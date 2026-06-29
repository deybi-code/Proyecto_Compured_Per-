@extends('layouts.admin')

@section('title', 'Crear Producto')

@section('content')

<div class="card" style="border-top: 4px solid #0056b3; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">

    {{-- HEADER --}}
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <div>
            <h1 style="color: #0056b3; margin:0;">➕ Crear Producto</h1>
            <p style="color:#6b7280;">Agrega productos con imágenes, stock y variantes</p>
        </div>

        <a href="{{ route('admin.productos.index') }}"
           style="background:#6b7280;color:white;padding:8px 16px;border-radius:8px;text-decoration:none; font-weight: 500;">
            Cancelar
        </a>
    </div>

    <hr style="margin:20px 0; border: 0; border-top: 1px solid #e5e7eb;">

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('admin.productos.store') }}"
          enctype="multipart/form-data">

        @csrf

        {{-- NOMBRE --}}
        <div style="margin-bottom:15px;">
            <label style="display:block; font-weight: 600; margin-bottom: 5px;">Nombre del producto</label>
            <input type="text"
                   name="nombre"
                   required
                   style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px; outline:none; transition: border 0.3s;"
                   onfocus="this.style.borderColor='#0056b3'">
        </div>

        {{-- PRECIO Y STOCK (GRID) --}}
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div style="margin-bottom:15px;">
                <label style="display:block; font-weight: 600; margin-bottom: 5px;">Precio (S/)</label>
                <input type="number"
                       name="precio"
                       step="0.01"
                       required
                       style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
            </div>
            <div style="margin-bottom:15px;">
                <label style="display:block; font-weight: 600; margin-bottom: 5px;">Stock</label>
                <input type="number"
                       name="stock"
                       required
                       style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
            </div>
        </div>

        {{-- DESCRIPCIÓN --}}
        <div style="margin-bottom:15px;">
            <label style="display:block; font-weight: 600; margin-bottom: 5px;">Descripción</label>
            <textarea name="descripcion"
                      rows="4"
                      style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;"></textarea>
        </div>

        {{-- VARIANTES --}}
        <div style="margin-bottom:15px;">
            <label style="display:block; font-weight: 600; margin-bottom: 5px;">Variantes (opcional)</label>
            <input type="text"
                   name="variantes"
                   placeholder="Ej: rojo, azul, M, L, XL"
                   style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
        </div>

        {{-- 🔥 DRAG & DROP VISUAL AREA --}}
        <div style="margin-bottom:20px;padding:25px;border:2px dashed #0056b3;border-radius:10px;text-align:center;background:#f0f9ff;">

            <p style="margin-bottom:5px;font-weight:bold; color: #0056b3;">
                📸 Subir imágenes del producto (máximo 4)
            </p>

            <p style="font-size:12px;color:#6b7280;">
                Arrastra o selecciona tus archivos aquí
            </p>

        </div>

        {{-- IMÁGENES --}}
        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:15px;">

            <div>
                <label style="font-size: 0.9rem; color: #4b5563;">Imagen 1</label>
                <input type="file" name="imagen_1" style="width:100%; margin-top:5px;">
            </div>

            <div>
                <label style="font-size: 0.9rem; color: #4b5563;">Imagen 2</label>
                <input type="file" name="imagen_2" style="width:100%; margin-top:5px;">
            </div>

            <div>
                <label style="font-size: 0.9rem; color: #4b5563;">Imagen 3</label>
                <input type="file" name="imagen_3" style="width:100%; margin-top:5px;">
            </div>

            <div>
                <label style="font-size: 0.9rem; color: #4b5563;">Imagen 4</label>
                <input type="file" name="imagen_4" style="width:100%; margin-top:5px;">
            </div>

        </div>

        {{-- BOTONES --}}
        <div style="margin-top:30px;display:flex;gap:10px;">

            <button type="submit"
                    style="background:#9ad800;color:#000;padding:12px 20px;border:none;border-radius:8px;cursor:pointer; font-weight: 700; flex-grow: 1;">
                💾 Crear Producto
            </button>

            <a href="{{ route('admin.productos.index') }}"
               style="background:#ef4444;color:white;padding:12px 20px;border-radius:8px;text-decoration:none; font-weight: 600;">
                ❌ Cancelar
            </a>

        </div>

    </form>

</div>

@endsection
