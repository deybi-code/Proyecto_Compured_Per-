<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Compured Peru</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        :root {
            --bg-body: #f4f6f9;
            --bg-card: #ffffff;
            --text-main: #172b4d;
            --text-muted: #7a869a;
            --border-color: #dfe1e6;
            --primary-blue: #0052cc;
            --light-blue: #00a3ff;
            --hover-blue: #0043a4;
            --success-green: #36b37e;
            --input-bg: #ffffff;
            --shadow: 0 10px 25px rgba(0, 82, 204, 0.08);
        }

        [data-theme="dark"] {
            --bg-body: #0f172a;
            --bg-card: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --primary-blue: #38bdf8;
            --light-blue: #0ea5e9;
            --hover-blue: #0284c7;
            --input-bg: #0f172a;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            padding: 40px 20px;
            transition: all 0.3s ease;
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
            border-radius: 12px;
            padding: 30px;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--primary-blue);
        }

        h2 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Lista de Productos */
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
        }

        .product-det h4 { font-size: 15px; color: var(--text-main); }
        .product-det p { font-size: 13px; color: var(--text-muted); }

        .product-price {
            font-weight: 700;
            color: var(--text-main);
        }

        /* Formulario de Checkout */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--text-main);
        }

        input, select {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid var(--border-color);
            background-color: var(--input-bg);
            color: var(--text-main);
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        input:focus, select:focus {
            border-color: var(--primary-blue);
        }

        .row-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* Pasarela de Pago */
        .payment-methods {
            margin: 20px 0;
        }

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
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }

        .tab-btn.active {
            color: var(--primary-blue);
            border-bottom: 3px solid var(--primary-blue);
        }

        .payment-panel { display: none; }
        .payment-panel.active { display: block; }

        .totals-section {
            background: rgba(0, 82, 204, 0.04);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .total-row.final {
            font-size: 18px;
            font-weight: 800;
            color: var(--primary-blue);
            border-top: 1px dashed var(--border-color);
            padding-top: 8px;
            margin-top: 8px;
        }

        .btn-pay {
            width: 100%;
            padding: 14px;
            background-color: var(--success-green);
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(54, 179, 126, 0.2);
        }

        .btn-pay:hover { background-color: #2b9366; }

        /* Estilos del Comprobante (Oculto en pantalla para renderizado PDF) */
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

        .company-box h2 { color: #0052cc; font-size: 26px; }
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

    <div class="cart-wrapper">
        <div class="card-panel">
            <h2>🛒 Tu Carrito de Compras</h2>
            <div id="cart-items-container">
                <div class="cart-item">
                    <div class="product-info">
                        <img src="https://raw.githubusercontent.com/deybi-code/Proyecto_Compured_Per-/main/public/images/logo.png" alt="Producto">
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
            <h2>📋 Datos del Cliente y Pago</h2>
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
                        <button type="button" class="tab-btn active" onclick="cambiarMetodoPago('card')">💳 Tarjeta de Crédito/Débito</button>

                        @if(auth()->user() && (auth()->user()->role === 'admin' || auth()->user()->role === 'ventas'))
                            <button type="button" class="tab-btn" onclick="cambiarMetodoPago('cash')">💵 Pago en Efectivo (Caja)</button>
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
                        <p style="font-size: 13px; color: var(--success-green); font-weight: 600;">
                            ✓ Modo de venta física activo. El dinero se registrará directamente en el flujo de caja diario de la tienda sin validar transacciones bancarias electrónicas.
                        </p>
                    </div>
                </div>

                <div class="totals-section">
                    <div class="total-row"><span>Subtotal:</span><span id="subtotal-val">S/ 207.63</span></div>
                    <div class="total-row"><span>I.G.V (18%):</span><span id="igv-val">S/ 37.37</span></div>
                    <div class="total-row final"><span>Total a Pagar:</span><span id="total-val">S/ 245.00</span></div>
                </div>

                <button type="submit" class="btn-pay">Finalizar Compra y Emitir</button>
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
                <h3 style="color: #EA4335;" id="pdf-type-title">BOLETA DE VENTA ELECTRÓNICA</h3>
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

        // Inicializa el Modo Oscuro global según lo guardado en las vistas de Login/Home
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);

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

            // Captura de datos del formulario
            const docType = document.getElementById('document_type').value;
            const clientDoc = document.getElementById('client_doc').value;
            const clientName = document.getElementById('client_name').value;
            const clientAddress = document.getElementById('client_address').value;

            // Mapeo al Comprobante PDF
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

            // Generación y descarga directa del comprobante electrónico en PDF
            const element = document.getElementById('invoice-template');
            element.style.display = 'block'; // Mostrar temporalmente para html2pdf

            const opciones = {
                margin:       10,
                filename:     `${docType}_COMPURED_${clientDoc}.pdf`,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, logging: false },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            html2pdf().from(element).set(opciones).save().then(() => {
                element.style.display = 'none'; // Ocultar de nuevo tras la descarga
                alert('¡Transacción exitosa! El comprobante electrónico ha sido generado y descargado.');
                // Aquí puedes redireccionar o limpiar el carrito mediante AJAX
            });
        }
    </script>
</body>
</html>
