<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Compured Peru</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script src="{{ asset('js/theme.js') }}"></script>

    <style>
        :root {
            --bg-body: linear-gradient(135deg, #0b33a2 0%, #27a1eb 100%);
            --bg-card: #ffffff;
            --text-main: #0b33a2;
            --text-muted: #5c728e;
            --border-color: #cce5ff;
            --primary-blue: #0b33a2;
            --light-blue: #27a1eb;
            --btn-green: #a4e613;
            --btn-text: #081a45;
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

        .theme-toggle-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(5px);
            color: #fff;
            font-size: 22px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            transition: background 0.3s ease, transform 0.2s ease, border-color 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.25);
        }
        .theme-toggle-btn:hover { background: rgba(255,255,255,0.3); transform: scale(1.08); }
        [data-theme="dark"] .theme-toggle-btn { border-color: rgba(164,230,19,0.5); }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', system-ui, sans-serif; }

        body { background: var(--bg-body); background-attachment: fixed; color: var(--text-main); padding: 40px 20px; min-height: 100vh; transition: background 0.3s ease, color 0.3s ease; }

        .header-logo { text-align: center; margin-bottom: 30px; background: rgba(255, 255, 255, 0.1); padding: 15px; border-radius: 12px; backdrop-filter: blur(5px); display: inline-block; margin-left: auto; margin-right: auto; border: 1px solid rgba(255,255,255,0.2); }
        .header-wrapper { display: flex; justify-content: center; }
        .header-logo img { height: 60px; width: auto; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3)); }

        .cart-wrapper { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 7fr 5fr; gap: 30px; }
        @media (max-width: 968px) { .cart-wrapper { grid-template-columns: 1fr; } }

        .card-panel { background-color: var(--bg-card); border-radius: 16px; padding: 30px; box-shadow: var(--shadow); border-top: 5px solid var(--btn-green); transition: background-color 0.3s ease, border-color 0.3s ease; }

        h2 { font-size: 20px; font-weight: 800; margin-bottom: 20px; color: var(--primary-blue); display: flex; align-items: center; gap: 10px; border-bottom: 2px solid var(--border-color); padding-bottom: 10px; }

        .cart-item { display: flex; align-items: center; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid var(--border-color); transition: opacity 0.3s ease; }
        .product-info { display: flex; align-items: center; gap: 15px; }
        .product-info img { width: 60px; height: 60px; object-fit: contain; background: #fff; border-radius: 8px; padding: 5px; border: 1px solid var(--border-color); }
        .product-det h4 { font-size: 15px; color: var(--text-main); font-weight: bold; }

        .qty-controls { display: flex; align-items: center; gap: 12px; margin-top: 8px; }
        .qty-btn { background: var(--border-color); border: none; color: var(--primary-blue); width: 28px; height: 28px; border-radius: 6px; font-weight: bold; font-size: 16px; cursor: pointer; transition: all 0.2s; }
        .qty-btn:hover { background: var(--light-blue); color: white; }
        .qty-display { font-weight: 700; font-size: 14px; width: 20px; text-align: center; }

        .product-actions { text-align: right; }
        .product-price { font-weight: 800; color: var(--light-blue); font-size: 1.2rem; }
        .btn-remove { background: none; border: none; color: #ef4444; font-size: 12px; font-weight: bold; cursor: pointer; margin-top: 8px; padding: 4px; border-radius: 4px; transition: background 0.2s; }
        .btn-remove:hover { background: rgba(239, 68, 68, 0.1); }

        .form-group { margin-bottom: 15px; }
        label { display: block; font-size: 13px; font-weight: 700; margin-bottom: 6px; color: var(--primary-blue); }
        input, select { width: 100%; padding: 10px 12px; border: 2px solid var(--border-color); background-color: var(--bg-card); color: var(--text-main); border-radius: 6px; font-size: 14px; outline: none; transition: border-color 0.3s ease, box-shadow 0.3s ease; }
        input:focus, select:focus { border-color: var(--light-blue); box-shadow: 0 0 0 3px rgba(39, 161, 235, 0.2); }
        .row-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }

        .payment-methods { margin: 20px 0; }
        .nav-tabs { display: flex; gap: 10px; margin-bottom: 15px; border-bottom: 2px solid var(--border-color); padding-bottom: 8px; }
        .tab-btn { padding: 8px 16px; border: none; background: none; color: var(--text-muted); font-weight: bold; cursor: pointer; font-size: 14px; transition: color 0.3s ease; }
        .tab-btn.active { color: var(--light-blue); border-bottom: 3px solid var(--light-blue); }
        .payment-panel { display: none; }
        .payment-panel.active { display: block; }

        .totals-section { background: rgba(39, 161, 235, 0.08); padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid var(--border-color); }
        .total-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; font-weight: 600; color: var(--text-main); }
        .total-row.final { font-size: 18px; font-weight: 900; color: var(--primary-blue); border-top: 2px dashed var(--light-blue); padding-top: 8px; margin-top: 8px; }

        .btn-pay { width: 100%; padding: 14px; background-color: var(--btn-green); color: var(--btn-text); border: none; border-radius: 8px; font-size: 16px; font-weight: 900; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(164, 230, 19, 0.4); transition: transform 0.2s ease, background-color 0.3s ease; }
        .btn-pay:hover { background-color: #93ce11; transform: translateY(-2px); }

        /* Ajuste estricto para evitar cortes en el PDF */
        #invoice-template { display: none; background: white; color: #000; padding: 20px; font-family: Arial, sans-serif; width: 700px; box-sizing: border-box; }
    </style>
</head>
<body>

    <button type="button" id="themeToggleBtn" class="theme-toggle-btn" onclick="toggleDarkMode()" title="Cambiar modo claro/oscuro" aria-label="Cambiar modo claro/oscuro">
        <span id="themeIcon">🌙</span>
    </button>

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
                <div class="cart-item" id="item-ram">
                    <div class="product-info">
                        <img src="{{ asset('img/logo.png') }}" alt="Producto">
                        <div class="product-det">
                            <h4>Memoria RAM Kingston FURY Beast 16GB DDR4</h4>
                            <div class="qty-controls">
                                <button type="button" class="qty-btn" onclick="updateQty(-1)">-</button>
                                <span class="qty-display" id="display-qty">1</span>
                                <button type="button" class="qty-btn" onclick="updateQty(1)">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="product-actions">
                        <div class="product-price" id="display-price">S/ 245.00</div>
                        <button type="button" class="btn-remove" onclick="removeItem()">🗑️ Eliminar</button>
                    </div>
                </div>

                <div id="empty-cart-msg" style="display: none; text-align: center; padding: 30px 0; color: var(--text-muted); font-weight: bold;">
                    Tu carrito está vacío.
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

                        @if(auth()->check() && in_array(strtolower(auth()->user()->rol ?? auth()->user()->role ?? auth()->user()->tipo_usuario ?? ''), ['admin', 'ventas', 'administrador', '1', '2']))
                            <button type="button" class="tab-btn" onclick="cambiarMetodoPago('cash')">Pago en Efectivo (Caja)</button>
                        @endif
                    </div>

                    <div id="panel-card" class="payment-panel active">
                        <div class="form-group">
                            <label for="card_number">Número de Tarjeta</label>
                            <input type="text" id="card_number" placeholder="0000 0000 0000 0000" maxlength="19" required>
                        </div>
                        <div class="row-grid">
                            <div class="form-group">
                                <label for="card_expiry">Vencimiento</label>
                                <input type="text" id="card_expiry" placeholder="MM/AA" maxlength="5" required>
                            </div>
                            <div class="form-group">
                                <label for="card_cvv">CVV</label>
                                <input type="password" id="card_cvv" placeholder="000" maxlength="3" required>
                            </div>
                        </div>
                    </div>

                    <div id="panel-cash" class="payment-panel">
                        <p style="font-size: 14px; color: var(--primary-blue); font-weight: bold; border: 2px dashed var(--light-blue); background: var(--border-color); padding: 15px; border-radius: 8px;">
                            ✓ Modo de venta física activo. El dinero se registrará directamente en el flujo de caja.
                        </p>
                    </div>
                </div>

                <div class="totals-section">
                    <div class="total-row"><span>Subtotal:</span><span id="subtotal-val">S/ 207.63</span></div>
                    <div class="total-row"><span>I.G.V (18%):</span><span id="igv-val">S/ 37.37</span></div>
                    <div class="total-row final"><span>Total a Pagar:</span><span id="total-val">S/ 245.00</span></div>
                </div>

                <button type="submit" class="btn-pay" id="btn-submit">FINALIZAR COMPRA Y EMITIR</button>
            </form>
        </div>
    </div>

    <div id="invoice-template">
        <table width="100%" style="border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 15px;">
            <tr>
                <td width="55%" style="vertical-align: top;">
                    <img src="{{ asset('img/logo.png') }}" style="max-height: 50px; margin-bottom: 10px;">
                    <h2 style="margin: 0; font-size: 15px; color: #0b33a2; font-weight: 900;">COMPURED PERU S.A.C.</h2>
                    <p style="margin: 2px 0; font-size: 10px; color: #333;">Tecnología Informática a tu Alcance</p>
                    <p style="margin: 2px 0; font-size: 10px; color: #333;">Av. España 1542, Trujillo, La Libertad</p>
                    <p style="margin: 2px 0; font-size: 10px; color: #333;">Tel: (044) 123456 | ventas@compured.com</p>
                </td>
                <td width="45%" style="vertical-align: top;">
                    <div style="border: 2px solid #000; border-radius: 8px; text-align: center; padding: 10px;">
                        <h3 style="margin: 0 0 8px 0; font-size: 15px; font-weight: 900;">RUC: 20601234567</h3>
                        <div style="background-color: #f0f0f0; padding: 6px; border-top: 1px solid #000; border-bottom: 1px solid #000;">
                            <h3 style="margin: 0; font-size: 13px; font-weight: bold;" id="pdf-type-title">BOLETA DE VENTA ELECTRÓNICA</h3>
                        </div>
                        <h3 style="margin: 8px 0 0 0; font-size: 16px; color: #c00;" id="pdf-invoice-number">B001-00000000</h3>
                    </div>
                </td>
            </tr>
        </table>

        <table width="100%" style="font-size: 11px; margin-bottom: 15px; border-collapse: collapse;">
            <tr>
                <td width="15%" style="padding: 3px 0;"><strong>Señor(es):</strong></td>
                <td width="50%" style="padding: 3px 0;" id="pdf-client-name">---</td>
                <td width="15%" style="padding: 3px 0;"><strong>Fecha Emisión:</strong></td>
                <td width="20%" style="padding: 3px 0;" id="pdf-date">---</td>
            </tr>
            <tr>
                <td style="padding: 3px 0;"><strong id="pdf-doc-type-label">DNI:</strong></td>
                <td style="padding: 3px 0;" id="pdf-client-doc">---</td>
                <td style="padding: 3px 0;"><strong>Hora Emisión:</strong></td>
                <td style="padding: 3px 0;" id="pdf-time">---</td>
            </tr>
            <tr id="pdf-address-row" style="display:none;">
                <td style="padding: 3px 0;"><strong>Dirección:</strong></td>
                <td colspan="3" style="padding: 3px 0;" id="pdf-client-address">---</td>
            </tr>
            <tr>
                <td style="padding: 3px 0;"><strong>Moneda:</strong></td>
                <td style="padding: 3px 0;">SOLES (PEN)</td>
                <td style="padding: 3px 0;"><strong>Condición Pago:</strong></td>
                <td style="padding: 3px 0;" id="pdf-payment-method">---</td>
            </tr>
        </table>

        <table width="100%" style="font-size: 11px; border-collapse: collapse; margin-bottom: 15px;">
            <thead>
                <tr style="background-color: #f4f4f4; border-top: 1px solid #000; border-bottom: 1px solid #000;">
                    <th style="padding: 6px; text-align: center; width: 8%;">CANT.</th>
                    <th style="padding: 6px; text-align: center; width: 8%;">UM</th>
                    <th style="padding: 6px; text-align: left; width: 54%;">DESCRIPCIÓN</th>
                    <th style="padding: 6px; text-align: right; width: 15%;">V. UNIT.</th>
                    <th style="padding: 6px; text-align: right; width: 15%;">IMPORTE</th>
                </tr>
            </thead>
            <tbody id="pdf-items-body">
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 8px 6px; text-align: center;" id="pdf-item-qty">1.00</td>
                    <td style="padding: 8px 6px; text-align: center;">NIU</td>
                    <td style="padding: 8px 6px; text-align: left;">Memoria RAM Kingston FURY Beast 16GB DDR4</td>
                    <td style="padding: 8px 6px; text-align: right;">245.00</td>
                    <td style="padding: 8px 6px; text-align: right;" id="pdf-item-total">245.00</td>
                </tr>
            </tbody>
        </table>

        <table width="100%" style="font-size: 11px; margin-top: 10px;">
            <tr>
                <td width="60%" style="vertical-align: top; padding-right: 15px;">
                    <table width="100%">
                        <tr>
                            <td width="90px">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=20601234567|01|F001|000001|37.37|245.00|01/01/2026|1|12345678" style="width: 80px; height: 80px; border: 1px solid #ddd; padding: 2px;">
                            </td>
                            <td style="vertical-align: top; padding-left: 10px; font-size: 9px; color: #555;">
                                <p style="margin: 0 0 4px 0;"><strong>Resumen Hash:</strong> wZ2+1B8Y2GqVn/R5m8T9aB=</p>
                                <p style="margin: 10px 0 0 0;">Representación impresa de la <strong id="pdf-footer-type">BOLETA DE VENTA</strong> ELECTRÓNICA.<br>Puede verificar la validez de este documento en <strong>www.sunat.gob.pe</strong></p>
                            </td>
                        </tr>
                    </table>
                </td>

                <td width="40%" style="vertical-align: top;">
                    <table width="100%" style="border-collapse: collapse;">
                        <tr><td style="padding: 3px; text-align: left;">Op. Gravadas:</td><td style="padding: 3px; text-align: right;" id="pdf-subtotal-val">S/ 207.63</td></tr>
                        <tr><td style="padding: 3px; text-align: left;">Op. Inafectas:</td><td style="padding: 3px; text-align: right;">S/ 0.00</td></tr>
                        <tr><td style="padding: 3px; text-align: left;">Op. Exoneradas:</td><td style="padding: 3px; text-align: right;">S/ 0.00</td></tr>
                        <tr><td style="padding: 3px; text-align: left;">I.G.V. (18%):</td><td style="padding: 3px; text-align: right;" id="pdf-igv-val">S/ 37.37</td></tr>
                        <tr style="font-weight: bold; font-size: 13px; border-top: 1px solid #000;">
                            <td style="padding: 6px 3px; text-align: left;">IMPORTE TOTAL:</td>
                            <td style="padding: 6px 3px; text-align: right;" id="pdf-total-val">S/ 245.00</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <script>
        let metodoSeleccionado = 'card';
        const unitPrice = 245.00;
        let currentQty = 1;

        function updateQty(change) {
            let newQty = currentQty + change;
            if (newQty < 1) return;
            currentQty = newQty;
            document.getElementById('display-qty').textContent = currentQty;
            calculateTotals();
        }

        function removeItem() {
            if (confirm("¿Estás seguro de quitar este producto de tu carrito?")) {
                document.getElementById('item-ram').style.display = 'none';
                document.getElementById('empty-cart-msg').style.display = 'block';
                currentQty = 0;
                calculateTotals();
                document.getElementById('btn-submit').disabled = true;
                document.getElementById('btn-submit').style.opacity = '0.5';
                document.getElementById('btn-submit').style.cursor = 'not-allowed';
            }
        }

        function calculateTotals() {
            let total = currentQty * unitPrice;
            let subtotal = total / 1.18;
            let igv = total - subtotal;

            if(currentQty > 0) document.getElementById('display-price').textContent = `S/ ${total.toFixed(2)}`;
            document.getElementById('subtotal-val').textContent = `S/ ${subtotal.toFixed(2)}`;
            document.getElementById('igv-val').textContent = `S/ ${igv.toFixed(2)}`;
            document.getElementById('total-val').textContent = `S/ ${total.toFixed(2)}`;

            if(currentQty > 0) {
                document.getElementById('pdf-item-qty').textContent = currentQty.toFixed(2);
                document.getElementById('pdf-item-total').textContent = total.toFixed(2);
            } else {
                document.getElementById('pdf-items-body').innerHTML = '<tr><td colspan="5" style="text-align:center; padding:10px;">Sin productos</td></tr>';
            }
            document.getElementById('pdf-subtotal-val').textContent = `S/ ${subtotal.toFixed(2)}`;
            document.getElementById('pdf-igv-val').textContent = `S/ ${igv.toFixed(2)}`;
            document.getElementById('pdf-total-val').textContent = `S/ ${total.toFixed(2)}`;
        }

        function alternarCamposDocumento() {
            const docType = document.getElementById('document_type').value;
            const clientDocInput = document.getElementById('client_doc');
            const rucFields = document.getElementById('ruc-additional-fields');

            if (docType === 'RUC') {
                document.getElementById('doc-label').textContent = "RUC de la Empresa";
                clientDocInput.placeholder = "Ingresa el RUC de 11 dígitos";
                clientDocInput.maxLength = 11;
                rucFields.style.display = 'block';
            } else {
                document.getElementById('doc-label').textContent = "DNI del Cliente";
                clientDocInput.placeholder = "Ingresa el DNI de 8 dígitos";
                clientDocInput.maxLength = 8;
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
                document.getElementById('card_expiry').setAttribute('required', 'required');
                document.getElementById('card_cvv').setAttribute('required', 'required');
            } else {
                document.getElementById('panel-cash').classList.add('active');
                event.target.classList.add('active');
                document.getElementById('card_number').removeAttribute('required');
                document.getElementById('card_expiry').removeAttribute('required');
                document.getElementById('card_cvv').removeAttribute('required');
            }
        }

        function procesarPago(e) {
            e.preventDefault();
            if(currentQty === 0) {
                alert("Tu carrito está vacío.");
                return;
            }

            const docType = document.getElementById('document_type').value;
            const clientDoc = document.getElementById('client_doc').value;
            const clientName = document.getElementById('client_name').value;
            const clientAddress = document.getElementById('client_address').value;

            const now = new Date();
            document.getElementById('pdf-client-name').textContent = clientName.toUpperCase();
            document.getElementById('pdf-client-doc').textContent = clientDoc;
            document.getElementById('pdf-date').textContent = now.toLocaleDateString('es-PE');
            document.getElementById('pdf-time').textContent = now.toLocaleTimeString('es-PE');
            document.getElementById('pdf-payment-method').textContent = metodoSeleccionado === 'card' ? 'TARJETA BANCARIA' : 'EFECTIVO (CONTADO)';

            if (docType === 'RUC') {
                document.getElementById('pdf-type-title').textContent = "FACTURA ELECTRÓNICA";
                document.getElementById('pdf-footer-type').textContent = "FACTURA";
                document.getElementById('pdf-invoice-number').textContent = "F001-" + String(Math.floor(Math.random() * 999999)).padStart(8, '0');
                document.getElementById('pdf-doc-type-label').textContent = "RUC:";
                document.getElementById('pdf-address-row').style.display = 'table-row';
                document.getElementById('pdf-client-address').textContent = clientAddress.toUpperCase() || '---';
            } else {
                document.getElementById('pdf-type-title').textContent = "BOLETA DE VENTA ELECTRÓNICA";
                document.getElementById('pdf-footer-type').textContent = "BOLETA DE VENTA";
                document.getElementById('pdf-invoice-number').textContent = "B001-" + String(Math.floor(Math.random() * 999999)).padStart(8, '0');
                document.getElementById('pdf-doc-type-label').textContent = "DNI:";
                document.getElementById('pdf-address-row').style.display = 'none';
            }

            const element = document.getElementById('invoice-template');
            element.style.display = 'block';

            const opciones = {
                margin:       [10, 10, 10, 10], // Márgenes más cerrados para que entre todo el ancho
                filename:     `${docType}_COMPURED_${clientDoc}.pdf`,
                image:        { type: 'jpeg', quality: 1.0 },
                html2canvas:  { scale: 2, windowWidth: 700, logging: false }, // Forza la medida del contenedor a 700px para que no recorte las palabras
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
