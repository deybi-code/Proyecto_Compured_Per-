<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Boleta; // Debes crear este modelo basado en tu tabla 'boletas'
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // Obtenemos las boletas del usuario actual (según tu diagrama)
        $pedidos = Boleta::where('id_usuario', $user->id_usuario)->get();

        return view('dashboard', compact('user', 'pedidos'));
    }

    // Aquí irían los métodos para 'depositos', 'tickets', etc.
}
