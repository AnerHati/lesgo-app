<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Shared/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        $intendedRole = $request->input('intended_role'); // Role yang dimaksud dari form login

        if ($intendedRole) {
            // Jika user belum punya role ini → otomatis tambahkan!
            if (!$user->hasRole($intendedRole)) {
                $user->assignRole($intendedRole);
            }

            // Set active role
            $user->update(['active_role' => $intendedRole]);

            // Reload roles agar data pivot terbaru
            $user->load('roles');
            $pivot = $user->getRolePivot($intendedRole);

            // Cek jika role ini belum selesai, TAPI ada role lain yang sudah selesai
            // Maka otomatis complete-kan role ini agar tidak perlu isi profil berulang kali
            if ($pivot && $pivot->registration_step < 4) {
                $hasCompletedAnyRole = $user->roles()
                    ->wherePivot('registration_step', '>=', 4)
                    ->exists();

                if ($hasCompletedAnyRole) {
                    $user->roles()->updateExistingPivot($user->getRole($intendedRole)->id, [
                        'registration_step' => 4,
                        'is_verified' => true,
                    ]);
                    $pivot->registration_step = 4; // Update memory
                }
            }

            // Cek apakah registrasi untuk role ini sudah selesai
            if ($pivot && $pivot->registration_step < 4) {
                if ($pivot->registration_step <= 2) {
                    return redirect()->route('register.step2');
                }
                return redirect()->route('register.step3');
            }

            return $this->redirectToDashboard($intendedRole);
        }

        // Tidak ada intended_role → ambil role yang sudah dimiliki
        $roles = $user->roleNames();

        if (empty($roles)) {
            // User tidak punya role sama sekali (edge case)
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Akun Anda belum memiliki role. Silakan daftar terlebih dahulu.',
            ]);
        }

        // Set active role ke role pertama
        $activeRole = $user->active_role ?? $roles[0];
        $user->update(['active_role' => $activeRole]);

        // Cek registrasi step
        $pivot = $user->getRolePivot($activeRole);
        if ($pivot && $pivot->registration_step < 4) {
            if ($pivot->registration_step <= 2) {
                return redirect()->route('register.step2');
            }
            return redirect()->route('register.step3');
        }

        return $this->redirectToDashboard($activeRole);
    }

    /**
     * Redirect ke dashboard berdasarkan role.
     */
    private function redirectToDashboard(string $role): RedirectResponse
    {
        return match ($role) {
            'tutor' => redirect()->route('dashboard.tutor'),
            'orangtua' => redirect()->route('dashboard.orangtua'),
            default => redirect()->route('dashboard.siswa'),
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
