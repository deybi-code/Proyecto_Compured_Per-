@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow border border-gray-200 dark:border-gray-700">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Editar Producto: {{ $producto->nombre }}
        </h2>
        <a href="{{ route('admin.productos.index') }}"
           class="text-gray-500 hover:text-gray-700 dark:text-gray-400 font-semibold text-sm">
            ← Cancelar
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CORREGIDO: action usa route() con la clave primaria correcta (id_producto) --}}
    <form action="{{ route('admin.productos.update', $producto->id_producto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-bold mb-2 dark:text-gray-300">Nombre del Producto *</label>
                <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required
                    class="w-full p-3 rounded bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-bold mb-2 dark:text-gray-300">Categoría *</label>
                <select name="id_categoria" required
                    class="w-full p-3 rounded bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}"
                            {{ old('id_categoria', $producto->id_categoria) == $categoria->id_categoria ? 'selected' : '' }}>
                            {{ $categoria->nombre_categoria }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2 dark:text-gray-300">Precio (S/) *</label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" required min="0"
                    class="w-full p-3 rounded bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-bold mb-2 dark:text-gray-300">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $producto->stock ?? 0) }}" min="0"
                    class="w-full p-3 rounded bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-bold mb-2 dark:text-gray-300">Marca</label>
                <input type="text" name="marca" value="{{ old('marca', $producto->marca ?? '') }}"
                    class="w-full p-3 rounded bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-bold mb-2 dark:text-gray-300">Imagen del Producto</label>
                <input type="file" name="imagen" accept="image/*"
                    class="w-full p-2 rounded bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-sm dark:text-white">
                @if(isset($producto->imagen))
                    <p class="text-xs text-gray-500 mt-1">Imagen actual: {{ $producto->imagen }}</p>
                @endif
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold mb-2 dark:text-gray-300">Detalles Técnicos</label>
                <textarea name="detalles_tecnicos" rows="4"
                    class="w-full p-3 rounded bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500">{{ old('detalles_tecnicos', $producto->detalles_tecnicos ?? '') }}</textarea>
            </div>

            <div class="md:col-span-2 flex items-center gap-3">
                <input type="checkbox" name="mostrar_inicio" value="1" id="mostrar_inicio"
                    {{ old('mostrar_inicio', $producto->mostrar_inicio ?? 0) == 1 ? 'checked' : '' }}
                    class="rounded border-gray-300 text-blue-600">
                <label for="mostrar_inicio" class="text-sm font-semibold dark:text-gray-300 cursor-pointer">
                    Mostrar este producto destacado en el Home
                </label>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow transition">
                Actualizar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
