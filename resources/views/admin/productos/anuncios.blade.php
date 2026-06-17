<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Anuncios - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; }
        .admin-container { max-width: 1000px; margin: 40px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .admin-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #27a1eb; padding-bottom: 15px; margin-bottom: 20px; }
        .admin-header h1 { margin: 0; color: #0b33a2; font-size: 24px; }
        .btn-add { background: #a4e613; color: #0b33a2; padding: 10px 20px; text-decoration: none; font-weight: bold; border-radius: 5px; border: none; cursor: pointer; }
        .banner-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .banner-card { border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; background: #fff; }
        .banner-img-preview { width: 100%; height: 120px; object-fit: cover; background: #eee; }
        .banner-info { padding: 15px; }
        .banner-info p { margin: 5px 0; font-size: 13px; color: #555; }
        .banner-actions { display: flex; border-top: 1px solid #e0e0e0; }
        .banner-actions button { flex: 1; padding: 10px; border: none; cursor: pointer; font-weight: bold; font-size: 13px; }
        .btn-edit { background: #fdfdfc; color: #27a1eb; border-right: 1px solid #e0e0e0; }
        .btn-delete { background: #fff2f2; color: #e53e3e; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 12px; font-size: 11px; font-weight: bold; color: white; background: #27a1eb; }
    </style>
</head>
<body>
    <div class="admin-container">
        <a href="{{ url('/') }}" style="color:#27a1eb; text-decoration:none; margin-bottom:15px; display:inline-block;">← Volver al inicio</a>
        <div class="admin-header">
            <h1><i class="fas fa-images"></i> Gestión de Anuncios (Home)</h1>
            <button class="btn-add"><i class="fas fa-plus"></i> Nuevo Anuncio</button>
        </div>

        <div class="banner-grid">
            <div class="banner-card">
                <img src="{{ asset('img/banner1.jpg') }}" class="banner-img-preview" onerror="this.src='{{ asset('img/logo.png') }}'">
                <div class="banner-info">
                    <p><strong>Posición:</strong> 1 <span class="badge slider">Slider</span></p>
                    <p><strong>Enlace:</strong> /oferta/1</p>
                    <p><strong>Duración:</strong> 3 Segundos</p>
                </div>
                <div class="banner-actions">
                    <button class="btn-edit"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn-delete"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </div>
            <div class="banner-card">
                <img src="{{ asset('img/banner2.jpg') }}" class="banner-img-preview" onerror="this.src='{{ asset('img/logo.png') }}'">
                <div class="banner-info">
                    <p><strong>Posición:</strong> 2 <span class="badge slider">Slider</span></p>
                    <p><strong>Enlace:</strong> /oferta/2</p>
                    <p><strong>Duración:</strong> 3 Segundos</p>
                </div>
                <div class="banner-actions">
                    <button class="btn-edit"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn-delete"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </div>
            <div class="banner-card">
                <img src="{{ asset('img/banner3.jpg') }}" class="banner-img-preview" onerror="this.src='{{ asset('img/logo.png') }}'">
                <div class="banner-info">
                    <p><strong>Posición:</strong> 3 <span class="badge slider">Slider</span></p>
                    <p><strong>Enlace:</strong> /oferta/3</p>
                    <p><strong>Duración:</strong> 3 Segundos</p>
                </div>
                <div class="banner-actions">
                    <button class="btn-edit"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn-delete"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </div>
            <div class="banner-card">
                <img src="{{ asset('img/banner4.jpg') }}" class="banner-img-preview" onerror="this.src='{{ asset('img/logo.png') }}'">
                <div class="banner-info">
                    <p><strong>Posición:</strong> 4 <span class="badge slider">Slider</span></p>
                    <p><strong>Enlace:</strong> /oferta/4</p>
                    <p><strong>Duración:</strong> 3 Segundos</p>
                </div>
                <div class="banner-actions">
                    <button class="btn-edit"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn-delete"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
