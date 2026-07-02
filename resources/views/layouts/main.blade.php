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
        (function () {
            const saved = localStorage.getItem('theme') || localStorage.getItem('cpTheme');
            const theme = saved === 'dark' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', theme);
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <style>
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
            background: #ffffff;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }
        @media (max-width: 768px) {
            .cp-navbar { display: none; }
        }
        html.dark .cp-navbar,
        html[data-theme="dark"] .cp-navbar {
            background: var(--card);
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
            position: absolute; top: -6px; right: -6px;
            min-width: 18px; height: 18px; padding: 0 4px;
            border-radius: 999px; background: var(--primary); color: #fff;
            font-size: 11px; font-weight: 800; line-height: 18px; text-align: center;
        }

        .cp-flash { max-width: 1280px; margin: 16px auto 0; padding: 0 20px; }
        .cp-flash-msg {
            display: flex; align-items: center; gap: 10px;
            padding: 14px 18px; border-radius: 12px; font-size: 14px; font-weight: 600;
            margin-bottom: 12px; animation: cpFlashIn 0.3s ease;
        }
        .cp-flash-success { background: rgba(140, 198, 63, 0.12); border: 1px solid rgba(140, 198, 63, 0.35); color: var(--cp-green-dark, #6EA82E); }
        .cp-flash-error { background: rgba(0, 82, 204, 0.08); border: 1px solid rgba(0, 58, 153, 0.22); color: var(--cp-blue-dark, #003A99); }
        @keyframes cpFlashIn { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }

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
            width: 44px; height: 44px; border-radius: 12px;
            background: var(--input-bg); border: 1px solid var(--border);
            color: var(--text); cursor: pointer;
            transition: all 0.2s ease;
        }
        .cp-mobile-toggle:hover { background: var(--border); }
        .cp-mobile-toggle svg { width: 20px; height: 20px; }
        .cp-mobile-menu { 
            display: none; 
            flex-direction: column; 
            gap: 8px; 
            padding: 20px; 
            border-top: 1px solid var(--border);
            background: var(--card);
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }
        .cp-mobile-menu.open { 
            display: flex;
            max-height: 500px;
            padding: 20px;
        }
        .cp-mobile-menu a, .cp-mobile-menu button {
            display: flex; align-items: center; gap: 12px;
            font-weight: 600; font-size: 15px; color: var(--text);
            background: var(--input-bg); border: 1px solid var(--border);
            padding: 14px 16px; text-align: left; cursor: pointer; font-family: inherit;
            border-radius: 12px;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .cp-mobile-menu a:hover, .cp-mobile-menu button:hover {
            background: rgba(59, 130, 246, 0.08);
            border-color: var(--primary);
            color: var(--primary);
        }
        .cp-mobile-menu svg { width: 18px; height: 18px; flex-shrink: 0; }
        .cp-mobile-menu-divider {
            height: 1px;
            background: var(--border);
            margin: 8px 0;
        }
        .cp-mobile-menu-section {
            font-size: 11px;
            font-weight: 800;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 12px 0 8px 0;
        }

        @media (max-width: 860px) {
            .cp-nav-links { display: none; }
            .cp-mobile-toggle { display: inline-flex; }
            .cp-nav-actions { gap: 8px; }
            .cp-icon-btn { width: 44px; height: 44px; }
        }
        /* Ocultar menú móvil antiguo en favor del drawer profesional */
        .cp-mobile-toggle, .cp-mobile-menu { display: none !important; }

        /* Botón flotante WhatsApp exclusivo móvil */
        .cp-whatsapp-float {
            display: none;
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 60px;
            height: 60px;
            background: #25D366;
            border-radius: 50%;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.5);
            z-index: 100;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: pulseWhatsApp 2s infinite;
        }
        .cp-whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 28px rgba(37, 211, 102, 0.6);
        }
        .cp-whatsapp-float svg {
            width: 32px;
            height: 32px;
            fill: white;
        }
        @keyframes pulseWhatsApp {
            0%, 100% { box-shadow: 0 4px 20px rgba(37, 211, 102, 0.5); }
            50% { box-shadow: 0 4px 30px rgba(37, 211, 102, 0.7); }
        }
        @media (max-width: 768px) {
            .cp-whatsapp-float { display: flex; }
        }

        .cp-footer {
            background: #ffffff; border-top: 1px solid var(--border);
            margin-top: 60px; padding: 36px 20px 24px;
            color: var(--muted); font-size: 13px;
        }
        html.dark .cp-footer,
        html[data-theme="dark"] .cp-footer {
            background: var(--card);
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
        .cp-user-dropdown button.danger { color: var(--cp-blue-dark, #003A99); }
        .cp-user-dropdown .divider { height: 1px; background: var(--border); margin: 4px 2px; }
    </style>

    @yield('styles')
</head>
<body>

        {{-- Mobile Header (Solo visible en móvil) --}}
        <header class="cp-mobile-header mobile-only">
            <button type="button" class="cp-mobile-menu-btn" id="cp-drawer-toggle" aria-label="Menú">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="cp-mobile-logo">COMPURED</div>
            <div class="cp-mobile-actions">
                <button type="button" class="cp-mobile-icon-btn" id="cp-theme-toggle-mobile" aria-label="Cambiar tema">
                    <svg id="cp-icon-sun-mobile" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"/>
                        <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                    </svg>
                    <svg id="cp-icon-moon-mobile" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                </button>
                <a href="{{ route('carrito.index') }}" class="cp-mobile-icon-btn" aria-label="Carrito">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="20" r="1"/>
                        <circle cx="18" cy="20" r="1"/>
                        <path d="M2.5 3h2.2l2.2 12.2a2 2 0 0 0 2 1.6h8.6a2 2 0 0 0 2-1.6L21 7H6"/>
                    </svg>
                    @php($cpCartCount = collect(session('carrito', []))->sum('cantidad'))
                    @if($cpCartCount > 0)
                        <span class="cp-mobile-badge">{{ $cpCartCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        {{-- Professional Mobile Drawer --}}
        <div class="cp-mobile-drawer-overlay mobile-only" id="cp-drawer-overlay"></div>
        <aside class="cp-mobile-drawer mobile-only" id="cp-drawer">
            <div class="cp-drawer-header">
                <div class="cp-drawer-brand">COMPURED PERÚ</div>
            </div>

            {{-- Mobile Search --}}
            <div style="padding: 0 20px 16px;">
                <form method="GET" action="{{ route('buscar') }}" style="display:flex;">
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="🔍 Buscar productos..."
                           style="width:100%;padding:12px;border:1px solid var(--border);border-radius:12px;outline:none;font-size:14px;background:var(--input-bg);color:var(--text);">
                </form>
            </div>

            <div class="cp-drawer-section">
                <div class="cp-drawer-section-title">Navegación</div>
                <a href="{{ route('home') }}" class="cp-drawer-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Inicio
                </a>
                <a href="{{ route('categoria') }}" class="cp-drawer-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    Categorías
                </a>
                <a href="{{ route('nosotros') }}" class="cp-drawer-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 16v-4"/>
                        <path d="M12 8h.01"/>
                    </svg>
                    Nosotros
                </a>
                <a href="{{ route('carrito.index') }}" class="cp-drawer-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="20" r="1"/>
                        <circle cx="18" cy="20" r="1"/>
                        <path d="M2.5 3h2.2l2.2 12.2a2 2 0 0 0 2 1.6h8.6a2 2 0 0 0 2-1.6L21 7H6"/>
                    </svg>
                    Carrito
                    @if($cpCartCount > 0)
                        <span style="margin-left:auto; background:var(--cp-blue); color:white; font-size:11px; font-weight:800; padding:2px 8px; border-radius:999px;">{{ $cpCartCount }}</span>
                    @endif
                </a>
            </div>
            
            @auth
                @php($rol = strtolower(trim(auth()->user()->rol ?? '')))
                <div class="cp-drawer-section">
                    <div class="cp-drawer-section-title">Mi Cuenta</div>
                    @if($rol === 'admin')
                        <a href="{{ route('admin.productos.index') }}" class="cp-drawer-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            Panel Admin
                        </a>
                        <a href="{{ route('admin.ventas.index') }}" class="cp-drawer-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 17l5-5 4 4 8-8M14 8h6v6"/>
                            </svg>
                            Ventas
                        </a>
                        <a href="{{ route('admin.anuncios.index') }}" class="cp-drawer-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                            Anuncios
                        </a>
                    @elseif(in_array($rol, ['vendedor', 'ventas'], true))
                        <a href="{{ route('admin.ventas.index') }}" class="cp-drawer-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 17l5-5 4 4 8-8M14 8h6v6"/>
                            </svg>
                            Panel de Ventas
                        </a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="cp-drawer-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7.5" height="7.5" rx="1.5"/>
                            <rect x="13.5" y="3" width="7.5" height="7.5" rx="1.5"/>
                            <rect x="3" y="13.5" width="7.5" height="7.5" rx="1.5"/>
                            <rect x="13.5" y="13.5" width="7.5" height="7.5" rx="1.5"/>
                        </svg>
                        {{ in_array($rol, ['admin', 'vendedor', 'ventas'], true) ? 'Mis Compras' : 'Panel de Usuario' }}
                    </a>
                    <a href="{{ route('profile.edit') }}" class="cp-drawer-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15.7 3.3a2 2 0 0 1 2.8 2.8L8 16.6l-4 1 1-4L15.7 3.3z"/>
                        </svg>
                        Editar Perfil
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0">
                        @csrf
                        <button type="submit" class="cp-drawer-item logout" style="width:100%; text-align:left; border:none; background:none; cursor:pointer;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 17l5-5-5-5M20 12H9M13 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7"/>
                            </svg>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            @else
                <div class="cp-drawer-section">
                    <div class="cp-drawer-section-title">Acceso</div>
                    <a href="{{ route('login') }}" class="cp-drawer-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 17l5-5-5-5M4 12h10M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4"/>
                        </svg>
                        Ingresar
                    </a>
                </div>
            @endauth
        </aside>

    <nav class="cp-navbar desktop-only">
        <div class="cp-navbar-inner">
            <a href="{{ route('home') }}" class="cp-logo">
                <img src="{{ asset('img/logo.png') }}" alt="Compured Perú">
            </a>

            <div class="cp-nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a>
                <a href="{{ route('categoria') }}" class="{{ request()->routeIs('categoria') ? 'active' : '' }}">Categorías</a>
                <a href="{{ route('nosotros') }}" class="{{ request()->routeIs('nosotros') ? 'active' : '' }}">Nosotros</a>
                <a href="{{ route('terminos') }}" class="{{ request()->routeIs('terminos') ? 'active' : '' }}">Términos</a>
            </div>

            <div class="cp-nav-actions">
                {{-- Buscador --}}
                <form method="GET" action="{{ route('buscar') }}" style="display:flex;">
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="🔍 Buscar..."
                           style="padding:8px 12px;border:1px solid var(--border);border-radius:8px;outline:none;min-width:200px;font-size:14px;background:var(--input-bg);color:var(--text);">
                </form>

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
                    @php($cpCarritoCount = collect(session('carrito', []))->sum('cantidad'))
                    @if($cpCarritoCount > 0)
                        <span class="cp-cart-badge">{{ $cpCarritoCount }}</span>
                    @endif
                </a>

                @auth
                    @php($rol = strtolower(trim(auth()->user()->rol ?? '')))

                    @if($rol === 'admin')
                        <a href="{{ route('admin.productos.index') }}" class="cp-btn-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.5l7.5 3.4v5.4c0 5-3.2 8-7.5 9.7-4.3-1.7-7.5-4.7-7.5-9.7V5.9L12 2.5z"/></svg>
                            Panel Admin
                        </a>
                    @elseif(in_array($rol, ['vendedor', 'ventas'], true))
                        <a href="{{ route('admin.ventas.index') }}" class="cp-btn-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l5-5 4 4 8-8M14 8h6v6"/></svg>
                            Panel de Ventas
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="cp-btn-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="3" y="13.5" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="13.5" width="7.5" height="7.5" rx="1.5"/></svg>
                            Mi Panel
                        </a>
                    @endif

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
                                <span class="role">
                                    {{ $rol === 'admin' ? 'Administrador' : (in_array($rol, ['vendedor', 'ventas'], true) ? 'Vendedor' : 'Cliente') }}
                                </span>
                            </div>

                            @if($rol === 'admin')
                                <a href="{{ route('admin.productos.index') }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    Productos (Admin)
                                </a>
                                <a href="{{ route('admin.ventas.index') }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l5-5 4 4 8-8M14 8h6v6"/></svg>
                                    Ventas
                                </a>
                                <a href="{{ route('admin.anuncios.index') }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                    Anuncios
                                </a>
                                <div class="divider"></div>
                            @elseif(in_array($rol, ['vendedor', 'ventas'], true))
                                <a href="{{ route('admin.ventas.index') }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l5-5 4 4 8-8M14 8h6v6"/></svg>
                                    Panel de Ventas
                                </a>
                                <div class="divider"></div>
                            @endif

                            <a href="{{ route('dashboard') }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="3" y="13.5" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="13.5" width="7.5" height="7.5" rx="1.5"/></svg>
                                {{ in_array($rol, ['admin', 'vendedor', 'ventas'], true) ? 'Mis Compras' : 'Panel de Usuario' }}
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
            </div>
        </div>
    </nav>

    @if(session('success') || session('error'))
        <div class="cp-flash">
            @if(session('success'))
                <div class="cp-flash-msg cp-flash-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="cp-flash-msg cp-flash-error">⚠️ {{ session('error') }}</div>
            @endif
        </div>
    @endif

    {{-- Bottom Navigation Bar (Solo visible en móvil) --}}
    <nav class="cp-bottom-nav mobile-only">
        <div class="cp-bottom-nav-inner">
            <a href="{{ route('home') }}" class="cp-bottom-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                <span>Inicio</span>
            </a>
            <a href="{{ route('categoria') }}" class="cp-bottom-nav-item {{ request()->routeIs('categoria') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                </svg>
                <span>Categorías</span>
            </a>
            <a href="{{ route('carrito.index') }}" class="cp-bottom-nav-item {{ request()->routeIs('carrito.index') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="20" r="1"/>
                    <circle cx="18" cy="20" r="1"/>
                    <path d="M2.5 3h2.2l2.2 12.2a2 2 0 0 0 2 1.6h8.6a2 2 0 0 0 2-1.6L21 7H6"/>
                </svg>
                <span>Carrito</span>
                @if($cpCartCount > 0)
                    <span style="position:absolute; top:4px; right:4px; min-width:16px; height:16px; background:var(--cp-blue); color:white; font-size:10px; font-weight:800; border-radius:999px; display:flex; align-items:center; justify-content:center; padding:0 4px;">{{ $cpCartCount }}</span>
                @endif
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="cp-bottom-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7.5" height="7.5" rx="1.5"/>
                        <rect x="13.5" y="3" width="7.5" height="7.5" rx="1.5"/>
                        <rect x="3" y="13.5" width="7.5" height="7.5" rx="1.5"/>
                        <rect x="13.5" y="13.5" width="7.5" height="7.5" rx="1.5"/>
                    </svg>
                    <span>Cuenta</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="cp-bottom-nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 17l5-5-5-5M4 12h10M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4"/>
                    </svg>
                    <span>Ingresar</span>
                </a>
            @endauth
        </div>
    </nav>

    @if(session('success') || session('error'))
        <div class="cp-flash">
            @if(session('success'))
                <div class="cp-flash-msg cp-flash-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="cp-flash-msg cp-flash-error">⚠️ {{ session('error') }}</div>
            @endif
        </div>
    @endif

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
        // Toggle de tema (desktop)
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
            localStorage.setItem('cpTheme', newTheme);
            document.documentElement.classList.toggle('dark', newTheme === 'dark');
            syncThemeIcon();
        });

        // Toggle de tema (móvil)
        const themeBtnMobile  = document.getElementById('cp-theme-toggle-mobile');
        const iconSunMobile   = document.getElementById('cp-icon-sun-mobile');
        const iconMoonMobile  = document.getElementById('cp-icon-moon-mobile');

        function syncThemeIconMobile() {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            iconSunMobile.style.display  = isDark ? 'none' : 'block';
            iconMoonMobile.style.display = isDark ? 'block' : 'none';
        }
        syncThemeIconMobile();

        themeBtnMobile?.addEventListener('click', function () {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            const newTheme = isDark ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            localStorage.setItem('cpTheme', newTheme);
            document.documentElement.classList.toggle('dark', newTheme === 'dark');
            syncThemeIconMobile();
        });

        // Professional Mobile Drawer
        const drawerToggle = document.getElementById('cp-drawer-toggle');
        const drawer = document.getElementById('cp-drawer');
        const drawerOverlay = document.getElementById('cp-drawer-overlay');

        function openDrawer() {
            drawer.classList.add('open');
            drawerOverlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeDrawer() {
            drawer.classList.remove('open');
            drawerOverlay.classList.remove('open');
            document.body.style.overflow = '';
        }

        drawerToggle?.addEventListener('click', openDrawer);
        drawerOverlay?.addEventListener('click', closeDrawer);

        // Cerrar drawer al hacer clic en enlaces
        drawer?.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeDrawer);
        });

        // Cerrar drawer con tecla ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && drawer.classList.contains('open')) {
                closeDrawer();
            }
        });

        // Dropdown de usuario (desktop)
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

    {{-- Botón flotante WhatsApp exclusivo móvil --}}
    <a href="https://wa.me/51999999999" target="_blank" class="cp-whatsapp-float" aria-label="Contactar por WhatsApp">
        <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    @yield('scripts')
</body>
</html>
