<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Boleta;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // CORREGIDO: los usuarios usan 'id' (Auth::id()) como clave foránea en boletas,
        // ya que Auth::id() devuelve el valor de la clave primaria del modelo (id_usuario).
        $pedidos = Boleta::where('id_usuario', $user->id_usuario)->get();

        return view('dashboard', compact('user', 'pedidos'));
    }

    public function pedidos(): View
    {
        $user    = Auth::user();
        $pedidos = Boleta::where('id_usuario', $user->id_usuario)->latest('fecha_venta')->get();
        return view('dashboard', compact('user', 'pedidos'));
    }

    // AÑADIDO: métodos de perfil que están en las rutas pero no en el controlador original
    public function editProfile(): View
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'correo'          => 'required|email|unique:usuarios,correo,' . $user->id_usuario . ',id_usuario',
        ]);

        $user->nombre_completo = $request->nombre_completo;
        $user->correo          = $request->correo;
        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}
