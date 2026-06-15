<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Compured Peru</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 450px;
            border-top: 5px solid #0052cc; /* Azul principal */
        }

        .register-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .register-header h1 {
            color: #0052cc; /* Azul principal del logo */
            font-size: 28px;
            font-weight: bold;
            letter-spacing: -0.5px;
            margin-bottom: 5px;
        }

        .register-header h1 span {
            color: #00a3ff; /* Azul claro de "Peru" */
        }

        .register-header p {
            color: #7a869a;
            font-size: 13px;
            font-style: italic;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #172b4d;
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #dfe1e6;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0052cc; /* Foco azul */
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.15);
        }

        /* Input con enfoque verde lima inspirado en el logo */
        .form-group input.valid-accent:focus {
            border-color: #8cc63f;
            box-shadow: 0 0 0 3px rgba(140, 198, 63, 0.2);
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: #0052cc; /* Azul del logo */
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 2px 5px rgba(0, 82, 204, 0.2);
        }

        .btn-register:hover {
            background: #0043a4; /* Azul más oscuro al pasar el mouse */
        }

        .register-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #7a869a;
        }

        .register-footer a {
            color: #00a3ff; /* Enlace en azul claro */
            text-decoration: none;
            font-weight: 600;
        }

        .register-footer a:hover {
            color: #0052cc;
            text-decoration: underline;
        }

        .error-message {
            color: #de350b;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <div class="register-header">
            <h1>COMPURED<span>PERU</span></h1>
            <p>Tecnología Informática a tu Alcance</p>
        </div>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nombre Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ingresa tu nombre" required autofocus>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@compured.com" required>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" required>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite tu contraseña" required>
            </div>

            <button type="submit" class="btn-register">Registrarse</button>
        </form>

        <div class="register-footer">
            ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </div>
    </div>

</body>
</html>
