@extends('layouts.main')

@section('title', 'Compured Perú – Tecnología Informática a tu Alcance')

@section('content')

{{-- ===== HERO / BANNER ===== --}}
<div class="w-full overflow-hidden" style="background:linear-gradient(135deg,#091E42 0%,#003A99 50%,#0052CC 100%);min-height:280px;display:flex;align-items:center;position:relative">
    {{-- Decorative circles --}}
    <div style="position:absolute;top:-60px;right:-60px;width:300px;height:300px;border-radius:50%;background:rgba(140,198,63,0.08);pointer-events:none"></div>
    <div style="position:absolute;bottom:-80px;left:-40px;width:250px;height:250px;border-radius:50%;background:rgba(38,132,255,0.1);pointer-events:none"></div>

    @if(isset($anuncios) && $anuncios->count())
        {{-- Dynamic banner --}}
        <div class="max-w-7xl mx-auto px-4 w-full" x-data="{ slide: 0 }" x-init="setInterval(() => slide = (slide + 1) % {{ $anuncios->count() }}, 4000)">
            @foreach($anuncios as $i => $anuncio)
            <div x-show="slide === {{ $i }}" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                @if($anuncio->imagen_url)
                    <img src="{{ $anuncio->imagen_url }}" alt="{{ $anuncio->titulo }}" style="max-height:350px;width:100%;object-fit:cover;border-radius:8px">
                @else
                    <div style="padding:60px 40px;text-align:center">
                        <h2 style="font-family:'Rajdhani',sans-serif;font-size:2.5rem;font-weight:800;color:white;margin-bottom:12px">{{ $anuncio->titulo }}</h2>
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    @else
        {{-- Fallback hero --}}
        <div class="max-w-7xl mx-auto px-4 w-full" style="padding:60px 32px">
            <div style="color:rgba(140,198,63,0.9);font-size:0.8rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;margin-bottom:12px">✦ Tecnología Informática a tu Alcance</div>
            <h1 style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.8rem,4vw,3rem);font-weight:800;color:white;line-height:1.15;margin-bottom:16px">
                Computadoras, Laptops<br>y Accesorios en Lima
            </h1>
            <p style="color:rgba(255,255,255,0.7);font-size:0.95rem;max-width:500px;margin-bottom:28px">Los mejores precios en tecnología informática. Envíos a todo el Perú.</p>
            <div style="display:flex;gap:12px;flex-wrap:wrap">
                <a href="/categoria/computadoras" class="btn-primary">Ver computadoras</a>
                <a href="/categoria/laptops" class="btn-outline" style="border-color:rgba(255,255,255,0.5);color:white" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='transparent'">Ver laptops</a>
            </div>
        </div>
    @endif
</div>

{{-- ===== BRANDS ===== --}}
<div class="brands-bar">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between gap-6 overflow-x-auto">
        <img src="{{ asset('img/marca1.jpg') }}" alt="Marca" onerror="this.parentElement.style.display='none'">
        <img src="{{ asset('img/marca2.jpg') }}" alt="Marca" onerror="this.remove()">
        <img src="{{ asset('img/marca3.jpg') }}" alt="Marca" onerror="this.remove()">
        <img src="{{ asset('img/marca4.jpg') }}" alt="Marca" onerror="this.remove()">
        <img src="{{ asset('img/marca5.jpg') }}" alt="Marca" onerror="this.remove()">
        {{-- Fallback brand names if no images --}}
        <span style="font-size:0.75rem;font-weight:700;color:#DFE1E6;white-space:nowrap">HP • DELL • LENOVO • ASUS • ACER • INTEL • AMD</span>
    </div>
</div>

