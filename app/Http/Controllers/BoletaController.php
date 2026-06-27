<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BoletaController extends Controller
{
    public function show($id) {
        $boleta = DB::table('boletas')->where('id_boleta', $id)->first();

        if (!$boleta) {
            return redirect()->route('admin.productos.index')->with('error', 'Boleta no encontrada.');
        }

        // AÑADIDO: cargar los detalles de la boleta para mostrar los productos
        $detalles = DB::table('detalle_boleta')
            ->join('productos', 'detalle_boleta.id_producto', '=', 'productos.id_producto')
            ->where('detalle_boleta.id_boleta', $id)
            ->select('detalle_boleta.*', 'productos.nombre')
            ->get();

        return view('admin.boletas.show', compact('boleta', 'detalles'));
    }
}
