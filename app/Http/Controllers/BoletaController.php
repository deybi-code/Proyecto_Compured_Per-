<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BoletaController extends Controller
{
    public function show($id) {
        // CORREGIDO: Busca por id_boleta
        $boleta = DB::table('boletas')->where('id_boleta', $id)->first();

        if (!$boleta) {
            return redirect()->back()->with('error', 'Boleta no encontrada.');
        }
        return view('admin.boletas.show', compact('boleta'));
    }
}
