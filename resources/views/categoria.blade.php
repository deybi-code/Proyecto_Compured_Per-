<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $categoria }} — Compured Perú</title>
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
    <span>{{ $categoria }}</span>
</div>

<!-- CONTENIDO CATEGORÍA -->
<div class="cat-wrapper">

    <!-- SIDEBAR -->
    <aside class="cat-sidebar">
        <div class="cat-sidebar-titulo">Filtrar resultados por</div>
        <ul class="cat-sidebar-lista">
            <li><a href="{{ route('categoria', 'Accesorio') }}"       class="{{ $categoria == 'Accesorio'            ? 'activo' : '' }}">Accesorios</a></li>
            <li><a href="{{ route('categoria', 'Computadora') }}"     class="{{ $categoria == 'Computadora'          ? 'activo' : '' }}">Computadoras</a></li>
            <li><a href="{{ route('categoria', 'Laptop') }}"          class="{{ $categoria == 'Laptop'               ? 'activo' : '' }}">Laptops</a></li>
            <li><a href="{{ route('categoria', 'Redes') }}"           class="{{ $categoria == 'Redes'                ? 'activo' : '' }}">Redes / Conectividad</a></li>
            <li><a href="{{ route('categoria', 'Case') }}"            class="{{ $categoria == 'Case'                 ? 'activo' : '' }}">Case</a></li>
            <li><a href="{{ route('categoria', 'Fuente') }}"          class="{{ $categoria == 'Fuente'               ? 'activo' : '' }}">Fuentes para Case</a></li>
            <li><a href="{{ route('categoria', 'Cooler') }}"          class="{{ $categoria == 'Cooler'               ? 'activo' : '' }}">Coolers/CPU - Refrigeración Líq.</a></li>
            <li><a href="{{ route('categoria', 'Procesador') }}"      class="{{ $categoria == 'Procesador'           ? 'activo' : '' }}">CPU - Procesadores</a></li>
            <li><a href="{{ route('categoria', 'Disco Duro Externo') }}" class="{{ $categoria == 'Disco Duro Externo' ? 'activo' : '' }}">Discos Duros Externos</a></li>
            <li><a href="{{ route('categoria', 'Disco Duro Interno') }}" class="{{ $categoria == 'Disco Duro Interno' ? 'activo' : '' }}">Discos Duros Internos</a></li>
            <li><a href="{{ route('categoria', 'Disco Solido') }}"    class="{{ $categoria == 'Disco Solido'         ? 'activo' : '' }}">Discos Sólidos Internos</a></li>
            <li><a href="{{ route('categoria', 'Impresora') }}"       class="{{ $categoria == 'Impresora'            ? 'activo' : '' }}">Impresoras</a></li>
            <li><a href="{{ route('categoria', 'Memoria Flash') }}"   class="{{ $categoria == 'Memoria Flash'        ? 'activo' : '' }}">Memorias Flash</a></li>
            <li><a href="{{ route('categoria', 'Memoria RAM') }}"     class="{{ $categoria == 'Memoria RAM'          ? 'activo' : '' }}">Memorias RAM</a></li>
            <li><a href="{{ route('categoria', 'Monitor') }}"         class="{{ $categoria == 'Monitor'              ? 'activo' : '' }}">Monitores</a></li>
            <li><a href="{{ route('categoria', 'Placa Madre') }}"     class="{{ $categoria == 'Placa Madre'          ? 'activo' : '' }}">Motherboards / Placas Madre</a></li>
            <li><a href="{{ route('categoria', 'Mouse') }}"           class="{{ $categoria == 'Mouse'                ? 'activo' : '' }}">Mouse</a></li>
            <li><a href="{{ route('categoria', 'Mutigrabador') }}"    class="{{ $categoria == 'Mutigrabador'         ? 'activo' : '' }}">Mutigrabadores DVD/Blu Ray</a></li>
            <li><a href="{{ route('categoria', 'Suministro Impresora') }}" class="{{ $categoria == 'Suministro Impresora' ? 'activo' : '' }}">Suministros para Impresoras</a></li>
            <li><a href="{{ route('categoria', 'Tablet') }}"          class="{{ $categoria == 'Tablet'               ? 'activo' : '' }}">Tablets</a></li>
            <li><a href="{{ route('categoria', 'Tarjeta Video') }}"   class="{{ $categoria == 'Tarjeta Video'        ? 'activo' : '' }}">Tarjetas de Video</a></li>
            <li><a href="{{ route('categoria', 'Teclado') }}"         class="{{ $categoria == 'Teclado'              ? 'activo' : '' }}">Teclados</a></li>
            <li><a href="{{ route('categoria', 'UPS') }}"             class="{{ $categoria == 'UPS'                  ? 'activo' : '' }}">UPS, Estabilizadores</a></li>
        </ul>
    </aside>

    <!-- PRODUCTOS -->
    <div class="cat-contenido">

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
            <div class="cat-card">
                <a href="{{ route('producto', $producto->id) }}" class="cat-card-img">
                    @if($producto->imagen)
                        <img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                    @else
                        <img src="{{ asset('img/logo.png') }}" alt="Sin imagen">
                    @endif
                </a>
                <div class="cat-card-info">
                    <a href="{{ route('producto', $producto->id) }}" class="cat-card-nombre">{{ $producto->nombre }}</a>
                    <p class="cat-card-precio">S/ {{ $producto->precio }}</p>
                    <div class="cat-card-estrellas">★★★★☆</div>
                </div>
                <div class="cat-card-overlay">
                    <button class="icono-btn" title="Agregar al carrito" ...>
                            <i class="fas fa-cart-plus"></i>
                        </button>
                        <button class="icono-btn" title="Vista rápida" ...>
                            <i class="fas fa-eye"></i>
                        </button>
                        <a href="https://wa.me/..." class="icono-btn" ...>
                            <i class="fab fa-whatsapp"></i>
                        </a>
                </div>
            </div>
            @empty
                <p class="cat-vacio">No hay productos en esta categoría.</p>
            @endforelse
        </div>

    </div>

