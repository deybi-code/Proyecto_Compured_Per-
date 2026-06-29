@extends('layouts.admin')

@section('title', 'Panel Admin')

@section('content')

{{-- HEADER PRINCIPAL --}}
<div class="card" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px; background:linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius:16px; box-shadow:0 12px 25px -5px rgba(0,86,179,0.15); padding:35px; border-left:8px solid #0056b3; margin-bottom:30px; position:relative; overflow:hidden;">

    {{-- Decoración de fondo --}}
    <div style="position:absolute; top:-30px; right:-20px; width:150px; height:150px; background:radial-gradient(circle, rgba(154,216,0,0.15) 0%, rgba(255,255,255,0) 70%); border-radius:50%; pointer-events:none;"></div>
    <div style="position:absolute; bottom:-30px; left:20%; width:100px; height:100px; background:radial-gradient(circle, rgba(0,86,179,0.05) 0%, rgba(255,255,255,0) 70%); border-radius:50%; pointer-events:none;"></div>

    <div style="position:relative; z-index:1;">
        <h1 style="color:#0056b3; font-size:32px; font-weight:800; margin:0 0 8px 0; letter-spacing:-0.5px; text-shadow:1px 1px 2px rgba(0,0,0,0.05);">
            <span style="background:#e0f2fe; padding:8px 12px; border-radius:12px; margin-right:10px;">📊</span>
            Panel Administrativo
        </h1>
        <p style="color:#475569; margin:0; font-size:16px; font-weight:500; display:flex; align-items:center; gap:8px;">
            <span style="display:inline-block; width:8px; height:8px; background:#9ad800; border-radius:50%; box-shadow:0 0 8px #9ad800;"></span>
            Bienvenido al sistema de administración
        </p>
    </div>

    <div style="display:flex; gap:15px; flex-wrap:wrap; position:relative; z-index:1;">

        <a href="{{ route('admin.productos.index') }}"
           style="background:linear-gradient(to bottom, #0066cc, #0056b3); color:white; padding:14px 22px; border-radius:10px; text-decoration:none; font-weight:700; font-size:15px; box-shadow:0 6px 15px -3px rgba(0,86,179,0.4); border:1px solid #004494; display:flex; align-items:center; gap:8px;">
            <span style="font-size:18px;">📦</span> Productos
        </a>

        <a href="{{ route('admin.ventas.index') }}"
           style="background:linear-gradient(to bottom, #a6ea00, #9ad800); color:#064e3b; padding:14px 22px; border-radius:10px; text-decoration:none; font-weight:800; font-size:15px; box-shadow:0 6px 15px -3px rgba(154,216,0,0.4); border:1px solid #86bc00; display:flex; align-items:center; gap:8px;">
            <span style="font-size:18px;">💰</span> Ventas
        </a>

        <a href="{{ route('admin.anuncios.index') }}"
           style="background:linear-gradient(to bottom, #f59e0b, #d97706); color:white; padding:14px 22px; border-radius:10px; text-decoration:none; font-weight:700; font-size:15px; box-shadow:0 6px 15px -3px rgba(245,158,11,0.4); border:1px solid #b45309; display:flex; align-items:center; gap:8px;">
            <span style="font-size:18px;">📢</span> Anuncios
        </a>

    </div>

</div>

