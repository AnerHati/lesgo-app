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

        // Handle variations of parent role
        $userRole = $user->role;
        if ($userRole === 'parent' && $role === 'orangtua') {
            $userRole = 'orangtua';
        }

        if ($userRole !== $role) {
            abort(403, 'Unauthorized Access.');
        }

        return $next($request);
    }
}
