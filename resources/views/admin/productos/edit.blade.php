@extends('layouts.admin')

@section('title', 'Editar Producto')

@section('content')

<div class="card" style="border-radius:12px; box-shadow:0 10px 15px -3px rgba(0,0,0,0.1); padding:30px; border-top:5px solid #0056b3;">

    {{-- HEADER --}}
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h1 style="color:#0056b3; font-size:24px; margin:0 0 5px 0;">✏️ Editar Producto</h1>
            <p style="color:#64748b; margin:0; font-size:14px;">Actualiza información, imágenes y stock</p>
        </div>
        <a href="{{ route('admin.productos.index') }}"
            style="background:#f1f5f9; color:#475569; padding:10px 20px; border-radius:8px; text-decoration:none; font-weight:600; border:1px solid #cbd5e1;">
            ← Volver
        </a>
    </div>

    <hr style="margin:25px 0; border:none; border-top:1px solid #e2e8f0;">

    {{-- ALERTAS --}}
    @if(session('success'))
        <div style="background:#dcfce7; border:1px solid #bbf7d0; color:#15803d; padding:12px 16px; border-radius:8px; margin-bottom:20px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#fee2e2; border:1px solid #fecaca; color:#b91c1c; padding:12px 16px; border-radius:8px; margin-bottom:20px;">
            <strong>⚠️ Errores:</strong>
            <ul style="margin:6px 0 0 20px;">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM DATOS --}}
    <form method="POST"
          action="{{ route('admin.productos.update', $producto->id_producto) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <input type="hidden" name="marca" value="{{ $producto->marca }}">
        <input type="hidden" name="id_categoria" value="{{ $producto->id_categoria }}">

        {{-- NOMBRE --}}
        <div style="margin-bottom:18px;">
            <label style="display:block; color:#334155; font-weight:600; margin-bottom:6px;">Nombre del producto</label>
            <input type="text" name="nombre" value="{{ $producto->nombre }}" required
                   style="width:100%; padding:12px; border:1px solid #cbd5e1; border-radius:8px; background:#f8fafc; font-size:15px; outline:none;">
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:18px;">
            <div>
                <label style="display:block; color:#334155; font-weight:600; margin-bottom:6px;">Precio (S/)</label>
                <input type="number" name="precio" value="{{ $producto->precio }}" step="0.01" required
                       style="width:100%; padding:12px; border:1px solid #cbd5e1; border-radius:8px; background:#f8fafc; font-size:15px; outline:none;">
            </div>
            <div>
                <label style="display:block; color:#334155; font-weight:600; margin-bottom:6px;">Stock</label>
                <input type="number" name="stock" value="{{ $producto->stock }}" required
                       style="width:100%; padding:12px; border:1px solid #cbd5e1; border-radius:8px; background:#f8fafc; font-size:15px; outline:none;">
            </div>
        </div>

        <div style="margin-bottom:18px;">
            <label style="display:block; color:#334155; font-weight:600; margin-bottom:6px;">Detalles Técnicos</label>
            <textarea name="detalles_tecnicos" rows="4"
                      style="width:100%; padding:12px; border:1px solid #cbd5e1; border-radius:8px; background:#f8fafc; font-size:15px; outline:none; resize:vertical;">{{ $producto->detalles_tecnicos }}</textarea>
        </div>

        {{-- MOSTRAR EN INICIO --}}
        <div style="margin-bottom:24px; padding:14px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; display:flex; align-items:center; gap:10px;">
            <input type="checkbox" name="mostrar_inicio" id="mostrar_inicio" value="1"
                   {{ $producto->mostrar_inicio ? 'checked' : '' }}
                   style="width:18px; height:18px; cursor:pointer; accent-color:#0056b3;">
            <label for="mostrar_inicio" style="font-weight:600; cursor:pointer; margin:0;">
                ⭐ Mostrar en la página de inicio
            </label>
        </div>

        {{-- BOTÓN GUARDAR DATOS --}}
        <div style="margin-bottom:30px;">
            <button type="submit"
                    style="background:#0056b3; color:white; padding:12px 24px; border:none; border-radius:8px; cursor:pointer; font-weight:700; font-size:15px;">
                💾 Guardar cambios
            </button>
        </div>

    </form>

    <hr style="margin:0 0 28px 0; border:none; border-top:2px solid #e2e8f0;">

    {{-- ===== GESTIÓN DE FOTOS (formularios separados) ===== --}}
    <h3 style="color:#0056b3; margin:0 0 18px 0; font-size:18px;">📸 Gestión de imágenes</h3>

    {{-- IMAGEN PRINCIPAL --}}
    <div style="background:#f0f9ff; border:1px solid #bae6fd; border-radius:12px; padding:20px; margin-bottom:20px;">
        <h4 style="margin:0 0 14px 0; color:#0369a1;">🖼️ Imagen principal del producto</h4>

        @if($producto->imagen)
            <div style="display:flex; align-items:center; gap:16px; flex-wrap:wrap;">
                <img src="{{ str_starts_with($producto->imagen, 'http') ? $producto->imagen : asset('storage/'.$producto->imagen) }}"
                     style="width:120px; height:120px; object-fit:cover; border-radius:10px; border:2px solid #bae6fd;">

                <div style="flex:1; min-width:200px;">
                    <p style="color:#0369a1; font-size:13px; margin:0 0 10px 0;">Para reemplazarla, sube una nueva imagen:</p>

                    <form method="POST"
                          action="{{ route('admin.productos.update', $producto->id_producto) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- Campos hidden para que la validación no falle --}}
                        <input type="hidden" name="nombre" value="{{ $producto->nombre }}">
                        <input type="hidden" name="precio" value="{{ $producto->precio }}">
                        <input type="hidden" name="stock" value="{{ $producto->stock }}">
                        <input type="hidden" name="marca" value="{{ $producto->marca }}">
                        <input type="hidden" name="id_categoria" value="{{ $producto->id_categoria }}">
                        <input type="hidden" name="mostrar_inicio" value="{{ $producto->mostrar_inicio ? 1 : 0 }}">

                        <input type="file" name="imagen_principal" accept="image/*"
                               style="margin-bottom:10px; display:block;">

                        <button type="submit"
                                style="background:#0056b3; color:white; padding:8px 16px; border:none; border-radius:6px; cursor:pointer; font-weight:600; font-size:13px;">
                            🔄 Reemplazar imagen principal
                        </button>
                    </form>
                </div>
            </div>
        @else
            <p style="color:#64748b; margin:0 0 12px 0;">No hay imagen principal.</p>
            <form method="POST"
                  action="{{ route('admin.productos.update', $producto->id_producto) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="nombre" value="{{ $producto->nombre }}">
                <input type="hidden" name="precio" value="{{ $producto->precio }}">
                <input type="hidden" name="stock" value="{{ $producto->stock }}">
                <input type="hidden" name="marca" value="{{ $producto->marca }}">
                <input type="hidden" name="id_categoria" value="{{ $producto->id_categoria }}">
                <input type="hidden" name="mostrar_inicio" value="{{ $producto->mostrar_inicio ? 1 : 0 }}">

                <input type="file" name="imagen_principal" accept="image/*" style="margin-bottom:10px; display:block;">
                <button type="submit"
                        style="background:#0056b3; color:white; padding:8px 16px; border:none; border-radius:6px; cursor:pointer; font-weight:600; font-size:13px;">
                    ⬆️ Subir imagen principal
                </button>
            </form>
        @endif
    </div>

    {{-- FOTOS ADICIONALES --}}
    <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:20px; margin-bottom:20px;">
        <h4 style="margin:0 0 14px 0; color:#334155;">📷 Fotos adicionales del producto</h4>

        {{-- FOTOS EXISTENTES --}}
        @if($producto->fotos->count() > 0)
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:14px; margin-bottom:20px;">
                @foreach($producto->fotos as $foto)
                <div style="background:white; border-radius:10px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 2px 4px rgba(0,0,0,0.06);">
                    <img src="{{ str_starts_with($foto->ruta_foto, 'http') ? $foto->ruta_foto : asset('storage/'.$foto->ruta_foto) }}"
                         style="width:100%; height:130px; object-fit:cover; display:block;">
                    <div style="padding:8px;">
                        {{-- Botón eliminar esta foto --}}
                        <form method="POST" action="{{ route('admin.fotos.destroy', $foto->id_foto) }}"
                              onsubmit="return confirm('¿Eliminar esta foto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="width:100%; background:#fee2e2; color:#b91c1c; border:1px solid #fecaca; border-radius:6px; padding:6px; cursor:pointer; font-size:12px; font-weight:600;">
                                🗑 Eliminar
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div style="padding:16px; background:#fff7ed; border:1px solid #fed7aa; border-radius:8px; color:#c2410c; margin-bottom:16px; font-size:13px;">
                ⚠️ Este producto no tiene fotos adicionales aún.
            </div>
        @endif

        {{-- AGREGAR NUEVAS FOTOS --}}
        <div style="border:2px dashed #cbd5e1; border-radius:10px; padding:16px;">
            <p style="font-weight:600; color:#475569; margin:0 0 10px 0;">➕ Agregar nuevas fotos (puedes subir hasta 4 a la vez)</p>
            <form method="POST" action="{{ route('admin.fotos.store', $producto->id_producto) }}"
                  enctype="multipart/form-data">
                @csrf

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:12px;">
                    @foreach([1,2,3,4] as $n)
                    <div style="border:1px solid #e2e8f0; border-radius:8px; padding:10px; background:white;">
                        <label style="font-size:12px; color:#64748b; display:block; margin-bottom:5px; font-weight:600;">Foto {{ $n }}</label>
                        <input type="file" name="fotos[]" accept="image/*"
                               style="width:100%; font-size:12px;"
                               onchange="previewFoto(this, 'prev{{$n}}')">
                        <img id="prev{{$n}}" src="" alt=""
                             style="display:none; width:100%; height:70px; object-fit:cover; border-radius:6px; margin-top:6px;">
                    </div>
                    @endforeach
                </div>

                <button type="submit"
                        style="background:#9ad800; color:#0f172a; padding:10px 20px; border:none; border-radius:8px; cursor:pointer; font-weight:700; font-size:14px;">
                    ⬆️ Subir fotos seleccionadas
                </button>
            </form>
        </div>
    </div>

</div>

<script>
function previewFoto(input, id) {
    const img = document.getElementById(id);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; img.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
