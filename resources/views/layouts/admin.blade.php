<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Panel Admin – Compured Perú')</title>

    {{-- JS base del sistema --}}
    <script src="{{ asset('js/theme.js') }}" defer></script>

    {{-- Vite (CSS + JS principal Laravel) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ESTILOS BASE DE EMERGENCIA (evita “pantalla sin diseño”) --}}
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 240px;
            background: #111827;
            color: white;
            display: flex;
            flex-direction: column;
        }

        .admin-logo-area {
            padding: 20px;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .admin-nav-item {
            padding: 12px 18px;
            display: block;
            color: #cbd5e1;
            text-decoration: none;
        }

        .admin-nav-item:hover {
            background: rgba(255,255,255,0.08);
            color: white;
        }

        .admin-content {
            flex: 1;
            padding: 20px;
            background: #f3f4f6;
        }
    </style>
</head>

<body>

<div class="admin-wrapper">

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar">

        <div class="admin-logo-area">
            COMPURED <span style="color:#22c55e">PERÚ</span>
            <div style="font-size:12px; font-weight: normal; opacity:0.6;">
                Panel Admin
            </div>
        </div>

        <a href="{{ route('admin.productos.index') }}" class="admin-nav-item">
            📦 Productos
        </a>

        <a href="{{ route('ventas.index') }}" class="admin-nav-item">
            💰 Ventas
        </a>

        <a href="{{ route('admin.boletas.show') ?? '#' }}" class="admin-nav-item">
            🧾 Boletas
        </a>

        <a href="{{ route('admin.anuncios.index') }}" class="admin-nav-item">
            📢 Anuncios
        </a>

    </aside>

    {{-- CONTENIDO --}}
    <main class="admin-content">
        @yield('content')
    </main>

</div>

</body>
</html>
