<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EsVendedor
{
    /**
     * Permite acceso a vendedores Y administradores.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->rol, ['vendedor', 'administrador'])) {
            return $next($request);
        }

        return redirect('/')->with('error', 'No tienes permisos para acceder a esta sección.');
    }
}
