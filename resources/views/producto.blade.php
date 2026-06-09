<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $producto->nombre }} — Compured Perú</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- BARRA SUPERIOR -->


<!-- HEADER -->
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

    <form action="{{ route('buscar') }}" method="GET" class="topbar-search">
        <select name="categoria_filtro">
            <option value="">Categorías</option>
            <option value="Accesorio">Accesorios</option>
            <option value="Computadora">Computadoras</option>
            <option value="Laptop">Laptops</option>
            <option value="Redes">Redes / Conectividad</option>
            <option value="Case">Case</option>
            <option value="Fuente">Fuentes para Case</option>
            <option value="Cooler">Coolers/CPU</option>
            <option value="Procesador">CPU - Procesadores</option>
            <option value="Disco Duro Externo">Discos Duros Externos</option>
            <option value="Disco Duro Interno">Discos Duros Internos</option>
            <option value="Disco Solido">Discos Sólidos</option>
            <option value="Impresora">Impresoras</option>
            <option value="Memoria Flash">Memorias Flash</option>
            <option value="Memoria RAM">Memorias RAM</option>
            <option value="Monitor">Monitores</option>
            <option value="Placa Madre">Placas Madre</option>
            <option value="Mouse">Mouse</option>
            <option value="Tablet">Tablets</option>
            <option value="Tarjeta Video">Tarjetas de Video</option>
            <option value="Teclado">Teclados</option>
            <option value="UPS">UPS</option>
        </select>
        <input type="text" name="buscar" placeholder="Buscar productos...">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>

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

<!-- BREADCRUMB -->
<div class="breadcrumb">
    <a href="{{ route('inicio') }}">Home</a> »
    <a href="{{ route('categoria', $producto->categoria) }}">{{ $producto->categoria }}</a> »
    <span>{{ $producto->nombre }}</span>
</div>

<!-- DETALLE PRODUCTO -->
<section class="detalle-wrapper">

    <div class="detalle-izq">
        <div class="detalle-img-principal">
            <img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
        </div>
    </div>

    <div class="detalle-der">
        <h1 class="detalle-nombre">{{ $producto->nombre }}</h1>

        <p class="detalle-stock"><i class="fas fa-check-circle"></i> En stock</p>

        <p class="detalle-precio">S/ {{ $producto->precio }}</p>

        <div class="detalle-cantidad">
            <button type="button" onclick="cambiarCantidad(-1)">−</button>
            <input type="number" id="cantidad" value="1" min="1">
            <button type="button" onclick="cambiarCantidad(1)">+</button>
        </div>

        <div class="detalle-botones">
            <button class="btn-añadir" ...>
                <i class="fas fa-cart-plus"></i> Añadir al carrito
            </button>
            <a href="https://wa.me/..." class="btn-whatsapp-producto">
                <i class="fab fa-whatsapp"></i> Atención por WhatsApp
            </a>
        </div>

        <div class="detalle-meta">
            <p><strong>Categoría:</strong> {{ $producto->categoria }}</p>
        </div>
    </div>

    <!-- PRODUCTOS DEL VENDEDOR -->
    <div class="detalle-sidebar">
        <h4>Productos relacionados</h4>
        @foreach($relacionados as $rel)
        <a href="{{ route('producto', $rel->id) }}" class="rel-card">
            <img src="{{ asset('img/' . $rel->imagen) }}" alt="{{ $rel->nombre }}">
            <div>
                <p class="rel-precio">S/ {{ $rel->precio }}</p>
                <p class="rel-nombre">{{ $rel->nombre }}</p>
            </div>
        </a>
        @endforeach
    </div>

</section>

<!-- TABS DESCRIPCIÓN -->
<div class="detalle-tabs">
    <div class="tabs-header">
        <button class="tab-btn activo" onclick="mostrarTab('descripcion', this)">Descripción</button>
    </div>
    <div id="tab-descripcion" class="tab-contenido activo">
        <p>{{ $producto->descripcion }}</p>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-grid">
        <div class="footer-col">
            <h4>Compured Perú</h4>
            <p>eCommerce que vende y promociona productos tecnológicos para toda persona, respaldados por una empresa.</p>
            <div class="footer-redes">
                <a href="https://www.facebook.com/" target="_blank">Facebook</a>
                <a href="https://twitter.com/" target="_blank">Twitter</a>
                <a href="https://wa.me/960900386" target="_blank">WhatsApp</a>
            </div>
        </div>
        <div class="footer-col">
            <h4>Enlaces</h4>
            <ul>
                <li><a href="{{ route('inicio') }}">Home</a></li>
                <li><a href="#">Sobre nosotros</a></li>
                <li><a href="#">Términos y condiciones</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Últimas categorías</h4>
            <ul>
                <li><a href="{{ route('categoria', 'Accesorio') }}">Accesorios</a></li>
                <li><a href="{{ route('categoria', 'Computadora') }}">Computadoras</a></li>
                <li><a href="{{ route('categoria', 'Laptop') }}">Laptops</a></li>
                <li><a href="{{ route('categoria', 'Redes') }}">Redes / Conectividad</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2026 Compured Perú — Todos los derechos reservados</p>
    </div>
</footer>

<a href="https://wa.me/960900386" class="whatsapp" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<script src="{{ asset('js/carrito.js') }}"></script>
<script>
function cambiarCantidad(valor) {
    let input = document.getElementById('cantidad');
    let nueva = parseInt(input.value) + valor;
    if (nueva >= 1) input.value = nueva;
}

function agregarAlCarritoConCantidad(nombre, precio, imagen) {
    let cantidad = parseInt(document.getElementById('cantidad').value);
    for (let i = 0; i < cantidad; i++) {
        agregarCarrito(nombre, precio, imagen);
    }
    alert(cantidad + ' producto(s) agregado(s) al carrito');
}

function mostrarTab(tab, btn) {
    document.querySelectorAll('.tab-contenido').forEach(t => t.classList.remove('activo'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('activo'));
    document.getElementById('tab-' + tab).classList.add('activo');
    btn.classList.add('activo');
}
</script>

</body>
</html>