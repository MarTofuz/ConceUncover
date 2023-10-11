<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class RedirectIfLanding
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica si la ruta a la que intenta acceder el usuario es "/landing".
        if ($request->is('landing')) {
            // Obtiene la URL anterior y la almacena en la sesión.
            session(['previous_url' => URL::previous()]);

            // Redirige al usuario a la ruta anterior.
            return redirect()->route('home'); // Cambia 'home' por la ruta a la que deseas redirigir.
        }

        return $next($request);
    }
}
