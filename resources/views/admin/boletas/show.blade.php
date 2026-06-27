<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta {{ $boleta->id }}</title>
    <style>
        body { font-family: monospace; padding: 20px; }
        .ticket { width: 300px; margin: 0 auto; border: 1px solid #000; padding: 15px; }
        .header { text-align: center; margin-bottom: 20px; }
        .info { margin-bottom: 15px; font-size: 12px; }
        .total { font-weight: bold; font-size: 16px; border-top: 1px solid #000; margin-top: 10px; pt: 5px; }
        @media print {
            .no-print { display: none; }
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
            <p><strong>FECHA:</strong> {{ $boleta->fecha_venta }}</p>
            <p><strong>TIPO:</strong> {{ $boleta->tipo_comprobante }}</p>
            <p><strong>MÉTODO:</strong> {{ strtoupper($boleta->metodo_pago) }}</p>
        </div>

        <div class="total">
            <p>TOTAL: S/ {{ number_format($boleta->total_pago, 2) }}</p>
        </div>

        <p style="text-align:center; font-size: 10px; margin-top: 20px;">
            Gracias por su compra.
        </p>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer;">IMPRIMIR BOLETA</button>
    </div>

</body>
</html>
