<!DOCTYPE html>
<html lang="es" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }"
      x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
      :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { margin:0; font-family: Arial; }

        .layout {
            display:flex;
            min-height:100vh;
        }

        .sidebar {
            width:260px;
            background:#0f172a;
            color:white;
            padding:20px;
        }

        .sidebar a {
            display:block;
            padding:10px;
            color:#cbd5e1;
            text-decoration:none;
            border-radius:8px;
        }

        .sidebar a:hover {
            background:#1e293b;
            color:white;
        }

        .content {
            flex:1;
            background:#f1f5f9;
            padding:20px;
        }

        .dark .content {
            background:#0b1220;
            color:white;
        }

        .card {
            background:white;
            padding:15px;
            border-radius:12px;
            margin-bottom:15px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        .dark .card {
            background:#111827;
            color:white;
        }

        .topbar {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .btn {
            padding:8px 12px;
            border-radius:8px;
            background:#2563eb;
            color:white;
            text-decoration:none;
        }
    </style>
</head>

<body>

<div class="layout">

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <h2>ADMIN</h2>

        <a href="{{ route('admin.panel') }}">🏠 Panel</a>
        <a href="{{ route('admin.productos.index') }}">📦 Productos</a>
        <a href="{{ route('admin.ventas.index') }}">💰 Ventas</a>
        <a href="{{ route('admin.anuncios.index') }}">📢 Anuncios</a>

        <hr>

        <button @click="darkMode = !darkMode" class="btn">
            🌙 Modo Oscuro
        </button>
    </div>

    {{-- CONTENIDO --}}
    <div class="content">
        @yield('content')
    </div>

</div>

</body>
</html>
