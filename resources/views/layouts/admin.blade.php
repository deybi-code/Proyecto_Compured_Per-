<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { margin:0; font-family: Arial; background:#f4f4f4; }

        .admin-wrapper { display:flex; min-height:100vh; }

        .sidebar {
            width:240px;
            background:#111827;
            color:white;
            padding:20px;
        }

        .sidebar a {
            display:block;
            color:#cbd5e1;
            padding:10px 0;
            text-decoration:none;
        }

        .sidebar a:hover { color:white; }

        .content {
            flex:1;
            padding:20px;
        }

        .card {
            background:white;
            padding:15px;
            border-radius:10px;
            margin-bottom:15px;
        }
    </style>
</head>

<body>

<div class="admin-wrapper">

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <h2>ADMIN</h2>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.productos.index') }}">Productos</a>
        <a href="{{ route('admin.ventas.index') }}">Ventas</a>
        <a href="{{ route('admin.anuncios.index') }}">Anuncios</a>
    </div>

    {{-- CONTENIDO --}}
    <div class="content">
        @yield('content')
    </div>

</div>

</body>
</html>
