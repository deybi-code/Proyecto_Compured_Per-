@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold text-white mb-6">Gestionar Anuncios (Banner)</h1>

    <form action="{{ route('anuncios.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg mb-8 border border-gray-700">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="titulo" placeholder="Título del anuncio" class="p-3 bg-gray-700 text-white rounded">
            <input type="file" name="imagen" class="p-2 bg-gray-700 text-white rounded">
        </div>
        <button class="mt-4 bg-blue-600 text-white px-6 py-2 rounded font-bold">SUBIR ANUNCIO</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($anuncios as $anuncio)
        <div class="bg-gray-800 p-4 rounded border border-gray-700">
            <img src="{{ asset('storage/' . $anuncio->ruta_imagen) }}" class="w-full h-40 object-cover rounded mb-2">
            <p class="text-white font-bold">{{ $anuncio->titulo }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-white mb-8">Gestión de Anuncios (Banners)</h1>

    <div class="bg-gray-800 p-6 rounded-lg border border-gray-700 shadow-xl mb-10">
        <form action="{{ route('anuncios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                <input type="text" name="titulo" placeholder="Título del anuncio" class="p-3 bg-gray-700 border border-gray-600 rounded text-white w-full" required>
                <input type="file" name="imagen" class="p-2 bg-gray-700 border border-gray-600 rounded text-white w-full" required>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded transition">
                    SUBIR ANUNCIO
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($anuncios as $anuncio)
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 shadow-lg">
            <img src="{{ asset('storage/' . $anuncio->ruta_imagen) }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <p class="text-white font-bold text-lg mb-4">{{ $anuncio->titulo }}</p>
                <form action="{{ route('anuncios.destroy', $anuncio->id_anuncio) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="text-red-400 hover:text-red-600 font-bold text-sm">Eliminar Anuncio</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
