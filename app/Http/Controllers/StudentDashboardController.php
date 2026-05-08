<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyClass;
use App\Models\Task;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class StudentDashboardController extends Controller
{
    public function __invoke(): Response
    {
        $user = Auth::user();

        // 1. Ambil Kelas Siswa
        $studyClasses = StudyClass::where('student_id', $user->id)
            ->with(['subject', 'tutor', 'schedules', 'tasks', 'materials', 'notes'])
            ->get();

        $classIds = $studyClasses->pluck('id');

        // 2. Ambil Jadwal Terdekat
        $jadwal = Schedule::whereIn('study_class_id', $classIds)
            ->where('start_time', '>=', now()->startOfDay())
            ->orderBy('start_time')
            ->take(5)
            ->with(['studyClass.subject', 'studyClass.tutor'])
            ->get();

        // 3. Ambil Tugas yang belum selesai
        $tugas = Task::whereIn('study_class_id', $classIds)
            ->where('status', 'pending')
            ->orderBy('deadline', 'asc')
            ->take(5)
            ->with(['studyClass.subject'])
            ->get();

               // 4. Ambil Daftar Semua Tutor untuk Halaman "Cari Tutor"
        $tutors = User::whereHas('roles', fn($q) => $q->where('name', 'tutor'))
            ->with(['tutorProfile', 'taughtSubjects'])
            ->get()
            ->map(function ($tutor) use ($user) {
                // Kalkulasi jarak menggunakan Haversine Formula (KM)
                $distance = 0;
                if ($user->latitude && $user->longitude && $tutor->latitude && $tutor->longitude) {
                    $latFrom = deg2rad($user->latitude);
                    $lonFrom = deg2rad($user->longitude);
                    $latTo = deg2rad($tutor->latitude);
                    $lonTo = deg2rad($tutor->longitude);

                    $latDelta = $latTo - $latFrom;
                    $lonDelta = $lonTo - $lonFrom;

                    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                      cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
                    $distance = $angle * 6371; // Radius bumi dalam KM
                }

                return [
                    'id' => $tutor->id,
                    'name' => $tutor->name,
                    'description' => $tutor->tutorProfile->bio ?? 'Tutor berpengalaman dan sabar.',
                    'rating' => $tutor->tutorProfile->rating ?? 0,
                    'distance' => round($distance, 1), // Jarak dihitung akurat ke 1 desimal
                    'subjects' => $tutor->taughtSubjects->map(fn($s) => [
                        'id' => $s->id,
                        'name' => $s->name,
                        'icon' => $s->icon,
                        'price' => $s->pivot->price_per_hour
                    ])->toArray()
                ];
            });

        return Inertia::render('Dashboard/Student/Index', [
            'progresKelas' => $studyClasses,
            'jadwal' => $jadwal,
            'tugas' => $tugas,
            'tutors' => $tutors, // <--- Data tutor kita lempar ke frontend
            'user' => $user
        ]);
    }

        public function storeBooking(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'metode_belajar' => 'required|string',
            'paket_mengajar' => 'required|string',
        ]);

        $studyClass = StudyClass::create([
            'student_id' => Auth::id(),
            'tutor_id' => $request->tutor_id,
            'subject_id' => $request->subject_id,
            'metode_belajar' => $request->metode_belajar,
            'paket_mengajar' => $request->paket_mengajar,
            'status' => 'pending',
            'progress_percentage' => 0,
        ]);

        // Kirim notifikasi ke tutor
        $tutor = \App\Models\User::find($request->tutor_id);
        $studyClass->load('student', 'subject');
        $tutor->notify(new \App\Notifications\NewBookingNotification($studyClass));

        // Hitung harga berdasarkan paket
        $paket = strtolower($request->paket_mengajar);
        $amount = 100000; // default 1x pertemuan
        
        if (str_contains($paket, '4x')) {
            $amount = 400000;
        } elseif (str_contains($paket, '8x')) {
            $amount = 760000;
        } elseif (str_contains($paket, '12x')) {
            $amount = 1100000;
        }

        // Buat transaksi awal status pending
        \App\Models\Transaction::create([
            'study_class_id' => $studyClass->id,
            'amount' => $amount,
            'status' => 'pending',
            'payment_method' => null,
            'paid_at' => null
        ]);

        return redirect()->back();
    }

    public function payBooking(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string'
        ]);

        $transaction = \App\Models\Transaction::where('study_class_id', $id)
            ->whereHas('studyClass', function($q) {
                $q->where('student_id', Auth::id());
            })->firstOrFail();

        $transaction->update([
            'status' => 'paid',
            'payment_method' => $request->payment_method,
            'paid_at' => now()
        ]);

        return redirect()->back();
    }

}
