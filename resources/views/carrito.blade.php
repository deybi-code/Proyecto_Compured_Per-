@extends('layouts.main')
@section('title', 'Carrito de Compras – Compured Perú')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <nav class="breadcrumb"><a href="/">Inicio</a><span>›</span><span>Carrito de compras</span></nav>

    @if(session('success'))<div class="alert-success">{{ session('success') }}</div>@endif

    @if(empty($carrito))
    <div class="cart-empty">
        <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin:0 auto 20px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        <h2 style="font-size:1.3rem;font-weight:700;color:#172B4D;margin-bottom:8px" class="dark:text-white">Tu carrito está vacío</h2>
        <p style="color:#97A0AF;margin-bottom:24px">Agrega productos para comenzar tu compra</p>
        <a href="/" class="btn-primary">Ver productos</a>
    </div>
    @else
    @php $total = collect($carrito)->sum(fn($i) => $i['precio'] * $i['cantidad']); @endphp
    <div class="flex flex-col lg:flex-row gap-6">
        <div style="flex:1">
            <div class="cp-card overflow-hidden">
                <div style="padding:16px 20px;border-bottom:1px solid #DFE1E6;display:flex;align-items:center;gap:10px;background:#F4F5F7" class="dark:bg-gray-800 dark:border-gray-700">
                    <svg width="18" height="18" fill="none" stroke="#0052CC" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span style="font-weight:700;font-size:0.9rem;color:#172B4D" class="dark:text-white">{{ count($carrito) }} producto(s) en tu carrito</span>
                </div>
                <table class="cp-table">
                    <thead><tr>
                        <th>Producto</th>
                        <th style="text-align:center">Precio</th>
                        <th style="text-align:center">Cantidad</th>
                        <th style="text-align:center">Subtotal</th>
                        <th></th>
                    </tr></thead>
                    <tbody>
                    @foreach($carrito as $id => $item)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:12px">
                                <div style="width:56px;height:56px;background:#EBF3FF;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0">💻</div>
                                <span style="font-weight:600;font-size:0.87rem;color:#172B4D" class="dark:text-gray-200">{{ $item['nombre'] }}</span>
                            </div>
                        </td>
                        <td style="text-align:center;color:#5E6C84" class="dark:text-gray-400">S/ {{ number_format($item['precio'],2) }}</td>
                        <td style="text-align:center">
                            <span style="display:inline-block;padding:4px 16px;background:#EBF3FF;border-radius:20px;font-weight:700;color:#0052CC;font-size:0.88rem" class="dark:bg-blue-900/30">{{ $item['cantidad'] }}</span>
                        </td>
                        <td style="text-align:center;font-weight:800;color:#0052CC;font-size:1rem;font-family:'Rajdhani',sans-serif" class="dark:text-blue-400">S/ {{ number_format($item['precio']*$item['cantidad'],2) }}</td>
                        <td style="text-align:center">
                            <form action="{{ route('carrito.destroy',$id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger" title="Eliminar">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top:12px"><a href="/" style="font-size:0.83rem;color:#0052CC;font-weight:600;text-decoration:none" class="hover:underline">← Seguir comprando</a></div>
        </div>

        <div style="width:100%;max-width:320px">
            <div class="cp-card" style="border-top:3px solid #0052CC">
                <div style="padding:16px 20px;border-bottom:1px solid #DFE1E6;font-weight:700;font-size:0.9rem;color:#172B4D" class="dark:text-white dark:border-gray-700">Resumen de compra</div>
                <div style="padding:20px">
                    <div style="display:flex;justify-content:space-between;font-size:0.87rem;color:#5E6C84;margin-bottom:10px" class="dark:text-gray-400">
                        <span>Subtotal ({{ count($carrito) }} items)</span><span style="color:#172B4D;font-weight:600" class="dark:text-white">S/ {{ number_format($total,2) }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;font-size:0.87rem;color:#5E6C84;margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid #DFE1E6" class="dark:text-gray-400 dark:border-gray-700">
                        <span>Descuento</span><span style="color:#22C55E;font-weight:600">S/ 0.00</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:20px">
                        <span style="font-weight:700;color:#172B4D" class="dark:text-white">Total</span>
                        <span style="font-family:'Rajdhani',sans-serif;font-size:1.4rem;font-weight:800;color:#0052CC" class="dark:text-blue-400">S/ {{ number_format($total,2) }}</span>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn-primary w-full justify-center py-3" style="display:flex;margin-bottom:12px">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        Proceder al pago
                    </a>
                    <div style="text-align:center;font-size:0.72rem;color:#97A0AF">🔒 Pago 100% seguro y cifrado</div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
