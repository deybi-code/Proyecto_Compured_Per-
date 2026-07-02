<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — CompuredPerú</title>

    <link rel="icon" href="{{ asset('img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Aplica el tema guardado antes de pintar (evita parpadeo)
        (function () {
            // Tema por defecto: SIEMPRE claro, salvo que el usuario haya elegido
            // oscuro antes (guardado en localStorage). Ya no se sigue el modo
            // oscuro del sistema operativo.
            const saved = localStorage.getItem('theme');
            const theme = saved === 'dark' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <style>
        /* ===== TOKENS — mismos que el home ===== */
        :root {
            --bg: #f0f4ff;
            --card: rgba(255,255,255,0.96);
            --text: #0f172a;
            --muted: #64748b;
            --border: #cbd5e1;
            --input-bg: #f8fafc;
            --primary: #1d4ed8;
            --primary-hover: #1e40af;
            --accent: #3b82f6;
            --shadow: 0 25px 60px rgba(0,0,0,0.18);
            --error: #dc2626;
            --sidebar-bg: #ffffff;
            --sidebar-border: #e2e8f0;
            --sidebar-text: #475569;
            --sidebar-text-hover: #1d4ed8;
            --sidebar-label: #94a3b8;
            --sidebar-hover-bg: rgba(29,78,216,0.08);
            --sidebar-active-bg: rgba(29,78,216,0.1);
            --sidebar-active-text: #1d4ed8;
            --sidebar-active-border: #1d4ed8;
        }
        [data-theme="dark"] {
            --bg: #0a0f1e;
            --card: rgba(15,23,42,0.97);
            --text: #f1f5f9;
            --muted: #94a3b8;
            --border: #1e3a5f;
            --input-bg: #0f172a;
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --accent: #60a5fa;
            --shadow: 0 25px 60px rgba(0,0,0,0.6);
            --error: #f87171;
            --sidebar-bg: #020617;
            --sidebar-border: rgba(255,255,255,0.05);
            --sidebar-text: #94a3b8;
            --sidebar-text-hover: #ffffff;
            --sidebar-label: #475569;
            --sidebar-hover-bg: rgba(255,255,255,0.08);
            --sidebar-active-bg: rgba(59,130,246,0.18);
            --sidebar-active-text: #93c5fd;
            --sidebar-active-border: #3b82f6;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        a { text-decoration: none; }
        svg { display: block; }

        /* ===== NAVBAR (idéntico al home) ===== */
        .cp-navbar {
            position: sticky; top: 0; z-index: 100;
            background: var(--card);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }
        .cp-navbar-inner {
            max-width: 100%; padding: 13px 24px;
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
        }
        .cp-logo { display: flex; align-items: center; gap: 8px; }
        .cp-logo img { height: 38px; width: auto; }

        /* Links de navegación admin */

        /* ===== MOBILE FIXES FOR ADMIN ===== */
        @media (max-width: 768px) {
            .cp-navbar-inner {
                padding: 12px 16px;
            }
            .admin-sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                width: 280px;
                height: 100vh;
                z-index: 1000;
                transition: left 0.3s ease;
                background: var(--sidebar-bg);
                border-right: 1px solid var(--sidebar-border);
            }
            .admin-sidebar.open {
                left: 0;
            }
            .admin-sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }
            .admin-sidebar-overlay.open {
                display: block;
            }
            .admin-content {
                padding: 16px;
            }
            .card {
                border-radius: 12px;
                padding: 16px;
            }
            button, a, input, select {
                min-height: 48px;
                min-width: 48px;
            }
        }
        .cp-nav-links { display: flex; align-items: center; gap: 6px; }
        .cp-nav-links a {
            font-weight: 600; font-size: 13.5px; color: var(--muted);
            padding: 7px 12px; border-radius: 8px;
            transition: color 0.2s, background 0.2s;
        }
        .cp-nav-links a:hover { color: var(--primary); background: color-mix(in srgb, var(--primary) 8%, transparent); }
        .cp-nav-links a.active { color: var(--primary); background: color-mix(in srgb, var(--primary) 10%, transparent); }

        /* Badge "ADMIN" en el nav */
        .cp-admin-badge {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 11px; font-weight: 800; letter-spacing: .05em;
            text-transform: uppercase; color: var(--primary);
            background: color-mix(in srgb, var(--primary) 12%, transparent);
            border: 1px solid color-mix(in srgb, var(--primary) 25%, transparent);
            padding: 3px 10px; border-radius: 999px;
        }

        .cp-nav-actions { display: flex; align-items: center; gap: 10px; }

        .cp-icon-btn {
            display: inline-flex; align-items: center; justify-content: center;
            width: 40px; height: 40px; border-radius: 10px;
            background: var(--input-bg); border: 1px solid var(--border);
            color: var(--text); cursor: pointer;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
        }
        .cp-icon-btn:hover { background: var(--border); color: var(--primary); }
        .cp-icon-btn svg { width: 19px; height: 19px; }

        .cp-btn-primary {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--primary); color: #fff;
            font-weight: 700; font-size: 13.5px;
            padding: 9px 16px; border-radius: 10px;
            transition: background 0.2s;
        }
        .cp-btn-primary:hover { background: var(--primary-hover); }
        .cp-btn-primary svg { width: 16px; height: 16px; }

        .cp-btn-ghost {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--input-bg); color: var(--muted);
            font-weight: 600; font-size: 13.5px;
            padding: 9px 16px; border-radius: 10px;
            border: 1px solid var(--border);
            transition: background 0.2s, color 0.2s;
        }
        .cp-btn-ghost:hover { background: var(--border); color: var(--text); }
        .cp-btn-ghost svg { width: 16px; height: 16px; }

        /* Mobile toggle */
        .cp-mobile-toggle {
            display: none; align-items: center; justify-content: center;
            width: 40px; height: 40px; border-radius: 10px;
            background: var(--input-bg); border: 1px solid var(--border);
            color: var(--text); cursor: pointer;
        }
        .cp-mobile-menu {
            display: none; flex-direction: column; gap: 6px;
            padding: 14px 20px; border-top: 1px solid var(--border);
            background: var(--card);
        }
        .cp-mobile-menu.open { display: flex; }
        .cp-mobile-menu a, .cp-mobile-menu button {
            display: flex; align-items: center; gap: 10px;
            font-weight: 600; font-size: 14px; color: var(--text);
            background: none; border: none; padding: 9px 12px; border-radius: 8px;
            text-align: left; cursor: pointer; font-family: inherit;
        }
        .cp-mobile-menu a:hover, .cp-mobile-menu button:hover {
            background: var(--input-bg); color: var(--primary);
        }

        @media (max-width: 860px) {
            .cp-nav-links { display: none; }
            .cp-mobile-toggle { display: inline-flex; }
        }

        /* ===== LAYOUT ADMIN ===== */
        .admin-layout {
            display: flex;
            min-height: calc(100vh - 67px);
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            width: 240px;
            min-height: 100%;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            padding: 20px 14px;
            flex-shrink: 0;
            border-right: 1px solid var(--sidebar-border);
        }

        .sidebar-section-label {
            font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
            text-transform: uppercase; color: var(--sidebar-label);
            padding: 4px 10px; margin: 14px 0 6px;
        }
        .sidebar-section-label:first-child { margin-top: 0; }

        .sidebar-link {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            color: var(--sidebar-text); font-size: 13.5px; font-weight: 600;
            text-decoration: none; margin-bottom: 2px;
            transition: background 0.18s, color 0.18s;
        }
        .sidebar-link:hover { background: var(--sidebar-hover-bg); color: var(--sidebar-text-hover); }
        .sidebar-link.active {
            background: var(--sidebar-active-bg);
            color: var(--sidebar-active-text);
            border-left: 3px solid var(--sidebar-active-border);
            padding-left: 9px;
        }
        .sidebar-link svg { width: 17px; height: 17px; flex-shrink: 0; }

        /* ===== CONTENT ===== */
        .admin-content {
            flex: 1;
            padding: 28px 32px;
            overflow-y: auto;
            background: var(--bg);
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            color: var(--text);
        }

        /* ===== ALERTAS FLASH ===== */
        .cp-flash-msg {
            display: flex; align-items: center; gap: 10px;
            padding: 13px 16px; border-radius: 10px;
            font-size: 14px; font-weight: 600; margin-bottom: 18px;
        }
        .cp-flash-success { background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); color: #059669; }
        .cp-flash-error   { background: rgba(239,68,68,0.1);  border: 1px solid rgba(239,68,68,0.3);  color: var(--error); }

        @media (max-width: 768px) {
            .admin-sidebar { display: none; }
            .admin-content { padding: 20px 16px; }
        }
    </style>

    @yield('styles')
