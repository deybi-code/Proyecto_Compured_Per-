<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

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