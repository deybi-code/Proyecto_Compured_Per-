@extends('layouts.main')

@section('title', (isset($producto) ? $producto->nombre : 'Detalle') . ' – Compured Perú')

@section('content')

<style>
    /* Variables sincronizadas con Login, Index, Dashboard, Categoría, etc. */
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

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-block { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }

    /* Breadcrumb Pro */
    .modern-breadcrumb {
        display: flex; align-items: center; flex-wrap: wrap; gap: 8px; font-size: 13px; font-weight: 600;
        color: var(--muted); margin-bottom: 24px; padding: 12px 20px;
        background: var(--card); backdrop-filter: blur(20px); border: 1px solid var(--border);
        border-radius: 12px; width: fit-content; box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .modern-breadcrumb a { color: var(--primary); text-decoration: none; transition: color 0.2s; }
    .modern-breadcrumb a:hover { color: var(--primary-hover); text-decoration: underline; }
    .modern-breadcrumb span.sep { color: var(--border); }

    /* Tarjetas Glassmorphism */
    .glass-card {
        background: var(--card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(59,130,246,0.2); border-radius: 20px;
        box-shadow: var(--shadow); color: var(--text); overflow: hidden;
    }
    .glass-card-top { border-top: 4px solid var(--primary); }

    /* Galería de Imagen */
    .product-gallery {
        background: var(--input-bg); border-radius: 16px; padding: 40px;
        display: flex; align-items: center; justify-content: center;
        border: 1px solid var(--border); position: relative; overflow: hidden;
    }
    .product-gallery::before {
        content: ''; position: absolute; inset: 0; pointer-events: none;
        background-image: radial-gradient(rgba(59,130,246,0.1) 1px, transparent 1px); background-size: 20px 20px;
    }
    .product-gallery img {
        max-width: 100%; max-height: 400px; object-fit: contain;
        transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1); position: relative; z-index: 2;
    }
    .product-gallery:hover img { transform: scale(1.08); }

    /* Detalles del Producto */
    .product-brand { font-size: 12px; font-weight: 800; color: var(--accent); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
    .product-title { font-family: 'Segoe UI', system-ui, sans-serif; font-size: clamp(1.5rem, 3vw, 2.2rem); font-weight: 900; line-height: 1.2; margin-bottom: 16px; color: var(--text); }
    .product-price-box { display: flex; align-items: baseline; gap: 12px; margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid var(--border); }
    .product-price { font-size: 2.5rem; font-weight: 900; color: var(--primary); font-family: 'Segoe UI', system-ui, sans-serif; }

    .status-badge { display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 8px; font-size: 13px; font-weight: 700; }
    .status-in-stock { background: rgba(16,185,129,0.1); color: var(--success); border: 1px solid rgba(16,185,129,0.2); }
    .status-out-stock { background: rgba(239,68,68,0.1); color: var(--danger); border: 1px solid rgba(239,68,68,0.2); }

    /* Controles de Compra */
    .quantity-control {
        display: flex; align-items: center; border: 2px solid var(--border); border-radius: 12px;
        background: var(--input-bg); overflow: hidden; width: fit-content;
    }
    .quantity-btn {
        background: transparent; border: none; color: var(--text); font-size: 18px; font-weight: 700;
        width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: background 0.2s;
    }
    .quantity-btn:hover { background: rgba(59,130,246,0.1); color: var(--primary); }
    .quantity-input {
        width: 50px; text-align: center; border: none; background: transparent;
        font-size: 16px; font-weight: 700; color: var(--text); outline: none;
        -moz-appearance: textfield;
    }
    .quantity-input::-webkit-outer-spin-button, .quantity-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }

    /* Botones Pro */
    .btn-mega {
        display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        padding: 16px 32px; background: linear-gradient(135deg, var(--primary), #2563eb);
        border: none; border-radius: 12px; color: white !important; font-size: 16px; font-weight: 800;
        cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(29,78,216,0.4); width: 100%;
    }
    .btn-mega:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(29,78,216,0.5); }
    .btn-mega:disabled { background: var(--muted); cursor: not-allowed; transform: none; box-shadow: none; opacity: 0.7; }

    /* Tabs Interactivos */
    .tabs-header { display: flex; overflow-x: auto; border-bottom: 2px solid var(--border); margin-bottom: 24px; gap: 8px; padding-bottom: 8px; }
    .tab-btn {
        background: transparent; border: none; padding: 12px 24px; font-size: 14px; font-weight: 700;
        color: var(--muted); cursor: pointer; border-radius: 10px; transition: all 0.3s;
        white-space: nowrap;
    }
    .tab-btn:hover { background: rgba(59,130,246,0.05); color: var(--primary); }
    .tab-btn.active { background: var(--primary); color: white; box-shadow: 0 4px 15px rgba(29,78,216,0.3); }

    .tab-content { color: var(--muted); font-size: 15px; line-height: 1.8; }
    .tab-content h3 { color: var(--text); font-size: 18px; font-weight: 800; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
    .tab-content ul { list-style: none; padding: 0; display: flex; flex-direction: column; gap: 12px; }
    .tab-content ul li { display: flex; align-items: flex-start; gap: 10px; }
    .tab-content ul li::before { content: '✓'; color: var(--primary); font-weight: 800; }

    /* Inputs Comentarios */
    .cp-input {
        width: 100%; padding: 16px; border: 2px solid var(--border); background: var(--input-bg);
        color: var(--text); border-radius: 12px; font-size: 14px; font-family: inherit; transition: all 0.3s;
    }
    .cp-input:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(59,130,246,0.1); outline: none; }
</style>

<div class="max-w-7xl mx-auto px-4 py-8 relative">

    {{-- Decorative Background Glow --}}
    <div style="position:absolute; top:10%; right:10%; width:400px; height:400px; background:radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 70%); border-radius:50%; pointer-events:none; z-index:-1;"></div>

    {{-- Breadcrumb --}}
    <nav class="modern-breadcrumb animate-block" style="animation-delay: 0s;">
        <a href="/">Inicio</a>
        <span class="sep">›</span>
        @if(isset($producto) && $producto->categoria)
        <a href="/categoria/{{ Str::slug($producto->categoria->nombre_categoria) }}">{{ $producto->categoria->nombre_categoria }}</a>
        <span class="sep">›</span>
        @endif
        <span style="color:var(--text);">{{ isset($producto) ? Str::limit($producto->nombre, 40) : 'Producto' }}</span>
    </nav>

    {{-- Componente Principal Alpine.js --}}
    <div x-data="{ cantidad: 1, tab: 'descripcion', imgSrc: '{{ isset($producto) && ($producto->imagen ?? false) ? (str_starts_with($producto->imagen, 'http') ? $producto->imagen : asset('storage/'.$producto->imagen)) : asset('img/producto.webp') }}' }" class="animate-block" style="animation-delay: 0.1s;">

        <div class="glass-card glass-card-top p-6 md:p-10 mb-8">
            <div class="flex flex-col lg:flex-row gap-10">

                {{-- ===== IMAGEN DEL PRODUCTO ===== --}}
                <div class="w-full lg:w-1/2">
                    <div class="product-gallery">
                        @if(isset($producto) && $producto->mostrar_inicio)
                            <span style="position:absolute; top:20px; left:20px; z-index:10; background:var(--primary); color:white; padding:6px 14px; border-radius:10px; font-size:12px; font-weight:800; letter-spacing:1px; box-shadow:0 4px 10px rgba(0,0,0,0.2);">NUEVO</span>
                        @endif
                        <img :src="imgSrc" alt="{{ isset($producto) ? $producto->nombre : 'Producto' }}" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22><rect fill=%22%23EBF3FF%22 width=%22200%22 height=%22200%22/><text x=%22100%22 y=%22100%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2240%22>💻</text></svg>'">
                    </div>
                </div>

                {{-- ===== INFO DEL PRODUCTO ===== --}}
                <div class="w-full lg:w-1/2 flex flex-col justify-center">

                    <div class="product-brand">{{ $producto->marca ?? 'Compured Exclusivo' }}</div>
                    <h1 class="product-title">{{ isset($producto) ? $producto->nombre : 'Nombre del Producto' }}</h1>

                    <div class="flex items-center gap-4 mb-6">
                        @if(($producto->stock ?? 0) > 0)
                            <span class="status-badge status-in-stock">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="mr-2"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Stock Disponible ({{ $producto->stock }})
                            </span>
                        @else
                            <span class="status-badge status-out-stock">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="mr-2"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                Agotado Temporalmente
                            </span>
                        @endif
                        <span style="font-size:13px; color:var(--muted); font-weight:600; display:flex; align-items:center; gap:4px;">
                            <span style="color:#fbbf24;">★★★★★</span> (0 Reseñas)
                        </span>
                    </div>

                    <div class="product-price-box">
                        <span class="product-price">S/ {{ isset($producto) ? number_format($producto->precio, 2) : '0.00' }}</span>
                        <span style="font-size:14px; color:var(--muted); font-weight:600;">Incluye IGV</span>
                    </div>

                    <p style="color:var(--muted); font-size:15px; line-height:1.6; margin-bottom:32px;">
                        {{ isset($producto) && $producto->descripcion ? Str::limit(strip_tags($producto->descripcion), 150) : 'Equipa tu setup con la mejor tecnología. Garantía oficial y envío seguro a todo el Perú.' }}
                    </p>

                    {{-- Formulario Agregar al Carrito --}}
                    <form action="{{ route('carrito.store') }}" method="POST" class="mt-auto">
                        @csrf
                        @if(isset($producto))
                            <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">
                        @endif

                        <div class="flex flex-col sm:flex-row gap-4 mb-6">
                            <div>
                                <label style="display:block; font-size:12px; font-weight:700; color:var(--muted); text-transform:uppercase; margin-bottom:8px;">Cantidad</label>
                                <div class="quantity-control">
                                    <button type="button" class="quantity-btn" @click="if(cantidad > 1) cantidad--">−</button>
                                    <input type="number" name="cantidad" x-model="cantidad" class="quantity-input" min="1" max="{{ $producto->stock ?? 1 }}">
                                    <button type="button" class="quantity-btn" @click="if(cantidad < {{ $producto->stock ?? 1 }}) cantidad++">+</button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-mega" {{ ($producto->stock ?? 0) < 1 ? 'disabled' : '' }}>
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            {{ ($producto->stock ?? 0) > 0 ? 'Agregar al Carrito' : 'Sin Stock' }}
                        </button>
                    </form>

                    <div style="display:flex; align-items:center; gap:24px; margin-top:32px; padding-top:24px; border-top:1px solid var(--border);">
                        <div style="display:flex; align-items:center; gap:8px; font-size:13px; font-weight:600; color:var(--muted);">
                            <span style="font-size:20px;">🛡️</span> Garantía de 1 año
                        </div>
                        <div style="display:flex; align-items:center; gap:8px; font-size:13px; font-weight:600; color:var(--muted);">
                            <span style="font-size:20px;">🚚</span> Envío a todo el Perú
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ===== TABS DE INFORMACIÓN ===== --}}
        <div class="glass-card p-6 md:p-10 animate-block" style="animation-delay: 0.2s;">

            <div class="tabs-header">
                <button @click="tab = 'descripcion'" :class="{ 'active': tab === 'descripcion' }" class="tab-btn">Descripción</button>
                <button @click="tab = 'especificaciones'" :class="{ 'active': tab === 'especificaciones' }" class="tab-btn">Especificaciones</button>
                <button @click="tab = 'politica'" :class="{ 'active': tab === 'politica' }" class="tab-btn">Garantía y Devolución</button>
                <button @click="tab = 'comentarios'" :class="{ 'active': tab === 'comentarios' }" class="tab-btn">Comentarios</button>
            </div>

            <div class="tab-content mt-6">

                <div x-show="tab === 'descripcion'" x-transition.opacity>
                    <h3><span style="color:var(--primary);">📄</span> Detalles del Producto</h3>
                    @if(isset($producto) && $producto->descripcion)
                        <div style="color:var(--text); line-height:1.8;">
                            {!! $producto->descripcion !!}
                        </div>
                    @else
                        <p>No hay descripción detallada disponible para este producto.</p>
                    @endif
                </div>

                <div x-show="tab === 'especificaciones'" x-transition.opacity x-cloak>
                    <h3><span style="color:var(--primary);">⚙️</span> Características Técnicas</h3>
                    <ul>
                        <li>Marca: <strong>{{ $producto->marca ?? 'No especificada' }}</strong></li>
                        <li>Categoría: <strong>{{ $producto->categoria->nombre_categoria ?? 'General' }}</strong></li>
                        <li>Estado: <strong>Nuevo, en caja sellada</strong></li>
                    </ul>
                </div>

                <div x-show="tab === 'politica'" x-transition.opacity x-cloak>
                    <h3><span style="color:var(--primary);">🛡️</span> Política de Compra y Devolución</h3>
                    <ul>
                        <li>7 días para devoluciones exclusivas por fallas de fábrica, presentando comprobante original (Boleta/Factura).</li>
                        <li>El producto debe ser devuelto en su empaque original, con todos sus manuales y accesorios intactos.</li>
                        <li>Los daños ocasionados por mal uso, overclocking, golpes o instalación eléctrica defectuosa no están cubiertos.</li>
                        <li>Para iniciar un proceso de garantía, contáctanos directamente a través de nuestros canales de atención (WhatsApp o Correo).</li>
                    </ul>
                </div>

                <div x-show="tab === 'comentarios'" x-transition.opacity x-cloak>
                    <div style="display:grid; grid-template-columns:1fr; md:grid-template-columns:2fr 1fr; gap:32px;">
                        <div>
                            <h3><span style="color:var(--primary);">⭐</span> Reseñas de Clientes</h3>
                            <div style="padding:40px; text-align:center; background:var(--input-bg); border-radius:12px; border:1px dashed var(--border);">
                                <div style="font-size:40px; margin-bottom:16px; opacity:0.5;">💬</div>
                                <p style="font-weight:600; color:var(--text);">No hay reseñas todavía.</p>
                                <p style="font-size:13px;">¡Sé el primero en opinar sobre este producto!</p>
                            </div>
                        </div>
                        <div>
                            <h3 style="font-size:16px;">Escribe un comentario</h3>
                            <textarea class="cp-input" rows="4" placeholder="Comparte tu experiencia con este producto..." style="resize:vertical; margin-bottom:16px;"></textarea>
                            <button class="btn-mega" style="padding:12px; font-size:14px; width:auto; display:inline-flex;">Publicar Comentario</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
