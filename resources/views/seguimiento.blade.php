<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seguimiento de Pedidos - Compured Perú</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; }
        .track-container { max-width: 900px; margin: 40px auto; background: white; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 30px; }
        .track-header { border-bottom: 2px solid #27a1eb; padding-bottom: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end; }
        .track-header h1 { margin: 0; color: #0b33a2; font-size: 24px; }
        .order-details { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px; background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #eee; }
        .timeline { display: flex; justify-content: space-between; position: relative; margin-bottom: 40px; }
        .timeline::before { content: ''; position: absolute; top: 20px; left: 40px; right: 40px; height: 4px; background: #e0e0e0; z-index: 1; }
        .timeline-progress { position: absolute; top: 20px; left: 40px; height: 4px; background: #a4e613; z-index: 2; width: 66%; transition: width 1s; }
        .step { position: relative; z-index: 3; text-align: center; width: 80px; }
        .step-icon { width: 44px; height: 44px; background: #e0e0e0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; color: white; font-size: 18px; border: 4px solid white; transition: background 0.3s; }
        .step.completed .step-icon { background: #a4e613; color: #0b33a2; }
        .step.active .step-icon { background: #27a1eb; box-shadow: 0 0 0 4px rgba(39, 161, 235, 0.2); }
        .items-list { border: 1px solid #eee; border-radius: 8px; overflow: hidden; margin-top:15px; }
        .item-row { display: flex; justify-content: space-between; padding: 15px 20px; border-bottom: 1px solid #eee; align-items: center; }
        .btn-back { display: inline-block; margin-top: 30px; color: #27a1eb; text-decoration: none; font-weight: bold; font-size: 14px; }
    </style>
</head>
<body>
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
