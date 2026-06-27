@extends('layouts.main')

@section('title', 'Carrito de Compras - Compured Perú')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
        <a href="/" class="hover:text-blue-600 dark:hover:text-blue-400">Home</a> &raquo;
        <span class="text-gray-700 dark:text-gray-200">Carrito</span>
    </nav>

    <div class="flex flex-col lg:flex-row gap-8">

        <!-- Tabla de productos -->
        <div class="w-full lg:w-2/3">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-max">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase">
                            <th class="p-4 font-bold border-b border-gray-200 dark:border-gray-600">Nombre del producto</th>
                            <th class="p-4 font-bold border-b border-gray-200 dark:border-gray-600">Detalles</th>
                            <th class="p-4 font-bold border-b border-gray-200 dark:border-gray-600 text-center">Precio unitario</th>
                            <th class="p-4 font-bold border-b border-gray-200 dark:border-gray-600 text-center">Sub Total</th>
                            <th class="p-4 font-bold border-b border-gray-200 dark:border-gray-600 text-center"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Fila de ejemplo (Debe iterarse con un foreach) -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition" x-data="{ cant: 3, precio: 228 }">
                            <td class="p-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-20 h-20 bg-white p-2 border border-gray-200 dark:border-gray-600 rounded flex items-center justify-center flex-shrink-0">
                                        <img src="{{ asset('img/producto.webp') }}" alt="Kingston A400" class="max-w-full max-h-full object-contain">
                                    </div>
                                    <div class="text-sm font-semibold text-gray-800 dark:text-gray-200 w-48 whitespace-normal">
                                        Unidad de Estado Solido Kingston A400...
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-500 dark:text-gray-400"></td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center border border-gray-300 dark:border-gray-600 rounded w-max mx-auto overflow-hidden">
                                    <div class="px-3 py-2 bg-gray-50 dark:bg-gray-700 text-sm font-bold text-gray-700 dark:text-gray-300 border-r border-gray-300 dark:border-gray-600">S/ <span x-text="precio"></span></div>
                                    <button @click="if(cant > 1) cant--" class="px-3 py-2 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition font-bold text-gray-600 dark:text-gray-300">-</button>
                                    <input type="text" x-model="cant" class="w-10 text-center text-sm border-none focus:ring-0 bg-white dark:bg-gray-800 dark:text-white p-2" readonly>
                                    <button @click="cant++" class="px-3 py-2 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition font-bold text-gray-600 dark:text-gray-300">+</button>
                                </div>
                            </td>
                            <td class="p-4 text-center text-base font-bold text-gray-800 dark:text-gray-200">
                                S/ <span x-text="precio * cant"></span>
                            </td>
                            <td class="p-4 text-center">
                                <button class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition" title="Eliminar del carrito">
                                    <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Resumen de compra -->
        <div class="w-full lg:w-1/3">
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
                <h3 class="text-sm font-bold text-gray-800 dark:text-gray-100 mb-4 uppercase tracking-wide">Detalles de Precio</h3>

                <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                    <div class="flex justify-between">
                        <span>SubTotal</span>
                        <span class="font-bold text-gray-900 dark:text-white">S/684</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Descuento</span>
                        <span class="font-bold text-gray-900 dark:text-white">S/0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Impuesto</span>
                        <span class="font-bold text-gray-900 dark:text-white">0%</span>
                    </div>
                </div>

                <div class="flex justify-between text-lg font-bold text-gray-900 dark:text-white mb-6">
                    <span>Total</span>
                    <span>S/684</span>
                </div>

                <div class="mb-6 text-center">
                    <button class="text-blue-600 dark:text-blue-400 text-sm hover:underline font-semibold flex items-center justify-center gap-1 mx-auto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        ¿TIENE UN CÓDIGO DE PROMOCIÓN?
                    </button>
                </div>

                <a href="/checkout" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded text-sm font-bold transition shadow-sm">
                    Realizar pedido
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
