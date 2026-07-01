<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAnuncioController extends Controller
{
    // ─────────────────────────────────────────────
    // 🔧 HELPER: Subir imagen a Cloudinary
    // ─────────────────────────────────────────────
    private function subirACloudinary($archivo, $carpeta = 'compuredperu/anuncios')
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey    = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        $timestamp = time();
        $params    = "folder={$carpeta}&timestamp={$timestamp}{$apiSecret}";
        $signature = sha1($params);

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
    // 📋 LISTAR
    // ─────────────────────────────────────────────
    public function index()
    {
        $anuncios = DB::table('anuncios')->get();
        return view('admin.anuncios.index', compact('anuncios'));
    }

    // ─────────────────────────────────────────────
    // 💾 GUARDAR ANUNCIO
    // ─────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:100',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Subir a Cloudinary en vez de disco local
        $url = $this->subirACloudinary($request->file('imagen'));

        if (!$url) {
            return back()->with('error', 'No se pudo subir la imagen. Intenta de nuevo.');
        }

        DB::table('anuncios')->insert([
            'titulo'     => $request->titulo,
            'imagen_url' => $url,
            'posicion'   => $request->posicion ?? 'principal',
            'activo'     => 1,
        ]);

        return back()->with('success', 'Anuncio publicado correctamente.');
    }

    // ─────────────────────────────────────────────
    // 🗑️ ELIMINAR ANUNCIO
    // ─────────────────────────────────────────────
    public function destroy($id)
    {
        $anuncio = DB::table('anuncios')->where('id_anuncio', $id)->first();

        if ($anuncio) {
            $this->eliminarDeCloudinary($anuncio->imagen_url);
            DB::table('anuncios')->where('id_anuncio', $id)->delete();
        }

        return back()->with('success', 'Anuncio eliminado correctamente.');
    }
}
