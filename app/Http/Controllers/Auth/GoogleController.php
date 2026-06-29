<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'password' => Hash::make(uniqid()),
            ]);

            Auth::login($user);
            return redirect('/dashboard'); // O a la ruta que prefieras
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'No se pudo iniciar sesión con Google.');
        }
    }
}
