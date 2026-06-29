<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Compured Perú – Tecnología Informática a tu Alcance')</title>

    <link rel="icon" href="{{ asset('img/logo.png') }}">

    <!-- Tipografías usadas en todo el sitio (Rajdhani para títulos) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Aplica el tema guardado antes de pintar la página (evita parpadeo)
        (function () {
            const saved = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = saved || (prefersDark ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <style>
        :root {
            --bg: #f0f4ff; --card: rgba(255,255,255,0.92); --text: #0f172a; --muted: #64748b;
            --border: #cbd5e1; --input-bg: #f8fafc; --primary: #1d4ed8; --primary-hover: #1e40af;
            --accent: #3b82f6; --shadow: 0 25px 60px rgba(0,0,0,0.18); --error: #dc2626;
        }
        [data-theme="dark"] {
            --bg: #0a0f1e; --card: rgba(15,23,42,0.93); --text: #f1f5f9; --muted: #94a3b8;
            --border: #1e3a5f; --input-bg: #0f172a; --primary: #3b82f6; --primary-hover: #2563eb;
            --accent: #60a5fa; --shadow: 0 25px 60px rgba(0,0,0,0.6); --error: #f87171;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', system-ui, sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        a { text-decoration: none; }

        .cp-navbar {
            position: sticky; top: 0; z-index: 50;
            background: var(--card);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }
        .cp-navbar-inner {
            max-width: 1280px; margin: 0 auto; padding: 14px 20px;
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
        }
        .cp-logo { display: flex; align-items: center; gap: 8px; }
        .cp-logo img { height: 38px; width: auto; }
        .cp-logo span {
            font-family: 'Rajdhani', sans-serif; font-weight: 800; font-size: 18px; color: var(--text);
        }
        .cp-nav-links { display: flex; align-items: center; gap: 22px; }
        .cp-nav-links a {
            font-weight: 600; font-size: 14px; color: var(--muted);
            transition: color 0.2s ease;
        }
        .cp-nav-links a:hover, .cp-nav-links a.active { color: var(--primary); }
        .cp-nav-actions { display: flex; align-items: center; gap: 10px; }
        .cp-icon-btn {
            display: inline-flex; align-items: center; justify-content: center;
            width: 38px; height: 38px; border-radius: 10px;
            background: var(--input-bg); border: 1px solid var(--border);
            color: var(--text); cursor: pointer; font-size: 16px;
            transition: background 0.2s ease;
        }
        .cp-icon-btn:hover { background: var(--border); }
        .cp-btn-primary {
            background: var(--primary); color: #fff; font-weight: 700; font-size: 14px;
            padding: 9px 18px; border-radius: 10px; transition: background 0.2s ease;
        }
        .cp-btn-primary:hover { background: var(--primary-hover); }
        .cp-mobile-toggle { display: none; background: none; border: none; font-size: 22px; color: var(--text); cursor: pointer; }
        .cp-mobile-menu { display: none; flex-direction: column; gap: 12px; padding: 16px 20px; border-top: 1px solid var(--border); }
        .cp-mobile-menu.open { display: flex; }

        @media (max-width: 860px) {
            .cp-nav-links { display: none; }
            .cp-mobile-toggle { display: inline-flex; }
        }

        .cp-footer {
            background: var(--card); border-top: 1px solid var(--border);
            margin-top: 60px; padding: 36px 20px 24px;
            color: var(--muted); font-size: 13px;
        }
        .cp-footer-inner { max-width: 1280px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 16px; }
        .cp-footer a { color: var(--muted); }
        .cp-footer a:hover { color: var(--primary); }
    </style>

    @yield('styles')
</head>
<body>

    <nav class="cp-navbar">
        <div class="cp-navbar-inner">
            <a href="{{ route('home') }}" class="cp-logo">
                <img src="{{ asset('img/logo.png') }}" alt="Compured Perú">
                <span>Compured Perú</span>
            </a>

            <div class="cp-nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a>
                <a href="{{ route('categoria') }}" class="{{ request()->routeIs('categoria') ? 'active' : '' }}">Categorías</a>
                <a href="{{ route('nosotros') }}" class="{{ request()->routeIs('nosotros') ? 'active' : '' }}">Nosotros</a>
                <a href="{{ route('terminos') }}" class="{{ request()->routeIs('terminos') ? 'active' : '' }}">Términos</a>
            </div>

            <div class="cp-nav-actions">
                <button type="button" class="cp-icon-btn" id="cp-theme-toggle" title="Cambiar tema">
                    <span id="cp-theme-icon">🌙</span>
                </button>

                <a href="{{ route('carrito.index') }}" class="cp-icon-btn" title="Carrito">🛒</a>

                @auth
                    <a href="{{ route('dashboard') }}" class="cp-btn-primary">Mi Panel</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="cp-icon-btn" title="Cerrar sesión">↩️</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="cp-btn-primary">Ingresar</a>
                @endauth

                <button type="button" class="cp-mobile-toggle" id="cp-mobile-toggle">☰</button>
            </div>
        </div>

        <div class="cp-mobile-menu" id="cp-mobile-menu">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('categoria') }}">Categorías</a>
            <a href="{{ route('nosotros') }}">Nosotros</a>
            <a href="{{ route('terminos') }}">Términos</a>
            <a href="{{ route('carrito.index') }}">Carrito</a>
            @auth
                <a href="{{ route('dashboard') }}">Mi Panel</a>
            @else
                <a href="{{ route('login') }}">Ingresar</a>
            @endauth
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="cp-footer">
        <div class="cp-footer-inner">
            <div>&copy; {{ date('Y') }} Compured Perú. Todos los derechos reservados.</div>
            <div style="display:flex; gap:16px;">
                <a href="{{ route('nosotros') }}">Nosotros</a>
                <a href="{{ route('terminos') }}">Términos</a>
                <a href="{{ route('seguimiento') }}">Seguimiento de pedido</a>
            </div>
        </div>
    </footer>

    <script>
        // Toggle de tema (sincronizado con el resto de páginas del sitio)
        const themeBtn = document.getElementById('cp-theme-toggle');
        const themeIcon = document.getElementById('cp-theme-icon');

        function syncThemeIcon() {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            themeIcon.textContent = isDark ? '☀️' : '🌙';
        }
        syncThemeIcon();

        themeBtn?.addEventListener('click', function () {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            const newTheme = isDark ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            syncThemeIcon();
        });

        // Menú móvil
        const mobileToggle = document.getElementById('cp-mobile-toggle');
        const mobileMenu = document.getElementById('cp-mobile-menu');
        mobileToggle?.addEventListener('click', function () {
            mobileMenu.classList.toggle('open');
        });
    </script>

    @yield('scripts')
</body>
</html>
