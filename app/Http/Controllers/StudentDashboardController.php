<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyClass;
use App\Models\Task;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\StoreBookingRequest;
use App\Services\StudyClassService;
use App\Enums\StudyClassStatus;
use App\Enums\TaskStatus;


class StudentDashboardController extends Controller
{
    protected $studyClassService;

    public function __construct(StudyClassService $studyClassService)
    {
        $this->studyClassService = $studyClassService;
    }

    public function __invoke(): Response
    {
        $user = Auth::user();

        // Gunakan Cache untuk data dashboard siswa (5 menit)
        $data = Cache::remember("student.dashboard.{$user->id}", 300, function () use ($user) {
            // 1. Ambil Kelas Siswa
            $studyClasses = StudyClass::where('student_id', $user->id)
                ->with(['subject', 'tutor', 'schedules', 'tasks', 'materials', 'notes', 'transactions'])
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
                ->where('status', TaskStatus::PENDING)
                ->orderBy('deadline', 'asc')
                ->take(5)
                ->with(['studyClass.subject'])
                ->get();

            // 4. Ambil Semua Lencana (Earned vs Locked)
            $allBadges = \App\Models\Badge::orderBy('required_points', 'asc')->get();
            $earnedBadgeIds = $user->badges()->pluck('badges.id')->toArray();

            $badgesWithStatus = $allBadges->map(function ($badge) use ($earnedBadgeIds) {
                return [
                    'id' => $badge->id,
                    'name' => $badge->name,
                    'description' => $badge->description,
                    'icon_path' => $badge->icon_path,
                    'required_points' => $badge->required_points,
                    'is_earned' => in_array($badge->id, $earnedBadgeIds),
                ];
            });

            return [
                'progresKelas' => $studyClasses,
                'jadwal' => $jadwal,
                'tugas' => $tugas,
                'badges' => $badgesWithStatus,
                'totalPoints' => $user->learning_points,
                'nextBadge' => $allBadges->where('required_points', '>', $user->learning_points)->first(),
            ];
        });

        return Inertia::render('Dashboard/Student/Index', array_merge($data, [
            'user' => $user
        ]));
    }

   public function storeBooking(StoreBookingRequest $request)
    {
        try {
            $this->studyClassService->createBooking($request->validated());
            
            // Hapus cache setelah booking baru
            Cache::forget("student.dashboard." . Auth::id());
            
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    

}
