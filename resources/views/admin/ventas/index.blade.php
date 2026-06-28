@extends('layouts.admin')
@section('title', 'Ventas – Admin Compured Perú')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px">
    <div>
        <h1 style="font-family:'Rajdhani',sans-serif;font-size:1.6rem;font-weight:800;color:#172B4D" class="dark:text-white">Ventas / Boletas</h1>
        <p style="font-size:0.82rem;color:#97A0AF;margin-top:2px">Historial de todas las transacciones</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:14px;margin-bottom:24px">
    <div class="cp-card" style="padding:16px;border-left:4px solid #0052CC">
        <div style="font-size:0.72rem;color:#97A0AF;text-transform:uppercase">Total boletas</div>
        <div style="font-family:'Rajdhani',sans-serif;font-size:1.8rem;font-weight:800;color:#0052CC">{{ isset($boletas) ? $boletas->count() : 0 }}</div>
    </div>
    <div class="cp-card" style="padding:16px;border-left:4px solid #22C55E">
        <div style="font-size:0.72rem;color:#97A0AF;text-transform:uppercase">Ingresos totales</div>
        <div style="font-family:'Rajdhani',sans-serif;font-size:1.4rem;font-weight:800;color:#22C55E">S/ {{ isset($boletas) ? number_format($boletas->sum('total_pago'),2) : '0.00' }}</div>
    </div>
    <div class="cp-card" style="padding:16px;border-left:4px solid #F59E0B">
        <div style="font-size:0.72rem;color:#97A0AF;text-transform:uppercase">Pendientes</div>
        <div style="font-family:'Rajdhani',sans-serif;font-size:1.8rem;font-weight:800;color:#F59E0B">{{ isset($boletas) ? $boletas->where('estado_pedido','Pendiente')->count() : 0 }}</div>
    </div>
</div>

<div class="cp-card overflow-hidden">
    <table class="cp-table">
        <thead><tr><th>#Boleta</th><th>Cliente</th><th>Fecha</th><th>Total</th><th>Método pago</th><th>Estado</th><th>Acciones</th></tr></thead>
        <tbody>
        @forelse($boletas ?? [] as $b)
        <tr>
            <td style="font-weight:700;color:#0052CC" class="dark:text-blue-400">#{{ $b->id_boleta }}</td>
            <td style="font-size:0.87rem">{{ $b->usuario->nombre_completo ?? $b->id_usuario }}</td>
            <td style="font-size:0.82rem;color:#97A0AF">{{ \Carbon\Carbon::parse($b->fecha_venta)->format('d/m/Y H:i') }}</td>
            <td style="font-family:'Rajdhani',sans-serif;font-size:1.1rem;font-weight:700;color:#0052CC" class="dark:text-blue-400">S/ {{ number_format($b->total_pago,2) }}</td>
            <td style="font-size:0.82rem;color:#5E6C84" class="dark:text-gray-400">{{ $b->metodo_pago ?? '—' }}</td>
            <td><span class="status-badge {{ $b->estado_pedido === 'Pagado' ? 'status-green' : ($b->estado_pedido === 'Enviado' ? 'status-blue' : 'status-yellow') }}">{{ $b->estado_pedido }}</span></td>
            <td>
                <a href="{{ route('boletas.show',$b->id_boleta) }}" style="font-size:0.78rem;color:#0052CC;font-weight:600;text-decoration:none" class="hover:underline">Ver detalle</a>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:40px;color:#97A0AF">No hay ventas registradas aún.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
