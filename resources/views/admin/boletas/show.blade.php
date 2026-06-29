@extends('layouts.admin')

@section('title', 'Boleta #{{ $boleta->id_boleta }}')

@section('content')

<div class="card">
    <h2>Boleta de Venta #{{ $boleta->id_boleta }}</h2>

    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($boleta->fecha_venta)->format('d/m/Y H:i') }}</p>
    <p><strong>Método de Pago:</strong> {{ ucfirst($boleta->metodo_pago) }}</p>
    <p><strong>Canal:</strong> {{ $boleta->canal_venta }}</p>
    <p><strong>Estado:</strong> {{ $boleta->estado_pedido }}</p>
    <p><strong>Tipo Comprobante:</strong> {{ $boleta->tipo_comprobante }}</p>

    <h3 style="margin-top:20px;">Detalle de Productos</h3>
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f1f5f9;">
                <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Producto</th>
                <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Marca</th>
                <th style="padding:10px;text-align:right;border-bottom:1px solid #e2e8f0;">Cantidad</th>
                <th style="padding:10px;text-align:right;border-bottom:1px solid #e2e8f0;">Precio Unit.</th>
                <th style="padding:10px;text-align:right;border-bottom:1px solid #e2e8f0;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalles as $det)
            <tr style="border-bottom:1px solid #e2e8f0;">
                <td style="padding:10px;">{{ $det->nombre }}</td>
                <td style="padding:10px;">{{ $det->marca }}</td>
                <td style="padding:10px;text-align:right;">{{ $det->cantidad }}</td>
                <td style="padding:10px;text-align:right;">S/ {{ number_format($det->precio_unitario, 2) }}</td>
                <td style="padding:10px;text-align:right;">S/ {{ number_format($det->cantidad * $det->precio_unitario, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="padding:10px;text-align:right;font-weight:bold;">Total:</td>
                <td style="padding:10px;text-align:right;font-weight:bold;">
                    S/ {{ number_format($boleta->total_pago, 2) }}
                </td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top:20px;">
        <a href="{{ route('admin.ventas.index') }}"
           style="padding:8px 16px;background:#2563eb;color:white;border-radius:6px;text-decoration:none;">
            ← Nueva Venta
        </a>
    </div>
</div>

@endsection
