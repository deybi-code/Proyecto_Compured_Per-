<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();

        return view('admin.ventas.index', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|integer|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'nombre_cliente' => 'required|string|max:255',
            'metodo_pago' => 'required|string|in:efectivo,tarjeta,yape,plin',
        ]);

        $producto = Producto::findOrFail($request->id_producto);

        // Validar stock ANTES de la transacción
        if ($producto->stock < $request->cantidad) {
            return back()
                ->withInput()
                ->with('error', 'Stock insuficiente. Solo quedan '.$producto->stock.' unidades.');
        }

        try {
            $idBoleta = DB::transaction(function () use ($request, $producto) {
                $total = $producto->precio * $request->cantidad;

                $producto->stock -= $request->cantidad;
                $producto->save();

                $idBoleta = DB::table('boletas')->insertGetId([
                    'id_usuario' => Auth::user()->id_usuario,
                    'fecha_venta' => now(),
                    'total_pago' => $total,
                    'metodo_pago' => $request->metodo_pago,
                    'canal_venta' => 'Tienda Física',
                    'estado_pedido' => 'Pagado',
                    'tipo_comprobante' => 'Boleta',
                    'nombre_cliente' => $request->nombre_cliente,
                ]);

                DB::table('detalle_boleta')->insert([
                    'id_boleta' => $idBoleta,
                    'id_producto' => $producto->id_producto,
                    'cantidad' => $request->cantidad,
                    'precio_unitario' => $producto->precio,
                ]);

                return $idBoleta;
            });

            return redirect()->route('admin.boletas.show', $idBoleta)
                ->with('success', 'Venta realizada exitosamente.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al registrar la venta: '.$e->getMessage());
        }
    }
}
