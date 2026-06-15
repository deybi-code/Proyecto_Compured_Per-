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
        // Se procesa el array de imágenes múltiples de forma segura para la base de datos
        $nombreImagen = null;
        if ($request->hasFile('imagenes')) {
            $files = $request->file('imagenes');
            if (count($files) > 0) {
                $mainImage = $files[0]; // Tomamos la primera imagen como la principal
                $nombreImagen = time() . '_' . $mainImage->getClientOriginalName();
                $mainImage->move(public_path('img'), $nombreImagen);
            }
        }

        Producto::create([
            'nombre'            => $request->nombre,
            'precio'            => $request->precio,
            'stock'             => $request->stock ?? 0,
            'marca'             => $request->marca,
            'detalles_tecnicos' => $request->detalles_tecnicos,
            'id_categoria'      => $request->id_categoria,
            'mostrar_inicio'    => $request->has('mostrar_inicio') ? 1 : 0,
            'imagen'            => $nombreImagen // Guardamos el nombre de la foto principal
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

        // Se mantiene la imagen actual por defecto
        $nombreImagen = $producto->imagen;

        // Si se suben nuevas imágenes, se reemplaza por la primera del nuevo grupo
        if ($request->hasFile('imagenes')) {
            $files = $request->file('imagenes');
            if (count($files) > 0) {
                $mainImage = $files[0];
                $nombreImagen = time() . '_' . $mainImage->getClientOriginalName();
                $mainImage->move(public_path('img'), $nombreImagen);
            }
        }

        $producto->update([
            'nombre'            => $request->nombre,
            'precio'            => $request->precio,
            'stock'             => $request->stock ?? 0,
            'marca'             => $request->marca,
            'detalles_tecnicos' => $request->detalles_tecnicos,
            'id_categoria'      => $request->id_categoria,
            'mostrar_inicio'    => $request->has('mostrar_inicio') ? 1 : 0,
            'imagen'            => $nombreImagen // Actualiza con la nueva foto principal o mantiene la anterior
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
