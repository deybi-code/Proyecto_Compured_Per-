<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - Panel Compured</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg-sidebar: #002b80;
            --bg-main: #f4f6f9;
            --bg-card: #ffffff;
            --text-main: #172b4d;
            --text-muted: #7a869a;
            --border-color: #dfe1e6;
            --primary-blue: #0052cc;
            --light-blue: #00a3ff;
            --success-green: #36b37e;
            --input-bg: #ffffff;
            --shadow: 0 4px 20px rgba(0, 82, 204, 0.05);
        }

        [data-theme="dark"], body.dark-mode {
            --bg-sidebar: #0f172a;
            --bg-main: #0b0f19;
            --bg-card: #141b2d;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #222f46;
            --primary-blue: #38bdf8;
            --input-bg: #1f293d;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px; background-color: var(--bg-sidebar); color: white; padding: 30px 20px;
            display: flex; flex-direction: column; gap: 30px;
        }

        .sidebar-brand {
            font-size: 20px; font-weight: 800; display: flex; align-items: center; gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px;
        }
        .sidebar-brand span { color: var(--light-blue); }

        .main-content { flex: 1; padding: 40px; overflow-y: auto; }
        .top-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; }
        .top-header h1 { font-size: 26px; font-weight: 800; }

        .btn-back {
            padding: 10px 18px; background: none; border: 2px solid var(--border-color);
            color: var(--text-main); border-radius: 8px; text-decoration: none;
            font-weight: 700; font-size: 14px; display: flex; align-items: center; gap: 8px;
        }

        .form-container { background-color: var(--bg-card); border-radius: 12px; box-shadow: var(--shadow); padding: 30px; }
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; margin-bottom: 30px; }
        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .form-group.full-width { grid-column: span 2; }
        .form-group.checkbox-group { flex-direction: row; align-items: center; gap: 10px; padding-top: 10px; }
        .form-group.checkbox-group input { width: auto; cursor: pointer; }

        label { font-size: 13px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; }
        input, select, textarea {
            width: 100%; padding: 12px 15px; border: 2px solid var(--border-color);
            background-color: var(--input-bg); color: var(--text-main); border-radius: 8px; font-size: 14px; outline: none;
        }
        input:focus, select:focus, textarea:focus { border-color: var(--primary-blue); }

        .image-upload-zone {
            border: 2px dashed var(--primary-blue); background-color: rgba(0, 82, 204, 0.02);
            border-radius: 10px; padding: 30px; text-align: center; cursor: pointer; position: relative;
        }
        .image-upload-zone i { font-size: 40px; color: var(--primary-blue); margin-bottom: 10px; }
        .image-upload-zone input { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }

        .preview-gallery { display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 15px; margin-top: 15px; }
        .preview-item { position: relative; width: 100px; height: 100px; border-radius: 8px; border: 1px solid var(--border-color); overflow: hidden; background: white; }
        .preview-item img { width: 100%; height: 100%; object-fit: contain; }

        .btn-submit-form {
            padding: 12px 30px; background-color: var(--success-green); color: white; border: none;
            border-radius: 8px; font-weight: 700; font-size: 15px; cursor: pointer;
            box-shadow: 0 4px 12px rgba(54, 179, 126, 0.2);
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-laptop-code"></i> COMPURED <span>PRO</span>
        </div>
    </div>

    <div class="main-content">
        <div class="top-header">
            <h1>Agregar Nuevo Producto</h1>
            <a href="/admin/productos" class="btn-back">
                <i class="fas fa-arrow-left"></i> Volver al Panel
            </a>
        </div>

        <div class="form-container">
            <form action="/admin/productos" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto</label>
                        <input type="text" id="nombre" name="nombre" required placeholder="Ej. Memoria RAM Kingston 16GB">
                    </div>

                    <div class="form-group">
                        <label for="id_categoria">Categoría</label>
                        <select id="id_categoria" name="id_categoria" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-grid" style="grid-column: span 2; margin-bottom: 0; gap: 25px;">
                        <div class="form-group">
                            <label for="precio">Precio (S/)</label>
                            <input type="number" id="precio" name="precio" step="0.01" required placeholder="0.00">
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock Inicial</label>
                            <input type="number" id="stock" name="stock" placeholder="0">
                        </div>

                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <input type="text" id="marca" name="marca" placeholder="Ej. ASUS, Kingston, Intel">
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="detalles_tecnicos">Detalles Técnicos / Descripción</label>
                        <textarea id="detalles_tecnicos" name="detalles_tecnicos" rows="4" placeholder="Especificaciones de rendimiento..."></textarea>
                    </div>

                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="mostrar_inicio" name="mostrar_inicio" value="1">
                        <label for="mostrar_inicio" style="text-transform: none; font-size: 14px; color: var(--text-main); cursor: pointer;">Mostrar este producto destacado en el Home</label>
                    </div>

                    <div class="form-group full-width">
                        <label>Imágenes del Producto</label>
                        <div class="image-upload-zone">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p style="font-weight:600; font-size:14px; margin-bottom:5px;">Selecciona imágenes para el producto</p>
                            <input type="file" id="imagenes" name="imagenes[]" accept="image/*" multiple onchange="previewImages()">
                        </div>
                        <div class="preview-gallery" id="gallery"></div>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-submit-form">Crear Producto</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);
        if (currentTheme === 'dark') { document.body.classList.add('dark-mode'); }

        function previewImages() {
            const preview = document.getElementById('gallery');
            preview.innerHTML = "";
            const files = document.getElementById('imagenes').files;
            if (files) { [].forEach.call(files, readAndPreview); }

            function readAndPreview(file) {
                if (!/\.(jpe?g|png|gif|webp)$/i.test(file.name)) return;
                const reader = new FileReader();
                reader.addEventListener("load", function() {
                    const div = document.createElement('div');
                    div.className = 'preview-item';
                    const image = new Image();
                    image.src = this.result;
                    div.appendChild(image);
                    preview.appendChild(div);
                });
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
