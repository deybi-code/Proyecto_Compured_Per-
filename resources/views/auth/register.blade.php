<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Compured Peru</title>

    <style>
        :root {
            --bg-body: #f4f6f9;
            --bg-card: #ffffff;
            --text-main: #172b4d;
            --text-muted: #7a869a;
            --border-color: #dfe1e6;
            --primary-blue: #0052cc;
            --light-blue: #00a3ff;
            --hover-blue: #0043a4;
            --input-bg: #ffffff;
            --shadow: 0 10px 25px rgba(0, 82, 204, 0.08);
        }

        [data-theme="dark"] {
            --bg-body: #0f172a;
            --bg-card: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --primary-blue: #38bdf8;
            --light-blue: #0ea5e9;
            --hover-blue: #0284c7;
            --input-bg: #0f172a;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        body {
            background-color: var(--bg-body);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Switch de Modo Oscuro */
        .theme-switch-wrapper {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
        }

        .theme-switch {
            display: inline-block;
            height: 26px;
            position: relative;
            width: 50px;
        }

        .theme-switch input { display: none; }

        .slider {
            background-color: #ccc;
            bottom: 0;
            cursor: pointer;
            left: 0;
            position: relative;
            right: 0;
            top: 0;
            transition: .4s;
            border-radius: 34px;
            height: 26px;
            width: 50px;
            display: block;
        }

        .slider:before {
            background-color: white;
            bottom: 3px;
            content: "";
            height: 20px;
            left: 4px;
            position: absolute;
            transition: .4s;
            width: 20px;
            border-radius: 50%;
        }

        input:checked + .slider { background-color: #0052cc; }
        input:checked + .slider:before { transform: translateX(22px); }

        /* Contenedor Principal */
        .auth-container {
            background-color: var(--bg-card);
            padding: 40px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 480px;
            border-top: 5px solid var(--primary-blue);
            position: relative;
        }

        /* Encabezado con Logo Corporativo */
        .auth-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .auth-header img {
            height: 55px;
            width: auto;
            object-fit: contain;
        }

        .auth-title h1 {
            color: var(--primary-blue);
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.1;
        }

        .auth-title h1 span { color: var(--light-blue); }

        .auth-title p {
            color: var(--text-muted);
            font-size: 12px;
            font-style: italic;
            font-weight: 500;
        }

        /* Formulario */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: var(--text-main);
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            border: 2px solid var(--border-color);
            background-color: var(--input-bg);
            color: var(--text-main);
            border-radius: 7px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.15);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #0052cc;
            border: none;
            border-radius: 7px;
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 82, 204, 0.15);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-submit:hover { background-color: var(--hover-blue); }

        /* Separador */
        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
            color: var(--text-muted);
            font-size: 13px;
        }

        .separator::before, .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border-color);
        }

        .separator:not(:empty)::before { margin-right: .5em; }
        .separator:not(:empty)::after { margin-left: .5em; }

        /* Botón de Google Corporativo */
        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 11px;
            background-color: var(--bg-card);
            border: 2px solid var(--border-color);
            border-radius: 7px;
            text-decoration: none;
            color: var(--text-main);
            font-weight: 600;
            font-size: 14px;
        }

        .btn-google:hover {
            background-color: var(--bg-body);
        }

        .btn-google img {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        .auth-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .auth-footer a {
            color: var(--light-blue);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover {
            color: var(--primary-blue);
            text-decoration: underline;
        }

        .error-message {
            color: #de350b;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>
</head>
<body>

    <div class="theme-switch-wrapper">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider"></div>
        </label>
    </div>

    <div class="auth-container">
        <div class="auth-header">
            <img src="https://raw.githubusercontent.com/deybi-code/Proyecto_Compured_Per-/main/public/images/logo.png" onerror="this.src='https://fonts.gstatic.com/s/i/productlogos/googleg/v6/web-24dp/logo_googleg_color_24dp.png'; this.style.height='35px';" alt="Compured Peru Logo">
            <div class="auth-title">
                <h1>COMPURED <span>PERU</span></h1>
                <p>Tecnología Informática a tu Alcance</p>
            </div>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nombre Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ingresa tu nombre" required autofocus autocomplete="name">
                @error('name') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@compured.com" required autocomplete="username">
                @error('email') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" required autocomplete="new-password">
                @error('password') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite tu contraseña" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn-submit">Registrarse</button>
        </form>

        <div class="separator">O regístrate con</div>

        <a href="{{ url('auth/google') }}" class="btn-google">
            <img src="https://fonts.gstatic.com/s/i/productlogos/googleg/v6/web-24dp/logo_googleg_color_24dp.png" alt="Google Logo">
            Registrarse con Google
        </a>

        <div class="auth-footer">
            ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </div>
    </div>

    <script>
        const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
        const currentTheme = localStorage.getItem('theme');

        if (currentTheme) {
            document.documentElement.setAttribute('data-theme', currentTheme);
            if (currentTheme === 'dark') { toggleSwitch.checked = true; }
        }

        function switchTheme(e) {
            if (e.target.checked) {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
        }
        toggleSwitch.addEventListener('change', switchTheme, false);
    </script>
</body>
</html>
