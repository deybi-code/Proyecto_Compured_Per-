@extends('layouts.main')

@section('title', 'Carrito de Compras - Compured Perú')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-400">Home</a> &raquo;
        <span class="text-gray-700 dark:text-gray-200">Carrito</span>
    </nav>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($carrito))
        <div class="text-center py-16">
            <p class="text-gray-500 dark:text-gray-400 text-lg mb-4">Tu carrito está vacío.</p>
            <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded font-bold transition">
                Ver Productos
            </a>
        </div>
    @else

    {{-- CORREGIDO: los datos ahora son dinámicos (antes eran hardcodeados) --}}
    @php
        $total = collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']);
    @endphp

    <div class="flex flex-col lg:flex-row gap-8">

        <!-- Tabla de productos -->
        <div class="w-full lg:w-2/3">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-max">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                            <th class="p-4 font-bold border-b border-gray-200 dark:border-gray-600">Producto</th>
                            <th class="p-4 font-bold border-b border-gray-200 dark:border-gray-600 text-center">Precio Unit.</th>
                            <th class="p-4 font-bold border-b border-gray-200 dark:border-gray-600 text-center">Cantidad</th>
                            <th class="p-4 font-bold border-b border-gray-200 dark:border-gray-600 text-center">Subtotal</th>
                            <th class="p-4 font-bold border-b border-gray-200 dark:border-gray-600 text-center"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($carrito as $id => $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition">
                            <td class="p-4">
                                <div class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $item['nombre'] }}
                                </div>
                            </td>
                            <td class="p-4 text-center text-sm text-gray-700 dark:text-gray-300">
                                S/ {{ number_format($item['precio'], 2) }}
                            </td>
                            <td class="p-4 text-center text-sm text-gray-700 dark:text-gray-300">
                                {{ $item['cantidad'] }}
                            </td>
                            <td class="p-4 text-center text-base font-bold text-gray-800 dark:text-gray-200">
                                S/ {{ number_format($item['precio'] * $item['cantidad'], 2) }}
                            </td>
                            <td class="p-4 text-center">
                                {{-- CORREGIDO: el botón eliminar ahora funciona con una ruta real --}}
                                <form action="{{ route('carrito.destroy', $id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Eliminar del carrito"
                                        class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Resumen de compra -->
        <div class="w-full lg:w-1/3">
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
                <h3 class="text-sm font-bold text-gray-800 dark:text-gray-100 mb-4 uppercase tracking-wide">
                    Detalles de Precio
                </h3>

                <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                    <div class="flex justify-between">
                        <span>SubTotal</span>
                        {{-- CORREGIDO: antes el subtotal era hardcodeado --}}
                        <span class="font-bold text-gray-900 dark:text-white">S/ {{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Descuento</span>
                        <span class="font-bold text-gray-900 dark:text-white">S/ 0.00</span>
                    </div>
                </div>

                <div class="flex justify-between text-lg font-bold text-gray-900 dark:text-white mb-6">
                    <span>Total</span>
                    <span>S/ {{ number_format($total, 2) }}</span>
                </div>

                <a href="{{ route('checkout') }}"
                   class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded text-sm font-bold transition shadow-sm">
                    Realizar pedido
                </a>
            </div>
        </div>

    </div>
    @endif
</div>
@endsection
