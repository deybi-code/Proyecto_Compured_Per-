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
        svg { display: block; }

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
            width: 40px; height: 40px; border-radius: 10px;
            background: var(--input-bg); border: 1px solid var(--border);
            color: var(--text); cursor: pointer;
            transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
            position: relative;
        }
        .cp-icon-btn:hover { background: var(--border); color: var(--primary); }
        .cp-icon-btn svg { width: 19px; height: 19px; }

        .cp-cart-badge {
            position: absolute; top: -5px; right: -5px;
            background: var(--primary); color: #fff;
            font-size: 10px; font-weight: 800; line-height: 1;
            min-width: 16px; height: 16px; border-radius: 999px;
            display: flex; align-items: center; justify-content: center;
            padding: 0 3px;
        }

        .cp-btn-primary {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--primary); color: #fff; font-weight: 700; font-size: 14px;
            padding: 9px 16px; border-radius: 10px; transition: background 0.2s ease;
        }
        .cp-btn-primary:hover { background: var(--primary-hover); }
        .cp-btn-primary svg { width: 16px; height: 16px; }

        .cp-mobile-toggle {
            display: none; align-items: center; justify-content: center;
            width: 40px; height: 40px; border-radius: 10px;
            background: var(--input-bg); border: 1px solid var(--border);
            color: var(--text); cursor: pointer;
        }
        .cp-mobile-toggle svg { width: 19px; height: 19px; }
        .cp-mobile-menu { display: none; flex-direction: column; gap: 12px; padding: 16px 20px; border-top: 1px solid var(--border); }
        .cp-mobile-menu.open { display: flex; }
        .cp-mobile-menu a, .cp-mobile-menu button {
            display: flex; align-items: center; gap: 10px;
            font-weight: 600; font-size: 14px; color: var(--text);
            background: none; border: none; padding: 0; text-align: left; cursor: pointer; font-family: inherit;
        }
        .cp-mobile-menu svg { width: 17px; height: 17px; }

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

        .cp-user-menu { position: relative; }
        .cp-user-dropdown {
            position: absolute; right: 0; top: calc(100% + 10px);
            min-width: 220px; background: var(--card); border: 1px solid var(--border);
            border-radius: 14px; box-shadow: var(--shadow);
            padding: 8px; display: none; flex-direction: column; gap: 2px;
            backdrop-filter: blur(12px); z-index: 60;
        }
        .cp-user-dropdown.open { display: flex; }
        .cp-user-dropdown-header {
            padding: 8px 10px 10px; margin-bottom: 4px; border-bottom: 1px solid var(--border);
        }
        .cp-user-dropdown-header .name { font-weight: 700; font-size: 13.5px; color: var(--text); }
        .cp-user-dropdown-header .role {
            display: inline-block; margin-top: 4px;
            font-size: 10.5px; font-weight: 700; letter-spacing: .03em; text-transform: uppercase;
            color: var(--primary); background: color-mix(in srgb, var(--primary) 14%, transparent);
            padding: 2px 8px; border-radius: 999px;
        }
        .cp-user-dropdown a, .cp-user-dropdown button {
            display: flex; align-items: center; gap: 10px;
            width: 100%; text-align: left; background: none; border: none;
            font-family: inherit; font-size: 14px; font-weight: 600; color: var(--text);
            padding: 10px; border-radius: 9px; cursor: pointer;
            transition: background 0.15s ease;
        }
        .cp-user-dropdown svg { width: 17px; height: 17px; flex-shrink: 0; }
        .cp-user-dropdown a:hover, .cp-user-dropdown button:hover { background: var(--input-bg); }
        .cp-user-dropdown button.danger { color: var(--error); }
        .cp-user-dropdown .divider { height: 1px; background: var(--border); margin: 4px 2px; }
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
                {{-- Toggle de tema --}}
                <button type="button" class="cp-icon-btn" id="cp-theme-toggle" title="Cambiar tema">
                    {{-- Sol --}}
                    <svg id="cp-icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="4.2"/>
                        <path d="M12 2.5v2.4M12 19.1v2.4M4.2 4.2l1.7 1.7M18.1 18.1l1.7 1.7M2.5 12h2.4M19.1 12h2.4M4.2 19.8l1.7-1.7M18.1 5.9l1.7-1.7"/>
                    </svg>
                    {{-- Luna --}}
                    <svg id="cp-icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                        <path d="M20.5 14.5A8.5 8.5 0 1 1 9.5 3.5a7 7 0 0 0 11 11z"/>
                    </svg>
                </button>

                {{-- Carrito --}}
                <a href="{{ route('carrito.index') }}" class="cp-icon-btn" title="Carrito">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="20" r="1.4"/>
                        <circle cx="18" cy="20" r="1.4"/>
                        <path d="M2.5 3h2.2l2.2 12.2a2 2 0 0 0 2 1.6h8.6a2 2 0 0 0 2-1.6L21 7H6"/>
                    </svg>
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="cp-btn-primary">
                        @if(auth()->user()->rol === 'admin')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.5l7.5 3.4v5.4c0 5-3.2 8-7.5 9.7-4.3-1.7-7.5-4.7-7.5-9.7V5.9L12 2.5z"/></svg>
                            Panel Admin
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="3" y="13.5" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="13.5" width="7.5" height="7.5" rx="1.5"/></svg>
                            Mi Panel
                        @endif
                    </a>

                    <div class="cp-user-menu" id="cp-user-menu">
                        <button type="button" class="cp-icon-btn" id="cp-user-toggle" title="Mi cuenta">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="3.6"/>
                                <path d="M4.5 20.5c0-3.6 3.4-6.2 7.5-6.2s7.5 2.6 7.5 6.2"/>
                            </svg>
                        </button>

                        <div class="cp-user-dropdown" id="cp-user-dropdown">
                            <div class="cp-user-dropdown-header">
                                <div class="name">{{ auth()->user()->nombre_completo ?? 'Mi cuenta' }}</div>
                                <span class="role">{{ auth()->user()->rol === 'admin' ? 'Administrador' : 'Cliente' }}</span>
                            </div>

                            <a href="{{ route('dashboard') }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="3" y="13.5" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="13.5" width="7.5" height="7.5" rx="1.5"/></svg>
                                Panel de Usuario
                            </a>

                            <a href="{{ route('profile.edit') }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15.7 3.3a2 2 0 0 1 2.8 2.8L8 16.6l-4 1 1-4L15.7 3.3z"/></svg>
                                Editar Perfil
                            </a>

                            <div class="divider"></div>

                            <form method="POST" action="{{ route('logout') }}" style="margin:0">
                                @csrf
                                <button type="submit" class="danger">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 17l5-5-5-5M20 12H9M13 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7"/></svg>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="cp-btn-primary">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 17l5-5-5-5M4 12h10M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4"/></svg>
                        Ingresar
                    </a>
                @endauth

                <button type="button" class="cp-mobile-toggle" id="cp-mobile-toggle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <div class="cp-mobile-menu" id="cp-mobile-menu">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('categoria') }}">Categorías</a>
            <a href="{{ route('nosotros') }}">Nosotros</a>
            <a href="{{ route('terminos') }}">Términos</a>
            <a href="{{ route('carrito.index') }}">Carrito</a>
            @auth
                <a href="{{ route('dashboard') }}">{{ auth()->user()->rol === 'admin' ? 'Panel Admin' : 'Panel de Usuario' }}</a>
                <a href="{{ route('profile.edit') }}">Editar Perfil</a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">
                    @csrf
                    <button type="submit" style="color:var(--error);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 17l5-5-5-5M20 12H9M13 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7"/></svg>
                        Cerrar Sesión
                    </button>
                </form>
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
        const themeBtn  = document.getElementById('cp-theme-toggle');
        const iconSun   = document.getElementById('cp-icon-sun');
        const iconMoon  = document.getElementById('cp-icon-moon');

        function syncThemeIcon() {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            iconSun.style.display  = isDark ? 'none' : 'block';
            iconMoon.style.display = isDark ? 'block' : 'none';
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

        // Dropdown de usuario (panel / perfil / cerrar sesión)
        const userToggle = document.getElementById('cp-user-toggle');
        const userDropdown = document.getElementById('cp-user-dropdown');
        userToggle?.addEventListener('click', function (e) {
            e.stopPropagation();
            userDropdown.classList.toggle('open');
        });
        document.addEventListener('click', function (e) {
            if (userDropdown && !document.getElementById('cp-user-menu').contains(e.target)) {
                userDropdown.classList.remove('open');
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
