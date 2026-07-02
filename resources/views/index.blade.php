@extends('layouts.main')

@section('title', 'Compured Perú – Tecnología Informática a tu Alcance')

@section('content')

<style>
    .hero-scene {
        position: relative;
        overflow: hidden;
        min-height: 380px;
        display: flex;
        align-items: center;
        border-radius: 0 0 30px 30px;
        box-shadow: var(--shadow);
        margin-bottom: 40px;
    }
    .hero-circles span {
        position: absolute;
        border-radius: 50%;
        background: rgba(0, 82, 204, 0.1);
        animation: floatUp linear infinite;
        z-index: 1;
        pointer-events: none;
    }
    html.dark .hero-circles span,
    html[data-theme="dark"] .hero-circles span {
        background: rgba(38, 132, 255, 0.12);
    }
    .hero-circles span:nth-child(1) { width:120px; height:120px; left:10%; animation-duration:14s; }
    .hero-circles span:nth-child(2) { width:60px; height:60px; left:40%; animation-duration:9s; animation-delay:2s; }
    .hero-circles span:nth-child(3) { width:90px; height:90px; left:80%; animation-duration:12s; animation-delay:1s; }
    @keyframes floatUp { 0% { transform:translateY(110vh) rotate(0deg); opacity:0; } 10% { opacity:1; } 90% { opacity:1; } 100% { transform:translateY(-10vh) rotate(720deg); opacity:0; } }

    .glass-card {
        background: var(--card);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 82, 204, 0.14);
        border-radius: 16px;
        box-shadow: var(--shadow);
        transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
        color: var(--text);
    }
    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0, 82, 204, 0.15);
    }

    .btn-mega {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, var(--primary), var(--cp-blue-light, #2684FF));
        border: none;
        border-radius: 10px;
        color: white !important;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0, 82, 204, 0.28);
        text-decoration: none;
    }
    .btn-mega:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(0, 82, 204, 0.35);
    }
    .btn-outline-mega {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 24px;
        background: transparent;
        border: 2px solid var(--primary);
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        transition: all 0.3s;
        text-decoration: none;
    }

    .cat-sidebar-title {
        background: linear-gradient(135deg, var(--primary), var(--cp-blue-dark, #003A99));
        color: white;
        font-weight: 800;
        padding: 16px 20px;
        border-radius: 16px 16px 0 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .cat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 20px;
        color: var(--text);
        font-weight: 600;
        font-size: 13px;
        border-bottom: 1px solid var(--border);
        text-decoration: none;
        transition: all 0.3s;
    }
    .cat-item:hover { background: rgba(0, 82, 204, 0.06); color: var(--primary); padding-left: 24px; }
    .cat-item:last-child { border-bottom: none; border-radius: 0 0 16px 16px; }

    .product-img-wrap {
        position: relative;
        border-radius: 16px 16px 0 0;
        overflow: hidden;
        background: var(--input-bg);
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid var(--border);
    }
    .product-img-wrap img { max-width: 100%; height: 180px; object-fit: contain; transition: transform 0.4s ease; }
    .glass-card:hover .product-img-wrap img { transform: scale(1.08); }

    .product-body { padding: 20px; display: flex; flex-direction: column; height: 100%; }
    .product-name { font-size: 14px; font-weight: 700; margin-bottom: 8px; color: var(--text); line-height: 1.4; flex-grow: 1; }
    .product-price { font-size: 22px; font-weight: 800; color: var(--primary); margin-bottom: 12px; }

    .badge-new { position: absolute; top: 12px; left: 12px; padding: 4px 10px; background: var(--cp-green, #8CC63F); color: white; border-radius: 8px; font-size: 11px; font-weight: 800; letter-spacing: 1px; z-index: 10; }
    .badge-offer { position: absolute; top: 12px; left: 12px; padding: 4px 10px; background: var(--primary); color: white; border-radius: 8px; font-size: 11px; font-weight: 800; letter-spacing: 1px; z-index: 10; }

    .section-title { font-size: 24px; font-weight: 800; color: var(--text); display: flex; align-items: center; gap: 10px; }

    .stock-available {
        color: var(--cp-green-dark, #6EA82E);
        font-weight: 700;
        background: rgba(140, 198, 63, 0.12);
        padding: 4px 8px;
        border-radius: 6px;
    }
    .stock-empty {
        color: var(--cp-blue-dark, #003A99);
        font-weight: 700;
        background: rgba(0, 82, 204, 0.08);
        padding: 4px 8px;
        border-radius: 6px;
    }
</style>

@php
    $totalSlides = 1 + (isset($anuncios) ? $anuncios->count() : 0);
@endphp

<div class="hero-scene w-full" x-data="{ slide: 0 }" x-init="setInterval(() => slide = (slide + 1) % {{ $totalSlides }}, 3000)">
    <div class="hero-grid"></div>
    <div class="hero-circles"><span></span><span></span><span></span></div>

    <div x-show="slide === 0" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="max-w-7xl mx-auto px-4 w-full z-10" style="padding:60px 20px; text-align:center;">
        <div class="hero-badge" style="display:inline-block; padding:6px 16px; border:1px solid rgba(0,82,204,0.18); font-size:12px; font-weight:800; letter-spacing:2px; text-transform:uppercase; border-radius:20px; margin-bottom:20px; backdrop-filter:blur(5px);">
            ✦ Tecnología Informática a tu Alcance ✦
        </div>
        <h1 class="hero-headline" style="font-family:'Rajdhani',sans-serif; font-size:clamp(2rem, 5vw, 3.5rem); font-weight:800; line-height:1.15; margin-bottom:20px;">
            Computadoras, Laptops<br><span class="hero-accent">y Accesorios en TRUJILLO</span>
        </h1>
        <p class="hero-subline" style="font-size:16px; max-width:600px; margin:0 auto 30px auto;">Los mejores precios en tecnología informática con calidad garantizada. Envíos seguros a todo el Perú.</p>
        <div style="display:flex; justify-content:center; gap:16px; flex-wrap:wrap;">
            <a href="/categoria/computadoras" class="btn-mega" style="width:auto; padding:14px 32px;">🔥 Ver computadoras</a>
            <a href="/categoria/laptops" class="btn-outline-mega">💻 Ver laptops</a>
        </div>
    </div>

    @if(isset($anuncios) && $anuncios->count())
        @foreach($anuncios as $i => $anuncio)
        <div x-show="slide === {{ $i + 1 }}" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="max-w-7xl mx-auto px-4 w-full z-10" style="display:flex; flex-wrap:wrap; align-items:center; gap:30px;">
            @if($anuncio->imagen_url)
                <div style="flex:1; min-width:300px;">
                    <img src="{{ $anuncio->imagen_url }}" alt="{{ $anuncio->titulo }}" style="width:100%; max-height:320px; object-fit:cover; border-radius:20px; border:4px solid rgba(0,82,204,0.12); box-shadow:0 20px 40px rgba(0,82,204,0.12);">
                </div>
            @endif
            <div class="hero-slide-panel" style="flex:1; min-width:300px; padding:40px; backdrop-filter:blur(10px); border-radius:20px;">
                <h2 class="hero-title" style="font-family:'Rajdhani',sans-serif; font-size:2.5rem; font-weight:800; margin-bottom:16px; line-height:1.2;">{{ $anuncio->titulo }}</h2>
                <a href="/buscar" class="btn-mega" style="width:auto; padding:12px 30px;">Descubrir más 🚀</a>
            </div>
        </div>
        @endforeach
    @endif
</div>

<div style="max-width:1280px; margin:0 auto 40px auto; padding:0 16px;">
    <div class="glass-card" style="padding:24px 32px; display:flex; align-items:center; justify-content:space-between; gap:24px; overflow-x:auto;">
        <img src="{{ asset('img/marca1.jpg') }}" alt="Marca" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.parentElement.style.display='none'">
        <img src="{{ asset('img/marca2.jpg') }}" alt="Marca" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
        <img src="{{ asset('img/marca3.jpg') }}" alt="Marca" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
        <img src="{{ asset('img/marca4.jpg') }}" alt="Marca" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
        <img src="{{ asset('img/marca5.jpg') }}" alt="Marca" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
        <img src="{{ asset('img/marca-hp.png') }}" alt="HP" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
        <img src="{{ asset('img/marca-dell.jpg') }}" alt="Dell" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
        <img src="{{ asset('img/marca-intel.jpg') }}" alt="Intel" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
        <img src="{{ asset('img/marca-amd.jpg') }}" alt="AMD" style="height:35px; object-fit:contain; opacity:0.7; transition:opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7" onerror="this.remove()">
    </div>
</div>

<div style="max-width:1280px; margin:0 auto; padding:0 16px 60px 16px; display:flex; flex-wrap:wrap; gap:30px;">

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

        <div class="glass-card" style="padding:24px; text-align:center; border-top:4px solid var(--cp-green, #8CC63F);">
            <div style="font-size:32px; margin-bottom:12px;">💬</div>
            <div style="font-size:12px; font-weight:800; color:var(--cp-green-dark, #6EA82E); text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">Asesoría Experta</div>
            <p style="font-size:13px; color:var(--muted); margin-bottom:16px;">¿Dudas armando tu PC? Nuestro equipo te asesora.</p>
            <a href="https://wa.me/51999999999" target="_blank" class="btn-mega" style="background:linear-gradient(135deg, var(--cp-green, #8CC63F), var(--cp-green-dark, #6EA82E)); padding:10px; font-size:12px;">
                📲 Chat WhatsApp
            </a>
        </div>
    </aside>

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
                                <span class="stock-available">✓ Stock Disponible ({{ $producto->stock }})</span>
                            @else
                                <span class="stock-empty">⚠ Agotado temporalmente</span>
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

        @if(isset($productos) && $productos->count())
        <div style="margin-top:48px; padding-top:32px; border-top:2px solid var(--border);">
            <h2 class="section-title" style="margin-bottom:24px;"><span style="color:var(--accent);">🔥</span> Ofertas del día</h2>
            <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:24px;">
                @foreach($productos->take(4) as $producto)
                <div class="glass-card" style="border-top:4px solid var(--primary);">
                    <div class="product-img-wrap">
                        <span class="badge-offer">OFERTA</span>
                        <img src="{{ asset('img/producto.webp') }}" alt="{{ $producto->nombre }}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22><rect fill=%22%23EBF3FF%22 width=%22200%22 height=%22200%22/><text x=%22100%22 y=%22100%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2240%22>🖥️</text></svg>'">
                    </div>
                    <div class="product-body">
                        <div class="product-name" title="{{ $producto->nombre }}">{{ Str::limit($producto->nombre, 45) }}</div>
                        <div class="product-price" style="font-size:20px; margin-bottom:4px;">S/ {{ number_format($producto->precio * 0.9, 2) }}</div>
                        <div style="font-size:12px; color:var(--muted); text-decoration:line-through; margin-bottom:16px;">S/ {{ number_format($producto->precio, 2) }}</div>
                        <form action="{{ route('carrito.store') }}" method="POST" style="margin-top:auto;">
                            @csrf
                            <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn-mega">
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

<div class="hero-scene features-strip" style="margin-top:20px; padding:48px 16px; border-radius:30px 30px 0 0;">
    <div class="hero-grid"></div>
    <div style="max-width:1280px; margin:0 auto; display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:32px; position:relative; z-index:10;">
        <div class="feature-card">
            <div style="font-size:36px; margin-bottom:16px;">🚚</div>
            <div class="feature-title">Envío a TRUJILLO</div>
            <div class="feature-text">Delivery rápido y seguro</div>
        </div>
        <div class="feature-card">
            <div style="font-size:36px; margin-bottom:16px;">🛡️</div>
            <div class="feature-title">Garantía oficial</div>
            <div class="feature-text">Productos 100% originales</div>
        </div>
        <div class="feature-card">
            <div style="font-size:36px; margin-bottom:16px;">💳</div>
            <div class="feature-title">Pago seguro</div>
            <div class="feature-text">Múltiples métodos cifrados</div>
        </div>
        <div class="feature-card">
            <div style="font-size:36px; margin-bottom:16px;">🔧</div>
            <div class="feature-title">Soporte técnico</div>
            <div class="feature-text">Atención personalizada Pro</div>
        </div>
    </div>
</div>

@endsection
