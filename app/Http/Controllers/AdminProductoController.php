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
        $nombreImagen = null;

        if ($request->hasFile('imagenes')) {
            $archivo = $request->file('imagenes');
            // Obtiene el archivo sea un array o un archivo único
            $mainImage = is_array($archivo) ? current($archivo) : $archivo;

            if ($mainImage && $mainImage->isValid()) {
                $nombreImagen = time() . '_' . $mainImage->getClientOriginalName();
                $rutaDestino = public_path('img');

                // CRUCIAL: Crea la carpeta en Render si no existe
                if (!file_exists($rutaDestino)) {
                    mkdir($rutaDestino, 0777, true);
                }

                $mainImage->move($rutaDestino, $nombreImagen);
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
            'imagen'            => $nombreImagen
        ]);

        return redirect('/admin/productos')->with('success', 'Producto creado');
    }

    public function show(string $id)
    {
        $producto = Producto::where('id_producto', $id)->firstOrFail();
        return view('producto', compact('producto'));
    }

    public function edit(string $id)
    {
        $producto = Producto::where('id_producto', $id)->firstOrFail();
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, string $id)
    {
        $producto = Producto::where('id_producto', $id)->firstOrFail();
        $nombreImagen = $producto->imagen;

        if ($request->hasFile('imagenes')) {
            $archivo = $request->file('imagenes');
            // Obtiene el archivo sea un array o un archivo único
            $mainImage = is_array($archivo) ? current($archivo) : $archivo;

            if ($mainImage && $mainImage->isValid()) {
                $nombreImagen = time() . '_' . $mainImage->getClientOriginalName();
                $rutaDestino = public_path('img');

                // CRUCIAL: Crea la carpeta en Render si no existe
                if (!file_exists($rutaDestino)) {
                    mkdir($rutaDestino, 0777, true);
                }

                $mainImage->move($rutaDestino, $nombreImagen);
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
            'imagen'            => $nombreImagen
        ]);

        return redirect('/admin/productos')->with('success', 'Producto actualizado');
    }

    public function destroy(string $id)
    {
        $producto = Producto::where('id_producto', $id)->firstOrFail();
        $producto->delete();
        return redirect('/admin/productos')->with('success', 'Producto eliminado');
    }
}
