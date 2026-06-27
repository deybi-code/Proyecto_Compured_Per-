<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BoletaController extends Controller
{
    /**
     * Muestra la boleta lista para imprimir.
     */
    public function show($id)
    {
        // Buscamos en tu tabla 'boletas' usando el ID correspondiente
        $boleta = DB::table('boletas')->where('id', $id)->first();

        if (!$boleta) {
            return redirect()->back()->with('error', 'Boleta no encontrada.');
        }

        return view('admin.boletas.show', compact('boleta'));
    }
}