{{-- ===== MAIN CONTENT ===== --}}
<div class="max-w-7xl mx-auto px-4 py-8 flex flex-col md:flex-row gap-6">

    {{-- === SIDEBAR === --}}
    <aside style="width:220px;flex-shrink:0" class="hidden md:block">
        <div class="cat-sidebar">
            <div class="cat-sidebar-title">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;margin-right:6px;vertical-align:middle"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                Categorías
            </div>
            @if(isset($categorias) && $categorias->count())
                @foreach($categorias as $cat)
                <a href="/categoria/{{ Str::slug($cat->nombre_categoria) }}" class="cat-item">
                    {{ $cat->nombre_categoria }}
                    <span>›</span>
                </a>
                @endforeach
            @else
                <a href="/categoria/computadoras" class="cat-item">Computadoras <span>›</span></a>
                <a href="/categoria/laptops" class="cat-item">Laptops <span>›</span></a>
                <a href="/categoria/accesorios" class="cat-item">Accesorios <span>›</span></a>
                <a href="/categoria/redes" class="cat-item">Redes / Conectividad <span>›</span></a>
                <a href="/categoria/case" class="cat-item">Cases <span>›</span></a>
                <a href="/categoria/fuentes" class="cat-item">Fuentes para Case <span>›</span></a>
                <a href="/categoria/coolers" class="cat-item">Coolers / CPU <span>›</span></a>
                <a href="/categoria/monitores" class="cat-item">Monitores <span>›</span></a>
            @endif
        </div>

        {{-- Info card --}}
        <div class="cp-card mt-4 p-4" style="border-top:3px solid var(--cp-green)">
            <div style="font-size:0.75rem;font-weight:700;color:#8CC63F;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px">¿Necesitas ayuda?</div>
            <p style="font-size:0.78rem;color:#5E6C84;margin-bottom:10px" class="dark:text-gray-400">Nuestro equipo está listo para asesorarte</p>
            <a href="https://wa.me/51999999999" target="_blank" class="whatsapp-btn" style="font-size:0.72rem;justify-content:center;display:flex">
                📲 Escríbenos
            </a>
        </div>
    </aside>

    {{-- === PRODUCTS === --}}
    <section style="flex:1;min-width:0">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
            <h2 class="section-title">⭐ Más Valorados</h2>
            <a href="/buscar" style="font-size:0.82rem;color:#0052CC;font-weight:600;text-decoration:none" class="hover:underline dark:text-blue-400">Ver todos →</a>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px">

            @if(isset($productos) && $productos->count())
                @foreach($productos as $producto)
                <div class="product-card fade-in-up fade-in-up-d{{ ($loop->index % 6) + 1 }}">
                    <div class="product-img-wrap">
                        @if($producto->mostrar_inicio ?? false)
                        <span class="badge-new">NUEVO</span>
                        @endif
                        @if($producto->imagen ?? false)
                            <img src="{{ asset('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}" loading="lazy">
                        @elseif($producto->fotos->first() ?? false)
                            <img src="{{ asset('storage/'.$producto->fotos->first()->ruta_foto) }}" alt="{{ $producto->nombre }}" loading="lazy">
                        @else
                            <img src="{{ asset('img/producto.webp') }}" alt="{{ $producto->nombre }}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22><rect fill=%22%23EBF3FF%22 width=%22200%22 height=%22200%22/><text x=%22100%22 y=%22100%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2240%22>💻</text></svg>'">
                        @endif
                        <button class="quick-view-btn">VISTA RÁPIDA</button>
                    </div>
                    <div class="product-body">
                        <div class="product-name">{{ $producto->nombre }}</div>
                        <div style="font-size:0.72rem;color:#97A0AF">{{ $producto->marca ?? '' }}</div>
                        <div class="product-price">S/ {{ number_format($producto->precio, 2) }}</div>
                        <div style="font-size:0.72rem;margin-bottom:4px">
                            @if(($producto->stock ?? 0) > 0)
                                <span style="color:#22C55E;font-weight:600">✓ En stock ({{ $producto->stock }})</span>
                            @else
                                <span style="color:#EF4444;font-weight:600">Sin stock</span>
                            @endif
                        </div>
                        <div class="product-actions">
                            <form action="{{ route('carrito.store') }}" method="POST" style="flex:1">
                                @csrf
                                <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">
                                <input type="hidden" name="cantidad" value="1">
                                <button type="submit" class="btn-cart w-full">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    Agregar
                                </button>
                            </form>
                            <a href="/producto/{{ $producto->id_producto }}" style="display:flex;align-items:center;padding:9px 10px;background:#EBF3FF;border-radius:6px;color:#0052CC;transition:all 0.2s;font-size:0.78rem;text-decoration:none;font-weight:600" class="dark:bg-blue-900/30 dark:text-blue-400 hover:bg-blue-600 hover:text-white">
                                Ver
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                {{-- Skeleton placeholders --}}
                @for($i = 0; $i < 6; $i++)
                <div class="product-card" style="animation-delay:{{ $i * 0.06 }}s">
                    <div class="product-img-wrap">
                        <div style="font-size:60px;opacity:0.15">💻</div>
                    </div>
                    <div class="product-body">
                        <div class="skeleton" style="height:14px;width:80%;margin-bottom:6px"></div>
                        <div class="skeleton" style="height:14px;width:60%;margin-bottom:8px"></div>
                        <div class="skeleton" style="height:22px;width:50%;margin-bottom:10px"></div>
                        <div class="skeleton" style="height:36px;width:100%;border-radius:6px"></div>
                    </div>
                </div>
                @endfor
            @endif
        </div>

        {{-- Más productos --}}
        @if(isset($productos) && $productos->count())
        <div style="margin-top:32px;padding-top:32px;border-top:1px solid #DFE1E6" class="dark:border-gray-700">
            <h2 class="section-title">🔥 Ofertas del día</h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px">
                @foreach($productos->take(4) as $producto)
                <div class="product-card">
                    <div class="product-img-wrap">
                        <span class="badge-offer">OFERTA</span>
                        <img src="{{ asset('img/producto.webp') }}" alt="{{ $producto->nombre }}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22><rect fill=%22%23FFF1F0%22 width=%22200%22 height=%22200%22/><text x=%22100%22 y=%22100%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2240%22>🖥️</text></svg>'">
                        <button class="quick-view-btn">VISTA RÁPIDA</button>
                    </div>
                    <div class="product-body">
                        <div class="product-name">{{ $producto->nombre }}</div>
                        <div class="product-price">S/ {{ number_format($producto->precio * 0.9, 2) }}</div>
                        <div style="font-size:0.75rem;color:#97A0AF;text-decoration:line-through;margin-top:-6px">S/ {{ number_format($producto->precio, 2) }}</div>
                        <div class="product-actions">
                            <form action="{{ route('carrito.store') }}" method="POST" style="flex:1">
                                @csrf
                                <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">
                                <input type="hidden" name="cantidad" value="1">
                                <button type="submit" class="btn-cart w-full">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    Agregar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </section>
