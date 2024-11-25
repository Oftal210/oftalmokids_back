<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('Authorization'); Log::info('Auth Token:', ['token' => $token]);

        if (Auth::guard($guard)->check()) {
            //return redirect('/login');
            return response()->json(['error' => 'No autenticado. Por favor, inicie sesión.'], 401);
        }


        return $next($request);
    }
}
