<!-- resources/views/admin/panel.blade.php -->
@extends('layouts.admin')

@section('title', 'Panel Admin')

@section('content')

{{-- HEADER PRINCIPAL LARGO --}}
<div class="card" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px; padding:35px; border-left:8px solid var(--primary); margin-bottom:30px; position:relative; overflow:hidden;">

    <div style="position:absolute; top:-30px; right:-20px; width:150px; height:150px; background:radial-gradient(circle, rgba(154,216,0,0.15) 0%, rgba(255,255,255,0) 70%); border-radius:50%; pointer-events:none;"></div>
    <div style="position:absolute; bottom:-30px; left:20%; width:100px; height:100px; background:radial-gradient(circle, rgba(0,86,179,0.05) 0%, rgba(255,255,255,0) 70%); border-radius:50%; pointer-events:none;"></div>

    <div style="position:relative; z-index:1;">
        <h1 class="title-text" style="font-size:32px; font-weight:800; margin:0 0 8px 0; letter-spacing:-0.5px;">
            <span style="background:var(--bg-hover); padding:8px 12px; border-radius:12px; margin-right:10px; border:1px solid var(--border-color);">📊</span>
            Panel Administrativo
        </h1>
        <p class="muted-text" style="margin:0; font-size:16px; font-weight:500; display:flex; align-items:center; gap:8px;">
            <span style="display:inline-block; width:8px; height:8px; background:var(--accent); border-radius:50%; box-shadow:0 0 8px var(--accent);"></span>
            Bienvenido al sistema de administración
        </p>
    </div>

    <div style="display:flex; gap:15px; flex-wrap:wrap; position:relative; z-index:1;">
        <a href="{{ route('admin.productos.index') }}"
           style="background:linear-gradient(to bottom, #0066cc, #0056b3); color:white; padding:14px 22px; border-radius:10px; text-decoration:none; font-weight:700; font-size:15px; box-shadow:0 6px 15px -3px rgba(0,86,179,0.4); border:1px solid #004494; display:flex; align-items:center; gap:8px;">
            Productos
        </a>
        <a href="{{ route('admin.anuncios.index') }}"
           style="background:linear-gradient(to bottom, #f59e0b, #d97706); color:white; padding:14px 22px; border-radius:10px; text-decoration:none; font-weight:700; font-size:15px; box-shadow:0 6px 15px -3px rgba(245,158,11,0.4); border:1px solid #b45309; display:flex; align-items:center; gap:8px;">
            <span style="font-size:18px;">📢</span> Anuncios
        </a>
    </div>
</div>

