<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResenaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id_producto',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|min:10|max:500',
        ]);

        $resena = Resena::create([
            'user_id' => Auth::id(),
            'producto_id' => $request->producto_id,
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
            'aprobado' => true,
        ]);

        return back()->with('success', '¡Reseña publicada correctamente!');
    }
}
