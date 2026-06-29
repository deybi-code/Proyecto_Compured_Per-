<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin – Compured Perú')</title>
    <script src="{{ asset('js/theme.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen" style="background:var(--cp-gray-50)">

{{-- SIDEBAR --}}
<aside class="admin-sidebar">
    <div class="admin-logo-area">
        <div class="mb-1" style="font-family:'Rajdhani',sans-serif;font-size:1.25rem;font-weight:800;color:white;letter-spacing:1px">
            COMPURED<span style="color:#8CC63F">PERÚ</span>
        </div>
        <div style="font-size:0.7rem;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:1px">Panel de Administración</div>
    </div>

    <nav class="py-4 flex-grow">
        <div style="padding:8px 20px;font-size:0.65rem;color:rgba(255,255,255,0.25);text-transform:uppercase;letter-spacing:1px;margin-bottom:4px">Gestión</div>

        <a href="{{ route('admin.productos.index') }}" class="admin-nav-item {{ request()->routeIs('admin.productos*') ? 'active' : '' }}">
            <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            Productos
        </a>
        <a href="{{ route('admin.ventas.index') }}" class="admin-nav-item {{ request()->routeIs('admin.ventas*') ? 'active' : '' }}">
            <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Ventas
        </a>
        <a href="{{ route('admin.anuncios.index') }}" class="admin-nav-item {{ request()->routeIs('admin.anuncios*') ? 'active' : '' }}">
            <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988

            Anuncios
        </a>

        <div style="padding:8px 20px;font-size:0.65rem;color:rgba(255,255,255,0.25);text-transform:uppercase;letter-spacing:1px;margin:12px 0 4px">Sistema</div>

        <a href="{{ route('home') }}" class="admin-nav-item">
            <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Ver Tienda
        </a>

        {{-- Dark Mode en sidebar --}}
        <div class="admin-nav-item" style="cursor:pointer" onclick="toggleDark()">
            <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            <span id="theme-icon">🌙</span> Modo oscuro
        </div>
    </nav>

    {{-- User info & logout --}}
    <div style="padding:16px;border-top:1px solid rgba(255,255,255,0.08)">
        <div style="font-size:0.75rem;color:rgba(255,255,255,0.5);margin-bottom:8px">
            <div style="color:white;font-weight:600">{{ auth()->user()->nombre_completo ?? auth()->user()->name ?? 'Admin' }}</div>
            <div>{{ auth()->user()->correo ?? auth()->user()->email ?? '' }}</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="admin-nav-item w-full text-left" style="background:rgba(220,38,38,0.15);color:#FCA5A5;border-radius:6px;border:none;cursor:pointer">
                <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Cerrar sesión
            </button>
        </form>
    </div>
</aside>

{{-- MAIN CONTENT --}}
<main class="flex-1 p-8 overflow-y-auto" style="background:var(--cp-gray-50)" class="dark:bg-gray-900">
    @if(session('success'))
        <div class="alert-success flex items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert-error flex items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

</body>
</html>
