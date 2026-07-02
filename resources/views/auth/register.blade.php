<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - Compured Perú</title>
    <script>
        (function(){
            // Por defecto siempre claro, salvo que el usuario haya elegido oscuro antes.
            const t = localStorage.getItem('theme');
            if (t === 'dark') {
                document.documentElement.setAttribute('data-theme','dark');
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    @vite(['resources/css/app.css'])
    <style>
        :root {
            --bg: #f0f4ff; --card: rgba(255,255,255,0.92); --text: #0f172a; --muted: #64748b;
            --border: #cbd5e1; --input-bg: #f8fafc; --primary: #1d4ed8; --primary-hover: #1e40af;
            --accent: #3b82f6; --shadow: 0 25px 60px rgba(0,0,0,0.18); --error: #dc2626;
        }
        [data-theme="dark"] {
            --bg: #0a0f1e; --card: rgba(15,23,42,0.93); --text: #f1f5f9; --muted: #94a3b8;
            --border: #1e3a5f; --input-bg: #0f172a; --primary: #3b82f6; --primary-hover: #2563eb;
            --accent: #60a5fa; --shadow: 0 25px 60px rgba(0,0,0,0.6); --error: #f87171;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: var(--bg); color: var(--text);
            display: flex; align-items: center; justify-content: center;
            min-height: 100vh; padding: 20px; position: relative; overflow-x: hidden;
            transition: background-color 0.4s, color 0.4s;
        }
        .bg-scene { position: fixed; inset: 0; z-index: 0; background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 40%, #1d4ed8 70%, #0f172a 100%); transition: all 0.4s; }
        [data-theme="dark"] .bg-scene { background: linear-gradient(135deg, #020617 0%, #0f172a 40%, #1e3a5f 70%, #020617 100%); }
        .bg-grid { position: fixed; inset: 0; z-index: 0; pointer-events: none; background-image: linear-gradient(rgba(59,130,246,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(59,130,246,0.05) 1px, transparent 1px); background-size: 50px 50px; }
        .bg-circles { position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none; }
        .bg-circles span { position: absolute; border-radius: 50%; background: rgba(59,130,246,0.1); animation: floatUp linear infinite; }
        .bg-circles span:nth-child(1) { width:80px; height:80px; left:5%; animation-duration:14s; }
        .bg-circles span:nth-child(2) { width:40px; height:40px; left:25%; animation-duration:9s; animation-delay:3s; }
        .bg-circles span:nth-child(3) { width:60px; height:60px; left:50%; animation-duration:12s; animation-delay:1s; }
        .bg-circles span:nth-child(4) { width:100px; height:100px; left:75%; animation-duration:11s; animation-delay:4s; }
        .bg-circles span:nth-child(5) { width:30px; height:30px; left:90%; animation-duration:8s; animation-delay:2s; }
        @keyframes floatUp { 0% { transform:translateY(110vh) rotate(0deg); opacity:0; } 10% { opacity:1; } 90% { opacity:1; } 100% { transform:translateY(-10vh) rotate(720deg); opacity:0; } }

        .theme-btn { position:fixed; top:20px; right:20px; z-index:100; display:inline-flex; align-items:center; justify-content:center; width:42px; height:42px; border-radius:10px; background:rgba(255,255,255,0.1); backdrop-filter:blur(10px); border:1px solid rgba(255,255,255,0.2); color:white; cursor:pointer; transition:background 0.2s ease, border-color 0.2s ease, transform 0.2s ease; }
        .theme-btn:hover { background:rgba(255,255,255,0.2); }
        .theme-btn svg { width:19px; height:19px; }

        .auth-card { position:relative; z-index:10; background:var(--card); backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px); border:1px solid rgba(59,130,246,0.2); border-top:4px solid var(--primary); border-radius:20px; padding:36px 44px; width:100%; max-width:480px; box-shadow:var(--shadow); animation:slideUp 0.5s cubic-bezier(0.34,1.56,0.64,1); }
        @keyframes slideUp { from { opacity:0; transform:translateY(30px) scale(0.97); } to { opacity:1; transform:translateY(0) scale(1); } }

        .logo-area { text-align:center; margin-bottom:22px; }
        .logo-area img { height:46px; object-fit:contain; margin-bottom:8px; }
        .logo-area .sub { font-size:12px; color:var(--muted); }

        .tabs { display:flex; border:1px solid var(--border); border-radius:10px; overflow:hidden; margin-bottom:22px; }
        .tabs a { flex:1; text-align:center; padding:10px; font-size:13px; font-weight:700; text-decoration:none; color:var(--muted); transition:all 0.3s; }
        .tabs a.active { background:var(--primary); color:white; }
        .tabs a:not(.active):hover { background:rgba(59,130,246,0.08); color:var(--primary); }

        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        @media(max-width:480px) { .form-row { grid-template-columns:1fr; } }

        .form-group { margin-bottom:14px; }
        .form-group label { display:block; margin-bottom:5px; font-size:13px; font-weight:600; color:var(--text); }
        .input-wrap { position:relative; }
        .input-wrap input { width:100%; padding:10px 40px 10px 14px; border:2px solid var(--border); background:var(--input-bg); color:var(--text); border-radius:10px; font-size:13px; transition:all 0.25s; outline:none; }
        .input-wrap input:focus { border-color:var(--primary); box-shadow:0 0 0 3px rgba(59,130,246,0.15); }
        .input-wrap .icon { position:absolute; right:12px; top:50%; transform:translateY(-50%); color:var(--muted); cursor:pointer; line-height:0; }
        .input-wrap .icon:hover { color:var(--primary); }
        .error-msg { color:var(--error); font-size:11px; margin-top:3px; }
        .alert-error { background:rgba(220,38,38,0.1); border:1px solid rgba(220,38,38,0.3); color:var(--error); border-radius:8px; padding:10px 14px; font-size:13px; margin-bottom:14px; text-align:center; }

        .btn-primary { width:100%; padding:13px; background:linear-gradient(135deg, var(--primary), #2563eb); border:none; border-radius:10px; color:white; font-size:14px; font-weight:700; cursor:pointer; letter-spacing:0.5px; text-transform:uppercase; transition:all 0.3s; box-shadow:0 4px 15px rgba(29,78,216,0.4); margin-top:4px; }
        .btn-primary:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(29,78,216,0.5); }

        .sep { display:flex; align-items:center; gap:10px; margin:16px 0; }
        .sep::before, .sep::after { content:''; flex:1; height:1px; background:var(--border); }
        .sep span { font-size:12px; color:var(--muted); white-space:nowrap; }

        .btn-google { display:flex; align-items:center; justify-content:center; gap:10px; width:100%; padding:11px; background:var(--input-bg); border:2px solid var(--border); border-radius:10px; text-decoration:none; color:var(--text); font-size:13px; font-weight:600; transition:all 0.25s; }
        .btn-google:hover { border-color:var(--accent); background:rgba(59,130,246,0.05); transform:translateY(-1px); }
        .btn-google svg { width:18px; height:18px; flex-shrink:0; }

        .auth-footer { text-align:center; margin-top:18px; font-size:13px; color:var(--muted); }
        .auth-footer a { color:var(--accent); font-weight:600; text-decoration:none; }
        .auth-footer a:hover { text-decoration:underline; }

        .terms { font-size:11px; color:var(--muted); text-align:center; margin-top:10px; }
        .terms a { color:var(--accent); }
    </style>
</head>
<body>
<div class="bg-scene"></div>
<div class="bg-grid"></div>
<div class="bg-circles"><span></span><span></span><span></span><span></span><span></span></div>

<button class="theme-btn" onclick="toggleTheme()" title="Cambiar tema">
    <svg id="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="4.2"/>
        <path d="M12 2.5v2.4M12 19.1v2.4M4.2 4.2l1.7 1.7M18.1 18.1l1.7 1.7M2.5 12h2.4M19.1 12h2.4M4.2 19.8l1.7-1.7M18.1 5.9l1.7-1.7"/>
    </svg>
    <svg id="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
        <path d="M20.5 14.5A8.5 8.5 0 1 1 9.5 3.5a7 7 0 0 0 11 11z"/>
    </svg>
</button>

<div class="auth-card">
    <div class="logo-area">
        <a href="/"><img src="{{ asset('img/logo.png') }}" alt="Compured Perú" onerror="this.style.display='none'"></a>
        <div class="sub">Crea tu cuenta gratis y empieza a comprar 🚀</div>
    </div>

    <div class="tabs">
        <a href="{{ route('login') }}">Iniciar Sesión</a>
        <a href="{{ route('register') }}" class="active">Registrarse</a>
    </div>

    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nombre completo --}}
        <div class="form-group">
            <label>Nombre Completo</label>
            <div class="input-wrap">
                <input type="text" name="nombre_completo" value="{{ old('nombre_completo') }}" placeholder="Tu nombre completo" required autofocus>
                <span class="icon">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </span>
            </div>
            @error('nombre_completo')<p class="error-msg">{{ $message }}</p>@enderror
        </div>

        {{-- Correo --}}
        <div class="form-group">
            <label>Correo Electrónico</label>
            <div class="input-wrap">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="tu@correo.com" required>
                <span class="icon">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </span>
            </div>
            @error('email')<p class="error-msg">{{ $message }}</p>@enderror
        </div>

        {{-- Contraseñas en fila --}}
        <div class="form-row">
            <div class="form-group">
                <label>Contraseña</label>
                <div class="input-wrap">
                    <input type="password" id="pass1" name="password" placeholder="••••••••" required>
                    <span class="icon" onclick="togglePassword('pass1', this)">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </span>
                </div>
                @error('password')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>Confirmar</label>
                <div class="input-wrap">
                    <input type="password" id="pass2" name="password_confirmation" placeholder="••••••••" required>
                    <span class="icon" onclick="togglePassword('pass2', this)">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </span>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-primary">🚀 Crear mi cuenta</button>

        <p class="terms">
            Al registrarte aceptas nuestros <a href="/terminos">Términos y Condiciones</a>
        </p>
    </form>

    <div class="sep"><span>O regístrate con</span></div>

    <a href="{{ url('auth/google') }}" class="btn-google">
        <svg viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
        Continuar con Google
    </a>

    <div class="auth-footer">
        ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
        <br><br>
        <a href="/" style="color:var(--muted); font-size:12px;">← Volver a la tienda</a>
    </div>
</div>

<script>
    function toggleTheme() {
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        const newTheme = isDark ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        if (newTheme === 'dark') document.documentElement.classList.add('dark');
        else document.documentElement.classList.remove('dark');
        document.getElementById('icon-moon').style.display = isDark ? 'block' : 'none';
        document.getElementById('icon-sun').style.display = isDark ? 'none' : 'block';
    }
    (function(){
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        document.getElementById('icon-moon').style.display = isDark ? 'none' : 'block';
        document.getElementById('icon-sun').style.display = isDark ? 'block' : 'none';
    })();
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        btn.innerHTML = isHidden
            ? `<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>`
            : `<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>`;
    }
</script>
</body>
</html>
