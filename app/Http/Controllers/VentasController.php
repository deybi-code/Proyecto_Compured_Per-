<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class VentasController extends Controller
{
    /**
     * Muestra la interfaz de ventas.
     */
    public function index()
    {
        // Verificamos permisos
        if (Auth::user()->rol !== 'admin' && Auth::user()->rol !== 'ventas') {
            return redirect('/dashboard')->with('error', 'No tienes permisos de ventas');
        }

        // Obtenemos productos para el selector
        $productos = Producto::all();
        return view('admin.ventas', compact('productos'));
    }

    /**
     * Procesa la venta y actualiza stock.
     */
    public function store(Request $request)
    {
        // 1. Validación de datos
        $request->validate([
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'nombre_cliente' => 'required|string|max:255',
            'dni_cliente' => 'required|string|max:20',
            'metodo_pago' => 'required|in:efectivo,tarjeta',
        ]);

        // 2. Ejecución segura de transacción
        return DB::transaction(function () use ($request) {
            $producto = Producto::find($request->id_producto);

            // Verificamos stock real
            if ($producto->stock < $request->cantidad) {
                return back()->with('error', 'Stock insuficiente para ' . $producto->nombre);
            }

            // 3. Descontar Stock
            $producto->stock -= $request->cantidad;
            $producto->save();

            // 4. Registrar Venta en 'boletas'
            // Nota: Usamos DB::table para interactuar con la tabla existente sin forzar modelos si no los tienes creados
            DB::table('boletas')->insert([
                'id_usuario' => Auth::id(), // ID del vendedor logueado
                'fecha_venta' => now(),
                'total_pago' => $producto->precio * $request->cantidad,
                'metodo_pago' => $request->metodo_pago,
                'canal_venta' => 'Tienda Física',
                'estado_pedido' => 'Pagado',
                'tipo_comprobante' => 'Boleta',
            ]);

            return redirect()->route('ventas.index')->with('success', 'Venta registrada. Stock actualizado.');
        });
    }
}
