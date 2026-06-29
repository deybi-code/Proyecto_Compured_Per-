@extends('layouts.main')
@section('title', 'Sobre Nosotros – Compured Perú')
@section('content')

<style>
    /* Variables sincronizadas con Login, Index, Dashboard y Categoría */
    :root {
        --bg: #f0f4ff; --card: rgba(255,255,255,0.92); --text: #0f172a; --muted: #64748b;
        --border: #cbd5e1; --input-bg: #f8fafc; --primary: #1d4ed8; --primary-hover: #1e40af;
        --accent: #3b82f6; --shadow: 0 25px 60px rgba(0,0,0,0.18);
    }
    [data-theme="dark"] {
        --bg: #0a0f1e; --card: rgba(15,23,42,0.93); --text: #f1f5f9; --muted: #94a3b8;
        --border: #1e3a5f; --input-bg: #0f172a; --primary: #3b82f6; --primary-hover: #2563eb;
        --accent: #60a5fa; --shadow: 0 25px 60px rgba(0,0,0,0.6);
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .animate-card { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }

    .hero-scene {
        position: relative; overflow: hidden;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 40%, #1d4ed8 70%, #0f172a 100%);
        padding: 80px 20px; text-align: center; border-radius: 0 0 40px 40px;
        box-shadow: var(--shadow); margin-bottom: 40px;
    }
    [data-theme="dark"] .hero-scene { background: linear-gradient(135deg, #020617 0%, #0f172a 40%, #1e3a5f 70%, #020617 100%); }

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
        <div style="display:inline-block; padding:6px 18px; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:var(--accent); font-size:13px; font-weight:800; letter-spacing:3px; text-transform:uppercase; border-radius:30px; margin-bottom:24px; backdrop-filter:blur(5px);">
            Conócenos
        </div>
        <h1 style="font-family:'Segoe UI',sans-serif; font-size:clamp(2.5rem, 5vw, 4rem); font-weight:900; color:white; line-height:1.2; margin-bottom:16px; text-shadow:0 10px 30px rgba(0,0,0,0.3);">
            Sobre Nosotros
        </h1>
        <p style="color:rgba(255,255,255,0.8); font-size:18px; max-width:600px; margin:0 auto; font-weight:500;">
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
