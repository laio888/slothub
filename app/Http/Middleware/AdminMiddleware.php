<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware {
    public function handle(Request $request, Closure $next) {
        if (!session('cliente_id')) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión.');
        }

        if (session('cliente_rol') !== 'admin') {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para acceder a esa sección.');
        }

        return $next($request);
    }
}
