<?php

namespace App\Http\Controllers;

use App\Models\TutorAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TutorAvailabilityController extends Controller
{
    /**
     * Tampilkan halaman ketersediaan jadwal tutor.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Pastikan hanya tutor yang bisa akses halaman ini
        if ($user->active_role !== 'tutor') {
            return redirect()->route('dashboard.siswa')->with('error', 'Hanya tutor yang dapat mengakses halaman ini.');
        }

        $availabilities = $user->availabilities()
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return Inertia::render('Dashboard/Tutor/Ketersediaan', [
            'availabilities' => $availabilities
        ]);
    }

    /**
     * Simpan atau perbarui jadwal ketersediaan secara bulk.
     */
    public function store(Request $request)
    {
        $request->validate([
            'availabilities' => 'present|array',
            'availabilities.*.day_of_week' => 'required|integer|min:0|max:6',
            'availabilities.*.start_time' => 'required|date_format:H:i',
            'availabilities.*.end_time' => 'required|date_format:H:i|after:availabilities.*.start_time',
        ]);

        $user = Auth::user();

        if ($user->active_role !== 'tutor') {
            return back()->withErrors(['message' => 'Hanya tutor yang dapat mengelola ketersediaan.']);
        }

        try {
            // Gunakan transaction untuk memastikan integritas data
            \DB::transaction(function () use ($user, $request) {
                // Hapus jadwal lama
                $user->availabilities()->delete();

                // Insert jadwal baru
                foreach ($request->availabilities as $slot) {
                    $user->availabilities()->create([
                        'day_of_week' => $slot['day_of_week'],
                        'start_time' => $slot['start_time'],
                        'end_time' => $slot['end_time'],
                        'is_active' => true,
                    ]);
                }
            });

            return back()->with('success', 'Seluruh jadwal ketersediaan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal memperbarui jadwal: ' . $e->getMessage()]);
        }
    }

    /**
     * API: Ambil ketersediaan tutor tertentu (untuk booking).
     */
    public function getByTutor($tutorId)
    {
        $availabilities = TutorAvailability::where('tutor_id', $tutorId)
            ->where('is_active', true)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return response()->json([
            'availabilities' => $availabilities
        ]);
    }
}
