<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    public function index() {
        $carrito = Session::get('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    public function store(Request $request) {
        $producto = Producto::findOrFail($request->id_producto);
        $carrito = Session::get('carrito', []);

        $carrito[$producto->id_producto] = [
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'cantidad' => $request->cantidad
        ];

        Session::put('carrito', $carrito);
        return back()->with('success', 'Producto añadido al carrito');
    }
}
