<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Boleta;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user    = Auth::user();
        $pedidos = Boleta::where('id_usuario', $user->id_usuario)
                         ->orderByDesc('fecha_venta')
                         ->get();

        return view('dashboard', compact('user', 'pedidos'));
    }

    public function pedidos(): View
    {
        $user    = Auth::user();
        $pedidos = Boleta::where('id_usuario', $user->id_usuario)
                         ->orderByDesc('fecha_venta')
                         ->get();

        return view('dashboard', compact('user', 'pedidos'));
    }

    public function editProfile(): View
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request): RedirectResponse
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
