@extends('layouts.main')

@section('title', 'Crear cuenta – Compured Perú')

@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;padding:40px 16px;background:linear-gradient(135deg,rgba(0,82,204,0.04),rgba(140,198,63,0.04))">
    <div class="cp-card" style="width:100%;max-width:500px;padding:40px">
        {{-- Header --}}
        <div class="text-center mb-6">
            <div style="font-family:'Rajdhani',sans-serif;font-size:1.4rem;font-weight:800;color:#0052CC">
                COMPURED<span style="color:#8CC63F">PERÚ</span>
            </div>
            <h1 style="font-size:1.2rem;font-weight:700;margin-top:12px;color:#172B4D" class="dark:text-white">Crea tu cuenta</h1>
            <p style="font-size:0.82rem;color:#97A0AF;margin-top:4px">Accede a ofertas exclusivas y haz seguimiento de tus pedidos</p>
        </div>

        {{-- Tab nav --}}
        <div style="display:flex;border-bottom:2px solid #DFE1E6;margin-bottom:24px" class="dark:border-gray-700">
            <a href="{{ route('login') }}" style="flex:1;text-align:center;padding:10px;font-weight:600;font-size:0.88rem;color:#97A0AF;text-decoration:none;transition:color 0.2s" class="hover:text-blue-600">Iniciar sesión</a>
            <div style="flex:1;text-align:center;padding:10px;font-weight:700;font-size:0.88rem;color:#0052CC;border-bottom:3px solid #0052CC;margin-bottom:-2px">Registrarse</div>
        </div>

        @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
                <div>
                    <label class="cp-label">Nombre completo *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="cp-input" placeholder="Juan Pérez" required>
                </div>
                <div>
                    <label class="cp-label">Correo electrónico *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="cp-input" placeholder="tu@correo.com" required>
                </div>
            </div>

            <div style="margin-bottom:14px">
                <label class="cp-label">Contraseña *</label>
                <input type="password" name="password" class="cp-input" placeholder="Mínimo 8 caracteres" required>
            </div>

            <div style="margin-bottom:20px">
                <label class="cp-label">Confirmar contraseña *</label>
                <input type="password" name="password_confirmation" class="cp-input" placeholder="Repite tu contraseña" required>
            </div>

            <button type="submit" class="btn-primary w-full justify-center py-3">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                CREAR MI CUENTA
            </button>
        </form>

        <p style="text-align:center;font-size:0.75rem;color:#97A0AF;margin-top:16px">
            Al registrarte, aceptas nuestros
            <a href="/terminos" style="color:#0052CC;font-weight:600;text-decoration:none">Términos y condiciones</a>
        </p>
    </div>
</div>
@endsection
