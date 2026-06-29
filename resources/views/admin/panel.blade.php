@extends('layouts.admin')

@section('title', 'Panel Admin')

@section('content')

<div class="card">
    <h1>Panel Administrativo</h1>
    <p>Sistema Compured Perú funcionando correctamente</p>
</div>

<div class="card">

    <h3>Accesos rápidos</h3>

    <ul>
        <li><a href="{{ route('admin.productos.index') }}">Gestionar Productos</a></li>
        <li><a href="{{ route('admin.ventas.index') }}">Ver Ventas</a></li>
        <li><a href="{{ route('admin.anuncios.index') }}">Anuncios</a></li>
    </ul>

</div>

<div class="card">

    <h3>Estado del sistema</h3>

    <p>✔ Admin activo</p>
    <p>✔ Rutas funcionando</p>
    <p>✔ Panel estable</p>

</div>

@endsection
