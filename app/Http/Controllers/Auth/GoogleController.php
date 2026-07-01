<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    /**
     * Redirige al usuario a la pantalla de login de Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Maneja el callback de Google después del login.
     *
     * CORRECCIONES:
     * 1. Usa las columnas reales de tu tabla 'usuarios': correo, nombre_completo
     * 2. Agrega 'rol' y 'preferencia_tema' (columnas NOT NULL sin default en algunos entornos)
     * 3. Redirige al home '/' en lugar de '/dashboard' para usuarios normales
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate(
                // Buscar por correo (columna real de tu tabla)
                ['correo' => $googleUser->getEmail()],
                // Crear o actualizar con los campos reales
                [
                    'nombre_completo'  => $googleUser->getName(),
                    'password'         => Hash::make(uniqid()),  // password dummy (login es via Google)
                    'rol'              => 'cliente',
                    'preferencia_tema' => 'light',
                ]
            );

            Auth::login($user);

            return redirect('/')->with('success', '¡Bienvenido, ' . $user->nombre_completo . '!');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'No se pudo iniciar sesión con Google: ' . $e->getMessage());
        }
    }
}
