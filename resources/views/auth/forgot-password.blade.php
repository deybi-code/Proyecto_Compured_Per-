<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Compured Perú</title>
    <script>
        (function(){
            const t = localStorage.getItem('theme') || localStorage.getItem('cpTheme');
            if (t === 'dark') {
                document.documentElement.setAttribute('data-theme','dark');
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    @vite(['resources/css/app.css'])
    <style>
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
        body { font-family:'Inter','Segoe UI',system-ui,sans-serif; background-color:var(--bg); color:var(--text); display:flex; align-items:center; justify-content:center; min-height:100vh; padding:20px; position:relative; overflow:hidden; transition:background-color 0.4s,color 0.4s; }
        .bg-scene { position:fixed; inset:0; z-index:0; background:var(--pub-hero-gradient); }
        .bg-grid { position:fixed; inset:0; z-index:0; pointer-events:none; background-image:linear-gradient(var(--pub-hero-grid) 1px,transparent 1px),linear-gradient(90deg,var(--pub-hero-grid) 1px,transparent 1px); background-size:50px 50px; }
        .bg-circles { position:fixed; inset:0; z-index:0; overflow:hidden; pointer-events:none; }
        .bg-circles span { position:absolute; border-radius:50%; background:rgba(0,82,204,0.1); animation:floatUp linear infinite; }
        .bg-circles span:nth-child(1){width:80px;height:80px;left:10%;animation-duration:13s;}
        .bg-circles span:nth-child(2){width:40px;height:40px;left:40%;animation-duration:9s;animation-delay:2s;}
        .bg-circles span:nth-child(3){width:60px;height:60px;left:70%;animation-duration:11s;animation-delay:4s;}
        @keyframes floatUp { 0%{transform:translateY(110vh) rotate(0deg);opacity:0;} 10%{opacity:1;} 90%{opacity:1;} 100%{transform:translateY(-10vh) rotate(720deg);opacity:0;} }
        .theme-btn { position:fixed; top:20px; right:20px; z-index:100; background:rgba(255,255,255,0.15); backdrop-filter:blur(10px); border:1px solid rgba(255,255,255,0.2); color:white; border-radius:50%; width:44px; height:44px; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.3s; font-size:18px; }
        .theme-btn:hover { background:rgba(255,255,255,0.25); transform:scale(1.1); }
        .auth-card { position:relative; z-index:10; background:var(--card); backdrop-filter:blur(20px); border:1px solid rgba(59,130,246,0.2); border-top:4px solid var(--primary); border-radius:20px; padding:44px; width:100%; max-width:420px; box-shadow:var(--shadow); animation:slideUp 0.5s cubic-bezier(0.34,1.56,0.64,1); }
        @keyframes slideUp { from{opacity:0;transform:translateY(30px) scale(0.97);} to{opacity:1;transform:translateY(0) scale(1);} }
        .logo-area { text-align:center; margin-bottom:24px; }
        .logo-area img { height:48px; object-fit:contain; margin-bottom:10px; }
        .page-icon { font-size:48px; text-align:center; margin-bottom:14px; animation:bounce 2s ease-in-out infinite; }
        @keyframes bounce { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-8px);} }
        h2 { font-size:20px; font-weight:800; text-align:center; color:var(--text); margin-bottom:8px; }
        .desc { font-size:13px; color:var(--muted); text-align:center; margin-bottom:24px; line-height:1.6; }
        .form-group { margin-bottom:18px; }
        .form-group label { display:block; margin-bottom:6px; font-size:13px; font-weight:600; color:var(--text); }
        .input-wrap { position:relative; }
        .input-wrap input { width:100%; padding:12px 42px 12px 16px; border:2px solid var(--border); background:var(--input-bg); color:var(--text); border-radius:10px; font-size:14px; transition:all 0.25s; outline:none; }
        .input-wrap input:focus { border-color:var(--primary); box-shadow:0 0 0 3px rgba(59,130,246,0.15); }
        .input-wrap .icon { position:absolute; right:13px; top:50%; transform:translateY(-50%); color:var(--muted); line-height:0; }
        .btn-primary { width:100%; padding:13px; background:linear-gradient(135deg,var(--primary),#2563eb); border:none; border-radius:10px; color:white; font-size:14px; font-weight:700; cursor:pointer; letter-spacing:0.5px; text-transform:uppercase; transition:all 0.3s; box-shadow:0 4px 15px rgba(29,78,216,0.4); }
        .btn-primary:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(29,78,216,0.5); }
        .alert-success { background:rgba(22,163,74,0.1); border:1px solid rgba(22,163,74,0.3); color:var(--success); border-radius:10px; padding:14px; font-size:13px; margin-bottom:18px; text-align:center; }
        .alert-error { background:rgba(220,38,38,0.1); border:1px solid rgba(220,38,38,0.3); color:var(--error); border-radius:8px; padding:10px 14px; font-size:13px; margin-bottom:14px; text-align:center; }
        .error-msg { color:var(--error); font-size:12px; margin-top:4px; }
        .auth-footer { text-align:center; margin-top:22px; font-size:13px; color:var(--muted); }
        .auth-footer a { color:var(--accent); font-weight:600; text-decoration:none; }
        .auth-footer a:hover { text-decoration:underline; }
    </style>
</head>
<body>
<div class="bg-scene"></div>
<div class="bg-grid"></div>
<div class="bg-circles"><span></span><span></span><span></span></div>

<button class="theme-btn" onclick="toggleTheme()" title="Cambiar tema">
    <span id="icon-moon">🌙</span><span id="icon-sun" style="display:none">☀️</span>
</button>

<div class="auth-card">
    <div class="logo-area">
        <a href="/"><img src="{{ asset('img/logo.png') }}" alt="Compured Perú" onerror="this.style.display='none'"></a>
    </div>

    <div class="page-icon">🔑</div>
    <h2>Recuperar Contraseña</h2>
    <p class="desc">Ingresa tu correo registrado y te enviaremos un enlace para restablecer tu contraseña.</p>

    @if(session('status'))
        <div class="alert-success">
            ✅ {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <div class="input-wrap">
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="tu@correo.com" required autofocus>
                <span class="icon">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </span>
            </div>
            @error('email')<p class="error-msg">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="btn-primary">📧 Enviar enlace de recuperación</button>
    </form>

    <div class="auth-footer">
        <a href="{{ route('login') }}">← Volver a Iniciar Sesión</a>
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
</script>
</body>
</html>
