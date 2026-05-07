<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterStepController extends Controller
{
    public function storeStep2(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
        ]);

        $user = Auth::user();
        $activeRole = $user->active_role;

        // Update data umum user
        $user->update([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Update registration_step di pivot role_user
        if ($activeRole) {
            $role = $user->roles()->where('name', $activeRole)->first();
            if ($role) {
                $user->roles()->updateExistingPivot($role->id, [
                    'registration_step' => 3,
                ]);
            }
        }

        return redirect()->route('register.step3');
    }

    public function storeStep3(Request $request)
    {
        $request->validate([
            'ktp' => ['required', 'image', 'max:5120'],
            'ijazah' => ['nullable', 'image', 'max:5120'],
        ]);

        $user = Auth::user();
        $activeRole = $user->active_role;

        $ktpPath = $request->file('ktp')->store('verifications/ktp', 'public');
        
        $ijazahPath = null;
        if ($request->hasFile('ijazah')) {
            $ijazahPath = $request->file('ijazah')->store('verifications/ijazah', 'public');
        }

        // Update di pivot role_user
        if ($activeRole) {
            $role = $user->roles()->where('name', $activeRole)->first();
            if ($role) {
                $user->roles()->updateExistingPivot($role->id, [
                    'ktp_path' => $ktpPath,
                    'ijazah_path' => $ijazahPath,
                    'registration_step' => 4, // Completed
                    'is_verified' => false,    // Waiting for admin
                ]);
            }
        }

        $roleName = $activeRole;

        // Log out the user after completing registration steps
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Final redirect to login page based on role
        if ($roleName === 'tutor') {
            return redirect('/login-tutor')->with('status', 'Pendaftaran selesai! Silakan masuk dengan akun Anda.');
        } elseif ($roleName === 'orangtua') {
            return redirect('/masuk-orang-tua')->with('status', 'Pendaftaran selesai! Silakan masuk dengan akun Anda.');
        }

        return redirect('/masuk-siswa')->with('status', 'Pendaftaran selesai! Silakan masuk dengan akun Anda.');
    }
}
