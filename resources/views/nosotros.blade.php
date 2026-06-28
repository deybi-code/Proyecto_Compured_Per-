@extends('layouts.main')
@section('title', 'Sobre Nosotros – Compured Perú')
@section('content')
<div style="background:linear-gradient(135deg,#091E42 0%,#0052CC 100%);padding:60px 20px;text-align:center;margin-bottom:0">
    <h1 style="font-family:'Rajdhani',sans-serif;font-size:2.5rem;font-weight:800;color:white;margin-bottom:8px">Sobre Nosotros</h1>
    <p style="color:rgba(255,255,255,0.7);font-size:1rem">Tecnología Informática a tu Alcance desde Lima, Perú</p>
</div>
<div class="max-w-4xl mx-auto px-4 py-12">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:32px;margin-bottom:40px" class="grid-cols-1 md:grid-cols-2">
        <div>
            <h2 class="section-title">¿Quiénes somos?</h2>
            <p style="color:#5E6C84;line-height:1.8;font-size:0.92rem" class="dark:text-gray-400">Compured Perú es una empresa dedicada a la venta de equipos informáticos, accesorios tecnológicos y soluciones computacionales. Brindamos productos de calidad con garantía oficial y asesoría personalizada para hogares y empresas en todo el Perú.</p>
        </div>
        <div>
            <h2 class="section-title">Nuestra misión</h2>
            <p style="color:#5E6C84;line-height:1.8;font-size:0.92rem" class="dark:text-gray-400">Democratizar el acceso a la tecnología informática, ofreciendo los mejores precios, garantía real y soporte técnico profesional. Creemos que la tecnología debe estar al alcance de todos.</p>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:20px">
        @foreach(['🚀 Innovación' => 'Siempre a la vanguardia tecnológica', '🛡️ Garantía' => 'Productos originales con garantía oficial', '💬 Soporte' => 'Asesoría técnica personalizada', '🤝 Confianza' => 'Miles de clientes satisfechos en Lima'] as $titulo => $desc)
        <div class="cp-card" style="padding:24px;text-align:center;border-top:3px solid #0052CC">
            <div style="font-size:2rem;margin-bottom:10px">{{ explode(' ',$titulo)[0] }}</div>
            <div style="font-weight:700;font-size:0.9rem;color:#172B4D;margin-bottom:6px" class="dark:text-white">{{ substr($titulo,3) }}</div>
            <div style="font-size:0.8rem;color:#97A0AF">{{ $desc }}</div>
        </div>
        @endforeach
    </div>
</div>
@endsection
