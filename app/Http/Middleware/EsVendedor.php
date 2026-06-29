<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EsVendedor
{
    public function handle(Request $request, Closure $next)
    {
        $rol = strtolower(trim(Auth::user()->rol ?? ''));
        if (Auth::check() && in_array($rol, ['admin', 'vendedor'])) {
            return $next($request);
        }

        return redirect('/')->with('error', 'No tienes permisos para acceder a esta sección.');
    }
}
