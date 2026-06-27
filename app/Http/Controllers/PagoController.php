<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class PagoController extends Controller
{
    public function procesar(Request $request)
    {
        // Verificar que el carrito no está vacío
        $carrito = Session::get('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        // Verificar que el usuario está autenticado (por seguridad extra)
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para pagar.');
        }

        try {
            $idBoleta = DB::transaction(function () use ($carrito) {
                $total = 0;

                // Verificar stock y calcular total
                foreach ($carrito as $id => $item) {
                    $producto = Producto::find($id);
                    if (!$producto) {
                        throw new \Exception("Producto no encontrado: {$id}");
                    }
                    if ($producto->stock < $item['cantidad']) {
                        throw new \Exception("Stock insuficiente para: {$producto->nombre}");
                    }
                    $total += $item['precio'] * $item['cantidad'];
                }

                // Crear la boleta
                $idBoleta = DB::table('boletas')->insertGetId([
                    'id_usuario'       => Auth::user()->id_usuario,
                    'fecha_venta'      => now(),
                    'total_pago'       => $total,
                    'metodo_pago'      => 'online',
                    'canal_venta'      => 'Tienda Online',
                    'estado_pedido'    => 'Pagado',
                    'tipo_comprobante' => 'Boleta',
                ]);

                // Registrar detalle y descontar stock
                foreach ($carrito as $id => $item) {
                    $producto = Producto::find($id);

                    DB::table('detalle_boleta')->insert([
                        'id_boleta'       => $idBoleta,
                        'id_producto'     => $id,
                        'cantidad'        => $item['cantidad'],
                        'precio_unitario' => $item['precio'],
                    ]);

                    $producto->stock -= $item['cantidad'];
                    $producto->save();
                }

                // Registrar en pagos_online
                DB::table('pagos_online')->insert([
                    'id_boleta'    => $idBoleta,
                    'monto'        => $total,
                    'metodo_pago'  => 'tarjeta',
                    'estado_pago'  => 'aprobado',
                    'fecha_pago'   => now(),
                ]);

                return $idBoleta;
            });

            Session::forget('carrito');
            return redirect()->route('dashboard')
                ->with('success', '¡Pago procesado con éxito! Tu boleta N° ' . $idBoleta . ' fue generada.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }
}
