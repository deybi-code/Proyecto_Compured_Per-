@extends('layouts.main')

@section('content')
<div class="flex items-center justify-center min-h-[60vh] px-4 py-8">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 p-8">
        <div class="flex border-b border-gray-200 dark:border-gray-700 mb-6">
            <a href="{{ route('login') }}" class="flex-1 text-center py-2 font-bold text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition">Login</a>
            <a href="{{ route('register') }}" class="flex-1 text-center py-2 font-bold bg-blue-600 text-white rounded-t">Registrarse</a>
        </div>

        <h2 class="text-xl font-bold text-center mb-6 text-gray-800 dark:text-white">REGÍSTRATE AHORA</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4 flex items-center bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-3 py-2">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <input type="text" name="name" placeholder="Nombre completo" class="w-full bg-transparent border-none focus:ring-0 text-gray-800 dark:text-white p-1" required>
            </div>

            <div class="mb-4 flex items-center bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-3 py-2">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <input type="email" name="email" placeholder="correo@ejemplo.com" class="w-full bg-transparent border-none focus:ring-0 text-gray-800 dark:text-white p-1" required>
            </div>

            <div class="mb-4 flex items-center bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-3 py-2">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                <input type="text" name="phone" placeholder="Número de teléfono" class="w-full bg-transparent border-none focus:ring-0 text-gray-800 dark:text-white p-1">
            </div>

            <div class="mb-4 flex items-center bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-3 py-2">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <input type="text" name="address" placeholder="Dirección" class="w-full bg-transparent border-none focus:ring-0 text-gray-800 dark:text-white p-1">
            </div>

            <div class="mb-4 flex items-center bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-3 py-2">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                <input type="password" name="password" placeholder="••••••••" class="w-full bg-transparent border-none focus:ring-0 text-gray-800 dark:text-white p-1" required>
            </div>

            <div class="mb-6 flex items-center bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-3 py-2">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" class="w-full bg-transparent border-none focus:ring-0 text-gray-800 dark:text-white p-1" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded transition">REGISTRARSE</button>
        </form>
    </div>
</div>
@endsection