{{-- ESTADÍSTICAS PRINCIPALES --}}
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:25px; margin-top:20px;">

    <div class="card" style="padding:30px; position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(to right, #0056b3, #3b82f6);"></div>
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <div>
                <h3 class="muted-text" style="font-size:14px; margin:0 0 10px 0; text-transform:uppercase; letter-spacing:1px; font-weight:700;">Productos</h3>
                <h1 class="main-text" style="margin:0; font-size:42px; font-weight:900;">{{ \App\Models\Producto::count() }}</h1>
            </div>
            <div style="background:var(--icon-bg); padding:12px; border-radius:12px; color:var(--icon-color);">
                <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16.5c0 .38-.21.71-.53.88l-7.9 4.44c-.16.12-.36.18-.57.18-.21 0-.41-.06-.57-.18l-7.9-4.44A.991.991 0 0 1 3 16.5v-9c0-.38.21-.71.53-.88l7.9-4.44c.16-.12.36-.18.57-.18.21 0 .41.06.57.18l7.9 4.44c.32.17.53.5.53.88v9M12 4.15L6.04 7.5 12 10.85l5.96-3.35L12 4.15M5 15.91l6 3.38v-6.71L5 9.21v6.7M19 15.91v-6.7l-6 3.38v6.71l6-3.38z"/></svg>
            </div>
        </div>
        <div style="margin-top:15px; padding-top:15px; border-top:1px solid var(--border-color); font-size:13px; color:#10b981; font-weight:600; display:flex; align-items:center; gap:5px;">
            <span>↑</span> Total registrados en inventario
        </div>
    </div>

    <div class="card" style="padding:30px; position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(to right, #9ad800, #84cc16);"></div>
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <div>
                <h3 class="muted-text" style="font-size:14px; margin:0 0 10px 0; text-transform:uppercase; letter-spacing:1px; font-weight:700;">💰 Ventas</h3>
                <h1 class="main-text" style="margin:0; font-size:42px; font-weight:900;">{{ \App\Models\Boleta::count() }}</h1>
            </div>
            <div style="background:rgba(132, 204, 22, 0.15); padding:12px; border-radius:12px; color:#65a30d;">
                <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-1.08 2.4-1.73 0-.9-1.26-1.28-3.08-1.8-2.58-.72-3.41-2.14-3.41-3.69 0-1.72 1.4-2.82 3.15-3.17V4h2.67v1.94c1.47.31 2.8 1.25 3.03 3.03h-1.92c-.17-.98-.95-1.55-2.45-1.55-1.57 0-2.3.7-2.3 1.54 0 1.01 1.29 1.34 3.25 1.86 2.45.66 3.24 2.15 3.24 3.75 0 2.06-1.57 3.08-3.25 3.52z"/></svg>
            </div>
        </div>
        <div style="margin-top:15px; padding-top:15px; border-top:1px solid var(--border-color); font-size:13px; color:#10b981; font-weight:600; display:flex; align-items:center; gap:5px;">
            <span>↑</span> Transacciones completadas
        </div>
    </div>

    <div class="card" style="padding:30px; position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(to right, #ef4444, #f87171);"></div>
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <div>
                <h3 class="muted-text" style="font-size:14px; margin:0 0 10px 0; text-transform:uppercase; letter-spacing:1px; font-weight:700;">📉 Stock bajo</h3>
                <h1 style="color:#ef4444; margin:0; font-size:42px; font-weight:900;">
                    {{ \App\Models\Producto::where('stock','<',5)->count() }}
                </h1>
            </div>
            <div style="background:rgba(239, 68, 68, 0.15); padding:12px; border-radius:12px; color:#ef4444;">
                <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm1 14h-2v-2h2v2zm0-4h-2V8h2v4z"/></svg>
            </div>
        </div>
        <div style="margin-top:15px; padding-top:15px; border-top:1px solid var(--border-color); font-size:13px; color:#ef4444; font-weight:600; display:flex; align-items:center; gap:5px;">
            <span>⚠</span> Requiere atención inmediata
        </div>
    </div>

    <div class="card" style="padding:30px; position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(to right, #10b981, #34d399);"></div>
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <div>
                <h3 class="muted-text" style="font-size:14px; margin:0 0 10px 0; text-transform:uppercase; letter-spacing:1px; font-weight:700;">📊 Activos</h3>
                <h1 style="color:#10b981; margin:0; font-size:42px; font-weight:900;">
                    {{ \App\Models\Producto::where('stock','>',0)->count() }}
                </h1>
            </div>
            <div style="background:rgba(16, 185, 129, 0.15); padding:12px; border-radius:12px; color:#10b981;">
                <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            </div>
        </div>
        <div style="margin-top:15px; padding-top:15px; border-top:1px solid var(--border-color); font-size:13px; color:#10b981; font-weight:600; display:flex; align-items:center; gap:5px;">
            <span>✔</span> Productos disponibles
        </div>
    </div>

</div>

{{-- SECCIÓN GRÁFICOS --}}
<div class="card" style="padding:35px; margin-top:30px;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; border-bottom:2px solid var(--border-color); padding-bottom:15px;">
        <h2 class="main-text" style="margin:0; font-size:24px; font-weight:800; display:flex; align-items:center; gap:10px;">
            <span style="background:var(--primary); color:white; padding:5px; border-radius:8px;">📈</span>
            Resumen del sistema
        </h2>
        <span style="background:var(--bg-hover); color:var(--text-muted); padding:6px 12px; border-radius:20px; font-size:13px; font-weight:600; border:1px solid var(--border-color);">Hoy</span>
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:25px;">

        <div style="padding:30px; background:var(--bg-hover); border-radius:16px; border:1px solid var(--border-color);">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                <div style="background:#0284c7; width:12px; height:12px; border-radius:50%;"></div>
                <h3 class="title-text" style="margin:0; font-size:18px; font-weight:700;">Ventas del día</h3>
            </div>
            <p class="title-text" style="font-size:42px; font-weight:900; margin:0 0 10px 0; letter-spacing:-1px;">S/ {{ number_format($ventasDelDia ?? 0, 2) }}</p>
            <div style="background:var(--bg-card); padding:10px 15px; border-radius:8px; border:1px solid var(--border-color);">
                <p class="muted-text" style="margin:0; font-size:14px; font-weight:600;">(Próxima integración gráfica)</p>
            </div>
        </div>

        <div style="padding:30px; background:var(--bg-hover); border-radius:16px; border:1px solid var(--border-color);">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                <div style="background:var(--text-muted); width:12px; height:12px; border-radius:50%;"></div>
                <h3 class="main-text" style="margin:0; font-size:18px; font-weight:700;">Pedidos pendientes</h3>
            </div>
            <p class="main-text" style="font-size:42px; font-weight:900; margin:0 0 10px 0; letter-spacing:-1px;">0</p>
            <div style="background:var(--bg-card); padding:10px 15px; border-radius:8px; border:1px solid var(--border-color);">
                <p class="muted-text" style="margin:0; font-size:14px; font-weight:600;">Estado del sistema en tiempo real</p>
            </div>
        </div>

    </div>

