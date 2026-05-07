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
            ->with(['subject', 'tutor'])
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
            ->map(function ($tutor) {
                return [
                    'id' => $tutor->id,
                    'name' => $tutor->name,
                    'description' => $tutor->tutorProfile->bio ?? 'Tutor berpengalaman dan sabar. Ahli di bidangnya!',
                    'rating' => 4.7, // Rating dummy sementara
                    'distance' => rand(1, 10) + (rand(1, 9) / 10), // Jarak dummy sementara
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

        StudyClass::create([
            'student_id' => Auth::id(),
            'tutor_id' => $request->tutor_id,
            'subject_id' => $request->subject_id,
            'metode_belajar' => $request->metode_belajar,
            'paket_mengajar' => $request->paket_mengajar,
            'status' => 'pending',
            'progress_percentage' => 0,
        ]);

        return redirect()->back();
    }

}
