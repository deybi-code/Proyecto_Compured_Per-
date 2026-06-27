<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <script src="{{ asset('js/theme.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex">

    <aside class="w-64 bg-gray-900 dark:bg-black text-white p-6 flex flex-col shadow-xl">
        <h2 class="text-xl font-bold mb-10 text-blue-400">COMPURED ADMIN</h2>
        <nav class="space-y-4">
            <a href="/admin/productos" class="block py-2 px-4 rounded hover:bg-gray-800 transition">📦 Productos</a>
            <a href="/admin/ventas" class="block py-2 px-4 rounded hover:bg-gray-800 transition">💰 Ejecutar Venta</a>
            <a href="/admin/anuncios" class="block py-2 px-4 rounded hover:bg-gray-800 transition">📢 Anuncios</a>
            <a href="/admin/boletas" class="block py-2 px-4 rounded hover:bg-gray-800 transition">📄 Boletas</a>
        </nav>
        <div class="mt-auto pt-10 border-t border-gray-800">
            <p class="text-xs text-gray-500">Rol: {{ auth()->user()->rol ?? 'Admin' }}</p>
        </div>
    </aside>

    <main class="flex-1 p-8">
        @yield('content')
    </main>
</body>
</html>
