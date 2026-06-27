@extends('layouts.main')

@section('title', 'Detalle del Producto - Compured Perú')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
        <a href="/" class="hover:text-blue-600 dark:hover:text-blue-400">Home</a> &raquo;
        <a href="/categoria/almacenamiento" class="hover:text-blue-600 dark:hover:text-blue-400">Discos Sólidos Internos</a> &raquo;
        <span class="text-gray-700 dark:text-gray-200">Unidad de Estado Solido Western Digital...</span>
    </nav>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 p-6 flex flex-col md:flex-row gap-8" x-data="{ cantidad: 1 }">

        <!-- Imagen del Producto -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-4 bg-white rounded-lg border border-gray-100 dark:border-gray-600">
            <img src="{{ asset('img/producto.webp') }}" alt="Producto" class="max-w-full h-auto object-contain">
        </div>

        <!-- Detalles del Producto -->
        <div class="w-full md:w-1/2 flex flex-col">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-2">Unidad de estado solido Western Digital Green, WD S240G3G0A, 240GB, SATA 6Gb/s, 2.5", 7mm.</h1>

            <div class="flex items-center gap-2 text-sm text-green-600 dark:text-green-400 mb-4 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                En stock
                <span class="text-gray-400 dark:text-gray-500 font-normal ml-2">0 Reseñas</span>
            </div>

            <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-6">S/ 108</div>

            <!-- Selector de cantidad y botones -->
            <div class="flex flex-wrap items-center gap-4 mb-6">
                <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded overflow-hidden">
                    <button @click="if(cantidad > 1) cantidad--" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 transition font-bold text-lg">-</button>
                    <input type="text" x-model="cantidad" class="w-12 text-center border-none focus:ring-0 dark:bg-gray-800 dark:text-white font-semibold" readonly>
                    <button @click="cantidad++" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 transition font-bold text-lg">+</button>
                </div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded font-semibold flex items-center gap-2 transition shadow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Añadir al carrito
                </button>

                <button class="bg-gray-800 hover:bg-black dark:bg-gray-600 dark:hover:bg-gray-500 text-white px-6 py-3 rounded font-semibold flex items-center gap-2 transition shadow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Compra ahora
                </button>
            </div>

            <a href="https://wa.me/51999999999" target="_blank" class="inline-flex w-max items-center gap-2 text-green-600 dark:text-green-400 border-2 border-green-600 dark:border-green-400 px-4 py-2 rounded hover:bg-green-50 dark:hover:bg-gray-700 transition mb-4 font-semibold">
                Atención por whatsapp
            </a>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-auto">Stock del producto: 392594_cp</p>
        </div>
    </div>

    <!-- Pestañas de información -->
    <div class="mt-8" x-data="{ tab: 'descripcion' }">
        <div class="flex flex-wrap border-b border-gray-200 dark:border-gray-700">
            <button @click="tab = 'descripcion'" :class="tab === 'descripcion' ? 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'" class="px-6 py-3 border-b-2 font-bold text-sm uppercase transition">DESCRIPCIÓN</button>
            <button @click="tab = 'politica'" :class="tab === 'politica' ? 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'" class="px-6 py-3 border-b-2 font-bold text-sm uppercase transition">POLÍTICA DE COMPRA Y DEVOLUCIÓN</button>
            <button @click="tab = 'resenas'" :class="tab === 'resenas' ? 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'" class="px-6 py-3 border-b-2 font-bold text-sm uppercase transition">RESEÑAS (0)</button>
            <button @click="tab = 'comentarios'" :class="tab === 'comentarios' ? 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'" class="px-6 py-3 border-b-2 font-bold text-sm uppercase transition">COMENTARIO(0)</button>
        </div>

        <div class="p-6 bg-white dark:bg-gray-800 border border-t-0 border-gray-200 dark:border-gray-700 rounded-b-lg text-sm text-gray-700 dark:text-gray-300">
            <div x-show="tab === 'descripcion'">
                <p class="mb-6 leading-relaxed">Unidad de estado solido Western Digital Green, WD S240G3G0A, 240GB, SATA 6Gb/s, 2.5", 7mm.<br>Capacidad: 240GB. Interfaz: SATA 6.0 Gb/s. Velocidad de Transferencia: 6 Gb/s. Velocidad de Lectura: 540 MB/s. Velocidad de Escritura: 430 MB/s.</p>
                <div class="w-full md:w-2/3">
                    <span class="bg-blue-600 text-white px-2 py-1 text-xs font-bold uppercase rounded mb-3 inline-block">Características :</span>
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-600 text-xs">
                        <tbody>
                            <tr><td class="border border-gray-300 dark:border-gray-600 p-2 font-bold bg-gray-50 dark:bg-gray-700 w-1/3">MARCA</td><td class="border border-gray-300 dark:border-gray-600 p-2">WESTERN DIGITAL</td></tr>
                            <tr><td class="border border-gray-300 dark:border-gray-600 p-2 font-bold bg-gray-50 dark:bg-gray-700 w-1/3">MODELO</td><td class="border border-gray-300 dark:border-gray-600 p-2">WD GREEN</td></tr>
                            <tr><td class="border border-gray-300 dark:border-gray-600 p-2 font-bold bg-gray-50 dark:bg-gray-700 w-1/3">CAPACIDAD</td><td class="border border-gray-300 dark:border-gray-600 p-2">240 GB</td></tr>
                            <tr><td class="border border-gray-300 dark:border-gray-600 p-2 font-bold bg-gray-50 dark:bg-gray-700 w-1/3">INTERFAZ</td><td class="border border-gray-300 dark:border-gray-600 p-2">SATA 6.0 Gb/s</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div x-cloak x-show="tab === 'politica'">
                <p>Nuestra política de compra y devolución asegura tu satisfacción total. Tienes 7 días para devoluciones por fallos de fábrica presentando el comprobante original.</p>
            </div>
            <div x-cloak x-show="tab === 'resenas'">
                <p>No se ha encontrado ninguna reseña.</p>
            </div>
            <div x-cloak x-show="tab === 'comentarios'">
                <h3 class="font-bold text-lg mb-2">Escribir comentario</h3>
                <textarea class="w-full md:w-1/2 border-gray-300 dark:border-gray-600 rounded bg-gray-50 dark:bg-gray-700 dark:text-white p-3 focus:ring-blue-500 focus:border-blue-500" rows="4" placeholder="Escriba sus comentarios aquí ..."></textarea>
                <button class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold transition">Publicar comentario</button>
            </div>
        </div>
    </div>
</div>
@endsection