</head>
<body>

{{-- ===== NAVBAR (mismo que home) ===== --}}
<nav class="cp-navbar">
    <div class="cp-navbar-inner">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="cp-logo">
            <img src="{{ asset('img/logo.png') }}" alt="CompuredPerú">
        </a>

        {{-- BADGE + LINKS ADMIN (desktop) --}}
        <div class="cp-nav-links">
            <span class="cp-admin-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:11px;height:11px;">
                    <path d="M12 2.5l7.5 3.4v5.4c0 5-3.2 8-7.5 9.7-4.3-1.7-7.5-4.7-7.5-9.7V5.9L12 2.5z"/>
                </svg>
                Admin
            </span>

            <a href="{{ route('admin.panel') }}" class="{{ request()->routeIs('admin.panel') ? 'active' : '' }}">
                Panel
            </a>
            <a href="{{ route('admin.productos.index') }}" class="{{ request()->routeIs('admin.productos.*') ? 'active' : '' }}">
                Productos
            </a>
            <a href="{{ route('admin.ventas.index') }}" class="{{ request()->routeIs('admin.ventas.*') ? 'active' : '' }}">
                Ventas
            </a>
            <a href="{{ route('admin.anuncios.index') }}" class="{{ request()->routeIs('admin.anuncios.*') ? 'active' : '' }}">
                Anuncios
            </a>
        </div>

        {{-- ACCIONES DERECHA --}}
        <div class="cp-nav-actions">

            {{-- Tema --}}
            <button type="button" class="cp-icon-btn" id="cp-theme-toggle" title="Cambiar tema">
                <svg id="cp-icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="4.2"/>
                    <path d="M12 2.5v2.4M12 19.1v2.4M4.2 4.2l1.7 1.7M18.1 18.1l1.7 1.7M2.5 12h2.4M19.1 12h2.4M4.2 19.8l1.7-1.7M18.1 5.9l1.7-1.7"/>
                </svg>
                <svg id="cp-icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                    <path d="M20.5 14.5A8.5 8.5 0 1 1 9.5 3.5a7 7 0 0 0 11 11z"/>
                </svg>
            </button>

            {{-- Ver sitio --}}
            <a href="{{ route('home') }}" class="cp-btn-ghost" target="_blank">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"/><path d="M12 3c-2.5 2.5-4 5.7-4 9s1.5 6.5 4 9M12 3c2.5 2.5 4 5.7 4 9s-1.5 6.5-4 9M3 12h18"/>
                </svg>
                Ver sitio
            </a>

            {{-- Cerrar sesión --}}
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="cp-icon-btn" title="Cerrar sesión">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
                    </svg>
                </button>
            </form>

            {{-- Mobile toggle --}}
            <button type="button" class="cp-mobile-toggle" id="cp-mobile-toggle">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:19px;height:19px;">
                    <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div class="cp-mobile-menu" id="cp-mobile-menu">
        <a href="{{ route('admin.panel') }}">🏠 Panel</a>
        <a href="{{ route('admin.productos.index') }}">📦 Productos</a>
        <a href="{{ route('admin.ventas.index') }}">💰 Ventas</a>
        <a href="{{ route('admin.anuncios.index') }}">📢 Anuncios</a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit">🚪 Cerrar sesión</button>
        </form>
    </div>
