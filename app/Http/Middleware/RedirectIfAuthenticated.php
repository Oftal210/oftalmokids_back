<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            //return redirect('/login');
            return response()->json(['error' => 'No autenticado. Por favor, inicie sesión.'], 401);
        }

        return $next($request);
    }
}
