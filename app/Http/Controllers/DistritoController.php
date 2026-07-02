<?php

namespace App\Http\Controllers;

use App\Models\Distrito;

class DistritoController extends Controller
{
    public function index()
    {
        $distritos = Distrito::activo()->orderBy('distancia_km')->get();

        return response()->json($distritos);
    }

    public function show($id)
    {
        $distrito = Distrito::findOrFail($id);

        return response()->json($distrito);
    }
}
