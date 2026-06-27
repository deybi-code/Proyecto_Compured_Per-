@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-white mb-8">Gestión de Anuncios (Banners)</h1>

    @if(session('success'))
        <div class="bg-green-600 text-white p-4 rounded mb-6 font-bold">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-600 text-white p-4 rounded mb-6 font-bold">{{ session('error') }}</div>
    @endif

    <div class="bg-gray-800 p-6 rounded-lg border border-gray-700 shadow-xl mb-10">
        <form action="{{ route('anuncios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                <input type="text" name="titulo" placeholder="Título del anuncio"
                    class="p-3 bg-gray-700 border border-gray-600 rounded text-white w-full @error('titulo') border-red-500 @enderror"
                    value="{{ old('titulo') }}" required>
                @error('titulo')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror

                <input type="file" name="imagen" accept="image/*"
                    class="p-2 bg-gray-700 border border-gray-600 rounded text-white w-full @error('imagen') border-red-500 @enderror"
                    required>
                @error('imagen')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded transition">
                    SUBIR ANUNCIO
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($anuncios as $anuncio)
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 shadow-lg">
            {{-- CORREGIDO: se usa imagen_url en lugar de ruta_imagen (nombre real en BD) --}}
            <img src="{{ asset('storage/' . $anuncio->imagen_url) }}" class="w-full h-48 object-cover"
                 alt="{{ $anuncio->titulo }}">
            <div class="p-4">
                <p class="text-white font-bold text-lg mb-4">{{ $anuncio->titulo }}</p>
                <form action="{{ route('anuncios.destroy', $anuncio->id_anuncio) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-400 hover:text-red-600 font-bold text-sm"
                        onclick="return confirm('¿Eliminar este anuncio?')">
                        Eliminar Anuncio
                    </button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-gray-400 col-span-3 text-center py-8">No hay anuncios publicados.</p>
        @endforelse
    </div>
</div>
@endsection
