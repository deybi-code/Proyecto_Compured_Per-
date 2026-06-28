@extends('layouts.main')
@section('title', 'Términos y Condiciones – Compured Perú')
@section('content')
<div style="background:linear-gradient(135deg,#091E42,#0052CC);padding:50px 20px;text-align:center">
    <h1 style="font-family:'Rajdhani',sans-serif;font-size:2rem;font-weight:800;color:white">Términos y Condiciones</h1>
    <p style="color:rgba(255,255,255,0.7);margin-top:8px">Última actualización: {{ date('Y') }}</p>
</div>
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="cp-card" style="padding:36px">
        @foreach(['Uso del sitio web' => 'El uso de este sitio web está sujeto a los presentes términos. Al acceder a compuredperu.com, aceptas cumplir con estas condiciones.', 'Compras y pagos' => 'Todos los precios están en Soles (S/) e incluyen IGV. Las compras son válidas sujeto a disponibilidad de stock. Una vez confirmado el pago, no se realizarán reembolsos salvo por defectos de fábrica.', 'Garantías y devoluciones' => 'Los productos tienen garantía del fabricante. Devoluciones aceptadas dentro de 7 días calendario presentando comprobante original. El producto debe estar en empaque original sin signos de uso.', 'Envíos' => 'Realizamos envíos a todo Lima y provincias. Los tiempos de entrega son referenciales (1-3 días Lima, 3-7 días provincias). No nos hacemos responsables por demoras del courier.', 'Privacidad' => 'Tus datos personales son tratados de forma confidencial y no serán compartidos con terceros sin tu consentimiento, salvo obligación legal.'] as $titulo => $contenido)
        <div style="margin-bottom:24px">
            <h2 style="font-weight:700;color:#0052CC;font-size:1rem;margin-bottom:8px;display:flex;align-items:center;gap:8px" class="dark:text-blue-400">
                <span style="background:#EBF3FF;border-radius:50%;width:24px;height:24px;display:inline-flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:800;color:#0052CC;flex-shrink:0" class="dark:bg-blue-900/30">{{ $loop->iteration }}</span>
                {{ $titulo }}
            </h2>
            <p style="color:#5E6C84;line-height:1.8;font-size:0.9rem" class="dark:text-gray-400">{{ $contenido }}</p>
        </div>
        @endforeach
        <div style="padding-top:20px;border-top:1px solid #DFE1E6;text-align:center" class="dark:border-gray-700">
            <p style="font-size:0.82rem;color:#97A0AF">¿Consultas? Escríbenos por <a href="https://wa.me/51999999999" style="color:#25D366;font-weight:600">WhatsApp</a></p>
        </div>
    </div>
</div>
@endsection
