@extends('layouts.main')

@section('title', (isset($producto) ? $producto->nombre : 'Detalle') . ' – Compured Perú')

@section('content')

<style>
    @keyframes fadeUp { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
    .anim { animation: fadeUp 0.5s ease forwards; opacity:0; }

    /* ── Breadcrumb ── */
    .breadcrumb {
        display:flex; align-items:center; gap:6px; flex-wrap:wrap;
        font-size:13px; font-weight:600; color:var(--muted);
        margin-bottom:20px;
    }
    .breadcrumb a { color:var(--primary); }
    .breadcrumb a:hover { text-decoration:underline; }
    .breadcrumb .sep { color:var(--border); }

    /* ── Card principal ── */
    .product-card {
        background:var(--card); border:1px solid var(--border);
        border-radius:20px; box-shadow:var(--shadow);
        overflow:hidden; margin-bottom:24px;
    }

    /* ── Galería ── */
    .gallery-wrap {
        background:var(--input-bg); border-radius:16px;
        display:flex; align-items:center; justify-content:center;
        min-height:340px; padding:32px; position:relative; overflow:hidden;
        border:1px solid var(--border);
    }
    .gallery-wrap::before {
        content:''; position:absolute; inset:0; pointer-events:none;
        background-image:radial-gradient(rgba(59,130,246,0.08) 1px, transparent 1px);
        background-size:22px 22px;
    }
    .gallery-wrap img {
        max-width:100%; max-height:360px; object-fit:contain; position:relative; z-index:2;
        transition:transform 0.4s cubic-bezier(0.34,1.56,0.64,1);
    }
    .gallery-wrap:hover img { transform:scale(1.06); }

    /* Miniaturas */
    .thumbs { display:flex; gap:10px; margin-top:14px; flex-wrap:wrap; }
    .thumb {
        width:64px; height:64px; border-radius:10px; object-fit:cover;
        border:2px solid var(--border); cursor:pointer; transition:border-color 0.2s;
        background:var(--input-bg);
    }
    .thumb:hover, .thumb.active { border-color:var(--primary); }

    /* ── Info ── */
    .product-brand { font-size:11px; font-weight:800; color:var(--accent); text-transform:uppercase; letter-spacing:1.2px; margin-bottom:6px; }
    .product-title { font-size:clamp(1.4rem,3vw,2rem); font-weight:900; line-height:1.2; margin-bottom:14px; color:var(--text); }
    .product-price { font-size:2.4rem; font-weight:900; color:var(--primary); line-height:1; }
    .price-row { display:flex; align-items:baseline; gap:12px; margin-bottom:20px; padding-bottom:20px; border-bottom:1px solid var(--border); }

    .stock-badge { display:inline-flex; align-items:center; gap:6px; padding:5px 12px; border-radius:8px; font-size:13px; font-weight:700; }
    .stock-in  { background:rgba(16,185,129,0.1); color:var(--success); border:1px solid rgba(16,185,129,0.25); }
    .stock-out { background:rgba(239,68,68,0.1);  color:var(--danger);  border:1px solid rgba(239,68,68,0.25); }

    /* Cantidad */
    .qty-wrap { display:flex; align-items:center; border:2px solid var(--border); border-radius:10px; background:var(--input-bg); width:fit-content; overflow:hidden; }
    .qty-btn  { background:transparent; border:none; color:var(--text); font-size:18px; font-weight:700; width:40px; height:42px; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:background 0.2s; }
    .qty-btn:hover { background:rgba(59,130,246,0.1); color:var(--primary); }
    .qty-input { width:48px; text-align:center; border:none; background:transparent; font-size:16px; font-weight:700; color:var(--text); outline:none; -moz-appearance:textfield; }
    .qty-input::-webkit-outer-spin-button, .qty-input::-webkit-inner-spin-button { -webkit-appearance:none; }

    /* Botón carrito */
    .btn-cart {
        display:flex; align-items:center; justify-content:center; gap:10px;
        width:100%; padding:15px; background:linear-gradient(135deg, var(--primary), #2563eb);
        border:none; border-radius:12px; color:white; font-size:15px; font-weight:800;
        cursor:pointer; letter-spacing:.5px; transition:all 0.3s;
        box-shadow:0 4px 16px rgba(29,78,216,0.35);
    }
    .btn-cart:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(29,78,216,0.45); }
    .btn-cart:disabled { background:var(--muted); cursor:not-allowed; transform:none; box-shadow:none; }

    /* ── TABS ── */
    .tabs-section { background:var(--card); border:1px solid var(--border); border-radius:20px; overflow:hidden; margin-bottom:24px; }
    .tabs-nav { display:flex; border-bottom:2px solid var(--border); overflow-x:auto; }
    .tab-btn {
        flex-shrink:0; background:transparent; border:none;
        padding:16px 24px; font-size:14px; font-weight:700; color:var(--muted);
        cursor:pointer; border-bottom:3px solid transparent; margin-bottom:-2px;
        transition:color 0.2s, border-color 0.2s; white-space:nowrap; font-family:inherit;
    }
    .tab-btn:hover { color:var(--primary); }
    .tab-btn.active { color:var(--primary); border-bottom-color:var(--primary); }
    .tab-panel { padding:28px 32px; color:var(--muted); font-size:15px; line-height:1.8; }
    .tab-panel h3 { color:var(--text); font-size:17px; font-weight:800; margin-bottom:16px; display:flex; align-items:center; gap:8px; }

    /* Especificaciones tabla */
    .specs-table { width:100%; border-collapse:collapse; }
    .specs-table tr { border-bottom:1px solid var(--border); }
    .specs-table tr:last-child { border-bottom:none; }
    .specs-table td { padding:12px 16px; font-size:14px; }
    .specs-table td:first-child { font-weight:700; color:var(--text); width:40%; background:var(--input-bg); }
    .specs-table td:last-child { color:var(--muted); }

    /* Garantía items */
    .garantia-item { display:flex; align-items:flex-start; gap:12px; padding:14px 0; border-bottom:1px solid var(--border); }
    .garantia-item:last-child { border-bottom:none; }
    .garantia-icon { width:36px; height:36px; border-radius:10px; background:rgba(29,78,216,0.1); display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
    .garantia-title { font-size:14px; font-weight:700; color:var(--text); margin-bottom:3px; }
    .garantia-desc { font-size:13px; color:var(--muted); line-height:1.5; }

    /* Comentarios */
    .comment-empty { text-align:center; padding:40px 20px; background:var(--input-bg); border-radius:14px; border:2px dashed var(--border); }
    .comment-empty .icon { font-size:36px; margin-bottom:12px; opacity:0.5; }
    .cp-textarea { width:100%; padding:14px; border:2px solid var(--border); border-radius:12px; background:var(--input-bg); color:var(--text); font-size:14px; font-family:inherit; resize:vertical; min-height:100px; transition:border-color 0.2s; outline:none; }
    .cp-textarea:focus { border-color:var(--primary); box-shadow:0 0 0 3px rgba(59,130,246,0.1); }
    .btn-comment { display:inline-flex; align-items:center; gap:8px; padding:11px 20px; background:var(--primary); color:white; border:none; border-radius:10px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit; transition:background 0.2s; }
    .btn-comment:hover { background:var(--primary-hover); }

    /* ── PRODUCTOS RECOMENDADOS ── */
    .recom-section { margin-bottom:32px; }
    .recom-title { font-size:20px; font-weight:900; color:var(--text); margin-bottom:6px; display:flex; align-items:center; gap:10px; }
    .recom-sub { font-size:14px; color:var(--muted); margin-bottom:20px; }
    .recom-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:16px; }

    .recom-card {
        background:var(--card); border:1px solid var(--border); border-radius:16px;
        overflow:hidden; transition:transform 0.2s, box-shadow 0.2s; text-decoration:none; color:var(--text);
        display:flex; flex-direction:column;
    }
    .recom-card:hover { transform:translateY(-4px); box-shadow:0 12px 32px rgba(0,0,0,0.12); }
    .recom-img-wrap { background:var(--input-bg); padding:20px; display:flex; align-items:center; justify-content:center; height:160px; border-bottom:1px solid var(--border); }
    .recom-img-wrap img { max-width:100%; max-height:120px; object-fit:contain; }
    .recom-body { padding:14px; flex:1; display:flex; flex-direction:column; }
    .recom-brand { font-size:10px; font-weight:800; color:var(--accent); text-transform:uppercase; letter-spacing:1px; margin-bottom:4px; }
    .recom-name { font-size:13px; font-weight:700; color:var(--text); line-height:1.4; margin-bottom:8px; flex:1; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
    .recom-price { font-size:17px; font-weight:900; color:var(--primary); }
    .recom-btn { display:block; width:100%; padding:9px; margin-top:10px; background:rgba(29,78,216,0.08); color:var(--primary); border:1px solid rgba(29,78,216,0.2); border-radius:8px; text-align:center; font-size:13px; font-weight:700; cursor:pointer; text-decoration:none; transition:background 0.2s; }
    .recom-btn:hover { background:var(--primary); color:white; }

    /* Trust bar */
    .trust-bar { display:flex; align-items:center; gap:24px; flex-wrap:wrap; margin-top:20px; padding-top:20px; border-top:1px solid var(--border); }
    .trust-item { display:flex; align-items:center; gap:8px; font-size:13px; font-weight:600; color:var(--muted); }

    @media (max-width:768px) {
        .tab-panel { padding:20px 16px; }
        .recom-grid { grid-template-columns:repeat(2, 1fr); }
    }
</style>

<div style="max-width:1280px; margin:0 auto; padding:24px 20px;">

    {{-- BREADCRUMB --}}
    <nav class="breadcrumb anim" style="animation-delay:0s;">
        <a href="{{ route('home') }}">Inicio</a>
        <span class="sep">›</span>
        @if(isset($producto) && $producto->categoria)
            <a href="{{ route('categoria', Str::slug($producto->categoria->nombre_categoria)) }}">
                {{ $producto->categoria->nombre_categoria }}
            </a>
            <span class="sep">›</span>
        @endif
        <span style="color:var(--text);">{{ isset($producto) ? Str::limit($producto->nombre, 45) : 'Producto' }}</span>
    </nav>

    {{-- CARD PRINCIPAL --}}
    <div class="product-card anim" style="animation-delay:0.08s;"
         x-data="{
            cantidad: 1,
            tab: 'descripcion',
            imgSrc: '{{ isset($producto) && ($producto->imagen ?? false) ? (str_starts_with($producto->imagen, 'http') ? $producto->imagen : asset('storage/'.$producto->imagen)) : asset('img/producto.webp') }}',
            fotos: {{ isset($producto) && $producto->fotos->count() ? $producto->fotos->map(fn($f) => str_starts_with($f->ruta_foto,'http') ? $f->ruta_foto : asset('storage/'.$f->ruta_foto))->toJson() : '[]' }}
         }">

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:0; padding:32px; gap:40px;"
             class="product-main-grid">

            {{-- IMAGEN --}}
            <div>
                <div class="gallery-wrap">
                    @if(isset($producto) && $producto->mostrar_inicio)
                        <span style="position:absolute;top:16px;left:16px;z-index:10;background:var(--primary);color:white;padding:5px 12px;border-radius:8px;font-size:11px;font-weight:800;letter-spacing:1px;">NUEVO</span>
                    @endif
                    <img :src="imgSrc" alt="{{ $producto->nombre ?? 'Producto' }}"
                         onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22><rect fill=%22%23EBF3FF%22 width=%22200%22 height=%22200%22/><text x=%22100%22 y=%22100%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2240%22>💻</text></svg>'">
                </div>

                {{-- Miniaturas si hay fotos --}}
                @if(isset($producto) && $producto->fotos->count() > 0)
                    <div class="thumbs">
                        @if($producto->imagen)
                            <img class="thumb active"
                                 src="{{ str_starts_with($producto->imagen,'http') ? $producto->imagen : asset('storage/'.$producto->imagen) }}"
                                 @click="imgSrc = '{{ str_starts_with($producto->imagen,'http') ? $producto->imagen : asset('storage/'.$producto->imagen) }}'; $el.parentElement.querySelectorAll('.thumb').forEach(t=>t.classList.remove('active')); $el.classList.add('active')">
                        @endif
                        @foreach($producto->fotos as $foto)
                            @php $fUrl = str_starts_with($foto->ruta_foto,'http') ? $foto->ruta_foto : asset('storage/'.$foto->ruta_foto); @endphp
                            <img class="thumb" src="{{ $fUrl }}"
                                 @click="imgSrc = '{{ $fUrl }}'; $el.parentElement.querySelectorAll('.thumb').forEach(t=>t.classList.remove('active')); $el.classList.add('active')">
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- INFO --}}
            <div style="display:flex; flex-direction:column; justify-content:center;">

                <div class="product-brand">{{ $producto->marca ?? 'CompuredPerú' }}</div>
                <h1 class="product-title">{{ $producto->nombre ?? 'Producto' }}</h1>

                <div style="display:flex; align-items:center; gap:12px; margin-bottom:20px;">
                    @if(($producto->stock ?? 0) > 0)
                        <span class="stock-badge stock-in">✓ Stock Disponible ({{ $producto->stock }})</span>
                    @else
                        <span class="stock-badge stock-out">✗ Agotado</span>
                    @endif
                    <span style="font-size:13px; color:var(--muted); display:flex; gap:3px; align-items:center;">
                        <span style="color:#fbbf24;">★★★★★</span>
                        <span style="margin-left:4px;">(0 Reseñas)</span>
                    </span>
                </div>

                <div class="price-row">
                    <span class="product-price">S/ {{ number_format($producto->precio ?? 0, 2) }}</span>
                    <span style="font-size:13px; color:var(--muted); font-weight:600;">Incluye IGV</span>
                </div>

                @if(isset($producto) && $producto->detalles_tecnicos)
                    <p style="color:var(--muted); font-size:14px; line-height:1.7; margin-bottom:24px;">
                        {{ Str::limit(strip_tags($producto->detalles_tecnicos), 180) }}
                    </p>
                @endif

                {{-- FORMULARIO CARRITO --}}
                <form action="{{ route('carrito.store') }}" method="POST">
                    @csrf
                    @isset($producto)
                        <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">
                    @endisset

                    <div style="margin-bottom:20px;">
                        <label style="display:block; font-size:11px; font-weight:800; color:var(--muted); text-transform:uppercase; letter-spacing:.8px; margin-bottom:10px;">Cantidad</label>
                        <div class="qty-wrap">
                            <button type="button" class="qty-btn" @click="if(cantidad > 1) cantidad--">−</button>
                            <input type="number" name="cantidad" x-model="cantidad" class="qty-input" min="1" max="{{ $producto->stock ?? 1 }}">
                            <button type="button" class="qty-btn" @click="if(cantidad < {{ $producto->stock ?? 1 }}) cantidad++">+</button>
                        </div>
                    </div>

                    <button type="submit" class="btn-cart" {{ ($producto->stock ?? 0) < 1 ? 'disabled' : '' }}>
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.3 2.3c-.63.63-.18 1.7.7 1.7H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        {{ ($producto->stock ?? 0) > 0 ? 'Agregar al Carrito' : 'Sin Stock' }}
                    </button>
                </form>

                <div class="trust-bar">
                    <div class="trust-item"><span style="font-size:20px;">🛡️</span> Garantía de 1 año</div>
                    <div class="trust-item"><span style="font-size:20px;">🚚</span> Envío a todo el Perú</div>
                    <div class="trust-item"><span style="font-size:20px;">✅</span> Producto original</div>
                </div>

            </div>
        </div>

        {{-- TABS --}}
        <div class="tabs-section" style="margin:0 32px 32px; border-radius:16px;">
            <div class="tabs-nav">
                <button class="tab-btn" :class="{ active: tab === 'descripcion' }" @click="tab = 'descripcion'">📄 Descripción</button>
                <button class="tab-btn" :class="{ active: tab === 'especificaciones' }" @click="tab = 'especificaciones'">⚙️ Especificaciones</button>
                <button class="tab-btn" :class="{ active: tab === 'garantia' }" @click="tab = 'garantia'">🛡️ Garantía</button>
                <button class="tab-btn" :class="{ active: tab === 'comentarios' }" @click="tab = 'comentarios'">💬 Comentarios</button>
            </div>

            {{-- DESCRIPCIÓN --}}
            <div class="tab-panel" x-show="tab === 'descripcion'" x-transition.opacity>
                <h3>📄 Descripción del Producto</h3>
                @if(isset($producto) && $producto->detalles_tecnicos)
                    <div style="color:var(--text); line-height:1.8; white-space:pre-line;">{{ $producto->detalles_tecnicos }}</div>
                @else
                    <div style="padding:32px; text-align:center; background:var(--input-bg); border-radius:12px; border:1px dashed var(--border);">
                        <div style="font-size:32px; margin-bottom:12px; opacity:0.4;">📄</div>
                        <p style="font-weight:600; color:var(--text);">Sin descripción disponible</p>
                        <p style="font-size:13px;">El vendedor aún no ha agregado descripción a este producto.</p>
                    </div>
                @endif
            </div>

            {{-- ESPECIFICACIONES --}}
            <div class="tab-panel" x-show="tab === 'especificaciones'" x-transition.opacity x-cloak>
                <h3>⚙️ Especificaciones Técnicas</h3>
                <table class="specs-table">
                    <tr><td>Marca</td><td>{{ $producto->marca ?? '—' }}</td></tr>
                    <tr><td>Categoría</td><td>{{ $producto->categoria->nombre_categoria ?? '—' }}</td></tr>
                    <tr><td>Stock disponible</td><td>{{ $producto->stock ?? 0 }} unidades</td></tr>
                    <tr><td>Estado</td><td>Nuevo, en caja sellada</td></tr>
                    <tr><td>Garantía</td><td>1 año oficial</td></tr>
                    <tr><td>Envío</td><td>A todo el Perú</td></tr>
                </table>
            </div>

            {{-- GARANTÍA --}}
            <div class="tab-panel" x-show="tab === 'garantia'" x-transition.opacity x-cloak>
                <h3>🛡️ Política de Garantía y Devolución</h3>
                <div>
                    <div class="garantia-item">
                        <div class="garantia-icon">📅</div>
                        <div>
                            <div class="garantia-title">7 días para devoluciones</div>
                            <div class="garantia-desc">Aceptamos devoluciones exclusivamente por fallas de fábrica, presentando el comprobante original (Boleta o Factura).</div>
                        </div>
                    </div>
                    <div class="garantia-item">
                        <div class="garantia-icon">📦</div>
                        <div>
                            <div class="garantia-title">Empaque original requerido</div>
                            <div class="garantia-desc">El producto debe ser devuelto en su caja original, con todos sus manuales, accesorios y sellos intactos.</div>
                        </div>
                    </div>
                    <div class="garantia-item">
                        <div class="garantia-icon">⚠️</div>
                        <div>
                            <div class="garantia-title">Daños no cubiertos</div>
                            <div class="garantia-desc">Los daños por mal uso, overclocking, golpes, humedad o instalación eléctrica defectuosa no están cubiertos por la garantía.</div>
                        </div>
                    </div>
                    <div class="garantia-item">
                        <div class="garantia-icon">📞</div>
                        <div>
                            <div class="garantia-title">Cómo iniciar una garantía</div>
                            <div class="garantia-desc">Contáctanos por WhatsApp o correo electrónico con tu número de boleta y descripción del problema. Te atendemos en 24 horas hábiles.</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- COMENTARIOS --}}
            <div class="tab-panel" x-show="tab === 'comentarios'" x-transition.opacity x-cloak>
                <div style="display:grid; grid-template-columns:3fr 2fr; gap:32px;">
                    <div>
                        <h3>💬 Reseñas de Clientes</h3>
                        <div class="comment-empty">
                            <div class="icon">💬</div>
                            <p style="font-weight:700; color:var(--text); margin-bottom:6px;">Aún no hay reseñas</p>
                            <p style="font-size:13px;">¡Sé el primero en opinar sobre este producto!</p>
                        </div>
                    </div>
                    <div>
                        <h3 style="font-size:15px;">Escribe tu reseña</h3>
                        <div style="margin-bottom:12px;">
                            <label style="font-size:12px; font-weight:700; color:var(--muted); display:block; margin-bottom:6px;">Tu calificación</label>
                            <div style="font-size:24px; cursor:pointer; color:#d1d5db;">★★★★★</div>
                        </div>
                        <textarea class="cp-textarea" placeholder="Comparte tu experiencia con este producto..." style="margin-bottom:12px;"></textarea>
                        <button class="btn-comment">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Publicar reseña
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ===== PRODUCTOS RECOMENDADOS ===== --}}
    @if(isset($relacionados) && $relacionados->count() > 0)
    <div class="recom-section anim" style="animation-delay:0.2s;">
        <div class="recom-title">
            <span style="font-size:22px;">🔥</span>
            También te puede interesar
        </div>
        <p class="recom-sub">Productos de la misma categoría que otros clientes también compraron</p>

        <div class="recom-grid">
            @foreach($relacionados as $rel)
            @php
                $relImg = null;
                if($rel->imagen) $relImg = str_starts_with($rel->imagen,'http') ? $rel->imagen : asset('storage/'.$rel->imagen);
                elseif($rel->fotos->first()) $relImg = str_starts_with($rel->fotos->first()->ruta_foto,'http') ? $rel->fotos->first()->ruta_foto : asset('storage/'.$rel->fotos->first()->ruta_foto);
                else $relImg = asset('img/producto.webp');
            @endphp
            <a href="{{ route('producto', $rel->id_producto) }}" class="recom-card">
                <div class="recom-img-wrap">
                    <img src="{{ $relImg }}" alt="{{ $rel->nombre }}"
                         onerror="this.src='{{ asset('img/producto.webp') }}'">
                </div>
                <div class="recom-body">
                    <div class="recom-brand">{{ $rel->marca }}</div>
                    <div class="recom-name">{{ $rel->nombre }}</div>
                    <div class="recom-price">S/ {{ number_format($rel->precio, 2) }}</div>
                    @if($rel->stock > 0)
                        <span style="font-size:11px; color:var(--success); font-weight:700; margin-top:4px; display:block;">✓ En stock</span>
                    @endif
                    <span class="recom-btn">Ver producto →</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>

<style>
    @media (max-width: 768px) {
        .product-main-grid { grid-template-columns: 1fr !important; }
    }
</style>

@endsection
