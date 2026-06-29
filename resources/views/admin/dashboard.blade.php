@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

@php
    // 🔥 USANDO TU BASE DE DATOS REAL (según tu sistema)
    use App\Models\Producto;
    use App\Models\Boleta;
    use App\Models\Anuncio;

    $totalProductos = Producto::count();
    $totalVentas = Boleta::count();
    $totalAnuncios = Anuncio::count();
@endphp

{{-- ============================= --}}
{{-- 🎯 HEADER ADMIN --}}
{{-- ============================= --}}

<div class="cp-card" style="margin-bottom:20px;">
    <h1 style="font-family: Rajdhani, sans-serif; font-size:1.8rem; margin:0;">
        Panel Administrativo
    </h1>
    <p style="color:#6b7280; margin-top:5px;">
        Bienvenido al sistema Compured Perú
    </p>
</div>

{{-- ============================= --}}
{{-- 📊 CARDS ESTADÍSTICAS --}}
{{-- ============================= --}}

<div style="display:grid; grid-template-columns:repeat(3,1fr); gap:15px; margin-bottom:20px;">

    <div class="cp-card">
        <h3>📦 Productos</h3>
        <h2>{{ $totalProductos }}</h2>
    </div>

    <div class="cp-card">
        <h3>💰 Ventas</h3>
        <h2>{{ $totalVentas }}</h2>
    </div>

    <div class="cp-card">
        <h3>📢 Anuncios</h3>
        <h2>{{ $totalAnuncios }}</h2>
    </div>

</div>

{{-- ============================= --}}
{{-- 🚀 ACCESOS RÁPIDOS --}}
{{-- ============================= --}}

<div class="cp-card" style="margin-bottom:20px;">
    <h3>⚡ Accesos rápidos</h3>

    <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:10px;">

        <a href="{{ route('admin.productos.index') }}" class="btn-primary" style="padding:10px 14px; border-radius:8px; text-decoration:none;">
            📦 Gestionar Productos
        </a>

        <a href="{{ route('admin.ventas.index') }}" class="btn-primary" style="padding:10px 14px; border-radius:8px; text-decoration:none;">
            💰 Ver Ventas
        </a>

        <a href="{{ route('admin.anuncios.index') }}" class="btn-primary" style="padding:10px 14px; border-radius:8px; text-decoration:none;">
            📢 Anuncios
        </a>

    </div>
</div>

{{-- ============================= --}}
{{-- 📈 PANEL FUTURO (EXTENSIBLE) --}}
{{-- ============================= --}}

<div class="cp-card">

    <h3>🧠 Gestión del sistema</h3>

    <p style="color:#6b7280;">
        Desde aquí puedes administrar productos, ventas, anuncios y todo el sistema e-commerce.
    </p>

    <ul style="margin-top:10px; color:#374151;">
        <li>✔ Crear productos con imágenes</li>
        <li>✔ Editar precio, stock y descripción</li>
        <li>✔ Control de ventas y boletas</li>
        <li>✔ Gestión de anuncios promocionales</li>
        <li>✔ Exportación futura a Excel (opcional)</li>
    </ul>

</div>

@endsection
