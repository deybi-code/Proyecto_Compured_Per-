@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gestión de Productos</h1>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold">
            + NUEVO PRODUCTO
        </button>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase">
                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Nombre</th>
                    <th class="p-4">Precio</th>
                    <th class="p-4">Stock</th>
                    <th class="p-4">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-600 dark:text-gray-300">
                @foreach($productos as $producto)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-750">
                    <td class="p-4 font-mono">{{ $producto->id_producto }}</td>
                    <td class="p-4 font-bold">{{ $producto->nombre }}</td>
                    <td class="p-4">S/ {{ $producto->precio }}</td>
                    <td class="p-4">{{ $producto->stock }}</td>
                    <td class="p-4 flex gap-2">
                        <button class="text-blue-600 hover:underline">Editar</button>
                        <button class="text-red-600 hover:underline">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
