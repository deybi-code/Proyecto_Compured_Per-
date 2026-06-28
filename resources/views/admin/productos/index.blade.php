@extends('layouts.admin')
@section('title', 'Productos – Admin Compured Perú')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px">
    <div>
        <h1 style="font-family:'Rajdhani',sans-serif;font-size:1.6rem;font-weight:800;color:#172B4D" class="dark:text-white">Gestión de Productos</h1>
        <p style="font-size:0.82rem;color:#97A0AF;margin-top:2px">{{ isset($productos) ? $productos->total() ?? $productos->count() : 0 }} productos registrados</p>
    </div>
    <a href="{{ route('admin.productos.create') }}" class="btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Nuevo producto
    </a>
</div>

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:14px;margin-bottom:24px">
    <div class="cp-card" style="padding:16px;border-left:4px solid #0052CC">
        <div style="font-size:0.72rem;color:#97A0AF;text-transform:uppercase;letter-spacing:0.5px">Total</div>
        <div style="font-family:'Rajdhani',sans-serif;font-size:1.8rem;font-weight:800;color:#0052CC">{{ isset($productos) ? $productos->count() : 0 }}</div>
    </div>
    <div class="cp-card" style="padding:16px;border-left:4px solid #22C55E">
        <div style="font-size:0.72rem;color:#97A0AF;text-transform:uppercase;letter-spacing:0.5px">Con stock</div>
        <div style="font-family:'Rajdhani',sans-serif;font-size:1.8rem;font-weight:800;color:#22C55E">{{ isset($productos) ? $productos->where('stock','>',0)->count() : 0 }}</div>
    </div>
    <div class="cp-card" style="padding:16px;border-left:4px solid #EF4444">
        <div style="font-size:0.72rem;color:#97A0AF;text-transform:uppercase;letter-spacing:0.5px">Sin stock</div>
        <div style="font-family:'Rajdhani',sans-serif;font-size:1.8rem;font-weight:800;color:#EF4444">{{ isset($productos) ? $productos->where('stock','<=',0)->count() : 0 }}</div>
    </div>
    <div class="cp-card" style="padding:16px;border-left:4px solid #8CC63F">
        <div style="font-size:0.72rem;color:#97A0AF;text-transform:uppercase;letter-spacing:0.5px">Stock bajo (&le;5)</div>
        <div style="font-family:'Rajdhani',sans-serif;font-size:1.8rem;font-weight:800;color:#8CC63F">{{ isset($productos) ? $productos->where('stock','<=',5)->where('stock','>',0)->count() : 0 }}</div>
    </div>
</div>

<div class="cp-card overflow-hidden">
    <div style="padding:14px 20px;border-bottom:1px solid #DFE1E6;background:#F4F5F7;display:flex;align-items:center;gap:12px" class="dark:bg-gray-800 dark:border-gray-700">
        <svg width="16" height="16" fill="none" stroke="#0052CC" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        <span style="font-weight:700;font-size:0.88rem;color:#172B4D" class="dark:text-white">Lista de productos</span>
    </div>
    <div style="overflow-x:auto">
        <table class="cp-table">
            <thead><tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr></thead>
            <tbody>
            @forelse($productos as $p)
            <tr>
                <td style="font-family:monospace;font-size:0.8rem;color:#97A0AF">#{{ $p->id_producto }}</td>
                <td>
                    <div style="display:flex;align-items:center;gap:10px">
                        <div style="width:40px;height:40px;background:#EBF3FF;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0">💻</div>
                        <div>
                            <div style="font-weight:600;font-size:0.87rem;color:#172B4D" class="dark:text-gray-200">{{ Str::limit($p->nombre,45) }}</div>
                            <div style="font-size:0.72rem;color:#97A0AF">{{ $p->marca ?? '' }}</div>
                        </div>
                    </div>
                </td>
                <td style="font-family:'Rajdhani',sans-serif;font-size:1.1rem;font-weight:700;color:#0052CC" class="dark:text-blue-400">S/ {{ number_format($p->precio,2) }}</td>
                <td>
                    @if($p->stock <= 0)
                        <span class="status-badge status-red">Sin stock</span>
                    @elseif($p->stock <= 5)
                        <span class="status-badge status-yellow">{{ $p->stock }} (bajo)</span>
                    @else
                        <span class="status-badge status-green">{{ $p->stock }}</span>
                    @endif
                </td>
                <td style="font-size:0.82rem;color:#5E6C84" class="dark:text-gray-400">{{ $p->categoria->nombre_categoria ?? '—' }}</td>
                <td><span class="status-badge {{ $p->mostrar_inicio ? 'status-green' : 'status-blue' }}">{{ $p->mostrar_inicio ? 'En home' : 'Activo' }}</span></td>
                <td>
                    <div style="display:flex;gap:8px;align-items:center">
                        <a href="{{ route('admin.productos.edit',$p->id_producto) }}" style="display:inline-flex;align-items:center;gap:4px;padding:5px 10px;background:#EBF3FF;color:#0052CC;border-radius:5px;font-size:0.78rem;font-weight:600;text-decoration:none;transition:background 0.15s" class="hover:bg-blue-600 hover:text-white dark:bg-blue-900/30 dark:text-blue-400">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Editar
                        </a>
                        <form action="{{ route('admin.productos.destroy',$p->id_producto) }}" method="POST" onsubmit="return confirm('¿Eliminar {{ addslashes($p->nombre) }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger" style="display:inline-flex;align-items:center;gap:4px;padding:5px 10px">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;padding:40px;color:#97A0AF">
                <div style="font-size:40px;margin-bottom:10px">📦</div>
                No hay productos. <a href="{{ route('admin.productos.create') }}" style="color:#0052CC;font-weight:600">Crea el primero</a>
            </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@if(isset($productos) && method_exists($productos,'links'))
<div style="margin-top:16px">{{ $productos->links() }}</div>
@endif
@endsection
