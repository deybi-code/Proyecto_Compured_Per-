<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        $items = Carrito::where('id_usuario', Auth::id())->get();
        return view('carrito', compact('items'));
    }

    public function store(Request $request)
    {
        // Validación basada en tu diagrama: id_producto y cantidad
        $request->validate([
            'id_producto' => 'required',
            'cantidad' => 'required|numeric'
        ]);

        Carrito::create([
            'id_usuario' => Auth::id(),
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'fecha_agregado' => now(),
        ]);

        return back()->with('success', 'Producto añadido al carrito');
    }
}
