<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/theme.js') }}"></script>
    <style>
        .theme-toggle-btn {
            position: fixed; top: 20px; right: 20px; width: 48px; height: 48px;
            border-radius: 50%; border: 2px solid #cce5ff; background: #ffffff;
            color: #0b33a2; font-size: 20px; cursor: pointer; display: flex;
            align-items: center; justify-content: center; z-index: 1000;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15); transition: all 0.3s ease;
        }
        .theme-toggle-btn:hover { transform: scale(1.08); }
        body.dark-mode .theme-toggle-btn { background: #1e1e1e; border-color: #333; color: #f1f1f1; }
    </style>
</head>
<body>

<button type="button" class="theme-toggle-btn" onclick="toggleDarkMode()" title="Cambiar modo claro/oscuro" aria-label="Cambiar modo claro/oscuro">
    <span id="themeIcon">🌙</span>
</button>

<h1>Resultados para: {{ $texto }}</h1>

<a href="{{ route('inicio') }}">
    ← Volver al inicio
</a>

<hr>

<section class="productos">

@forelse($productos as $producto)

<a href="{{ route('producto', $producto->id) }}"
    class="card">

    <img src="{{ asset('img/' . $producto->imagen) }}">

    <h3>{{ $producto->nombre }}</h3>

    <p>S/ {{ $producto->precio }}</p>

</a>

@empty

<p>No se encontraron productos.</p>

@endforelse

</section>

</body>
</html>