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
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized Access.');
        }

        // Cek apakah user memiliki role yang diminta (many-to-many)
        if (!$user->hasRole($role)) {
            abort(403, 'Unauthorized Access. Anda tidak memiliki akses sebagai ' . $role . '.');
        }

        return $next($request);
    }
}
