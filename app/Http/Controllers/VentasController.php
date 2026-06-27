<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class VentasController extends Controller
{
    public function index() {
        $productos = Producto::all();
        return view('admin.productos.ventas', compact('productos'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_producto'    => 'required|integer|exists:productos,id_producto',
            'cantidad'       => 'required|integer|min:1',
            'nombre_cliente' => 'required|string|max:255',
            'dni_cliente'    => 'required|string|max:20',
            'metodo_pago'    => 'required|string',
        ]);

        return DB::transaction(function () use ($request) {
            $producto = Producto::findOrFail($request->id_producto);

            // CORREGIDO: validar que hay suficiente stock antes de vender
            if ($producto->stock < $request->cantidad) {
                return back()->with('error', 'Stock insuficiente. Solo quedan ' . $producto->stock . ' unidades.');
            }

            $producto->stock -= $request->cantidad;
            $producto->save();

            $total = $producto->precio * $request->cantidad;

            $idBoleta = DB::table('boletas')->insertGetId([
                'id_usuario'       => Auth::id(),
                'fecha_venta'      => now(),
                'total_pago'       => $total,
                'metodo_pago'      => $request->metodo_pago,
                'canal_venta'      => 'Tienda Física',
                'estado_pedido'    => 'Pagado',
                'tipo_comprobante' => 'Boleta',
            ]);

            // AÑADIDO: registrar el detalle de la boleta
            DB::table('detalle_boleta')->insert([
                'id_boleta'      => $idBoleta,
                'id_producto'    => $producto->id_producto,
                'cantidad'       => $request->cantidad,
                'precio_unitario'=> $producto->precio,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            return redirect()->route('boletas.show', $idBoleta)->with('success', 'Venta realizada exitosamente.');
        });
    }
}
