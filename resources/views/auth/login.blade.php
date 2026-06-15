<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Compured Peru</title>

    <style>
        :root {
            --bg-body: #f4f6f9;
            --bg-card: rgba(255, 255, 255, 0.95);
            --text-main: #172b4d;
            --text-muted: #7a869a;
            --border-color: #dfe1e6;
            --primary-blue: #0052cc;
            --light-blue: #00a3ff;
            --hover-blue: #0043a4;
            --input-bg: #ffffff;
            --shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        [data-theme="dark"], body.dark-mode {
            --bg-body: #0f172a;
            --bg-card: rgba(30, 41, 59, 0.95);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --primary-blue: #38bdf8;
            --light-blue: #0ea5e9;
            --hover-blue: #0284c7;
            --input-bg: #0f172a;
            --shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s;
        }

        body {
            /* Imagen de fondo HD de tecnología/computadoras */
            background: linear-gradient(rgba(0, 82, 204, 0.15), rgba(15, 23, 42, 0.8)),
                        url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1920') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .auth-container {
            background-color: var(--bg-card);
            backdrop-filter: blur(8px);
            padding: 40px;
            border-radius: 16px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 450px;
            border-top: 5px solid var(--primary-blue);
            text-align: center;
        }

        .auth-header {
            margin-bottom: 25px;
        }

        .auth-header img {
            height: 60px;
            width: auto;
            margin-bottom: 15px;
            object-fit: contain;
        }

        .auth-title h1 {
            color: var(--primary-blue);
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .auth-title h1 span { color: var(--light-blue); }

        .auth-title p {
            color: var(--text-muted);
            font-size: 12px;
            font-style: italic;
            margin-top: 4px;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
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
            border-radius: 8px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.15);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            color: var(--text-muted);
            cursor: pointer;
        }

        .remember-me input { margin-right: 6px; }

        .forgot-password {
            color: var(--light-blue);
            text-decoration: none;
            font-weight: 600;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #0052cc;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
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
            background-color: var(--input-bg);
            border: 2px solid var(--border-color);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-main);
            font-weight: 600;
            font-size: 14px;
        }

        .btn-google:hover {
            background-color: var(--bg-body);
        }

        .btn-google svg {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        .auth-footer {
            margin-top: 25px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .auth-footer a {
            color: var(--light-blue);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="auth-header">
            <!-- Logo oficial de la empresa -->
            <img src="{{ asset('img/logo.png') }}" alt="Compured Peru Logo">
            <div class="auth-title">
                <h1>COMPURED <span>PERU</span></h1>
                <p>Tecnología Informática a tu Alcance</p>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@compured.com" required autofocus>
                @error('email') <p style="color: #de350b; font-size: 12px; margin-top: 4px;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                @error('password') <p style="color: #de350b; font-size: 12px; margin-top: 4px;">{{ $message }}</p> @enderror
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span>Recordarme</span>
                </label>
                <a class="forgot-password" href="{{ route('password.request') }}">¿Olvidaste tu clave?</a>
            </div>

            <button type="submit" class="btn-submit">Iniciar Sesión</button>
        </form>

        <div class="separator">O ingresa con</div>

        <!-- Botón de Google Corporativo con Icono SVG Nativo e Inalterable -->
        <a href="{{ url('auth/google') }}" class="btn-google">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 12-4.53z" fill="#EA4335"/>
            </svg>
            Ingresar con Google
        </a>

        <div class="auth-footer">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
        </div>
    </div>

    <!-- SCRIPT DE SINCRONIZACIÓN AUTOMÁTICA -->
    <script>
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);
        if (currentTheme === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>
</body>
</html>
