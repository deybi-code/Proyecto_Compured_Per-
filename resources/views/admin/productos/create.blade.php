@extends('layouts.admin')
@section('title', 'Nuevo Producto – Admin Compured Perú')
@section('content')
<div style="max-width:760px">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px">
        <a href="{{ route('admin.productos.index') }}" style="color:#97A0AF;text-decoration:none;font-size:0.82rem" class="hover:text-blue-500">← Volver</a>
        <h1 style="font-family:'Rajdhani',sans-serif;font-size:1.5rem;font-weight:800;color:#172B4D" class="dark:text-white">Nuevo Producto</h1>
    </div>

    <div class="cp-card" style="padding:28px">
        @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)<div>• {{ $error }}</div>@endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
            @csrf
            

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:18px">
                <div style="grid-column:1/-1">
                    <label class="cp-label">Nombre del producto *</label>
                    <input type="text" name="nombre" class="cp-input" value="{{ old('nombre', isset($producto) ? $producto->nombre : '') }}" placeholder="Ej: Laptop Dell Vostro 14" required>
                </div>
                <div>
                    <label class="cp-label">Precio (S/) *</label>
                    <input type="number" name="precio" step="0.01" min="0" class="cp-input" value="{{ old('precio', isset($producto) ? $producto->precio : '') }}" placeholder="0.00" required>
                </div>
                <div>
                    <label class="cp-label">Stock *</label>
                    <input type="number" name="stock" min="0" class="cp-input" value="{{ old('stock', isset($producto) ? $producto->stock : '0') }}" required>
                </div>
                <div>
                    <label class="cp-label">Marca</label>
                    <input type="text" name="marca" class="cp-input" value="{{ old('marca', isset($producto) ? $producto->marca : '') }}" placeholder="Ej: Dell, HP, Lenovo">
                </div>
                <div>
                    <label class="cp-label">Categoría</label>
                    <select name="id_categoria" class="cp-input">
                        <option value="">Sin categoría</option>
                        @if(isset($categorias))
                        @foreach($categorias as $cat)
                        <option value="{{ $cat->id_categoria }}" {{ old('id_categoria', isset($producto) ? $producto->id_categoria : '') == $cat->id_categoria ? 'selected' : '' }}>{{ $cat->nombre_categoria }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div style="grid-column:1/-1">
                    <label class="cp-label">Descripción / Detalles técnicos</label>
                    <textarea name="detalles_tecnicos" class="cp-input" rows="4" placeholder="Especificaciones técnicas del producto...">{{ old('detalles_tecnicos', isset($producto) ? $producto->detalles_tecnicos : '') }}</textarea>
                </div>
                <div>
                    <label class="cp-label">Imagen del producto</label>
                    <input type="file" name="imagen" class="cp-input" accept="image/*" style="padding:7px 14px">
                    @if(isset($producto) && $producto->fotos->first())
                    <div style="margin-top:8px;font-size:0.75rem;color:#97A0AF">Imagen actual registrada</div>
                    @endif
                </div>
                <div style="display:flex;align-items:center;gap:10px;padding-top:20px">
                    <input type="checkbox" name="mostrar_inicio" value="1" id="mostrar_inicio" style="accent-color:#0052CC;width:16px;height:16px" {{ old('mostrar_inicio', isset($producto) ? $producto->mostrar_inicio : false) ? 'checked' : '' }}>
                    <label for="mostrar_inicio" class="cp-label" style="margin:0;cursor:pointer">Mostrar en página de inicio</label>
                </div>
            </div>

            <div style="display:flex;gap:12px;border-top:1px solid #DFE1E6;padding-top:20px" class="dark:border-gray-700">
                <button type="submit" class="btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Crear producto
                </button>
                <a href="{{ route('admin.productos.index') }}" class="btn-outline">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