</div>

<!-- MODAL VISTA RÁPIDA -->
<div id="modal-rapida" class="modal-overlay" onclick="cerrarModal(event)">
    <div class="modal-contenido">
        <button class="modal-cerrar" onclick="document.getElementById('modal-rapida').style.display='none'">✕</button>
        <div class="modal-body">
            <div class="modal-img">
                <img id="modal-imagen" src="" alt="">
            </div>
            <div class="modal-info">
                <h2 id="modal-nombre"></h2>
                <p class="modal-precio" id="modal-precio"></p>
                <p id="modal-descripcion"></p>
                <div class="modal-botones">
                    <button id="modal-carrito" class="btn-modal-carrito">🛒 Agregar al carrito</button>
                    <a id="modal-ver" href="#" class="btn-modal-ver">Ver producto completo</a>
                </div>
            </div>
        </div>
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
function ordenar(valor) {
    let cards = Array.from(document.querySelectorAll('.cat-card'));
    let grid = document.querySelector('.cat-grid');

    cards.sort((a, b) => {
        if (valor === 'precio_asc') {
            return parseFloat(a.querySelector('.cat-card-precio').innerText.replace('S/ ', '')) -
                    parseFloat(b.querySelector('.cat-card-precio').innerText.replace('S/ ', ''));
        } else if (valor === 'precio_desc') {
            return parseFloat(b.querySelector('.cat-card-precio').innerText.replace('S/ ', '')) -
                    parseFloat(a.querySelector('.cat-card-precio').innerText.replace('S/ ', ''));
        } else {
            return a.querySelector('.cat-card-nombre').innerText.localeCompare(
                    b.querySelector('.cat-card-nombre').innerText);
        }
    });

    cards.forEach(card => grid.appendChild(card));
}
</script>

</body>
</html>