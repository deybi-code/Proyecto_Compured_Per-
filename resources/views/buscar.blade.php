@extends('layouts.main')
@section('title', 'Resultados de búsqueda – Compured Perú')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div style="margin-bottom:24px">
        <h1 style="font-family:'Rajdhani',sans-serif;font-size:1.5rem;font-weight:800;color:#172B4D" class="dark:text-white">
            Resultados para: <span style="color:#0052CC">"{{ request('q') }}"</span>
        </h1>
        <p style="font-size:0.83rem;color:#97A0AF;margin-top:4px">{{ isset($productos) ? $productos->count() : 0 }} productos encontrados</p>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px">
        @forelse($productos ?? [] as $p)
        <div class="product-card fade-in-up">
            <div class="product-img-wrap">
                <img src="{{ asset('img/producto.webp') }}" alt="{{ $p->nombre }}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22><rect fill=%22%23EBF3FF%22 width=%22200%22 height=%22200%22/><text x=%22100%22 y=%22100%22 text-anchor=%22middle%22 dy=%22.35em%22 font-size=%2240%22>💻</text></svg>'">
                <button class="quick-view-btn">VISTA RÁPIDA</button>
            </div>
            <div class="product-body">
                <div class="product-name">{{ $p->nombre }}</div>
                <div class="product-price">S/ {{ number_format($p->precio,2) }}</div>
                <div class="product-actions">
                    <form action="{{ route('carrito.store') }}" method="POST" style="flex:1">
                        @csrf
                        <input type="hidden" name="id_producto" value="{{ $p->id_producto }}">
                        <input type="hidden" name="cantidad" value="1">
                        <button type="submit" class="btn-cart w-full">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Agregar
                        </button>
                    </form>
                    <a href="/producto/{{ $p->id_producto }}" style="display:flex;align-items:center;padding:9px 10px;background:#EBF3FF;border-radius:6px;color:#0052CC;text-decoration:none;font-size:0.78rem;font-weight:600" class="dark:bg-blue-900/30 dark:text-blue-400 hover:bg-blue-600 hover:text-white">Ver</a>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1;text-align:center;padding:60px 20px">
            <div style="font-size:60px;margin-bottom:16px">🔍</div>
            <h2 style="font-weight:700;color:#172B4D;margin-bottom:8px" class="dark:text-white">Sin resultados</h2>
            <p style="color:#97A0AF;margin-bottom:20px">No encontramos productos para "{{ request('q') }}"</p>
            <a href="/" class="btn-primary">Ver todos los productos</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
