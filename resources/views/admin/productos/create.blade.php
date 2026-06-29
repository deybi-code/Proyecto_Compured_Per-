@extends('layouts.admin')

@section('title', 'Nuevo Producto')

@section('content')

<div class="card">
    <h2>Nuevo Producto</h2>

    @if($errors->any())
        <div style="color:red;margin-bottom:15px;">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.productos.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:12px;">
            <label>Nombre</label><br>
            <input type="text" name="nombre" value="{{ old('nombre') }}"
                   style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">
        </div>

        <div style="margin-bottom:12px;">
            <label>Categoría</label><br>
            <select name="id_categoria" style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">
                <option value="">— Selecciona —</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id_categoria }}" {{ old('id_categoria') == $cat->id_categoria ? 'selected' : '' }}>
                        {{ $cat->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="display:flex;gap:15px;margin-bottom:12px;">
            <div style="flex:1;">
                <label>Precio (S/)</label><br>
                <input type="number" name="precio" step="0.01" value="{{ old('precio') }}"
                       style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">
            </div>
            <div style="flex:1;">
                <label>Stock</label><br>
                <input type="number" name="stock" value="{{ old('stock') }}"
                       style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">
            </div>
        </div>

        <div style="margin-bottom:12px;">
            <label>Marca</label><br>
            <input type="text" name="marca" value="{{ old('marca') }}"
                   style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">
        </div>

        <div style="margin-bottom:12px;">
            <label>Detalles Técnicos</label><br>
            <textarea name="detalles_tecnicos" rows="4"
                      style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">{{ old('detalles_tecnicos') }}</textarea>
        </div>

        <div style="margin-bottom:15px;">
            <label>
                <input type="checkbox" name="mostrar_inicio" value="1" {{ old('mostrar_inicio') ? 'checked' : '' }}>
                Mostrar en inicio
            </label>
        </div>

        <button type="submit"
                style="padding:10px 20px;background:#2563eb;color:white;border:none;border-radius:6px;cursor:pointer;">
            Guardar Producto
        </button>
        <a href="{{ route('admin.productos.index') }}" style="margin-left:10px;color:#64748b;">Cancelar</a>
    </form>
</div>

@endsection
