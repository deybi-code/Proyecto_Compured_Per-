<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminAnuncioController extends Controller
{
    public function index()
    {
        // Traemos todos los anuncios de tu tabla existente
        $anuncios = DB::table('anuncios')->get();
        return view('admin.anuncios.index', compact('anuncios'));
    }

    public function store(Request $request)
    {
        // 1. Validamos datos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Subimos el archivo a la carpeta 'anuncios' dentro de storage/app/public
        $path = $request->file('imagen')->store('anuncios', 'public');

        // 3. Insertamos en la tabla 'anuncios'
        DB::table('anuncios')->insert([
            'titulo' => $request->titulo,
            'ruta_imagen' => $path, // Guardamos la ruta del archivo
            'activo' => 1,
        ]);

        return redirect()->route('anuncios.index')->with('success', 'Anuncio publicado exitosamente.');
    }

    public function destroy($id)
    {
        $anuncio = DB::table('anuncios')->where('id_anuncio', $id)->first();

        if ($anuncio) {
            Storage::disk('public')->delete($anuncio->ruta_imagen);
            DB::table('anuncios')->where('id_anuncio', $id)->delete();
        }

        return redirect()->route('anuncios.index')->with('success', 'Anuncio eliminado.');
    }
}
