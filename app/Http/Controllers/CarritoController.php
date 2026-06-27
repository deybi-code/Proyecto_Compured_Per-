<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        // En el futuro aquí se recuperarán los items de la base de datos
        // $items = Carrito::where('id_usuario', Auth::id())->get();
        return view('carrito');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1'
        ]);

        if (Auth::check()) {
            // Lógica real de base de datos según tu diagrama
            /*
            Carrito::create([
                'id_usuario' => Auth::id(),
                'id_producto' => $request->id_producto,
                'cantidad' => $request->cantidad,
                'fecha_agregado' => now(),
            ]);
            */
        }

        return redirect()->route('carrito.index')->with('success', 'Producto añadido exitosamente al carrito');
    }
}
