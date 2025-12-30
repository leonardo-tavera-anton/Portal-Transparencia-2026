<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Usuario;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder.');
        }

        // Verificar si el usuario está activo
        $usuario = Usuario::find(session('admin_id'));
        if (!$usuario || !$usuario->activo) {
            $username = session('admin_username', 'Usuario');
            session()->flush(); // Limpiar toda la sesión
            return redirect()->route('admin.login')->with('error', 'Su cuenta ha sido desactivada. Contacte al administrador.');
        }

        return $next($request);
    }
}
