<!DOCTYPE html>
<html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Recuperar contraseña – Compured Perú</title>
<script src="{{ asset('js/theme.js') }}"></script>
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
.auth-bg{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;background:linear-gradient(135deg,#091E42 0%,#003A99 50%,#0052CC 100%)}
html.dark .auth-bg{background:linear-gradient(135deg,#010409,#0D1117,#091E42)}
.auth-card{background:rgba(255,255,255,0.97);border-radius:16px;padding:40px;width:100%;max-width:420px;box-shadow:0 25px 60px rgba(0,0,0,0.3);border-top:4px solid #0052CC}
html.dark .auth-card{background:rgba(22,27,34,0.97)}
</style>
</head><body>
<div class="auth-bg">
<div class="auth-card">
    <div style="text-align:center;margin-bottom:24px">
        <div style="font-size:2rem;margin-bottom:8px">🔑</div>
        <div style="font-family:'Rajdhani',sans-serif;font-size:1.4rem;font-weight:800;color:#0052CC">COMPURED<span style="color:#8CC63F">PERÚ</span></div>
        <h2 style="font-size:1rem;font-weight:700;color:#172B4D;margin-top:10px" class="dark:text-white">Recuperar contraseña</h2>
        <p style="font-size:0.8rem;color:#97A0AF;margin-top:4px">Te enviaremos un enlace para restablecer tu contraseña</p>
    </div>
    @if(session('status'))<div class="alert-success">{{ session('status') }}</div>@endif
    @if($errors->any())<div class="alert-error">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label class="cp-label">Correo electrónico</label>
        <input type="email" name="email" class="cp-input" style="margin-bottom:16px" placeholder="tu@correo.com" value="{{ old('email') }}" required>
        <button type="submit" class="btn-primary w-full justify-center py-3">Enviar enlace</button>
    </form>
    <div style="text-align:center;margin-top:16px"><a href="{{ route('login') }}" style="font-size:0.82rem;color:#0052CC;text-decoration:none" class="hover:underline">← Volver al login</a></div>
</div>
</div>
</body></html>
