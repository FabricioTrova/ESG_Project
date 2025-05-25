<?php

namespace App\Http\Middleware;

use Closure;

class TipoUsuarioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  mixed  ...$tipos
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$tipos)
    {
        $user = auth()->user();

        if (!$user || !in_array($user->tipo_usuario, $tipos)) {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}