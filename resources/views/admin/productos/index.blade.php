@extends('layouts.admin')

@section('title', 'Productos')

@section('content')

@php
    use App\Models\Producto;
    $productos = Producto::all();
@endphp

<div class="topbar">
    <h1>📦 Productos</h1>

    <a class="btn" href="{{ route('admin.productos.create') }}">
        + Nuevo Producto
    </a>
</div>

<div class="card">

<table width="100%" cellpadding="10">

    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>

    @foreach($productos as $p)

    <tr>
        <td>
            @if($p->imagen)
                <img src="{{ asset('storage/'.$p->imagen) }}" width="60">
            @else
                ❌
            @endif
        </td>

        <td>{{ $p->nombre }}</td>
        <td>S/ {{ $p->precio }}</td>
        <td>{{ $p->stock }}</td>

        <td>
            <a href="{{ route('admin.productos.edit', $p->id) }}">Editar</a>
        </td>
    </tr>

    @endforeach

</table>

</div>

@endsection
