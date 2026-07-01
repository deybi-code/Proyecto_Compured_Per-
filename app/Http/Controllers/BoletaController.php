<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BoletaController extends Controller
{
    /**
     * Vista de boleta para el panel de administración/ventas (ya existía).
     */
    public function show($id)
    {
        $boleta = DB::table('boletas')->where('id_boleta', $id)->first();

        if (!$boleta) {
            return redirect()->route('dashboard')
                ->with('error', 'Boleta no encontrada.');
        }

        $detalles = $this->obtenerDetalles($id);

        return view('admin.boletas.show', compact('boleta', 'detalles'));
    }

    /**
     * Vista de boleta electrónica para el cliente que la compró.
     * Solo puede verla el dueño de la boleta (o un admin/ventas).
     */
    public function showCliente($id)
    {
        $boleta = DB::table('boletas')->where('id_boleta', $id)->first();

        if (!$boleta) {
            return redirect()->route('dashboard')
                ->with('error', 'Boleta no encontrada.');
        }

        $usuario = Auth::user();
        $esDueno = $boleta->id_usuario === $usuario->id_usuario;
        $esStaff = in_array($usuario->rol, ['admin', 'ventas']);

        if (!$esDueno && !$esStaff) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para ver esa boleta.');
        }

        $detalles = $this->obtenerDetalles($id);
        $pago     = DB::table('pagos_online')->where('id_boleta', $id)->first();

        // Serie del comprobante (B001 / F001, configurable en config/empresa.php)
        $serie = $boleta->tipo_comprobante === 'Factura'
            ? config('empresa.serie_factura', 'F001')
            : config('empresa.serie_boleta', 'B001');
        $numeroComprobante = $serie . '-' . str_pad($boleta->id_boleta, 8, '0', STR_PAD_LEFT);

        // Desglose de IGV según cómo esté configurado el precio (con o sin IGV incluido)
        if (config('empresa.incluye_igv', true)) {
            $opGravada = round($boleta->total_pago / 1.18, 2);
            $igv       = round($boleta->total_pago - $opGravada, 2);
            $total     = $boleta->total_pago;
        } else {
            $opGravada = $boleta->total_pago;
            $igv       = round($boleta->total_pago * 0.18, 2);
            $total     = round($opGravada + $igv, 2);
        }

        $importeEnLetras = $this->numeroALetras($total);

        return view('boleta_cliente', compact(
            'boleta', 'detalles', 'pago', 'numeroComprobante', 'opGravada', 'igv', 'total', 'importeEnLetras'
        ));
    }

    private function obtenerDetalles($id)
    {
        return DB::table('detalle_boleta')
            ->join('productos', 'detalle_boleta.id_producto', '=', 'productos.id_producto')
            ->where('detalle_boleta.id_boleta', $id)
            ->select(
                'detalle_boleta.*',
                'productos.nombre',
                'productos.marca'
            )
            ->get();
    }

    /**
     * Convierte un monto en soles a letras, ej: 865.50 -> "OCHOCIENTOS SESENTA
     * Y CINCO CON 50/100 SOLES". Uso interno solo para la boleta electrónica.
     */
    private function numeroALetras(float $monto): string
    {
        $entero   = (int) floor($monto);
        $centavos = (int) round(($monto - $entero) * 100);

        $letras = $entero === 0 ? 'CERO' : $this->enterosALetras($entero);

        return strtoupper($letras) . ' CON ' . str_pad((string) $centavos, 2, '0', STR_PAD_LEFT) . '/100 SOLES';
    }

    private function enterosALetras(int $n): string
    {
        $unidades = ['', 'UNO', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE'];
        $especiales = [
            10 => 'DIEZ', 11 => 'ONCE', 12 => 'DOCE', 13 => 'TRECE', 14 => 'CATORCE', 15 => 'QUINCE',
            16 => 'DIECISÉIS', 17 => 'DIECISIETE', 18 => 'DIECIOCHO', 19 => 'DIECINUEVE',
            20 => 'VEINTE',
        ];
        $decenas = [
            20 => 'VEINTI', 30 => 'TREINTA', 40 => 'CUARENTA', 50 => 'CINCUENTA',
            60 => 'SESENTA', 70 => 'SETENTA', 80 => 'OCHENTA', 90 => 'NOVENTA',
        ];
        $centenas = [
            100 => 'CIEN', 200 => 'DOSCIENTOS', 300 => 'TRESCIENTOS', 400 => 'CUATROCIENTOS',
            500 => 'QUINIENTOS', 600 => 'SEISCIENTOS', 700 => 'SETECIENTOS', 800 => 'OCHOCIENTOS', 900 => 'NOVECIENTOS',
        ];

        if ($n < 10) {
            return $unidades[$n];
        }
        if ($n <= 20) {
            return $especiales[$n];
        }
        if ($n < 100) {
            $d = intdiv($n, 10) * 10;
            $u = $n % 10;
            if ($d === 20) {
                return $u === 0 ? 'VEINTE' : 'VEINTI' . strtolower($unidades[$u]);
            }
            return $u === 0 ? $decenas[$d] : $decenas[$d] . ' Y ' . $unidades[$u];
        }
        if ($n === 100) {
            return 'CIEN';
        }
        if ($n < 1000) {
            $c = intdiv($n, 100) * 100;
            $resto = $n % 100;
            return $resto === 0 ? $centenas[$c] : $centenas[$c] . ' ' . $this->enterosALetras($resto);
        }
        if ($n < 1000000) {
            $miles = intdiv($n, 1000);
            $resto = $n % 1000;
            $prefijo = $miles === 1 ? 'MIL' : $this->enterosALetras($miles) . ' MIL';
            return $resto === 0 ? $prefijo : $prefijo . ' ' . $this->enterosALetras($resto);
        }

        $millones = intdiv($n, 1000000);
        $resto = $n % 1000000;
        $prefijo = $millones === 1 ? 'UN MILLÓN' : $this->enterosALetras($millones) . ' MILLONES';
        return $resto === 0 ? $prefijo : $prefijo . ' ' . $this->enterosALetras($resto);
    }
}
