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
        $path = $request->file('imagen')->store('anuncios', 'public');
        DB::table('anuncios')->insert([
            'titulo' => $request->titulo,
            'imagen_url' => $path, // CORREGIDO: Se llama imagen_url
            'activo' => 1,
        ]);
        return back()->with('success', 'Anuncio publicado.');
    }
}
