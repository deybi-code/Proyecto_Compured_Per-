@extends('layouts.admin')

@section('title', 'Editar Producto')

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <div>
            <h1>✏️ Editar Producto</h1>
            <p style="color:#6b7280;">Actualiza información, imágenes y stock del producto</p>
        </div>

        <a href="{{ route('admin.productos.index') }}"
           style="background:#6b7280;color:white;padding:8px 12px;border-radius:8px;text-decoration:none;">
            Volver
        </a>
    </div>

    <hr style="margin:15px 0;">

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('admin.productos.update', $producto) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- NOMBRE --}}
        <div style="margin-bottom:12px;">
            <label>Nombre del producto</label>
            <input type="text"
                   name="nombre"
                   value="{{ $producto->nombre }}"
                   required
                   style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
        </div>

        {{-- PRECIO --}}
        <div style="margin-bottom:12px;">
            <label>Precio</label>
            <input type="number"
                   name="precio"
                   value="{{ $producto->precio }}"
                   step="0.01"
                   required
                   style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
        </div>

        {{-- STOCK --}}
        <div style="margin-bottom:12px;">
            <label>Stock</label>
            <input type="number"
                   name="stock"
                   value="{{ $producto->stock }}"
                   required
                   style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
        </div>

        {{-- DESCRIPCIÓN --}}
        <div style="margin-bottom:12px;">
            <label>Descripción</label>
            <textarea name="descripcion"
                      rows="4"
                      style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">{{ $producto->descripcion }}</textarea>
        </div>

        {{-- VARIANTES --}}
        <div style="margin-bottom:12px;">
            <label>Variantes (tallas, colores, etc)</label>
            <input type="text"
                   name="variantes"
                   value="{{ $producto->variantes ?? '' }}"
                   placeholder="Ej: rojo, azul, M, L"
                   style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
        </div>

        {{-- 🔥 IMÁGENES ACTUALES --}}
        <div style="margin-top:20px;">
            <h3>📸 Imágenes actuales</h3>

            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:10px;">

                @if($producto->imagen_1)
                    <img src="{{ asset('storage/'.$producto->imagen_1) }}" style="width:100%;border-radius:8px;">
                @endif

                @if($producto->imagen_2)
                    <img src="{{ asset('storage/'.$producto->imagen_2) }}" style="width:100%;border-radius:8px;">
                @endif

                @if($producto->imagen_3)
                    <img src="{{ asset('storage/'.$producto->imagen_3) }}" style="width:100%;border-radius:8px;">
                @endif

                @if($producto->imagen_4)
                    <img src="{{ asset('storage/'.$producto->imagen_4) }}" style="width:100%;border-radius:8px;">
                @endif

            </div>
        </div>

        {{-- 🔥 NUEVAS IMÁGENES --}}
        <div style="margin-top:20px;">
            <h3>🆕 Reemplazar imágenes</h3>
            <p style="color:#6b7280;font-size:13px;">
                Solo sube nuevas imágenes si deseas reemplazar las actuales
            </p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin-top:10px;">

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
        <div style="margin-top:25px;display:flex;gap:10px;">

            <button type="submit"
                    style="background:#22c55e;color:white;padding:10px 15px;border:none;border-radius:8px;cursor:pointer;">
                💾 Actualizar Producto
            </button>

            <a href="{{ route('admin.productos.index') }}"
               style="background:#ef4444;color:white;padding:10px 15px;border-radius:8px;text-decoration:none;">
                ❌ Cancelar
            </a>

        </div>

    </form>

</div>

@endsection
