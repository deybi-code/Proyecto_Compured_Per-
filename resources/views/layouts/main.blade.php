<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Compured Perú')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script>
        (function() {
            if(localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
                document.body.classList.add('dark-mode');
            }
        })();
    </script>
</head>
<body>
    <header class="topbar">
        <div class="topbar-icons">
            <a href="{{ url('/carrito') }}" class="topbar-icon">...</a>

            <button onclick="toggleDarkModeUniversal()" class="topbar-icon" style="border:none; background:none; cursor:pointer;">
                <i id="theme-icon" class="fas fa-moon"></i>
                <span class="icon-label" id="theme-text">Oscuro</span>
            </button>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script>
        function toggleDarkModeUniversal() {
            const body = document.body;
            const doc = document.documentElement;
            const icon = document.getElementById('theme-icon');
            const text = document.getElementById('theme-text');

            body.classList.toggle('dark-mode');
            doc.classList.toggle('dark');

            const isDark = body.classList.contains('dark-mode');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');

            icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
            text.textContent = isDark ? 'Claro' : 'Oscuro';
        }
    </script>
</body>
</html>
