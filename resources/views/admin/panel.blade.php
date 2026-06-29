@extends('layouts.admin')

@section('title', 'Panel Admin')

@section('content')

@php
    use App\Models\Producto;
    use App\Models\Boleta;

    $productos = Producto::latest()->take(5)->get();
    $totalProductos = Producto::count();
    $totalVentas = Boleta::count();
@endphp

<div class="topbar">
    <h1>Dashboard Admin</h1>
</div>

<div style="display:grid; grid-template-columns:repeat(2,1fr); gap:15px;">

    <div class="card">
        <h3>📦 Productos</h3>
        <h1>{{ $totalProductos }}</h1>
    </div>

    <div class="card">
        <h3>💰 Ventas</h3>
        <h1>{{ $totalVentas }}</h1>
    </div>

</div>

<div class="card">
    <h3>⚡ Accesos rápidos</h3>

    <a class="btn" href="{{ route('admin.productos.index') }}">Gestionar Productos</a>
    <a class="btn" href="{{ route('admin.ventas.index') }}">Ver Ventas</a>
</div>

<div class="card">
    <h3>📦 Últimos productos</h3>

    <table width="100%">
        <tr>
            <th>Producto</th>
            <th>Stock</th>
            <th>Precio</th>
        </tr>

        @foreach($productos as $p)
        <tr>
            <td>{{ $p->nombre }}</td>
            <td>{{ $p->stock }}</td>
            <td>{{ $p->precio }}</td>
        </tr>
        @endforeach

    </table>
</div>

@endsection