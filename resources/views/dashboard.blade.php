@extends('layouts.main')
@section('title', 'Mi Panel – Compured Perú')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 flex flex-col md:flex-row gap-6">

    {{-- Sidebar --}}
    <aside style="width:220px;flex-shrink:0">
        <div class="cp-card overflow-hidden" style="border-top:3px solid #0052CC">
            <div style="padding:20px 16px;background:linear-gradient(135deg,#091E42,#0052CC);text-align:center">
                <div style="width:56px;height:56px;background:rgba(255,255,255,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-size:24px">👤</div>
                <div style="font-weight:700;color:white;font-size:0.9rem">{{ $user->nombre_completo ?? $user->name ?? 'Usuario' }}</div>
                <div style="font-size:0.72rem;color:rgba(255,255,255,0.6)">{{ ucfirst($user->rol ?? 'cliente') }}</div>
            </div>
            <nav>
                <a href="/dashboard" style="display:flex;align-items:center;gap:8px;padding:11px 16px;font-size:0.85rem;font-weight:600;color:#0052CC;background:#EBF3FF;border-left:3px solid #0052CC;text-decoration:none" class="dark:bg-blue-900/20 dark:text-blue-400">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:8px;padding:11px 16px;font-size:0.85rem;color:#5E6C84;text-decoration:none;border-left:3px solid transparent;transition:all 0.15s" class="dark:text-gray-400 hover:text-blue-600">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Editar perfil
                </a>
                <a href="/carrito" style="display:flex;align-items:center;gap:8px;padding:11px 16px;font-size:0.85rem;color:#5E6C84;text-decoration:none;border-left:3px solid transparent;transition:all 0.15s" class="dark:text-gray-400 hover:text-blue-600">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Mi carrito
                </a>
                <div style="border-top:1px solid #DFE1E6;margin:4px 0" class="dark:border-gray-700"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="display:flex;align-items:center;gap:8px;width:100%;padding:11px 16px;font-size:0.85rem;color:#DC2626;background:none;border:none;border-left:3px solid transparent;cursor:pointer;text-align:left;font-weight:600">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Cerrar sesión
                    </button>
                </form>
            </nav>
        </div>
    </aside>

    {{-- Main --}}
    <section style="flex:1;display:flex;flex-direction:column;gap:20px">
        @if(session('success'))<div class="alert-success">{{ session('success') }}</div>@endif

        {{-- Stats row --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:14px">
            <div class="cp-card" style="padding:20px;text-align:center;border-top:3px solid #0052CC">
                <div style="font-family:'Rajdhani',sans-serif;font-size:2.2rem;font-weight:800;color:#0052CC" class="dark:text-blue-400">{{ $pedidos->count() }}</div>
                <div style="font-size:0.8rem;font-weight:600;color:#5E6C84" class="dark:text-gray-400">Total pedidos</div>
            </div>
            <div class="cp-card" style="padding:20px;text-align:center;border-top:3px solid #F59E0B">
                <div style="font-family:'Rajdhani',sans-serif;font-size:2.2rem;font-weight:800;color:#F59E0B">{{ $pedidos->where('estado_pedido','Pendiente')->count() }}</div>
                <div style="font-size:0.8rem;font-weight:600;color:#5E6C84" class="dark:text-gray-400">Pendientes</div>
            </div>
            <div class="cp-card" style="padding:20px;text-align:center;border-top:3px solid #22C55E">
                <div style="font-family:'Rajdhani',sans-serif;font-size:2.2rem;font-weight:800;color:#22C55E">{{ $pedidos->where('estado_pedido','Pagado')->count() }}</div>
                <div style="font-size:0.8rem;font-weight:600;color:#5E6C84" class="dark:text-gray-400">Completados</div>
            </div>
            <div class="cp-card" style="padding:20px;text-align:center;border-top:3px solid #8CC63F">
                <div style="font-family:'Rajdhani',sans-serif;font-size:1.4rem;font-weight:800;color:#8CC63F">S/{{ number_format($pedidos->sum('total_pago'),0) }}</div>
                <div style="font-size:0.8rem;font-weight:600;color:#5E6C84" class="dark:text-gray-400">Total gastado</div>
            </div>
        </div>

        {{-- Account info --}}
        <div class="cp-card" style="padding:24px">
            <h3 style="font-weight:700;color:#172B4D;margin-bottom:16px;display:flex;align-items:center;gap:8px" class="dark:text-white">
                <svg width="18" height="18" fill="none" stroke="#0052CC" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Información de cuenta
            </h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;font-size:0.87rem">
                <div><span style="color:#97A0AF;display:block;margin-bottom:2px">Nombre</span><span style="font-weight:600;color:#172B4D" class="dark:text-white">{{ $user->nombre_completo ?? $user->name ?? '—' }}</span></div>
                <div><span style="color:#97A0AF;display:block;margin-bottom:2px">Correo</span><span style="font-weight:600;color:#172B4D" class="dark:text-white">{{ $user->correo ?? $user->email ?? '—' }}</span></div>
                <div><span style="color:#97A0AF;display:block;margin-bottom:2px">Rol</span><span class="status-badge status-blue">{{ ucfirst($user->rol ?? 'cliente') }}</span></div>
                <div><span style="color:#97A0AF;display:block;margin-bottom:2px">Miembro desde</span><span style="font-weight:600;color:#172B4D" class="dark:text-white">{{ $user->created_at ? $user->created_at->format('M Y') : '—' }}</span></div>
            </div>
        </div>

        {{-- Orders table --}}
        <div class="cp-card overflow-hidden">
            <div style="padding:16px 20px;border-bottom:1px solid #DFE1E6;font-weight:700;font-size:0.9rem;color:#172B4D;display:flex;align-items:center;gap:8px" class="dark:text-white dark:border-gray-700">
                <svg width="16" height="16" fill="none" stroke="#0052CC" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Mis pedidos recientes
            </div>
            <table class="cp-table">
                <thead><tr><th>#</th><th>Fecha</th><th>Total</th><th>Método</th><th>Estado</th></tr></thead>
                <tbody>
                @forelse($pedidos as $p)
                <tr>
                    <td style="font-weight:700;color:#0052CC" class="dark:text-blue-400">#{{ $p->id_boleta }}</td>
                    <td style="color:#5E6C84;font-size:0.83rem" class="dark:text-gray-400">{{ \Carbon\Carbon::parse($p->fecha_venta)->format('d/m/Y') }}</td>
                    <td style="font-weight:700;font-family:'Rajdhani',sans-serif;font-size:1rem">S/ {{ number_format($p->total_pago,2) }}</td>
                    <td style="font-size:0.82rem;color:#5E6C84" class="dark:text-gray-400">{{ $p->metodo_pago ?? '—' }}</td>
                    <td><span class="status-badge {{ $p->estado_pedido === 'Pagado' ? 'status-green' : ($p->estado_pedido === 'Enviado' ? 'status-blue' : 'status-yellow') }}">{{ $p->estado_pedido }}</span></td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;padding:32px;color:#97A0AF">No tienes pedidos aún. <a href="/" style="color:#0052CC;font-weight:600">¡Empieza a comprar!</a></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
