<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\StudyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\TransactionStatus;

class TransactionController extends Controller
{
    /**
     * Endpoint untuk Siswa melihat riwayat tagihan/pembayaran mereka
     */
    public function getStudentTransactions()
    {
        $transactions = Transaction::whereHas('studyClass', function($q) {
            $q->where('student_id', Auth::id());
        })->with('studyClass.subject', 'studyClass.tutor')->get();

        return response()->json($transactions);
    }

    /**
     * Endpoint untuk Tutor melihat riwayat pendapatan mereka
     */
    public function getTutorEarnings()
    {
        $earnings = Transaction::whereHas('studyClass', function($q) {
            $q->where('tutor_id', Auth::id());
        })->with('studyClass.subject', 'studyClass.student')->get();

        return response()->json($earnings);
    }

    /**
     * Fungsi otomatis membuat tagihan saat kelas disetujui (Active)
     * Ini dipanggil bukan dari Frontend, tapi dari TutorDashboardController
     */
    public static function createInvoiceForClass(StudyClass $class)
{
    // Ambil harga per jam dari tabel tutor_subjects
    $pricePerHour = $class->tutor->taughtSubjects()
        ->where('subject_id', $class->subject_id)
        ->first()?->pivot?->price_per_hour ?? 50000;

    // Hitung jumlah pertemuan dari paket
    $jumlahPertemuan = (int) filter_var($class->paket_mengajar, FILTER_SANITIZE_NUMBER_INT);
    if ($jumlahPertemuan === 0) $jumlahPertemuan = 1;

    return Transaction::create([
        'study_class_id' => $class->id,
        'amount' => $pricePerHour * $jumlahPertemuan,
        'status' => TransactionStatus::PENDING,
        'payment_method' => null,
        'paid_at' => null
    ]);
}

}
