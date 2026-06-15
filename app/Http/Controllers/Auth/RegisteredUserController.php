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
    // 1. Validamos usando los nombres de los inputs del formulario tradicional
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:usuarios,correo'], // Apunta a tu tabla 'usuarios' y columna 'correo'
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // 2. Mapeamos las variables a las columnas reales de tu tabla 'usuarios'
    $user = User::create([
        'nombre_completo' => $request->name,
        'correo'          => $request->email,
        'password'        => Hash::make($request->password), // Encriptación correcta para Laravel
        'rol'             => 'normal',                       // Soluciona el NOT NULL de la DB
        'preferencia_tema'=> 'light',                        // Soluciona el NOT NULL de la DB
        'fecha_registro'  => now(),                         // Llena el campo de fecha actual
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}
}
