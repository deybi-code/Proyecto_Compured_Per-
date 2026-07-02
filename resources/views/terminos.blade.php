@extends('layouts.main')
@section('title', 'Términos y Condiciones – Compured Perú')
@section('content')

<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .animate-card { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }

    /* Hero header */
    .hero-scene {
        position: relative; overflow: hidden;
        background: var(--pub-hero-gradient);
        padding: 60px 20px; text-align: center; border-radius: 0 0 40px 40px;
        box-shadow: var(--shadow); margin-bottom: 40px;
    }

    .hero-grid {
        position: absolute; inset: 0; z-index: 1; pointer-events: none;
        background-image: linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
        background-size: 40px 40px;
    }

    /* Contenedor legal */
    .glass-card {
        background: var(--card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(59,130,246,0.2); border-top: 4px solid var(--primary);
        border-radius: 20px; box-shadow: var(--shadow); transition: all 0.3s;
        padding: 40px; color: var(--text); margin-bottom: 40px;
    }

    .legal-content h2 {
        font-family: 'Segoe UI', system-ui, sans-serif; font-size: 20px; font-weight: 800;
        color: var(--text); margin-top: 32px; margin-bottom: 16px;
        display: flex; align-items: center; gap: 10px;
    }
    .legal-content h2::before {
        content: '❖'; color: var(--accent); font-size: 18px;
    }
    .legal-content h2:first-child { margin-top: 0; }

    .legal-content p, .legal-content li {
        color: var(--muted); line-height: 1.8; font-size: 15px; font-weight: 500; margin-bottom: 16px;
    }
    .legal-content ul { padding-left: 20px; margin-bottom: 16px; }
    .legal-content li { margin-bottom: 8px; list-style-type: disc; color: var(--accent); }
    .legal-content li span { color: var(--muted); }

    .last-updated {
        display: inline-block; padding: 6px 16px; background: rgba(59,130,246,0.1);
        border: 1px solid rgba(59,130,246,0.2); color: var(--primary);
        border-radius: 20px; font-size: 12px; font-weight: 700; margin-bottom: 24px;
    }
</style>

<div class="hero-scene">
    <div class="hero-grid"></div>
    <div style="position:relative; z-index:2;">
        <div style="font-size:40px; margin-bottom:16px; animation:floatIcon 3s ease-in-out infinite;">⚖️</div>
        <h1 class="hero-title" style="font-family:'Rajdhani',sans-serif; font-size:clamp(2rem, 4vw, 3rem); font-weight:900; line-height:1.2; margin-bottom:12px;">
            Términos y Condiciones
        </h1>
        <p style="color:rgba(255,255,255,0.7); font-size:16px; font-weight:500;">
            Políticas de uso y privacidad de Compured Perú
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 pb-20">
    <div class="glass-card animate-card legal-content">

        <div class="last-updated">Última actualización: {{ date('d \d\e F \d\e Y') }}</div>

        {{-- INSERTA AQUÍ TU TEXTO ORIGINAL. HE DEJADO UN ESQUELETO DE EJEMPLO BASADO EN EL DISEÑO --}}

        <h2>1. Información General</h2>
        <p>Al acceder y utilizar el sitio web de Compured Perú, aceptas cumplir con los siguientes términos y condiciones. Te recomendamos leer cuidadosamente esta sección antes de realizar cualquier transacción en nuestra plataforma.</p>

        <h2>2. Productos y Garantías</h2>
        <p>Todos los equipos, componentes y accesorios comercializados cuentan con la garantía oficial de la marca fabricante. Para hacer efectiva cualquier garantía, es indispensable:</p>
        <ul>
            <li><span>Presentar el comprobante de pago original (Boleta o Factura).</span></li>
            <li><span>Entregar el producto con sus empaques, manuales y accesorios originales en buen estado.</span></li>
            <li><span>No haber incurrido en daños por manipulación indebida, overclocking o instalación eléctrica defectuosa.</span></li>
        </ul>

        <h2>3. Precios y Pagos</h2>
        <p>Los precios publicados en la plataforma están expresados en Soles (S/) e incluyen IGV. Nos reservamos el derecho de modificar los precios sin previo aviso. Las pasarelas de pago están cifradas y aseguradas para proteger la información financiera del usuario.</p>

        <h2>4. Políticas de Envío</h2>
        <p>Realizamos envíos a nivel nacional. Los tiempos de entrega varían según el destino y la disponibilidad del stock. Una vez confirmado el pago y despachado el pedido, se proporcionará un número de seguimiento (tracking).</p>

        <h2>5. Cambios y Devoluciones</h2>
        <p>Solo se aceptarán cambios o devoluciones dentro de los 7 días calendario posteriores a la compra, siempre y cuando el producto presente fallas de fábrica y no haya sido utilizado o registrado a nombre del cliente final.</p>

    </div>
</div>
@endsection
