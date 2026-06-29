@extends('layouts.main')
@section('title', 'Resultados de búsqueda – Compured Perú')
@section('content')

<style>
    /* Variables sincronizadas con el ecosistema (Login, Index, Dashboard, etc.) */
    :root {
        --bg: #f0f4ff; --card: rgba(255,255,255,0.92); --text: #0f172a; --muted: #64748b;
        --border: #cbd5e1; --input-bg: #f8fafc; --primary: #1d4ed8; --primary-hover: #1e40af;
        --accent: #3b82f6; --shadow: 0 25px 60px rgba(0,0,0,0.18); --success: #10b981;
    }
    [data-theme="dark"] {
        --bg: #0a0f1e; --card: rgba(15,23,42,0.93); --text: #f1f5f9; --muted: #94a3b8;
        --border: #1e3a5f; --input-bg: #0f172a; --primary: #3b82f6; --primary-hover: #2563eb;
        --accent: #60a5fa; --shadow: 0 25px 60px rgba(0,0,0,0.6); --success: #34d399;
    }

    /* Animaciones */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .animate-card { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }

    /* Botón flotante de Tema (Modo Oscuro Sincronizado) */
    .theme-btn-floating {
        position: fixed; bottom: 30px; right: 30px; z-index: 100;
        background: var(--card); backdrop-filter: blur(10px);
        border: 2px solid var(--primary); color: var(--text);
        border-radius: 50%; width: 56px; height: 56px; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
        box-shadow: 0 10px 25px rgba(59,130,246,0.3); font-size: 24px;
    }
    .theme-btn-floating:hover { transform: scale(1.15) rotate(15deg); background: var(--primary); color: white; }

    /* Hero de Búsqueda */
    .search-hero {
        position: relative; overflow: hidden;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 40%, #1d4ed8 70%, #0f172a 100%);
        border-radius: 24px; box-shadow: var(--shadow); transition: all 0.4s;
        padding: 40px; display: flex; flex-direction: column; align-items: center; text-align: center;
        margin-bottom: 40px;
    }
    [data-theme="dark"] .search-hero { background: linear-gradient(135deg, #020617 0%, #0f172a 40%, #1e3a5f 70%, #020617 100%); }

    .search-bg-grid {
        position: absolute; inset: 0; z-index: 1; pointer-events: none;
        background-image: linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
        background-size: 40px 40px;
    }

    /* Input Búsqueda Pro (Para realizar nueva búsqueda) */
    .search-input-wrapper {
        position: relative; width: 100%; max-width: 600px; z-index: 2; margin-top: 24px;
    }
    .search-input-wrapper input {
        width: 100%; padding: 18px 24px 18px 56px;
        background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);
        border: 2px solid rgba(255,255,255,0.2); border-radius: 16px;
        color: white; font-size: 16px; font-weight: 600; outline: none; transition: all 0.3s;
    }
    .search-input-wrapper input::placeholder { color: rgba(255,255,255,0.6); }
    .search-input-wrapper input:focus { border-color: var(--accent); background: rgba(255,255,255,0.15); box-shadow: 0 0 0 4px rgba(96,165,250,0.3); }
    .search-input-wrapper .search-icon {
        position: absolute; left: 20px; top: 50%; transform: translateY(-50%);
        color: rgba(255,255,255,0.6); font-size: 20px; pointer-events: none;
    }
    .search-input-wrapper button {
        position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
        background: var(--accent); border: none; padding: 10px 20px;
        border-radius: 10px; color: white; font-weight: 800; cursor: pointer; transition: all 0.2s;
    }
    .search-input-wrapper button:hover { background: white; color: var(--primary); }

    /* Tarjetas Glassmorphism */
    .glass-card {
        background: var(--card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(59,130,246,0.2); border-top: 4px solid var(--primary);
        border-radius: 16px; box-shadow: var(--shadow); transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
        display: flex; flex-direction: column; overflow: hidden; height: 100%;
    }
    .glass-card:hover { transform: translateY(-8px); box-shadow: 0 30px 60px rgba(29,78,216,0.25); }

    .product-img-wrap {
        position: relative; background: var(--input-bg); padding: 20px; text-align: center;
        border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: center; height: 200px;
    }
    .product-img-wrap img { max-width: 100%; max-height: 100%; object-fit: contain; transition: transform 0.4s ease; }
    .glass-card:hover .product-img-wrap img { transform: scale(1.1); }

    .product-body { padding: 20px; display: flex; flex-direction: column; flex-grow: 1; }
    .product-name { font-size: 15px; font-weight: 700; color: var(--text); margin-bottom: 8px; line-height: 1.4; flex-grow: 1; }
    .product-price { font-size: 24px; font-weight: 900; color: var(--primary); margin-bottom: 16px; font-family: 'Segoe UI', system-ui, sans-serif; }

    /* Botones Pro */
    .btn-mega {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 12px; background: linear-gradient(135deg, var(--primary), #2563eb);
        border: none; border-radius: 10px; color: white !important; font-size: 13px; font-weight: 800;
        cursor: pointer; text-transform: uppercase; transition: all 0.3s; width: 100%; text-decoration: none;
    }
    .btn-mega:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(29,78,216,0.4); }

    .btn-outline-mega {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 12px; background: transparent; border: 2px solid var(--primary);
        border-radius: 10px; color: var(--primary) !important; font-size: 13px; font-weight: 800;
        cursor: pointer; text-transform: uppercase; transition: all 0.3s; width: 100%; text-decoration: none;
    }
    .btn-outline-mega:hover { background: rgba(59,130,246,0.1); }
</style>

{{-- Botón Flotante para Alternar Tema --}}
<button class="theme-btn-floating animate-card" onclick="toggleThemeGlobal()" title="Cambiar tema" style="animation-delay: 0.5s;">
    <span id="icon-moon-global">🌙</span>
    <span id="icon-sun-global" style="display:none;">☀️</span>
</button>

<div class="max-w-7xl mx-auto px-4 py-8" style="min-height: calc(100vh - 200px);">

    {{-- Búsqueda Hero --}}
    <div class="search-hero animate-card" style="animation-delay: 0s;">
        <div class="search-bg-grid"></div>
        <div style="position:relative; z-index:2; width:100%; display:flex; flex-direction:column; align-items:center;">
            <div style="font-size:48px; margin-bottom:12px; animation:bounce 2s infinite;">🔍</div>
            <h1 style="font-family:'Segoe UI',sans-serif; font-size:clamp(1.5rem, 3vw, 2.5rem); font-weight:900; color:white; margin-bottom:8px;">
                Resultados para: <span style="color:var(--accent);">"{{ request('q') }}"</span>
            </h1>
            <p style="color:rgba(255,255,255,0.7); font-size:15px; font-weight:600;">
                Hemos encontrado {{ isset($productos) ? $productos->count() : 0 }} productos que coinciden con tu búsqueda
            </p>

            <form method="GET" action="{{ route('buscar') }}" class="search-input-wrapper">
                <span class="search-icon">🔎</span>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar otro producto, marca o categoría...">
                <button type="submit">Buscar</button>
            </form>
        </div>
    </div>

    {{-- Grid de Resultados --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:24px;">
        @forelse($productos ?? [] as $index => $p)
        <div class="glass-card animate-card" style="animation-delay: {{ 0.1 + ($index * 0.05) }}s;">
            <div class="product-img-wrap">
                <img src="{{ asset('img/producto.webp') }}" alt="{{ $p->nombre }}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22><rect fill=%22%23EBF3FF%22 width=%22200%22 height=%22200%22/><text x=%22100%22 y=%22100%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2240%22>💻</text></svg>'">
            </div>
            <div class="product-body">
                <div class="product-name" title="{{ $p->nombre }}">{{ Str::limit($p->nombre, 55) }}</div>
                <div class="product-price">S/ {{ number_format($p->precio,2) }}</div>

                <div style="display:flex; gap:12px; margin-top:auto;">
                    <form action="{{ route('carrito.store') }}" method="POST" style="flex:1;">
                        @csrf
                        <input type="hidden" name="id_producto" value="{{ $p->id_producto }}">
                        <input type="hidden" name="cantidad" value="1">
                        <button type="submit" class="btn-mega" title="Agregar al Carrito">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </button>
                    </form>
                    <a href="/producto/{{ $p->id_producto }}" class="btn-outline-mega" style="flex:1;">
                        Ver Detalles
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="glass-card animate-card" style="grid-column:1/-1; padding:80px 20px; text-align:center; border-top:4px solid var(--muted);">
            <div style="font-size:70px; margin-bottom:20px; opacity:0.6; filter:grayscale(100%);">🛒</div>
            <h2 style="font-size:24px; font-weight:800; color:var(--text); margin-bottom:12px;">No encontramos resultados</h2>
            <p style="color:var(--muted); font-size:15px; margin-bottom:32px;">No pudimos encontrar productos que coincidan con la búsqueda <strong style="color:var(--primary);">"{{ request('q') }}"</strong>.</p>
            <a href="/" class="btn-mega" style="width:auto; padding:14px 40px;">Volver al Catálogo</a>
        </div>
        @endforelse
    </div>
</div>

<script>
    // Lógica para alternar el modo oscuro sincronizado
    function toggleThemeGlobal() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);

        // Tailwind class sync
        if (newTheme === 'dark') {
            document.documentElement.classList.add('dark');
            document.getElementById('icon-moon-global').style.display = 'none';
            document.getElementById('icon-sun-global').style.display = 'block';
        } else {
            document.documentElement.classList.remove('dark');
            document.getElementById('icon-moon-global').style.display = 'block';
            document.getElementById('icon-sun-global').style.display = 'none';
        }
    }

    // Inicializar iconos al cargar
    document.addEventListener('DOMContentLoaded', () => {
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        document.getElementById('icon-moon-global').style.display = isDark ? 'none' : 'block';
        document.getElementById('icon-sun-global').style.display = isDark ? 'block' : 'none';
    });
</script>

@endsection
