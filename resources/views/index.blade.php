<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compured Perú</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="{{ asset('js/theme.js') }}"></script>

    <style>
        /* ESTILOS DEL MENÚ LATERAL */
        .cat-sidebar {
            background-color: #ffffff;
            border-radius: 0;
            overflow: hidden;
            width: 260px;
            min-width: 260px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .cat-sidebar-titulo {
            background-color: #ffffff;
            color: #333;
            padding: 15px;
            font-size: 14px;
            font-weight: bold;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cat-sidebar-lista {
            list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column;
        }
        .cat-sidebar-lista li {
            border-bottom: 1px solid #f5f5f5;
        }
        .cat-sidebar-lista a {
            display: flex; align-items: center; padding: 10px 15px; color: #555; text-decoration: none; font-size: 13px; transition: background 0.2s, color 0.2s;
        }
        .cat-sidebar-lista a:hover {
            background-color: #f9f9f9; color: #27a1eb;
        }

        body.dark-mode .cat-sidebar {
            background-color: #1a1a1a; border-color: #2d2d2d;
        }
        body.dark-mode .cat-sidebar-titulo {
            background-color: #1a1a1a; color: #fff; border-bottom-color: #333;
        }
        body.dark-mode .cat-sidebar-lista li { border-bottom: 1px solid #2d2d2d; }
        body.dark-mode .cat-sidebar-lista a { color: #bbb; }
        body.dark-mode .cat-sidebar-lista a:hover { background-color: #252525; color: #27a1eb; }

        /* NUEVA SECCIÓN HERO (SLIDER + BANNER LATERAL) */
        .hero-container {
            display: flex;
            gap: 20px;
            max-width: 1200px;
            margin: 20px auto 0 auto;
            align-items: stretch;
            height: 400px; /* Altura fija para que ambos se alineen perfecto */
        }

        .main-slider {
            flex: 3; /* 75% del ancho */
            position: relative;
            overflow: hidden;
            border-radius: 4px;
            background-color: #e2e8f0;
        }

        .slider-wrapper {
            display: flex;
            height: 100%;
            transition: transform 0.5s ease-in-out;
        }

        .slider-wrapper img {
            min-width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .side-banner {
            flex: 1; /* 25% del ancho */
            border-radius: 4px;
            overflow: hidden;
            background-color: #e2e8f0;
            display: flex;
        }

        .side-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .side-banner:hover img {
            transform: scale(1.02);
        }

        /* CONTROLES DEL SLIDER */
        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.3);
            color: white;
            border: none;
            width: 35px;
            height: 50px;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
            z-index: 10;
        }
        .slider-btn:hover { background: rgba(0, 0, 0, 0.7); }
        .slider-btn.prev { left: 0; }
        .slider-btn.next { right: 0; }

        .slider-dots {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }
        .slider-dot {
            width: 30px;
            height: 4px;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: background 0.3s;
        }
        .slider-dot.activo { background: #ffffff; }

        /* BARRAS INFERIORES TIPO IMAGEN */
        .strip-dark {
            background-color: #1c1c1c;
            color: #ffffff;
            text-align: center;
            padding: 12px;
            font-size: 14px;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        .strip-dark i { font-size: 18px; }

        .strip-links {
            background-color: #ffffff;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border: 1px solid #e0e0e0;
            border-top: none;
        }

        .btn-whatsapp-strip {
            background-color: #27a1eb;
            color: #ffffff;
            padding: 6px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .links-right {
            display: flex;
            gap: 25px;
        }

        .links-right a {
            color: #555;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s;
        }
        .links-right a:hover { color: #27a1eb; }
        .links-right a.highlight { color: #27a1eb; font-weight: bold; }

        body.dark-mode .strip-links {
            background-color: #1a1a1a;
            border-color: #2d2d2d;
        }
        body.dark-mode .links-right a { color: #bbb; }
        body.dark-mode .links-right a:hover { color: #27a1eb; }

        @media (max-width: 968px) {
            .hero-container { flex-direction: column; height: auto; }
            .main-slider { height: 250px; }
            .side-banner { height: 150px; }
            .strip-links { flex-direction: column; gap: 15px; }
            .links-right { flex-wrap: wrap; justify-content: center; }
        }
    </style>
</head>
<body>

@if (session('status'))
    <div id="success-alert" style="background-color: #d4edda; color: #155724; padding: 12px 20px; text-align: center; font-weight: 600; font-size: 14px; border-bottom: 1px solid #c3e6cb; display: flex; justify-content: center; align-items: center; gap: 15px; font-family: sans-serif;">
        <span><i class="fas fa-check-circle"></i> {{ session('status') }}</span>
        <button onclick="document.getElementById('success-alert').style.display='none'" style="background: none; border: none; color: #155724; font-size: 16px; cursor: pointer; font-weight: bold;">✕</button>
    </div>
@endif

<div class="top-info">
    <div class="top-left"></div>
    <div class="top-right">
        @guest
            <a href="{{ route('register') }}">Registrarse</a>
            <span style="color: white; margin: 0 5px;">|</span>
            <a href="{{ route('login') }}">Entrar</a>
        @endguest
        @auth
            <span style="color: white; font-size: 13px; font-weight: bold; padding-right: 15px;">
                <i class="fas fa-user-check"></i> {{ Auth::user()->nombre_completo }}
            </span>
        @endauth
    </div>
</div>

<header class="topbar">
    <div class="logo">
        <a href="{{ route('inicio') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Compured">
        </a>
    </div>

    <form action="{{ route('buscar') }}" method="GET" class="topbar-search" style="display: flex; flex: 1; max-width: 600px; margin: 0 30px;">
        <select name="categoria_filtro" style="width: 150px; border-radius: 4px 0 0 4px; border: 1px solid #e0e0e0; border-right: none; padding: 10px; outline: none; background: #fff;">
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
        <input type="text" name="buscar" placeholder="Buscar producto" style="flex: 1; border: 1px solid #e0e0e0; padding: 10px; outline: none;">
        <button type="submit" style="background: #27a1eb; border: none; color: white; padding: 0 20px; border-radius: 0 4px 4px 0; cursor: pointer;"><i class="fas fa-search"></i></button>
    </form>

    <div class="topbar-icons">
        <a href="{{ route('carrito') }}" class="topbar-icon" style="position: relative;">
            <i class="fas fa-shopping-cart" style="font-size: 20px; color: #555;"></i>
            <span style="position: absolute; top: -8px; right: -10px; background: #27a1eb; color: white; border-radius: 50%; font-size: 10px; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">0</span>
        </a>
        <button onclick="toggleDarkMode()" class="topbar-icon" style="background: none; border: none; cursor: pointer;">
            <i class="fas fa-moon" style="font-size: 20px; color: #555;"></i>
        </button>

        @auth
            @if(Auth::user()->rol === 'administrador')
                <a href="{{ url('/admin/productos') }}" class="topbar-icon" style="color: #0b33a2;">
                    <i class="fas fa-user-shield" style="font-size: 20px;"></i>
                </a>
            @endif
        @endauth

        <div style="position: relative; display: inline-block;">
            <a href="#" onclick="toggleUserDropdown(event)" id="dropdownBtn" class="topbar-icon">
                <i class="fas fa-user" style="font-size: 20px; color: #555;"></i>
            </a>

            <div id="userDropdown" style="display: none; position: absolute; right: 0; top: 40px; background-color: #ffffff; min-width: 180px; border: 1px solid #dfe1e6; border-radius: 4px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); z-index: 1000; overflow: hidden;">
                @auth
                    <a href="{{ route('profile.edit') }}" style="display: block; padding: 12px 16px; color: #333; text-decoration: none; font-size: 13px;">Ver detalles</a>
                    <hr style="border: 0; border-top: 1px solid #eee; margin: 0;">
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" style="display: block; width: 100%; text-align: left; padding: 12px 16px; background: none; border: none; color: #e53e3e; font-size: 13px; cursor: pointer;">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="display: block; padding: 12px 16px; color: #333; text-decoration: none; font-size: 13px;">Inicia Sesión</a>
                    <a href="{{ route('register') }}" style="display: block; padding: 12px 16px; color: #333; text-decoration: none; font-size: 13px;">Registrarse</a>
                @endauth
            </div>
        </div>
    </div>
</header>

<!-- SECCIÓN TIPO IMAGEN DE REFERENCIA -->
<div class="hero-container">
    <!-- 3 Anuncios Intercalables Izquierda -->
    <div class="main-slider">
        <div class="slider-wrapper" id="banner-slider">
            <img src="{{ asset('img/banner1.jpg') }}" alt="Anuncio 1 (Slider)">
            <img src="{{ asset('img/banner2.jpg') }}" alt="Anuncio 2 (Slider)">
            <img src="{{ asset('img/banner3.jpg') }}" alt="Anuncio 3 (Slider)">
        </div>
        <button class="slider-btn prev" onclick="moveSlider(-1)"><i class="fas fa-chevron-left"></i></button>
        <button class="slider-btn next" onclick="moveSlider(1)"><i class="fas fa-chevron-right"></i></button>
        <div class="slider-dots">
            <span class="slider-dot activo" onclick="goToSlide(0)"></span>
            <span class="slider-dot" onclick="goToSlide(1)"></span>
            <span class="slider-dot" onclick="goToSlide(2)"></span>
        </div>
    </div>

    <!-- 1 Anuncio Fijo Derecha -->
    <div class="side-banner">
        <img src="{{ asset('img/banner4.jpg') }}" alt="Anuncio 4 (Fijo)">
    </div>
</div>

<div class="strip-dark">
    Enviamos tu pedido a casa <i class="fas fa-truck"></i>
</div>

<div class="strip-links">
    <a href="https://wa.me/960900386" class="btn-whatsapp-strip">
        WHATSAPP VENTAS <i class="fab fa-whatsapp" style="font-size: 16px;"></i>
    </a>
    <div class="links-right">
        <a href="#">Sobre nosotros</a>
        <a href="#">Términos y Condiciones</a>
        <a href="#">Contacta con nosotros</a>
        <a href="#" class="highlight">Seguimiento de pedidos</a>
    </div>
</div>

<section class="marcas" style="max-width: 1200px; margin: 20px auto; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
    <img src="{{ asset('img/marca1.jpg') }}">
    <img src="{{ asset('img/marca2.jpg') }}">
    <img src="{{ asset('img/marca3.jpg') }}">
    <img src="{{ asset('img/marca4.jpg') }}">
    <img src="{{ asset('img/marca5.jpg') }}">
</section>

<section class="contenido">

    <aside class="cat-sidebar" style="margin-top: 20px;">
        <div class="cat-sidebar-titulo">
            Categorías <i class="fas fa-chevron-down" style="font-size: 12px; color: #888;"></i>
        </div>
        <ul class="cat-sidebar-lista">
            <li><a href="{{ route('categoria', ['id' => 'Accesorio']) }}">Accesorios</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Computadora']) }}">Computadoras</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Laptop']) }}">Laptops</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Redes']) }}">Redes / Conectividad</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Case']) }}">Case</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Fuente']) }}">Fuentes para Case</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Cooler']) }}">Coolers/CPU</a></li>
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
            <li><a href="{{ route('categoria', ['id' => 'Tarjeta Video']) }}">Tarjetas de Video</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Teclado']) }}">Teclados</a></li>
            <li><a href="{{ route('categoria', ['id' => 'UPS']) }}">UPS, Estabilizadores</a></li>
        </ul>
    </aside>

    <div class="contenido-derecha">
        <h3 class="seccion-titulo" style="border-bottom: 2px solid #27a1eb; padding-bottom: 10px; margin-bottom: 20px;">Los más valorados</h3>

        <div class="grid-valorados">
            @forelse($destacados ?? [] as $producto)
            <div class="card-valorado" style="border: 1px solid #e0e0e0; border-radius: 4px;">
                <a href="{{ route('producto', ['id' => $producto->id_producto]) }}" class="card-valorado-img">
                    <img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                </a>
                <div class="card-valorado-info">
                    <a href="{{ route('producto', ['id' => $producto->id_producto]) }}" class="nombre-valorado" style="font-size: 14px; font-weight: normal; color: #333;">{{ $producto->nombre }}</a>
                    <p class="precio-valorado" style="color: #c00; font-size: 18px; font-weight: bold; margin: 10px 0;">S/ {{ $producto->precio }}</p>
                    <div class="card-iconos">
                        <button class="icono-btn" title="Agregar al carrito"><i class="fas fa-cart-plus"></i></button>
                        <button class="icono-btn" title="Vista rápida"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
            </div>
            @empty
                <p>No hay productos destacados aún.</p>
            @endforelse
        </div>
    </div>

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

<footer class="footer" style="background: #111; color: #ccc; margin-top: 50px;">
    <div class="footer-grid">
        <div class="footer-col">
            <h4 style="color: white;">Compured Perú</h4>
            <p>eCommerce que vende y promociona productos tecnológicos para toda persona, respaldados por una empresa.</p>
            <div class="footer-redes">
                <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://wa.me/960900386" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
        <div class="footer-col">
            <h4 style="color: white;">Enlaces</h4>
            <ul>
                <li><a href="{{ route('inicio') }}">Home</a></li>
                <li><a href="#">Sobre nosotros</a></li>
                <li><a href="#">Términos y condiciones</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4 style="color: white;">Últimas categorías</h4>
            <ul>
                <li><a href="{{ route('categoria', ['id' => 'Accesorio']) }}">Accesorios</a></li>
                <li><a href="{{ route('categoria', ['id' => 'Computadora']) }}">Computadoras</a></li>
                <li><a href="{{ route('categoria', ['id' => 'Laptop']) }}">Laptops</a></li>
                <li><a href="{{ route('categoria', ['id' => 'Redes']) }}">Redes / Conectividad</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom" style="border-top: 1px solid #333;">
        <p>© 2026 Compured Perú — Todos los derechos reservados</p>
    </div>
</footer>

<a href="https://wa.me/960900386" class="whatsapp" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<script>
function toggleUserDropdown(event) {
    event.preventDefault();
    const dropdown = document.getElementById('userDropdown');
    dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' : 'none';
}
window.onclick = function(event) {
    if (!event.target.matches('#dropdownBtn') && !event.target.closest('#dropdownBtn')) {
        const dropdown = document.getElementById('userDropdown');
        if (dropdown && dropdown.style.display === 'block') { dropdown.style.display = 'none'; }
    }
}

// LÓGICA DEL SLIDER PRINCIPAL (3 IMÁGENES)
let currentSlide = 0;
const totalSlides = 3;
const slider = document.getElementById('banner-slider');
const dots = document.querySelectorAll('.slider-dot');

function updateSlider() {
    slider.style.transform = `translateX(-${currentSlide * 100}%)`;
    dots.forEach((dot, index) => {
        if (index === currentSlide) {
            dot.classList.add('activo');
        } else {
            dot.classList.remove('activo');
        }
    });
}

function moveSlider(direction) {
    currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
    updateSlider();
}

function goToSlide(index) {
    currentSlide = index;
    updateSlider();
}

setInterval(() => {
    moveSlider(1);
}, 5000);
</script>

<script src="{{ asset('js/carrito.js') }}"></script>

</body>
</html>
