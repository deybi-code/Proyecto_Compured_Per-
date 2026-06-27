<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminAnuncioController extends Controller
{
    public function index()
    {
        $anuncios = DB::table('anuncios')->get();
        return view('admin.anuncios.index', compact('anuncios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:100',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $path = $request->file('imagen')->store('anuncios', 'public');

        DB::table('anuncios')->insert([
            'titulo'     => $request->titulo,
            'imagen_url' => $path,
            'posicion'   => $request->posicion ?? 'principal',
            'activo'     => 1,
        ]);

        return back()->with('success', 'Anuncio publicado correctamente.');
    }

    public function destroy($id)
    {
        $anuncio = DB::table('anuncios')->where('id_anuncio', $id)->first();

        if ($anuncio) {
            // Eliminar imagen del storage
            Storage::disk('public')->delete($anuncio->imagen_url);
            DB::table('anuncios')->where('id_anuncio', $id)->delete();
        }

        return back()->with('success', 'Anuncio eliminado correctamente.');
    }
}
