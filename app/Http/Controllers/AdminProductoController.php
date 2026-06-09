<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        Producto::create([
            'nombre'            => $request->nombre,
            'precio'            => $request->precio,
            'stock'             => $request->stock ?? 0,
            'marca'             => $request->marca,
            'detalles_tecnicos' => $request->detalles_tecnicos,
            'id_categoria'      => $request->id_categoria,
            'mostrar_inicio'    => $request->has('mostrar_inicio') ? 1 : 0
        ]);

        return redirect('/admin/productos')->with('success', 'Producto creado');
    }

    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);

        $producto->update([
            'nombre'            => $request->nombre,
            'precio'            => $request->precio,
            'stock'             => $request->stock ?? 0,
            'marca'             => $request->marca,
            'detalles_tecnicos' => $request->detalles_tecnicos,
            'id_categoria'      => $request->id_categoria,
            'mostrar_inicio'    => $request->has('mostrar_inicio') ? 1 : 0
        ]);

        return redirect('/admin/productos')->with('success', 'Producto actualizado');
    }

    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect('/admin/productos')->with('success', 'Producto eliminado');
    }
}
