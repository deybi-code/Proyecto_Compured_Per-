@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow border border-gray-200 dark:border-gray-700">
    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Nuevo Producto</h2>

    <form action="/admin/productos" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold mb-2">Nombre del producto</label>
                <input type="text" name="nombre" class="w-full p-3 rounded bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Precio (S/)</label>
                <input type="number" step="0.01" name="precio" class="w-full p-3 rounded bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Stock</label>
                <input type="number" name="stock" class="w-full p-3 rounded bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Imagen del Producto</label>
                <input type="file" name="imagen" class="w-full p-2 rounded bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-sm">
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow transition">
                GUARDAR PRODUCTO
            </button>
        </div>
    </form>
</div>
@endsection