{{-- ESTADÍSTICAS PRINCIPALES --}}
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:25px; margin-top:20px;">

    {{-- Tarjeta 1: Productos --}}
    <div class="card" style="background:#ffffff; border-radius:16px; box-shadow:0 8px 20px -5px rgba(0,0,0,0.08); padding:30px; position:relative; overflow:hidden; border:1px solid #e2e8f0;">
        <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(to right, #0056b3, #3b82f6);"></div>
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <div>
                <h3 style="color:#64748b; font-size:14px; margin:0 0 10px 0; text-transform:uppercase; letter-spacing:1px; font-weight:700;">📦 Productos</h3>
                <h1 style="color:#0f172a; margin:0; font-size:42px; font-weight:900;">{{ \App\Models\Producto::count() }}</h1>
            </div>
            <div style="background:#eff6ff; padding:12px; border-radius:12px; color:#0056b3;">
                <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16.5c0 .38-.21.71-.53.88l-7.9 4.44c-.16.12-.36.18-.57.18-.21 0-.41-.06-.57-.18l-7.9-4.44A.991.991 0 0 1 3 16.5v-9c0-.38.21-.71.53-.88l7.9-4.44c.16-.12.36-.18.57-.18.21 0 .41.06.57.18l7.9 4.44c.32.17.53.5.53.88v9M12 4.15L6.04 7.5 12 10.85l5.96-3.35L12 4.15M5 15.91l6 3.38v-6.71L5 9.21v6.7M19 15.91v-6.7l-6 3.38v6.71l6-3.38z"/></svg>
            </div>
        </div>
        <div style="margin-top:15px; padding-top:15px; border-top:1px solid #f1f5f9; font-size:13px; color:#10b981; font-weight:600; display:flex; align-items:center; gap:5px;">
            <span>↑</span> Total registrados en inventario
        </div>
    </div>

    {{-- Tarjeta 2: Ventas --}}
    <div class="card" style="background:#ffffff; border-radius:16px; box-shadow:0 8px 20px -5px rgba(0,0,0,0.08); padding:30px; position:relative; overflow:hidden; border:1px solid #e2e8f0;">
        <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(to right, #9ad800, #84cc16);"></div>
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <div>
                <h3 style="color:#64748b; font-size:14px; margin:0 0 10px 0; text-transform:uppercase; letter-spacing:1px; font-weight:700;">💰 Ventas</h3>
                <h1 style="color:#0f172a; margin:0; font-size:42px; font-weight:900;">{{ \App\Models\Boleta::count() }}</h1>
            </div>
            <div style="background:#f7fee7; padding:12px; border-radius:12px; color:#65a30d;">
                <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-1.08 2.4-1.73 0-.9-1.26-1.28-3.08-1.8-2.58-.72-3.41-2.14-3.41-3.69 0-1.72 1.4-2.82 3.15-3.17V4h2.67v1.94c1.47.31 2.8 1.25 3.03 3.03h-1.92c-.17-.98-.95-1.55-2.45-1.55-1.57 0-2.3.7-2.3 1.54 0 1.01 1.29 1.34 3.25 1.86 2.45.66 3.24 2.15 3.24 3.75 0 2.06-1.57 3.08-3.25 3.52z"/></svg>
            </div>
        </div>
        <div style="margin-top:15px; padding-top:15px; border-top:1px solid #f1f5f9; font-size:13px; color:#10b981; font-weight:600; display:flex; align-items:center; gap:5px;">
            <span>↑</span> Transacciones completadas
        </div>
    </div>

    {{-- Tarjeta 3: Stock Bajo --}}
    <div class="card" style="background:#ffffff; border-radius:16px; box-shadow:0 8px 20px -5px rgba(0,0,0,0.08); padding:30px; position:relative; overflow:hidden; border:1px solid #e2e8f0;">
        <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(to right, #ef4444, #f87171);"></div>
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <div>
                <h3 style="color:#64748b; font-size:14px; margin:0 0 10px 0; text-transform:uppercase; letter-spacing:1px; font-weight:700;">📉 Stock bajo</h3>
                <h1 style="color:#ef4444; margin:0; font-size:42px; font-weight:900;">
                    {{ \App\Models\Producto::where('stock','<',5)->count() }}
                </h1>
            </div>
            <div style="background:#fef2f2; padding:12px; border-radius:12px; color:#dc2626;">
                <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm1 14h-2v-2h2v2zm0-4h-2V8h2v4z"/></svg>
            </div>
        </div>
        <div style="margin-top:15px; padding-top:15px; border-top:1px solid #f1f5f9; font-size:13px; color:#ef4444; font-weight:600; display:flex; align-items:center; gap:5px;">
            <span>⚠</span> Requiere atención inmediata
        </div>
    </div>

    {{-- Tarjeta 4: Activos --}}
    <div class="card" style="background:#ffffff; border-radius:16px; box-shadow:0 8px 20px -5px rgba(0,0,0,0.08); padding:30px; position:relative; overflow:hidden; border:1px solid #e2e8f0;">
        <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(to right, #10b981, #34d399);"></div>
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <div>
                <h3 style="color:#64748b; font-size:14px; margin:0 0 10px 0; text-transform:uppercase; letter-spacing:1px; font-weight:700;">📊 Activos</h3>
                <h1 style="color:#10b981; margin:0; font-size:42px; font-weight:900;">
                    {{ \App\Models\Producto::where('stock','>',0)->count() }}
                </h1>
            </div>
            <div style="background:#ecfdf5; padding:12px; border-radius:12px; color:#059669;">
                <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            </div>
        </div>
        <div style="margin-top:15px; padding-top:15px; border-top:1px solid #f1f5f9; font-size:13px; color:#10b981; font-weight:600; display:flex; align-items:center; gap:5px;">
            <span>✔</span> Productos disponibles
        </div>
    </div>

</div>

{{-- SECCIÓN GRÁFICOS (UI FUTURA) --}}
<div class="card" style="margin-top:30px; background:#ffffff; border-radius:16px; box-shadow:0 8px 25px -5px rgba(0,0,0,0.05); padding:35px; border:1px solid #e2e8f0;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; border-bottom:2px solid #f1f5f9; padding-bottom:15px;">
        <h2 style="color:#0f172a; margin:0; font-size:24px; font-weight:800; display:flex; align-items:center; gap:10px;">
            <span style="background:#0056b3; color:white; padding:5px; border-radius:8px;">📈</span>
            Resumen del sistema
        </h2>
        <span style="background:#f1f5f9; color:#475569; padding:6px 12px; border-radius:20px; font-size:13px; font-weight:600;">Hoy</span>
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:25px;">

        <div style="padding:30px; background:linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border-radius:16px; border:1px solid #bae6fd; box-shadow:inset 0 2px 4px rgba(255,255,255,0.8);">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                <div style="background:#0284c7; width:12px; height:12px; border-radius:50%;"></div>
                <h3 style="color:#0369a1; margin:0; font-size:18px; font-weight:700;">Ventas del día</h3>
            </div>
            <p style="font-size:42px; font-weight:900; color:#0c4a6e; margin:0 0 10px 0; letter-spacing:-1px;">S/ 0.00</p>
            <div style="background:rgba(2,132,199,0.1); padding:10px 15px; border-radius:8px;">
                <p style="color:#0284c7; margin:0; font-size:14px; font-weight:600;">(Próxima integración gráfica)</p>
            </div>
        </div>

        <div style="padding:30px; background:linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius:16px; border:1px solid #e2e8f0; box-shadow:inset 0 2px 4px rgba(255,255,255,0.8);">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                <div style="background:#475569; width:12px; height:12px; border-radius:50%;"></div>
                <h3 style="color:#334155; margin:0; font-size:18px; font-weight:700;">Pedidos pendientes</h3>
            </div>
            <p style="font-size:42px; font-weight:900; color:#0f172a; margin:0 0 10px 0; letter-spacing:-1px;">0</p>
            <div style="background:rgba(71,85,105,0.1); padding:10px 15px; border-radius:8px;">
                <p style="color:#475569; margin:0; font-size:14px; font-weight:600;">Estado del sistema en tiempo real</p>
            </div>
        </div>

    </div>

</div>

{{-- ACCESOS RÁPIDOS Y ACTIVIDAD (GRID) --}}
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(400px, 1fr)); gap:30px; margin-top:30px;">

    {{-- ACCESOS RÁPIDOS --}}
    <div class="card" style="background:#ffffff; border-radius:16px; box-shadow:0 8px 25px -5px rgba(0,0,0,0.05); padding:35px; border:1px solid #e2e8f0; height:100%;">

        <h2 style="color:#0056b3; margin:0 0 20px 0; font-size:22px; font-weight:800; display:flex; align-items:center; gap:10px; border-bottom:2px solid #f1f5f9; padding-bottom:15px;">
            <span style="font-size:24px;">⚡</span> Accesos rápidos
        </h2>

        <div style="display:flex; flex-direction:column; gap:15px; margin-top:20px;">

            <a href="{{ route('admin.productos.create') }}"
               style="background:#0056b3; color:white; padding:16px 20px; border-radius:12px; text-decoration:none; font-weight:700; font-size:16px; box-shadow:0 4px 10px rgba(0,86,179,0.2); transition:all 0.2s; display:flex; align-items:center; justify-content:space-between; border:1px solid transparent;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <span style="background:rgba(255,255,255,0.2); padding:8px; border-radius:8px;">➕</span>
                    Crear Producto
                </div>
                <span style="opacity:0.7;">→</span>
            </a>

            <a href="{{ route('admin.productos.index') }}"
               style="background:#f8fafc; color:#0056b3; padding:16px 20px; border-radius:12px; text-decoration:none; font-weight:700; font-size:16px; border:2px solid #e2e8f0; transition:all 0.2s; display:flex; align-items:center; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <span style="background:#e0f2fe; padding:8px; border-radius:8px;">📦</span>
                    Ver Productos
                </div>
                <span style="color:#94a3b8;">→</span>
            </a>

            <a href="{{ route('admin.ventas.index') }}"
               style="background:#f8fafc; color:#4d6c00; padding:16px 20px; border-radius:12px; text-decoration:none; font-weight:700; font-size:16px; border:2px solid #e2e8f0; transition:all 0.2s; display:flex; align-items:center; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <span style="background:#f7fee7; padding:8px; border-radius:8px;">💰</span>
                    Ver Ventas
                </div>
                <span style="color:#94a3b8;">→</span>
            </a>

        </div>

    </div>

    {{-- ACTIVIDAD RECIENTE (UI FUTURA) --}}
    <div class="card" style="background:#ffffff; border-radius:16px; box-shadow:0 8px 25px -5px rgba(0,0,0,0.05); padding:35px; border:1px solid #e2e8f0; border-top:6px solid #9ad800; height:100%;">

        <h2 style="color:#0f172a; margin:0 0 20px 0; font-size:22px; font-weight:800; display:flex; align-items:center; gap:10px; border-bottom:2px solid #f1f5f9; padding-bottom:15px;">
            <span style="font-size:24px;">🧾</span> Actividad reciente
        </h2>

        <div style="margin-top:20px;">
            <ul style="margin:0; padding:0; list-style:none;">

                <li style="display:flex; align-items:flex-start; gap:15px; margin-bottom:20px; position:relative;">
                    <div style="width:2px; height:100%; background:#e2e8f0; position:absolute; left:14px; top:28px;"></div>
                    <div style="background:#f7fee7; color:#84cc16; width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-weight:bold; z-index:1; border:2px solid #ffffff; box-shadow:0 2px 4px rgba(0,0,0,0.1);">✔</div>
                    <div style="background:#f8fafc; padding:15px; border-radius:12px; width:100%; border:1px solid #f1f5f9;">
                        <p style="margin:0; color:#334155; font-weight:600; font-size:15px;">Sistema iniciado correctamente</p>
                        <p style="margin:5px 0 0 0; color:#94a3b8; font-size:12px;">Sesión autenticada</p>
                    </div>
                </li>

                <li style="display:flex; align-items:flex-start; gap:15px; margin-bottom:20px; position:relative;">
                    <div style="width:2px; height:100%; background:#e2e8f0; position:absolute; left:14px; top:28px;"></div>
                    <div style="background:#f7fee7; color:#84cc16; width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-weight:bold; z-index:1; border:2px solid #ffffff; box-shadow:0 2px 4px rgba(0,0,0,0.1);">✔</div>
                    <div style="background:#f8fafc; padding:15px; border-radius:12px; width:100%; border:1px solid #f1f5f9;">
                        <p style="margin:0; color:#334155; font-weight:600; font-size:15px;">Panel admin cargado</p>
                        <p style="margin:5px 0 0 0; color:#94a3b8; font-size:12px;">Módulos principales listos</p>
                    </div>
                </li>

                <li style="display:flex; align-items:flex-start; gap:15px; margin-bottom:20px; position:relative;">
                    <div style="width:2px; height:100%; background:#e2e8f0; position:absolute; left:14px; top:28px;"></div>
                    <div style="background:#f7fee7; color:#84cc16; width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-weight:bold; z-index:1; border:2px solid #ffffff; box-shadow:0 2px 4px rgba(0,0,0,0.1);">✔</div>
                    <div style="background:#f8fafc; padding:15px; border-radius:12px; width:100%; border:1px solid #f1f5f9;">
                        <p style="margin:0; color:#334155; font-weight:600; font-size:15px;">Productos sincronizados</p>
                        <p style="margin:5px 0 0 0; color:#94a3b8; font-size:12px;">Base de datos actualizada</p>
                    </div>
                </li>

                <li style="display:flex; align-items:flex-start; gap:15px; position:relative;">
                    <div style="background:#fffbeb; color:#f59e0b; width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-weight:bold; z-index:1; border:2px solid #ffffff; box-shadow:0 2px 4px rgba(0,0,0,0.1);">⚡</div>
                    <div style="background:#fffbeb; padding:15px; border-radius:12px; width:100%; border:1px dashed #fcd34d;">
                        <p style="margin:0; color:#b45309; font-weight:700; font-size:15px;">Próximamente: estadísticas en tiempo real</p>
                        <p style="margin:5px 0 0 0; color:#d97706; font-size:12px;">En desarrollo</p>
                    </div>
                </li>

            </ul>
        </div>

    </div>

</div>

@endsection
