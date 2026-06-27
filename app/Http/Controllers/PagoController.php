<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    public function procesar(Request $request)
    {
        $request->validate([
            'metodo_envio' => 'nullable|string',
            'numero_documento' => 'nullable|string',
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string',
        ]);

        if (Auth::check()) {
            // Aquí irá la lógica para guardar en la tabla 'boletas' y 'detalle_boleta' según el diagrama
            /*
            $boleta = Boleta::create([
                'id_usuario' => Auth::id(),
                'fecha_venta' => now(),
                'total_pago' => 1140, // Monto estático temporal
                'metodo_pago' => 'Transferencia/Efectivo',
                'estado_pedido' => 'Pendiente',
            ]);
            */

            // Limpiar carrito
            // Carrito::where('id_usuario', Auth::id())->delete();
        }

        return redirect()->route('dashboard')->with('success', 'Pedido realizado con éxito.');
    }
}
