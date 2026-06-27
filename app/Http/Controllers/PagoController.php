<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    public function procesar(Request $request) {
        $carrito = Session::get('carrito', []);
        if (empty($carrito)) return back()->with('error', 'Carrito vacío');

        // Aquí guardamos el pago (simplificado)
        DB::table('pagos_online')->insert([
            'id_boleta' => 1, // Esto vendría de la lógica real de crear la boleta
            'monto' => array_sum(array_column($carrito, 'precio')),
            'metodo_pago' => 'tarjeta',
            'estado' => 'aprobado',
            'created_at' => now()
        ]);

        Session::forget('carrito');
        return redirect()->route('dashboard')->with('success', 'Pago procesado con éxito');
    }
}
