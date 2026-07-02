@extends('layouts.admin')

@section('title', 'Anuncios')

@section('content')

<div class="card" style="border-top: 4px solid #f59e0b; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
        <div>
            <h1 style="color: #f59e0b; margin:0;">📢 Gestión de Anuncios</h1>
            <p style="color:#6b7280; margin:5px 0 0 0;">Administra los anuncios que aparecen en el home</p>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#dcfce7;color:#166534;padding:12px 16px;border-radius:8px;margin-top:20px;border:1px solid #86efac;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;color:#991b1b;padding:12px 16px;border-radius:8px;margin-top:20px;border:1px solid #fca5a5;">
            {{ session('error') }}
        </div>
    @endif

    <div style="margin-top:30px;">
        <h3 style="color:#374151; font-size:18px; margin-bottom:15px;">➕ Agregar Nuevo Anuncio</h3>
        <form action="{{ route('admin.anuncios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if($errors->any())
                <div style="background:#fee2e2;color:#991b1b;padding:12px 16px;border-radius:8px;margin-bottom:15px;border:1px solid #fca5a5;">
                    <ul style="margin:0;padding-left:20px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap:20px;">
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Título del anuncio</label>
                    <input type="text" name="titulo" value="{{ old('titulo') }}"
                           placeholder="Ej: Oferta especial en laptops"
                           style="width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:8px;font-size:14px;">
                </div>

                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Posición en el carrusel</label>
                    <select name="posicion" style="width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:8px;font-size:14px;">
                        <option value="principal">🎯 Principal (segundo slide)</option>
                        <option value="secundario">⭐ Secundario (tercer slide)</option>
                        <option value="lateral">📱 Lateral (cuarto slide)</option>
                    </select>
                </div>
            </div>

            <div style="margin-top:20px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Imágenes del anuncio (máximo 3)</label>
                <input type="file" name="imagenes[]" accept="image/*" multiple
                       style="width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:8px;font-size:14px;">
                <div style="background:#fef3c7;border:1px solid #fcd34d;padding:10px;border-radius:6px;margin-top:8px;">
                    <p style="font-size:12px;color:#92400e;margin:0;">
                        <strong>💡 Tamaño recomendado:</strong> 1200x450px (ancho x alto) para mejor visualización en desktop. En móviles se ajustará automáticamente.
                    </p>
                </div>
                <p style="font-size:12px;color:#6b7280;margin-top:5px;">Formatos: jpeg, png, jpg, gif, webp — máx. 2MB cada una</p>
            </div>

            <div style="margin-top:20px;">
                <button type="submit"
                        style="padding:12px 24px;background:#f59e0b;color:white;border:none;border-radius:8px;cursor:pointer;font-weight:600;font-size:14px;">
                    📢 Publicar Anuncio
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card" style="margin-top:30px;">
    <h3 style="color:#374151; font-size:18px; margin-bottom:20px;">📋 Anuncios Publicados</h3>

    @if($anuncios->isEmpty())
        <div style="background:#f1f5f9;padding:40px;text-align:center;border-radius:12px;border:2px dashed #cbd5e1;">
            <div style="font-size:48px;margin-bottom:15px;">📢</div>
            <p style="color:#6b7280;font-size:16px;margin:0;">No hay anuncios publicados aún.</p>
        </div>
    @else
        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap:20px;">
            @foreach($anuncios as $anuncio)
            <div style="background:white;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;box-shadow:0 2px 4px rgba(0,0,0,0.05);">
                <div style="position:relative;">
                    @if($anuncio->imagen_url)
                        <img src="{{ $anuncio->imagen_url && str_starts_with($anuncio->imagen_url, 'http') ? $anuncio->imagen_url : asset('storage/' . $anuncio->imagen_url) }}"
                             alt="{{ $anuncio->titulo }}"
                             style="width:100%;height:180px;object-fit:cover;">
                    @else
                        <div style="width:100%;height:180px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:48px;">📷</div>
                    @endif
                    <span style="position:absolute;top:10px;right:10px;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;{{ $anuncio->activo ? 'background:#dcfce7;color:#166534;' : 'background:#fee2e2;color:#991b1b;' }}">
                        {{ $anuncio->activo ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
                <div style="padding:16px;">
                    <h4 style="margin:0 0 8px 0;color:#1e293b;font-size:16px;font-weight:700;">{{ $anuncio->titulo }}</h4>
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px;">
                        <span style="padding:4px 10px;background:#f1f5f9;color:#475569;border-radius:6px;font-size:12px;font-weight:600;">
                            {{ ucfirst($anuncio->posicion) }}
                        </span>
                    </div>
                    <div style="display:flex;gap:8px;">
                        <button onclick="editarAnuncio({{ $anuncio->id_anuncio }}, '{{ $anuncio->titulo }}', '{{ $anuncio->posicion }}')"
                                style="flex:1;padding:8px 12px;background:#2563eb;color:white;border:none;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;">
                            ✏️ Editar
                        </button>
                        <form action="{{ route('admin.anuncios.destroy', $anuncio->id_anuncio) }}"
                              method="POST" onsubmit="return confirm('¿Eliminar este anuncio?')" style="flex:1;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="width:100%;padding:8px 12px;background:#ef4444;color:white;border:none;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Modal de edición --}}
<div id="editModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:white;padding:30px;border-radius:12px;max-width:500px;width:90%;box-shadow:0 10px 40px rgba(0,0,0,0.2);">
        <h2 style="margin:0 0 20px 0;color:#f59e0b;">✏️ Editar Anuncio</h2>
        <form action="{{ route('admin.anuncios.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id_anuncio" id="editId">
            
            <div style="margin-bottom:15px;">
                <label style="display:block;font-weight:600;margin-bottom:8px;">Título</label>
                <input type="text" name="titulo" id="editTitulo"
                       style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:6px;">
            </div>
            
            <div style="margin-bottom:15px;">
                <label style="display:block;font-weight:600;margin-bottom:8px;">Posición</label>
                <select name="posicion" id="editPosicion" style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:6px;">
                    <option value="principal">Principal</option>
                    <option value="secundario">Secundario</option>
                    <option value="lateral">Lateral</option>
                </select>
            </div>
            
            <div style="display:flex;gap:10px;">
                <button type="submit" style="flex:1;padding:10px 20px;background:#f59e0b;color:white;border:none;border-radius:6px;cursor:pointer;font-weight:600;">
                    💾 Guardar cambios
                </button>
                <button type="button" onclick="document.getElementById('editModal').style.display='none'"
                        style="flex:1;padding:10px 20px;background:#6b7280;color:white;border:none;border-radius:6px;cursor:pointer;font-weight:600;">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    window.editarAnuncio = function(id, titulo, posicion) {
        const editId = document.getElementById('editId');
        const editTitulo = document.getElementById('editTitulo');
        const editPosicion = document.getElementById('editPosicion');
        const editModal = document.getElementById('editModal');

        if (editId && editTitulo && editPosicion && editModal) {
            editId.value = id;
            editTitulo.value = titulo;
            editPosicion.value = posicion;
            editModal.style.display = 'flex';
        } else {
            console.error('No se encontraron los elementos del modal de edición');
        }
    };

    // Cerrar modal al hacer clic fuera
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.addEventListener('click', function(e) {
            if (e.target === editModal) {
                editModal.style.display = 'none';
            }
        });
    }
});
</script>
@endpush

@endsection
