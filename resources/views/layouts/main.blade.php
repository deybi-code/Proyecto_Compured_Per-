<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Compured Perú – Tecnología Informática a tu Alcance')</title>
    <meta name="description" content="Compured Perú – Venta de computadoras, laptops, accesorios y más. Tecnología informática a tu alcance.">
    <script src="{{ asset('js/theme.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen">

{{-- ===== TOP BAR ===== --}}
<div class="topbar">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <a href="https://wa.me/51999999999" target="_blank" class="whatsapp-btn">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WHATSAPP VENTAS
            </a>
            <span class="hidden sm:inline text-white/60">|</span>
            <span class="hidden sm:inline text-white/70 text-xs">📍 Lima, Perú</span>
        </div>
        <nav class="hidden md:flex items-center gap-5">
            <a href="/nosotros">Sobre nosotros</a>
            <a href="/terminos">Términos y condiciones</a>
            <a href="/seguimiento" class="font-semibold text-white">🔍 Seguimiento de pedido</a>
        </nav>
    </div>
</div>

{{-- ===== HEADER ===== --}}
<header class="site-header">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-4">

        {{-- Logo --}}
        <a href="/" class="flex-shrink-0">
            <img src="{{ asset('img/logo.png') }}" alt="Compured Perú" class="h-12 dark:hidden" onerror="this.style.display='none'">
            <div class="dark:hidden h-12 flex items-center" style="display:none">
                <span style="font-family:'Rajdhani',sans-serif;font-size:1.4rem;font-weight:800;color:#0052CC">COMPURED<span style="color:#8CC63F">PERÚ</span></span>
            </div>
            <span class="hidden dark:inline-flex items-center h-12" style="font-family:'Rajdhani',sans-serif;font-size:1.4rem;font-weight:800;color:#2684FF">COMPURED<span style="color:#8CC63F">PERÚ</span></span>
        </a>

        {{-- Search --}}
        <div class="flex-grow max-w-2xl hidden md:block" x-data="{ open: false }">
            <form action="/buscar" method="GET">
                <div class="search-wrapper">
                    <button type="button" @click="open = !open" class="search-cat-btn">
                        Categorías
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <input type="text" name="q" placeholder="¿Qué producto buscas?" class="search-input" value="{{ request('q') }}">
                    <button type="submit" class="search-submit" title="Buscar">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </div>
            </form>
        </div>

        {{-- Right Controls --}}
        <div class="flex items-center gap-4 ml-auto">

            {{-- Dark Mode Toggle --}}
            <div class="dark-toggle-wrap" title="Modo oscuro/claro">
                <span id="theme-icon" class="text-base cursor-pointer" onclick="toggleDark()">🌙</span>
                <button class="dark-toggle" onclick="toggleDark()" aria-label="Cambiar tema"></button>
            </div>

            {{-- User Menu --}}
            @auth
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex flex-col items-center gap-1 text-xs font-semibold text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Mi cuenta
                </button>
                <div x-show="open" @click.away="open = false" x-cloak class="user-dropdown absolute right-0 mt-2 z-50">
                    <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
                        {{ auth()->user()->nombre_completo ?? auth()->user()->name ?? 'Usuario' }}
                    </div>
                    <a href="/dashboard">📊 Panel de usuario</a>
                    <a href="{{ route('profile.edit') }}">⚙️ Editar perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="danger">🚪 Cerrar sesión</button>
                    </form>
                </div>
            </div>
            @else
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('login') }}" class="font-semibold text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">Entrar</a>
                <span class="text-gray-300 dark:text-gray-600">|</span>
                <a href="{{ route('register') }}" class="btn-primary text-xs py-2 px-4">Registrarse</a>
            </div>
            @endauth

            {{-- Cart --}}
            <a href="/carrito" class="cart-icon">
                <div class="relative">
                    <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span class="cart-badge">{{ session('carrito') ? count(session('carrito')) : 0 }}</span>
                </div>
                <span class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">Carrito</span>
            </a>
        </div>
    </div>
</header>

{{-- ===== MAIN ===== --}}
<main class="flex-grow">
    @yield('content')
</main>

{{-- ===== FOOTER ===== --}}
<footer class="site-footer pt-10 pb-0 mt-12">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-10 pb-10">
        <div>
            <div class="mb-4">
                <span style="font-family:'Rajdhani',sans-serif;font-size:1.5rem;font-weight:800;color:white">COMPURED<span style="color:#8CC63F">PERÚ</span></span>
            </div>
            <p class="text-sm text-white/60 leading-relaxed mb-4">Tecnología informática a tu alcance. Venta de computadoras, laptops, accesorios y más para toda persona en Perú.</p>
            <a href="https://wa.me/51999999999" target="_blank" class="whatsapp-btn" style="display:inline-flex">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                999 999 999
            </a>
        </div>
        <div>
            <div class="footer-title">Navegación</div>
            <a href="/" class="footer-link">» Inicio</a>
            <a href="/nosotros" class="footer-link">» Sobre nosotros</a>
            <a href="/terminos" class="footer-link">» Términos y condiciones</a>
            <a href="/seguimiento" class="footer-link">» Seguimiento de pedido</a>
            <a href="/carrito" class="footer-link">» Mi carrito</a>
            <a href="/dashboard" class="footer-link">» Mi cuenta</a>
        </div>
        <div>
            <div class="footer-title">Categorías</div>
            <a href="/categoria/computadoras" class="footer-link">» Computadoras</a>
            <a href="/categoria/laptops" class="footer-link">» Laptops</a>
            <a href="/categoria/accesorios" class="footer-link">» Accesorios</a>
            <a href="/categoria/redes" class="footer-link">» Redes / Conectividad</a>
            <a href="/categoria/case" class="footer-link">» Cases</a>
            <a href="/categoria/coolers" class="footer-link">» Coolers / CPU</a>
        </div>
    </div>
    <div class="footer-copy">
        © {{ date('Y') }} Compured Perú · compuredperu.com · Todos los derechos reservados
        <span class="ml-4 text-white/20">Tecnología Informática a tu Alcance</span>
    </div>
</footer>

</body>
</html>
