@extends('layouts.main')

@section('content')
<div class="flex items-center justify-center min-h-[60vh] px-4">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 p-8">
        <div class="flex border-b border-gray-200 dark:border-gray-700 mb-6">
            <a href="{{ route('login') }}" class="flex-1 text-center py-2 font-bold bg-blue-600 text-white rounded-t">Login</a>
            <a href="{{ route('register') }}" class="flex-1 text-center py-2 font-bold text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">Registrarse</a>
        </div>

        <h2 class="text-xl font-bold text-center mb-6 text-gray-800 dark:text-white">INICIA SESIÓN AHORA</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <input type="email" name="email" placeholder="correo@ejemplo.com" class="w-full p-3 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password" placeholder="••••••••" class="w-full p-3 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div class="flex justify-between items-center mb-6 text-sm">
                <label class="flex items-center text-gray-600 dark:text-gray-300">
                    <input type="checkbox" class="mr-2"> Recordar contraseña
                </label>
                <a href="{{ route('password.request') }}" class="text-blue-600 dark:text-blue-400">¿Has olvidado tu contraseña?</a>
            </div>
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded transition">LOGIN</button>
        </form>
    </div>
</div>
@endsection
