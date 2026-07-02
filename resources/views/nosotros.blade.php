@extends('layouts.main')
@section('title', 'Sobre Nosotros – Compured Perú')
@section('content')

<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .animate-card { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }

    .hero-scene {
        position: relative; overflow: hidden;
        background: var(--pub-hero-gradient);
        padding: 80px 20px; text-align: center; border-radius: 0 0 40px 40px;
        box-shadow: var(--shadow); margin-bottom: 40px;
    }

    .hero-grid {
        position: absolute; inset: 0; z-index: 1; pointer-events: none;
        background-image: linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
        background-size: 40px 40px;
    }

    .glass-card {
        background: var(--card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(59,130,246,0.2); border-radius: 20px;
        box-shadow: var(--shadow); transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
        padding: 36px; color: var(--text);
    }
    .glass-card:hover { transform: translateY(-5px); box-shadow: 0 30px 60px rgba(29,78,216,0.25); }

    .section-title {
        font-family: 'Segoe UI', system-ui, sans-serif; font-size: 26px; font-weight: 800;
        color: var(--text); margin-bottom: 16px; display: flex; align-items: center; gap: 12px;
    }

    .feature-card {
        text-align: center; border-top: 4px solid var(--primary); padding: 32px 24px;
    }
    .feature-icon {
        font-size: 46px; margin-bottom: 20px;
        animation: floatIcon 4s ease-in-out infinite; display: inline-block;
    }
    @keyframes floatIcon { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-8px);} }
</style>

<div class="hero-scene">
    <div class="hero-grid"></div>
    <div style="position:relative; z-index:2;">
        <div class="hero-badge" style="display:inline-block; padding:6px 18px; font-size:13px; font-weight:800; letter-spacing:3px; text-transform:uppercase; border-radius:30px; margin-bottom:24px; backdrop-filter:blur(5px);">
            Conócenos
        </div>
        <h1 class="hero-title" style="font-family:'Rajdhani',sans-serif; font-size:clamp(2.5rem, 5vw, 4rem); font-weight:900; line-height:1.2; margin-bottom:16px;">
            Sobre Nosotros
        </h1>
        <p class="hero-subline" style="font-size:18px; max-width:600px; margin:0 auto; font-weight:500;">
            Tecnología Informática a tu Alcance desde Lima, Perú
        </p>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 pb-20">
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:32px; margin-bottom:56px;">
        <div class="glass-card animate-card" style="animation-delay: 0.1s;">
            <h2 class="section-title"><span style="color:var(--primary);">🎯</span> ¿Quiénes somos?</h2>
            <p style="color:var(--muted); line-height:1.8; font-size:16px; font-weight:500;">
                Compured Perú es una empresa dedicada a la venta de equipos informáticos, accesorios tecnológicos y soluciones computacionales. Brindamos productos de calidad con garantía oficial y asesoría personalizada para hogares y empresas en todo el Perú.
            </p>
        </div>
        <div class="glass-card animate-card" style="animation-delay: 0.2s;">
            <h2 class="section-title"><span style="color:var(--primary);">🚀</span> Nuestra misión</h2>
            <p style="color:var(--muted); line-height:1.8; font-size:16px; font-weight:500;">
                Democratizar el acceso a la tecnología informática, ofreciendo los mejores precios, garantía real y soporte técnico profesional. Creemos que la tecnología debe estar al alcance de todos.
            </p>
        </div>
    </div>

    <div style="text-align:center; margin-bottom:40px; position:relative; z-index:2;" class="animate-card" style="animation-delay: 0.3s;">
        <h2 style="font-size:28px; font-weight:800; color:var(--text); margin-bottom:12px;">Nuestros Pilares</h2>
        <div style="height:4px; width:80px; background:var(--primary); margin:0 auto; border-radius:2px;"></div>
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:28px;">
        @foreach(['🚀 Innovación' => 'Siempre a la vanguardia tecnológica', '🛡️ Garantía' => 'Productos originales con garantía oficial', '💬 Soporte' => 'Asesoría técnica personalizada', '🤝 Confianza' => 'Miles de clientes satisfechos en Lima'] as $titulo => $desc)
        <div class="glass-card feature-card animate-card" style="animation-delay: {{ 0.4 + ($loop->index * 0.1) }}s;">
            <div class="feature-icon">{{ explode(' ',$titulo)[0] }}</div>
            <div style="font-weight:800; font-size:17px; color:var(--text); margin-bottom:12px; text-transform:uppercase; letter-spacing:0.5px;">
                {{ substr($titulo,3) }}
            </div>
            <div style="font-size:14px; color:var(--muted); font-weight:500; line-height:1.6;">
                {{ $desc }}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
