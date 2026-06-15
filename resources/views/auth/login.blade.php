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

        [data-theme="dark"] {
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
            /* Foto de fondo HD de servidores / computadoras de fondo */
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
        }

        .btn-submit:hover { background-color: var(--hover-blue); }

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

        .error-message {
            color: #de350b;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="auth-header">
            <img src="https://raw.githubusercontent.com/deybi-code/Proyecto_Compured_Per-/main/public/images/logo.png" onerror="this.style.display='none';" alt="Compured Peru Logo">
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
                @error('email') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                @error('password') <p class="error-message">{{ $message }}</p> @enderror
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

        <div class="auth-footer">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
        </div>
    </div>

    <script>
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);
    </script>
</body>
</html>
