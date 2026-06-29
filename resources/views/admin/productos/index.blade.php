@extends('layouts.admin')

@section('title', 'Productos Admin')

@section('content')

<div class="card">
    <h1>📦 Gestión de Productos</h1>
</div>

<div class="card">

<table width="100%" cellpadding="10">

    <thead>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

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

                {{-- EDITAR ✔ CORREGIDO --}}
                <a href="{{ route('admin.productos.edit', ['producto' => $p->id]) }}">
                    ✏️ Editar
                </a>

            </td>
        </tr>

        @endforeach

    </tbody>

</table>

</div>

@endsection
