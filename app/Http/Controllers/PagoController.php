<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class PagoController extends Controller
{
    public function procesar(Request $request) {
        $carrito = Session::get('carrito', []);
        if (empty($carrito)) {
            return back()->with('error', 'El carrito está vacío.');
        }

        return DB::transaction(function () use ($carrito) {
            // CORREGIDO: calcular el total correctamente (precio * cantidad)
            $total = 0;
            foreach ($carrito as $id => $item) {
                $total += $item['precio'] * $item['cantidad'];

                // Reducir el stock de cada producto
                $producto = Producto::find($id);
                if ($producto) {
                    $producto->stock -= $item['cantidad'];
                    $producto->save();
                }
            }

            // CORREGIDO: crear primero la boleta y obtener su ID real
            $idBoleta = DB::table('boletas')->insertGetId([
                'id_usuario'       => Auth::id(),
                'fecha_venta'      => now(),
                'total_pago'       => $total,
                'metodo_pago'      => 'online',
                'canal_venta'      => 'Tienda Online',
                'estado_pedido'    => 'Pagado',
                'tipo_comprobante' => 'Boleta',
            ]);

            // CORREGIDO: insertar en pagos_online con el id_boleta real (antes era 1 hardcodeado)
            DB::table('pagos_online')->insert([
                'id_boleta'   => $idBoleta,
                'monto'       => $total,
                'metodo_pago' => 'tarjeta',
                'estado'      => 'aprobado',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            Session::forget('carrito');
            return redirect()->route('dashboard')->with('success', '¡Pago procesado con éxito! Tu boleta N° ' . $idBoleta . ' fue generada.');
        });
    }
}
