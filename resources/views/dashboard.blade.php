@extends('layouts.main')
@section('title', 'Mi Panel – Compured Perú')
@section('content')

<style>
    /* Fondo base unificado sutil */
    .dashboard-wrapper {
        position: relative; min-height: calc(100vh - 200px); padding-bottom: 60px;
    }
    .dash-bg-grid {
        position: fixed; inset: 0; z-index: 0; pointer-events: none;
        background-image: linear-gradient(rgba(0,82,204,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(0,82,204,0.04) 1px, transparent 1px);
        background-size: 50px 50px;
    }

    /* Tarjetas Glassmorphism */
    .glass-card {
        position: relative; z-index: 10;
        background: var(--card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(0,82,204,0.14); border-radius: 20px;
        box-shadow: var(--shadow); transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
        color: var(--text); overflow: hidden;
    }
    .glass-card:hover { transform: translateY(-3px); box-shadow: 0 30px 60px rgba(29,78,216,0.2); }

    /* Perfil Sidebar */
    .profile-header {
        background: linear-gradient(135deg, rgba(29,78,216,0.9), rgba(37,99,235,0.8));
        padding: 30px 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1);
        position: relative; overflow: hidden;
    }
    .profile-header::before {
        content: ''; position: absolute; inset: 0;
        background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PHBhdGggZD0iTTAgMGg0MHY0MEgweiIgZmlsbD0ibm9uZSIvPjxwYXRoIGQ9Ik0wIDEwaDQwTTEwIDB2NDBNMCAyMGg0ME0yMCAwdjQwTTAgMzBoNDBNMzAgMHY0MCIgc3Ryb2tlPSJyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMDUpIiBzdHJva2Utd2lkdGg9IjEiLz48L3N2Zz4=');
    }
    .avatar-circle {
        width: 70px; height: 70px; background: rgba(255,255,255,0.2); backdrop-filter: blur(5px);
        border: 2px solid rgba(255,255,255,0.4); border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 12px; font-size: 32px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        position: relative; z-index: 2;
    }

    /* Navegación Sidebar */
    .nav-link {
        display: flex; align-items: center; gap: 12px; padding: 14px 24px;
        font-size: 14px; font-weight: 600; color: var(--muted);
        text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s;
    }
    .nav-link:hover { background: rgba(59,130,246,0.05); color: var(--primary); padding-left: 28px; }
    .nav-link.active {
        background: linear-gradient(90deg, rgba(59,130,246,0.1) 0%, transparent 100%);
        color: var(--primary); border-left-color: var(--primary);
    }
    .nav-link.danger:hover { background: rgba(220,38,38,0.05); color: var(--danger); }

    /* Tarjetas de Estadísticas */
    .stat-card {
        padding: 24px; text-align: center; display: flex; flex-direction: column; justify-content: center;
    }
    .stat-value { font-family: 'Segoe UI', system-ui, sans-serif; font-size: 36px; font-weight: 800; line-height: 1.1; margin-bottom: 8px; }
    .stat-label { font-size: 12px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; }

    /* Estilos de Tabla Pro */
    .table-container { width: 100%; overflow-x: auto; }
    .cp-table { width: 100%; border-collapse: collapse; }
    .cp-table th {
        background: rgba(59,130,246,0.05); padding: 16px 20px; text-align: left;
        font-size: 12px; font-weight: 800; color: var(--muted); text-transform: uppercase; letter-spacing: 0.5px;
        border-bottom: 1px solid var(--border);
    }
    .cp-table td {
        padding: 16px 20px; font-size: 14px; color: var(--text); font-weight: 500;
        border-bottom: 1px solid var(--border); transition: background 0.2s;
    }
    .cp-table tbody tr:hover td { background: rgba(59,130,246,0.02); }
    .cp-table tbody tr:last-child td { border-bottom: none; }

    /* Badges de Estado */
    .status-badge {
        display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 20px;
        font-size: 12px; font-weight: 700; letter-spacing: 0.5px;
    }
    .status-green { background: rgba(16,185,129,0.1); color: var(--success); border: 1px solid rgba(16,185,129,0.2); }
    .status-yellow { background: rgba(245,158,11,0.1); color: var(--warning); border: 1px solid rgba(245,158,11,0.2); }
    .status-blue { background: rgba(59,130,246,0.1); color: var(--info); border: 1px solid rgba(59,130,246,0.2); }

    .alert-success {
        background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3);
        color: var(--success); border-radius: 12px; padding: 16px 20px; font-size: 14px;
        font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; gap: 10px;
    }
