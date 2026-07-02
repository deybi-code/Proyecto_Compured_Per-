@extends('layouts.admin')

@section('title', 'Crear Producto')

@section('content')

<div class="card" style="border-top: 4px solid #0056b3; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">

    {{-- HEADER --}}
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <div>
            <h1 style="color: #0056b3; margin:0;">➕ Crear Producto</h1>
            <p style="color:#6b7280; margin-top:4px;">Completa todos los campos requeridos</p>
        </div>
        <a href="{{ route('admin.productos.index') }}"
           style="background:#6b7280;color:white;padding:8px 16px;border-radius:8px;text-decoration:none;font-weight:500;">
            ← Volver
        </a>
    </div>

    <hr style="margin:20px 0; border:0; border-top:1px solid #e5e7eb;">

    {{-- ERRORES DE VALIDACIÓN --}}
    @if($errors->any())
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#991b1b;padding:16px;border-radius:8px;margin-bottom:20px;">
            <strong>⚠️ Corrige los siguientes errores:</strong>
            <ul style="margin:8px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORMULARIO --}}
    <form method="POST"
          action="{{ route('admin.productos.store') }}"
          enctype="multipart/form-data">

        @csrf

        {{-- NOMBRE --}}
        <div style="margin-bottom:15px;">
            <label style="display:block;font-weight:600;margin-bottom:5px;">
                Nombre del producto <span style="color:#ef4444;">*</span>
            </label>
            <input type="text"
                   name="nombre"
                   value="{{ old('nombre') }}"
                   required
                   placeholder="Ej: SSD Kingston 500GB NVMe"
                   style="width:100%;padding:12px;border:1px solid {{ $errors->has('nombre') ? '#ef4444' : '#d1d5db' }};border-radius:8px;outline:none;transition:border 0.3s;"
                   onfocus="this.style.borderColor='#0056b3'"
                   onblur="this.style.borderColor='#d1d5db'">
        </div>

        {{-- PRECIO, STOCK Y MARCA --}}
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:15px;margin-bottom:15px;">
            <div>
                <label style="display:block;font-weight:600;margin-bottom:5px;">
                    Precio (S/) <span style="color:#ef4444;">*</span>
                </label>
                <input type="number"
                       name="precio"
                       value="{{ old('precio') }}"
                       step="0.01"
                       min="0"
                       required
                       placeholder="0.00"
                       style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
            </div>
            <div>
                <label style="display:block;font-weight:600;margin-bottom:5px;">
                    Stock <span style="color:#ef4444;">*</span>
                </label>
                <input type="number"
                       name="stock"
                       value="{{ old('stock') }}"
                       min="0"
                       required
                       placeholder="0"
                       style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
            </div>
            <div>
                <label style="display:block;font-weight:600;margin-bottom:5px;">
                    Marca <span style="color:#ef4444;">*</span>
                </label>
                <input type="text"
                       name="marca"
                       value="{{ old('marca') }}"
                       required
                       placeholder="Ej: Kingston, Samsung, HP"
                       style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
            </div>
        </div>

        {{-- DESCUENTO --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:15px;">
            <div>
                <label style="display:block;font-weight:600;margin-bottom:5px;">
                    Precio con Descuento (S/) - Opcional
                </label>
                <input type="number"
                       name="precio_descuento"
                       value="{{ old('precio_descuento') }}"
                       step="0.01"
                       min="0"
                       placeholder="0.00"
                       style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
                <small style="color:#6b7280;font-size:12px;">Dejar vacío si no hay descuento</small>
            </div>
            <div>
                <label style="display:block;font-weight:600;margin-bottom:5px;">
                    Porcentaje de Descuento (%) - Opcional
                </label>
                <input type="number"
                       name="porcentaje_descuento"
                       value="{{ old('porcentaje_descuento') }}"
                       step="0.01"
                       min="0"
                       placeholder="Ej: 20"
                       style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;">
                <small style="color:#6b7280;font-size:12px;">Ej: 20 para 20% de descuento</small>
            </div>
        </div>

        {{-- CATEGORÍA --}}
        <div style="margin-bottom:15px;">
            <label style="display:block;font-weight:600;margin-bottom:5px;">
                Categoría <span style="color:#ef4444;">*</span>
            </label>
            <select name="id_categoria"
                    required
                    style="width:100%;padding:12px;border:1px solid {{ $errors->has('id_categoria') ? '#ef4444' : '#d1d5db' }};border-radius:8px;background:white;font-size:14px;">
                <option value="">— Selecciona una categoría —</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id_categoria }}"
                        {{ old('id_categoria') == $cat->id_categoria ? 'selected' : '' }}>
                        {{ $cat->nombre_categoria }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- DETALLES TÉCNICOS --}}
        <div style="margin-bottom:15px;">
            <label style="display:block;font-weight:600;margin-bottom:5px;">
                Descripción / Detalles técnicos
            </label>
            <textarea name="detalles_tecnicos"
                      rows="4"
                      placeholder="Especificaciones técnicas, características destacadas, etc."
                      style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;resize:vertical;">{{ old('detalles_tecnicos') }}</textarea>
        </div>

        {{-- IMAGEN PRINCIPAL --}}
        <div style="margin-bottom:20px;">
            <label style="display:block;font-weight:600;margin-bottom:8px;">
                🖼️ Imagen principal
            </label>
            <div style="padding:20px;border:2px dashed #0056b3;border-radius:10px;background:#f0f9ff;text-align:center;">
                <p style="margin-bottom:8px;color:#6b7280;font-size:13px;">JPG, PNG o WEBP — máx. 2MB</p>
                <input type="file"
                       name="imagen_principal"
                       accept="image/*"
                       style="width:100%;"
                       onchange="previewImg(this,'prev-principal')">
                <img id="prev-principal" src="" alt=""
                     style="display:none;max-height:120px;margin-top:10px;border-radius:8px;object-fit:contain;">
            </div>
        </div>

        {{-- IMÁGENES ADICIONALES --}}
        <div style="margin-bottom:20px;">
            <label style="display:block;font-weight:600;margin-bottom:8px;">
                📸 Imágenes adicionales (opcional, máx. 4)
            </label>
            <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:12px;">
                @foreach([1,2,3,4] as $n)
                <div style="border:1px solid #e5e7eb;border-radius:8px;padding:12px;text-align:center;">
                    <label style="font-size:12px;color:#6b7280;display:block;margin-bottom:6px;">Imagen {{ $n }}</label>
                    <input type="file"
                           name="imagen_{{ $n }}"
                           accept="image/*"
                           style="width:100%;"
                           onchange="previewImg(this,'prev-{{ $n }}')">
                    <img id="prev-{{ $n }}" src="" alt=""
                         style="display:none;max-height:80px;margin-top:8px;border-radius:6px;object-fit:contain;">
                </div>
                @endforeach
            </div>
        </div>

        {{-- MOSTRAR EN HOME --}}
        <div style="margin-bottom:25px;padding:16px;background:#f8fafc;border:1px solid #e5e7eb;border-radius:8px;display:flex;align-items:center;gap:12px;">
            <input type="checkbox"
                   name="mostrar_inicio"
                   id="mostrar_inicio"
                   value="1"
                   {{ old('mostrar_inicio') ? 'checked' : '' }}
                   style="width:18px;height:18px;cursor:pointer;accent-color:#0056b3;">
            <label for="mostrar_inicio" style="font-weight:600;cursor:pointer;margin:0;">
                ⭐ Mostrar este producto en la página de inicio
            </label>
        </div>

        {{-- BOTONES --}}
        <div style="display:flex;gap:10px;">
            <button type="submit"
                    style="background:#0056b3;color:white;padding:14px 24px;border:none;border-radius:8px;cursor:pointer;font-weight:700;font-size:15px;flex-grow:1;transition:background 0.2s;"
                    onmouseover="this.style.background='#003d82'"
                    onmouseout="this.style.background='#0056b3'">
                💾 Crear Producto
            </button>
            <a href="{{ route('admin.productos.index') }}"
               style="background:#6b7280;color:white;padding:14px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:inline-flex;align-items:center;">
                Cancelar
            </a>
        </div>

    </form>

</div>

{{-- PREVIEW JS --}}
<script>
function previewImg(input, targetId) {
    const target = document.getElementById(targetId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            target.src = e.target.result;
            target.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
