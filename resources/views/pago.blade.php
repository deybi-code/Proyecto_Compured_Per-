@extends('layouts.main')
@section('title', 'Checkout – Compured Perú')
@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <nav class="breadcrumb mb-6"><a href="/">Inicio</a><span>›</span><a href="/carrito">Carrito</a><span>›</span><span>Checkout</span></nav>
    <h1 style="font-family:'Rajdhani',sans-serif;font-size:1.6rem;font-weight:800;color:#172B4D;margin-bottom:24px" class="dark:text-white">Finalizar compra</h1>

    <div class="flex flex-col lg:flex-row gap-6">
        <div style="flex:1">
            <div class="cp-card" style="padding:28px;margin-bottom:16px">
                <h2 style="font-weight:700;font-size:1rem;color:#172B4D;margin-bottom:20px;display:flex;align-items:center;gap:8px" class="dark:text-white">
                    <svg width="18" height="18" fill="none" stroke="#0052CC" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Datos de envío
                </h2>
                <form method="POST" action="{{ route('pago.procesar') ?? '#' }}">
                    @csrf
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                        <div style="grid-column:1/-1">
                            <label class="cp-label">Nombre completo *</label>
                            <input type="text" name="nombre" class="cp-input" value="{{ auth()->user()->nombre_completo ?? '' }}" required>
                        </div>
                        <div>
                            <label class="cp-label">Correo *</label>
                            <input type="email" name="email" class="cp-input" value="{{ auth()->user()->correo ?? auth()->user()->email ?? '' }}" required>
                        </div>
                        <div>
                            <label class="cp-label">Teléfono</label>
                            <input type="text" name="telefono" class="cp-input" placeholder="999 999 999">
                        </div>
                        <div style="grid-column:1/-1">
                            <label class="cp-label">Dirección de entrega *</label>
                            <input type="text" name="direccion" class="cp-input" placeholder="Av. Ejemplo 123, Lima" required>
                        </div>
                    </div>

                    <div style="margin-top:24px;padding-top:20px;border-top:1px solid #DFE1E6" class="dark:border-gray-700">
                        <h3 style="font-weight:700;font-size:0.92rem;color:#172B4D;margin-bottom:14px" class="dark:text-white">Método de pago</h3>
                        <div style="display:flex;flex-direction:column;gap:10px">
                            @foreach(['Transferencia bancaria' => '🏦', 'Yape / Plin' => '📱', 'Tarjeta de crédito/débito' => '💳', 'Pago contra entrega' => '🤝'] as $method => $icon)
                            <label style="display:flex;align-items:center;gap:12px;padding:14px;border:2px solid #DFE1E6;border-radius:8px;cursor:pointer;transition:border-color 0.2s" class="dark:border-gray-700 hover:border-blue-400">
                                <input type="radio" name="metodo_pago" value="{{ $method }}" style="accent-color:#0052CC" {{ $loop->first ? 'checked' : '' }}>
                                <span style="font-size:1.1rem">{{ $icon }}</span>
                                <span style="font-weight:600;font-size:0.88rem;color:#172B4D" class="dark:text-gray-200">{{ $method }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center py-3 mt-6">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Confirmar pedido
                    </button>
                </form>
            </div>
        </div>

        <div style="width:100%;max-width:300px">
            <div class="cp-card" style="border-top:3px solid #0052CC">
                <div style="padding:16px 20px;border-bottom:1px solid #DFE1E6;font-weight:700;font-size:0.9rem" class="dark:border-gray-700 dark:text-white">Resumen del pedido</div>
                <div style="padding:16px 20px">
                    @if(isset($carrito))
                    @foreach($carrito as $item)
                    <div style="display:flex;justify-content:space-between;font-size:0.83rem;margin-bottom:8px;color:#5E6C84" class="dark:text-gray-400">
                        <span>{{ Str::limit($item['nombre'],30) }} ×{{ $item['cantidad'] }}</span>
                        <span style="font-weight:600">S/ {{ number_format($item['precio']*$item['cantidad'],2) }}</span>
                    </div>
                    @endforeach
                    <div style="border-top:1px solid #DFE1E6;margin:12px 0;padding-top:12px;display:flex;justify-content:space-between;font-family:'Rajdhani',sans-serif;font-size:1.3rem;font-weight:800;color:#0052CC" class="dark:border-gray-700 dark:text-blue-400">
                        <span>TOTAL</span><span>S/ {{ number_format(collect($carrito)->sum(fn($i)=>$i['precio']*$i['cantidad']),2) }}</span>
                    </div>
                    @endif
                    <div style="font-size:0.72rem;color:#97A0AF;text-align:center;margin-top:8px">🔒 Pago seguro y cifrado</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
