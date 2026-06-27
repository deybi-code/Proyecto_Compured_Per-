<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminProductoController extends Controller
{
    public function index() {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    public function create() {
        // CORREGIDO: se pasan las categorías para el select
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'marca'       => 'required|string|max:255',
            'id_categoria'=> 'required|integer|exists:categorias,id_categoria',
            'detalles_tecnicos' => 'nullable|string',
            'mostrar_inicio'    => 'nullable|boolean',
        ]);

        // CORREGIDO: manejo del checkbox mostrar_inicio
        $data['mostrar_inicio'] = $request->has('mostrar_inicio') ? 1 : 0;

        Producto::create($data);
        return redirect()->route('admin.productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id) {
        $producto   = Producto::findOrFail($id);
        // CORREGIDO: se pasan las categorías para el select del formulario de edición
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id) {
        $producto = Producto::findOrFail($id);

        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'marca'       => 'required|string|max:255',
            'id_categoria'=> 'required|integer|exists:categorias,id_categoria',
            'detalles_tecnicos' => 'nullable|string',
            'mostrar_inicio'    => 'nullable|boolean',
        ]);

        // CORREGIDO: manejo del checkbox mostrar_inicio
        $data['mostrar_inicio'] = $request->has('mostrar_inicio') ? 1 : 0;

        // CORREGIDO: antes se usaba $request->all() sin validar
        $producto->update($data);
        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id) {
        Producto::findOrFail($id)->delete();
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
