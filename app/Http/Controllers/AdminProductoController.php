<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductoController extends Controller
{
    // ─────────────────────────────────────────────
    // 📋 LISTAR
    // ─────────────────────────────────────────────
    public function index()
    {
        $productos = Producto::with('categoria')->orderBy('id_producto', 'desc')->get();
        return view('admin.productos.index', compact('productos'));
    }

    // ─────────────────────────────────────────────
    // ➕ FORMULARIO CREAR
    // ─────────────────────────────────────────────
    public function create()
    {
        $categorias = Categoria::orderBy('nombre_categoria')->get();
        return view('admin.productos.create', compact('categorias'));
    }

    // ─────────────────────────────────────────────
    // 💾 GUARDAR NUEVO PRODUCTO
    // ─────────────────────────────────────────────
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'            => 'required|string|max:150',
            'precio'            => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'marca'             => 'required|string|max:50',
            'id_categoria'      => 'required|integer|exists:categorias,id_categoria',
            'detalles_tecnicos' => 'nullable|string',
            'mostrar_inicio'    => 'nullable|in:0,1',
            'imagen_principal'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Checkbox → 0 o 1
        $data['mostrar_inicio'] = $request->has('mostrar_inicio') ? 1 : 0;
        $data['fecha_registro'] = now();

        // Imagen principal
        if ($request->hasFile('imagen_principal')) {
            $data['imagen'] = $request->file('imagen_principal')
                ->store('productos', 'public');
        }

        // Crear producto
        $producto = Producto::create($data);

        // Imágenes adicionales → tabla fotos_productos
        foreach (['imagen_1', 'imagen_2', 'imagen_3', 'imagen_4'] as $i => $campo) {
            if ($request->hasFile($campo)) {
                $ruta = $request->file($campo)->store('productos', 'public');

                \Illuminate\Support\Facades\DB::table('fotos_productos')->insert([
                    'id_producto'  => $producto->id_producto,
                    'ruta_foto'    => $ruta,
                    'es_principal' => ($i === 0 && !isset($data['imagen'])) ? 1 : 0,
                ]);
            }
        }

        return redirect()->route('admin.productos.index')
            ->with('success', '✅ Producto creado correctamente.');
    }

    // ─────────────────────────────────────────────
    // 👁️ VER DETALLE
    // ─────────────────────────────────────────────
    public function show($id)
    {
        $producto = Producto::with(['categoria', 'fotos'])->findOrFail($id);
        return view('admin.productos.show', compact('producto'));
    }

    // ─────────────────────────────────────────────
    // ✏️ FORMULARIO EDITAR
    // ─────────────────────────────────────────────
    public function edit($id)
    {
        $producto   = Producto::with('fotos')->findOrFail($id);
        $categorias = Categoria::orderBy('nombre_categoria')->get();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }
// ─────────────────────────────────────────────
    // 🔄 ACTUALIZAR PRODUCTO
    // ─────────────────────────────────────────────
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $data = $request->validate([
            'nombre'            => 'required|string|max:150',
            'precio'            => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'marca'             => 'required|string|max:50',
            'id_categoria'      => 'required|integer|exists:categorias,id_categoria',
            'detalles_tecnicos' => 'nullable|string', // Cambiado de 'descripcion'
            'mostrar_inicio'    => 'nullable|in:0,1',
        ]);

        $data['mostrar_inicio'] = $request->has('mostrar_inicio') ? 1 : 0;

        // 1. Actualizar datos básicos
        $producto->update($data);

        // 2. Procesar fotos adicionales (fotos[])
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $ruta = $foto->store('productos', 'public');
                \Illuminate\Support\Facades\DB::table('fotos_productos')->insert([
                    'id_producto'  => $producto->id_producto,
                    'ruta_foto'    => $ruta,
                    'es_principal' => 0,
                ]);
            }
        }

        return redirect()->route('admin.productos.index')
            ->with('success', '✅ Producto actualizado correctamente.');
    }

    // ─────────────────────────────────────────────
    // 🗑️ ELIMINAR PRODUCTO
    // ─────────────────────────────────────────────
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        // Eliminar imagen principal del disco
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        // Eliminar fotos adicionales del disco
        foreach ($producto->fotos as $foto) {
            Storage::disk('public')->delete($foto->ruta_foto);
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('success', '✅ Producto eliminado correctamente.');
    }
}
