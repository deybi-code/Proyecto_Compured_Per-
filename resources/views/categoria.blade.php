<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $categoria }} — Compured Perú</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- El script principal que maneja el modo oscuro global -->
    <script src="{{ asset('js/theme.js') }}"></script>

    <style>
        /* ESTILOS EXACTOS DE TU IMAGEN PARA EL MENÚ LATERAL */
        .cat-sidebar {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            width: 260px;
            min-width: 260px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .cat-sidebar-titulo {
            background-color: #0b33a2; color: #ffffff; text-align: center; padding: 16px; font-size: 16px; font-weight: 800; letter-spacing: 0.5px;
        }
        .cat-sidebar-lista {
            list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column;
        }
        .cat-sidebar-lista li {
            border-bottom: 1px solid #e2e8f0; transition: border-color 0.3s ease;
        }
        .cat-sidebar-lista li:last-child { border-bottom: none; }
        .cat-sidebar-lista a {
            display: flex; align-items: center; padding: 12px 20px; color: #4b5563; text-decoration: none; font-size: 14px; transition: background 0.3s, color 0.3s;
        }
        .cat-sidebar-lista a::before {
            content: '»'; color: #27a1eb; font-weight: 900; font-size: 18px; margin-right: 12px;
        }
        .cat-sidebar-lista a:hover {
            background-color: #f3f4f6; color: #0b33a2; font-weight: 600;
        }

        /* LA CLASE ACTIVA (Fondo blanco, letra azul oscura como tu imagen) */
        .cat-sidebar-lista a.activo {
            background-color: #f4f6f9; color: #0b33a2; font-weight: bold;
        }

        /* COMPORTAMIENTO MODO OSCURO PARA EL MENÚ */
        body.dark-mode .cat-sidebar {
            background-color: #1a1a1a; border-color: #2d2d2d; box-shadow: 0 4px 15px rgba(0,0,0,0.4);
        }
        body.dark-mode .cat-sidebar-lista li { border-bottom: 1px solid #2d2d2d; }
        body.dark-mode .cat-sidebar-lista a { color: #d1d5db; }
        body.dark-mode .cat-sidebar-lista a:hover { background-color: #252525; color: #ffffff; }

        /* ACTIVO EN MODO OSCURO (Mantiene la fidelidad de tu imagen) */
        body.dark-mode .cat-sidebar-lista a.activo {
            background-color: #f4f6f9; color: #0b33a2; font-weight: bold;
        }
    </style>
</head>
<body>

<!-- BARRA SUPERIOR -->
<div class="top-info">
    <a href="{{ route('register') }}">Registrarse</a>
    <span style="margin: 0 5px; color: white">|</span>
    <a href="{{ route('login') }}">Iniciar sesión</a>
</div>

<!-- HEADER -->
<header class="topbar">
    <div class="logo">
        <a href="{{ route('inicio') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Compured">
        </a>
    </div>

    <!-- Buscador ... (Mismo que tenías) -->

    <div class="topbar-icons">
        <a href="{{ route('carrito') }}" class="topbar-icon">
            <span><i class="fas fa-shopping-cart"></i></span>
            <span>Carrito</span>
        </a>
        <button onclick="toggleDarkMode()" class="topbar-icon">
            <span><i class="fas fa-moon"></i></span>
            <span>Oscuro</span>
        </button>
        <a href="{{ route('login') }}" class="topbar-icon">
            <span><i class="fas fa-user"></i></span>
            <span>Mi cuenta</span>
        </a>
    </div>
</header>

<div class="breadcrumb">
    <a href="{{ route('inicio') }}">Home</a> »
    <span>{{ $categoria }}</span>
</div>

<!-- CONTENIDO CATEGORÍA -->
<div class="cat-wrapper" style="display: flex; gap: 30px; margin-top: 20px;">

    <!-- NUEVO DISEÑO DEL FILTRO -->
    <aside class="cat-sidebar">
        <div class="cat-sidebar-titulo">Filtrar resultados por</div>
        <ul class="cat-sidebar-lista">
            <li><a href="{{ route('categoria', 'Accesorio') }}" class="{{ $categoria == 'Accesorio' ? 'activo' : '' }}">Accesorios</a></li>
            <li><a href="{{ route('categoria', 'Computadora') }}" class="{{ $categoria == 'Computadora' ? 'activo' : '' }}">Computadoras</a></li>
            <li><a href="{{ route('categoria', 'Laptop') }}" class="{{ $categoria == 'Laptop' ? 'activo' : '' }}">Laptops</a></li>
            <li><a href="{{ route('categoria', 'Redes') }}" class="{{ $categoria == 'Redes' ? 'activo' : '' }}">Redes / Conectividad</a></li>
            <li><a href="{{ route('categoria', 'Case') }}" class="{{ $categoria == 'Case' ? 'activo' : '' }}">Case</a></li>
            <li><a href="{{ route('categoria', 'Fuente') }}" class="{{ $categoria == 'Fuente' ? 'activo' : '' }}">Fuentes para Case</a></li>
            <li><a href="{{ route('categoria', 'Cooler') }}" class="{{ $categoria == 'Cooler' ? 'activo' : '' }}">Coolers/CPU</a></li>
            <li><a href="{{ route('categoria', 'Procesador') }}" class="{{ $categoria == 'Procesador' ? 'activo' : '' }}">CPU - Procesadores</a></li>
            <li><a href="{{ route('categoria', 'Disco Duro Externo') }}" class="{{ $categoria == 'Disco Duro Externo' ? 'activo' : '' }}">Discos Duros Externos</a></li>
            <li><a href="{{ route('categoria', 'Disco Duro Interno') }}" class="{{ $categoria == 'Disco Duro Interno' ? 'activo' : '' }}">Discos Duros Internos</a></li>
            <li><a href="{{ route('categoria', 'Disco Solido') }}" class="{{ $categoria == 'Disco Solido' ? 'activo' : '' }}">Discos Sólidos Internos</a></li>
            <li><a href="{{ route('categoria', 'Impresora') }}" class="{{ $categoria == 'Impresora' ? 'activo' : '' }}">Impresoras</a></li>
            <li><a href="{{ route('categoria', 'Memoria Flash') }}" class="{{ $categoria == 'Memoria Flash' ? 'activo' : '' }}">Memorias Flash</a></li>
            <li><a href="{{ route('categoria', 'Memoria RAM') }}" class="{{ $categoria == 'Memoria RAM' ? 'activo' : '' }}">Memorias RAM</a></li>
            <li><a href="{{ route('categoria', 'Monitor') }}" class="{{ $categoria == 'Monitor' ? 'activo' : '' }}">Monitores</a></li>
            <li><a href="{{ route('categoria', 'Placa Madre') }}" class="{{ $categoria == 'Placa Madre' ? 'activo' : '' }}">Motherboards / Placas Madre</a></li>
            <li><a href="{{ route('categoria', 'Mouse') }}" class="{{ $categoria == 'Mouse' ? 'activo' : '' }}">Mouse</a></li>
            <li><a href="{{ route('categoria', 'Tarjeta Video') }}" class="{{ $categoria == 'Tarjeta Video' ? 'activo' : '' }}">Tarjetas de Video</a></li>
            <li><a href="{{ route('categoria', 'Teclado') }}" class="{{ $categoria == 'Teclado' ? 'activo' : '' }}">Teclados</a></li>
            <li><a href="{{ route('categoria', 'UPS') }}" class="{{ $categoria == 'UPS' ? 'activo' : '' }}">UPS, Estabilizadores</a></li>
        </ul>
    </aside>

    <!-- PRODUCTOS -->
    <div class="cat-contenido" style="flex: 1;">
        <div class="cat-header">
            <h1 class="cat-titulo">{{ $categoria }}</h1>
            <div class="cat-ordenar">
                <label>Ordenar por:</label>
                <select onchange="ordenar(this.value)">
                    <option value="precio_asc">El precio más bajo</option>
                    <option value="precio_desc">El precio más alto</option>
                    <option value="nombre">Nombre</option>
                </select>
            </div>
        </div>

        <div class="cat-grid">
            @forelse($productos as $producto)
            <!-- ... Tu bucle de productos intacto ... -->
            @empty
                <p class="cat-vacio">No hay productos en esta categoría.</p>
            @endforelse
        </div>
    </div>
</div>

<script src="{{ asset('js/carrito.js') }}"></script>
</body>
</html>
