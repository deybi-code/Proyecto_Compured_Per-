@extends('layouts.admin')

@section('title', 'Ventas')

@section('content')

<div class="card">
    <h2>Registrar Venta (Tienda Física)</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    @if($errors->any())
        <div style="color:red;margin-bottom:15px;">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.ventas.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:12px;">
            <label>Producto</label><br>
            <select name="id_producto" style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">
                <option value="">— Selecciona un producto —</option>
                @foreach($productos as $p)
                    <option value="{{ $p->id_producto }}" {{ old('id_producto') == $p->id_producto ? 'selected' : '' }}>
                        {{ $p->nombre }} — S/ {{ number_format($p->precio, 2) }} (Stock: {{ $p->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:12px;">
            <label>Cantidad</label><br>
            <input type="number" name="cantidad" min="1" value="{{ old('cantidad', 1) }}"
                   style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">
        </div>

        <div style="margin-bottom:12px;">
            <label>Nombre del Cliente</label><br>
            <input type="text" name="nombre_cliente" value="{{ old('nombre_cliente') }}"
                   style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Método de Pago</label><br>
            <select name="metodo_pago" style="width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:6px;">
                <option value="efectivo" {{ old('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                <option value="tarjeta"  {{ old('metodo_pago') == 'tarjeta'  ? 'selected' : '' }}>Tarjeta</option>
                <option value="yape"     {{ old('metodo_pago') == 'yape'     ? 'selected' : '' }}>Yape</option>
                <option value="plin"     {{ old('metodo_pago') == 'plin'     ? 'selected' : '' }}>Plin</option>
            </select>
        </div>

        <button type="submit"
                style="padding:10px 20px;background:#16a34a;color:white;border:none;border-radius:6px;cursor:pointer;">
            Registrar Venta
        </button>
    </form>
</div>

@endsection
