@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    @if(session('success'))
        <div class="bg-green-600 text-white p-4 rounded mb-6 font-bold shadow">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-600 text-white p-4 rounded mb-6 font-bold shadow">{{ session('error') }}</div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gestión de Productos</h1>
        {{-- CORREGIDO: el botón ahora es un enlace real a la ruta de creación --}}
        <a href="{{ route('admin.productos.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold transition">
            + NUEVO PRODUCTO
        </a>
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
                @forelse($productos as $producto)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="p-4 font-mono">{{ $producto->id_producto }}</td>
                    <td class="p-4 font-bold">{{ $producto->nombre }}</td>
                    <td class="p-4">S/ {{ number_format($producto->precio, 2) }}</td>
                    <td class="p-4">
                        <span class="{{ $producto->stock <= 5 ? 'text-red-500 font-bold' : '' }}">
                            {{ $producto->stock }}
                        </span>
                    </td>
                    <td class="p-4 flex gap-3 items-center">
                        {{-- CORREGIDO: Editar ahora es un link real --}}
                        <a href="{{ route('admin.productos.edit', $producto->id_producto) }}"
                           class="text-blue-600 hover:underline font-semibold">Editar</a>

                        {{-- CORREGIDO: Eliminar ahora tiene un formulario real con CSRF --}}
                        <form action="{{ route('admin.productos.destroy', $producto->id_producto) }}"
                              method="POST"
                              onsubmit="return confirm('¿Eliminar {{ $producto->nombre }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline font-semibold">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500 dark:text-gray-400">
                        No hay productos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
