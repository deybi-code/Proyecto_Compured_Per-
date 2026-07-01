@extends('layouts.admin')

@section('title', 'Editar Producto')

@section('content')

<div class="card" style="background:#ffffff; border-radius:12px; box-shadow:0 10px 15px -3px rgba(0,0,0,0.1); padding:30px; border-top:5px solid #0056b3;">

    {{-- HEADER --}}
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h1 style="color:#0056b3; font-size:24px; margin:0 0 5px 0;">✏️ Editar Producto</h1>
            <p style="color:#64748b; margin:0; font-size:14px;">Actualiza información, imágenes y stock del producto</p>
        </div>

        <a href="{{ route('admin.productos.index') }}"
           style="background:#f1f5f9; color:#475569; padding:10px 20px; border-radius:8px; text-decoration:none; font-weight:600; border:1px solid #cbd5e1;">
            ← Volver
        </a>
    </div>

    <hr style="margin:25px 0; border:none; border-top:1px solid #e2e8f0;">

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('admin.productos.update', $producto->id_producto) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- CAMPOS OBLIGATORIOS (Ocultos para no romper tu diseño) --}}
        <input type="hidden" name="marca" value="{{ $producto->marca }}">
        <input type="hidden" name="id_categoria" value="{{ $producto->id_categoria }}">

        {{-- NOMBRE --}}
        <div style="margin-bottom:20px;">
            <label style="display:block; color:#334155; font-weight:600; margin-bottom:8px;">Nombre del producto</label>
            <input type="text"
                   name="nombre"
                   value="{{ $producto->nombre }}"
                   required
                   style="width:100%; padding:12px 15px; border:1px solid #cbd5e1; border-radius:8px; outline:none; background:#f8fafc; font-size:15px;">
        </div>

        <div style="display:flex; gap:20px; margin-bottom:20px; flex-wrap:wrap;">
            {{-- PRECIO --}}
            <div style="flex:1; min-width:200px;">
                <label style="display:block; color:#334155; font-weight:600; margin-bottom:8px;">Precio (S/)</label>
                <input type="number"
                       name="precio"
                       value="{{ $producto->precio }}"
                       step="0.01"
                       required
                       style="width:100%; padding:12px 15px; border:1px solid #cbd5e1; border-radius:8px; outline:none; background:#f8fafc; font-size:15px;">
            </div>

            {{-- STOCK --}}
            <div style="flex:1; min-width:200px;">
                <label style="display:block; color:#334155; font-weight:600; margin-bottom:8px;">Stock</label>
                <input type="number"
                       name="stock"
                       value="{{ $producto->stock }}"
                       required
                       style="width:100%; padding:12px 15px; border:1px solid #cbd5e1; border-radius:8px; outline:none; background:#f8fafc; font-size:15px;">
            </div>
        </div>

        {{-- DESCRIPCIÓN CORREGIDA --}}
        <div style="margin-bottom:20px;">
            <label style="display:block; color:#334155; font-weight:600; margin-bottom:8px;">Detalles Técnicos</label>
            <textarea name="detalles_tecnicos"
                      rows="4"
                      style="width:100%; padding:12px 15px; border:1px solid #cbd5e1; border-radius:8px; outline:none; background:#f8fafc; font-size:15px;">{{ $producto->detalles_tecnicos }}</textarea>
        </div>
{{-- VARIANTES --}}
        <div style="margin-bottom:30px;">
            <label style="display:block; color:#334155; font-weight:600; margin-bottom:8px;">Variantes (tallas, colores, etc)</label>
            <input type="text"
                   name="variantes"
                   value="{{ $producto->variantes ?? '' }}"
                   placeholder="Ej: rojo, azul, M, L"
                   style="width:100%; padding:12px 15px; border:1px solid #cbd5e1; border-radius:8px; outline:none; background:#f8fafc; font-size:15px;">
        </div>

        {{-- 🔥 IMÁGENES ACTUALES (CORREGIDO: USANDO RELACIÓN FOTOS) --}}
        <div style="background:#f0f9ff; border:1px solid #bae6fd; border-radius:12px; padding:20px; margin-bottom:25px;">
            <h3 style="color:#0369a1; margin:0 0 15px 0; font-size:18px;">📸 Imágenes actuales</h3>

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(150px, 1fr)); gap:15px;">
                @forelse($producto->fotos as $foto)
                    <div style="background:#ffffff; padding:5px; border-radius:10px; border:1px solid #e0f2fe; box-shadow:0 2px 4px rgba(0,0,0,0.05);">
                        <img src="{{ str_starts_with($foto->ruta_foto, 'http') ? $foto->ruta_foto : asset('storage/'.$foto->ruta_foto) }}" style="width:100%; height:150px; object-fit:cover; border-radius:6px;">
                    </div>
                @empty
                    <p>No hay fotos cargadas.</p>
                @endforelse
            </div>
        </div>

        {{-- 🔥 NUEVAS IMÁGENES (CORREGIDO: CAMPO ÚNICO PARA SUBIR) --}}
        <div style="border:1px dashed #cbd5e1; border-radius:12px; padding:20px; margin-bottom:30px;">
            <div style="margin-bottom:15px;">
                <h3 style="color:#0056b3; margin:0 0 5px 0; font-size:18px;">🆕 Reemplazar imágenes</h3>
                <p style="color:#64748b; font-size:13px; margin:0;">
                    Selecciona nuevos archivos para actualizar.
                </p>
            </div>

            <div style="background:#f8fafc; padding:15px; border-radius:8px; border:1px solid #e2e8f0;">
                <label style="display:block; font-weight:600; color:#475569; margin-bottom:8px; font-size:14px;">Subir imágenes</label>
                <input type="file" name="fotos[]" multiple style="width:100%; font-size:13px;">
            </div>
        </div>

        {{-- BOTONES --}}
        <div style="display:flex; gap:15px; border-top:1px solid #e2e8f0; padding-top:20px;">
            <button type="submit"
                    style="background:#9ad800; color:#0f172a; padding:12px 25px; border:none; border-radius:8px; cursor:pointer; font-weight:bold; font-size:15px; box-shadow:0 4px 6px -1px rgba(154,216,0,0.3);">
                💾 Guardar Cambios
            </button>
            <a href="{{ route('admin.productos.index') }}"
               style="background:#ffffff; color:#ef4444; padding:12px 25px; border:1px solid #fca5a5; border-radius:8px; text-decoration:none; font-weight:bold; font-size:15px;">
                ❌ Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
