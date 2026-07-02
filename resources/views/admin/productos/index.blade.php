@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')

<div class="card" style="border-top: 4px solid #0056b3; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">

    {{-- HEADER --}}
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">

        <div>
            <h1 style="color: #0056b3;">📦 Gestión de Productos</h1>
            <p style="color:#6b7280;">Administra productos, stock, imágenes y precios</p>
        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">

            {{-- BUSCADOR --}}
            <form method="GET" action="{{ route('admin.productos.index') }}" style="display:flex;">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="🔎 Buscar producto..."
                       style="padding:8px;border:1px solid #ddd;border-radius:8px; outline:none; min-width:200px;">
            </form>

            {{-- BOTÓN CREAR --}}
            <a href="{{ route('admin.productos.create') }}"
               style="background:#0056b3;color:white;padding:10px 14px;border-radius:8px;text-decoration:none; font-weight: 600;">
                + Nuevo Producto
            </a>

            {{-- IMPORT EXCEL --}}
            <button onclick="document.getElementById('importModal').style.display='flex'"
                    style="background:#9ad800;color:#000;padding:10px 14px;border:none;border-radius:8px;cursor:pointer; font-weight: 600;">
                ⬆ Importar Excel
            </button>

            {{-- ELIMINAR MASIVO --}}
            <form method="POST" action="{{ route('admin.productos.destroyMultiple') }}" id="bulkDeleteForm" style="display:inline;">
                @csrf
                <button type="submit" onclick="return confirm('¿Estás seguro de eliminar los productos seleccionados?')" style="background:#ef4444;color:white;padding:10px 14px;border:none;border-radius:8px;cursor:pointer; font-weight: 600;">
                    🗑 Eliminar seleccionados
                </button>
            </form>

        </div>

    </div>

</div>

