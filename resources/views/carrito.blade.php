@extends('layouts.main')
@section('title', 'Carrito de Compras – Compured Perú')
@section('content')

<style>
    /* Variables sincronizadas con el ecosistema (Login, Index, Dashboard, etc.) */
    :root {
        --bg: #f0f4ff; --card: rgba(255,255,255,0.92); --text: #0f172a; --muted: #64748b;
        --border: #cbd5e1; --input-bg: #f8fafc; --primary: #1d4ed8; --primary-hover: #1e40af;
        --accent: #3b82f6; --shadow: 0 25px 60px rgba(0,0,0,0.18);
        --success: #10b981; --warning: #f59e0b; --danger: #ef4444;
    }
    [data-theme="dark"] {
        --bg: #0a0f1e; --card: rgba(15,23,42,0.93); --text: #f1f5f9; --muted: #94a3b8;
        --border: #1e3a5f; --input-bg: #0f172a; --primary: #3b82f6; --primary-hover: #2563eb;
        --accent: #60a5fa; --shadow: 0 25px 60px rgba(0,0,0,0.6);
        --success: #34d399; --warning: #fbbf24; --danger: #f87171;
    }

    /* Animaciones Generales */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .animate-card { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }

    /* Tarjetas Glassmorphism */
    .glass-card {
        background: var(--card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(59,130,246,0.2); border-top: 4px solid var(--primary);
        border-radius: 20px; box-shadow: var(--shadow); transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
        color: var(--text); overflow: hidden;
    }

    /* Tabla Pro del Carrito */
    .cart-table-wrap { width: 100%; overflow-x: auto; }
    .cp-table { width: 100%; border-collapse: collapse; min-width: 600px; }
    .cp-table th {
        background: rgba(59,130,246,0.05); padding: 16px 24px; text-align: left;
        font-size: 13px; font-weight: 800; color: var(--muted); text-transform: uppercase; letter-spacing: 0.5px;
        border-bottom: 2px solid var(--border);
    }
    .cp-table td {
        padding: 20px 24px; font-size: 14px; color: var(--text); font-weight: 600;
        border-bottom: 1px solid var(--border); transition: background 0.2s; vertical-align: middle;
    }
    .cp-table tbody tr:hover td { background: rgba(59,130,246,0.02); }
    .cp-table tbody tr:last-child td { border-bottom: none; }

    /* Botones y Controles */
    .btn-mega {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 14px 24px; background: linear-gradient(135deg, var(--primary), #2563eb);
        border: none; border-radius: 12px; color: white !important; font-size: 14px; font-weight: 800;
        cursor: pointer; text-transform: uppercase; transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(29,78,216,0.4); text-decoration: none; width: 100%;
    }
    .btn-mega:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(29,78,216,0.5); }

    .btn-danger-icon {
        display: inline-flex; align-items: center; justify-content: center;
        width: 36px; height: 36px; background: rgba(239,68,68,0.1); color: var(--danger);
        border: 1px solid rgba(239,68,68,0.2); border-radius: 10px; cursor: pointer; transition: all 0.2s;
    }
    .btn-danger-icon:hover { background: var(--danger); color: white; transform: scale(1.05); }

    /* Formulario de Checkout Interactivo Integrado */
    .checkout-section { padding: 24px; background: var(--input-bg); border-top: 1px solid var(--border); }
    .checkout-title { font-size: 14px; font-weight: 800; color: var(--text); margin-bottom: 16px; text-transform: uppercase; letter-spacing: 0.5px; }

    .toggle-group { display: flex; gap: 10px; margin-bottom: 16px; background: rgba(59,130,246,0.05); padding: 6px; border-radius: 12px; border: 1px solid var(--border); }
    .toggle-btn {
        flex: 1; padding: 10px; text-align: center; font-size: 13px; font-weight: 700;
        color: var(--muted); border-radius: 8px; cursor: pointer; transition: all 0.3s;
        border: 2px solid transparent;
    }
    .toggle-btn.active { background: var(--card); color: var(--primary); border-color: var(--primary); box-shadow: 0 2px 8px rgba(0,0,0,0.1); }

    .cp-input-group { margin-bottom: 16px; }
    .cp-input-group label { display: block; font-size: 12px; font-weight: 700; color: var(--muted); margin-bottom: 6px; text-transform: uppercase; }
    .cp-input {
        width: 100%; padding: 12px 16px; border: 2px solid var(--border); background: var(--card);
        color: var(--text); border-radius: 10px; font-size: 14px; font-weight: 600; transition: all 0.3s;
    }
    .cp-input:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 4px rgba(59,130,246,0.15); }

    /* Breadcrumbs */
    .modern-breadcrumb {
        display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600;
        color: var(--muted); margin-bottom: 24px; padding: 12px 20px;
        background: var(--card); border: 1px solid var(--border); border-radius: 12px;
        width: fit-content; box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .modern-breadcrumb a { color: var(--primary); text-decoration: none; }
    .modern-breadcrumb a:hover { text-decoration: underline; }

    .alert-success {
        background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3);
        color: var(--success); border-radius: 12px; padding: 16px 20px; font-size: 14px;
        font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; gap: 10px;
    }
