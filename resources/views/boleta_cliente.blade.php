@extends('layouts.main')
@section('title', 'Boleta N° ' . $boleta->id_boleta . ' – Compured Perú')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-8" style="max-width:700px;margin:0 auto;padding:32px 16px;">

    <nav class="breadcrumb mb-6"><a href="/">Inicio</a><span>›</span><a href="{{ route('dashboard') }}">Mis pedidos</a><span>›</span><span>Boleta #{{ $boleta->id_boleta }}</span></nav>

    @if(session('success'))
    <div class="cp-flash-msg cp-flash-success" style="margin-bottom:18px;">✅ {{ session('success') }}</div>
    @endif

    <div class="cp-card" id="boleta-imprimible" style="padding:32px;">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;border-bottom:2px solid var(--border);padding-bottom:18px;margin-bottom:20px;">
            <div>
                <h1 style="font-family:'Rajdhani',sans-serif;font-size:1.5rem;font-weight:800;color:var(--text);margin:0;">
                    {{ $boleta->tipo_comprobante ?? 'Boleta' }} electrónica
                </h1>
                <p style="color:var(--muted);font-size:0.85rem;margin:4px 0 0;">N° {{ str_pad($boleta->id_boleta, 8, '0', STR_PAD_LEFT) }}</p>
            </div>
            <span style="background:{{ $boleta->estado_pedido === 'Pagado' ? 'rgba(16,185,129,0.12)' : 'rgba(245,158,11,0.12)' }};color:{{ $boleta->estado_pedido === 'Pagado' ? '#059669' : '#b45309' }};font-weight:700;font-size:0.8rem;padding:6px 14px;border-radius:999px;">
                {{ $boleta->estado_pedido }}
            </span>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px;font-size:0.85rem;">
            <div>
                <div style="color:var(--muted);font-weight:700;font-size:0.72rem;text-transform:uppercase;margin-bottom:4px;">Fecha de venta</div>
                <div style="color:var(--text);font-weight:600;">{{ \Carbon\Carbon::parse($boleta->fecha_venta)->format('d/m/Y H:i') }}</div>
            </div>
            <div>
                <div style="color:var(--muted);font-weight:700;font-size:0.72rem;text-transform:uppercase;margin-bottom:4px;">Método de pago</div>
                <div style="color:var(--text);font-weight:600;">{{ ucfirst($boleta->metodo_pago) }}</div>
            </div>
            <div>
                <div style="color:var(--muted);font-weight:700;font-size:0.72rem;text-transform:uppercase;margin-bottom:4px;">Canal de venta</div>
                <div style="color:var(--text);font-weight:600;">{{ $boleta->canal_venta ?? '—' }}</div>
            </div>
            @if($boleta->ruc_empresa)
            <div>
                <div style="color:var(--muted);font-weight:700;font-size:0.72rem;text-transform:uppercase;margin-bottom:4px;">RUC</div>
                <div style="color:var(--text);font-weight:600;">{{ $boleta->ruc_empresa }}</div>
            </div>
            @endif
            @if($pago)
            <div>
                <div style="color:var(--muted);font-weight:700;font-size:0.72rem;text-transform:uppercase;margin-bottom:4px;">N° de transacción</div>
                <div style="color:var(--text);font-weight:600;">{{ $pago->transaccion_id }}</div>
            </div>
            <div>
                <div style="color:var(--muted);font-weight:700;font-size:0.72rem;text-transform:uppercase;margin-bottom:4px;">Estado del pago</div>
                <div style="color:var(--text);font-weight:600;text-transform:capitalize;">{{ $pago->estado_pago }}</div>
            </div>
            @endif
        </div>

        <div class="table-container">
            <table class="cp-table" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="border-bottom:1px solid var(--border);">
                        <th style="text-align:left;padding:8px;font-size:0.75rem;color:var(--muted);">Producto</th>
                        <th style="text-align:left;padding:8px;font-size:0.75rem;color:var(--muted);">Marca</th>
                        <th style="text-align:right;padding:8px;font-size:0.75rem;color:var(--muted);">Cant.</th>
                        <th style="text-align:right;padding:8px;font-size:0.75rem;color:var(--muted);">P. Unit.</th>
                        <th style="text-align:right;padding:8px;font-size:0.75rem;color:var(--muted);">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalles as $det)
                    <tr style="border-bottom:1px solid var(--border);">
                        <td style="padding:8px;color:var(--text);font-size:0.85rem;">{{ $det->nombre }}</td>
                        <td style="padding:8px;color:var(--muted);font-size:0.85rem;">{{ $det->marca }}</td>
                        <td style="padding:8px;text-align:right;color:var(--text);font-size:0.85rem;">{{ $det->cantidad }}</td>
                        <td style="padding:8px;text-align:right;color:var(--text);font-size:0.85rem;">S/ {{ number_format($det->precio_unitario, 2) }}</td>
                        <td style="padding:8px;text-align:right;color:var(--text);font-weight:700;font-size:0.85rem;">S/ {{ number_format($det->cantidad * $det->precio_unitario, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="display:flex;justify-content:flex-end;margin-top:18px;padding-top:18px;border-top:2px solid var(--border);">
            <div style="text-align:right;">
                <div style="color:var(--muted);font-size:0.8rem;font-weight:700;text-transform:uppercase;">Total pagado</div>
                <div style="font-family:'Rajdhani',sans-serif;font-size:1.8rem;font-weight:800;color:var(--primary);">S/ {{ number_format($boleta->total_pago, 2) }}</div>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:12px;margin-top:20px;">
        <button onclick="window.print()" class="btn-primary" style="flex:1;justify-content:center;">
            🖨️ Imprimir / Descargar PDF
        </button>
        <a href="{{ route('dashboard') }}" style="flex:1;text-align:center;padding:11px;border:1px solid var(--border);border-radius:10px;color:var(--text);font-weight:700;font-size:0.88rem;">
            Volver a mis pedidos
        </a>
    </div>
</div>

<style>
    @media print {
        .cp-navbar, .cp-footer, nav.breadcrumb, .cp-flash-msg { display: none !important; }
        #boleta-imprimible { border: none !important; box-shadow: none !important; }
    }
</style>
@endsection
