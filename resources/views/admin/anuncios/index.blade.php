@extends('layouts.admin')

@section('title', 'Anuncios')

@section('content')

<div class="card">
    <h2>Gestión de Anuncios</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <h3 style="margin-top:20px;">Agregar Anuncio</h3>
    <form action="{{ route('admin.anuncios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($errors->any())
            <div style="color:red;margin-bottom:10px;">
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <div style="margin-bottom:12px;">
            <label>Título</label><br>
            <input type="text" name="titulo" value="{{ old('titulo') }}"
                   style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">
        </div>

        <div style="margin-bottom:12px;">
            <label>Posición</label><br>
            <select name="posicion" style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">
                <option value="principal">Principal</option>
                <option value="secundario">Secundario</option>
                <option value="lateral">Lateral</option>
            </select>
        </div>

        <div style="margin-bottom:15px;">
            <label>Imagen (jpeg, png, jpg, gif, webp — máx. 2MB)</label><br>
            <input type="file" name="imagen" accept="image/*">
        </div>

        <button type="submit"
                style="padding:10px 20px;background:#2563eb;color:white;border:none;border-radius:6px;cursor:pointer;">
            Publicar Anuncio
        </button>
    </form>
</div>

<div class="card">
    <h3>Anuncios Publicados</h3>

    @if($anuncios->isEmpty())
        <p>No hay anuncios publicados aún.</p>
    @else
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f1f5f9;">
                    <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Imagen</th>
                    <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Título</th>
                    <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Posición</th>
                    <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Activo</th>
                    <th style="padding:10px;text-align:left;border-bottom:1px solid #e2e8f0;">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anuncios as $anuncio)
                <tr style="border-bottom:1px solid #e2e8f0;">
                    <td style="padding:10px;">
                        <img src="{{ $anuncio->imagen_url && str_starts_with($anuncio->imagen_url, 'http') ? $anuncio->imagen_url : asset('storage/' . $anuncio->imagen_url) }}"
                             alt="{{ $anuncio->titulo }}"
                             style="width:80px;height:50px;object-fit:cover;border-radius:4px;">
                    </td>
                    <td style="padding:10px;">{{ $anuncio->titulo }}</td>
                    <td style="padding:10px;">{{ ucfirst($anuncio->posicion) }}</td>
                    <td style="padding:10px;">{{ $anuncio->activo ? '✔ Sí' : '✘ No' }}</td>
                    <td style="padding:10px;">
                        <form action="{{ route('admin.anuncios.destroy', $anuncio->id_anuncio) }}"
                              method="POST" onsubmit="return confirm('¿Eliminar este anuncio?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color:red;background:none;border:none;cursor:pointer;">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
