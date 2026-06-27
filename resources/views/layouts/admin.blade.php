<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- CORREGIDO: el layout admin no tenía etiqueta <title> --}}
    <title>@yield('title', 'Panel Admin - Compured Perú')</title>
    <script src="{{ asset('js/theme.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex">

    <aside class="w-64 bg-gray-900 dark:bg-black text-white p-6 flex flex-col shadow-xl">
        <h2 class="text-xl font-bold mb-10 text-blue-400">COMPURED ADMIN</h2>
        <nav class="space-y-2">
            <a href="{{ route('admin.productos.index') }}"
               class="block py-2 px-4 rounded hover:bg-gray-800 transition {{ request()->routeIs('admin.productos*') ? 'bg-gray-800' : '' }}">
                📦 Productos
            </a>
            <a href="{{ route('ventas.index') }}"
               class="block py-2 px-4 rounded hover:bg-gray-800 transition {{ request()->routeIs('ventas*') ? 'bg-gray-800' : '' }}">
                💰 Ejecutar Venta
            </a>
            <a href="{{ route('anuncios.index') }}"
               class="block py-2 px-4 rounded hover:bg-gray-800 transition {{ request()->routeIs('anuncios*') ? 'bg-gray-800' : '' }}">
                📢 Anuncios
            </a>
            {{-- CORREGIDO: el enlace /admin/boletas no existe como ruta, se apunta al home --}}
            <a href="{{ route('home') }}"
               class="block py-2 px-4 rounded hover:bg-gray-800 transition">
                🏠 Ver Tienda
            </a>
        </nav>
        <div class="mt-auto pt-10 border-t border-gray-800 space-y-3">
            <p class="text-xs text-gray-500">
                {{ auth()->user()->nombre_completo ?? 'Admin' }}<br>
                Rol: {{ auth()->user()->rol ?? 'admin' }}
            </p>
            {{-- CORREGIDO: el layout no tenía botón de cierre de sesión --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left py-2 px-4 rounded hover:bg-gray-800 transition text-gray-400 hover:text-white text-sm">
                    🚪 Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        @if(session('success'))
            <div class="bg-green-600 text-white p-4 rounded mb-6 font-bold shadow">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-600 text-white p-4 rounded mb-6 font-bold shadow">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
