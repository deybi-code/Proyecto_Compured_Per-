<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
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
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->id_producto);

        // Verificar stock disponible
        if ($producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $carrito = Session::get('carrito', []);
        $id = $producto->id_producto;

        // Determinar el precio a usar (con descuento si existe)
        $precioFinal = $producto->precio_descuento ?? $producto->precio;

        // Si ya existe en el carrito, sumar cantidad
        if (isset($carrito[$id])) {
            $nuevaCantidad = $carrito[$id]['cantidad'] + (int) $request->cantidad;
            // No superar el stock
            $carrito[$id]['cantidad'] = min($nuevaCantidad, $producto->stock);
        } else {
            $carrito[$id] = [
                'nombre' => $producto->nombre,
                'precio' => $precioFinal,
                'precio_original' => $producto->precio,
                'tiene_descuento' => ! is_null($producto->precio_descuento),
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
