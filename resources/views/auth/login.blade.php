<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión – Compured Perú</title>
    <script src="{{ asset('js/theme.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .auth-bg {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        .auth-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #091E42 0%, #003A99 40%, #0052CC 70%, #1a6fd4 100%);
            z-index: 0;
        }
        .auth-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 20% 80%, rgba(140,198,63,0.15) 0%, transparent 50%),
                              radial-gradient(circle at 80% 20%, rgba(38,132,255,0.2) 0%, transparent 50%),
                              url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: 0;
        }
        html.dark .auth-bg::before {
            background: linear-gradient(135deg, #010409 0%, #0D1117 50%, #091E42 100%);
        }
        .auth-card {
            position: relative;
            z-index: 1;
            background: rgba(255,255,255,0.97);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3), 0 0 0 1px rgba(255,255,255,0.1);
            border-top: 4px solid #0052CC;
        }
        html.dark .auth-card {
            background: rgba(22,27,34,0.97);
            border-top-color: #2684FF;
            box-shadow: 0 25px 60px rgba(0,0,0,0.6);
        }
        .floating-tech {
            position: absolute;
            z-index: 0;
            opacity: 0.08;
            pointer-events: none;
        }
    </style>
</head>
<body>
<div class="auth-bg">
    {{-- Floating decorative elements --}}
    <div class="floating-tech" style="top:10%;left:5%;font-size:80px">💻</div>
    <div class="floating-tech" style="top:70%;left:8%;font-size:50px">🖥️</div>
    <div class="floating-tech" style="top:20%;right:8%;font-size:60px">⌨️</div>
    <div class="floating-tech" style="bottom:15%;right:6%;font-size:70px">🖱️</div>

    <div class="auth-card">
        {{-- Logo --}}
        <div class="text-center mb-6">
            <img src="{{ asset('img/logo.png') }}" alt="Compured Perú" class="h-14 mx-auto mb-3 dark:hidden" onerror="this.style.display='none'">
            <div style="font-family:'Rajdhani',sans-serif;font-size:1.6rem;font-weight:800;color:#0052CC">
                COMPURED<span style="color:#8CC63F">PERÚ</span>
            </div>
            <div style="font-size:0.75rem;color:#97A0AF;font-style:italic">Tecnología Informática a tu Alcance</div>
        </div>

        <h2 style="font-size:1rem;font-weight:700;color:#172B4D;margin-bottom:20px;text-align:center" class="dark:text-gray-200">
            Iniciar Sesión
        </h2>

        {{-- Session Errors --}}
        @if($errors->any())
        <div class="alert-error mb-4">{{ $errors->first() }}</div>
        @endif

        <x-auth-session-status :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="cp-label">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" class="cp-input" placeholder="tu@correo.com" required autofocus>
            </div>

            <div class="mb-4">
                <label class="cp-label">Contraseña</label>
                <input type="password" name="password" class="cp-input" placeholder="••••••••" required>
            </div>

            <div class="flex items-center justify-between mb-5 text-sm">
                <label class="flex items-center gap-2 cursor-pointer text-gray-600 dark:text-gray-400">
                    <input type="checkbox" name="remember" style="accent-color:#0052CC">
                    Recordarme
                </label>
                @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="color:#0052CC;font-weight:600;text-decoration:none" class="hover:underline">¿Olvidaste tu clave?</a>
                @endif
            </div>

            <button type="submit" class="btn-primary w-full justify-center text-sm py-3 mb-4">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                INICIAR SESIÓN
            </button>
        </form>

        <div style="display:flex;align-items:center;gap:10px;margin:16px 0;color:#97A0AF;font-size:0.8rem">
            <div style="flex:1;height:1px;background:#DFE1E6"></div>
            O continúa con
            <div style="flex:1;height:1px;background:#DFE1E6"></div>
        </div>

        <a href="{{ url('auth/google') }}" style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:11px;border:2px solid #DFE1E6;border-radius:8px;text-decoration:none;color:#172B4D;font-weight:600;font-size:0.88rem;transition:all 0.2s;background:white" class="dark:text-gray-300 dark:border-gray-600 dark:bg-gray-800 hover:border-blue-400">
            <svg width="18" height="18" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
            Ingresar con Google
        </a>

        <div class="text-center mt-5 text-sm text-gray-500 dark:text-gray-400">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" style="color:#0052CC;font-weight:700;text-decoration:none" class="hover:underline">Regístrate gratis</a>
        </div>

        {{-- Dark mode toggle en login --}}
        <div class="text-center mt-4">
            <button onclick="toggleDark()" style="font-size:0.75rem;color:#97A0AF;background:none;border:none;cursor:pointer;padding:4px 8px;border-radius:4px" class="hover:text-blue-500">
                <span id="theme-icon">🌙</span> Cambiar modo
            </button>
        </div>
    </div>
</div>
</body>
</html>
