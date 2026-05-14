<?php

namespace App\Http\Controllers;

use App\Models\StudyClass;
use App\Models\Schedule;
use App\Models\Task;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\StoreNoteRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use App\Services\StudyClassService;
use App\Enums\StudyClassStatus;
use App\Enums\ScheduleStatus;
use App\Enums\MaterialStatus;
use App\Enums\TaskStatus;


class TutorDashboardController extends Controller
{
    protected $studyClassService;

    public function __construct(StudyClassService $studyClassService)
    {
        $this->studyClassService = $studyClassService;
    }

    public function index(): Response
    {
        $user = Auth::user();

        // Ambil pesanan yang masuk (status pending)
        $pesananMasuk = StudyClass::where('tutor_id', $user->id)
            ->where('status', StudyClassStatus::PENDING)
            ->with(['student', 'subject'])
            ->get();

        // Ambil kelas yang sudah aktif (dengan SEMUA relasi untuk sub-pages)
        $kelasAktif = StudyClass::where('tutor_id', $user->id)
            ->where('status', StudyClassStatus::ACTIVE)
            ->with([
                'student.studentProfile',
                'subject',
                'materials',
                'tasks',
                'notes',
                'schedules',
            ])
            ->get();

               // Ambil SEMUA jadwal mengajar dari kelas aktif
        $classIds = $kelasAktif->pluck('id');
        $semuaJadwal = Schedule::whereIn('study_class_id', $classIds)
            ->where('start_time', '>=', Carbon::today())
            ->orderBy('start_time', 'asc')
            ->with(['studyClass.student.studentProfile', 'studyClass.subject'])
            ->get();

        // Hitung total penghasilan berdasarkan transaksi yang statusnya 'paid'
        $statistik = Cache::remember("tutor.stats.{$user->id}", 300, function () use ($classIds) {
            $totalPenghasilan = \App\Models\Transaction::whereIn('study_class_id', $classIds)
                ->where('status', \App\Enums\TransactionStatus::PAID)
                ->sum('amount');
                
            $totalTransaksi = \App\Models\Transaction::whereIn('study_class_id', $classIds)
                ->where('status', \App\Enums\TransactionStatus::PAID)
                ->count();

            return [
                'totalPenghasilan' => $totalPenghasilan,
                'totalTransaksi'   => $totalTransaksi
            ];
        });

        $availabilities = $user->availabilities()
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return Inertia::render('Dashboard/Tutor/Index', [
            'pesananMasuk'   => $pesananMasuk,
            'kelasAktif'     => $kelasAktif,
            'semuaJadwal'    => $semuaJadwal,
            'user'           => $user,
            'statistik'      => $statistik,
            'availabilities' => $availabilities
        ]);
    }

    // ── Terima Pesanan ────────────────────────────────────────────────
    public function acceptBooking(Request $request, $id)
    {
        $studyClass = StudyClass::findOrFail($id);
        Gate::authorize('manage', $studyClass);

        $this->studyClassService->acceptBooking($studyClass);

        // Hapus cache statistik tutor & dashboard siswa
        Cache::forget("tutor.stats." . Auth::id());
        Cache::forget("student.dashboard." . $studyClass->student_id);

        return redirect()->back();
    }


    // ── Tolak Pesanan ─────────────────────────────────────────────────
    public function rejectBooking(Request $request, $id)
    {
        $studyClass = StudyClass::findOrFail($id);
        Gate::authorize('manage', $studyClass);

        $studyClass->transitionTo(StudyClassStatus::CANCELLED);
        Cache::forget("student.dashboard." . $studyClass->student_id);

        return redirect()->back();
    }

    // ── Buat Jadwal Baru ──────────────────────────────────────────────
   public function storeSchedule(StoreScheduleRequest $request)
    {
        
        $studyClass = StudyClass::findOrFail($request->study_class_id);
        Gate::authorize('manage', $studyClass);


        Schedule::create([
            'study_class_id' => $request->study_class_id,
            'start_time'     => $request->start_time,
            'end_time'       => $request->end_time,
            'status'         => ScheduleStatus::SCHEDULED,
        ]);

        return redirect()->back();
    }

    // ── Buat Materi Baru ──────────────────────────────────────────────
  public function storeMaterial(StoreMaterialRequest $request, StudyClass $studyClass)
    {
        Gate::authorize('manage', $studyClass);


      

        $nextOrder = (int) $studyClass->materials()->max('order_index') + 1;

        $studyClass->materials()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'order_index' => $nextOrder,
            'status'      => MaterialStatus::ACTIVE,
        ]);

        return redirect()->back();
    }

    
    public function storeTask(StoreTaskRequest $request, StudyClass $studyClass)
{
   
   Gate::authorize('manage', $studyClass);


        $studyClass->tasks()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'deadline'    => $request->deadline,
            'status'      => TaskStatus::PENDING,
        ]);

        return redirect()->back();
    }

    // ── Buat Catatan Baru ─────────────────────────────────────────────
  public function storeNote(StoreNoteRequest $request, StudyClass $studyClass) 
  {
        Gate::authorize('manage', $studyClass);


        $studyClass->notes()->create([
            'content' => $request->content,
        ]);

        return redirect()->back();
    }
}
