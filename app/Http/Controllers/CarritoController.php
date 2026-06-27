<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    public function index() {
        $carrito = Session::get('carrito', []);
        // CORREGIDO: la vista es 'carrito' (no 'carrito.index', que no existe)
        return view('carrito', compact('carrito'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_producto' => 'required|integer',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->id_producto);
        $carrito  = Session::get('carrito', []);

        $id = $producto->id_producto;

        // CORREGIDO: Si ya existe en el carrito, sumamos la cantidad en lugar de sobrescribir
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] += (int) $request->cantidad;
        } else {
            $carrito[$id] = [
                'nombre'   => $producto->nombre,
                'precio'   => $producto->precio,
                'cantidad' => (int) $request->cantidad,
            ];
        }

        Session::put('carrito', $carrito);
        return back()->with('success', 'Producto añadido al carrito');
    }

    // AÑADIDO: método para eliminar un ítem del carrito
    public function destroy($id) {
        $carrito = Session::get('carrito', []);
        unset($carrito[$id]);
        Session::put('carrito', $carrito);
        return back()->with('success', 'Producto eliminado del carrito');
    }
}
