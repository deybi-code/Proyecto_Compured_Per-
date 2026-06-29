@extends('layouts.admin')

@section('title', 'Detalle Producto')

@section('content')

<div class="card">
    <h2>{{ $producto->nombre }}</h2>
    <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? '—' }}</p>
    <p><strong>Precio:</strong> S/ {{ number_format($producto->precio, 2) }}</p>
    <p><strong>Stock:</strong> {{ $producto->stock }}</p>
    <p><strong>Marca:</strong> {{ $producto->marca }}</p>
    @if($producto->detalles_tecnicos)
        <p><strong>Detalles técnicos:</strong><br>{{ $producto->detalles_tecnicos }}</p>
    @endif
    <p><strong>Mostrar en inicio:</strong> {{ $producto->mostrar_inicio ? 'Sí' : 'No' }}</p>

    <div style="margin-top:15px;">
        <a href="{{ route('admin.productos.edit', $producto->id_producto) }}"
           style="padding:8px 16px;background:#2563eb;color:white;border-radius:6px;text-decoration:none;">
            Editar
        </a>
        <a href="{{ route('admin.productos.index') }}" style="margin-left:10px;color:#64748b;">
            ← Volver
        </a>
    </div>
</div>

@endsection
