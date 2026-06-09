@extends('layouts.admin')

@section('content')

<div class="admin-header">
    <h1>✏️ Editar producto</h1>
    <a href="{{ route('admin.productos.index') }}" class="btn-primary">← Volver</a>
</div>

<div class="admin-form">
    <form method="POST" action="{{ route('admin.productos.update', $producto->id_producto) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ $producto->nombre }}" required>
        </div>

        <div class="form-group">
            <label>Marca</label>
            <input type="text" name="marca" value="{{ $producto->marca }}" required>
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock" value="{{ $producto->stock }}" min="0" required>
        </div>

        <div class="form-group">
            <label>Precio (S/)</label>
            <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required>
        </div>

        <div class="form-group">
            <label>Categoría</label>
            <select name="id_categoria" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}" {{ $producto->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>
                        {{ $categoria->nombre_categoria }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Detalles Técnicos</label>
            <textarea name="detalles_tecnicos">{{ $producto->detalles_tecnicos }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-check">
                <input type="checkbox" name="mostrar_inicio" value="1" {{ $producto->mostrar_inicio ? 'checked' : '' }}>
                Mostrar en "Los más valorados"
            </label>
        </div>

        <button type="submit" class="btn-primary">Guardar cambios</button>
    </form>
</div>

@endsection
