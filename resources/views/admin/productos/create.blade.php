@extends('layouts.admin')

@section('title', 'Crear Producto')

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <div>
            <h1>➕ Crear Producto</h1>
            <p style="color:#6b7280;">Agrega productos con imágenes, stock y variantes</p>
        </div>

        <a href="{{ route('admin.productos.index') }}"
           style="background:#6b7280;color:white;padding:8px 12px;border-radius:8px;text-decoration:none;">
            Cancelar
        </a>
    </div>

    <hr style="margin:15px 0;">

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('admin.productos.store') }}"
          enctype="multipart/form-data">

        @csrf

        {{-- NOMBRE --}}
        <div style="margin-bottom:12px;">
            <label>Nombre del producto</label>
            <input type="text"
                   name="nombre"
                   required
                   style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
        </div>

        {{-- PRECIO --}}
        <div style="margin-bottom:12px;">
            <label>Precio</label>
            <input type="number"
                   name="precio"
                   step="0.01"
                   required
                   style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
        </div>

        {{-- STOCK --}}
        <div style="margin-bottom:12px;">
            <label>Stock</label>
            <input type="number"
                   name="stock"
                   required
                   style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
        </div>

        {{-- DESCRIPCIÓN --}}
        <div style="margin-bottom:12px;">
            <label>Descripción</label>
            <textarea name="descripcion"
                      rows="4"
                      style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;"></textarea>
        </div>

        {{-- VARIANTES (COLOR / TALLA) --}}
        <div style="margin-bottom:12px;">
            <label>Variantes (opcional)</label>
            <input type="text"
                   name="variantes"
                   placeholder="Ej: rojo, azul, M, L, XL"
                   style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
        </div>

        {{-- 🔥 DRAG & DROP VISUAL AREA --}}
        <div style="margin-bottom:15px;padding:15px;border:2px dashed #3b82f6;border-radius:10px;text-align:center;background:#f8fafc;">

            <p style="margin-bottom:10px;font-weight:bold;">
                📸 Subir imágenes del producto (máximo 4)
            </p>

            <p style="font-size:12px;color:#6b7280;">
                Arrastra o selecciona archivos
            </p>

        </div>

        {{-- IMÁGENES --}}
        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;">

            <div>
                <label>Imagen 1</label>
                <input type="file" name="imagen_1">
            </div>

            <div>
                <label>Imagen 2</label>
                <input type="file" name="imagen_2">
            </div>

            <div>
                <label>Imagen 3</label>
                <input type="file" name="imagen_3">
            </div>

            <div>
                <label>Imagen 4</label>
                <input type="file" name="imagen_4">
            </div>

        </div>

        {{-- BOTONES --}}
        <div style="margin-top:20px;display:flex;gap:10px;">

            <button type="submit"
                    style="background:#2563eb;color:white;padding:10px 15px;border:none;border-radius:8px;cursor:pointer;">
                💾 Crear Producto
            </button>

            <a href="{{ route('admin.productos.index') }}"
               style="background:#ef4444;color:white;padding:10px 15px;border-radius:8px;text-decoration:none;">
                ❌ Cancelar
            </a>

        </div>

    </form>

</div>

@endsection
