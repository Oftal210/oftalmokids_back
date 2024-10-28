<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     
    //     return $next($request);
    // }
    
    //Funcion para validar el rol
    public function handle(Request $request, Closure $next, ...$roles)
    {   
        if (!$request->user() || !in_array($request->user()->id_rol, $roles)) {
            return response()->json(['mensaje' => 'No tiene permisos para acceder a esta ruta'], 403);
        }
        
        return $next($request);
    }

}
