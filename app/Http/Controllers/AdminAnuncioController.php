<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAnuncioController extends Controller
{
    public function index() {
        $anuncios = DB::table('anuncios')->get();
        return view('admin.anuncios.index', compact('anuncios'));
    }

    public function store(Request $request) {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // CORREGIDO: verificar que se subió el archivo antes de acceder a él
        $path = $request->file('imagen')->store('anuncios', 'public');

        DB::table('anuncios')->insert([
            'titulo'     => $request->titulo,
            'imagen_url' => $path, // columna correcta en la BD
            'activo'     => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Anuncio publicado correctamente.');
    }

    public function destroy($id) {
        // AÑADIDO: método destroy que estaba en rutas pero faltaba la implementación completa
        $anuncio = DB::table('anuncios')->where('id_anuncio', $id)->first();

        if ($anuncio) {
            // Eliminar el archivo de imagen del storage
            \Illuminate\Support\Facades\Storage::disk('public')->delete($anuncio->imagen_url);
            DB::table('anuncios')->where('id_anuncio', $id)->delete();
        }

        return back()->with('success', 'Anuncio eliminado correctamente.');
    }
}
