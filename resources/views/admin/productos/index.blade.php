<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Compured Perú</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg-sidebar: #002b80;
            --bg-sidebar-hover: #0043a4;
            --bg-main: #f4f6f9;
            --bg-card: #ffffff;
            --text-main: #172b4d;
            --text-muted: #7a869a;
            --border-color: #dfe1e6;
            --primary-blue: #0052cc;
            --light-blue: #00a3ff;
            --success-green: #36b37e;
            --warning-orange: #ffab00;
            --danger-red: #ff5630;
            --input-bg: #ffffff;
            --shadow: 0 4px 20px rgba(0, 82, 204, 0.05);
        }

        [data-theme="dark"], body.dark-mode {
            --bg-sidebar: #0f172a;
            --bg-sidebar-hover: #1e293b;
            --bg-main: #0b0f19;
            --bg-card: #141b2d;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #222f46;
            --primary-blue: #38bdf8;
            --light-blue: #0ea5e9;
            --input-bg: #1f293d;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR COMPURED */
        .sidebar {
            width: 280px;
            background-color: var(--bg-sidebar);
            color: white;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 20px;
        }

        .sidebar-brand span { color: var(--light-blue); }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border-radius: 8px;
        }

        .sidebar-link:hover, .sidebar-link.active {
            background-color: var(--bg-sidebar-hover);
            color: white;
        }

        /* CONTENIDO */
        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .top-header h1 {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .btn-action {
            padding: 10px 20px;
            background-color: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(0, 82, 204, 0.2);
        }

        .btn-action:hover { background-color: var(--hover-blue); }

        /* MÉTRICAS */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 35px;
        }

        .metric-card {
            background-color: var(--bg-card);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-left: 4px solid var(--primary-blue);
        }

        .metric-info h3 { font-size: 13px; color: var(--text-muted); text-transform: uppercase; }
        .metric-info p { font-size: 24px; font-weight: 800; margin-top: 5px; }
        .metric-icon { font-size: 28px; color: var(--text-muted); opacity: 0.4; }

        /* TABLA DE PRODUCTOS */
        .table-container {
            background-color: var(--bg-card);
            border-radius: 12px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 35px;
        }

        .table-header-tool {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            font-weight: 700;
            font-size: 16px;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .admin-table th {
            background-color: rgba(0, 82, 204, 0.03);
            padding: 15px 20px;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-table td {
            padding: 15px 20px;
            font-size: 14px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .img-preview-table {
            width: 45px;
            height: 45px;
            object-fit: contain;
            background-color: white;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            padding: 3px;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
        }
        .badge-success { background: rgba(54,179,126,0.15); color: var(--success-green); }
        .badge-danger { background: rgba(255,86,48,0.15); color: var(--danger-red); }

        .actions-cell {
            display: flex;
            gap: 8px;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            color: white;
            text-decoration: none;
        }
        .btn-edit { background-color: var(--primary-blue); }
        .btn-delete { background-color: var(--danger-red); background: none; color: var(--danger-red); border: 1px solid var(--danger-red); }
        .btn-delete:hover { background-color: var(--danger-red); color: white; }

        /* MODAL ANUNCIOS */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            padding: 20px;
        }

        .modal-card {
            background-color: var(--bg-card);
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 600px;
            overflow: hidden;
        }

        .modal-header {
            background-color: var(--primary-blue);
            color: white;
            padding: 20px;
            font-weight: 700;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-close {
            background: none; border: none; color: white;
            font-size: 20px; cursor: pointer;
        }

        .modal-body { padding: 25px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: var(--text-main); }
        input { width: 100%; padding: 11px 14px; border: 2px solid var(--border-color); background-color: var(--input-bg); color: var(--text-main); border-radius: 8px; font-size: 14px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-laptop-code"></i> COMPURED <span>PRO</span>
        </div>
        <ul class="sidebar-menu">
            <!-- FIX #5: href corregido para rutas reales -->
            <li><a href="{{ route('admin.productos.index') }}" class="sidebar-link active"><i class="fas fa-box"></i> Productos</a></li>
            <li><a href="#" class="sidebar-link" onclick="abrirModalAnuncios()"><i class="fas fa-ad"></i> Anuncios del Home</a></li>
            <li><a href="{{ route('inicio') }}" class="sidebar-link"><i class="fas fa-home"></i> Volver a Tienda</a></li>
        </ul>
        <!-- FIX #6: Botón logout en sidebar -->
        <div style="margin-top: auto;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link" style="width:100%; background:none; border:none; cursor:pointer; color:rgba(255,255,255,0.75); font-weight:600; font-size:14px; display:flex; align-items:center; gap:12px; padding:12px 15px; border-radius:8px;">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="top-header">
            <h1>Gestión de Productos</h1>
            <a href="{{ route('admin.productos.create') }}" class="btn-action">
                <i class="fas fa-plus-circle"></i> Agregar Nuevo Producto
            </a>
        </div>

        <div class="metrics-grid">
            <div class="metric-card" style="border-left-color: var(--primary-blue);">
                <div class="metric-info"><h3>Total Ítems</h3><p>{{ count($productos ?? $destacados ?? []) }}</p></div>
                <i class="fas fa-boxes metric-icon"></i>
            </div>
            <div class="metric-card" style="border-left-color: var(--success-green);">
                <div class="metric-info"><h3>Estado Sistema</h3><p>Online</p></div>
                <i class="fas fa-check-double metric-icon"></i>
            </div>
        </div>

        <div class="table-container">
            <div class="table-header-tool">Inventario de Componentes y Equipos</div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nombre del Producto</th>
                        <th>Marca / Cat.</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos ?? $destacados ?? [] as $producto)
                    <tr>
                        <td>
                            <!-- Muestra la foto actual del producto -->
                            <img src="{{ asset('img/' . $producto->imagen) }}" class="img-preview-table" alt="Product Image" onerror="this.src='{{ asset('img/logo.png') }}'">
                        </td>
                        <!-- Corregido para que use el campo exacto de tu tabla: id_producto -->
                        <td style="font-weight: 600;">{{ $producto->nombre }}</td>
                        <td><span class="badge badge-success">{{ $producto->categoria_filtro ?? 'Compured' }}</span></td>
                        <td style="font-weight: 700; color: var(--primary-blue);">S/ {{ $producto->precio }}</td>
                        <td>
                            <span class="badge {{ ($producto->stock ?? 0) > 5 ? 'badge-success' : 'badge-danger' }}">
                                {{ $producto->stock ?? '0' }} Unid.
                            </span>
                        </td>
                        <td>
                            <div class="actions-cell">
                                <!-- Enlace dinámico para ir a la vista de edición (donde cambias fotos, nombres, etc.) -->
                                <a href="{{ route('admin.productos.edit', $producto->id_producto ?? $producto->id) }}" class="btn-icon btn-edit" title="Editar Producto y Fotos">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.productos.destroy', $producto->id_producto ?? $producto->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro de eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align: center; color: var(--text-muted); padding: 30px;">No se registran productos en el sistema. Verifique la variable del Controlador.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal-ads" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <span>Modificar Anuncios Banner (Home)</span>
                <button class="modal-close" onclick="cerrarModal()">✕</button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="ad_banner">Imagen del Banner Principal (1920x600)</label>
                        <input type="file" id="ad_banner" name="banner" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="ad_link">Enlace de Redirección (Opcional)</label>
                        <input type="url" id="ad_link" name="link" placeholder="https://compured.com/categoria/laptops">
                    </div>
                    <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                        <button type="button" class="btn-action" style="background:none; border:2px solid var(--border-color); color:var(--text-main); box-shadow:none;" onclick="cerrarModal()">Cancelar</button>
                        <button type="submit" class="btn-action" style="background-color: var(--success-green);">Actualizar Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Sincronización automática de Modo Oscuro
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);
        if (currentTheme === 'dark') { document.body.classList.add('dark-mode'); }

        function abrirModalAnuncios() { document.getElementById('modal-ads').style.display = 'flex'; }
        function cerrarModal() { document.getElementById('modal-ads').style.display = 'none'; }
    </script>
</body>
</html>
