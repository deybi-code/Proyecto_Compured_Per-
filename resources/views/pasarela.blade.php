@extends('layouts.main')
@section('title', 'Pasarela de pago – Compured Perú')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-8" style="max-width:560px;margin:0 auto;padding:32px 16px;">

    <nav class="breadcrumb mb-6"><a href="/">Inicio</a><span>›</span><a href="{{ route('carrito.index') }}">Carrito</a><span>›</span><span>Pasarela de pago</span></nav>

    <div class="cp-card" style="padding:28px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
            <span style="font-size:1.4rem;">🔒</span>
            <h1 style="font-family:'Rajdhani',sans-serif;font-size:1.4rem;font-weight:800;color:var(--text);margin:0;">Pasarela de pago segura</h1>
        </div>
        <p style="font-size:0.85rem;color:var(--muted);margin:0 0 22px;">
            Ingresa los datos de tu tarjeta para completar el pago. Ninguna información se guarda sin cifrar.
        </p>

        @if(session('error'))
        <div class="cp-flash-msg cp-flash-error" style="margin-bottom:18px;">⚠ {{ session('error') }}</div>
        @endif

        <div style="display:flex;justify-content:space-between;align-items:center;background:var(--input-bg);border:1px solid var(--border);border-radius:10px;padding:14px 18px;margin-bottom:22px;">
            <span style="font-weight:700;color:var(--text);">Total a pagar</span>
            <span style="font-family:'Rajdhani',sans-serif;font-size:1.4rem;font-weight:800;color:var(--primary);">S/ {{ number_format($total, 2) }}</span>
        </div>

        <form method="POST" action="{{ route('pago.pasarela.confirmar') }}" id="formTarjeta">
            @csrf

            <div style="margin-bottom:14px;">
                <label class="cp-label">Número de tarjeta *</label>
                <input type="text" name="numero_tarjeta" id="numero_tarjeta" class="cp-input"
                       inputmode="numeric" maxlength="19" placeholder="4111 1111 1111 1111"
                       value="{{ old('numero_tarjeta') }}" required>
            </div>

            <div style="margin-bottom:14px;">
                <label class="cp-label">Nombre del titular *</label>
                <input type="text" name="nombre_titular" class="cp-input"
                       placeholder="Como aparece en la tarjeta"
                       value="{{ old('nombre_titular') }}" required>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;">
                <div>
                    <label class="cp-label">Mes *</label>
                    <input type="text" name="mes_exp" class="cp-input" inputmode="numeric" maxlength="2" placeholder="MM" value="{{ old('mes_exp') }}" required>
                </div>
                <div>
                    <label class="cp-label">Año *</label>
                    <input type="text" name="anio_exp" class="cp-input" inputmode="numeric" maxlength="4" placeholder="AAAA" value="{{ old('anio_exp') }}" required>
                </div>
                <div>
                    <label class="cp-label">CVV *</label>
                    <input type="password" name="cvv" class="cp-input" inputmode="numeric" maxlength="4" placeholder="•••" required>
                </div>
            </div>

            <button type="submit" class="btn-primary w-full justify-center py-3" style="margin-top:24px;">
                🔒 Pagar S/ {{ number_format($total, 2) }}
            </button>
        </form>

        <form method="POST" action="{{ route('pago.pasarela.cancelar') }}" style="margin-top:10px;">
            @csrf
            <button type="submit" style="width:100%;background:none;border:none;color:var(--muted);font-weight:600;font-size:0.85rem;cursor:pointer;padding:8px;">
                ← Cancelar y volver al carrito
            </button>
        </form>

        <div style="font-size:0.72rem;color:#97A0AF;text-align:center;margin-top:6px;">
            🔒 Esta es una pasarela de prueba (sandbox). No se realizan cargos reales.
        </div>
    </div>
</div>

<script>
    // Formatea el número de tarjeta en grupos de 4 mientras se escribe
    document.getElementById('numero_tarjeta').addEventListener('input', function (e) {
        let v = e.target.value.replace(/\D/g, '').slice(0, 19);
        e.target.value = v.replace(/(.{4})/g, '$1 ').trim();
    });
</script>
@endsection
