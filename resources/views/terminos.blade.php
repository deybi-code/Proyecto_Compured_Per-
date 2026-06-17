<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Términos y Condiciones - Compured Perú</title>
    <script src="{{ asset('js/theme.js') }}"></script>
    <style>
        body{font-family:sans-serif; text-align:center; padding:50px; background:#f4f6f9; transition: background-color 0.3s ease, color 0.3s ease;}
        body.dark-mode { background:#121212; color:#e0e0e0; }
        .theme-toggle-btn {
            position: fixed; top: 20px; right: 20px; width: 48px; height: 48px;
            border-radius: 50%; border: 2px solid #cce5ff; background: #ffffff;
            color: #0b33a2; font-size: 20px; cursor: pointer; display: flex;
            align-items: center; justify-content: center; z-index: 1000;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15); transition: all 0.3s ease;
        }
        .theme-toggle-btn:hover { transform: scale(1.08); }
        body.dark-mode .theme-toggle-btn { background: #1e1e1e; border-color: #333; color: #f1f1f1; }
    </style>
</head>
<body>
    <button type="button" class="theme-toggle-btn" onclick="toggleDarkMode()" title="Cambiar modo claro/oscuro" aria-label="Cambiar modo claro/oscuro">
        <span id="themeIcon">🌙</span>
    </button>

    <h1 style="color:#0b33a2;">Términos y Condiciones</h1>
    <p>Todos los productos cuentan con garantía de fabricante. Las devoluciones se aceptan dentro de los primeros 7 días hábiles.</p>
    <br>
    <a href="{{ url('/') }}" style="color:#27a1eb; text-decoration:none; font-weight:bold;">← Volver al Inicio</a>
</body>
</html>
