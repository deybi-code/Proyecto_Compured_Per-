<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seguimiento de Pedidos - Compured Perú</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="{{ asset('js/theme.js') }}"></script>
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; transition: background-color 0.3s ease, color 0.3s ease; }
        .track-container { max-width: 900px; margin: 40px auto; background: white; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 30px; transition: background-color 0.3s ease, box-shadow 0.3s ease; }
        .track-header { border-bottom: 2px solid #27a1eb; padding-bottom: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end; }
        .track-header h1 { margin: 0; color: #0b33a2; font-size: 24px; }
        .order-details { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px; background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #eee; transition: background-color 0.3s ease, border-color 0.3s ease; }
        .timeline { display: flex; justify-content: space-between; position: relative; margin-bottom: 40px; }
        .timeline::before { content: ''; position: absolute; top: 20px; left: 40px; right: 40px; height: 4px; background: #e0e0e0; z-index: 1; }
        .timeline-progress { position: absolute; top: 20px; left: 40px; height: 4px; background: #a4e613; z-index: 2; width: 66%; transition: width 1s; }
        .step { position: relative; z-index: 3; text-align: center; width: 80px; }
        .step-icon { width: 44px; height: 44px; background: #e0e0e0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; color: white; font-size: 18px; border: 4px solid white; transition: background 0.3s, border-color 0.3s; }
        .step.completed .step-icon { background: #a4e613; color: #0b33a2; }
        .step.active .step-icon { background: #27a1eb; box-shadow: 0 0 0 4px rgba(39, 161, 235, 0.2); }
        .items-list { border: 1px solid #eee; border-radius: 8px; overflow: hidden; margin-top:15px; transition: border-color 0.3s ease; }
        .item-row { display: flex; justify-content: space-between; padding: 15px 20px; border-bottom: 1px solid #eee; align-items: center; transition: border-color 0.3s ease; }
        .btn-back { display: inline-block; margin-top: 30px; color: #27a1eb; text-decoration: none; font-weight: bold; font-size: 14px; }

        .theme-toggle-btn {
            position: fixed; top: 20px; right: 20px; width: 48px; height: 48px;
            border-radius: 50%; border: 2px solid #cce5ff; background: #ffffff;
            color: #0b33a2; font-size: 20px; cursor: pointer; display: flex;
            align-items: center; justify-content: center; z-index: 1000;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15); transition: all 0.3s ease;
        }
        .theme-toggle-btn:hover { transform: scale(1.08); }

        /* MODO OSCURO */
        body.dark-mode { background-color: #121212; color: #e0e0e0; }
        body.dark-mode .track-container { background: #1e1e1e; box-shadow: 0 4px 20px rgba(0,0,0,0.4); }
        body.dark-mode .track-header { border-bottom-color: #1e3a70; }
        body.dark-mode .order-details { background: #1a1a1a; border-color: #2d2d2d; }
        body.dark-mode .timeline::before { background: #2d2d2d; }
        body.dark-mode .step-icon { background: #2d2d2d; border-color: #1e1e1e; }
        body.dark-mode .items-list { border-color: #2d2d2d; }
        body.dark-mode .item-row { border-bottom-color: #2d2d2d; }
        body.dark-mode .theme-toggle-btn { background: #1e1e1e; border-color: #333; color: #f1f1f1; }
    </style>
</head>
<body>
    <button type="button" class="theme-toggle-btn" onclick="toggleDarkMode()" title="Cambiar modo claro/oscuro" aria-label="Cambiar modo claro/oscuro">
        <span id="themeIcon">🌙</span>
    </button>

    <div class="track-container">
        <div class="track-header">
            <div>
                <h1>Seguimiento de Pedido</h1>
                <p>N° Orden: <strong>#ORD-9938472</strong></p>
            </div>
            <div style="text-align: right;">
                <p>Comprobante Generado:</p>
                <a href="#" style="color: #27a1eb; font-weight: bold; text-decoration: none;"><i class="fas fa-file-pdf"></i> Descargar Boleta</a>
            </div>
        </div>

        <div class="order-details">
            <div><h4>Dirección</h4><p>Av. España 1542, Trujillo</p></div>
            <div><h4>Tiempo Estimado</h4><p>Hoy, 4:30 PM - 5:30 PM</p></div>
            <div><h4>Repartidor</h4><p>Juan Pérez</p><a href="https://wa.me/960900386" style="color: #25D366; font-weight: bold; text-decoration: none;"><i class="fab fa-whatsapp"></i> Contactar</a></div>
        </div>

        <div class="timeline">
            <div class="timeline-progress"></div>
            <div class="step completed"><div class="step-icon"><i class="fas fa-clipboard-check"></i></div><p>Confirmado</p></div>
            <div class="step completed"><div class="step-icon"><i class="fas fa-box-open"></i></div><p>Empaquetado</p></div>
            <div class="step active"><div class="step-icon"><i class="fas fa-motorcycle"></i></div><p>En Camino</p></div>
            <div class="step"><div class="step-icon"><i class="fas fa-home"></i></div><p>Entregado</p></div>
        </div>

        <div class="items-list">
            <div class="item-row">
                <div><i class="fas fa-box" style="color:#27a1eb; margin-right:10px;"></i> <strong>Memoria RAM Kingston FURY Beast 16GB DDR4</strong> (x1)</div>
                <strong style="color: #0b33a2;">S/ 245.00</strong>
            </div>
        </div>

        <a href="{{ url('/') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Volver a la tienda</a>
    </div>
</body>
</html>
