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
        $middleware->redirectUsersTo(function (Request $request) {
            $user = $request->user();
            
            if (!$user) return '/';

            // Cegat user yang belum selesai melewati Step 2 & 3 agar tidak kebablasan
            if ($user->registration_step < 4) {
                if ($user->registration_step <= 2) {
                    return route('register.step2');
                }
                return route('register.step3');
            }

            if ($user->role === 'tutor') {
                return route('dashboard.tutor');
            } elseif ($user->role === 'orangtua' || $user->role === 'parent') {
                return route('dashboard.orangtua');
            }

            return route('dashboard.siswa');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
