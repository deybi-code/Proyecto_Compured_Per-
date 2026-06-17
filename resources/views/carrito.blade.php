<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Compured Peru</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <!-- Script de Sincronización Estricta de Modo Oscuro -->
    <script>
        function applyTheme() {
            const theme = localStorage.getItem('theme') || localStorage.getItem('color-theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                document.documentElement.classList.remove('dark');
            }
        }
        applyTheme();
        window.addEventListener('storage', applyTheme);
    </script>

    <style>
        :root {
            /* Colores principales de Compured Peru */
            --bg-body: linear-gradient(135deg, #0b33a2 0%, #27a1eb 100%);
            --bg-card: #ffffff;
            --text-main: #0b33a2; /* Azul para el texto dentro de las tarjetas */
            --text-muted: #5c728e;
            --border-color: #cce5ff;
            --primary-blue: #0b33a2;
            --light-blue: #27a1eb;
            --btn-green: #a4e613; /* El verde clarito exacto de tu logo */
            --btn-text: #081a45; /* Azul muy oscuro para que el texto resalte en el verde claro */
            --shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        [data-theme="dark"] {
            --bg-body: linear-gradient(135deg, #040d21 0%, #0b33a2 100%);
            --bg-card: #0f1c3f;
            --text-main: #e0e8f5;
            --text-muted: #8a9bb3;
            --border-color: #1e3a70;
            --primary-blue: #27a1eb;
            --light-blue: #a4e613;
            --btn-green: #a4e613;
            --btn-text: #040d21;
            --shadow: 0 15px 35px rgba(0,0,0,0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            /* Se aplica el gradiente azul intenso de fondo */
            background: var(--bg-body);
            background-attachment: fixed;
            color: var(--text-main);
            padding: 40px 20px;
            min-height: 100vh;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .header-logo {
            text-align: center;
            margin-bottom: 30px;
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 12px;
            backdrop-filter: blur(5px);
            display: inline-block;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .header-wrapper {
            display: flex;
            justify-content: center;
        }

        .header-logo img {
            height: 60px;
            width: auto;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));
        }

        .cart-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 7fr 5fr;
            gap: 30px;
        }

        @media (max-width: 968px) {
            .cart-wrapper { grid-template-columns: 1fr; }
        }

        .card-panel {
            background-color: var(--bg-card);
            border-radius: 16px;
            padding: 30px;
            box-shadow: var(--shadow);
            border-top: 5px solid var(--btn-green); /* Borde superior con el verde del logo */
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        h2 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 20px;
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 10px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product-info img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            background: #fff;
            border-radius: 8px;
            padding: 5px;
            border: 1px solid var(--border-color);
        }

        .product-det h4 { font-size: 15px; color: var(--text-main); font-weight: bold; }
        .product-det p { font-size: 13px; color: var(--text-muted); }

        .product-price {
            font-weight: 800;
            color: var(--light-blue);
            font-size: 1.2rem;
        }

        .form-group { margin-bottom: 15px; }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 6px;
            color: var(--primary-blue);
        }

        input, select {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid var(--border-color);
            background-color: var(--bg-card);
            color: var(--text-main);
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus, select:focus {
            border-color: var(--light-blue);
            box-shadow: 0 0 0 3px rgba(39, 161, 235, 0.2);
        }

        .row-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .payment-methods { margin: 20px 0; }

        .nav-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 8px;
        }

        .tab-btn {
            padding: 8px 16px;
            border: none;
            background: none;
            color: var(--text-muted);
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .tab-btn.active {
            color: var(--light-blue);
            border-bottom: 3px solid var(--light-blue);
        }

        .payment-panel { display: none; }
        .payment-panel.active { display: block; }

        .totals-section {
            background: rgba(39, 161, 235, 0.08);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
        }

        .total-row.final {
            font-size: 18px;
            font-weight: 900;
            color: var(--primary-blue);
            border-top: 2px dashed var(--light-blue);
            padding-top: 8px;
            margin-top: 8px;
        }

        .btn-pay {
            width: 100%;
            padding: 14px;
            background-color: var(--btn-green); /* Verde clarito del logo */
            color: var(--btn-text); /* Texto oscuro para contraste */
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 900;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(164, 230, 19, 0.4);
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .btn-pay:hover {
            background-color: #93ce11;
            transform: translateY(-2px);
        }

        #invoice-template {
            display: none;
            background: white;
            color: #000;
            padding: 40px;
            font-family: Arial, sans-serif;
            width: 800px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .company-box h2 { color: #0b33a2; font-size: 26px; }
        .rnc-box {
            border: 2px solid #000;
            padding: 15px;
            text-align: center;
            border-radius: 6px;
            min-width: 220px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .invoice-table th { background-color: #f4f6f9; }
    </style>
</head>
<body>

    <div class="header-wrapper">
        <div class="header-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Compured Peru">
            </a>
        </div>
    </div>

    <div class="cart-wrapper">
        <div class="card-panel">
            <h2>Tu Carrito de Compras</h2>
            <div id="cart-items-container">
                <div class="cart-item">
                    <div class="product-info">
                        <img src="{{ asset('img/logo.png') }}" alt="Producto">
                        <div class="product-det">
                            <h4>Memoria RAM Kingston FURY Beast 16GB DDR4</h4>
                            <p>Cantidad: 1</p>
                        </div>
                    </div>
                    <div class="product-price">S/ 245.00</div>
                </div>
            </div>
        </div>

        <div class="card-panel">
            <h2>Datos del Cliente y Pago</h2>
            <form id="checkout-form" onsubmit="procesarPago(event)">

                <div class="form-group">
                    <label for="document_type">Tipo de Comprobante / Documento</label>
                    <select id="document_type" onchange="alternarCamposDocumento()">
                        <option value="DNI">Boleta de Venta (DNI)</option>
                        <option value="RUC">Factura Electrónica (RUC)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label id="doc-label" for="client_doc">DNI del Cliente</label>
                    <input type="text" id="client_doc" placeholder="Ingresa el número de documento" required>
                </div>

                <div class="form-group">
                    <label for="client_name">Nombre / Razón Social</label>
                    <input type="text" id="client_name" placeholder="Nombre completo" required>
                </div>

                <div id="ruc-additional-fields" style="display: none;">
                    <div class="form-group">
                        <label for="client_address">Dirección Fiscal</label>
                        <input type="text" id="client_address" placeholder="Dirección legal de la empresa">
                    </div>
                </div>

                <div class="payment-methods">
                    <div class="nav-tabs">
                        <button type="button" class="tab-btn active" onclick="cambiarMetodoPago('card')">Tarjeta de Crédito/Débito</button>

                        <!-- Lógica a prueba de fallos: Convierte a minúsculas y busca en múltiples campos de BD -->
                        @if(auth()->check() && in_array(strtolower(auth()->user()->rol ?? auth()->user()->role ?? auth()->user()->tipo_usuario ?? ''), ['admin', 'ventas', 'administrador', '1', '2']))
                            <button type="button" class="tab-btn" onclick="cambiarMetodoPago('cash')">Pago en Efectivo (Caja)</button>
                        @endif
                    </div>

                    <div id="panel-card" class="payment-panel active">
                        <div class="form-group">
                            <label for="card_number">Número de Tarjeta</label>
                            <input type="text" id="card_number" placeholder="0000 0000 0000 0000" maxlength="19">
                        </div>
                        <div class="row-grid">
                            <div class="form-group">
                                <label for="card_expiry">Vencimiento</label>
                                <input type="text" id="card_expiry" placeholder="MM/AA" maxlength="5">
                            </div>
                            <div class="form-group">
                                <label for="card_cvv">CVV</label>
                                <input type="password" id="card_cvv" placeholder="000" maxlength="3">
                            </div>
                        </div>
                    </div>

                    <div id="panel-cash" class="payment-panel">
                        <p style="font-size: 14px; color: var(--primary-blue); font-weight: bold; border: 2px dashed var(--light-blue); background: var(--border-color); padding: 15px; border-radius: 8px;">
                            ✓ Modo de venta física activo. El dinero se registrará directamente en el flujo de caja diario de la tienda sin validar transacciones bancarias electrónicas.
                        </p>
                    </div>
                </div>

                <div class="totals-section">
                    <div class="total-row"><span>Subtotal:</span><span id="subtotal-val">S/ 207.63</span></div>
                    <div class="total-row"><span>I.G.V (18%):</span><span id="igv-val">S/ 37.37</span></div>
                    <div class="total-row final"><span>Total a Pagar:</span><span id="total-val">S/ 245.00</span></div>
                </div>

                <button type="submit" class="btn-pay">FINALIZAR COMPRA Y EMITIR</button>
            </form>
        </div>
    </div>

    <div id="invoice-template">
        <div class="invoice-header">
            <div class="company-box">
                <h2>COMPURED PERU S.A.C.</h2>
                <p>Tecnología Informática a tu Alcance</p>
                <p>Av. España 1542, Trujillo, La Libertad</p>
                <p>Email: ventas@compured.com</p>
            </div>
            <div class="rnc-box">
                <h3 style="color: #0b33a2;" id="pdf-type-title">BOLETA DE VENTA ELECTRÓNICA</h3>
                <p><strong>RUC: 20601234567</strong></p>
                <p id="pdf-invoice-number">N° B001-000412</p>
            </div>
        </div>

        <div style="margin-bottom: 20px; font-size: 14px;">
            <p><strong>Señor(es):</strong> <span id="pdf-client-name"></span></p>
            <p><strong><span id="pdf-doc-type">DNI</span>:</strong> <span id="pdf-client-doc"></span></p>
            <p id="pdf-address-row" style="display:none;"><strong>Dirección Fiscal:</strong> <span id="pdf-client-address"></span></p>
            <p><strong>Fecha de Emisión:</strong> <span id="pdf-date"></span></p>
            <p><strong>Moneda:</strong> Soles (S/)</p>
            <p><strong>Forma de Pago:</strong> <span id="pdf-payment-method">Tarjeta</span></p>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Cant.</th>
                    <th>Descripción del Producto / Componente</th>
                    <th>P. Unitario</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Memoria RAM Kingston FURY Beast 16GB DDR4</td>
                    <td>S/ 245.00</td>
                    <td>S/ 245.00</td>
                </tr>
            </tbody>
        </table>

        <div style="float: right; width: 250px; font-size: 14px; line-height: 1.8;">
            <div style="display:flex; justify-content: space-between;"><span>Op. Gravada:</span><span id="pdf-subtotal">S/ 207.63</span></div>
            <div style="display:flex; justify-content: space-between;"><span>I.G.V. (18%):</span><span id="pdf-igv">S/ 37.37</span></div>
            <div style="display:flex; justify-content: space-between; font-weight: bold; border-top: 1px solid #000; padding-top: 5px; font-size: 16px;">
                <span>Total:</span><span id="pdf-total">S/ 245.00</span>
            </div>
        </div>

        <div style="margin-top: 120px; text-align: center; font-size: 12px; color: #555;">
            <p>Representación impresa de la Boleta Electrónica.</p>
            <p>Consulte su validez en el portal web de la SUNAT.</p>
            <p><strong>¡Gracias por comprar en Compured Peru!</strong></p>
        </div>
    </div>

    <script>
        let metodoSeleccionado = 'card';

        function alternarCamposDocumento() {
            const docType = document.getElementById('document_type').value;
            const label = document.getElementById('doc-label');
            const rucFields = document.getElementById('ruc-additional-fields');
            const clientDocInput = document.getElementById('client_doc');

            if (docType === 'RUC') {
                label.textContent = "RUC de la Empresa";
                clientDocInput.placeholder = "Ingresa el RUC de 11 dígitos";
                rucFields.style.display = 'block';
            } else {
                label.textContent = "DNI del Cliente";
                clientDocInput.placeholder = "Ingresa el DNI de 8 dígitos";
                rucFields.style.display = 'none';
            }
        }

        function cambiarMetodoPago(metodo) {
            metodoSeleccionado = metodo;
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.payment-panel').forEach(panel => panel.classList.remove('active'));

            if (metodo === 'card') {
                document.getElementById('panel-card').classList.add('active');
                event.target.classList.add('active');
                document.getElementById('card_number').setAttribute('required', 'required');
            } else {
                document.getElementById('panel-cash').classList.add('active');
                event.target.classList.add('active');
                document.getElementById('card_number').removeAttribute('required');
            }
        }

        function procesarPago(e) {
            e.preventDefault();

            const docType = document.getElementById('document_type').value;
            const clientDoc = document.getElementById('client_doc').value;
            const clientName = document.getElementById('client_name').value;
            const clientAddress = document.getElementById('client_address').value;

            document.getElementById('pdf-client-name').textContent = clientName.toUpperCase();
            document.getElementById('pdf-client-doc').textContent = clientDoc;
            document.getElementById('pdf-date').textContent = new Date().toLocaleDateString('es-PE') + ' ' + new Date().toLocaleTimeString();
            document.getElementById('pdf-payment-method').textContent = metodoSeleccionado === 'card' ? 'TARJETA BANCARIA' : 'EFECTIVO EN CAJA';

            if (docType === 'RUC') {
                document.getElementById('pdf-type-title').textContent = "FACTURA ELECTRÓNICA";
                document.getElementById('pdf-invoice-number').textContent = "N° F001-" + Math.floor(100000 + Math.random() * 900000);
                document.getElementById('pdf-doc-type').textContent = "RUC";
                document.getElementById('pdf-address-row').style.display = 'block';
                document.getElementById('pdf-client-address').textContent = clientAddress.toUpperCase();
            } else {
                document.getElementById('pdf-type-title').textContent = "BOLETA DE VENTA ELECTRÓNICA";
                document.getElementById('pdf-invoice-number').textContent = "N° B001-" + Math.floor(100000 + Math.random() * 900000);
                document.getElementById('pdf-doc-type').textContent = "DNI";
                document.getElementById('pdf-address-row').style.display = 'none';
            }

            const element = document.getElementById('invoice-template');
            element.style.display = 'block';

            const opciones = {
                margin:       10,
                filename:     `${docType}_COMPURED_${clientDoc}.pdf`,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, logging: false },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            html2pdf().from(element).set(opciones).save().then(() => {
                element.style.display = 'none';
                alert('¡Transacción exitosa! El comprobante electrónico ha sido generado y descargado.');
            });
        }
    </script>
</body>
</html>
