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
     * @param  Closure(Request): (Response)  $next
     */
  public function handle(Request $request, Closure $next, string ...$roles): Response
{
    $user = $request->user();

    if (!$user) {
        abort(403, 'Unauthorized Access.');
    }

    // Cek apakah active_role user cocok dengan salah satu role yang diizinkan
    foreach ($roles as $role) {
        if ($user->hasRole($role) && $user->active_role === $role) {
            return $next($request);
        }
    }

    abort(403, 'Unauthorized. Role aktif Anda tidak memiliki akses ke halaman ini.');
}

}
