@extends('layouts.main')
@section('title', (isset($categoria) ? $categoria->nombre_categoria : 'Categoría') . ' – Compured Perú')
@section('content')

<style>
    /* Animaciones Generales */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .animate-card { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }

    /* Banner de Categoría Hero */
    .cat-hero {
        position: relative; overflow: hidden;
        background: var(--pub-hero-gradient);
        border-radius: 20px; box-shadow: var(--shadow); transition: all 0.4s;
        padding: 40px; display: flex; align-items: center; gap: 24px; margin-bottom: 40px;
    }

    .cat-bg-grid {
        position: absolute; inset: 0; z-index: 1; pointer-events: none;
        background-image: linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
        background-size: 40px 40px;
    }
    .cat-icon-wrap {
        position: relative; z-index: 2; width: 80px; height: 80px;
        background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);
        border: 2px solid rgba(255,255,255,0.2); border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 40px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        animation: floatIcon 4s ease-in-out infinite;
    }
    @keyframes floatIcon { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }

    /* Tarjetas de Producto */
    .glass-card {
        background: var(--card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(59,130,246,0.2); border-top: 4px solid var(--primary);
        border-radius: 16px; box-shadow: var(--shadow); transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
        display: flex; flex-direction: column; overflow: hidden;
    }
    .glass-card:hover { transform: translateY(-8px); box-shadow: 0 30px 60px rgba(29,78,216,0.25); }

    .product-img-wrap {
        position: relative; background: var(--input-bg); padding: 20px; text-align: center;
        border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: center; height: 180px;
    }
    .product-img-wrap img { max-width: 100%; max-height: 100%; object-fit: contain; transition: transform 0.4s ease; }
    .glass-card:hover .product-img-wrap img { transform: scale(1.1); }

    .product-body { padding: 20px; display: flex; flex-direction: column; flex-grow: 1; }
    .product-name { font-size: 14px; font-weight: 700; color: var(--text); margin-bottom: 8px; line-height: 1.4; flex-grow: 1; }
    .product-price { font-size: 22px; font-weight: 800; color: var(--primary); margin-bottom: 12px; }

    /* Botones Pro */
    .btn-mega {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 10px; background: linear-gradient(135deg, var(--primary), #2563eb);
        border: none; border-radius: 10px; color: white !important; font-size: 13px; font-weight: 700;
        cursor: pointer; text-transform: uppercase; transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(29,78,216,0.4); text-decoration: none; width: 100%;
    }
    .btn-mega:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(29,78,216,0.5); }

    .btn-outline-mega {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 10px; background: transparent; border: 2px solid var(--primary);
        border-radius: 10px; color: var(--primary) !important; font-size: 13px; font-weight: 700;
        cursor: pointer; text-transform: uppercase; transition: all 0.3s; text-decoration: none; width: 100%;
    }
    .btn-outline-mega:hover { background: rgba(59,130,246,0.1); }

    /* Breadcrumbs Modernos */
    .modern-breadcrumb {
        display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600;
        color: var(--muted); margin-bottom: 24px; padding: 12px 20px;
        background: var(--card); border: 1px solid var(--border); border-radius: 12px;
        width: fit-content; box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .modern-breadcrumb a { color: var(--primary); text-decoration: none; transition: color 0.2s; }
    .modern-breadcrumb a:hover { color: var(--primary-hover); text-decoration: underline; }
    .modern-breadcrumb span.sep { color: var(--border); }

    @media (max-width: 768px) {
        .cat-hero { padding: 24px; flex-direction: column; text-align: center; gap: 16px; }
        .cat-icon-wrap { width: 64px; height: 64px; font-size: 32px; }
        .cat-hero h1 { font-size: 1.8rem; }
        .modern-breadcrumb { font-size: 12px; padding: 10px 16px; }
        .animate-card { animation-delay: 0s !important; }
    }
    @media (max-width: 480px) {
        .glass-card { border-radius: 12px; }
        .product-img-wrap { height: 160px; padding: 16px; }
        .product-body { padding: 16px; }
        .btn-mega, .btn-outline-mega { padding: 14px 16px; font-size: 15px; }
    }
</style>

<div class="max-w-7xl mx-auto px-4 py-8" style="min-height: calc(100vh - 200px);">

    <div class="modern-breadcrumb animate-card" style="animation-delay: 0s;">
        <a href="/">Inicio</a>
        <span class="sep">›</span>
        <span style="color:var(--text);">{{ isset($categoria) ? $categoria->nombre_categoria : 'Categoría' }}</span>
    </div>

    <div class="cat-hero animate-card" style="animation-delay: 0.1s;">
        <div class="cat-bg-grid"></div>
        <div class="cat-icon-wrap">🖥️</div>
        <div style="position:relative; z-index:2;">
            <h1 class="hero-title" style="font-family:'Rajdhani',sans-serif; font-size:clamp(1.8rem, 4vw, 2.8rem); font-weight:900; line-height:1.2; margin-bottom:8px;">
                {{ isset($categoria) ? $categoria->nombre_categoria : 'Categoría' }}
            </h1>
            <div class="hero-badge" style="display:inline-block; padding:4px 12px; backdrop-filter:blur(5px); border-radius:20px; font-size:13px; font-weight:700; letter-spacing:1px;">
                ⭐ {{ isset($productos) ? $productos->count() : 0 }} productos disponibles
            </div>
        </div>
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:24px;">
        @forelse($productos ?? [] as $index => $p)
        <div class="glass-card animate-card" style="animation-delay: {{ 0.2 + ($index * 0.05) }}s;">
            <div class="product-img-wrap">
                <img src="{{ asset('img/producto.webp') }}" alt="{{ $p->nombre }}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22><rect fill=%22%23EBF3FF%22 width=%22200%22 height=%22200%22/><text x=%22100%22 y=%22100%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2240%22>💻</text></svg>'">
            </div>
            <div class="product-body">
                <div class="product-name" title="{{ $p->nombre }}">{{ Str::limit($p->nombre, 50) }}</div>
                <div class="product-price">S/ {{ number_format($p->precio,2) }}</div>

                <div style="font-size:12px; margin-bottom:16px;">
                    @if(($p->stock ?? 0) > 0)
                        <span style="color:var(--success); font-weight:700; background:rgba(16,185,129,0.1); padding:4px 8px; border-radius:6px;">✓ En stock ({{ $p->stock }})</span>
                    @else
                        <span style="color:#ef4444; font-weight:700; background:rgba(239,68,68,0.1); padding:4px 8px; border-radius:6px;">⚠ Sin stock</span>
                    @endif
                </div>

                <div style="display:flex; gap:10px; margin-top:auto;">
                    <form action="{{ route('carrito.store') }}" method="POST" style="flex:1;">
                        @csrf
                        <input type="hidden" name="id_producto" value="{{ $p->id_producto }}">
                        <input type="hidden" name="cantidad" value="1">
                        <button type="submit" class="btn-mega">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </button>
                    </form>
                    <a href="/producto/{{ $p->id_producto }}" class="btn-outline-mega" style="flex:1;">
                        Ver
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="glass-card animate-card" style="grid-column:1/-1; padding:60px; text-align:center; border-top:4px solid var(--muted);">
            <div style="font-size:60px; margin-bottom:16px; opacity:0.8; animation:bounce 2s infinite;">📦</div>
            <h2 style="font-size:20px; font-weight:800; color:var(--text); margin-bottom:8px;">Aún no hay productos</h2>
            <p style="color:var(--muted); font-size:14px; max-width:400px; margin:0 auto 24px auto;">Estamos trabajando para traer los mejores productos a esta categoría muy pronto.</p>
            <a href="/" class="btn-mega" style="width:auto; padding:12px 32px;">Explorar otras categorías</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
