<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = Session::get('carrito', []);
        return view('carrito', compact('carrito'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|integer|exists:productos,id_producto',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->id_producto);

        // Verificar stock disponible
        if ($producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $carrito = Session::get('carrito', []);
        $id      = $producto->id_producto;

        // Si ya existe en el carrito, sumar cantidad
        if (isset($carrito[$id])) {
            $nuevaCantidad = $carrito[$id]['cantidad'] + (int) $request->cantidad;
            // No superar el stock
            $carrito[$id]['cantidad'] = min($nuevaCantidad, $producto->stock);
        } else {
            $carrito[$id] = [
                'nombre'   => $producto->nombre,
                'precio'   => $producto->precio,
                'cantidad' => (int) $request->cantidad,
            ];
        }

        Session::put('carrito', $carrito);
        return back()->with('success', 'Producto añadido al carrito.');
    }

    public function destroy($id)
    {
        $carrito = Session::get('carrito', []);
        unset($carrito[$id]);
        Session::put('carrito', $carrito);
        return back()->with('success', 'Producto eliminado del carrito.');
    }
}
