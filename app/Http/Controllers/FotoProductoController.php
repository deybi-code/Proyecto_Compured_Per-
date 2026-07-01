<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FotoProducto;

class FotoProductoController extends Controller
{
    // ─────────────────────────────────────────────
    // 🔧 HELPER: Subir imagen a Cloudinary
    // ─────────────────────────────────────────────
    private function subirACloudinary($archivo, $carpeta = 'compuredperu/productos')
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey    = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        $timestamp = time();
        $signature = sha1("folder={$carpeta}&timestamp={$timestamp}{$apiSecret}");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload");
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
        return $data['secure_url'] ?? null;
    }

    // ─────────────────────────────────────────────
    // 🔧 HELPER: Eliminar de Cloudinary
    // ─────────────────────────────────────────────
    private function eliminarDeCloudinary($url)
    {
        if (!$url || !str_contains($url, 'cloudinary.com')) return;

        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey    = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        preg_match('/upload\/(?:v\d+\/)?(.+)\.\w+$/', $url, $matches);
        if (empty($matches[1])) return;

        $publicId  = $matches[1];
        $timestamp = time();
        $signature = sha1("public_id={$publicId}&timestamp={$timestamp}{$apiSecret}");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.cloudinary.com/v1_1/{$cloudName}/image/destroy");
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
    // ➕ AGREGAR FOTOS A UN PRODUCTO
    // ─────────────────────────────────────────────
    public function store(Request $request, $id_producto)
    {
        $request->validate([
            'fotos'   => 'required|array|min:1',
            'fotos.*' => 'image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $subidas = 0;

        foreach ($request->file('fotos') as $foto) {
            if (!$foto) continue;

            $url = $this->subirACloudinary($foto);

            if ($url) {
                DB::table('fotos_productos')->insert([
                    'id_producto'  => $id_producto,
                    'ruta_foto'    => $url,
                    'es_principal' => 0,
                ]);
                $subidas++;
            }
        }

        if ($subidas > 0) {
            return redirect()->route('admin.productos.edit', $id_producto)
                ->with('success', "✅ {$subidas} foto(s) subida(s) correctamente a Cloudinary.");
        }

        return redirect()->route('admin.productos.edit', $id_producto)
            ->with('error', 'No se pudo subir ninguna foto. Verifica el formato e intenta de nuevo.');
    }

    // ─────────────────────────────────────────────
    // 🗑️ ELIMINAR UNA FOTO INDIVIDUAL
    // ─────────────────────────────────────────────
    public function destroy($id_foto)
    {
        $foto = FotoProducto::findOrFail($id_foto);
        $id_producto = $foto->id_producto;

        // Eliminar de Cloudinary
        $this->eliminarDeCloudinary($foto->ruta_foto);

        // Eliminar de la base de datos
        $foto->delete();

        return redirect()->route('admin.productos.edit', $id_producto)
            ->with('success', '✅ Foto eliminada correctamente.');
    }
}
