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
        // Ruta corregida: ahora apunta a admin.productos.ventas
        return view('admin.productos.ventas', compact('productos'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_producto' => 'required',
            'cantidad' => 'required|integer',
            'nombre_cliente' => 'required',
            'dni_cliente' => 'required',
            'metodo_pago' => 'required',
        ]);

        return DB::transaction(function () use ($request) {
            $producto = Producto::find($request->id_producto);
            $producto->stock -= $request->cantidad;
            $producto->save();

            $idBoleta = DB::table('boletas')->insertGetId([
                'id_usuario' => Auth::id(),
                'fecha_venta' => now(),
                'total_pago' => $producto->precio * $request->cantidad,
                'metodo_pago' => $request->metodo_pago,
                'canal_venta' => 'Tienda Física',
                'estado_pedido' => 'Pagado',
                'tipo_comprobante' => 'Boleta',
            ]);

            return redirect()->route('boletas.show', $idBoleta)->with('success', 'Venta realizada');
        });
    }
}
