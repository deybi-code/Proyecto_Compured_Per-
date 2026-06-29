<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - CompuredPeru')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Script ejecutado inmediatamente para evitar parpadeos
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        /* VARIABLES PARA MODO CLARO Y OSCURO AUTOMÁTICO */
        :root {
            --primary: #0056b3;
            --primary-hover: #003d82;
            --accent: #9ad800;
            --accent-hover: #7eb300;

            --bg-body: #f4f7f9;
            --bg-card: #ffffff;
            --bg-hover: #f8fafc;

            --text-main: #0f172a;
            --text-title: #0056b3;
            --text-muted: #64748b;

            --border-color: #e2e8f0;
            --shadow-card: 0 10px 25px -5px rgba(0,0,0,0.05);
            --sidebar-bg: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);

            --icon-bg: #eff6ff;
            --icon-color: #0056b3;
        }

        html.dark {
            --bg-body: #0b1220;
            --bg-card: #111827;
            --bg-hover: #1f2937;

            --text-main: #f8fafc;
            --text-title: #60a5fa; /* Azul más claro para títulos en modo oscuro */
            --text-muted: #94a3b8;

            --border-color: #374151;
            --shadow-card: 0 10px 25px -5px rgba(0,0,0,0.4);
            --sidebar-bg: linear-gradient(180deg, #020617 0%, #0f172a 100%);

            --icon-bg: rgba(0,86,179,0.2);
            --icon-color: #60a5fa;
        }

        /* RESET Y ESTILOS BASE */
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .layout { display: flex; min-height: 100vh; }
        .content { flex: 1; padding: 30px 40px; overflow-y: auto; }

        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-card);
            transition: all 0.3s ease;
            color: var(--text-main);
        }

        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        html.dark ::-webkit-scrollbar-thumb { background: #475569; }

        /* ARREGLOS DE VISIBILIDAD PARA TEXTOS, INPUTS Y TABLAS EN MODO OSCURO */
        h1, h2, h3, h4, h5, p, span, label, div {
            transition: color 0.3s ease;
        }

        .title-text { color: var(--text-title) !important; }
        .muted-text { color: var(--text-muted) !important; }
        .main-text { color: var(--text-main) !important; }

        input, textarea, select {
            background-color: var(--bg-card) !important;
            color: var(--text-main) !important;
            border: 1px solid var(--border-color) !important;
        }

        input::placeholder { color: var(--text-muted); }

        table thead tr {
            background-color: var(--bg-hover) !important;
            border-bottom: 2px solid var(--border-color) !important;
        }
        table th { color: var(--text-muted) !important; }
        table tbody tr { border-bottom: 1px solid var(--border-color) !important; }
        table tbody tr:hover { background-color: var(--bg-hover) !important; }
        table td { color: var(--text-main) !important; }

        hr { border-color: var(--border-color) !important; }
    </style>
</head>

<body>

<div class="layout">

    {{-- SIDEBAR LATERAL LARGO --}}
    <aside style="width: 280px; background: var(--sidebar-bg); display: flex; flex-direction: column; box-shadow: 4px 0 25px rgba(0,0,0,0.2); z-index: 50; flex-shrink: 0; min-height: 100vh;">

        <div style="padding: 40px 25px 30px; border-bottom: 1px solid rgba(255,255,255,0.08); text-align: center; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: radial-gradient(circle, rgba(154,216,0,0.1) 0%, rgba(255,255,255,0) 70%); border-radius: 50%;"></div>
            <h2 style="margin: 0; color: #ffffff; font-size: 30px; font-weight: 900; letter-spacing: 1px; text-transform: uppercase;">
                <span style="color: var(--accent);">Compu</span>red
            </h2>
            <div style="display: inline-block; background: rgba(255,255,255,0.1); padding: 4px 12px; border-radius: 20px; margin-top: 10px; border: 1px solid rgba(255,255,255,0.05);">
                <p style="margin: 0; color: #cbd5e1; font-size: 11px; font-weight: 700; letter-spacing: 2px;">PANEL ADMIN</p>
            </div>
        </div>

        <nav style="flex: 1; padding: 30px 20px; display: flex; flex-direction: column; gap: 12px; overflow-y: auto;">
            <p style="color: #64748b; font-size: 11px; font-weight: 700; letter-spacing: 1px; margin: 0 0 5px 15px; text-transform: uppercase;">Principal</p>

            <a href="{{ route('admin.panel') }}"
               style="display: flex; align-items: center; gap: 15px; padding: 14px 20px; color: #f8fafc; text-decoration: none; font-weight: 600; font-size: 15px; border-radius: 12px; transition: all 0.3s; border-left: 4px solid transparent;"
               onmouseover="this.style.background='rgba(0,86,179,0.3)'; this.style.borderLeft='4px solid var(--accent)';"
               onmouseout="this.style.background='transparent'; this.style.borderLeft='4px solid transparent';">
                <span style="font-size: 22px;">🏠</span> Panel
            </a>

            <a href="{{ route('admin.productos.index') }}"
               style="display: flex; align-items: center; gap: 15px; padding: 14px 20px; color: #f8fafc; text-decoration: none; font-weight: 600; font-size: 15px; border-radius: 12px; transition: all 0.3s; border-left: 4px solid transparent;"
               onmouseover="this.style.background='rgba(0,86,179,0.3)'; this.style.borderLeft='4px solid var(--accent)';"
               onmouseout="this.style.background='transparent'; this.style.borderLeft='4px solid transparent';">
                <span style="font-size: 22px;">📦</span> Productos
            </a>

            <a href="{{ route('admin.ventas.index') }}"
               style="display: flex; align-items: center; gap: 15px; padding: 14px 20px; color: #f8fafc; text-decoration: none; font-weight: 600; font-size: 15px; border-radius: 12px; transition: all 0.3s; border-left: 4px solid transparent;"
               onmouseover="this.style.background='rgba(0,86,179,0.3)'; this.style.borderLeft='4px solid var(--accent)';"
               onmouseout="this.style.background='transparent'; this.style.borderLeft='4px solid transparent';">
                <span style="font-size: 22px;">💰</span> Ventas
            </a>

            <a href="{{ route('admin.anuncios.index') }}"
               style="display: flex; align-items: center; gap: 15px; padding: 14px 20px; color: #f8fafc; text-decoration: none; font-weight: 600; font-size: 15px; border-radius: 12px; transition: all 0.3s; border-left: 4px solid transparent;"
               onmouseover="this.style.background='rgba(0,86,179,0.3)'; this.style.borderLeft='4px solid var(--accent)';"
               onmouseout="this.style.background='transparent'; this.style.borderLeft='4px solid transparent';">
                <span style="font-size: 22px;">📢</span> Anuncios
            </a>
        </nav>

        <div style="padding: 25px 25px 35px; border-top: 1px solid rgba(255,255,255,0.08); background: rgba(0,0,0,0.2);">
            <button onclick="toggleTheme()"
                    style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 12px; background: linear-gradient(135deg, #0056b3 0%, #003d82 100%); border: 1px solid rgba(255,255,255,0.1); padding: 14px; border-radius: 12px; font-weight: 700; font-size: 15px; cursor: pointer; box-shadow: 0 4px 15px rgba(0,86,179,0.4); transition: all 0.3s ease;">
                <span id="theme-icon" style="font-size: 18px;">🌙</span>
                <span id="theme-label" style="color: white;">Modo Oscuro</span>
            </button>
        </div>
    </aside>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="content">
        <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color);">
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="text-align: right;">
                    <p class="main-text" style="margin: 0; font-weight: 600; font-size: 14px;">Administrador</p>
                    <p class="muted-text" style="margin: 0; font-size: 12px;">Panel de Control</p>
                </div>
                <div style="width: 40px; height: 40px; background: var(--primary); color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 18px; box-shadow: 0 4px 10px rgba(0,86,179,0.3);">C</div>
            </div>
        </div>

        @yield('content')
    </main>

</div>

<script>
    function toggleTheme() {
        const html = document.getElementById('html-root');
        html.classList.toggle('dark');
        const isDark = html.classList.contains('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        updateThemeUI(isDark);
    }

    function updateThemeUI(isDark) {
        document.getElementById('theme-icon').innerText = isDark ? '☀️' : '🌙';
        document.getElementById('theme-label').innerText = isDark ? 'Modo Claro' : 'Modo Oscuro';
        document.getElementById('theme-label').style.color = isDark ? 'var(--accent)' : 'white';
    }

    // Aplicar los iconos correctos al cargar
    document.addEventListener('DOMContentLoaded', () => {
        const isDark = document.getElementById('html-root').classList.contains('dark');
        updateThemeUI(isDark);
    });
</script>

</body>
</html>