</nav>

{{-- ===== LAYOUT ADMIN ===== --}}
<div class="admin-layout">

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar">

        <div class="sidebar-section-label">Principal</div>
        <a href="{{ route('admin.panel') }}"
           class="sidebar-link {{ request()->routeIs('admin.panel') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            Dashboard
        </a>

        <div class="sidebar-section-label">Inventario</div>
        <a href="{{ route('admin.productos.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.productos.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
            </svg>
            Productos
        </a>

        <div class="sidebar-section-label">Comercial</div>
        <a href="{{ route('admin.ventas.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.ventas.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
            Ventas
        </a>

        <a href="{{ route('admin.anuncios.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.anuncios.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
            </svg>
            Anuncios
        </a>

        <div class="sidebar-section-label">Sistema</div>
        <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9"/><path d="M12 3c-2.5 2.5-4 5.7-4 9s1.5 6.5 4 9M12 3c2.5 2.5 4 5.7 4 9s-1.5 6.5-4 9M3 12h18"/>
            </svg>
            Ver tienda
        </a>

    </aside>

    {{-- CONTENIDO --}}
    <main class="admin-content">

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="cp-flash-msg cp-flash-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="cp-flash-msg cp-flash-error">⚠️ {{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

</div>

<script>
    // ── TEMA (mismo script que el home) ──────────────────────────────
    const htmlRoot    = document.documentElement;
    const toggleBtn   = document.getElementById('cp-theme-toggle');
    const iconSun     = document.getElementById('cp-icon-sun');
    const iconMoon    = document.getElementById('cp-icon-moon');

    function applyTheme(theme) {
        htmlRoot.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        if (theme === 'dark') {
            iconSun.style.display  = 'none';
            iconMoon.style.display = 'block';
        } else {
            iconSun.style.display  = 'block';
            iconMoon.style.display = 'none';
        }
    }

    // Aplicar el tema actual al cargar
    applyTheme(localStorage.getItem('theme') || 'light');

    toggleBtn.addEventListener('click', () => {
        const current = htmlRoot.getAttribute('data-theme');
        applyTheme(current === 'dark' ? 'light' : 'dark');
    });

    // ── MENÚ MOBILE ───────────────────────────────────────────────────
    const mobileToggle = document.getElementById('cp-mobile-toggle');
    const mobileMenu   = document.getElementById('cp-mobile-menu');
    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });
    }
</script>

</body>
</html>
