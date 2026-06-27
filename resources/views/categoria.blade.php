@extends('layouts.main')

@section('title', 'Categorías - Compured Perú')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
        <a href="/" class="hover:text-blue-600 dark:hover:text-blue-400">Home</a> &raquo;
        <span class="text-gray-700 dark:text-gray-200 capitalize">Categoría seleccionada</span>
    </nav>

    <div class="flex flex-col md:flex-row gap-8">

        <!-- Sidebar de Filtros -->
        <aside class="w-full md:w-1/4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
                <h2 class="bg-blue-600 dark:bg-blue-800 font-bold text-white p-4 text-sm">Filtrar resultados por</h2>
                <ul class="divide-y divide-gray-100 dark:divide-gray-700 text-sm p-2">
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Accesorios</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Computadoras</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Laptops</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Redes / Conectividad</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Case</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Fuentes para Case</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Coolers/CPU - Refrigeracion Liq.</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» CPU - Procesadores</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Discos Duros Externos</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Discos Duros Internos</a></li>
                    <li><a href="#" class="block px-4 py-2 text-blue-600 dark:text-blue-400 font-bold">» Discos Sólidos Internos</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Impresoras</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Memorias Flash</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:text-blue-600 dark:hover:text-blue-400 font-medium">» Memorias RAM</a></li>
                </ul>
            </div>

            <!-- Filtro de Precio -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden p-6 text-center" x-data="{ min: 0, max: 10000 }">
                <input type="range" min="0" max="10000" x-model="max" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 accent-blue-600 mb-4">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <input type="number" x-model="min" class="w-full border-gray-300 dark:border-gray-600 rounded bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white p-2 text-center text-sm focus:ring-blue-500">
                    <span class="text-gray-500 font-bold">A</span>
                    <input type="number" x-model="max" class="w-full border-gray-300 dark:border-gray-600 rounded bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white p-2 text-center text-sm focus:ring-blue-500">
                </div>
                <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded transition shadow-sm w-full">
                    BUSCAR <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </div>
        </aside>

        <!-- Resultados -->
        <section class="w-full md:w-3/4">

            <div class="flex justify-end items-center mb-6 text-sm text-gray-700 dark:text-gray-300">
                <label class="mr-2 font-medium">Ordenar por :</label>
                <select class="border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 p-2 focus:ring-blue-500 outline-none">
                    <option>El precio más bajo</option>
                    <option>El precio más alto</option>
                    <option>Más recientes</option>
                </select>
            </div>

            <!-- Mostrar si no hay productos (como se ve en partes del video) -->
            <!-- <div class="text-center text-xl text-gray-600 dark:text-gray-400 py-10">No se ha encontrado ningún producto.</div> -->

            <!-- Grid de productos (Similar al index pero adaptado) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tarjeta Producto -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 hover:shadow-lg transition flex flex-col relative group">
                    <button class="absolute top-2 right-2 text-gray-400 hover:text-red-500 transition opacity-0 group-hover:opacity-100 z-10" title="Agregar a favoritos">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                    <div class="relative w-full h-48 bg-white p-4 flex items-center justify-center border-b border-gray-100 dark:border-gray-700">
                        <img src="{{ asset('img/producto.webp') }}" alt="Producto" class="max-h-full object-contain">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <div class="flex items-center gap-1 text-xs text-yellow-400 mb-1">
                            ★★★★★ <span class="text-gray-400 ml-1">0 Reseñas</span>
                        </div>
                        <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2 leading-tight">Unidad de estado solido Western Digital Green, WD S240G3G0A...</h3>
                        <div class="text-sm text-green-600 dark:text-green-400 font-semibold mb-2">En stock</div>
                        <div class="text-xl font-bold text-blue-600 dark:text-blue-400 mb-4 mt-auto">S/ 108</div>
                    </div>
                </div>
                <!-- Fin Tarjeta Producto -->
            </div>

        </section>
    </div>
</div>
@endsection
