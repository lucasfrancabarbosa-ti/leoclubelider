<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * @param  string  $role  administrador|gestor|administrador_ou_gestor
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $allowed = match ($role) {
            'administrador' => $user->isAdministrador(),
            'gestor' => $user->isGestor(),
            'administrador_ou_gestor' => $user->isAdministrador() || $user->isGestor(),
            default => false,
        };

        if (!$allowed) {
            abort(403, 'Acesso não autorizado para seu perfil.');
        }

        return $next($request);
    }
}
