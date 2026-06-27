<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\PagoOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    public function procesar(Request $request)
    {
        // 1. Crear la Boleta
        $boleta = Boleta::create([
            'id_usuario' => Auth::id(),
            'fecha_venta' => now(),
            'total_pago' => $request->total,
            'estado_pedido' => 'pendiente'
        ]);

        // 2. Registrar el Pago Online
        PagoOnline::create([
            'id_boleta' => $boleta->id_boleta,
            'metodo_pago' => $request->metodo,
            'estado_pago' => 'pendiente',
            'fecha_pago' => now()
        ]);

        return redirect()->route('dashboard')->with('success', 'Pedido realizado con éxito');
    }
}
