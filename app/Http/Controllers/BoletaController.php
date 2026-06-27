<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BoletaController extends Controller
{
    public function show($id)
    {
        $boleta = DB::table('boletas')->where('id_boleta', $id)->first();

        if (!$boleta) {
            return redirect()->route('dashboard')
                ->with('error', 'Boleta no encontrada.');
        }

        $detalles = DB::table('detalle_boleta')
            ->join('productos', 'detalle_boleta.id_producto', '=', 'productos.id_producto')
            ->where('detalle_boleta.id_boleta', $id)
            ->select(
                'detalle_boleta.*',
                'productos.nombre',
                'productos.marca'
            )
            ->get();

        return view('admin.boletas.show', compact('boleta', 'detalles'));
    }
}
