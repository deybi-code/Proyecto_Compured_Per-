<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EsAdmin
{
        if(!auth()->check() || auth()->user()->role !== 'admin'){ return redirect('/dashboard'); }

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && strtolower(trim(Auth::user()->rol ?? '')) === 'admin') {
            return $next($request);
        }

        return redirect('/')->with('error', 'No tienes permisos para acceder a esta sección.');
    }
}
