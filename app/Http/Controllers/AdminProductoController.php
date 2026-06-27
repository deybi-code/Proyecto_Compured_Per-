<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class AdminProductoController extends Controller
{
    public function index() {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    public function create() {
        return view('admin.productos.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'marca' => 'required',
        ]);
        Producto::create($data);
        return redirect()->route('admin.productos.index')->with('success', 'Producto creado.');
    }

    public function edit($id) {
        $producto = Producto::findOrFail($id);
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, $id) {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado.');
    }

    public function destroy($id) {
        Producto::findOrFail($id)->delete();
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado.');
    }
}
