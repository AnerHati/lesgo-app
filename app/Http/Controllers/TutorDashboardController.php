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

        // Ambil kelas yang sudah aktif (dengan SEMUA relasi untuk sub-pages)
        $kelasAktif = StudyClass::where('tutor_id', $user->id)
            ->where('status', 'active')
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
        $totalPenghasilan = \App\Models\Transaction::whereIn('study_class_id', $classIds)
            ->where('status', 'paid')
            ->sum('amount');
            
        $totalTransaksi = \App\Models\Transaction::whereIn('study_class_id', $classIds)
            ->where('status', 'paid')
            ->count();

        return Inertia::render('Dashboard/Tutor/Index', [
            'pesananMasuk'  => $pesananMasuk,
            'kelasAktif'    => $kelasAktif,
            'semuaJadwal'   => $semuaJadwal,
            'user'          => $user,
            'statistik'     => [
                'totalPenghasilan' => $totalPenghasilan,
                'totalTransaksi'   => $totalTransaksi
            ]
        ]);
    }

       // ── Terima Pesanan ────────────────────────────────────────────────
    public function acceptBooking(Request $request, $id)
    {
        $studyClass = StudyClass::findOrFail($id);

        if ($studyClass->tutor_id !== Auth::id()) {
            abort(403);
        }

        $studyClass->update(['status' => 'active']);

        // Ekstrak angka dari teks paket (Misal: "4x Pertemuan" -> 4)
        $paket = $studyClass->paket_mengajar;
        $jumlahPertemuan = (int) filter_var($paket, FILTER_SANITIZE_NUMBER_INT);
        
        // Jika angka gagal diekstrak (0), default ke 1 pertemuan
        if ($jumlahPertemuan === 0) {
            $jumlahPertemuan = 1;
        }

        // Buat jadwal otomatis berulang setiap minggu (selisih 7 hari)
        for ($i = 0; $i < $jumlahPertemuan; $i++) {
            Schedule::create([
                'study_class_id' => $studyClass->id,
                'start_time' => Carbon::now()->addDays(7 * ($i + 1))->setHour(15)->setMinute(0),
                'end_time' => Carbon::now()->addDays(7 * ($i + 1))->setHour(16)->setMinute(30),
                'status' => 'scheduled'
            ]);
        }

        return redirect()->back();
    }


    // ── Tolak Pesanan ─────────────────────────────────────────────────
    public function rejectBooking(Request $request, $id)
    {
        $studyClass = StudyClass::findOrFail($id);

        if ($studyClass->tutor_id !== Auth::id()) {
            abort(403);
        }

        $studyClass->update(['status' => 'cancelled']);

        return redirect()->back();
    }

    // ── Buat Jadwal Baru ──────────────────────────────────────────────
    public function storeSchedule(Request $request)
    {
        $request->validate([
            'study_class_id' => 'required|exists:study_classes,id',
            'start_time'     => 'required|date',
            'end_time'       => 'required|date|after:start_time',
        ]);

        $studyClass = StudyClass::findOrFail($request->study_class_id);
        if ($studyClass->tutor_id !== Auth::id()) {
            abort(403);
        }

        Schedule::create([
            'study_class_id' => $request->study_class_id,
            'start_time'     => $request->start_time,
            'end_time'       => $request->end_time,
            'status'         => 'scheduled',
        ]);

        return redirect()->back();
    }

    // ── Buat Materi Baru ──────────────────────────────────────────────
    public function storeMaterial(Request $request, StudyClass $studyClass)
    {
        if ($studyClass->tutor_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $nextOrder = (int) $studyClass->materials()->max('order_index') + 1;

        $studyClass->materials()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'order_index' => $nextOrder,
            'status'      => 'active',
        ]);

        return redirect()->back();
    }

    // ── Buat Tugas Baru ───────────────────────────────────────────────
    public function storeTask(Request $request, StudyClass $studyClass)
    {
        if ($studyClass->tutor_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline'    => 'nullable|date',
        ]);

        $studyClass->tasks()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'deadline'    => $request->deadline,
            'status'      => 'pending',
        ]);

        return redirect()->back();
    }

    // ── Buat Catatan Baru ─────────────────────────────────────────────
    public function storeNote(Request $request, StudyClass $studyClass)
    {
        if ($studyClass->tutor_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $studyClass->notes()->create([
            'content' => $request->content,
        ]);

        return redirect()->back();
    }
}
