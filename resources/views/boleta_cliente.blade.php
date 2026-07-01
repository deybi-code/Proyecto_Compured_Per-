@extends('layouts.main')
@section('title', $numeroComprobante . ' – Compured Perú')
@section('content')
<div style="max-width:820px;margin:0 auto;padding:32px 16px;">

    <nav class="breadcrumb mb-6"><a href="/">Inicio</a><span>›</span><a href="{{ route('dashboard') }}">Mis pedidos</a><span>›</span><span>{{ $numeroComprobante }}</span></nav>

    @if(session('success'))
    <div class="cp-flash-msg cp-flash-success" style="margin-bottom:18px;">✅ {{ session('success') }}</div>
    @endif

    <div id="boleta-imprimible" style="background:#fff;color:#0f172a;border:1px solid #cbd5e1;border-radius:14px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.08);">

        {{-- ===== Encabezado ===== --}}
        <div style="display:flex;justify-content:space-between;align-items:stretch;padding:22px 24px;border-bottom:3px solid {{ config('empresa.color_primario') }};gap:16px;flex-wrap:wrap;">
            <div style="display:flex;gap:14px;align-items:center;">
                <img src="{{ asset(config('empresa.logo')) }}" alt="Logo" style="height:56px;width:auto;object-fit:contain;">
                <div>
                    <div style="font-family:'Rajdhani',sans-serif;font-weight:800;font-size:1.15rem;color:{{ config('empresa.color_primario') }};line-height:1.2;">{{ config('empresa.nombre') }}</div>
                    <div style="font-size:0.72rem;color:#475569;line-height:1.5;max-width:320px;">
                        {{ config('empresa.direccion') }}<br>
                        {{ config('empresa.telefono') }} / {{ config('empresa.celular') }}<br>
                        {{ config('empresa.correo') }} · {{ config('empresa.web') }}
                    </div>
                </div>
            </div>
            <div style="border:2px solid {{ config('empresa.color_primario') }};border-radius:10px;padding:12px 20px;text-align:center;min-width:220px;">
                <div style="font-size:0.72rem;font-weight:700;color:#475569;">RUC: {{ config('empresa.ruc') }}</div>
                <div style="font-weight:800;font-size:0.85rem;color:{{ config('empresa.color_primario') }};margin-top:6px;">
                    {{ strtoupper($boleta->tipo_comprobante ?? 'BOLETA') }} DE VENTA ELECTRÓNICA
                </div>
                <div style="font-family:'Rajdhani',sans-serif;font-weight:800;font-size:1.1rem;color:#0f172a;margin-top:4px;">{{ $numeroComprobante }}</div>
            </div>
        </div>

        {{-- ===== Datos del cliente + datos de la venta ===== --}}
        <div style="display:flex;gap:0;flex-wrap:wrap;border-bottom:1px solid #cbd5e1;">
            <div style="flex:1 1 320px;padding:16px 24px;border-right:1px solid #e2e8f0;font-size:0.8rem;">
                <div style="display:grid;grid-template-columns:90px 1fr;gap:4px 8px;">
                    <div style="font-weight:700;color:#475569;">CLIENTE</div>
                    <div>{{ $boleta->nombre_cliente ?? '—' }}</div>

                    <div style="font-weight:700;color:#475569;">{{ $boleta->ruc_empresa ? 'RUC' : 'DNI' }}</div>
                    <div>{{ $boleta->ruc_empresa ?? ($boleta->dni_cliente ?? '—') }}</div>

                    <div style="font-weight:700;color:#475569;">DIRECCIÓN</div>
                    <div>{{ $boleta->direccion_cliente ?? ($boleta->canal_venta === 'Recojo en Tienda' ? 'Recojo en tienda' : '—') }}</div>

                    <div style="font-weight:700;color:#475569;">TELÉFONO</div>
                    <div>{{ $boleta->telefono_cliente ?? '—' }}</div>
                </div>
            </div>
            <div style="flex:1 1 220px;padding:16px 24px;font-size:0.8rem;">
                <div style="display:grid;grid-template-columns:110px 1fr;gap:4px 8px;">
                    <div style="font-weight:700;color:#475569;">FECHA EMISIÓN</div>
                    <div>{{ \Carbon\Carbon::parse($boleta->fecha_venta)->format('d/m/Y H:i') }}</div>

                    <div style="font-weight:700;color:#475569;">MONEDA</div>
                    <div>SOLES</div>

                    <div style="font-weight:700;color:#475569;">MÉTODO PAGO</div>
                    <div>{{ ucfirst($boleta->metodo_pago) }}</div>

                    <div style="font-weight:700;color:#475569;">ESTADO</div>
                    <div style="font-weight:700;color:{{ $boleta->estado_pedido === 'Pagado' ? '#059669' : '#b45309' }};">{{ $boleta->estado_pedido }}</div>
                </div>
            </div>
        </div>

        {{-- ===== Tabla de productos ===== --}}
        <div style="padding:0 24px;">
            <table style="width:100%;border-collapse:collapse;margin-top:12px;font-size:0.8rem;">
                <thead>
                    <tr style="background:{{ config('empresa.color_primario') }};color:#fff;">
                        <th style="text-align:left;padding:8px 10px;font-size:0.7rem;">DESCRIPCIÓN</th>
                        <th style="text-align:left;padding:8px 10px;font-size:0.7rem;">MARCA</th>
                        <th style="text-align:center;padding:8px 10px;font-size:0.7rem;">CANT.</th>
                        <th style="text-align:right;padding:8px 10px;font-size:0.7rem;">P. UNIT.</th>
                        <th style="text-align:right;padding:8px 10px;font-size:0.7rem;">IMPORTE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalles as $det)
                    <tr style="border-bottom:1px solid #e2e8f0;">
                        <td style="padding:8px 10px;">{{ $det->nombre }}</td>
                        <td style="padding:8px 10px;color:#64748b;">{{ $det->marca }}</td>
                        <td style="padding:8px 10px;text-align:center;">{{ $det->cantidad }}</td>
                        <td style="padding:8px 10px;text-align:right;">S/ {{ number_format($det->precio_unitario, 2) }}</td>
                        <td style="padding:8px 10px;text-align:right;font-weight:700;">S/ {{ number_format($det->cantidad * $det->precio_unitario, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ===== Importe en letras + totales ===== --}}
        <div style="display:flex;flex-wrap:wrap;gap:16px;padding:20px 24px;">
            <div style="flex:1 1 320px;border:1px solid #cbd5e1;border-radius:8px;padding:12px 16px;font-size:0.78rem;align-self:flex-start;">
                <div style="font-weight:700;color:#475569;font-size:0.7rem;margin-bottom:4px;">IMPORTE EN LETRAS</div>
                <div>SON: {{ $importeEnLetras }}</div>
            </div>
            <div style="flex:1 1 220px;font-size:0.82rem;">
                <div style="display:flex;justify-content:space-between;padding:4px 0;">
                    <span style="color:#475569;">Op. Gravada</span><span>S/ {{ number_format($opGravada, 2) }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;padding:4px 0;">
                    <span style="color:#475569;">IGV (18%)</span><span>S/ {{ number_format($igv, 2) }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;padding:8px 0;margin-top:4px;border-top:2px solid {{ config('empresa.color_primario') }};font-weight:800;font-size:1.05rem;">
                    <span>TOTAL</span><span style="color:{{ config('empresa.color_primario') }};">S/ {{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- ===== Pie ===== --}}
        <div style="border-top:1px solid #cbd5e1;padding:14px 24px;font-size:0.68rem;color:#64748b;text-align:center;">
            Comprobante generado por el sistema de Compured Perú a partir de tu compra en línea.
            Consérvalo como constancia de tu pedido.
        </div>
    </div>

    <div class="boleta-acciones-no-print" style="display:flex;gap:12px;margin-top:20px;">
        <button onclick="window.print()" class="btn-primary" style="flex:1;justify-content:center;">
            🖨️ Imprimir / Descargar PDF
        </button>
        <a href="{{ route('dashboard') }}" style="flex:1;text-align:center;padding:11px;border:1px solid var(--border);border-radius:10px;color:var(--text);font-weight:700;font-size:0.88rem;">
            Volver a mis pedidos
        </a>
    </div>
</div>

<style>
    @media print {
        .cp-navbar, .cp-footer, nav.breadcrumb, .cp-flash-msg, .boleta-acciones-no-print { display: none !important; }
        #boleta-imprimible { border: none !important; box-shadow: none !important; }
    }
</style>
@endsection
