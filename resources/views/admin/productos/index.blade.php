@extends('layouts.admin')

@section('content')

<div class="admin-header">
    <h1> Productos</h1>
    <a href="{{ route('admin.productos.create') }}" class="btn-primary">+ Nuevo producto</a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Stock</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Destacado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->marca }}</td>
            <td>{{ $producto->stock }}</td>
            <td>{{ $producto->categoria->nombre_categoria ?? 'Sin categoría' }}</td>
            <td>S/ {{ number_format($producto->precio, 2) }}</td>
            <td>
                @if($producto->mostrar_inicio)
                    <span class="badge-si">✅ Sí</span>
                @else
                    <span class="badge-no">No</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.productos.edit', $producto->id_producto) }}" class="btn-editar">✏️ Editar</a>
                <form action="{{ route('admin.productos.destroy', $producto->id_producto) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-eliminar" onclick="return confirm('¿Eliminar este producto?')">🗑️ Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
