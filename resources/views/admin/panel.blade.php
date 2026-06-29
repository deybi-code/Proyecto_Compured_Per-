@extends('layouts.admin')

@section('title', 'Panel Admin')

@section('content')

{{-- HEADER PRINCIPAL --}}
<div class="card" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">

    <div>
        <h1>📊 Panel Administrativo</h1>
        <p style="color:#6b7280;">
            Bienvenido al sistema de administración
        </p>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">

        <a href="{{ route('admin.productos.index') }}"
           style="background:#2563eb;color:white;padding:10px 14px;border-radius:8px;text-decoration:none;">
            📦 Productos
        </a>

        <a href="{{ route('admin.ventas.index') }}"
           style="background:#10b981;color:white;padding:10px 14px;border-radius:8px;text-decoration:none;">
            💰 Ventas
        </a>

        <a href="{{ route('admin.anuncios.index') }}"
           style="background:#f59e0b;color:white;padding:10px 14px;border-radius:8px;text-decoration:none;">
            📢 Anuncios
        </a>

    </div>

</div>

{{-- ESTADÍSTICAS PRINCIPALES --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:15px;margin-top:15px;">

    <div class="card" style="text-align:center;">
        <h3>📦 Productos</h3>
        <h1>{{ \App\Models\Producto::count() }}</h1>
    </div>

    <div class="card" style="text-align:center;">
        <h3>💰 Ventas</h3>
        <h1>{{ \App\Models\Boleta::count() }}</h1>
    </div>

    <div class="card" style="text-align:center;">
        <h3>📉 Stock bajo</h3>
        <h1 style="color:red;">
            {{ \App\Models\Producto::where('stock','<',5)->count() }}
        </h1>
    </div>

    <div class="card" style="text-align:center;">
        <h3>📊 Activos</h3>
        <h1 style="color:green;">
            {{ \App\Models\Producto::where('stock','>',0)->count() }}
        </h1>
    </div>

</div>

{{-- SECCIÓN GRÁFICOS (UI FUTURA) --}}
<div class="card" style="margin-top:15px;">

    <h2>📈 Resumen del sistema</h2>

    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:15px;margin-top:10px;">

        <div style="padding:20px;background:#f8fafc;border-radius:10px;">
            <h3>Ventas del día</h3>
            <p style="font-size:22px;font-weight:bold;">S/ 0.00</p>
            <p style="color:#6b7280;">(Próxima integración gráfica)</p>
        </div>

        <div style="padding:20px;background:#f8fafc;border-radius:10px;">
            <h3>Pedidos pendientes</h3>
            <p style="font-size:22px;font-weight:bold;">0</p>
            <p style="color:#6b7280;">Estado del sistema en tiempo real</p>
        </div>

    </div>

</div>

{{-- ACCESOS RÁPIDOS --}}
<div class="card" style="margin-top:15px;">

    <h2>⚡ Accesos rápidos</h2>

    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:10px;">

        <a href="{{ route('admin.productos.create') }}"
           style="background:#2563eb;color:white;padding:10px 14px;border-radius:8px;text-decoration:none;">
            ➕ Crear Producto
        </a>

        <a href="{{ route('admin.productos.index') }}"
           style="background:#6366f1;color:white;padding:10px 14px;border-radius:8px;text-decoration:none;">
            📦 Ver Productos
        </a>

        <a href="{{ route('admin.ventas.index') }}"
           style="background:#10b981;color:white;padding:10px 14px;border-radius:8px;text-decoration:none;">
            💰 Ver Ventas
        </a>

    </div>

</div>

{{-- ACTIVIDAD RECIENTE (UI FUTURA) --}}
<div class="card" style="margin-top:15px;">

    <h2>🧾 Actividad reciente</h2>

    <ul style="margin-top:10px;line-height:1.8;color:#6b7280;">

        <li>✔ Sistema iniciado correctamente</li>
        <li>✔ Panel admin cargado</li>
        <li>✔ Productos sincronizados</li>
        <li>⚡ Próximamente: estadísticas en tiempo real</li>

    </ul>

</div>

@endsection
