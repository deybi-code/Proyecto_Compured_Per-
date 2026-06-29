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
    <style>
        /* ── HEADER LAYOUT FIX ── */
        .header-inner {
            display: flex;
            align-items: center;
            gap: 16px;
            max-width: 80rem;
            margin: 0 auto;
            padding: 12px 16px;
        }
        .header-logo { flex-shrink: 0; }
        .header-search {
            flex-grow: 1;
            max-width: 640px;
        }
        @media (max-width: 767px) { .header-search { display: none; } }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-left: auto;
            flex-shrink: 0;
        }
        /* ── USER ICON BUTTON ── */
        .user-icon-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px 8px;
            border-radius: 8px;
            color: #374151;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            width: auto;
            flex-shrink: 0;
        }
        .user-icon-btn:hover {
            background: #EBF3FF;
            color: #0052CC;
        }
        html.dark .user-icon-btn { color: #D1D5DB; }
        html.dark .user-icon-btn:hover { background: rgba(0,82,204,0.15); color: #2684FF; }
        .user-icon-btn span {
            font-size: 0.65rem;
            font-weight: 600;
            line-height: 1;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">

{{-- ===== TOP BAR ===== --}}
<div class="topbar">
    <div style="max-width:80rem;margin:0 auto;padding:0 16px;display:flex;justify-content:space-between;align-items:center;">
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="https://wa.me/51999999999" target="_blank" class="whatsapp-btn">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WHATSAPP VENTAS
            </a>
            <span style="color:rgba(255,255,255,0.6);display:none;" class="sm-show">|</span>
            <span style="color:rgba(255,255,255,0.7);font-size:0.75rem;display:none;" class="sm-show">📍 Lima, Perú</span>
        </div>
        <nav style="display:none;align-items:center;gap:20px;" class="md-show">
            <a href="/nosotros">Sobre nosotros</a>
            <a href="/terminos">Términos y condiciones</a>
            <a href="/seguimiento" style="font-weight:600;color:white;">🔍 Seguimiento de pedido</a>
        </nav>
    </div>
</div>

{{-- ===== HEADER ===== --}}
<header class="site-header">
    <div class="header-inner">

        {{-- Logo --}}
        <a href="/" class="header-logo">
            <img src="{{ asset('img/logo.png') }}" alt="Compured Perú" style="height:48px;" onerror="this.style.display='none'">
        </a>

        {{-- Search --}}
        <div class="header-search" x-data="{ open: false }">
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

        {{-- Right Actions --}}
        <div class="header-actions">

            {{-- Dark Mode Toggle --}}
            <div class="dark-toggle-wrap" title="Modo oscuro/claro">
                <span id="theme-icon" style="font-size:1rem;cursor:pointer;" onclick="toggleDark()">🌙</span>
                <button class="dark-toggle" onclick="toggleDark()" aria-label="Cambiar tema"></button>
            </div>

            {{-- User Menu --}}
            @auth
            {{-- Logueado: ícono persona con dropdown --}}
            <div x-data="{ open: false }" style="position:relative;">
                <button @click="open = !open" class="user-icon-btn" title="{{ auth()->user()->nombre_completo ?? auth()->user()->name ?? 'Mi cuenta' }}">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Mi cuenta</span>
                </button>
                <div x-show="open" @click.away="open = false" x-cloak class="user-dropdown" style="position:absolute;right:0;margin-top:8px;z-index:50;min-width:190px;">
                    <div style="padding:10px 16px;border-bottom:1px solid #F3F4F6;font-size:0.75rem;color:#6B7280;font-weight:600;">
                        👤 {{ auth()->user()->nombre_completo ?? auth()->user()->name ?? 'Usuario' }}
                    </div>
                    <a href="/dashboard">📊 Panel de usuario</a>
                    <a href="{{ route('profile.edit') }}">⚙️ Editar perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="danger" style="width:100%;text-align:left;padding:10px 16px;background:none;border:none;cursor:pointer;font-size:0.85rem;color:#DC2626;">🚪 Cerrar sesión</button>
                    </form>
                </div>
            </div>
            @else
            {{-- No logueado: mismo ícono persona que lleva al login --}}
            <a href="{{ route('login') }}" class="user-icon-btn" title="Iniciar sesión">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>Ingresar</span>
            </a>
            @endauth

            {{-- Cart --}}
            <a href="/carrito" class="cart-icon">
                <div style="position:relative;">
                    <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span class="cart-badge">{{ session('carrito') ? count(session('carrito')) : 0 }}</span>
                </div>
                <span style="font-size:0.7rem;font-weight:600;margin-top:2px;">Carrito</span>
            </a>
        </div>
    </div>
</header>

{{-- ===== MAIN ===== --}}
<main style="flex-grow:1;">
    @yield('content')
</main>

{{-- ===== FOOTER ===== --}}
<footer class="site-footer" style="padding-top:40px;padding-bottom:0;margin-top:48px;">
    <div style="max-width:80rem;margin:0 auto;padding:0 16px 40px;display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:40px;">
        <div>
            <div style="margin-bottom:16px;">
                <span style="font-family:'Rajdhani',sans-serif;font-size:1.5rem;font-weight:800;color:white;">COMPURED<span style="color:#8CC63F;">PERÚ</span></span>
            </div>
            <p style="font-size:0.875rem;color:rgba(255,255,255,0.6);line-height:1.625;margin-bottom:16px;">Tecnología informática a tu alcance. Venta de computadoras, laptops, accesorios y más para toda persona en Perú.</p>
            <a href="https://wa.me/51999999999" target="_blank" class="whatsapp-btn" style="display:inline-flex;">
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
        <span style="margin-left:16px;color:rgba(255,255,255,0.2);">Tecnología Informática a tu Alcance</span>
    </div>
</footer>

</body>
</html>
