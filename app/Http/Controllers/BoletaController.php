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
     * NUEVO: vista de boleta electrónica para el cliente que la compró.
     * Solo puede verla el dueño de la boleta (o un admin/ventas).
     */
    public function showCliente($id)
    {
        $boleta = DB::table('boletas')->where('id_boleta', $id)->first();

        if (!$boleta) {
            return redirect()->route('dashboard')
                ->with('error', 'Boleta no encontrada.');
        }

        $usuario   = Auth::user();
        $esDueno   = $boleta->id_usuario === $usuario->id_usuario;
        $esStaff   = in_array($usuario->rol, ['admin', 'ventas']);

        if (!$esDueno && !$esStaff) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para ver esa boleta.');
        }

        $detalles = $this->obtenerDetalles($id);

        $pago = DB::table('pagos_online')->where('id_boleta', $id)->first();

        return view('boleta_cliente', compact('boleta', 'detalles', 'pago'));
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
}