</style>

<div class="dashboard-wrapper">
    <div class="dash-bg-grid"></div>

    <div class="max-w-7xl mx-auto px-4 py-8 flex flex-col md:flex-row gap-8 relative z-10">

        {{-- Sidebar --}}
        <aside style="width:280px; flex-shrink:0;">
            <div class="glass-card">
                <div class="profile-header">
                    <div class="avatar-circle">👤</div>
                    <div style="font-weight:800; color:white; font-size:18px; position:relative; z-index:2; text-shadow:0 2px 4px rgba(0,0,0,0.2);">
                        {{ $user->nombre_completo ?? $user->name ?? 'Usuario Pro' }}
                    </div>
                    <div style="font-size:12px; font-weight:600; color:rgba(255,255,255,0.7); text-transform:uppercase; letter-spacing:1px; margin-top:4px; position:relative; z-index:2;">
                        {{ ucfirst($user->rol ?? 'Cliente') }}
                    </div>
                </div>
                <nav style="padding: 12px 0;">
                    <a href="/dashboard" class="nav-link active">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Panel Principal
                    </a>
                    <a href="{{ route('profile.edit') }}" class="nav-link">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Editar Perfil
                    </a>
                    <a href="/carrito" class="nav-link">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Mi Carrito
                    </a>
                    <div style="border-top:1px solid var(--border); margin:12px 0;"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link danger" style="width:100%; background:none; border:none; border-left:3px solid transparent; cursor:pointer; text-align:left;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Cerrar Sesión
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

        {{-- Main --}}
        <section style="flex:1; display:flex; flex-direction:column; gap:24px;">

            @if(session('success'))
            <div class="alert-success glass-card" style="border-left:4px solid var(--success);">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
            @endif

            {{-- Stats row --}}
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:20px;">
                <div class="glass-card stat-card" style="border-top: 4px solid var(--info);">
                    <div class="stat-value" style="color:var(--info);">{{ $pedidos->count() }}</div>
                    <div class="stat-label">Total Pedidos</div>
                </div>
                <div class="glass-card stat-card" style="border-top: 4px solid var(--warning);">
                    <div class="stat-value" style="color:var(--warning);">{{ $pedidos->where('estado_pedido','Pendiente')->count() }}</div>
                    <div class="stat-label">Pendientes</div>
                </div>
                <div class="glass-card stat-card" style="border-top: 4px solid var(--success);">
                    <div class="stat-value" style="color:var(--success);">{{ $pedidos->where('estado_pedido','Pagado')->count() }}</div>
                    <div class="stat-label">Completados</div>
                </div>
                <div class="glass-card stat-card" style="border-top: 4px solid #8b5cf6;">
                    <div class="stat-value" style="color:#8b5cf6; font-size:26px;">S/ {{ number_format($pedidos->sum('total_pago'),0) }}</div>
                    <div class="stat-label">Total Gastado</div>
                </div>
            </div>

            {{-- Account info --}}
            <div class="glass-card" style="padding:30px;">
                <h3 style="font-size:18px; font-weight:800; color:var(--text); margin-bottom:20px; display:flex; align-items:center; gap:10px;">
                    <svg width="22" height="22" fill="none" stroke="var(--primary)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                    Información de Cuenta
                </h3>
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:20px; background:var(--input-bg); padding:20px; border-radius:12px; border:1px solid var(--border);">
                    <div>
                        <span style="font-size:12px; font-weight:700; color:var(--muted); text-transform:uppercase; display:block; margin-bottom:6px;">Nombre Completo</span>
                        <span style="font-weight:600; font-size:15px; color:var(--text);">{{ $user->nombre_completo ?? $user->name ?? '—' }}</span>
                    </div>
                    <div>
                        <span style="font-size:12px; font-weight:700; color:var(--muted); text-transform:uppercase; display:block; margin-bottom:6px;">Correo Electrónico</span>
                        <span style="font-weight:600; font-size:15px; color:var(--text);">{{ $user->correo ?? $user->email ?? '—' }}</span>
                    </div>
                    <div>
                        <span style="font-size:12px; font-weight:700; color:var(--muted); text-transform:uppercase; display:block; margin-bottom:6px;">Rol Asignado</span>
                        <span class="status-badge status-blue" style="font-size:11px;">{{ ucfirst($user->rol ?? 'cliente') }}</span>
                    </div>
                    <div>
                        <span style="font-size:12px; font-weight:700; color:var(--muted); text-transform:uppercase; display:block; margin-bottom:6px;">Miembro Desde</span>
                        <span style="font-weight:600; font-size:15px; color:var(--text);">{{ $user->created_at ? $user->created_at->format('M Y') : '—' }}</span>
                    </div>
                </div>
            </div>

            {{-- Orders table --}}
            <div class="glass-card">
                <div style="padding:20px 24px; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:10px;">
                    <svg width="20" height="20" fill="none" stroke="var(--primary)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <h3 style="font-size:16px; font-weight:800; color:var(--text); margin:0;">Mis Pedidos Recientes</h3>
                </div>
                <div class="table-container">
                    <table class="cp-table">
                        <thead>
                            <tr>
                                <th>N° Boleta</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Método de Pago</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pedidos as $p)
                            <tr>
                                <td style="font-weight:800; color:var(--primary);">#{{ $p->id_boleta }}</td>
                                <td style="color:var(--muted); font-size:13px; font-weight:600;">{{ \Carbon\Carbon::parse($p->fecha_venta)->format('d/m/Y') }}</td>
                                <td style="font-weight:800; font-size:15px; color:var(--text);">S/ {{ number_format($p->total_pago,2) }}</td>
                                <td style="font-size:13px; font-weight:600; color:var(--muted);">
                                    <span style="background:var(--input-bg); padding:4px 10px; border-radius:6px; border:1px solid var(--border);">{{ $p->metodo_pago ?? '—' }}</span>
                                </td>
                                <td>
                                    <span class="status-badge {{ $p->estado_pedido === 'Pagado' ? 'status-green' : ($p->estado_pedido === 'Enviado' ? 'status-blue' : 'status-yellow') }}">
                                        {{ $p->estado_pedido }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('boletas.mia', $p->id_boleta) }}" style="font-size:12px; font-weight:800; color:var(--primary); white-space:nowrap;">
                                        🧾 Ver boleta
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align:center; padding:40px 20px;">
                                    <div style="font-size:40px; margin-bottom:12px; opacity:0.5;">📦</div>
                                    <div style="font-weight:700; color:var(--text); margin-bottom:8px;">No tienes pedidos aún</div>
                                    <p style="color:var(--muted); font-size:14px; margin-bottom:16px;">¡Explora nuestra tienda y encuentra las mejores ofertas!</p>
                                    <a href="/" style="display:inline-block; padding:10px 24px; background:linear-gradient(135deg, var(--primary), #2563eb); color:white; font-weight:700; border-radius:10px; text-decoration:none; box-shadow:0 4px 15px rgba(29,78,216,0.3);">Ir a comprar</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
</div>
@endsection
