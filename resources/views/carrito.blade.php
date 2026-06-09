<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito — Compured Perú</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

<!-- BOTÓN VOLVER -->
<div class="volver">
    <a href="{{ route('inicio') }}">
        ← Seguir comprando
    </a>
</div>

<!-- CONTENIDO -->
<section class="carrito-container">

    <h2>Carrito de compras</h2>

    <div id="lista-carrito"></div>

    <h3 id="total"></h3>

    <div class="acciones-carrito">
        <button onclick="vaciarCarrito()">
            <i class="fas fa-trash"></i> Vaciar carrito
        </button>
        <a href="#" onclick="finalizarWhatsApp()" class="btn-finalizar-ws">
            <i class="fab fa-whatsapp"></i> Finalizar por WhatsApp
        </a>
    </div>

</section>

<a href="https://wa.me/960900386" class="whatsapp" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<script src="{{ asset('js/carrito.js') }}"></script>
<script>
    mostrarCarrito();
    mostrarTotal();

    function finalizarWhatsApp() {
        if (carrito.length === 0) {
            alert('El carrito está vacío');
            return;
        }

        let mensaje = 'Hola, quiero realizar el siguiente pedido:\n\n';
        carrito.forEach(p => {
            mensaje += `- ${p.nombre} x${p.cantidad} = S/ ${(p.precio * p.cantidad).toFixed(2)}\n`;
        });

        let total = carrito.reduce((sum, p) => sum + p.precio * p.cantidad, 0);
        mensaje += `\nTotal: S/ ${total.toFixed(2)}`;

        window.open('https://wa.me/960900386?text=' + encodeURIComponent(mensaje), '_blank');
    }
</script>

</body>
</html>