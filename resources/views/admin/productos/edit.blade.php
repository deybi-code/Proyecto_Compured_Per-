@extends('layouts.admin')

@section('title','Editar Producto')

@section('content')

<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-4">✏️ Editar Producto</h1>

    <form method="POST"
          action="{{ route('admin.productos.update',['producto'=>$producto->id_producto]) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <input name="nombre" value="{{ $producto->nombre }}"
               class="w-full p-2 border rounded mb-3">

        <input name="precio" value="{{ $producto->precio }}"
               class="w-full p-2 border rounded mb-3">

        <input name="stock" value="{{ $producto->stock }}"
               class="w-full p-2 border rounded mb-3">

        <textarea name="descripcion"
                  class="w-full p-2 border rounded mb-3">{{ $producto->descripcion }}</textarea>

        <p class="font-semibold mb-2">📸 Cambiar imágenes (máx 4)</p>

        <input type="file" name="imagen_1" class="mb-2">
        <input type="file" name="imagen_2" class="mb-2">
        <input type="file" name="imagen_3" class="mb-2">
        <input type="file" name="imagen_4" class="mb-4">

        <button class="px-4 py-2 bg-green-600 text-white rounded">
            Actualizar
        </button>

    </form>

</div>

@endsection