</div>

{{-- ===== FEATURES STRIP ===== --}}
<div style="background:linear-gradient(90deg,#091E42,#003A99);margin-top:40px;padding:32px 0">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-6 text-center text-white">
        <div>
            <div style="font-size:2rem;margin-bottom:8px">🚚</div>
            <div style="font-weight:700;font-size:0.9rem">Envío a Lima</div>
            <div style="font-size:0.75rem;color:rgba(255,255,255,0.6)">Delivery rápido</div>
        </div>
        <div>
            <div style="font-size:2rem;margin-bottom:8px">🛡️</div>
            <div style="font-weight:700;font-size:0.9rem">Garantía oficial</div>
            <div style="font-size:0.75rem;color:rgba(255,255,255,0.6)">Productos originales</div>
        </div>
        <div>
            <div style="font-size:2rem;margin-bottom:8px">💳</div>
            <div style="font-weight:700;font-size:0.9rem">Pago seguro</div>
            <div style="font-size:0.75rem;color:rgba(255,255,255,0.6)">Múltiples métodos</div>
        </div>
        <div>
            <div style="font-size:2rem;margin-bottom:8px">🔧</div>
            <div style="font-weight:700;font-size:0.9rem">Soporte técnico</div>
            <div style="font-size:0.75rem;color:rgba(255,255,255,0.6)">Atención personalizada</div>
        </div>
    </div>
</div>

@endsection
