@extends('layouts.main')

@section('title', 'Inicio - Compured Perú')

@section('content')
<div class="w-full bg-gray-200 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto">
        <img src="{{ asset('img/banner.jpg') }}" alt="Promociones" class="w-full h-auto object-cover max-h-[400px]">
    </div>
</div>

<div class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 py-4 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center overflow-x-auto gap-4">
        <img src="{{ asset('img/marca1.jpg') }}" alt="Marca 1" class="h-12 object-contain grayscale hover:grayscale-0 transition">
        <img src="{{ asset('img/marca2.jpg') }}" alt="Marca 2" class="h-12 object-contain grayscale hover:grayscale-0 transition">
        <img src="{{ asset('img/marca3.jpg') }}" alt="Marca 3" class="h-12 object-contain grayscale hover:grayscale-0 transition">
        <img src="{{ asset('img/marca4.jpg') }}" alt="Marca 4" class="h-12 object-contain grayscale hover:grayscale-0 transition">
        <img src="{{ asset('img/marca5.jpg') }}" alt="Marca 5" class="h-12 object-contain grayscale hover:grayscale-0 transition">
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row gap-8">

    <aside class="w-full md:w-1/4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden border border-gray-200 dark:border-gray-700">
            <h2 class="bg-gray-100 dark:bg-gray-700 font-bold text-gray-800 dark:text-white p-4 border-b border-gray-200 dark:border-gray-600">Categorías</h2>
            <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                <li><a href="/categoria/accesorios" class="block p-3 text-sm hover:bg-blue-50 dark:hover:bg-gray-600 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium flex justify-between">Accesorios <span>></span></a></li>
                <li><a href="/categoria/computadoras" class="block p-3 text-sm hover:bg-blue-50 dark:hover:bg-gray-600 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium flex justify-between">Computadoras <span>></span></a></li>
                <li><a href="/categoria/laptops" class="block p-3 text-sm hover:bg-blue-50 dark:hover:bg-gray-600 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium flex justify-between">Laptops <span>></span></a></li>
                <li><a href="/categoria/redes" class="block p-3 text-sm hover:bg-blue-50 dark:hover:bg-gray-600 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium flex justify-between">Redes / Conectividad <span>></span></a></li>
                <li><a href="/categoria/case" class="block p-3 text-sm hover:bg-blue-50 dark:hover:bg-gray-600 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium flex justify-between">Case <span>></span></a></li>
                <li><a href="/categoria/fuentes" class="block p-3 text-sm hover:bg-blue-50 dark:hover:bg-gray-600 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium flex justify-between">Fuentes para Case <span>></span></a></li>
                <li><a href="/categoria/coolers" class="block p-3 text-sm hover:bg-blue-50 dark:hover:bg-gray-600 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium flex justify-between">Coolers/CPU <span>></span></a></li>
            </ul>
        </div>
    </aside>

    <section class="w-full md:w-3/4">
        <h2 class="text-xl font-bold mb-6 text-gray-800 dark:text-gray-100 border-b-2 border-blue-600 inline-block pb-1">Los más valorados</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 hover:shadow-lg transition flex flex-col">
                <div class="relative w-full h-48 bg-white p-4 flex items-center justify-center">
                    <img src="{{ asset('img/producto.webp') }}" alt="Producto" class="max-h-full object-contain">
                </div>
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2 leading-tight">Unidad de Estado Solido Kingston A400, 240GB, SATA 6Gb/s...</h3>
                    <div class="text-lg font-bold text-blue-600 dark:text-blue-400 mb-4 mt-auto">S/ 228</div>

                    <div class="flex gap-2">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded flex-grow flex justify-center items-center transition" title="Añadir al carrito">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </button>
                        <button class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 p-2 rounded transition" title="Vista rápida">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                        <a href="https://wa.me/51999999999" target="_blank" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded transition" title="Consultar por WhatsApp">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M... "/></svg> </a>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 hover:shadow-lg transition flex flex-col">
                <div class="relative w-full h-48 bg-white p-4 flex items-center justify-center">
                    <img src="{{ asset('img/producto.webp') }}" alt="Producto" class="max-h-full object-contain">
                </div>
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2 leading-tight">Laptop Dell Vostro 14 3405 AMD Ryzen...</h3>
                    <div class="text-lg font-bold text-blue-600 dark:text-blue-400 mb-4 mt-auto">S/ 1450</div>

                    <div class="flex gap-2">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded flex-grow flex justify-center items-center transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </button>
                        <button class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 p-2 rounded transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                        <a href="https://wa.me/51999999999" target="_blank" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M... "/></svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
