<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (! $request->user()) {
            return redirect('login'); // Redirigir a la página de inicio de sesión si no está autenticado
        }

        return $next($request); // Permitir el acceso si el usuario está autenticado
    }
}
