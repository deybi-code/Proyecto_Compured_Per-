<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class PagoController extends Controller
{
    /**
     * Paso 1: recibe los datos de envío/facturación del formulario del carrito.
     *
     * - Si el método es "tarjeta": NO se cobra ni se genera boleta todavía.
     *   Se guardan los datos validados en sesión y se redirige a la pasarela
     *   de pago (/pago/pasarela), donde recién se piden los datos de la tarjeta.
     * - Si el método es "efectivo": el admin/ventas ya tiene el dinero en mano
     *   al confirmar (se cobra en caja al momento), así que la boleta se marca
     *   "Pagado" de inmediato.
     * - Si el método es "transferencia": el pago aún no está confirmado (falta
     *   que el cliente envíe su voucher), así que queda "Pendiente".
     */
    public function procesar(Request $request)
    {
        $carrito = Session::get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para pagar.');
        }

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
            'metodo_pago'   => ['required', 'in:tarjeta,transferencia,efectivo'],
        ]);

        $rol = Auth::user()->rol;
        if ($data['metodo_pago'] === 'efectivo' && !in_array($rol, ['admin', 'ventas'])) {
            return back()->with('error', 'Tu rol no tiene permiso para usar el método de pago en efectivo.');
        }

        // 🔀 Tarjeta: todavía no se cobra nada. Se manda a la pasarela.
        if ($data['metodo_pago'] === 'tarjeta') {
            Session::put('checkout_pendiente', $data);
            return redirect()->route('pago.pasarela');
        }

        // Efectivo / Transferencia: se registra el pedido de inmediato (sin pasarela online).
        try {
            // ✅ Efectivo = ya se cobró en caja al confirmar -> Pagado.
            // Transferencia = falta verificar el voucher -> Pendiente.
            $estadoPedido = $data['metodo_pago'] === 'efectivo' ? 'Pagado' : 'Pendiente';

            $idBoleta = $this->registrarBoleta($carrito, $data, [
                'estado_pedido' => $estadoPedido,
            ]);

            Session::forget('carrito');
            Session::forget('checkout_pendiente');

            $mensaje = $data['metodo_pago'] === 'efectivo'
                ? '¡Pago recibido! Tu boleta N° ' . $idBoleta . ' fue generada y marcada como pagada.'
                : '¡Pedido registrado! Tu boleta N° ' . $idBoleta . ' fue generada. Envíanos tu voucher de la transferencia para confirmar el pago.';

            return redirect()->route('boletas.mia', $idBoleta)->with('success', $mensaje);

        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    /**
     * Paso 2 (solo tarjeta): muestra la pasarela de pago donde el cliente
     * ingresa los datos de su tarjeta.
     */
    public function mostrarPasarela()
    {
        $carrito = Session::get('carrito', []);
        $checkout = Session::get('checkout_pendiente');

        if (empty($carrito) || !$checkout || ($checkout['metodo_pago'] ?? null) !== 'tarjeta') {
            return redirect()->route('carrito.index')
                ->with('error', 'No hay un pago con tarjeta pendiente. Completa el carrito nuevamente.');
        }

        $total = collect($carrito)->sum(fn ($item) => $item['precio'] * $item['cantidad']);

        return view('pasarela', compact('carrito', 'total'));
    }

    /**
     * Paso 3 (solo tarjeta): valida los datos de la tarjeta como lo haría una
     * pasarela real (número con algoritmo de Luhn, vencimiento no pasado,
     * CVV), simula la autorización y recién ahí genera la boleta + el
     * registro en pagos_online.
     */
    public function confirmarTarjeta(Request $request)
    {
        $carrito  = Session::get('carrito', []);
        $checkout = Session::get('checkout_pendiente');

        if (empty($carrito) || !$checkout || ($checkout['metodo_pago'] ?? null) !== 'tarjeta') {
            return redirect()->route('carrito.index')
                ->with('error', 'No hay un pago con tarjeta pendiente. Completa el carrito nuevamente.');
        }

        $tarjeta = $request->validate([
            'numero_tarjeta' => ['required', 'string'],
            'nombre_titular' => ['required', 'string', 'max:255'],
            'mes_exp'        => ['required', 'digits:2', 'between:01,12'],
            'anio_exp'       => ['required', 'digits:4'],
            'cvv'            => ['required', 'digits_between:3,4'],
        ]);

        $numero = preg_replace('/\D/', '', $tarjeta['numero_tarjeta']);

        if (strlen($numero) < 13 || strlen($numero) > 19 || !$this->luhnValido($numero)) {
            return back()->withInput()->with('error', 'El número de tarjeta no es válido.');
        }

        $vencimiento = \DateTime::createFromFormat('Y-m-d', $tarjeta['anio_exp'] . '-' . $tarjeta['mes_exp'] . '-01');
        $finDeMes    = (clone $vencimiento)->modify('last day of this month');
        if (!$vencimiento || $finDeMes < new \DateTime('today')) {
            return back()->withInput()->with('error', 'La tarjeta está vencida.');
        }

        try {
            $ultimos4 = substr($numero, -4);

            $idBoleta = $this->registrarBoleta($carrito, $checkout, [
                'estado_pedido' => 'Pagado',
            ]);

            // CORREGIDO: 'monto' es obligatoria en pagos_online y no se estaba
            // enviando. Se toma el total ya calculado y guardado en la boleta
            // recién creada.
            $totalBoleta = DB::table('boletas')->where('id_boleta', $idBoleta)->value('total_pago');

            DB::table('pagos_online')->insert([
                'id_boleta'      => $idBoleta,
                'monto'          => $totalBoleta,
                'metodo_pago'    => 'tarjeta',
                'transaccion_id' => 'TXN-' . strtoupper(uniqid()) . '-' . $ultimos4,
                'estado_pago'    => 'aprobado',
                'fecha_pago'     => now(),
            ]);

            Session::forget('carrito');
            Session::forget('checkout_pendiente');

            return redirect()->route('boletas.mia', $idBoleta)
                ->with('success', '¡Pago aprobado! Tu boleta N° ' . $idBoleta . ' fue generada.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    public function cancelarPasarela()
    {
        Session::forget('checkout_pendiente');
        return redirect()->route('carrito.index')->with('error', 'Pago con tarjeta cancelado.');
    }

    /**
     * Verifica stock, calcula el total, crea la boleta (con los datos del
     * cliente que llenó en el checkout), sus detalles, y descuenta el stock.
     * Reutilizado tanto por el flujo directo (efectivo/transferencia) como
     * por el flujo de tarjeta (tras aprobar el pago en la pasarela).
     */
    private function registrarBoleta(array $carrito, array $data, array $overrides = []): int
    {
        return DB::transaction(function () use ($carrito, $data, $overrides) {
            $total = 0;

            foreach ($carrito as $id => $item) {
                $producto = Producto::find($id);
                if (!$producto) {
                    throw new \Exception('Producto no encontrado.');
                }
                if ($producto->stock < $item['cantidad']) {
                    throw new \Exception("Stock insuficiente para: {$producto->nombre}");
                }
                $total += $item['precio'] * $item['cantidad'];
            }

            $idBoleta = DB::table('boletas')->insertGetId([
                'id_usuario'        => Auth::user()->id_usuario,
                'fecha_venta'       => now(),
                'total_pago'        => $total,
                'metodo_pago'       => $data['metodo_pago'],
                'canal_venta'       => $data['entrega'] === 'recojo' ? 'Recojo en Tienda' : 'Tienda Online',
                'estado_pedido'     => $overrides['estado_pedido'] ?? 'Pendiente',
                'tipo_comprobante'  => $data['tipo_doc'] === 'ruc' ? 'Factura' : 'Boleta',
                'ruc_empresa'       => $data['tipo_doc'] === 'ruc' ? ($data['ruc'] ?? null) : null,
                // 🧾 Datos del cliente tal cual los llenó en el checkout,
                // para que la boleta electrónica los pueda mostrar.
                'dni_cliente'       => $data['tipo_doc'] === 'dni' ? ($data['dni'] ?? null) : null,
                'nombre_cliente'    => $data['tipo_doc'] === 'ruc' ? ($data['razon_social'] ?? null) : ($data['nombre'] ?? null),
                'direccion_cliente' => $data['direccion'] ?? null,
                'telefono_cliente'  => $data['telefono'] ?? null,
            ]);

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

            return $idBoleta;
        });
    }

    /**
     * Algoritmo de Luhn: validación estándar del número de tarjeta
     * (la misma que usa cualquier pasarela real antes de intentar cobrar).
     */
    private function luhnValido(string $numero): bool
    {
        $suma = 0;
        $alternar = false;

        for ($i = strlen($numero) - 1; $i >= 0; $i--) {
            $digito = (int) $numero[$i];

            if ($alternar) {
                $digito *= 2;
                if ($digito > 9) {
                    $digito -= 9;
                }
            }

            $suma += $digito;
            $alternar = !$alternar;
        }

        return $suma % 10 === 0;
    }
}
