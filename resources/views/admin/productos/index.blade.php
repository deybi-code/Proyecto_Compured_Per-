@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')

@php
    // Si ya estás pasando $productos desde controller, esto no afecta
@endphp

<div class="card" style="display:flex;justify-content:space-between;align-items:center;">
    <div>
        <h1>📦 Gestión de Productos</h1>
        <p style="opacity:.7;">Administra productos, stock, precios e imágenes</p>
    </div>

    <a href="{{ route('admin.productos.create') }}"
       style="background:#2563eb;color:white;padding:10px 14px;border-radius:8px;text-decoration:none;">
        + Nuevo Producto
    </a>
</div>

<div class="card">

    <table width="100%" cellpadding="10" style="border-collapse:collapse;">

        <thead>
            <tr style="text-align:left;border-bottom:1px solid #e5e7eb;">
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

        @foreach($productos as $p)

            <tr style="border-bottom:1px solid #f1f1f1;">

                {{-- 🖼 IMAGEN --}}
                <td>
                    @if(isset($p->imagen) && $p->imagen)
                        <img src="{{ asset('storage/'.$p->imagen) }}"
                             width="55"
                             style="border-radius:8px;">
                    @else
                        <span style="opacity:.5;">Sin imagen</span>
                    @endif
                </td>

                {{-- 📦 NOMBRE --}}
                <td>
                    <strong>{{ $p->nombre }}</strong>
                </td>

                {{-- 💰 PRECIO --}}
                <td>
                    S/ {{ $p->precio }}
                </td>

                {{-- 📊 STOCK --}}
                <td>
                    @if($p->stock > 10)
                        <span style="color:green;font-weight:600;">
                            {{ $p->stock }}
                        </span>
                    @elseif($p->stock > 0)
                        <span style="color:orange;font-weight:600;">
                            {{ $p->stock }}
                        </span>
                    @else
                        <span style="color:red;font-weight:600;">
                            Sin stock
                        </span>
                    @endif
                </td>

                {{-- ⚙ ACCIONES --}}
                <td style="display:flex;gap:8px;align-items:center;">

                    {{-- ✏️ EDITAR (CORREGIDO 100%) --}}
                    <a href="{{ route('admin.productos.edit', ['producto' => $p->id_producto]) }}"
                       style="background:#e0f2fe;color:#0369a1;padding:6px 10px;border-radius:6px;text-decoration:none;font-size:13px;">
                        Editar
                    </a>

                    {{-- 🗑 ELIMINAR --}}
                    <form action="{{ route('admin.productos.destroy', ['producto' => $p->id_producto]) }}"
                          method="POST"
                          onsubmit="return confirm('¿Eliminar este producto?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                style="background:#fee2e2;color:#b91c1c;border:none;padding:6px 10px;border-radius:6px;cursor:pointer;">
                            Eliminar
                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection
