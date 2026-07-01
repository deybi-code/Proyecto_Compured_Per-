@extends('layouts.main')
@section('title', 'Carrito de Compras – Compured Perú')
@section('content')

<style>
    /* Variables y diseño base sincronizado con Home / Login */
    :root {
        --bg: #f0f4ff; --card: rgba(255,255,255,0.92); --text: #0f172a; --muted: #64748b;
        --border: #cbd5e1; --input-bg: #f8fafc; --primary: #1d4ed8; --primary-hover: #1e40af;
        --accent: #3b82f6; --shadow: 0 25px 60px rgba(0,0,0,0.18);
        --success: #10b981; --warning: #f59e0b; --danger: #ef4444;
        --surface-2: #ffffff;
    }
    [data-theme="dark"] {
        --bg: #060a14; --card: rgba(13,20,38,0.94); --text: #f1f5f9; --muted: #8fa1bd;
        --border: #1c2c4a; --input-bg: #0a1226; --primary: #3b82f6; --primary-hover: #2563eb;
        --accent: #60a5fa; --shadow: 0 30px 70px rgba(0,0,0,0.65);
        --success: #34d399; --warning: #fbbf24; --danger: #f87171;
        --surface-2: #0d1426;
    }

    /* ===== Hero compacto ===== */
    .hero-scene {
        position: relative; overflow: hidden;
        background: linear-gradient(135deg, #0b1120 0%, #14204a 45%, #1d4ed8 100%);
    }
    [data-theme="dark"] .hero-scene {
        background: linear-gradient(135deg, #020617 0%, #0a1128 45%, #16264d 100%);
    }
    .hero-grid {
        position: absolute; inset: 0; z-index: 1; pointer-events: none;
        background-image: linear-gradient(rgba(96,165,250,0.07) 1px, transparent 1px), linear-gradient(90deg, rgba(96,165,250,0.07) 1px, transparent 1px);
        background-size: 42px 42px;
        mask-image: radial-gradient(ellipse at top left, black, transparent 70%);
    }
    .hero-dots span {
        position: absolute; border-radius: 50%; background: rgba(96,165,250,0.35);
        animation: floatUp linear infinite; z-index: 1; pointer-events: none;
    }
    .hero-dots span:nth-child(1) { width:7px; height:7px; left:12%; top:70%; animation-duration:11s; }
    .hero-dots span:nth-child(2) { width:4px; height:4px; left:34%; top:40%; animation-duration:8s; animation-delay:1.5s; }
    .hero-dots span:nth-child(3) { width:9px; height:9px; left:58%; top:80%; animation-duration:13s; animation-delay:.5s; }
    .hero-dots span:nth-child(4) { width:5px; height:5px; left:78%; top:30%; animation-duration:9s; animation-delay:2.5s; }
    .hero-dots span:nth-child(5) { width:6px; height:6px; left:92%; top:65%; animation-duration:12s; animation-delay:1s; }
    @keyframes floatUp { 0% { transform:translateY(30px); opacity:0; } 30% { opacity:1; } 100% { transform:translateY(-40px); opacity:0; } }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-card { animation: fadeUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }

    @keyframes stepIn {
        from { opacity: 0; transform: translateX(14px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .step-pane { animation: stepIn 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
    [x-cloak] { display: none !important; }

    /* ===== Panel premium ===== */
    .premium-panel {
        background: var(--card); backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
        border: 1px solid var(--border); border-radius: 20px;
        box-shadow: 0 1px 0 rgba(255,255,255,0.03) inset, 0 20px 45px rgba(2,6,23,0.08);
        color: var(--text); overflow: hidden; position: relative;
    }
    [data-theme="dark"] .premium-panel { box-shadow: 0 1px 0 rgba(255,255,255,0.02) inset, 0 25px 60px rgba(0,0,0,0.5); }

    .premium-panel-header {
        display:flex; align-items:center; gap:14px; padding: 20px 26px;
        border-bottom: 1px solid var(--border);
    }
    .premium-panel-header .icon-badge {
        width:40px; height:40px; border-radius:13px; flex-shrink:0;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        display:flex; align-items:center; justify-content:center; color:#fff;
        box-shadow: 0 8px 18px rgba(29,78,216,0.35);
    }
    .premium-panel-header h3 {
        font-size:14px; font-weight:800; color:var(--text); letter-spacing:.6px; text-transform:uppercase; margin:0;
    }
    .premium-panel-header .sub { font-size:12px; color:var(--muted); font-weight:600; margin-top:2px; }

    /* ===== Stepper funcional ===== */
    .checkout-steps {
        display:flex; align-items:center; justify-content:center; gap:6px; margin: 0 auto 30px auto;
        max-width:640px; flex-wrap:wrap; padding: 0 16px;
    }
    .checkout-steps .step { display:flex; align-items:center; gap:10px; cursor:pointer; user-select:none; }
    .checkout-steps .step.disabled { cursor:not-allowed; opacity:.5; }
    .checkout-steps .step .dot {
        width:32px; height:32px; border-radius:50%; flex-shrink:0;
        background: var(--input-bg); color:var(--muted); border: 2px solid var(--border);
        display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:800;
        transition: all .25s;
    }
    .checkout-steps .step.active .dot, .checkout-steps .step.done .dot {
        background: linear-gradient(135deg, var(--primary), var(--accent)); color:#fff; border-color:transparent;
        box-shadow: 0 6px 14px rgba(29,78,216,0.4);
    }
    .checkout-steps .step.done .dot { background: linear-gradient(135deg, var(--success), #059669); box-shadow:0 6px 14px rgba(16,185,129,0.35); }
    .checkout-steps .step .label { font-size:12px; font-weight:800; color:var(--muted); text-transform:uppercase; letter-spacing:.4px; transition: color .25s; }
    .checkout-steps .step.active .label, .checkout-steps .step.done .label { color: var(--text); }
    .checkout-steps .step .label small { display:block; font-size:10px; font-weight:600; color:var(--muted); text-transform:none; letter-spacing:0; }
    .checkout-steps .line { width:36px; height:2px; background: var(--border); border-radius:2px; transition: background .3s; }
    .checkout-steps .line.done { background: linear-gradient(90deg, var(--success), var(--primary)); }

    /* ===== Productos ===== */
    .cart-item {
        display:flex; align-items:center; gap:16px; padding: 18px 26px;
        border-bottom: 1px solid var(--border); transition: background .2s;
    }
    .cart-item:last-child { border-bottom:none; }
    .cart-item:hover { background: rgba(59,130,246,0.04); }
    .prod-thumb {
        width:60px; height:60px; border-radius:16px; flex-shrink:0; overflow:hidden;
        background: linear-gradient(135deg, rgba(59,130,246,0.18), rgba(59,130,246,0.05));
        border: 1px solid rgba(59,130,246,0.25);
        display:flex; align-items:center; justify-content:center; font-size: 26px;
    }
    .prod-thumb img { width:100%; height:100%; object-fit:cover; }
    .prod-thumb-sm {
        width:44px; height:44px; border-radius:12px; flex-shrink:0; overflow:hidden;
        background: linear-gradient(135deg, rgba(59,130,246,0.18), rgba(59,130,246,0.05));
        border: 1px solid rgba(59,130,246,0.25);
        display:flex; align-items:center; justify-content:center; font-size: 19px;
    }
    .prod-thumb-sm img { width:100%; height:100%; object-fit:cover; }
    .qty-pill {
        display:inline-flex; align-items:center; justify-content:center; min-width:30px; padding:4px 10px;
        background:var(--input-bg); border:1px solid var(--border); border-radius:20px;
        font-weight:800; color:var(--primary); font-size:13px;
    }

    /* ===== Botones ===== */
    .btn-mega {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 15px 24px; background: linear-gradient(135deg, var(--primary), #2563eb);
        border: none; border-radius: 12px; color: white !important; font-size: 14px; font-weight: 800;
        cursor: pointer; letter-spacing: 0.5px; text-transform: uppercase; transition: all 0.25s;
        box-shadow: 0 10px 25px rgba(29,78,216,0.4); text-decoration: none; width: 100%;
    }
    .btn-mega:hover { transform: translateY(-2px); box-shadow: 0 14px 32px rgba(29,78,216,0.5); }
    .btn-mega:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

    .btn-ghost {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 15px 24px; background: transparent;
        border: 1.5px solid var(--border); border-radius: 12px; color: var(--text) !important; font-size: 14px; font-weight: 800;
        cursor: pointer; letter-spacing: 0.5px; text-transform: uppercase; transition: all 0.2s;
        text-decoration: none;
    }
    .btn-ghost:hover { border-color: var(--primary); color: var(--primary) !important; background: rgba(59,130,246,0.06); }

    .step-actions { display:flex; gap:14px; margin-top: 22px; }
    .step-actions .btn-ghost { flex: 0 0 auto; min-width: 140px; }
    .step-actions .btn-mega { flex: 1; }

    .btn-danger-icon {
        display: inline-flex; align-items: center; justify-content: center;
        width: 38px; height: 38px; background: rgba(239,68,68,0.1); color: var(--danger);
        border: 1px solid rgba(239,68,68,0.2); border-radius: 11px; cursor: pointer; transition: all 0.2s;
        flex-shrink: 0;
    }
    .btn-danger-icon:hover { background: var(--danger); color: white; transform: scale(1.05); }

    /* ===== Secciones del formulario ===== */
    .checkout-section { padding: 26px; }
    .checkout-section + .checkout-section { border-top: 1px solid var(--border); }
    .checkout-title {
        font-size: 12px; font-weight: 800; color: var(--text); margin-bottom: 18px;
        text-transform: uppercase; letter-spacing: 0.8px; display:flex; align-items:center; gap:10px;
    }

    /* Toggle segmentado */
    .toggle-group { display: flex; gap: 6px; margin-bottom: 18px; background: var(--input-bg); padding: 6px; border-radius: 14px; border: 1px solid var(--border); }
    .toggle-btn {
        flex: 1; padding: 12px 10px; text-align: center; font-size: 13px; font-weight: 700;
        color: var(--muted); border-radius: 10px; cursor: pointer; transition: all 0.25s;
        border: 2px solid transparent; display:flex; align-items:center; justify-content:center; gap:6px;
    }
    .toggle-btn.active { background: var(--card); color: var(--primary); border-color: rgba(59,130,246,0.3); box-shadow: 0 6px 16px rgba(0,0,0,0.08); }

    .cp-input-group { margin-bottom: 16px; }
    .cp-input-group label { display: block; font-size: 11px; font-weight: 800; color: var(--muted); margin-bottom: 7px; text-transform: uppercase; letter-spacing:.4px; }
    .cp-input {
        width: 100%; padding: 13px 16px; border: 1.5px solid var(--border); background: var(--input-bg);
        color: var(--text); border-radius: 12px; font-size: 14px; font-weight: 600; transition: all 0.25s;
    }
    .cp-input:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 4px rgba(59,130,246,0.15); background: var(--card); }
    .cp-input::placeholder { color: var(--muted); opacity:.7; }
    .cp-input.input-error { border-color: var(--danger) !important; box-shadow: 0 0 0 3px rgba(239,68,68,0.12); }
    .field-error { font-size:11px; font-weight:700; color: var(--danger); margin-top:-10px; margin-bottom:14px; display:flex; align-items:center; gap:5px; }
    .cp-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:16px; }

    /* Opciones de pago tipo tarjeta premium */
    .pay-option {
        display:flex; align-items:center; gap:14px; padding:16px; border:1.5px solid var(--border);
        border-radius:16px; cursor:pointer; margin-bottom:10px; transition:all 0.2s; background: var(--input-bg);
        position: relative;
    }
    .pay-option:last-child { margin-bottom: 0; }
    .pay-option:hover { border-color: rgba(59,130,246,0.4); }
    .pay-option input[type="radio"] { accent-color: var(--primary); width:19px; height:19px; flex-shrink:0; }
    .pay-icon {
        width:46px; height:46px; border-radius:13px; display:flex; align-items:center; justify-content:center;
        font-size:21px; flex-shrink:0; background: var(--card); border:1px solid var(--border);
    }
    .pay-check {
        position:absolute; top:-6px; right:-6px; width:20px; height:20px; border-radius:50%;
        background: var(--primary); color:#fff; display:none; align-items:center; justify-content:center; font-size:11px;
        box-shadow: 0 4px 10px rgba(29,78,216,.4);
    }
    .role-chip {
        display:inline-flex; align-items:center; gap:4px; font-size:10px; font-weight:800;
        padding:3px 10px; border-radius:20px; background: rgba(16,185,129,0.15); color: var(--success);
        text-transform:uppercase; letter-spacing:0.5px; margin-left:auto;
    }

    .review-card {
        background: var(--input-bg); border: 1px solid var(--border); border-radius: 16px;
        padding: 18px 20px; margin: 0 26px 22px 26px;
    }
    .review-card .review-row { display:flex; justify-content:space-between; gap:12px; font-size:13px; padding: 6px 0; }
    .review-card .review-row span:first-child { color: var(--muted); font-weight:600; }
    .review-card .review-row span:last-child { color: var(--text); font-weight:800; text-align:right; }
    .review-edit { font-size:11px; font-weight:800; color:var(--primary); cursor:pointer; text-transform:uppercase; letter-spacing:.4px; }

    .trust-row { display:flex; align-items:center; justify-content:center; gap:14px; padding:14px 0 4px 0; flex-wrap:wrap; }
    .trust-row span { font-size:11px; font-weight:700; color:var(--muted); display:flex; align-items:center; gap:5px; }

    /* Breadcrumb superior slim */
    .modern-breadcrumb {
        display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 600;
        color: rgba(255,255,255,0.6);
    }
    .modern-breadcrumb a { color: rgba(255,255,255,0.85); text-decoration: none; }
    .modern-breadcrumb a:hover { text-decoration: underline; }

    /* ===== Resumen sticky ===== */
    .summary-sticky { position: sticky; top: 24px; }

    @media (max-width: 1024px) {
        .summary-sticky { position: static; }
    }
    @media (max-width: 640px) {
        .checkout-section { padding: 20px; }
        .premium-panel-body, .premium-panel-header { padding-left:20px; padding-right:20px; }
        .cp-grid-2 { grid-template-columns: 1fr; gap: 0; }
        .checkout-steps .step .label small { display:none; }
        .step-actions { flex-direction: column-reverse; }
        .step-actions .btn-ghost { width: 100%; }
        .review-card { margin-left: 20px; margin-right: 20px; }
    }
</style>

{{-- ===== HERO COMPACTO ===== --}}
<div class="hero-scene w-full" style="padding:26px 0; margin-bottom:36px;">
    <div class="hero-grid"></div>
    <div class="hero-dots"><span></span><span></span><span></span><span></span><span></span></div>

    <div class="max-w-7xl mx-auto px-4 w-full" style="position:relative; z-index:2;">
        <nav class="modern-breadcrumb" style="margin-bottom:10px;">
            <a href="/">Inicio</a><span>›</span><span style="color:#fff;">Carrito de compras</span>
        </nav>
        <h1 style="font-family:'Segoe UI',sans-serif; font-size:clamp(1.5rem, 3.2vw, 2.1rem); font-weight:800; color:white; line-height:1.2;">
            Finalizar Compra <span style="color:var(--accent);">🛒</span>
        </h1>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 pb-16" style="min-height: calc(100vh - 320px);">

    @if(empty($carrito))
    <div class="premium-panel animate-card" style="padding:80px 20px; text-align:center; animation-delay:0.1s;">
        <div style="font-size:80px; margin-bottom:20px; opacity:0.6; filter:grayscale(100%);">🛒</div>
        <h2 style="font-size:26px; font-weight:900; color:var(--text); margin-bottom:12px;">Tu carrito está vacío</h2>
        <p style="color:var(--muted); font-size:15px; margin-bottom:32px;">Aún no has agregado equipos o accesorios a tu compra.</p>
        <a href="/" class="btn-mega" style="width:auto; padding:16px 40px; display:inline-flex;">Ir a la tienda</a>
    </div>
    @else

    @php
        $total = collect($carrito)->sum(fn($i) => $i['precio'] * $i['cantidad']);
        $rolUsuario = auth()->check() ? auth()->user()->rol : 'cliente';
    @endphp

    <div
        x-data="{
            step: 1,
            maxStep: 1,
            tipo_doc: 'dni',
            entrega: 'delivery',
            metodo_pago: 'tarjeta',
            dni: '', nombre: '', ruc: '', razon_social: '',
            telefono: '', direccion: '', referencia: '',
            errors2: {},
            validateStep2() {
                this.errors2 = {};
                if (this.tipo_doc === 'dni') {
                    if (!/^[0-9]{8}$/.test(this.dni)) this.errors2.dni = true;
                    if (!this.nombre.trim()) this.errors2.nombre = true;
                } else {
                    if (!/^[0-9]{11}$/.test(this.ruc)) this.errors2.ruc = true;
                    if (!this.razon_social.trim()) this.errors2.razon_social = true;
                }
                if (!this.telefono.trim()) this.errors2.telefono = true;
                if (this.entrega === 'delivery' && !this.direccion.trim()) this.errors2.direccion = true;
                return Object.keys(this.errors2).length === 0;
            },
            goNext2to3() {
                if (this.validateStep2()) { this.step = 3; this.maxStep = Math.max(this.maxStep, 3); }
            },
            goToStep(n) {
                if (n <= this.maxStep) this.step = n;
            }
        }"
    >
        {{-- Stepper funcional --}}
        <div class="checkout-steps animate-card">
            <div class="step" :class="{ active: step === 1, done: step > 1, disabled: 1 > maxStep }" @click="goToStep(1)">
                <div class="dot"><span x-show="step <= 1">1</span><span x-show="step > 1">✓</span></div>
                <div class="label">Carrito<small>Tus productos</small></div>
            </div>
            <div class="line" :class="{ done: maxStep > 1 }"></div>
            <div class="step" :class="{ active: step === 2, done: step > 2, disabled: 2 > maxStep }" @click="goToStep(2)">
                <div class="dot"><span x-show="step <= 2">2</span><span x-show="step > 2">✓</span></div>
                <div class="label">Datos y Entrega<small>Comprobante y envío</small></div>
            </div>
            <div class="line" :class="{ done: maxStep > 2 }"></div>
            <div class="step" :class="{ active: step === 3, disabled: 3 > maxStep }" @click="goToStep(3)">
                <div class="dot">3</div>
                <div class="label">Pago<small>Confirmar pedido</small></div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start">
            {{-- COLUMNA IZQUIERDA --}}
            <div style="flex:1; width:100%;" class="animate-card" style="animation-delay: 0.15s;">

                <form id="formPago" action="{{ route('pago.procesar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tipo_doc" :value="tipo_doc">
                    <input type="hidden" name="entrega" :value="entrega">
                    <input type="hidden" name="metodo_pago" :value="metodo_pago">

                    {{-- ===== PASO 1: CARRITO ===== --}}
                    <div x-show="step === 1" class="step-pane">
                        <div class="premium-panel mb-6">
                            <div class="premium-panel-header">
                                <div class="icon-badge">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <div>
                                    <h3>Productos en tu carrito</h3>
                                    <div class="sub">{{ count($carrito) }} {{ count($carrito) == 1 ? 'artículo' : 'artículos' }}</div>
                                </div>
                            </div>

                            @foreach($carrito as $id => $item)
                            <div class="cart-item">
                                <div class="prod-thumb">
                                    @if(!empty($item['imagen'] ?? null))
                                        <img src="{{ asset('img/'.($item['imagen'] ?? '')) }}" alt="{{ $item['nombre'] }}">
                                    @else
                                        💻
                                    @endif
                                </div>
                                <div style="flex:1; min-width:0;">
                                    <div style="font-weight:700; font-size:14px; color:var(--text); line-height:1.4; margin-bottom:4px;">{{ $item['nombre'] }}</div>
                                    <div style="font-size:12px; color:var(--muted); font-weight:600;">S/ {{ number_format($item['precio'],2) }} c/u &nbsp;·&nbsp; <span class="qty-pill">{{ $item['cantidad'] }}</span></div>
                                </div>
                                <div style="text-align:right; flex-shrink:0;">
                                    <div style="font-weight:900; color:var(--primary); font-size:16px; font-family:'Segoe UI', sans-serif;">S/ {{ number_format($item['precio']*$item['cantidad'],2) }}</div>
                                </div>
                                <button type="button" onclick="document.getElementById('delete-{{ $id }}').submit()" class="btn-danger-icon" title="Eliminar del carrito">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                            @endforeach
                        </div>

                        <a href="/" style="display:inline-flex; align-items:center; gap:8px; font-size:14px; color:var(--primary); font-weight:700; text-decoration:none; margin-bottom:28px;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Continuar Comprando
                        </a>

                        <div class="step-actions">
                            <button type="button" class="btn-mega" @click="step = 2; maxStep = Math.max(maxStep, 2)">
                                Siguiente: Datos y Entrega
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- ===== PASO 2: DATOS Y ENTREGA ===== --}}
                    <div x-show="step === 2" class="step-pane" x-cloak>

                        {{-- Datos de facturación --}}
                        <div class="premium-panel mb-6">
                            <div class="premium-panel-header">
                                <div class="icon-badge">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <div>
                                    <h3>Datos de Facturación</h3>
                                    <div class="sub">¿Boleta o factura?</div>
                                </div>
                            </div>

                            <div class="checkout-section">
                                <div class="toggle-group">
                                    <div class="toggle-btn" :class="tipo_doc === 'dni' ? 'active' : ''" @click="tipo_doc = 'dni'">🪪 Boleta (DNI) — Persona Natural</div>
                                    <div class="toggle-btn" :class="tipo_doc === 'ruc' ? 'active' : ''" @click="tipo_doc = 'ruc'">🏢 Factura (RUC) — Empresa</div>
                                </div>

                                {{-- Persona Natural --}}
                                <div x-show="tipo_doc === 'dni'" x-transition.opacity>
                                    <div class="cp-grid-2">
                                        <div class="cp-input-group">
                                            <label>DNI</label>
                                            <input type="text" name="dni" x-model="dni" :class="errors2.dni ? 'input-error' : ''" class="cp-input" placeholder="Número de DNI" maxlength="8" inputmode="numeric">
                                            <div class="field-error" x-show="errors2.dni">⚠ Ingresa un DNI válido de 8 dígitos.</div>
                                        </div>
                                        <div class="cp-input-group">
                                            <label>Nombre Completo</label>
                                            <input type="text" name="nombre" x-model="nombre" :class="errors2.nombre ? 'input-error' : ''" class="cp-input" placeholder="Nombres y Apellidos">
                                            <div class="field-error" x-show="errors2.nombre">⚠ Ingresa tu nombre completo.</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Empresa / RUC --}}
                                <div x-show="tipo_doc === 'ruc'" x-transition.opacity x-cloak>
                                    <div class="cp-grid-2">
                                        <div class="cp-input-group">
                                            <label>RUC</label>
                                            <input type="text" name="ruc" x-model="ruc" :class="errors2.ruc ? 'input-error' : ''" class="cp-input" placeholder="Número de RUC" maxlength="11" inputmode="numeric">
                                            <div class="field-error" x-show="errors2.ruc">⚠ Ingresa un RUC válido de 11 dígitos.</div>
                                        </div>
                                        <div class="cp-input-group">
                                            <label>Razón Social</label>
                                            <input type="text" name="razon_social" x-model="razon_social" :class="errors2.razon_social ? 'input-error' : ''" class="cp-input" placeholder="Nombre de la Empresa">
                                            <div class="field-error" x-show="errors2.razon_social">⚠ Ingresa la razón social.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Entrega --}}
                        <div class="premium-panel mb-6">
                            <div class="premium-panel-header">
                                <div class="icon-badge">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <h3>Método de Entrega</h3>
                                    <div class="sub">¿Cómo recibes tu pedido?</div>
                                </div>
                            </div>

                            <div class="checkout-section">
                                <div class="toggle-group">
                                    <div class="toggle-btn" :class="entrega === 'delivery' ? 'active' : ''" @click="entrega = 'delivery'">🚚 Envío a Domicilio</div>
                                    <div class="toggle-btn" :class="entrega === 'recojo' ? 'active' : ''" @click="entrega = 'recojo'">🏬 Recojo en Tienda</div>
                                </div>

                                <div class="cp-input-group">
                                    <label>Teléfono de Contacto</label>
                                    <input type="text" name="telefono" x-model="telefono" :class="errors2.telefono ? 'input-error' : ''" class="cp-input" placeholder="Celular para coordinar" inputmode="tel">
                                    <div class="field-error" x-show="errors2.telefono">⚠ Indica un teléfono de contacto.</div>
                                </div>

                                <div x-show="entrega === 'delivery'" x-transition.opacity>
                                    <div class="cp-input-group">
                                        <label>Dirección Exacta</label>
                                        <input type="text" name="direccion" x-model="direccion" :class="errors2.direccion ? 'input-error' : ''" class="cp-input" placeholder="Av. / Calle / N° / Distrito">
                                        <div class="field-error" x-show="errors2.direccion">⚠ Indica la dirección de entrega.</div>
                                    </div>
                                    <div class="cp-input-group" style="margin-bottom:0;">
                                        <label>Referencias</label>
                                        <input type="text" name="referencia" x-model="referencia" class="cp-input" placeholder="Ej. Cerca al parque...">
                                    </div>
                                </div>

                                <div x-show="entrega === 'recojo'" x-transition.opacity x-cloak>
                                    <div style="background:rgba(59,130,246,0.08); border:1px solid rgba(59,130,246,0.2); padding:16px; border-radius:14px;">
                                        <div style="font-weight:800; color:var(--primary); font-size:13px; margin-bottom:4px;">📍 Dirección de Tienda</div>
                                        <div style="color:var(--text); font-size:13px; font-weight:600;">Av. Tecnología 123, Centro de Lima.</div>
                                        <div style="color:var(--muted); font-size:12px; margin-top:4px;">Presentar comprobante digital al recoger. Te avisaremos por teléfono cuando esté listo.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="step-actions">
                            <button type="button" class="btn-ghost" @click="step = 1">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Atrás
                            </button>
                            <button type="button" class="btn-mega" @click="goNext2to3()">
                                Siguiente: Pago
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- ===== PASO 3: PAGO ===== --}}
                    <div x-show="step === 3" class="step-pane" x-cloak>

                        {{-- Resumen de datos elegidos --}}
                        <div class="premium-panel mb-6">
                            <div class="premium-panel-header">
                                <div class="icon-badge">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                </div>
                                <div style="flex:1;">
                                    <h3>Revisa tus datos</h3>
                                    <div class="sub">Facturación y entrega</div>
                                </div>
                                <span class="review-edit" @click="step = 2">✎ Editar</span>
                            </div>
                            <div class="review-card">
                                <template x-if="tipo_doc === 'dni'">
                                    <div>
                                        <div class="review-row"><span>Comprobante</span><span>Boleta (DNI)</span></div>
                                        <div class="review-row"><span>DNI</span><span x-text="dni || '—'"></span></div>
                                        <div class="review-row"><span>Nombre</span><span x-text="nombre || '—'"></span></div>
                                    </div>
                                </template>
                                <template x-if="tipo_doc === 'ruc'">
                                    <div>
                                        <div class="review-row"><span>Comprobante</span><span>Factura (RUC)</span></div>
                                        <div class="review-row"><span>RUC</span><span x-text="ruc || '—'"></span></div>
                                        <div class="review-row"><span>Razón Social</span><span x-text="razon_social || '—'"></span></div>
                                    </div>
                                </template>
                                <div class="review-row"><span>Entrega</span><span x-text="entrega === 'delivery' ? 'Envío a domicilio' : 'Recojo en tienda'"></span></div>
                                <div class="review-row"><span>Teléfono</span><span x-text="telefono || '—'"></span></div>
                                <template x-if="entrega === 'delivery'">
                                    <div class="review-row"><span>Dirección</span><span x-text="direccion || '—'"></span></div>
                                </template>
                            </div>
                        </div>

                        {{-- Pago --}}
                        <div class="premium-panel mb-6" id="panel-pago">
                            <div class="premium-panel-header">
                                <div class="icon-badge">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-8 4h16a1 1 0 001-1V6a1 1 0 00-1-1H3a1 1 0 00-1 1v12a1 1 0 001 1z"/></svg>
                                </div>
                                <div style="flex:1;">
                                    <h3>Método de Pago</h3>
                                    <div class="sub">Elige cómo quieres pagar</div>
                                </div>
                                @if($rolUsuario === 'admin' || $rolUsuario === 'ventas')
                                    <span class="role-chip">✓ {{ strtoupper($rolUsuario) }}</span>
                                @endif
                            </div>

                            <div class="checkout-section">
                                <label class="pay-option" :style="metodo_pago === 'tarjeta' ? 'border-color:var(--primary); background:rgba(59,130,246,0.06);' : ''">
                                    <input type="radio" name="metodo_pago_radio" value="tarjeta" x-model="metodo_pago">
                                    <div class="pay-icon">💳</div>
                                    <div style="flex:1;">
                                        <div style="font-weight:800; font-size:14px; color:var(--text);">Pago con Tarjeta</div>
                                        <div style="font-size:12px; color:var(--muted); font-weight:600;">Pasarela segura · Visa / Mastercard / Yape</div>
                                    </div>
                                    <div class="pay-check" :style="metodo_pago === 'tarjeta' ? 'display:flex;' : ''">✓</div>
                                </label>

                                <div x-show="metodo_pago === 'tarjeta'" x-transition.opacity style="background:rgba(59,130,246,0.08); border:1px solid rgba(59,130,246,0.2); padding:14px 16px; border-radius:14px; margin-top:2px; margin-bottom:10px; display:flex; align-items:center; gap:10px;">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0; color:var(--primary);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    <div style="font-size:12px; color:var(--text); font-weight:600; line-height:1.5;">Al confirmar te llevaremos a la pasarela de pago segura para ingresar los datos de tu tarjeta.</div>
                                </div>

                                <label class="pay-option" :style="metodo_pago === 'transferencia' ? 'border-color:var(--accent); background:rgba(59,130,246,0.06);' : ''">
                                    <input type="radio" name="metodo_pago_radio" value="transferencia" x-model="metodo_pago">
                                    <div class="pay-icon">🏦</div>
                                    <div style="flex:1;">
                                        <div style="font-weight:800; font-size:14px; color:var(--text);">Transferencia Bancaria</div>
                                        <div style="font-size:12px; color:var(--muted); font-weight:600;">BCP / Interbank / BBVA — envío de voucher</div>
                                    </div>
                                    <div class="pay-check" :style="metodo_pago === 'transferencia' ? 'display:flex;' : ''">✓</div>
                                </label>

                                <div x-show="metodo_pago === 'transferencia'" x-transition.opacity style="background:rgba(59,130,246,0.08); border:1px solid rgba(59,130,246,0.2); padding:14px 16px; border-radius:14px; margin-top:2px; margin-bottom:10px;">
                                    <div style="font-weight:800; color:var(--primary); font-size:12px; margin-bottom:6px;">📋 Cuentas para depósito</div>
                                    <div style="font-size:12px; color:var(--text); font-weight:600; line-height:1.8;">
                                        BCP: 193-XXXXXXX-0-XX &nbsp;·&nbsp; CCI: 002193XXXXXXXXXXX18<br>
                                        Titular: Compured Perú S.A.C.
                                    </div>
                                    <div style="font-size:11px; color:var(--muted); font-weight:600; margin-top:8px;">Después de confirmar tu pedido, envíanos el voucher para validar el pago.</div>
                                </div>

                                @if($rolUsuario === 'admin' || $rolUsuario === 'ventas')
                                <label class="pay-option" :style="metodo_pago === 'efectivo' ? 'border-color:var(--success); background:rgba(16,185,129,0.06);' : ''">
                                    <input type="radio" name="metodo_pago_radio" value="efectivo" x-model="metodo_pago">
                                    <div class="pay-icon">💵</div>
                                    <div style="flex:1;">
                                        <div style="font-weight:800; font-size:14px; color:var(--text);">Efectivo (Caja)</div>
                                        <div style="font-size:12px; color:var(--success); font-weight:700;">Habilitado por tu rol: {{ strtoupper($rolUsuario) }}</div>
                                    </div>
                                    <div class="pay-check" style="background:var(--success);" :style="metodo_pago === 'efectivo' ? 'display:flex; background:var(--success);' : ''">✓</div>
                                </label>
                                @endif
                            </div>
                        </div>

                        <div class="step-actions">
                            <button type="button" class="btn-ghost" @click="step = 2">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Atrás
                            </button>
                            <button type="submit" class="btn-mega">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                Confirmar y Pagar
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Formularios de eliminación (fuera del form principal para no interferir) --}}
                @foreach($carrito as $id => $item)
                <form id="delete-{{ $id }}" action="{{ route('carrito.destroy',$id) }}" method="POST" style="display:none;">
                    @csrf @method('DELETE')
                </form>
                @endforeach
            </div>

            {{-- COLUMNA DERECHA: resumen sticky --}}
            <div style="width:100%; max-width:400px; flex-shrink:0;" class="animate-card summary-sticky" style="animation-delay: 0.25s;">
                <div class="premium-panel">
                    <div class="premium-panel-header">
                        <div class="icon-badge">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h3>Resumen del Pedido</h3>
                            <div class="sub">{{ count($carrito) }} {{ count($carrito) == 1 ? 'producto' : 'productos' }}</div>
                        </div>
                    </div>

                    <div style="max-height:220px; overflow-y:auto;">
                        @foreach($carrito as $id => $item)
                        <div class="cart-item" style="padding:14px 26px;">
                            <div class="prod-thumb-sm">
                                @if(!empty($item['imagen'] ?? null))
                                    <img src="{{ asset('img/'.($item['imagen'] ?? '')) }}" alt="{{ $item['nombre'] }}">
                                @else
                                    💻
                                @endif
                            </div>
                            <div style="flex:1; min-width:0;">
                                <div style="font-weight:700; font-size:13px; color:var(--text); line-height:1.3; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $item['nombre'] }}</div>
                                <div style="font-size:11px; color:var(--muted); font-weight:600;">x{{ $item['cantidad'] }}</div>
                            </div>
                            <div style="font-weight:800; color:var(--primary); font-size:13px; flex-shrink:0;">S/ {{ number_format($item['precio']*$item['cantidad'],2) }}</div>
                        </div>
                        @endforeach
                    </div>

                    <div style="padding:24px 26px; border-top:1px solid var(--border);">
                        <div style="display:flex; justify-content:space-between; font-size:14px; color:var(--muted); font-weight:600; margin-bottom:12px;">
                            <span>Subtotal ({{ count($carrito) }} items)</span>
                            <span style="color:var(--text);">S/ {{ number_format($total,2) }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; font-size:14px; color:var(--muted); font-weight:600; margin-bottom:20px; padding-bottom:20px; border-bottom:1px dashed var(--border);">
                            <span>Descuentos</span>
                            <span style="color:var(--success);">S/ 0.00</span>
                        </div>

                        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:22px;">
                            <span style="font-weight:800; color:var(--text); font-size:15px; text-transform:uppercase;">Total</span>
                            <span style="font-family:'Segoe UI', sans-serif; font-size:28px; font-weight:900; color:var(--primary);">S/ {{ number_format($total,2) }}</span>
                        </div>

                        <template x-if="step < 3">
                            <div style="font-size:12px; color:var(--muted); font-weight:600; text-align:center; padding:10px 6px; background:var(--input-bg); border:1px solid var(--border); border-radius:10px;">
                                Completa los pasos anteriores para confirmar el pago 👆
                            </div>
                        </template>
                        <template x-if="step === 3">
                            <button type="submit" form="formPago" class="btn-mega">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                Confirmar y Pagar
                            </button>
                        </template>

                        <div class="trust-row">
                            <span>🔒 Compra segura</span>
                            <span>💳 Tarjetas</span>
                            <span>🏦 Transferencia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
