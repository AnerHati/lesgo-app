<?php

namespace App\Http\Controllers;

use App\Models\StudyClass;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;

class TutorDashboardController extends Controller
{
       public function index(): Response
    {
        $user = Auth::user();

        // Ambil pesanan yang masuk (status pending)
        $pesananMasuk = StudyClass::where('tutor_id', $user->id)
            ->where('status', 'pending')
            ->with(['student', 'subject'])
            ->get();

        // Ambil kelas yang sudah aktif
        $kelasAktif = StudyClass::where('tutor_id', $user->id)
            ->where('status', 'active')
            ->with(['student', 'subject'])
            ->get();

        // Ambil jadwal mengajar terdekat dari kelas yang aktif
        $classIds = $kelasAktif->pluck('id');
        $jadwalMengajar = Schedule::whereIn('study_class_id', $classIds)
            ->where('start_time', '>=', Carbon::today())
            ->orderBy('start_time', 'asc')
            ->take(5)
            ->with(['studyClass.student', 'studyClass.subject'])
            ->get();

        return Inertia::render('Dashboard/Tutor/Index', [
            'pesananMasuk' => $pesananMasuk,
            'kelasAktif' => $kelasAktif,
            'jadwalMengajar' => $jadwalMengajar, // <-- Data jadwal kita lempar ke Vue
            'user' => $user
        ]);
    }


    public function acceptBooking(Request $request, $id)
    {
        $studyClass = StudyClass::findOrFail($id);

        // Keamanan: Pastikan pesanan ini ditujukan untuk tutor yang sedang login
        if ($studyClass->tutor_id !== Auth::id()) {
            abort(403);
        }

        // Terima pesanan
        $studyClass->update(['status' => 'active']);

        // Buat jadwal otomatis (TBA) untuk minggu depan jam 15:00
        Schedule::create([
            'study_class_id' => $studyClass->id,
            'start_time' => Carbon::now()->addDays(7)->setHour(15)->setMinute(0),
            'end_time' => Carbon::now()->addDays(7)->setHour(16)->setMinute(30),
            'status' => 'scheduled'
        ]);

        return redirect()->back();
    }

    public function rejectBooking(Request $request, $id)
    {
        $studyClass = StudyClass::findOrFail($id);

        if ($studyClass->tutor_id !== Auth::id()) {
            abort(403);
        }

        $studyClass->update(['status' => 'cancelled']);

        return redirect()->back();
    }
}