</style>

<div class="max-w-7xl mx-auto px-4 py-8" style="min-height: calc(100vh - 200px);">

    <nav class="modern-breadcrumb animate-card" style="animation-delay: 0s;">
        <a href="/">Inicio</a><span>›</span><span style="color:var(--text);">Carrito de compras / Checkout</span>
    </nav>

    @if(empty($carrito))
    <div class="glass-card animate-card" style="padding:80px 20px; text-align:center; animation-delay:0.1s;">
        <div style="font-size:80px; margin-bottom:20px; opacity:0.6; filter:grayscale(100%); animation:bounce 2s infinite;">🛒</div>
        <h2 style="font-size:28px; font-weight:900; color:var(--text); margin-bottom:12px;">Tu carrito está vacío</h2>
        <p style="color:var(--muted); font-size:16px; margin-bottom:32px;">Aún no has agregado equipos o accesorios a tu compra.</p>
        <a href="/" class="btn-mega" style="width:auto; padding:16px 40px; font-size:16px;">Ir a la tienda</a>
    </div>
    @else

    @php
        $total = collect($carrito)->sum(fn($i) => $i['precio'] * $i['cantidad']);
        $rolUsuario = auth()->check() ? auth()->user()->rol : 'cliente';
    @endphp

    <div class="flex flex-col lg:flex-row gap-8">
        {{-- LISTA DE PRODUCTOS --}}
        <div style="flex:1;" class="animate-card" style="animation-delay: 0.2s;">
            <div class="glass-card mb-6">
                <div style="padding:20px 24px; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:12px; background:rgba(59,130,246,0.05);">
                    <div style="background:var(--primary); color:white; width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:14px;">{{ count($carrito) }}</div>
                    <span style="font-weight:800; font-size:16px; color:var(--text);">Productos en tu Carrito</span>
                </div>

                <div class="cart-table-wrap">
                    <table class="cp-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th style="text-align:center">Precio</th>
                                <th style="text-align:center">Cant.</th>
                                <th style="text-align:center">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($carrito as $id => $item)
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:16px;">
                                    <div style="width:64px; height:64px; background:var(--input-bg); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:28px; flex-shrink:0; border:1px solid var(--border);">💻</div>
                                    <span style="font-weight:700; font-size:14px; color:var(--text); line-height:1.4;">{{ $item['nombre'] }}</span>
                                </div>
                            </td>
                            <td style="text-align:center; color:var(--muted);">S/ {{ number_format($item['precio'],2) }}</td>
                            <td style="text-align:center;">
                                <span style="display:inline-block; padding:6px 16px; background:var(--input-bg); border:1px solid var(--border); border-radius:12px; font-weight:800; color:var(--primary); font-size:14px;">{{ $item['cantidad'] }}</span>
                            </td>
                            <td style="text-align:center; font-weight:900; color:var(--primary); font-size:16px; font-family:'Segoe UI', sans-serif;">S/ {{ number_format($item['precio']*$item['cantidad'],2) }}</td>
                            <td style="text-align:center;">
                                <form action="{{ route('carrito.destroy',$id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger-icon" title="Eliminar del carrito">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <a href="/" style="display:inline-flex; align-items:center; gap:8px; font-size:14px; color:var(--primary); font-weight:700; text-decoration:none;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Continuar Comprando
            </a>
        </div>

        {{-- RESUMEN Y CHECKOUT (Alpine.js Integrado) --}}
        <div style="width:100%; lg:max-width:400px; flex-shrink:0;" class="animate-card" style="animation-delay: 0.3s;">

            <form action="{{ route('pago.procesar') }}" method="POST" x-data="{
                tipo_doc: 'dni',
                entrega: 'delivery',
                metodo_pago: 'tarjeta',
                rol: '{{ $rolUsuario }}'
            }">
                @csrf

                <div class="glass-card" style="border-top:4px solid var(--primary);">

                    <div style="padding:24px; border-bottom:1px solid var(--border);">
                        <h2 style="font-size:18px; font-weight:900; color:var(--text); display:flex; align-items:center; gap:10px;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Resumen y Pago
                        </h2>
                    </div>

                    {{-- 1. Tipo de Comprobante --}}
                    <div class="checkout-section">
                        <div class="checkout-title">1. Tipo de Comprobante</div>
                        <div class="toggle-group">
                            <div class="toggle-btn" :class="tipo_doc === 'dni' ? 'active' : ''" @click="tipo_doc = 'dni'">Boleta (DNI)</div>
                            <div class="toggle-btn" :class="tipo_doc === 'ruc' ? 'active' : ''" @click="tipo_doc = 'ruc'">Factura (RUC)</div>
                        </div>
                        <input type="hidden" name="tipo_doc" :value="tipo_doc">

                        {{-- Campos DNI --}}
                        <div x-show="tipo_doc === 'dni'" x-transition.opacity>
                            <div class="cp-input-group">
                                <label>DNI</label>
                                <input type="text" name="dni" class="cp-input" placeholder="Número de DNI" maxlength="8">
                            </div>
                            <div class="cp-input-group">
                                <label>Nombre Completo</label>
                                <input type="text" name="nombre" class="cp-input" placeholder="Nombres y Apellidos">
                            </div>
                        </div>

                        {{-- Campos RUC --}}
                        <div x-show="tipo_doc === 'ruc'" x-transition.opacity style="display: none;">
                            <div class="cp-input-group">
                                <label>RUC</label>
                                <input type="text" name="ruc" class="cp-input" placeholder="Número de RUC" maxlength="11">
                            </div>
                            <div class="cp-input-group">
                                <label>Razón Social</label>
                                <input type="text" name="razon_social" class="cp-input" placeholder="Nombre de la Empresa">
                            </div>
                        </div>
                    </div>

                    {{-- 2. Método de Entrega --}}
                    <div class="checkout-section">
                        <div class="checkout-title">2. Método de Entrega</div>
                        <div class="toggle-group">
                            <div class="toggle-btn" :class="entrega === 'delivery' ? 'active' : ''" @click="entrega = 'delivery'">Envío a Domicilio</div>
                            <div class="toggle-btn" :class="entrega === 'recojo' ? 'active' : ''" @click="entrega = 'recojo'">Recojo en Tienda</div>
                        </div>
                        <input type="hidden" name="entrega" :value="entrega">

                        <div class="cp-input-group">
                            <label>Teléfono de Contacto</label>
                            <input type="text" name="telefono" class="cp-input" placeholder="Celular para coordinar">
                        </div>

                        {{-- Campos Delivery --}}
                        <div x-show="entrega === 'delivery'" x-transition.opacity>
                            <div class="cp-input-group">
                                <label>Dirección Exacta</label>
                                <input type="text" name="direccion" class="cp-input" placeholder="Av. / Calle / N° / Distrito">
                            </div>
                            <div class="cp-input-group">
                                <label>Referencias</label>
                                <input type="text" name="referencia" class="cp-input" placeholder="Ej. Cerca al parque...">
                            </div>
                        </div>

                        {{-- Info Recojo --}}
                        <div x-show="entrega === 'recojo'" x-transition.opacity style="display: none;">
                            <div style="background:rgba(59,130,246,0.1); border:1px solid rgba(59,130,246,0.2); padding:16px; border-radius:12px; margin-bottom:16px;">
                                <div style="font-weight:800; color:var(--primary); font-size:13px; margin-bottom:4px;">📍 Dirección de Tienda</div>
                                <div style="color:var(--text); font-size:13px; font-weight:600;">Av. Tecnología 123, Centro de Lima.</div>
                                <div style="color:var(--muted); font-size:12px; margin-top:4px;">Presentar comprobante digital al recoger.</div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. Método de Pago (Roles) --}}
                    <div class="checkout-section">
                        <div class="checkout-title">3. Método de Pago</div>

                        <label style="display:flex; align-items:center; gap:12px; padding:16px; border:2px solid var(--border); border-radius:12px; cursor:pointer; margin-bottom:10px; transition:all 0.2s;" :style="metodo_pago === 'tarjeta' ? 'border-color:var(--primary); background:rgba(59,130,246,0.05);' : ''">
                            <input type="radio" name="metodo_pago" value="tarjeta" x-model="metodo_pago" style="accent-color:var(--primary); width:18px; height:18px;">
                            <span style="font-size:24px;">💳</span>
                            <div>
                                <div style="font-weight:800; font-size:14px; color:var(--text);">Pago con Tarjeta Online</div>
                                <div style="font-size:12px; color:var(--muted); font-weight:600;">Débito / Crédito / Yape</div>
                            </div>
                        </label>

                        {{-- Opción Efectivo solo para Admin o Ventas --}}
                        <div x-show="rol === 'admin' || rol === 'ventas'">
                            <label style="display:flex; align-items:center; gap:12px; padding:16px; border:2px solid var(--border); border-radius:12px; cursor:pointer; transition:all 0.2s;" :style="metodo_pago === 'efectivo' ? 'border-color:var(--success); background:rgba(16,185,129,0.05);' : ''">
                                <input type="radio" name="metodo_pago" value="efectivo" x-model="metodo_pago" style="accent-color:var(--success); width:18px; height:18px;">
                                <span style="font-size:24px;">💵</span>
                                <div>
                                    <div style="font-weight:800; font-size:14px; color:var(--text);">Efectivo (Caja)</div>
                                    <div style="font-size:12px; color:var(--success); font-weight:700;">Habilitado para tu rol: <span x-text="rol.toUpperCase()"></span></div>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Totales --}}
                    <div style="padding:24px; background:var(--card);">
                        <div style="display:flex; justify-content:space-between; font-size:14px; color:var(--muted); font-weight:600; margin-bottom:12px;">
                            <span>Subtotal ({{ count($carrito) }} items)</span>
                            <span style="color:var(--text);">S/ {{ number_format($total,2) }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; font-size:14px; color:var(--muted); font-weight:600; margin-bottom:20px; padding-bottom:20px; border-bottom:1px dashed var(--border);">
                            <span>Descuentos</span>
                            <span style="color:var(--success);">S/ 0.00</span>
                        </div>

                        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:24px;">
                            <span style="font-weight:800; color:var(--text); font-size:16px; text-transform:uppercase;">Total</span>
                            <span style="font-family:'Segoe UI', sans-serif; font-size:28px; font-weight:900; color:var(--primary);">S/ {{ number_format($total,2) }}</span>
                        </div>

                        <button type="submit" class="btn-mega" :style="metodo_pago === 'efectivo' ? 'background:linear-gradient(135deg, #10b981, #059669); box-shadow:0 4px 15px rgba(16,185,129,0.4);' : ''">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <span x-text="metodo_pago === 'efectivo' ? 'COBRAR EN EFECTIVO' : 'PAGAR SEGURO'"></span>
                        </button>

                        <div style="text-align:center; font-size:12px; color:var(--muted); font-weight:600; margin-top:16px;">
                            🔒 Transacción 100% encriptada y segura.
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
    @endif
</div>
@endsection
