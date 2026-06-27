<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductoController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validamos los datos según los campos de tu tabla
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'marca' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Manejo de imagen (sin modificar BD, solo guardamos el nombre del archivo)
        $nombreImagen = null;
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $nombreImagen);
        }

        // 3. Guardamos respetando los nombres de tu tabla 'productos'
        Producto::create([
            'nombre' => $validated['nombre'],
            'precio' => $validated['precio'],
            'stock' => $validated['stock'],
            'marca' => $validated['marca'],
            'id_categoria' => 1, // Valor temporal, luego lo dinamizamos
            'fecha_registro' => now(),
            'mostrar_inicio' => 1,
        ]);

        return redirect()->route('admin.productos')->with('success', 'Producto registrado correctamente.');
    }
}
