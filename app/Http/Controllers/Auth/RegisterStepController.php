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
        $user->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'registration_step' => 3,
        ]);

        return redirect()->route('register.step3');
    }

    public function storeStep3(Request $request)
    {
        $request->validate([
            'ktp' => ['required', 'image', 'max:5120'],
            'ijazah' => ['required', 'image', 'max:5120'],
        ]);

        $user = Auth::user();

        $ktpPath = $request->file('ktp')->store('verifications/ktp', 'public');
        $ijazahPath = $request->file('ijazah')->store('verifications/ijazah', 'public');

        $user->update([
            'ktp_path' => $ktpPath,
            'ijazah_path' => $ijazahPath,
            'registration_step' => 4, // Completed
            'is_verified' => false, // Waiting for admin
        ]);

        // Final redirect based on role
        if ($user->role === 'tutor') {
            return redirect()->route('dashboard.tutor');
        } elseif ($user->role === 'orangtua') {
            return redirect()->route('dashboard.orangtua');
        }

        return redirect()->route('dashboard.siswa');
    }
}