</div>

{{-- ACCESOS RÁPIDOS Y ACTIVIDAD --}}
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(400px, 1fr)); gap:30px; margin-top:30px;">

    {{-- ACCESOS RÁPIDOS --}}
    <div class="card" style="padding:35px; height:100%;">
        <h2 class="title-text" style="margin:0 0 20px 0; font-size:22px; font-weight:800; display:flex; align-items:center; gap:10px; border-bottom:2px solid var(--border-color); padding-bottom:15px;">
            <span style="font-size:24px;">⚡</span> Accesos rápidos
        </h2>
        <div style="display:flex; flex-direction:column; gap:15px; margin-top:20px;">
            <a href="{{ route('admin.productos.create') }}"
               style="background:var(--primary); color:white; padding:16px 20px; border-radius:12px; text-decoration:none; font-weight:700; font-size:16px; display:flex; align-items:center; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <span style="background:rgba(255,255,255,0.2); padding:8px; border-radius:8px;">➕</span> Crear Producto
                </div>
                <span style="opacity:0.7;">→</span>
            </a>
            <a href="{{ route('admin.productos.index') }}"
               style="background:var(--bg-hover); color:var(--text-main); padding:16px 20px; border-radius:12px; text-decoration:none; font-weight:700; font-size:16px; border:2px solid var(--border-color); display:flex; align-items:center; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <span style="background:var(--icon-bg); color:var(--icon-color); padding:8px; border-radius:8px;">📦</span> Ver Productos
                </div>
                <span class="muted-text">→</span>
            </a>
        </div>
    </div>

    {{-- ACTIVIDAD RECIENTE --}}
    <div class="card" style="padding:35px; border-top:6px solid var(--accent); height:100%;">
        <h2 class="main-text" style="margin:0 0 20px 0; font-size:22px; font-weight:800; display:flex; align-items:center; gap:10px; border-bottom:2px solid var(--border-color); padding-bottom:15px;">
            <span style="font-size:24px;">🧾</span> Actividad reciente
        </h2>
        <div style="margin-top:20px;">
            <ul style="margin:0; padding:0; list-style:none;">
                <li style="display:flex; align-items:flex-start; gap:15px; margin-bottom:20px; position:relative;">
                    <div style="width:2px; height:100%; background:var(--border-color); position:absolute; left:14px; top:28px;"></div>
                    <div style="background:rgba(132, 204, 22, 0.15); color:#84cc16; width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-weight:bold; z-index:1;">✔</div>
                    <div style="background:var(--bg-hover); padding:15px; border-radius:12px; width:100%; border:1px solid var(--border-color);">
                        <p class="main-text" style="margin:0; font-weight:600; font-size:15px;">Sistema iniciado correctamente</p>
                        <p class="muted-text" style="margin:5px 0 0 0; font-size:12px;">Sesión autenticada</p>
                    </div>
                </li>
                <li style="display:flex; align-items:flex-start; gap:15px; margin-bottom:20px; position:relative;">
                    <div style="width:2px; height:100%; background:var(--border-color); position:absolute; left:14px; top:28px;"></div>
                    <div style="background:rgba(132, 204, 22, 0.15); color:#84cc16; width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-weight:bold; z-index:1;">✔</div>
                    <div style="background:var(--bg-hover); padding:15px; border-radius:12px; width:100%; border:1px solid var(--border-color);">
                        <p class="main-text" style="margin:0; font-weight:600; font-size:15px;">Panel admin cargado</p>
                        <p class="muted-text" style="margin:5px 0 0 0; font-size:12px;">Módulos principales listos</p>
                    </div>
                </li>
                <li style="display:flex; align-items:flex-start; gap:15px; margin-bottom:20px; position:relative;">
                    <div style="width:2px; height:100%; background:var(--border-color); position:absolute; left:14px; top:28px;"></div>
                    <div style="background:rgba(132, 204, 22, 0.15); color:#84cc16; width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-weight:bold; z-index:1;">✔</div>
                    <div style="background:var(--bg-hover); padding:15px; border-radius:12px; width:100%; border:1px solid var(--border-color);">
                        <p class="main-text" style="margin:0; font-weight:600; font-size:15px;">Productos sincronizados</p>
                        <p class="muted-text" style="margin:5px 0 0 0; font-size:12px;">Base de datos actualizada</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</div>

@endsection
