@extends('layouts.main')

@section('title', (isset($producto) ? $producto->nombre : 'Detalle') . ' – Compured Perú')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- Breadcrumb --}}
    <nav class="breadcrumb mb-6">
        <a href="/">Inicio</a>
        <span>›</span>
        @if(isset($producto) && $producto->categoria)
        <a href="/categoria/{{ Str::slug($producto->categoria->nombre_categoria) }}">{{ $producto->categoria->nombre_categoria }}</a>
        <span>›</span>
        @endif
        <span>{{ isset($producto) ? Str::limit($producto->nombre, 50) : 'Producto' }}</span>
    </nav>

    <div class="cp-card p-6 md:p-8" x-data="{ cantidad: 1, tab: 'descripcion', imgSrc: '{{ isset($producto) && ($producto->imagen ?? false) ? asset('storage/'.$producto->imagen) : asset('img/producto.webp') }}' }">
        <div class="flex flex-col md:flex-row gap-8">

            {{-- ===== IMAGEN ===== --}}
            <div style="flex:1">
                <div class="product-detail-img">
                    <img :src="imgSrc" alt="{{ isset($producto) ? $producto->nombre : 'Producto' }}" style="max-height:360px;max-width:100%;object-fit:contain;transition:opacity 0.3s" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 300 300%22><rect fill=%22%23EBF3FF%22 width=%22300%22 height=%22300%22/><text x=%22150%22 y=%22150%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2280%22>💻</text></svg>'">
                </div>

                {{-- Thumbnails --}}
                @if(isset($producto) && isset($producto->fotos) && $producto->fotos->count())
                <div style="display:flex;gap:8px;margin-top:12px;flex-wrap:wrap">
                    @foreach($producto->fotos as $foto)
                    <div @click="imgSrc='{{ asset('storage/'.$foto->ruta_foto) }}'" style="width:64px;height:64px;border:2px solid #DFE1E6;border-radius:6px;cursor:pointer;overflow:hidden;padding:4px;display:flex;align-items:center;justify-content:center;transition:border-color 0.2s" class="hover:border-blue-500">
                        <img src="{{ asset('storage/'.$foto->ruta_foto) }}" style="max-width:100%;max-height:100%;object-fit:contain">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- ===== DETAILS ===== --}}
            <div style="flex:1;display:flex;flex-direction:column;gap:16px">
                <div>
                    <div style="font-size:0.72rem;font-weight:700;color:#8CC63F;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px">
                        {{ isset($producto) ? ($producto->marca ?? 'COMPURED PERÚ') : 'COMPURED PERÚ' }}
                    </div>
                    <h1 style="font-size:1.4rem;font-weight:700;color:#172B4D;line-height:1.3" class="dark:text-white">
                        {{ isset($producto) ? $producto->nombre : 'Nombre del Producto' }}
                    </h1>
                </div>

                {{-- Price --}}
                <div style="background:linear-gradient(135deg,rgba(0,82,204,0.06),rgba(140,198,63,0.04));padding:16px;border-radius:10px;border:1px solid rgba(0,82,204,0.1)">
                    <div style="font-family:'Rajdhani',sans-serif;font-size:2.2rem;font-weight:800;color:#0052CC" class="dark:text-blue-400">
                        S/ {{ isset($producto) ? number_format($producto->precio, 2) : '0.00' }}
                    </div>
                    <div style="font-size:0.78rem;color:#97A0AF;margin-top:2px">Precio incluye IGV</div>
                </div>

                {{-- Stock --}}
                <div style="display:flex;align-items:center;gap:8px">
                    @if(isset($producto) && ($producto->stock ?? 0) > 0)
                        <span style="display:inline-flex;align-items:center;gap:4px;color:#22C55E;font-weight:600;font-size:0.85rem">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            En stock — {{ $producto->stock }} unidades
                        </span>
                    @else
                        <span style="color:#EF4444;font-weight:600;font-size:0.85rem">⚠ Sin stock</span>
                    @endif
                </div>

                {{-- Qty + Add to cart --}}
                <div style="display:flex;flex-wrap:wrap;gap:12px;align-items:center">
                    <div class="qty-control">
                        <button type="button" class="qty-btn" @click="if(cantidad > 1) cantidad--">−</button>
                        <input type="text" class="qty-input" x-model="cantidad" readonly>
                        <button type="button" class="qty-btn" @click="cantidad++">+</button>
                    </div>

                    <form action="{{ route('carrito.store') }}" method="POST" style="display:flex;gap:8px">
                        @csrf
                        <input type="hidden" name="id_producto" value="{{ isset($producto) ? $producto->id_producto : '' }}">
                        <input type="hidden" name="cantidad" :value="cantidad">
                        <button type="submit" class="btn-primary">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Añadir al carrito
                        </button>
                    </form>

                    <a href="{{ route('checkout') }}" class="btn-green">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Comprar ahora
                    </a>
                </div>

                {{-- WhatsApp --}}
                <a href="https://wa.me/51999999999?text=Hola!%20Quiero%20info%20sobre:%20{{ isset($producto) ? urlencode($producto->nombre) : '' }}" target="_blank" class="whatsapp-btn" style="justify-content:center;padding:10px 16px;border-radius:8px;font-size:0.85rem">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Consultar por WhatsApp
                </a>

                {{-- SKU --}}
                <div style="font-size:0.75rem;color:#97A0AF;padding-top:8px;border-top:1px solid #DFE1E6" class="dark:border-gray-700">
                    SKU: {{ isset($producto) ? ($producto->id_producto ?? 'CP-001') : 'CP-001' }}
                </div>
            </div>
        </div>

        {{-- ===== TABS ===== --}}
        <div style="margin-top:32px">
            <div class="tab-nav">
                <button class="tab-btn" :class="tab === 'descripcion' ? 'active' : ''" @click="tab = 'descripcion'">DESCRIPCIÓN</button>
                <button class="tab-btn" :class="tab === 'politica' ? 'active' : ''" @click="tab = 'politica'">POLÍTICA DE COMPRA</button>
                <button class="tab-btn" :class="tab === 'resenas' ? 'active' : ''" @click="tab = 'resenas'">RESEÑAS</button>
                <button class="tab-btn" :class="tab === 'comentarios' ? 'active' : ''" @click="tab = 'comentarios'">COMENTARIOS</button>
            </div>

            <div class="tab-panel">
                <div x-show="tab === 'descripcion'">
                    <p style="margin-bottom:16px;line-height:1.8;color:#5E6C84;font-size:0.9rem" class="dark:text-gray-400">
                        {{ isset($producto) ? ($producto->detalles_tecnicos ?? 'Sin descripción disponible para este producto.') : 'Sin descripción.' }}
                    </p>

                    @if(isset($producto))
                    <div style="display:inline-block;background:#0052CC;color:white;padding:4px 12px;border-radius:4px;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:12px">Especificaciones</div>
                    <table style="border-collapse:collapse;font-size:0.83rem;width:100%;max-width:500px">
                        <tr>
                            <td style="padding:8px 12px;background:#F4F5F7;font-weight:600;width:40%;border:1px solid #DFE1E6" class="dark:bg-gray-700 dark:border-gray-600">Marca</td>
                            <td style="padding:8px 12px;border:1px solid #DFE1E6" class="dark:border-gray-600">{{ $producto->marca ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td style="padding:8px 12px;background:#F4F5F7;font-weight:600;border:1px solid #DFE1E6" class="dark:bg-gray-700 dark:border-gray-600">Stock</td>
                            <td style="padding:8px 12px;border:1px solid #DFE1E6" class="dark:border-gray-600">{{ $producto->stock ?? 0 }} unidades</td>
                        </tr>
                        @if($producto->categoria)
                        <tr>
                            <td style="padding:8px 12px;background:#F4F5F7;font-weight:600;border:1px solid #DFE1E6" class="dark:bg-gray-700 dark:border-gray-600">Categoría</td>
                            <td style="padding:8px 12px;border:1px solid #DFE1E6" class="dark:border-gray-600">{{ $producto->categoria->nombre_categoria }}</td>
                        </tr>
                        @endif
                    </table>
                    @endif
                </div>

                <div x-show="tab === 'politica'" x-cloak>
                    <h3 style="font-weight:700;margin-bottom:10px;color:#172B4D" class="dark:text-white">Política de Compra y Devolución</h3>
                    <ul style="list-style:none;display:flex;flex-direction:column;gap:8px;font-size:0.88rem;color:#5E6C84" class="dark:text-gray-400">
                        <li>✔ 7 días para devoluciones por fallas de fábrica, presentando comprobante original</li>
                        <li>✔ El producto debe estar en su empaque original y sin uso</li>
                        <li>✔ Los daños por mal uso no están cubiertos por garantía</li>
                        <li>✔ Contáctanos por WhatsApp para iniciar el proceso</li>
                    </ul>
                </div>

                <div x-show="tab === 'resenas'" x-cloak>
                    <p style="color:#97A0AF;font-size:0.88rem">No hay reseñas todavía. ¡Sé el primero en opinar!</p>
                </div>

                <div x-show="tab === 'comentarios'" x-cloak>
                    <h3 style="font-weight:700;margin-bottom:12px;color:#172B4D;font-size:0.95rem" class="dark:text-white">Escribe un comentario</h3>
                    <textarea class="cp-input" rows="4" placeholder="Comparte tu experiencia con este producto..." style="resize:vertical"></textarea>
                    <button class="btn-primary mt-3">Publicar comentario</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
