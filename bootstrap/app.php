<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        // Logika redirect pintar berdasarkan role
                // Logika redirect pintar berdasarkan role (Updated Multi-Role)
        $middleware->redirectUsersTo(function (Request $request) {
            $user = $request->user();
            
            if (!$user) return '/';

            $activeRole = $user->active_role;
            
            // Jika belum ada active_role, ambil role pertama yang dimiliki
            if (!$activeRole) {
                $roles = $user->roleNames();
                $activeRole = !empty($roles) ? $roles[0] : null;
            }

            if ($activeRole) {
                // Cek status registrasi dari tabel pivot
                $pivot = $user->getRolePivot($activeRole);
                if ($pivot && $pivot->registration_step < 4) {
                    if ($pivot->registration_step <= 2) {
                        return route('register.step2');
                    }
                    return route('register.step3');
                }

                // Redirect ke dashboard yang sesuai
                if ($activeRole === 'tutor') {
                    return route('dashboard.tutor');
                } elseif ($activeRole === 'orangtua' || $activeRole === 'parent') {
                    return route('dashboard.orangtua');
                }
            }

            // Default fallback
            return route('dashboard.siswa');
        });

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
