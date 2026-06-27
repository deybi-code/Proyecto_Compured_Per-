<div class="group bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
    <!-- Imagen -->
    <div class="relative w-full h-56 bg-gray-50 dark:bg-gray-700 p-4 flex items-center justify-center overflow-hidden">
        <img src="{{ asset('img/producto.webp') }}" alt="Producto" class="group-hover:scale-110 transition-transform duration-500 max-h-full object-contain">

        <!-- Botón de Vista Rápida (Estilo video) -->
        <button class="absolute bottom-4 left-0 right-0 mx-auto w-[80%] bg-blue-600/90 hover:bg-blue-700 text-white py-2 rounded-md font-bold text-sm transform translate-y-12 group-hover:translate-y-0 transition-all duration-300 shadow-lg">
            VISTA RÁPIDA
        </button>
    </div>

    <!-- Info -->
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-200 line-clamp-2 h-10 mb-2">
            Unidad de Estado Solido Kingston A400, 240GB...
        </h3>

        <div class="text-xl font-black text-gray-900 dark:text-white mb-3">S/ 228</div>

        <!-- Botones Acción -->
        <div class="flex gap-2 mt-auto">
            <button class="flex-grow bg-blue-600 hover:bg-blue-700 text-white py-2 rounded transition font-bold text-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Carrito
            </button>
            <button class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 px-3 py-2 rounded transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </button>
        </div>
    </div>
</div>
