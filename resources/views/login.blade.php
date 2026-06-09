<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<div class="top-info">
    <div>Bienvenido a Compured</div>
    <div>
        <a href="{{ route('register') }}">Registrarse</a>
        <a href="{{ route('login') }}">Iniciar sesión</a>
    </div>
</div>

<header class="topbar">
    <div class="logo">
        <a href="{{ route('inicio') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Compured">
        </a>
    </div>

    <input type="text" placeholder="Buscar productos...">

    <div class="icons">
        <a href="{{ route('carrito') }}">🛒</a>
        👤
        <button onclick="toggleDarkMode()" class="btn-dark">🌙</button>
    </div>
</header>

<nav class="menu">
    <a href="#">Computadoras</a>
    <a href="#">Laptops</a>
    <a href="#">Accesorios</a>
    <a href="#">Ofertas</a>
</nav>

<div class="form-container">
    <h2>Iniciar sesión</h2>

    <input type="email" placeholder="Correo">
    <input type="password" placeholder="Contraseña">
    <button>Ingresar</button>

    <p>
        <a href="{{ route('inicio') }}">← Volver al inicio</a>
    </p>
</div>

<script src="{{ asset('js/carrito.js') }}"></script>

</body>
</html>