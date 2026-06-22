<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Anuncios - Admin Compured</title>
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

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', system-ui, sans-serif; transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease; }
        body { background-color: var(--bg-main); color: var(--text-main); display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: 280px; background-color: var(--bg-sidebar); color: white; padding: 30px 20px; display: flex; flex-direction: column; gap: 30px; box-shadow: 4px 0 15px rgba(0,0,0,0.1); }
        .sidebar-brand { font-size: 20px; font-weight: 800; letter-spacing: -0.5px; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px; }
        .sidebar-brand span { color: var(--light-blue); }
        .sidebar-menu { list-style: none; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-link { display: flex; align-items: center; gap: 12px; padding: 12px 15px; color: rgba(255,255,255,0.75); text-decoration: none; font-weight: 600; font-size: 14px; border-radius: 8px; }
        .sidebar-link:hover, .sidebar-link.active { background-color: var(--bg-sidebar-hover); color: white; }

        /* CONTENIDO */
        .main-content { flex: 1; padding: 40px; overflow-y: auto; }
        .top-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; }
        .top-header h1 { font-size: 26px; font-weight: 800; letter-spacing: -0.5px; }
        .btn-action { padding: 10px 20px; background-color: var(--success-green); color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer; text-decoration: none; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(54, 179, 126, 0.2); transition: background 0.3s; }
        .btn-action:hover { opacity: 0.9; transform: translateY(-1px); }

        /* BANNERS GRID */
        .banner-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .banner-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; box-shadow: var(--shadow); display: flex; flex-direction: column; transition: transform 0.2s; }
        .banner-card:hover { transform: translateY(-3px); }
        .banner-img-preview { width: 100%; height: 140px; object-fit: cover; background: var(--border-color); border-bottom: 1px solid var(--border-color); }
        .banner-info { padding: 20px; flex: 1; }
        .banner-info p { margin: 8px 0; font-size: 14px; color: var(--text-main); display: flex; justify-content: space-between; align-items: center; }
        .banner-info strong { color: var(--text-muted); font-weight: 700; }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 700; background: rgba(0, 163, 255, 0.15); color: var(--light-blue); }

        .banner-actions { display: flex; border-top: 1px solid var(--border-color); }
        .banner-actions button { flex: 1; padding: 12px; border: none; cursor: pointer; font-weight: 700; font-size: 13px; display: flex; align-items: center; justify-content: center; gap: 6px; transition: background 0.2s; }
        .btn-edit { background: transparent; color: var(--primary-blue); border-right: 1px solid var(--border-color); }
        .btn-edit:hover { background: rgba(0, 82, 204, 0.05); }
        .btn-delete { background: transparent; color: var(--danger-red); }
        .btn-delete:hover { background: rgba(255, 86, 48, 0.05); }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-laptop-code"></i> COMPURED <span>PRO</span>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.productos.index') }}" class="sidebar-link"><i class="fas fa-box"></i> Productos</a></li>
            <li><a href="{{ route('admin.anuncios') }}" class="sidebar-link active"><i class="fas fa-ad"></i> Anuncios del Home</a></li>
            <li><a href="{{ route('inicio') }}" class="sidebar-link"><i class="fas fa-home"></i> Volver a Tienda</a></li>
        </ul>
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
            <h1><i class="fas fa-images" style="color: var(--light-blue); margin-right: 10px;"></i> Gestión de Anuncios</h1>
            <button class="btn-action"><i class="fas fa-plus"></i> Nuevo Anuncio</button>
        </div>

        <div class="banner-grid">
            <div class="banner-card">
                <img src="{{ asset('img/banner1.jpg') }}" class="banner-img-preview" onerror="this.src='{{ asset('img/logo.png') }}'">
                <div class="banner-info">
                    <p><strong>Posición:</strong> <span>1 <span class="badge">Slider</span></span></p>
                    <p><strong>Enlace:</strong> <span>/oferta/1</span></p>
                    <p><strong>Duración:</strong> <span>3 Seg.</span></p>
                </div>
                <div class="banner-actions">
                    <button class="btn-edit"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn-delete"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </div>

            <div class="banner-card">
                <img src="{{ asset('img/banner2.jpg') }}" class="banner-img-preview" onerror="this.src='{{ asset('img/logo.png') }}'">
                <div class="banner-info">
                    <p><strong>Posición:</strong> <span>2 <span class="badge">Slider</span></span></p>
                    <p><strong>Enlace:</strong> <span>/oferta/2</span></p>
                    <p><strong>Duración:</strong> <span>3 Seg.</span></p>
                </div>
                <div class="banner-actions">
                    <button class="btn-edit"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn-delete"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </div>

            <div class="banner-card">
                <img src="{{ asset('img/banner3.jpg') }}" class="banner-img-preview" onerror="this.src='{{ asset('img/logo.png') }}'">
                <div class="banner-info">
                    <p><strong>Posición:</strong> <span>3 <span class="badge">Slider</span></span></p>
                    <p><strong>Enlace:</strong> <span>/oferta/3</span></p>
                    <p><strong>Duración:</strong> <span>3 Seg.</span></p>
                </div>
                <div class="banner-actions">
                    <button class="btn-edit"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn-delete"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </div>

            <div class="banner-card">
                <img src="{{ asset('img/banner4.jpg') }}" class="banner-img-preview" onerror="this.src='{{ asset('img/logo.png') }}'">
                <div class="banner-info">
                    <p><strong>Posición:</strong> <span>4 <span class="badge">Slider</span></span></p>
                    <p><strong>Enlace:</strong> <span>/oferta/4</span></p>
                    <p><strong>Duración:</strong> <span>3 Seg.</span></p>
                </div>
                <div class="banner-actions">
                    <button class="btn-edit"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn-delete"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);
        if (currentTheme === 'dark') { document.body.classList.add('dark-mode'); }
    </script>
</body>
</html>
