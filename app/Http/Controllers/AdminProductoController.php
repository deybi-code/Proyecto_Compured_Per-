<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminProductoController extends Controller
{
    // ─────────────────────────────────────────────
    // 🔧 HELPER: Subir imagen a Cloudinary
    // ─────────────────────────────────────────────
    private function subirACloudinary($archivo, $carpeta = 'compuredperu/productos')
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        $timestamp = time();
        $params = "folder={$carpeta}&timestamp={$timestamp}{$apiSecret}";
        $signature = sha1($params);

        $url = "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'file' => new \CURLFile($archivo->getRealPath(), $archivo->getMimeType(), $archivo->getClientOriginalName()),
            'api_key' => $apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
            'folder' => $carpeta,
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
        if (! $url || ! str_contains($url, 'cloudinary.com')) {
            return;
        }

        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        // Extraer el public_id de la URL de Cloudinary
        // Ejemplo URL: https://res.cloudinary.com/dwea7sfmc/image/upload/v123/compuredperu/productos/abc123.jpg
        preg_match('/upload\/(?:v\d+\/)?(.+)\.\w+$/', $url, $matches);
        if (empty($matches[1])) {
            return;
        }

        $publicId = $matches[1];
        $timestamp = time();
        $signature = sha1("public_id={$publicId}&timestamp={$timestamp}{$apiSecret}");

        $destroyUrl = "https://api.cloudinary.com/v1_1/{$cloudName}/image/destroy";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $destroyUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'public_id' => $publicId,
            'api_key' => $apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ]);

        curl_exec($ch);
        curl_close($ch);
    }

    // ─────────────────────────────────────────────
    // 📋 LISTAR
    // ─────────────────────────────────────────────
    public function index(Request $request)
    {
        $query = Producto::with('categoria')->orderBy('id_producto', 'desc');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('marca', 'like', "%{$search}%")
                    ->orWhere('id_producto', 'like', "%{$search}%");
            });
        }

        $productos = $query->get();

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
            'nombre' => 'required|string|max:150',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'marca' => 'required|string|max:50',
            'id_categoria' => 'required|integer|exists:categorias,id_categoria',
            'detalles_tecnicos' => 'nullable|string',
            'mostrar_inicio' => 'nullable|in:0,1',
            'imagen_principal' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['mostrar_inicio'] = $request->has('mostrar_inicio') ? 1 : 0;
        $data['fecha_registro'] = now();

        // Imagen principal → Cloudinary
        if ($request->hasFile('imagen_principal')) {
            $url = $this->subirACloudinary($request->file('imagen_principal'));
            if ($url) {
                $data['imagen'] = $url;
            }
        }

        $producto = Producto::create($data);

        // Imágenes adicionales → Cloudinary → tabla fotos_productos
        foreach (['imagen_1', 'imagen_2', 'imagen_3', 'imagen_4'] as $i => $campo) {
            if ($request->hasFile($campo)) {
                $url = $this->subirACloudinary($request->file($campo));
                if ($url) {
                    DB::table('fotos_productos')->insert([
                        'id_producto' => $producto->id_producto,
                        'ruta_foto' => $url,
                        'es_principal' => ($i === 0 && ! isset($data['imagen'])) ? 1 : 0,
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
        $producto = Producto::with('fotos')->findOrFail($id);
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
            'nombre' => 'required|string|max:150',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'marca' => 'required|string|max:50',
            'id_categoria' => 'required|integer|exists:categorias,id_categoria',
            'detalles_tecnicos' => 'nullable|string',
            'mostrar_inicio' => 'nullable|in:0,1',
        ]);

        $data['mostrar_inicio'] = $request->has('mostrar_inicio') ? 1 : 0;

        $producto->update($data);

        // Nuevas fotos adicionales → Cloudinary
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $url = $this->subirACloudinary($foto);
                if ($url) {
                    DB::table('fotos_productos')->insert([
                        'id_producto' => $producto->id_producto,
                        'ruta_foto' => $url,
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

    // ─────────────────────────────────────────────
    // 📊 IMPORTAR EXCEL
    // ─────────────────────────────────────────────
    public function importarExcel(Request $request)
    {
        $request->validate([
            'archivo_excel' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $archivo = $request->file('archivo_excel');
            $spreadsheet = IOFactory::load($archivo->getPathname());
            $hoja = $spreadsheet->getActiveSheet();
            $filas = $hoja->toArray();

            // Eliminar cabecera si existe
            if (count($filas) > 0 && strtolower($filas[0][0] ?? '') === 'nombre') {
                array_shift($filas);
            }

            $importados = 0;
            $errores = [];

            foreach ($filas as $index => $fila) {
                // Validar que tenga datos mínimos
                if (empty($fila[0])) {
                    continue; // Saltar filas vacías
                }

                $nombre = trim($fila[0] ?? '');
                $precio = floatval($fila[1] ?? 0);
                $stock = intval($fila[2] ?? 0);
                $marca = trim($fila[3] ?? '');
                $categoriaNombre = trim($fila[4] ?? '');
                $detalles = trim($fila[5] ?? '');

                // Validaciones básicas
                if (empty($nombre) || $precio <= 0 || $stock < 0) {
                    $errores[] = 'Fila '.($index + 2).': Datos incompletos o inválidos';

                    continue;
                }

                // Buscar o crear categoría
                $categoria = Categoria::where('nombre_categoria', $categoriaNombre)->first();
                if (! $categoria) {
                    $categoria = Categoria::create([
                        'nombre_categoria' => $categoriaNombre ?: 'General',
                        'descripcion' => 'Categoría creada por importación',
                    ]);
                }

                // Crear producto
                Producto::create([
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'stock' => $stock,
                    'marca' => $marca ?: 'Sin marca',
                    'id_categoria' => $categoria->id_categoria,
                    'detalles_tecnicos' => $detalles,
                    'mostrar_inicio' => 0,
                    'fecha_registro' => now(),
                ]);

                $importados++;
            }

            $mensaje = "✅ Se importaron {$importados} productos correctamente.";
            if (count($errores) > 0) {
                $mensaje .= ' ⚠️ '.count($errores).' errores: '.implode('; ', array_slice($errores, 0, 3));
            }

            return redirect()->route('admin.productos.index')
                ->with('success', $mensaje);

        } catch (\Exception $e) {
            return redirect()->route('admin.productos.index')
                ->with('error', '❌ Error al importar: '.$e->getMessage());
        }
    }
}
