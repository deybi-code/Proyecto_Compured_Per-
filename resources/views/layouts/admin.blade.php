<!DOCTYPE html>
<html lang="es" id="html-root" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }"
      x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
      :class="{ 'dark': darkMode }">
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
            --text-title: #60a5fa;
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

        /* SIDEBAR */
        .sidebar { width: 280px; background: var(--sidebar-bg); color: white; padding: 20px; display: flex; flex-direction: column; }
        .sidebar a { display: block; padding: 14px 20px; color: #cbd5e1; text-decoration: none; border-radius: 12px; margin-bottom: 8px; transition: 0.3s; }
        .sidebar a:hover { background: rgba(255,255,255,0.1); color: white; }

        /* TOPBAR */
        .topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; background: var(--bg-card); padding: 15px 20px; border-radius: 12px; border: 1px solid var(--border-color); }
        .btn { padding:10px 16px; border-radius:8px; background:var(--primary); color:white; text-decoration:none; border:none; cursor:pointer; font-weight:600; }

        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>

<body>

<div class="layout">

    <div class="sidebar">
        <h2 style="text-align: center; color: var(--accent);">ADMIN</h2>
        <hr style="border: 0; border-top: 1px solid #1e293b; margin: 20px 0;">

        <a href="{{ route('admin.panel') }}">🏠 Panel</a>
        <a href="{{ route('admin.productos.index') }}">📦 Productos</a>
        <a href="{{ route('admin.ventas.index') }}">💰 Ventas</a>
        <a href="{{ route('admin.anuncios.index') }}">📢 Anuncios</a>
    </div>

    <div class="content">

        {{-- TOPBAR MEJORADO --}}
        <div class="topbar">
            <div style="font-weight: bold; font-size: 1.1rem;">Panel de Control</div>
            <div style="display:flex; gap:10px;">
                <a href="/" class="btn" style="background:#64748b;">🏠 Ver Sitio</a>
                <button @click="darkMode = !darkMode" class="btn">
                    <span x-text="darkMode ? '☀️ Modo Claro' : '🌙 Modo Oscuro'"></span>
                </button>
            </div>
        </div>

        @yield('content')
    </div>

</div>

</body>
</html>
