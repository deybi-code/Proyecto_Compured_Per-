@extends('layouts.main')

@section('title', 'Compured Perú – Tecnología Informática a tu Alcance')

@section('content')

<style>
    /* Variables y diseño base sincronizado con Login */
    :root {
        --bg: #f0f4ff; --card: rgba(255,255,255,0.92); --text: #0f172a; --muted: #64748b;
        --border: #cbd5e1; --input-bg: #f8fafc; --primary: #1d4ed8; --primary-hover: #1e40af;
        --accent: #3b82f6; --shadow: 0 25px 60px rgba(0,0,0,0.18); --error: #dc2626;
    }
    [data-theme="dark"] {
        --bg: #0a0f1e; --card: rgba(15,23,42,0.93); --text: #f1f5f9; --muted: #94a3b8;
        --border: #1e3a5f; --input-bg: #0f172a; --primary: #3b82f6; --primary-hover: #2563eb;
        --accent: #60a5fa; --shadow: 0 25px 60px rgba(0,0,0,0.6); --error: #f87171;
    }

    .hero-scene {
        position: relative; overflow: hidden;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 40%, #1d4ed8 70%, #0f172a 100%);
        transition: all 0.4s;
    }
    [data-theme="dark"] .hero-scene {
        background: linear-gradient(135deg, #020617 0%, #0f172a 40%, #1e3a5f 70%, #020617 100%);
    }
    .hero-grid {
        position: absolute; inset: 0; z-index: 1; pointer-events: none;
        background-image: linear-gradient(rgba(59,130,246,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(59,130,246,0.05) 1px, transparent 1px);
        background-size: 50px 50px;
    }
    .hero-circles span {
        position: absolute; border-radius: 50%; background: rgba(59,130,246,0.1);
        animation: floatUp linear infinite; z-index: 1; pointer-events: none;
    }
    .hero-circles span:nth-child(1) { width:120px; height:120px; left:10%; animation-duration:14s; }
    .hero-circles span:nth-child(2) { width:60px; height:60px; left:40%; animation-duration:9s; animation-delay:2s; }
    .hero-circles span:nth-child(3) { width:90px; height:90px; left:80%; animation-duration:12s; animation-delay:1s; }
    @keyframes floatUp { 0% { transform:translateY(110vh) rotate(0deg); opacity:0; } 10% { opacity:1; } 90% { opacity:1; } 100% { transform:translateY(-10vh) rotate(720deg); opacity:0; } }

    .glass-card {
        background: var(--card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(59,130,246,0.2); border-radius: 16px;
        box-shadow: var(--shadow); transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
        color: var(--text);
    }
    .glass-card:hover {
        transform: translateY(-5px); box-shadow: 0 30px 60px rgba(29,78,216,0.25);
    }

    .btn-mega {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        width: 100%; padding: 12px; background: linear-gradient(135deg, var(--primary), #2563eb);
        border: none; border-radius: 10px; color: white !important; font-size: 14px; font-weight: 700;
        cursor: pointer; letter-spacing: 0.5px; text-transform: uppercase; transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(29,78,216,0.4); text-decoration: none;
    }
    .btn-mega:hover {
        transform: translateY(-1px); box-shadow: 0 6px 20px rgba(29,78,216,0.5);
    }
    .btn-outline-mega {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 12px 24px; background: transparent; border: 2px solid rgba(255,255,255,0.5);
        border-radius: 10px; color: white !important; font-size: 14px; font-weight: 700;
        cursor: pointer; letter-spacing: 0.5px; text-transform: uppercase; transition: all 0.3s; text-decoration: none;
    }
    .btn-outline-mega:hover {
        background: rgba(255,255,255,0.1); border-color: white;
    }

    .cat-sidebar-title {
        background: linear-gradient(135deg, var(--primary), #2563eb);
        color: white; font-weight: 800; padding: 16px 20px;
        border-radius: 16px 16px 0 0; text-transform: uppercase; letter-spacing: 0.5px;
    }
    .cat-item {
        display: flex; justify-content: space-between; align-items: center;
        padding: 14px 20px; color: var(--text); font-weight: 600; font-size: 13px;
        border-bottom: 1px solid var(--border); text-decoration: none; transition: all 0.3s;
    }
    .cat-item:hover { background: rgba(59,130,246,0.08); color: var(--primary); padding-left: 24px; }
    .cat-item:last-child { border-bottom: none; border-radius: 0 0 16px 16px; }

    .product-img-wrap {
        position: relative; border-radius: 16px 16px 0 0; overflow: hidden;
        background: var(--input-bg); padding: 20px; text-align: center;
        border-bottom: 1px solid var(--border);
    }
    .product-img-wrap img { max-width: 100%; height: 180px; object-fit: contain; transition: transform 0.4s ease; }
    .glass-card:hover .product-img-wrap img { transform: scale(1.08); }

    .product-body { padding: 20px; display: flex; flex-direction: column; height: 100%; }
    .product-name { font-size: 14px; font-weight: 700; margin-bottom: 8px; color: var(--text); line-height: 1.4; flex-grow: 1; }
    .product-price { font-size: 22px; font-weight: 800; color: var(--primary); margin-bottom: 12px; }

    .badge-new { position: absolute; top: 12px; left: 12px; padding: 4px 10px; background: var(--primary); color: white; border-radius: 8px; font-size: 11px; font-weight: 800; letter-spacing: 1px; z-index: 10; }
    .badge-offer { position: absolute; top: 12px; left: 12px; padding: 4px 10px; background: var(--error); color: white; border-radius: 8px; font-size: 11px; font-weight: 800; letter-spacing: 1px; z-index: 10; }

    .section-title { font-size: 24px; font-weight: 800; color: var(--text); display: flex; align-items: center; gap: 10px; }
</style>

{{-- ===== HERO / BANNER ===== --}}
<div class="hero-scene w-full" style="min-height:380px; display:flex; align-items:center; border-radius:0 0 30px 30px; box-shadow:var(--shadow); margin-bottom:40px;">
    <div class="hero-grid"></div>
    <div class="hero-circles"><span></span><span></span><span></span></div>

    @if(isset($anuncios) && $anuncios->count())
        <div class="max-w-7xl mx-auto px-4 w-full z-10" x-data="{ slide: 0 }" x-init="setInterval(() => slide = (slide + 1) % {{ $anuncios->count() }}, 4000)">
            @foreach($anuncios as $i => $anuncio)
            <div x-show="slide === {{ $i }}" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="display:flex; flex-wrap:wrap; align-items:center; gap:30px;">
                @if($anuncio->imagen_url)
                    <div style="flex:1; min-width:300px;">
                        <img src="{{ $anuncio->imagen_url }}" alt="{{ $anuncio->titulo }}" style="width:100%; max-height:320px; object-fit:cover; border-radius:20px; border:4px solid rgba(255,255,255,0.1); box-shadow:0 20px 40px rgba(0,0,0,0.3);">
                    </div>
                @endif
                <div style="flex:1; min-width:300px; padding:40px; background:rgba(255,255,255,0.05); backdrop-filter:blur(10px); border-radius:20px; border:1px solid rgba(255,255,255,0.1);">
                    <h2 style="font-family:'Segoe UI',sans-serif; font-size:2.5rem; font-weight:800; color:white; margin-bottom:16px; line-height:1.2;">{{ $anuncio->titulo }}</h2>
                    <a href="/buscar" class="btn-mega" style="width:auto; padding:12px 30px;">Descubrir más 🚀</a>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="max-w-7xl mx-auto px-4 w-full z-10" style="padding:60px 20px; text-align:center;">
            <div style="display:inline-block; padding:6px 16px; background:rgba(59,130,246,0.2); border:1px solid rgba(59,130,246,0.3); color:var(--accent); font-size:12px; font-weight:800; letter-spacing:2px; text-transform:uppercase; border-radius:20px; margin-bottom:20px; backdrop-filter:blur(5px);">
                ✦ Tecnología Informática a tu Alcance ✦
            </div>
            <h1 style="font-family:'Segoe UI',sans-serif; font-size:clamp(2rem, 5vw, 3.5rem); font-weight:800; color:white; line-height:1.15; margin-bottom:20px; text-shadow:0 10px 30px rgba(0,0,0,0.3);">
                Computadoras, Laptops<br><span style="color:var(--accent);">y Accesorios en TRUJILLO</span>
            </h1>
            <p style="color:rgba(255,255,255,0.7); font-size:16px; max-width:600px; margin:0 auto 30px auto;">Los mejores precios en tecnología informática con calidad garantizada. Envíos seguros a todo el Perú.</p>
            <div style="display:flex; justify-content:center; gap:16px; flex-wrap:wrap;">
                <a href="/categoria/computadoras" class="btn-mega" style="width:auto; padding:14px 32px;">🔥 Ver computadoras</a>
                <a href="/categoria/laptops" class="btn-outline-mega">💻 Ver laptops</a>
            </div>
        </div>
    @endif
</div>

{{-- ===== BRANDS ===== --}}
<div style="max-width:1280px; margin:0 auto 40px auto; padding:0 16px;">
    <div class="glass-card" style="padding:24px 32px; display:flex; align-items:center; justify-content:space-between; gap:24px; overflow-x:auto;">
        <img src="{{ asset('img/marca1.jpg') }}" alt="Marca" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.parentElement.style.display='none'">
        <img src="{{ asset('img/marca2.jpg') }}" alt="Marca" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
        <img src="{{ asset('img/marca3.jpg') }}" alt="Marca" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
        <img src="{{ asset('img/marca4.jpg') }}" alt="Marca" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
        <img src="{{ asset('img/marca5.jpg') }}" alt="Marca" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
        <span style="font-size:12px; font-weight:700; color:var(--muted); white-space:nowrap;">HP • DELL • LENOVO • ASUS • ACER • INTEL • AMD</span>
    </div>
</div>

{{-- ===== MAIN CONTENT ===== --}}
<div style="max-width:1280px; margin:0 auto; padding:0 16px 60px 16px; display:flex; flex-wrap:wrap; gap:30px;">

    {{-- === SIDEBAR === --}}
    <aside style="width:260px; flex-shrink:0;" class="hidden md:block">
        <div class="glass-card" style="padding:0; margin-bottom:24px; border-top:4px solid var(--primary);">
            <div class="cat-sidebar-title">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline; margin-right:8px; vertical-align:-3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                Categorías Pro
            </div>
            @if(isset($categorias) && $categorias->count())
                @foreach($categorias as $cat)
                <a href="/categoria/{{ Str::slug($cat->nombre_categoria) }}" class="cat-item">
                    {{ $cat->nombre_categoria }}
                    <span style="color:var(--accent);">›</span>
                </a>
                @endforeach
            @else
                <a href="/categoria/computadoras" class="cat-item">Computadoras <span style="color:var(--accent);">›</span></a>
                <a href="/categoria/laptops" class="cat-item">Laptops <span style="color:var(--accent);">›</span></a>
                <a href="/categoria/accesorios" class="cat-item">Accesorios <span style="color:var(--accent);">›</span></a>
                <a href="/categoria/redes" class="cat-item">Redes / Conectividad <span style="color:var(--accent);">›</span></a>
                <a href="/categoria/case" class="cat-item">Cases <span style="color:var(--accent);">›</span></a>
                <a href="/categoria/fuentes" class="cat-item">Fuentes para Case <span style="color:var(--accent);">›</span></a>
                <a href="/categoria/coolers" class="cat-item">Coolers / CPU <span style="color:var(--accent);">›</span></a>
                <a href="/categoria/monitores" class="cat-item">Monitores <span style="color:var(--accent);">›</span></a>
            @endif
        </div>

        <div class="glass-card" style="padding:24px; text-align:center; border-top:4px solid #10b981;">
            <div style="font-size:32px; margin-bottom:12px; animation:bounce 2s infinite;">💬</div>
            <div style="font-size:12px; font-weight:800; color:#10b981; text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">Asesoría Experta</div>
            <p style="font-size:13px; color:var(--muted); margin-bottom:16px;">¿Dudas armando tu PC? Nuestro equipo te asesora.</p>
            <a href="https://wa.me/51999999999" target="_blank" class="btn-mega" style="background:linear-gradient(135deg, #10b981, #059669); padding:10px; font-size:12px;">
                📲 Chat WhatsApp
            </a>
        </div>
    </aside>

    {{-- === PRODUCTS === --}}
    <section style="flex:1; min-width:0;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; padding-bottom:16px; border-bottom:2px solid var(--border);">
            <h2 class="section-title"><span style="color:var(--accent);">⭐</span> Más Valorados</h2>
            <a href="/buscar" style="font-size:13px; color:var(--primary); font-weight:700; text-decoration:none;">Ver catálogo completo →</a>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:24px;">

            @if(isset($productos) && $productos->count())
                @foreach($productos as $producto)
                <div class="glass-card" style="display:flex; flex-direction:column; border-top:4px solid var(--primary);">
                    <div class="product-img-wrap">
                        @if($producto->mostrar_inicio ?? false)
                        <span class="badge-new">NUEVO</span>
                        @endif
                        @if($producto->imagen ?? false)
                            <img src="{{ str_starts_with($producto->imagen, 'http') ? $producto->imagen : asset('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}" loading="lazy">
                        @elseif($producto->fotos->first() ?? false)
                            <img src="{{ str_starts_with($producto->fotos->first()->ruta_foto, 'http') ? $producto->fotos->first()->ruta_foto : asset('storage/'.$producto->fotos->first()->ruta_foto) }}" alt="{{ $producto->nombre }}" loading="lazy">
                        @else
                            <img src="{{ asset('img/producto.webp') }}" alt="{{ $producto->nombre }}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22><rect fill=%22%23EBF3FF%22 width=%22200%22 height=%22200%22/><text x=%22100%22 y=%22100%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2240%22>💻</text></svg>'">
                        @endif
                    </div>
                    <div class="product-body">
                        <div style="font-size:11px; font-weight:800; color:var(--accent); text-transform:uppercase; margin-bottom:6px;">{{ $producto->marca ?? 'Compured' }}</div>
                        <div class="product-name" title="{{ $producto->nombre }}">{{ Str::limit($producto->nombre, 50) }}</div>
                        <div class="product-price">S/ {{ number_format($producto->precio, 2) }}</div>
                        <div style="font-size:12px; margin-bottom:16px;">
                            @if(($producto->stock ?? 0) > 0)
                                <span style="color:#10b981; font-weight:700; background:rgba(16,185,129,0.1); padding:4px 8px; border-radius:6px;">✓ Stock Disponible ({{ $producto->stock }})</span>
                            @else
                                <span style="color:var(--error); font-weight:700; background:rgba(220,38,38,0.1); padding:4px 8px; border-radius:6px;">⚠ Agotado temporalmente</span>
                            @endif
                        </div>
                        <div style="display:flex; gap:10px; margin-top:auto;">
                            <form action="{{ route('carrito.store') }}" method="POST" style="flex:1;">
                                @csrf
                                <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">
                                <input type="hidden" name="cantidad" value="1">
                                <button type="submit" class="btn-mega" style="padding:10px;">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </button>
                            </form>
                            <a href="/producto/{{ $producto->id_producto }}" class="btn-mega" style="flex:1; background:transparent; border:2px solid var(--primary); color:var(--primary) !important; padding:8px; box-shadow:none;">
                                Ver
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                @for($i = 0; $i < 6; $i++)
                <div class="glass-card" style="border-top:4px solid var(--border);">
                    <div class="product-img-wrap" style="height:180px; display:flex; align-items:center; justify-content:center; background:var(--input-bg);">
                        <div style="font-size:60px; opacity:0.15;">💻</div>
                    </div>
                    <div class="product-body">
                        <div style="height:12px; width:80%; background:var(--border); border-radius:4px; margin-bottom:8px; opacity:0.5;"></div>
                        <div style="height:12px; width:60%; background:var(--border); border-radius:4px; margin-bottom:12px; opacity:0.5;"></div>
                        <div style="height:24px; width:50%; background:var(--border); border-radius:4px; margin-bottom:16px; opacity:0.7;"></div>
                        <div style="height:40px; width:100%; background:var(--input-bg); border-radius:10px; margin-top:auto;"></div>
                    </div>
                </div>
                @endfor
            @endif
        </div>

        {{-- Más productos / Ofertas --}}
        @if(isset($productos) && $productos->count())
        <div style="margin-top:48px; padding-top:32px; border-top:2px solid var(--border);">
            <h2 class="section-title" style="margin-bottom:24px;"><span style="color:var(--error);">🔥</span> Ofertas del día</h2>
            <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:24px;">
                @foreach($productos->take(4) as $producto)
                <div class="glass-card" style="border-top:4px solid var(--error);">
                    <div class="product-img-wrap">
                        <span class="badge-offer">OFERTA</span>
                        <img src="{{ asset('img/producto.webp') }}" alt="{{ $producto->nombre }}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22><rect fill=%22%23FFF1F0%22 width=%22200%22 height=%22200%22/><text x=%22100%22 y=%22100%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2240%22>🖥️</text></svg>'">
                    </div>
                    <div class="product-body">
                        <div class="product-name" title="{{ $producto->nombre }}">{{ Str::limit($producto->nombre, 45) }}</div>
                        <div class="product-price" style="color:var(--error); font-size:20px; margin-bottom:4px;">S/ {{ number_format($producto->precio * 0.9, 2) }}</div>
                        <div style="font-size:12px; color:var(--muted); text-decoration:line-through; margin-bottom:16px;">S/ {{ number_format($producto->precio, 2) }}</div>
                        <form action="{{ route('carrito.store') }}" method="POST" style="margin-top:auto;">
                            @csrf
                            <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn-mega" style="background:linear-gradient(135deg, #ef4444, #dc2626);">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Agregar
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </section>
</div>

{{-- ===== FEATURES STRIP ===== --}}
<div class="hero-scene" style="margin-top:20px; padding:48px 16px; border-radius:30px 30px 0 0;">
    <div class="hero-grid"></div>
    <div style="max-width:1280px; margin:0 auto; display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:32px; text-align:center; position:relative; z-index:10;">
        <div style="background:rgba(255,255,255,0.05); backdrop-filter:blur(10px); padding:24px; border-radius:20px; border:1px solid rgba(255,255,255,0.1);">
            <div style="font-size:36px; margin-bottom:16px;">🚚</div>
            <div style="font-weight:800; font-size:15px; color:white; margin-bottom:6px;">Envío a TRUJILLO</div>
            <div style="font-size:13px; color:rgba(255,255,255,0.6);">Delivery rápido y seguro</div>
        </div>
        <div style="background:rgba(255,255,255,0.05); backdrop-filter:blur(10px); padding:24px; border-radius:20px; border:1px solid rgba(255,255,255,0.1);">
            <div style="font-size:36px; margin-bottom:16px;">🛡️</div>
            <div style="font-weight:800; font-size:15px; color:white; margin-bottom:6px;">Garantía oficial</div>
            <div style="font-size:13px; color:rgba(255,255,255,0.6);">Productos 100% originales</div>
        </div>
        <div style="background:rgba(255,255,255,0.05); backdrop-filter:blur(10px); padding:24px; border-radius:20px; border:1px solid rgba(255,255,255,0.1);">
            <div style="font-size:36px; margin-bottom:16px;">💳</div>
            <div style="font-weight:800; font-size:15px; color:white; margin-bottom:6px;">Pago seguro</div>
            <div style="font-size:13px; color:rgba(255,255,255,0.6);">Múltiples métodos cifrados</div>
        </div>
        <div style="background:rgba(255,255,255,0.05); backdrop-filter:blur(10px); padding:24px; border-radius:20px; border:1px solid rgba(255,255,255,0.1);">
            <div style="font-size:36px; margin-bottom:16px;">🔧</div>
            <div style="font-weight:800; font-size:15px; color:white; margin-bottom:6px;">Soporte técnico</div>
            <div style="font-size:13px; color:rgba(255,255,255,0.6);">Atención personalizada Pro</div>
        </div>
    </div>
</div>

@endsection
