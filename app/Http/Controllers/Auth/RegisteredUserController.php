<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
public function store(Request $request): RedirectResponse
{
    // 1. Validamos usando los nombres reales de los inputs del formulario
    //    (el formulario envía "nombre_completo", no "name")
    $request->validate([
        'nombre_completo' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:usuarios,correo'], // Apunta a tu tabla 'usuarios' y columna 'correo'
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // 2. Mapeamos las variables a las columnas reales de tu tabla 'usuarios'
    $user = User::create([
        'nombre_completo' => $request->nombre_completo,
        'correo'          => $request->email,
        'password'        => Hash::make($request->password), // Encriptación correcta para Laravel
        'rol'             => 'normal',                       // Soluciona el NOT NULL de la DB
        'preferencia_tema'=> 'light',                        // Soluciona el NOT NULL de la DB
    ]);

    event(new Registered($user));

    Auth::login($user);

    // Te loguea y te manda directo al Home con el mensaje de éxito
    return redirect('/')->with('status', '¡Registro exitoso! Bienvenido a Compured Perú.');
}
}
