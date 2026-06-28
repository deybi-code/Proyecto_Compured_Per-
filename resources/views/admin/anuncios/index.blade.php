@extends('layouts.admin')
@section('title', 'Anuncios – Admin Compured Perú')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px">
    <div>
        <h1 style="font-family:'Rajdhani',sans-serif;font-size:1.6rem;font-weight:800;color:#172B4D" class="dark:text-white">Anuncios / Banners</h1>
        <p style="font-size:0.82rem;color:#97A0AF">Gestión de banners del home</p>
    </div>
    <a href="{{ route('anuncios.create') }}" class="btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Nuevo anuncio
    </a>
</div>
<div class="cp-card overflow-hidden">
    <table class="cp-table">
        <thead><tr><th>ID</th><th>Título</th><th>Posición</th><th>Estado</th><th>Acciones</th></tr></thead>
        <tbody>
        @forelse($anuncios ?? [] as $a)
        <tr>
            <td style="color:#97A0AF;font-family:monospace">#{{ $a->id_anuncio }}</td>
            <td style="font-weight:600">{{ $a->titulo }}</td>
            <td><span class="status-badge status-blue">{{ $a->posicion ?? 'home' }}</span></td>
            <td><span class="status-badge {{ $a->activo ? 'status-green' : 'status-red' }}">{{ $a->activo ? 'Activo' : 'Inactivo' }}</span></td>
            <td>
                <div style="display:flex;gap:8px">
                    <a href="{{ route('anuncios.edit',$a->id_anuncio) }}" style="font-size:0.78rem;color:#0052CC;font-weight:600;text-decoration:none" class="hover:underline">Editar</a>
                    <form action="{{ route('anuncios.destroy',$a->id_anuncio) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-danger" style="font-size:0.78rem;padding:0">Eliminar</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:40px;color:#97A0AF">No hay anuncios. <a href="{{ route('anuncios.create') }}" style="color:#0052CC;font-weight:600">Crear primero</a></td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
