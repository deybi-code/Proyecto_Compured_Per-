<!-- resources/views/index.blade.php -->
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
            background-color: #ffffff; color: #333; padding: 15px; font-size: 14px; font-weight: bold; border-bottom: 2px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center;
        }
        .cat-sidebar-lista { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; }
        .cat-sidebar-lista li { border-bottom: 1px solid #f5f5f5; }
        .cat-sidebar-lista a { display: flex; align-items: center; padding: 10px 15px; color: #555; text-decoration: none; font-size: 13px; transition: background 0.2s, color 0.2s; }
        .cat-sidebar-lista a:hover { background-color: #f9f9f9; color: #27a1eb; }

        body.dark-mode .cat-sidebar { background-color: #1a1a1a; border-color: #2d2d2d; }
        body.dark-mode .cat-sidebar-titulo { background-color: #1a1a1a; color: #fff; border-bottom-color: #333; }
        body.dark-mode .cat-sidebar-lista li { border-bottom: 1px solid #2d2d2d; }
        body.dark-mode .cat-sidebar-lista a { color: #bbb; }
        body.dark-mode .cat-sidebar-lista a:hover { background-color: #252525; color: #27a1eb; }

        /* ICONOS SUPERIORES CON TEXTO */
        .topbar-icons { display: flex; gap: 20px; align-items: center; }
        .topbar-icon { display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; color: #555; cursor: pointer; transition: color 0.3s; background: none; border: none; }
        .topbar-icon i { font-size: 20px; margin-bottom: 4px; transition: transform 0.4s ease, opacity 0.4s ease; }
        .topbar-icon span.icon-label { font-size: 11px; font-weight: bold; }
        .topbar-icon:hover { color: #27a1eb; }
        body.dark-mode .topbar-icon { color: #ccc; }
        body.dark-mode .topbar-icon:hover { color: #27a1eb; }

        /* ANIMACIÓN MODO OSCURO */
        .theme-rotating { transform: rotate(360deg) scale(0.5); opacity: 0; }

        /* NUEVA SECCIÓN HERO (SLIDER CORREGIDO) */
        .hero-container { display: flex; gap: 20px; max-width: 1200px; margin: 20px auto 0 auto; align-items: stretch; height: 400px; }
        .main-slider { flex: 3; position: relative; overflow: hidden; border-radius: 4px; background-color: #111; }
        .slider-wrapper { display: flex; height: 100%; transition: transform 0.5s ease-in-out; width: 100%; }
        .slide { min-width: 100%; height: 100%; position: relative; display: flex; align-items: center; justify-content: center; background-color: #222; color: #555; }
        .slide img { width: 100%; height: 100%; object-fit: cover; }
        .slide-overlay { position: absolute; bottom: 40px; left: 40px; z-index: 5; }
        .btn-comprar-slider { background: #27a1eb; color: #fff; padding: 12px 24px; text-decoration: none; font-weight: 900; font-size: 14px; border-radius: 30px; text-transform: uppercase; box-shadow: 0 4px 15px rgba(39, 161, 235, 0.4); transition: transform 0.2s, background 0.2s; display: inline-block; }
        .btn-comprar-slider:hover { transform: translateY(-3px); background: #1c85c7; }

        .side-banner { flex: 1; border-radius: 4px; overflow: hidden; background-color: #111; position: relative; display: flex; align-items: center; justify-content: center; color: #555; }
        .side-banner img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
        .side-banner:hover img { transform: scale(1.02); }

        .slider-btn { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(0, 0, 0, 0.5); color: white; border: none; width: 40px; height: 60px; cursor: pointer; font-size: 20px; display: flex; align-items: center; justify-content: center; transition: background 0.3s; z-index: 10; }
        .slider-btn:hover { background: rgba(0, 0, 0, 0.9); }
        .slider-btn.prev { left: 0; }
        .slider-btn.next { right: 0; }

        .slider-dots { position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 10; }
        .slider-dot { width: 30px; height: 4px; background: rgba(255, 255, 255, 0.3); cursor: pointer; transition: background 0.3s; }
        .slider-dot.activo { background: #ffffff; }

        /* BARRAS INFERIORES */
        .strip-dark { background-color: #1c1c1c; color: #ffffff; text-align: center; padding: 12px; font-size: 14px; max-width: 1200px; margin: 0 auto; display: flex; justify-content: center; align-items: center; gap: 10px; }
        .strip-links { background-color: #ffffff; max-width: 1200px; margin: 0 auto; display: flex; justify-content: center; align-items: center; padding: 15px 20px; border: 1px solid #e0e0e0; border-top: none; }
        .links-right { display: flex; gap: 40px; }
        .links-right a { color: #555; text-decoration: none; font-size: 13px; font-weight: 600; transition: color 0.2s; }
        .links-right a:hover { color: #27a1eb; }
        .links-right a.highlight { color: #27a1eb; font-weight: 900; }

        body.dark-mode .strip-links { background-color: #1a1a1a; border-color: #2d2d2d; }
        body.dark-mode .links-right a { color: #bbb; }
        body.dark-mode .links-right a:hover { color: #27a1eb; }

        @media (max-width: 968px) {
            .hero-container { flex-direction: column; height: auto; }
            .main-slider { height: 250px; }
            .side-banner { height: 150px; }
            .strip-links { flex-direction: column; gap: 15px; }
            .links-right { flex-wrap: wrap; justify-content: center; gap: 20px; }
        }
    </style>
</head>
<body>

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
        </select>
        <input type="text" name="buscar" placeholder="Buscar producto" style="flex: 1; border: 1px solid #e0e0e0; padding: 10px; outline: none;">
        <button type="submit" style="background: #27a1eb; border: none; color: white; padding: 0 20px; border-radius: 0 4px 4px 0; cursor: pointer;"><i class="fas fa-search"></i></button>
    </form>

    <div class="topbar-icons">
        <a href="{{ route('carrito') }}" class="topbar-icon">
            <div style="position: relative;">
                <i class="fas fa-shopping-cart"></i>
                <span style="position: absolute; top: -8px; right: -10px; background: #27a1eb; color: white; border-radius: 50%; font-size: 10px; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">0</span>
            </div>
            <span class="icon-label">Carrito</span>
        </a>

        <button onclick="toggleDarkModeAnimation()" class="topbar-icon">
            <i id="theme-icon" class="fas fa-moon"></i>
            <span class="icon-label" id="theme-text">Oscuro</span>
        </button>

        @auth
            @if(Auth::user()->rol === 'administrador')
                <a href="{{ url('/admin/anuncios') }}" class="topbar-icon" style="color: #0b33a2;">
                    <i class="fas fa-user-shield"></i>
                    <span class="icon-label">Panel Admin</span>
                </a>
            @endif
        @endauth

        <div style="position: relative; display: inline-block;">
            <a href="#" onclick="toggleUserDropdown(event)" id="dropdownBtn" class="topbar-icon">
                <i class="fas fa-user"></i>
                <span class="icon-label">Mi cuenta</span>
            </a>

            <div id="userDropdown" style="display: none; position: absolute; right: 0; top: 50px; background-color: #ffffff; min-width: 180px; border: 1px solid #dfe1e6; border-radius: 4px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); z-index: 1000; overflow: hidden;">
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

<div class="hero-container">
    <div class="main-slider">
        <div class="slider-wrapper" id="banner-slider">
            <div class="slide">
                <img src="{{ asset('img/banner1.jpg') }}" alt="Sin Imagen 1" onerror="this.style.display='none'">
                <div class="slide-overlay"><a href="#" class="btn-comprar-slider">COMPRAR AHORA <i class="fas fa-arrow-right"></i></a></div>
            </div>
            <div class="slide">
                <img src="{{ asset('img/banner2.jpg') }}" alt="Sin Imagen 2" onerror="this.style.display='none'">
                <div class="slide-overlay"><a href="#" class="btn-comprar-slider">COMPRAR AHORA <i class="fas fa-arrow-right"></i></a></div>
            </div>
            <div class="slide">
                <img src="{{ asset('img/banner3.jpg') }}" alt="Sin Imagen 3" onerror="this.style.display='none'">
                <div class="slide-overlay"><a href="#" class="btn-comprar-slider">COMPRAR AHORA <i class="fas fa-arrow-right"></i></a></div>
            </div>
        </div>
        <button class="slider-btn prev" onclick="moveSlider(-1)"><i class="fas fa-chevron-left"></i></button>
        <button class="slider-btn next" onclick="moveSlider(1)"><i class="fas fa-chevron-right"></i></button>
        <div class="slider-dots">
            <span class="slider-dot activo" onclick="goToSlide(0)"></span>
            <span class="slider-dot" onclick="goToSlide(1)"></span>
            <span class="slider-dot" onclick="goToSlide(2)"></span>
        </div>
    </div>

    <div class="side-banner">
        <img src="{{ asset('img/banner4.jpg') }}" alt="Sin Imagen Fija" onerror="this.style.display='none'">
        <div style="position:absolute; bottom: 20px;"><a href="#" class="btn-comprar-slider">VER OFERTA</a></div>
    </div>
</div>

<div class="strip-dark">
    Enviamos tu pedido a casa <i class="fas fa-truck"></i>
</div>

<div class="strip-links">
    <div class="links-right">
        <a href="{{ url('/nosotros') }}">Sobre nosotros</a>
        <a href="{{ url('/terminos') }}">Términos y Condiciones</a>
        <a href="https://wa.me/960900386" target="_blank">Contacta con nosotros</a>
        <a href="{{ url('/pedidos/seguimiento') }}" class="highlight">Seguimiento de pedidos</a>
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
        <div class="cat-sidebar-titulo">Categorías <i class="fas fa-chevron-down" style="font-size: 12px; color: #888;"></i></div>
        <ul class="cat-sidebar-lista">
            <li><a href="{{ route('categoria', ['id' => 'Accesorio']) }}">Accesorios</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Computadora']) }}">Computadoras</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Laptop']) }}">Laptops</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Redes']) }}">Redes / Conectividad</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Case']) }}">Case</a></li>
            <li><a href="{{ route('categoria', ['id' => 'Fuente']) }}">Fuentes para Case</a></li>
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
</section>

<script>
// ACTUALIZAR ICONO AL CARGAR
document.addEventListener('DOMContentLoaded', () => {
    const isDark = document.documentElement.classList.contains('dark') || document.body.classList.contains('dark-mode');
    const icon = document.getElementById('theme-icon');
    const text = document.getElementById('theme-text');
    icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
    text.textContent = isDark ? 'Claro' : 'Oscuro';
});

// ANIMACIÓN Y TOGGLE MODO OSCURO
function toggleDarkModeAnimation() {
    const icon = document.getElementById('theme-icon');
    const text = document.getElementById('theme-text');

    icon.classList.add('theme-rotating');

    setTimeout(() => {
        toggleDarkMode(); // Función de theme.js
        const isDark = document.body.classList.contains('dark-mode');
        icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
        text.textContent = isDark ? 'Claro' : 'Oscuro';
        icon.classList.remove('theme-rotating');
    }, 400);
}

// LÓGICA DEL SLIDER (INTERVALO 3 SEGUNDOS ESTRICTO)
let currentSlide = 0;
const totalSlides = 3;
const slider = document.getElementById('banner-slider');
const dots = document.querySelectorAll('.slider-dot');
let slideInterval;

function updateSlider() {
    slider.style.transform = `translateX(-${currentSlide * 100}%)`;
    dots.forEach((dot, index) => {
        dot.classList.toggle('activo', index === currentSlide);
    });
}

function moveSlider(direction) {
    currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
    updateSlider();
    resetInterval();
}

function goToSlide(index) {
    currentSlide = index;
    updateSlider();
    resetInterval();
}

function resetInterval() {
    clearInterval(slideInterval);
    slideInterval = setInterval(() => moveSlider(1), 3000);
}
resetInterval();

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
</script>
</body>
</html>
