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
        $carrito = Session::get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para pagar.');
        }

        // 1. Validamos los datos que realmente manda el formulario del carrito
        $data = $request->validate([
            'tipo_doc'      => ['required', 'in:dni,ruc'],
            'dni'           => ['required_if:tipo_doc,dni', 'nullable', 'string', 'max:8'],
            'nombre'        => ['required_if:tipo_doc,dni', 'nullable', 'string', 'max:255'],
            'ruc'           => ['required_if:tipo_doc,ruc', 'nullable', 'string', 'max:11'],
            'razon_social'  => ['required_if:tipo_doc,ruc', 'nullable', 'string', 'max:255'],
            'entrega'       => ['required', 'in:delivery,recojo'],
            'telefono'      => ['required', 'string', 'max:20'],
            'direccion'     => ['required_if:entrega,delivery', 'nullable', 'string', 'max:255'],
            'referencia'    => ['nullable', 'string', 'max:255'],
            'metodo_pago'   => ['required', 'in:tarjeta,efectivo'],
        ]);

        // 2. "Efectivo" solo puede usarlo admin o ventas.
        //    Antes esto solo se ocultaba con Alpine.js en el HTML, pero cualquiera
        //    podía forzar el envío de metodo_pago=efectivo. Ahora se valida en el servidor.
        $rol = Auth::user()->rol;
        if ($data['metodo_pago'] === 'efectivo' && !in_array($rol, ['admin', 'ventas'])) {
            return back()->with('error', 'Tu rol no tiene permiso para usar el método de pago en efectivo.');
        }

        try {
            $idBoleta = DB::transaction(function () use ($carrito, $data) {
                $total = 0;

                // Verificar stock y calcular total
                foreach ($carrito as $id => $item) {
                    $producto = Producto::find($id);
                    if (!$producto) {
                        throw new \Exception("Producto no encontrado.");
                    }
                    if ($producto->stock < $item['cantidad']) {
                        throw new \Exception("Stock insuficiente para: {$producto->nombre}");
                    }
                    $total += $item['precio'] * $item['cantidad'];
                }

                // Crear boleta con los datos reales elegidos por el cliente
                $idBoleta = DB::table('boletas')->insertGetId([
                    'id_usuario'       => Auth::user()->id_usuario,
                    'fecha_venta'      => now(),
                    'total_pago'       => $total,
                    'metodo_pago'      => $data['metodo_pago'],
                    'canal_venta'      => $data['entrega'] === 'recojo' ? 'Recojo en Tienda' : 'Tienda Online',
                    'estado_pedido'    => $data['metodo_pago'] === 'efectivo' ? 'Pendiente' : 'Pagado',
                    'tipo_comprobante' => $data['tipo_doc'] === 'ruc' ? 'Factura' : 'Boleta',
                    'ruc_empresa'      => $data['tipo_doc'] === 'ruc' ? ($data['ruc'] ?? null) : null,
                ]);

                // Insertar detalles y descontar stock
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

                // Registrar en pagos_online SOLO si el pago fue con tarjeta/online.
                // El efectivo se cobra físicamente en caja, no genera transacción online.
                if ($data['metodo_pago'] === 'tarjeta') {
                    DB::table('pagos_online')->insert([
                        'id_boleta'      => $idBoleta,
                        'metodo_pago'    => 'tarjeta',
                        'transaccion_id' => 'TXN-' . strtoupper(uniqid()),
                        'estado_pago'    => 'aprobado',
                        'fecha_pago'     => now(),
                    ]);
                }

                return $idBoleta;
            });

            Session::forget('carrito');

            $mensaje = $data['metodo_pago'] === 'efectivo'
                ? '¡Pedido registrado! Tu boleta N° ' . $idBoleta . ' fue generada. Paga en caja al recoger/recibir tu pedido.'
                : '¡Pago procesado! Tu boleta N° ' . $idBoleta . ' fue generada.';

            return redirect()->route('dashboard')->with('success', $mensaje);

        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }
}
 