@extends('layouts.admin')

@section('title', 'Productos')

@section('content')

<div class="card">
    <h2>Gestión de Productos</h2>
    <a href="{{ route('admin.productos.create') }}" style="display:inline-block;margin-bottom:15px;padding:8px 16px;background:#2563eb;color:white;border-radius:6px;text-decoration:none;">
        + Nuevo Producto
    </a>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if($productos->isEmpty())
        <p>No hay productos registrados.</p>
    @else
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f1f5f9;">
                    <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Nombre</th>
                    <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Categoría</th>
                    <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Precio</th>
                    <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Stock</th>
                    <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Marca</th>
                    <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr style="border-bottom:1px solid #e2e8f0;">
                    <td style="padding:10px;">{{ $producto->nombre }}</td>
                    <td style="padding:10px;">{{ $producto->categoria->nombre ?? '—' }}</td>
                    <td style="padding:10px;">S/ {{ number_format($producto->precio, 2) }}</td>
                    <td style="padding:10px;">{{ $producto->stock }}</td>
                    <td style="padding:10px;">{{ $producto->marca }}</td>
                    <td style="padding:10px;">
                        <a href="{{ route('admin.productos.edit', $producto->id_producto) }}"
                           style="color:#2563eb;margin-right:10px;">Editar</a>
                        <form action="{{ route('admin.productos.destroy', $producto->id_producto) }}"
                              method="POST" style="display:inline;"
                              onsubmit="return confirm('¿Eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color:red;background:none;border:none;cursor:pointer;">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
