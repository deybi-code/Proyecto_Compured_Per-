<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProductoController extends Controller
{
    // ─────────────────────────────────────────────
    // 🔧 HELPER: Subir imagen a Cloudinary
    // ─────────────────────────────────────────────
    private function subirACloudinary($archivo, $carpeta = 'compuredperu/productos')
    {
        $cloudName  = env('CLOUDINARY_CLOUD_NAME');
        $apiKey     = env('CLOUDINARY_API_KEY');
        $apiSecret  = env('CLOUDINARY_API_SECRET');

        $timestamp  = time();
        $params     = "folder={$carpeta}&timestamp={$timestamp}{$apiSecret}";
        $signature  = sha1($params);

        $url = "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'file'      => new \CURLFile($archivo->getRealPath(), $archivo->getMimeType(), $archivo->getClientOriginalName()),
            'api_key'   => $apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
            'folder'    => $carpeta,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        // Retorna la URL segura de Cloudinary o null si falló
        return $data['secure_url'] ?? null;
    }

    // ─────────────────────────────────────────────
    // 🔧 HELPER: Eliminar imagen de Cloudinary
    // ─────────────────────────────────────────────
    private function eliminarDeCloudinary($url)
    {
        if (!$url || !str_contains($url, 'cloudinary.com')) return;

        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey    = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        // Extraer el public_id de la URL de Cloudinary
        // Ejemplo URL: https://res.cloudinary.com/dwea7sfmc/image/upload/v123/compuredperu/productos/abc123.jpg
        preg_match('/upload\/(?:v\d+\/)?(.+)\.\w+$/', $url, $matches);
        if (empty($matches[1])) return;

        $publicId  = $matches[1];
        $timestamp = time();
        $signature = sha1("public_id={$publicId}&timestamp={$timestamp}{$apiSecret}");

        $destroyUrl = "https://api.cloudinary.com/v1_1/{$cloudName}/image/destroy";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $destroyUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'public_id' => $publicId,
            'api_key'   => $apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ]);

        curl_exec($ch);
        curl_close($ch);
    }

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

        $data['mostrar_inicio'] = $request->has('mostrar_inicio') ? 1 : 0;
        $data['fecha_registro'] = now();

        // Imagen principal → Cloudinary
        if ($request->hasFile('imagen_principal')) {
            $url = $this->subirACloudinary($request->file('imagen_principal'));
            if ($url) $data['imagen'] = $url;
        }

        $producto = Producto::create($data);

        // Imágenes adicionales → Cloudinary → tabla fotos_productos
        foreach (['imagen_1', 'imagen_2', 'imagen_3', 'imagen_4'] as $i => $campo) {
            if ($request->hasFile($campo)) {
                $url = $this->subirACloudinary($request->file($campo));
                if ($url) {
                    DB::table('fotos_productos')->insert([
                        'id_producto'  => $producto->id_producto,
                        'ruta_foto'    => $url,
                        'es_principal' => ($i === 0 && !isset($data['imagen'])) ? 1 : 0,
                    ]);
                }
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
            'detalles_tecnicos' => 'nullable|string',
            'mostrar_inicio'    => 'nullable|in:0,1',
        ]);

        $data['mostrar_inicio'] = $request->has('mostrar_inicio') ? 1 : 0;

        $producto->update($data);

        // Nuevas fotos adicionales → Cloudinary
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $url = $this->subirACloudinary($foto);
                if ($url) {
                    DB::table('fotos_productos')->insert([
                        'id_producto'  => $producto->id_producto,
                        'ruta_foto'    => $url,
                        'es_principal' => 0,
                    ]);
                }
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

        // Eliminar imagen principal de Cloudinary
        $this->eliminarDeCloudinary($producto->imagen);

        // Eliminar fotos adicionales de Cloudinary
        foreach ($producto->fotos as $foto) {
            $this->eliminarDeCloudinary($foto->ruta_foto);
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('success', '✅ Producto eliminado correctamente.');
    }
}
