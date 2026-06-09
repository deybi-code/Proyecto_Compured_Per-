<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compured Perú</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- BARRA SUPERIOR -->
<div class="top-info">
    <div class="top-left"></div>
    <div class="top-right">
        <a href="{{ route('register') }}">Registrarse</a>
        <a href="{{ route('login') }}">Iniciar sesión</a>
    </div>
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


<!-- BANNER -->
<section class="banner">
    <img src="{{ asset('img/banner.jpg') }}" alt="Banner">
</section>

<!-- MARCAS -->
<section class="marcas">
    <img src="{{ asset('img/marca1.jpg') }}">
    <img src="{{ asset('img/marca2.jpg') }}">
    <img src="{{ asset('img/marca3.jpg') }}">
    <img src="{{ asset('img/marca4.jpg') }}">
    <img src="{{ asset('img/marca5.jpg') }}">
</section>

<!-- LINEA -->
<div class="linea"></div>

<!-- CONTENIDO -->
<section class="contenido">

    <div class="categorias">
        <h3>Categorías</h3>
        <ul>
            <li><a href="{{ route('categoria', ['id' => 'Accesorio']) }}">Accesorios</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Computadora']) }}">Computadoras</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Laptop']) }}">Laptops</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Redes']) }}">Redes / Conectividad</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Case']) }}">Case</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Fuente']) }}">Fuentes para Case</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Cooler']) }}">Coolers/CPU - Refrigeración Líq.</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Procesador']) }}">CPU - Procesadores</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Disco Duro Externo']) }}">Discos Duros Externos</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Disco Duro Interno']) }}">Discos Duros Internos</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Disco Solido']) }}">Discos Sólidos Internos</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Impresora']) }}">Impresoras</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Memoria Flash']) }}">Memorias Flash</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Memoria RAM']) }}">Memorias RAM</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Monitor']) }}">Monitores</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Placa Madre']) }}">Motherboards / Placas Madre</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Mouse']) }}">Mouse</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Mutigrabador']) }}">Mutigrabadores DVD/Blu Ray</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Suministro Impresora']) }}">Suministros para Impresoras</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Tablet']) }}">Tablets</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Tarjeta Video']) }}">Tarjetas de Video</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Teclado']) }}">Teclados</a></li>
            <li><a href="{{ route('categoria', ['id' => 'UPS']) }}">UPS, Estabilizadores</a></li>
        </ul>
    </div>

    <div class="contenido-derecha">
        <h3 class="seccion-titulo">Los más valorados</h3>

        <div class="grid-valorados">
            @forelse($destacados as $producto)
            <div class="card-valorado">
                <a href="{{ route('producto', ['id' => $producto->id_producto]) }}" class="card-valorado-img">
                    <img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                </a>
                <div class="card-valorado-info">
                    <a href="{{ route('producto', ['id' => $producto->id_producto]) }}" class="nombre-valorado">{{ $producto->nombre }}</a>
                    <p class="precio-valorado">S/ {{ $producto->precio }}</p>
                    <div class="card-iconos">
                        <button class="icono-btn" title="Agregar al carrito">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                        <button class="icono-btn" title="Vista rápida">
                            <i class="fas fa-eye"></i>
                        </button>
                        <a href="https://wa.me/960900386" class="icono-btn">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <p>No hay productos destacados aún.</p>
            @endforelse
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

</section>

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
                <li><a href="{{ route('categoria', ['id' => 'Accesorio']) }}">Accesorios</a></li>
                <li><a href="{{ route('categoria', ['id' => 'Computadora']) }}">Computadoras</a></li>
                <li><a href="{{ route('categoria', ['id' => 'Laptop']) }}">Laptops</a></li>
                <li><a href="{{ route('categoria', ['id' => 'Redes']) }}">Redes / Conectividad</a></li>
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

</body>
</html>
