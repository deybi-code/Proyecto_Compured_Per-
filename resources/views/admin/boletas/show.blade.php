<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    {{-- CORREGIDO: se usaba $boleta->id, la clave correcta es id_boleta --}}
    <title>Boleta N° {{ $boleta->id_boleta }} - Compured Perú</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #fff; }
        .ticket { width: 320px; margin: 0 auto; border: 1px solid #000; padding: 15px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { font-size: 18px; margin: 0 0 4px; }
        .info { margin-bottom: 15px; font-size: 12px; line-height: 1.6; }
        .items { font-size: 12px; border-top: 1px dashed #000; border-bottom: 1px dashed #000; padding: 8px 0; margin-bottom: 10px; }
        .items tr td:last-child { text-align: right; }
        .total { font-weight: bold; font-size: 16px; border-top: 1px solid #000; padding-top: 8px; display: flex; justify-content: space-between; }
        .footer { text-align: center; font-size: 10px; margin-top: 20px; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body>

    <div class="ticket">
        <div class="header">
            <h2>COMPURED PERÚ</h2>
            <p>RUC: 20600000000</p>
            <p>El Porvenir, La Libertad</p>
        </div>

        <div class="info">
            {{-- CORREGIDO: se usaba $boleta->id (incorrecto), ahora usa id_boleta --}}
            <p><strong>BOLETA N°:</strong> {{ str_pad($boleta->id_boleta, 8, '0', STR_PAD_LEFT) }}</p>
            <p><strong>FECHA:</strong> {{ \Carbon\Carbon::parse($boleta->fecha_venta)->format('d/m/Y H:i') }}</p>
            <p><strong>TIPO:</strong> {{ strtoupper($boleta->tipo_comprobante ?? 'Boleta') }}</p>
            <p><strong>MÉTODO:</strong> {{ strtoupper($boleta->metodo_pago) }}</p>
            <p><strong>CANAL:</strong> {{ $boleta->canal_venta ?? 'Tienda' }}</p>
        </div>

        {{-- AÑADIDO: detalle de productos en la boleta --}}
        @if(isset($detalles) && count($detalles) > 0)
        <table class="items" style="width:100%;">
            <thead>
                <tr>
                    <td><strong>Producto</strong></td>
                    <td style="text-align:center"><strong>Cant</strong></td>
                    <td style="text-align:right"><strong>Subtotal</strong></td>
                </tr>
            </thead>
            <tbody>
                @foreach($detalles as $detalle)
                <tr>
                    <td>{{ Str::limit($detalle->nombre, 20) }}</td>
                    <td style="text-align:center">{{ $detalle->cantidad }}</td>
                    <td>S/ {{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <div class="total">
            <span>TOTAL:</span>
            <span>S/ {{ number_format($boleta->total_pago, 2) }}</span>
        </div>

        <div class="footer">
            <p>Estado: {{ $boleta->estado_pedido }}</p>
            <br>
            <p>Gracias por su compra en Compured Perú.</p>
        </div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px; display: flex; gap: 12px; justify-content: center;">
        <button onclick="window.print()"
            style="padding: 10px 24px; cursor: pointer; background: #2563eb; color: white; border: none; border-radius: 6px; font-weight: bold;">
            🖨️ IMPRIMIR BOLETA
        </button>
        <a href="{{ route('ventas.index') }}"
            style="padding: 10px 24px; cursor: pointer; background: #6b7280; color: white; border: none; border-radius: 6px; font-weight: bold; text-decoration: none;">
            ← Nueva Venta
        </a>
    </div>

</body>
</html>
