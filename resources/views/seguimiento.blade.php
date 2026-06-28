@extends('layouts.main')
@section('title', 'Seguimiento de Pedido – Compured Perú')
@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    <div style="text-align:center;margin-bottom:32px">
        <div style="font-size:3rem;margin-bottom:12px">🔍</div>
        <h1 style="font-family:'Rajdhani',sans-serif;font-size:2rem;font-weight:800;color:#172B4D" class="dark:text-white">Seguimiento de pedido</h1>
        <p style="color:#97A0AF;margin-top:8px">Ingresa el número de tu boleta para ver el estado</p>
    </div>
    <div class="cp-card" style="padding:32px">
        <form method="GET" action="{{ route('seguimiento') }}">
            <label class="cp-label">Número de boleta</label>
            <div style="display:flex;gap:10px;margin-bottom:20px">
                <input type="text" name="boleta" class="cp-input" placeholder="Ej: 1023" value="{{ request('boleta') }}" style="flex:1">
                <button type="submit" class="btn-primary">Buscar</button>
            </div>
        </form>

        @if(isset($boleta))
        <div style="border-top:1px solid #DFE1E6;padding-top:20px" class="dark:border-gray-700">
            <div style="display:flex;justify-content:space-between;margin-bottom:16px">
                <div>
                    <div style="font-size:0.75rem;color:#97A0AF">Boleta #</div>
                    <div style="font-weight:700;font-size:1.1rem;color:#172B4D" class="dark:text-white">{{ $boleta->id_boleta }}</div>
                </div>
                <span class="status-badge {{ $boleta->estado_pedido === 'Pagado' ? 'status-green' : ($boleta->estado_pedido === 'Enviado' ? 'status-blue' : 'status-yellow') }}" style="font-size:0.85rem;padding:6px 14px">{{ $boleta->estado_pedido }}</span>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;font-size:0.87rem">
                <div><span style="color:#97A0AF">Fecha:</span><br><strong class="dark:text-white">{{ \Carbon\Carbon::parse($boleta->fecha_venta)->format('d/m/Y') }}</strong></div>
                <div><span style="color:#97A0AF">Total:</span><br><strong style="color:#0052CC;font-family:'Rajdhani',sans-serif;font-size:1.1rem">S/ {{ number_format($boleta->total_pago,2) }}</strong></div>
                <div><span style="color:#97A0AF">Método:</span><br><strong class="dark:text-white">{{ $boleta->metodo_pago ?? '—' }}</strong></div>
            </div>

            @if(isset($guia) && $guia)
            <div style="margin-top:16px;padding:14px;background:#EBF3FF;border-radius:8px;font-size:0.87rem" class="dark:bg-blue-900/20">
                <div style="font-weight:700;color:#0052CC;margin-bottom:6px">📦 Información de envío</div>
                <div>Empresa: {{ $guia->empresa_courier }}</div>
                <div>Tracking: <strong>{{ $guia->tracking_number }}</strong></div>
                <div>Estado: <span class="status-badge status-blue">{{ $guia->estado_envio }}</span></div>
            </div>
            @endif
        </div>
        @elseif(request('boleta'))
        <div style="text-align:center;color:#EF4444;font-size:0.9rem">No encontramos el pedido #{{ request('boleta') }}. Verifica el número.</div>
        @endif
    </div>
</div>
@endsection
