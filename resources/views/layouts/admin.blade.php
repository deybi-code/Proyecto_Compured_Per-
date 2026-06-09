<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Compured Perú</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body">

<div class="admin-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <span>Admin Panel</span>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.productos.index') }}" class="{{ request()->is('admin/productos*') ? 'active' : '' }}">
                📦 Productos
            </a>
            <a href="{{ route('inicio') }}" target="_blank">
                🌐 Ver tienda
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">🚪 Cerrar sesión</button>
            </form>
        </nav>
    </aside>

    <!-- CONTENIDO -->
    <main class="admin-main">

        @if(session('success'))
            <div class="alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </main>

</div>

</body>
</html>