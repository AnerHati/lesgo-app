<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Shared/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Logout any existing session so registration always works
        if (Auth::check()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:siswa,tutor,orangtua'],
        ]);

        $roleName = $request->role;

        // Cek apakah email sudah terdaftar
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // Email sudah ada → arahkan user untuk login
            // Role baru akan otomatis ditambahkan saat login
            $loginUrl = match ($roleName) {
                'tutor' => '/login-tutor',
                'orangtua' => '/masuk-orang-tua',
                default => '/masuk-siswa',
            };

            $roleLabel = match ($roleName) {
                'tutor' => 'Tutor',
                'orangtua' => 'Orang Tua',
                default => 'Siswa',
            };

            if ($existingUser->hasRole($roleName)) {
                throw ValidationException::withMessages([
                    'email' => "Email ini sudah terdaftar sebagai {$roleLabel}. Silakan login di halaman {$roleLabel}.",
                ]);
            }

            throw ValidationException::withMessages([
                'email' => "Email ini sudah terdaftar. Silakan login di halaman {$roleLabel} untuk menambahkan role {$roleLabel} ke akun Anda.",
            ]);
        }

        // Email belum terdaftar → buat akun baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active_role' => $roleName,
        ]);

        // Assign role ke user baru
        $user->assignRole($roleName);

        event(new Registered($user));

        // Auto login user to proceed with registration steps
        Auth::login($user);

        return redirect()->route('register.step2');
    }
}
