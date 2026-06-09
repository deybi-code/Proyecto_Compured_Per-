@extends('layouts.admin')

@section('content')

<div class="admin-header">
    <h1>➕ Crear producto</h1>
    <a href="{{ route('admin.productos.index') }}" class="btn-primary">← Volver</a>
</div>

<div class="admin-form">
    <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" placeholder="Nombre del producto" required>
        </div>

        <div class="form-group">
            <label>Marca</label>
            <input type="text" name="marca" placeholder="Ej. ASUS, Intel, HP" required>
        </div>

        <div class="form-group">
            <label>Stock Inicial</label>
            <input type="number" name="stock" placeholder="0" min="0" required>
        </div>

        <div class="form-group">
            <label>Precio (S/)</label>
            <input type="number" step="0.01" name="precio" placeholder="0.00" required>
        </div>

        <div class="form-group">
            <label>Categoría</label>
            <select name="id_categoria" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Detalles Técnicos</label>
            <textarea name="detalles_tecnicos" placeholder="Especificaciones y descripción del producto"></textarea>
        </div>

        <div class="form-group">
            <label class="form-check">
                <input type="checkbox" name="mostrar_inicio" value="1">
                Mostrar en "Los más valorados"
            </label>
        </div>

        <button type="submit" class="btn-primary">Guardar producto</button>
    </form>
</div>

@endsection
