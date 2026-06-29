@extends('layouts.admin')

@section('title','Crear Producto')

@section('content')

<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-4">➕ Crear Producto</h1>

    <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
        @csrf

        <input name="nombre" placeholder="Nombre"
               class="w-full p-2 border rounded mb-3">

        <input name="precio" type="number" placeholder="Precio"
               class="w-full p-2 border rounded mb-3">

        <input name="stock" type="number" placeholder="Stock"
               class="w-full p-2 border rounded mb-3">

        <textarea name="descripcion" placeholder="Descripción"
                  class="w-full p-2 border rounded mb-3"></textarea>

        <p class="font-semibold mb-2">📸 Imágenes (máx 4)</p>

        <input type="file" name="imagen_1" class="mb-2">
        <input type="file" name="imagen_2" class="mb-2">
        <input type="file" name="imagen_3" class="mb-2">
        <input type="file" name="imagen_4" class="mb-4">

        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Guardar
        </button>

    </form>

</div>

@endsection