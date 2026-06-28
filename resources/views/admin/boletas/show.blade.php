@extends('layouts.admin')
@section('title', 'Boleta #{{ $boleta->id_boleta ?? "" }} – Admin')
@section('content')
<div style="max-width:700px">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px">
        <a href="{{ route('ventas.index') }}" style="color:#97A0AF;text-decoration:none;font-size:0.82rem" class="hover:text-blue-500">← Volver</a>
        <h1 style="font-family:'Rajdhani',sans-serif;font-size:1.5rem;font-weight:800;color:#172B4D" class="dark:text-white">Boleta #{{ $boleta->id_boleta ?? '' }}</h1>
        @if(isset($boleta))<span class="status-badge {{ $boleta->estado_pedido === 'Pagado' ? 'status-green' : 'status-yellow' }}" style="font-size:0.85rem;padding:6px 14px">{{ $boleta->estado_pedido }}</span>@endif
    </div>

    <div class="cp-card" style="padding:28px;margin-bottom:16px">
        <h2 style="font-weight:700;font-size:0.92rem;color:#172B4D;margin-bottom:14px;text-transform:uppercase;letter-spacing:0.5px;color:#97A0AF">Información del pedido</h2>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;font-size:0.88rem">
            <div><span style="color:#97A0AF">Cliente:</span><br><strong class="dark:text-white">{{ $boleta->usuario->nombre_completo ?? '—' }}</strong></div>
            <div><span style="color:#97A0AF">Correo:</span><br><strong class="dark:text-white">{{ $boleta->usuario->correo ?? '—' }}</strong></div>
            <div><span style="color:#97A0AF">Fecha:</span><br><strong class="dark:text-white">{{ isset($boleta) ? \Carbon\Carbon::parse($boleta->fecha_venta)->format('d/m/Y H:i') : '—' }}</strong></div>
            <div><span style="color:#97A0AF">Método de pago:</span><br><strong class="dark:text-white">{{ $boleta->metodo_pago ?? '—' }}</strong></div>
            <div><span style="color:#97A0AF">Canal de venta:</span><br><strong class="dark:text-white">{{ $boleta->canal_venta ?? '—' }}</strong></div>
            <div><span style="color:#97A0AF">RUC empresa:</span><br><strong class="dark:text-white">{{ $boleta->ruc_empresa ?? '—' }}</strong></div>
        </div>
    </div>

    <div class="cp-card overflow-hidden" style="margin-bottom:16px">
        <div style="padding:14px 20px;border-bottom:1px solid #DFE1E6;font-weight:700;font-size:0.88rem;color:#172B4D" class="dark:text-white dark:border-gray-700">Productos</div>
        <table class="cp-table">
            <thead><tr><th>Producto</th><th>Cantidad</th><th>Precio unit.</th><th>Subtotal</th></tr></thead>
            <tbody>
            @forelse($boleta->detalles ?? [] as $d)
            <tr>
                <td style="font-weight:600;font-size:0.87rem">{{ $d->producto->nombre ?? 'Producto' }}</td>
                <td style="text-align:center">{{ $d->cantidad }}</td>
                <td>S/ {{ number_format($d->precio_unitario,2) }}</td>
                <td style="font-weight:700;color:#0052CC;font-family:'Rajdhani',sans-serif" class="dark:text-blue-400">S/ {{ number_format($d->precio_unitario * $d->cantidad,2) }}</td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;color:#97A0AF;padding:20px">Sin detalles</td></tr>
            @endforelse
            </tbody>
        </table>
        <div style="padding:16px 20px;text-align:right;border-top:2px solid #0052CC">
            <span style="font-family:'Rajdhani',sans-serif;font-size:1.4rem;font-weight:800;color:#0052CC" class="dark:text-blue-400">TOTAL: S/ {{ isset($boleta) ? number_format($boleta->total_pago,2) : '0.00' }}</span>
        </div>
    </div>
</div>
@endsection