{{-- DASHBOARD STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-top:15px;">

    <div class="card" style="border-bottom: 3px solid #0056b3;">
        <h3 style="color: #666; font-size: 0.9rem;">Total Productos</h3>
        <h2 style="color: #0056b3;">{{ $productos->count() }}</h2>
    </div>

    <div class="card" style="border-bottom: 3px solid #ef4444;">
        <h3 style="color: #666; font-size: 0.9rem;">Stock Bajo</h3>
        <h2 style="color:red;">
            {{ $productos->where('stock','<',5)->count() }}
        </h2>
    </div>

    <div class="card" style="border-bottom: 3px solid #9ad800;">
        <h3 style="color: #666; font-size: 0.9rem;">Productos Activos</h3>
        <h2 style="color:green;">
            {{ $productos->where('stock','>',0)->count() }}
        </h2>
    </div>

</div>

{{-- TABLA --}}
<div class="card" style="margin-top:15px;overflow-x:auto; padding: 0;">

<table class="table-responsive-card" width="100%" cellpadding="15" style="border-collapse:collapse;">

    <thead style="background:#f8fafc; border-bottom: 2px solid #e2e8f0;">
        <tr style="text-align: left; color: #374151;">
            <th><input type="checkbox" id="selectAll"></th>
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

        <tr style="border-bottom:1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#fdfdfd'">

            {{-- CHECK --}}
            <td data-label="Seleccionar"><input type="checkbox" name="productos[]" value="{{ $p->id_producto }}" class="product-checkbox"></td>

            {{-- IMAGEN CORREGIDA --}}
            <td data-label="Imagen">
                @php $foto = $p->fotos->first(); @endphp
                @if($foto)
                    <img src="{{ str_starts_with($foto->ruta_foto, 'http') ? $foto->ruta_foto : asset('storage/'.$foto->ruta_foto) }}"
                         style="width:50px;height:50px;border-radius:8px;object-fit:cover; border: 1px solid #eee;">
                @else
                    <div style="width:50px;height:50px;background:#ddd;border-radius:8px; display:flex; align-items:center; justify-content:center; color:#666; font-size:10px;">Sin foto</div>
                @endif
            </td>

            {{-- NOMBRE --}}
            <td data-label="Producto">
                <strong style="color: #1e293b;">{{ $p->nombre }}</strong>
                <div style="font-size:12px;color:#6b7280;">
                    ID: {{ $p->id_producto }}
                </div>
            </td>

            {{-- PRECIO --}}
            <td data-label="Precio" style="font-weight: 600;">S/ {{ number_format($p->precio, 2) }}</td>

            {{-- STOCK --}}
            <td data-label="Stock">
                @if($p->stock <= 0)
                    <span style="color:red;font-weight:bold; background: #fee2e2; padding: 4px 8px; border-radius: 6px;">Agotado</span>
                @elseif($p->stock < 5)
                    <span style="color:orange;font-weight:bold; background: #fef3c7; padding: 4px 8px; border-radius: 6px;">{{ $p->stock }}</span>
                @else
                    <span style="color:green;font-weight:bold; background: #dcfce7; padding: 4px 8px; border-radius: 6px;">{{ $p->stock }}</span>
                @endif
            </td>

            {{-- ESTADO --}}
            <td data-label="Estado">
                @if($p->stock > 0)
                    <span style="background:#dcfce7;color:#166534;padding:4px 8px;border-radius:6px; font-size: 0.85rem;">
                        Activo
                    </span>
                @else
                    <span style="background:#fee2e2;color:#991b1b;padding:4px 8px;border-radius:6px; font-size: 0.85rem;">
                        Sin stock
                    </span>
                @endif
            </td>

            {{-- ACCIONES --}}
            <td data-label="Acciones" style="display:flex;gap:6px;flex-wrap:wrap; align-items: center; margin-top: 5px;">

                {{-- EDITAR --}}
                <a href="{{ route('admin.productos.edit', $p) }}"
                   style="background:#fef3c7;color:#92400e;padding:6px 10px;border-radius:6px;text-decoration:none; font-weight: 500;">
                    ✏️ Editar
                </a>

                {{-- ELIMINAR --}}
                <form method="POST" action="{{ route('admin.productos.destroy', $p) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('¿Eliminar producto?')"
                            style="background:#fee2e2;color:#b91c1c;padding:6px 10px;border:none;border-radius:6px; cursor: pointer;">
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
<div class="card" style="margin-top:15px; border-left: 4px solid #9ad800;">

    <h3 style="margin-top:0;">📸 Preview de productos (Galería futura)</h3>
    <p style="color:#6b7280; margin-bottom: 0;">
        Aquí se integrará slider tipo MercadoLibre / Amazon
    </p>

</div>

{{-- MODAL IMPORTAR EXCEL --}}
<div id="importModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:white;padding:30px;border-radius:12px;max-width:500px;width:90%;box-shadow:0 10px 40px rgba(0,0,0,0.2);">
        <h2 style="margin:0 0 20px 0;color:#0056b3;">📊 Importar Productos desde Excel</h2>
        <p style="color:#6b7280;margin-bottom:20px;">
            Formato esperado: Nombre, Precio, Stock, Marca, Categoría, Detalles (opcional)
        </p>
        <form method="POST" action="{{ route('admin.productos.importar') }}" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:20px;">
                <label style="display:block;font-weight:600;margin-bottom:8px;">Archivo Excel (.xlsx, .xls, .csv)</label>
                <input type="file"
                       name="archivo_excel"
                       accept=".xlsx,.xls,.csv"
                       required
                       style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
            </div>
            <div style="display:flex;gap:10px;justify-content:flex-end;">
                <button type="button"
                        onclick="document.getElementById('importModal').style.display='none'"
                        style="background:#6b7280;color:white;padding:10px 20px;border:none;border-radius:8px;cursor:pointer;">
                    Cancelar
                </button>
                <button type="submit"
                        style="background:#9ad800;color:#000;padding:10px 20px;border:none;border-radius:8px;cursor:pointer;font-weight:600;">
                    Importar
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Seleccionar/deseleccionar todos
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.product-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    // Habilitar/deshabilitar botón de eliminación masiva
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const bulkDeleteBtn = document.querySelector('#bulkDeleteForm button');

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            const anyChecked = document.querySelectorAll('.product-checkbox:checked').length > 0;
            bulkDeleteBtn.disabled = !anyChecked;
            bulkDeleteBtn.style.opacity = anyChecked ? '1' : '0.5';
        });
    });

    // Inicializar estado del botón
    bulkDeleteBtn.disabled = true;
    bulkDeleteBtn.style.opacity = '0.5';
</script>
@endpush
