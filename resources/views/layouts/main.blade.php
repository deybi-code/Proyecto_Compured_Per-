<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Compured Perú - Tecnología Informática')</title>
    <script src="{{ asset('js/theme.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 flex flex-col min-h-screen font-sans">

    <div class="bg-blue-600 dark:bg-blue-900 text-white text-sm py-2 px-4 flex justify-between items-center w-full">
        <div class="flex items-center gap-4">
            <a href="https://wa.me/51999999999" target="_blank" class="flex items-center gap-1 bg-green-500 hover:bg-green-600 px-3 py-1 rounded-full font-bold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M... "/></svg> WHATSAPP VENTAS
            </a>
        </div>
        <div class="hidden md:flex gap-6">
            <a href="/nosotros" class="hover:underline">Sobre nosotros</a>
            <a href="/terminos" class="hover:underline">Términos y Condiciones</a>
            <a href="/contacto" class="hover:underline">Contacta con nosotros</a>
            <a href="/seguimiento" class="hover:underline font-semibold">Seguimiento de pedidos</a>
        </div>
    </div>

    <header class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between gap-4">
            <a href="/" class="flex-shrink-0">
                <img src="{{ asset('img/logo.png') }}" alt="Compured Perú" class="h-10 dark:hidden">
                <img src="{{ asset('img/logo-dark.png') }}" alt="Compured Perú" class="h-10 hidden dark:block">
            </a>

            <div class="flex-grow max-w-2xl hidden md:flex" x-data="{ openCat: false }">
                <div class="flex w-full border-2 border-blue-600 dark:border-blue-500 rounded-lg overflow-hidden">
                    <button @click="openCat = !openCat" class="bg-gray-100 dark:bg-gray-700 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 flex items-center gap-2 border-r border-gray-300 dark:border-gray-600">
                        Categorías <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <input type="text" placeholder="Buscar producto..." class="w-full px-4 py-2 focus:outline-none dark:bg-gray-800 dark:text-white border-none focus:ring-0">
                    <button class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 text-white px-6 py-2 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <button onclick="toggleTheme()" class="text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition">
                    <svg class="w-6 h-6 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg class="w-6 h-6 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>

                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex flex-col items-center text-sm font-semibold hover:text-blue-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Mi cuenta
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 shadow-xl rounded-md py-2 border border-gray-100 dark:border-gray-600 hidden" :class="{'hidden': !open}">
                            <a href="/dashboard" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">Panel de usuario</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600">Cerrar Sesión</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="text-sm font-semibold flex gap-2">
                        <a href="{{ route('register') }}" class="hover:text-blue-600">Registrarse</a> |
                        <a href="{{ route('login') }}" class="hover:text-blue-600">Entrar</a>
                    </div>
                @endauth

                <a href="/carrito" class="relative flex flex-col items-center text-sm hover:text-blue-600 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="absolute top-0 right-0 -mt-1 -mr-2 bg-blue-600 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center font-bold">0</span>
                </a>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-900 dark:bg-black text-gray-300 py-10 border-t-4 border-blue-600 mt-10">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <img src="{{ asset('img/logo-dark.png') }}" alt="Compured" class="h-10 mb-4">
                <p class="text-sm">compuredperu.com es un eCommerce que vende, promociona productos tecnológicos para toda persona y estamos respaldados por una empresa.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white mb-4 uppercase">Enlaces de pie de página</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="hover:text-blue-400">» Home</a></li>
                    <li><a href="/nosotros" class="hover:text-blue-400">» Sobre nosotros</a></li>
                    <li><a href="/terminos" class="hover:text-blue-400">» Términos y Condiciones</a></li>
                    <li><a href="/contacto" class="hover:text-blue-400">» Contacta con nosotros</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white mb-4 uppercase">Últimas Categorías</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/categoria/accesorios" class="hover:text-blue-400">Accesorios</a></li>
                    <li><a href="/categoria/computadoras" class="hover:text-blue-400">Computadoras</a></li>
                    <li><a href="/categoria/laptops" class="hover:text-blue-400">Laptops</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center text-sm mt-10 border-t border-gray-700 pt-4">
            Derechos autor © {{ date('Y') }}. Todos los derechos reservados por compuredperu.com
        </div>
    </footer>

    <script>
        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>
</body>
</html>
