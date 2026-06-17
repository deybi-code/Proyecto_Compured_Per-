<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Compured Peru</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
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

    <style>
        /* TUS ESTILOS EXISTENTES (NO BORRAR) */
        :root {
            --bg-body: linear-gradient(135deg, #0b33a2 0%, #27a1eb 100%);
            --bg-card: #ffffff;
            --text-main: #0b33a2;
            --text-muted: #5c728e;
            --border-color: #cce5ff;
            --primary-blue: #0b33a2;
            --light-blue: #27a1eb;
            --btn-green: #a4e613;
            --btn-text: #081a45;
            --shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        [data-theme="dark"], .dark-mode {
            --bg-body: linear-gradient(135deg, #040d21 0%, #0b33a2 100%);
            --bg-card: #0f1c3f;
            --text-main: #e0e8f5;
            --text-muted: #8a9bb3;
            --border-color: #1e3a70;
            --primary-blue: #27a1eb;
            --light-blue: #a4e613;
            --btn-green: #a4e613;
            --btn-text: #040d21;
            --shadow: 0 15px 35px rgba(0,0,0,0.5);
        }
        body { background: var(--bg-body); color: var(--text-main); transition: background 0.3s, color 0.3s; padding: 40px 20px; }
        .card-panel { background-color: var(--bg-card); border-radius: 16px; padding: 30px; box-shadow: var(--shadow); border-top: 5px solid var(--btn-green); }
        /* ... resto de tu CSS original ... */
    </style>
</head>
<body>

    <div class="header-wrapper">
        <div class="header-logo">
            <a href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" alt="Compured Peru"></a>
        </div>
        <button type="button" onclick="toggleDarkModeAnimation()" style="background:none; border:none; cursor:pointer; color:white; margin-left:20px;">
            <i id="theme-icon" class="fas fa-moon"></i>
        </button>
    </div>

    <div class="cart-wrapper">
        <div class="card-panel">
            <h2>Tu Carrito de Compras</h2>
            </div>

        <div class="card-panel">
            </div>
    </div>

    <script>
        function toggleDarkModeAnimation() {
            const body = document.body;
            const doc = document.documentElement;
            const isDark = body.classList.toggle('dark-mode');
            doc.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');

            const icon = document.getElementById('theme-icon');
            if(icon) icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
        }

        // TUS FUNCIONES ORIGINALES DE CARRITO
        function updateQty(val) { /* tu código actual */ }
        function removeItem() { /* tu código actual */ }
        function procesarPago(e) { /* tu código actual */ }
        // ... TODAS TUS FUNCIONES ...
    </script>
</body>
</html>
