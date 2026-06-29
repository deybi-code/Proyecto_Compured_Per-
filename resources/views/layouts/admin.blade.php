<!DOCTYPE html>
<html lang="es" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }"
      x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
      :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - CompuredPeru')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* VARIABLES CORPORATIVAS */
        :root {
            --primary: #0056b3;
            --primary-hover: #003d82;
            --accent: #9ad800;
            --accent-hover: #7eb300;
            --bg-light: #f4f7f9;
            --bg-dark: #0b1220;
            --sidebar-dark: #0f172a;
            --card-light: #ffffff;
            --card-dark: #111827;
            --text-light: #334155;
            --text-dark: #f8fafc;
        }

        /* RESET Y BÁSICOS */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-light);
            transition: background-color 0.3s ease, color 0.3s ease;
            -webkit-font-smoothing: antialiased;
        }

        /* LAYOUT PRINCIPAL */
        .layout {
            display: flex;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 30px 40px;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        /* TARJETAS GLOBALES */
        .card {
            background: var(--card-light);
            border-radius: 16px;
            margin-bottom: 25px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        /* SCROLLBAR PERSONALIZADO */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* MODO OSCURO (APLICACIÓN GLOBAL) */
        .dark body {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }
        .dark .content {
            background-color: var(--bg-dark);
        }
        .dark .card {
            background-color: var(--card-dark);
            border: 1px solid #1f2937 !important;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.3);
        }
        .dark h1, .dark h2, .dark h3 { color: #ffffff !important; }
        .dark p, .dark label, .dark span { color: #cbd5e1 !important; }
        .dark input, .dark textarea, .dark select {
            background: #1f2937 !important;
            border-color: #374151 !important;
            color: white !important;
        }
        .dark table thead { background: #1f2937 !important; border-bottom: 2px solid #374151 !important; }
        .dark table th { color: #94a3b8 !important; }
        .dark table tr { border-bottom: 1px solid #374151 !important; }
        .dark table tr:hover { background-color: rgba(255,255,255,0.02) !important; }
        .dark hr { border-color: #374151 !important; }

        /* ADAPTACIÓN DE COLORES EN DARK MODE */
        .dark .btn-primary { box-shadow: 0 4px 15px rgba(0,86,179,0.2) !important; }
        .dark .btn-accent { box-shadow: 0 4px 15px rgba(154,216,0,0.1) !important; }
    </style>
</head>

<body>

<div class="layout">

    {{-- SIDEBAR LATERAL PROFESIONAL --}}
    <aside style="width: 280px; background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%); display: flex; flex-direction: column; box-shadow: 4px 0 25px rgba(0,0,0,0.15); position: relative; z-index: 50; flex-shrink: 0;">

        {{-- LOGO BRANDING --}}
        <div style="padding: 40px 25px 30px; border-bottom: 1px solid rgba(255,255,255,0.08); text-align: center; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: radial-gradient(circle, rgba(154,216,0,0.1) 0%, rgba(255,255,255,0) 70%); border-radius: 50%;"></div>

            <h2 style="margin: 0; color: #ffffff; font-size: 30px; font-weight: 900; letter-spacing: 1px; text-transform: uppercase; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                <span style="color: var(--accent);">Compu</span>red
            </h2>
            <div style="display: inline-block; background: rgba(255,255,255,0.1); padding: 4px 12px; border-radius: 20px; margin-top: 10px; border: 1px solid rgba(255,255,255,0.05);">
                <p style="margin: 0; color: #cbd5e1; font-size: 11px; font-weight: 700; letter-spacing: 2px;">PANEL ADMIN</p>
            </div>
        </div>

        {{-- MENÚ DE NAVEGACIÓN --}}
        <nav style="flex: 1; padding: 30px 20px; display: flex; flex-direction: column; gap: 12px; overflow-y: auto;">

            <p style="color: #64748b; font-size: 11px; font-weight: 700; letter-spacing: 1px; margin: 0 0 5px 15px; text-transform: uppercase;">Principal</p>

            <a href="{{ route('admin.panel') }}"
               style="display: flex; align-items: center; gap: 15px; padding: 14px 20px; color: #f8fafc; text-decoration: none; font-weight: 600; font-size: 15px; border-radius: 12px; background: transparent; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border-left: 4px solid transparent;"
               onmouseover="this.style.background='rgba(0,86,179,0.3)'; this.style.borderLeft='4px solid var(--accent)'; this.style.transform='translateX(6px)';"
               onmouseout="this.style.background='transparent'; this.style.borderLeft='4px solid transparent'; this.style.transform='translateX(0)';">
                <span style="font-size: 22px;">🏠</span> Panel
            </a>

            <a href="{{ route('admin.productos.index') }}"
               style="display: flex; align-items: center; gap: 15px; padding: 14px 20px; color: #ffffff; text-decoration: none; font-weight: 600; font-size: 15px; border-radius: 12px; background: rgba(0,86,179,0.25); border-left: 4px solid var(--primary); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: inset 0 0 20px rgba(0,86,179,0.1);"
               onmouseover="this.style.background='rgba(0,86,179,0.4)'; this.style.borderLeft='4px solid var(--accent)'; this.style.transform='translateX(6px)';"
               onmouseout="this.style.background='rgba(0,86,179,0.25)'; this.style.borderLeft='4px solid var(--primary)'; this.style.transform='translateX(0)';">
                <span style="font-size: 22px;">📦</span> Productos
            </a>

            <a href="{{ route('admin.ventas.index') }}"
               style="display: flex; align-items: center; gap: 15px; padding: 14px 20px; color: #f8fafc; text-decoration: none; font-weight: 600; font-size: 15px; border-radius: 12px; background: transparent; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border-left: 4px solid transparent;"
               onmouseover="this.style.background='rgba(0,86,179,0.3)'; this.style.borderLeft='4px solid var(--accent)'; this.style.transform='translateX(6px)';"
               onmouseout="this.style.background='transparent'; this.style.borderLeft='4px solid transparent'; this.style.transform='translateX(0)';">
                <span style="font-size: 22px;">💰</span> Ventas
            </a>

            <a href="{{ route('admin.anuncios.index') }}"
               style="display: flex; align-items: center; gap: 15px; padding: 14px 20px; color: #f8fafc; text-decoration: none; font-weight: 600; font-size: 15px; border-radius: 12px; background: transparent; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border-left: 4px solid transparent;"
               onmouseover="this.style.background='rgba(0,86,179,0.3)'; this.style.borderLeft='4px solid var(--accent)'; this.style.transform='translateX(6px)';"
               onmouseout="this.style.background='transparent'; this.style.borderLeft='4px solid transparent'; this.style.transform='translateX(0)';">
                <span style="font-size: 22px;">📢</span> Anuncios
            </a>

        </nav>

        {{-- BOTÓN MODO OSCURO INTEGRADO CON ALPINE.JS --}}
        <div style="padding: 25px 25px 35px; border-top: 1px solid rgba(255,255,255,0.08); background: rgba(0,0,0,0.2);">
            <button @click="darkMode = !darkMode"
                    style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 12px; background: linear-gradient(135deg, var(--primary) 0%, #003d82 100%); color: white; border: 1px solid rgba(255,255,255,0.1); padding: 14px; border-radius: 12px; font-weight: 700; font-size: 15px; cursor: pointer; box-shadow: 0 4px 15px rgba(0,86,179,0.4); transition: all 0.3s ease;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(0,86,179,0.6)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,86,179,0.4)';">

                <span x-show="!darkMode" style="display:flex; align-items:center; gap:8px;">🌙 <span>Modo Oscuro</span></span>
                <span x-show="darkMode" style="display:flex; align-items:center; gap:8px; color:var(--accent);">☀️ <span style="color:white;">Modo Claro</span></span>

            </button>

            <div style="text-align: center; margin-top: 20px;">
                <p style="margin: 0; color: #475569; font-size: 11px;">CompuredPeru v1.0</p>
            </div>
        </div>
    </aside>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="content">

        {{-- TOPBAR OPCIONAL (Puedes agregar migas de pan o perfil de usuario aquí en el futuro) --}}
        <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid rgba(148, 163, 184, 0.2);">
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="text-align: right;">
                    <p style="margin: 0; font-weight: 600; font-size: 14px;">Administrador</p>
                    <p style="margin: 0; font-size: 12px; color: #64748b;">Panel de Control</p>
                </div>
                <div style="width: 40px; height: 40px; background: var(--primary); color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 18px; box-shadow: 0 4px 10px rgba(0,86,179,0.2);">
                    C
                </div>
            </div>
        </div>

        @yield('content')

    </main>

</div>

</body>
</html>
