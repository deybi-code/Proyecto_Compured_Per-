@extends('layouts.main')

@section('title', 'Buscar - Compured Perú')

@section('content')

<style>
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
    @media (max-width: 768px) {
        .products-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
        .product-img-wrap img { height: 140px; }
        .glass-card { border-radius: 12px; }
    }
    @media (max-width: 480px) {
        .products-grid { grid-template-columns: 1fr; }
    }
</style>

<div style="max-width:1280px; margin:0 auto; padding:0 16px 60px 16px;">

    {{-- Header de búsqueda --}}
    <div style="margin-bottom:32px; padding-bottom:24px; border-bottom:2px solid var(--border);">
        <h1 class="section-title">
            <span style="color:var(--accent);">�</span> 
            @if($q)
                Resultados para: <span style="color:var(--primary);">"{{ $q }}"</span>
            @else
                Catálogo Completo
            @endif
        </h1>
        <p style="color:var(--muted); margin-top:8px; font-size:14px;">
            {{ $productos->count() }} productos encontrados
        </p>
    </div>

    {{-- Filtros --}}
    <div class="glass-card" style="padding:20px 24px; margin-bottom:32px;">
        <form method="GET" action="{{ route('buscar') }}">
            <input type="hidden" name="q" value="{{ $q }}">
            <div style="display:flex; flex-wrap:wrap; gap:16px; align-items:center;">
                {{-- Buscador --}}
                <div style="flex:1; min-width:200px;">
                    <input type="text" name="q" value="{{ $q }}" placeholder="Buscar productos..."
                        style="width:100%; padding:12px 16px; border:1px solid var(--border); border-radius:10px; background:var(--input-bg); color:var(--text); font-size:14px; outline:none; transition:border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
                </div>

                {{-- Ordenamiento --}}
                <div style="display:flex; align-items:center; gap:8px;">
                    <span style="font-size:13px; font-weight:700; color:var(--muted);">Ordenar por:</span>
                    <select name="orden" onchange="this.form.submit()" style="padding:10px 14px; border:1px solid var(--border); border-radius:8px; background:var(--input-bg); color:var(--text); font-size:13px; font-weight:600; cursor:pointer;">
                        <option value="relevancia" {{ $orden === 'relevancia' ? 'selected' : '' }}>Relevancia</option>
                        <option value="precio_asc" {{ $orden === 'precio_asc' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                        <option value="precio_desc" {{ $orden === 'precio_desc' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                    </select>
                </div>

                {{-- Stock --}}
                <div style="display:flex; align-items:center; gap:8px;">
                    <span style="font-size:13px; font-weight:700; color:var(--muted);">Stock:</span>
                    <select name="stock" onchange="this.form.submit()" style="padding:10px 14px; border:1px solid var(--border); border-radius:8px; background:var(--input-bg); color:var(--text); font-size:13px; font-weight:600; cursor:pointer;">
                        <option value="" {{ $stock === '' ? 'selected' : '' }}>Todos</option>
                        <option value="con_stock" {{ $stock === 'con_stock' ? 'selected' : '' }}>Con Stock</option>
                        <option value="sin_stock" {{ $stock === 'sin_stock' ? 'selected' : '' }}>Sin Stock</option>
                    </select>
                </div>

                {{-- Marca --}}
                <div style="display:flex; align-items:center; gap:8px;">
                    <span style="font-size:13px; font-weight:700; color:var(--muted);">Marca:</span>
                    <select name="marca" onchange="this.form.submit()" style="padding:10px 14px; border:1px solid var(--border); border-radius:8px; background:var(--input-bg); color:var(--text); font-size:13px; font-weight:600; cursor:pointer;">
                        <option value="">Todas</option>
                        @foreach($marcas as $m)
                        <option value="{{ $m }}" {{ $marca === $m ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Limpiar --}}
                @if($orden || $stock || $marca)
                    <a href="{{ route('buscar', ['q' => $q]) }}" style="padding:10px 16px; font-size:13px; font-weight:700; color:var(--primary); text-decoration:none;">
                        ✕ Limpiar filtros
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Grid de Productos --}}
    <div class="products-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:24px;">
        @forelse($productos ?? [] as $p)
        <div class="glass-card" style="display:flex; flex-direction:column; border-top:4px solid var(--primary);">
            <div class="product-img-wrap">
                @if($p->mostrar_inicio ?? false)
                <span class="badge-new">NUEVO</span>
                @endif
                @if($p->imagen ?? false)
                    <img src="{{ str_starts_with($p->imagen, 'http') ? $p->imagen : asset('storage/'.$p->imagen) }}" alt="{{ $p->nombre }}" loading="lazy">
                @elseif($p->fotos->first() ?? false)
                    <img src="{{ str_starts_with($p->fotos->first()->ruta_foto, 'http') ? $p->fotos->first()->ruta_foto : asset('storage/'.$p->fotos->first()->ruta_foto) }}" alt="{{ $p->nombre }}" loading="lazy">
                @else
                    <img src="{{ asset('img/producto.webp') }}" alt="{{ $p->nombre }}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22><rect fill=%22%23EBF3FF%22 width=%22200%22 height=%22200%22/><text x=%22100%22 y=%22100%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2240%22>💻</text></svg>'">
                @endif
            </div>
            <div class="product-body">
                <div style="font-size:11px; font-weight:800; color:var(--accent); text-transform:uppercase; margin-bottom:6px;">{{ $p->marca ?? 'Compured' }}</div>
                <div class="product-name" title="{{ $p->nombre }}">{{ \Illuminate\Support\Str::limit($p->nombre, 50) }}</div>
                <div class="product-price">S/ {{ number_format($p->precio, 2) }}</div>
                <div style="font-size:12px; margin-bottom:16px;">
                    @if(($p->stock ?? 0) > 0)
                        <span class="stock-available">✓ Stock Disponible ({{ $p->stock }})</span>
                    @else
                        <span class="stock-empty">⚠ Agotado temporalmente</span>
                    @endif
                </div>
                <div style="display:flex; gap:10px; margin-top:auto;">
                    <form action="{{ route('carrito.store') }}" method="POST" style="flex:1;">
                        @csrf
                        <input type="hidden" name="id_producto" value="{{ $p->id_producto }}">
                        <input type="hidden" name="cantidad" value="1">
                        <button type="submit" class="btn-mega" style="padding:10px;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </button>
                    </form>
                    <a href="/producto/{{ $p->id_producto }}" class="btn-mega" style="flex:1; background:transparent; border:2px solid var(--primary); color:var(--primary) !important; padding:8px; box-shadow:none;">
                        Ver
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:60px 20px;">
            <div style="font-size:64px; margin-bottom:20px; opacity:0.5;">�</div>
            <h2 style="font-size:24px; font-weight:800; color:var(--text); margin-bottom:12px;">No encontramos resultados</h2>
            <p style="color:var(--muted); margin-bottom:24px;">Prueba con otra palabra clave o explora nuestro catálogo completo.</p>
            <a href="/categoria" class="btn-mega" style="width:auto; padding:14px 32px;">Explorar categorías</a>
        </div>
        @endforelse
    </div>

</div>

@endsection
