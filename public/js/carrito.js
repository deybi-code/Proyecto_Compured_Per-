let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

function agregarCarrito(nombre, precio, imagen) {
    let existente = carrito.find(p => p.nombre === nombre);

    if (existente) {
        existente.cantidad++;
    } else {
        carrito.push({ nombre, precio, imagen, cantidad: 1 });
    }

    localStorage.setItem("carrito", JSON.stringify(carrito));
    alert("Producto agregado al carrito");
}

function mostrarCarrito() {
    let contenedor = document.getElementById("lista-carrito");
    if (!contenedor) return;

    if (carrito.length === 0) {
        contenedor.innerHTML = "<p>El carrito está vacío.</p>";
        return;
    }

    contenedor.innerHTML = "";

    carrito.forEach((producto, index) => {
        contenedor.innerHTML += `
            <div class="carrito-item">
                <img src="/img/${producto.imagen}" width="80">
                <div>
                    <p><strong>${producto.nombre}</strong></p>
                    <p>S/ ${producto.precio} x ${producto.cantidad}</p>
                    <p>Subtotal: S/ ${(producto.precio * producto.cantidad).toFixed(2)}</p>
                </div>
                <button onclick="eliminarProducto(${index})">X</button>
            </div>
        `;
    });
}

function mostrarTotal() {
    let total = 0;
    carrito.forEach(p => total += p.precio * p.cantidad);

    let totalHTML = document.getElementById("total");
    if (totalHTML) {
        totalHTML.innerText = "Total: S/ " + total.toFixed(2);
    }
}

function eliminarProducto(index) {
    carrito.splice(index, 1);
    localStorage.setItem("carrito", JSON.stringify(carrito));
    mostrarCarrito();
    mostrarTotal();
}

function vaciarCarrito() {
    carrito = [];
    localStorage.setItem("carrito", JSON.stringify(carrito));
    mostrarCarrito();
    mostrarTotal();
}

function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");
    localStorage.setItem("modo", document.body.classList.contains("dark-mode") ? "oscuro" : "claro");
}

window.onload = function() {
    if (localStorage.getItem("modo") === "oscuro") {
        document.body.classList.add("dark-mode");
    }
}

function vistaRapida(nombre, precio, imagen, descripcion, id) {
    document.getElementById('modal-nombre').innerText = nombre;
    document.getElementById('modal-precio').innerText = 'S/ ' + precio;
    document.getElementById('modal-descripcion').innerText = descripcion;
    document.getElementById('modal-imagen').src = '/img/' + imagen;
    document.getElementById('modal-ver').href = '/producto/' + id;

    document.getElementById('modal-carrito').onclick = function() {
        agregarCarrito(nombre, precio, imagen);
        document.getElementById('modal-rapida').classList.remove('activo');
    };

    document.getElementById('modal-rapida').classList.add('activo');
}

function cerrarModal(event) {
    if (event.target === document.getElementById('modal-rapida')) {
        document.getElementById('modal-rapida').classList.remove('activo');
    }
}