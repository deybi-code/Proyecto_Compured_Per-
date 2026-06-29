@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">

        <div>
            <h1>📦 Gestión de Productos</h1>
            <p style="color:#6b7280;">Administra productos, stock, imágenes y precios</p>
        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">

            {{-- BUSCADOR (UI) --}}
            <input type="text" placeholder="🔎 Buscar producto..."
                   style="padding:8px;border:1px solid #ddd;border-radius:8px;">

            {{-- BOTÓN CREAR --}}
            <a href="{{ route('admin.productos.create') }}"
               style="background:#2563eb;color:white;padding:10px 14px;border-radius:8px;text-decoration:none;">
                + Nuevo Producto
            </a>

            {{-- IMPORT EXCEL --}}
            <button style="background:#10b981;color:white;padding:10px 14px;border:none;border-radius:8px;cursor:pointer;">
                ⬆ Importar Excel
            </button>

            {{-- ELIMINAR MASIVO --}}
            <button style="background:#ef4444;color:white;padding:10px 14px;border:none;border-radius:8px;cursor:pointer;">
                🗑 Eliminar seleccionados
            </button>

        </div>

    </div>

</div>

{{-- DASHBOARD STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-top:15px;">

    <div class="card">
        <h3>Total Productos</h3>
        <h2>{{ $productos->count() }}</h2>
    </div>

    <div class="card">
        <h3>Stock Bajo</h3>
        <h2 style="color:red;">
            {{ $productos->where('stock','<',5)->count() }}
        </h2>
    </div>

    <div class="card">
        <h3>Productos Activos</h3>
        <h2 style="color:green;">
            {{ $productos->where('stock','>',0)->count() }}
        </h2>
    </div>

</div>

{{-- TABLA --}}
<div class="card" style="margin-top:15px;overflow-x:auto;">

<table width="100%" cellpadding="10" style="border-collapse:collapse;">

    <thead style="background:#f3f4f6;">
        <tr>
            <th><input type="checkbox"></th>
            <th>Imagen</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

    @foreach($productos as $p)

        <tr style="border-bottom:1px solid #eee;">

            {{-- CHECK --}}
            <td><input type="checkbox"></td>

            {{-- IMAGEN --}}
            <td>
                @if($p->imagen_1)
                    <img src="{{ asset('storage/'.$p->imagen_1) }}"
                         style="width:50px;height:50px;border-radius:8px;object-fit:cover;">
                @else
                    <div style="width:50px;height:50px;background:#ddd;border-radius:8px;"></div>
                @endif
            </td>

            {{-- NOMBRE --}}
            <td>
                <strong>{{ $p->nombre }}</strong>
                <div style="font-size:12px;color:#6b7280;">
                    ID: {{ $p->id_producto }}
                </div>
            </td>

            {{-- PRECIO --}}
            <td>S/ {{ $p->precio }}</td>

            {{-- STOCK --}}
            <td>
                @if($p->stock <= 0)
                    <span style="color:red;font-weight:bold;">Agotado</span>
                @elseif($p->stock < 5)
                    <span style="color:orange;font-weight:bold;">{{ $p->stock }}</span>
                @else
                    <span style="color:green;font-weight:bold;">{{ $p->stock }}</span>
                @endif
            </td>

            {{-- ESTADO --}}
            <td>
                @if($p->stock > 0)
                    <span style="background:#dcfce7;color:#166534;padding:4px 8px;border-radius:6px;">
                        Activo
                    </span>
                @else
                    <span style="background:#fee2e2;color:#991b1b;padding:4px 8px;border-radius:6px;">
                        Sin stock
                    </span>
                @endif
            </td>

            {{-- ACCIONES --}}
            <td style="display:flex;gap:6px;flex-wrap:wrap;">

                {{-- EDITAR --}}
                <a href="{{ route('admin.productos.edit', $p) }}"
                   style="background:#facc15;color:#000;padding:6px 10px;border-radius:6px;text-decoration:none;">
                    ✏️ Editar
                </a>

                {{-- MODAL EDIT (UI FUTURO) --}}
                <button style="background:#6366f1;color:white;padding:6px 10px;border:none;border-radius:6px;">
                    ⚡ Modal
                </button>

                {{-- ELIMINAR --}}
                <form method="POST"
                      action="{{ route('admin.productos.destroy', $p) }}">
                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('¿Eliminar producto?')"
                            style="background:#ef4444;color:white;padding:6px 10px;border:none;border-radius:6px;">
                        🗑
                    </button>
                </form>

            </td>

        </tr>

    @endforeach

    </tbody>

</table>

</div>

{{-- GALERÍA PREVIEW --}}
<div class="card" style="margin-top:15px;">

    <h3>📸 Preview de productos (Galería futura)</h3>
    <p style="color:#6b7280;">
        Aquí se integrará slider tipo MercadoLibre / Amazon
    </p>

</div>

@endsection
