<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\StudyClass;
use App\Enums\TransactionStatus;
use App\Enums\StudyClassStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RefundController extends Controller
{
    /**
     * Siswa mengajukan permintaan refund untuk transaksi yang sudah dibayar.
     * Hanya bisa dilakukan jika kelas masih pending atau active dan belum ada jadwal completed.
     */
    public function requestRefund(Request $request, $transactionId)
    {
        $transaction = Transaction::with('studyClass.schedules')->findOrFail($transactionId);

        // Pastikan user adalah siswa pemilik kelas
        if ($transaction->studyClass->student_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke transaksi ini.');
        }

        // Hanya transaksi berstatus 'paid' yang bisa di-refund
        if ($transaction->status !== TransactionStatus::PAID) {
            return response()->json([
                'message' => 'Hanya transaksi berstatus "paid" yang bisa diajukan refund.'
            ], 422);
        }

        // Cek apakah ada jadwal yang sudah completed (les sudah berjalan)
        $completedSchedules = $transaction->studyClass->schedules()
            ->where('status', 'completed')
            ->count();

        if ($completedSchedules > 0) {
            return response()->json([
                'message' => 'Tidak bisa refund karena sudah ada ' . $completedSchedules . ' sesi yang telah selesai.'
            ], 422);
        }

        $transaction->update([
            'status' => TransactionStatus::REFUND_REQUESTED,
        ]);

        Log::info('Refund requested', [
            'transaction_id' => $transaction->id,
            'student_id' => Auth::id(),
            'amount' => $transaction->amount,
            'ip' => $request->ip(),
        ]);

        return response()->json([
            'message' => 'Permintaan refund berhasil diajukan. Admin akan meninjau dalam 1-3 hari kerja.'
        ]);
    }

    /**
     * Admin menyetujui refund.
     * Dipanggil dari panel Filament atau endpoint admin.
     */
    public static function approveRefund(Transaction $transaction): void
    {
        if ($transaction->status !== TransactionStatus::REFUND_REQUESTED) {
            throw new \Exception('Transaksi ini tidak dalam status refund_requested.');
        }

        $transaction->update([
            'status' => TransactionStatus::REFUNDED,
        ]);

        // Batalkan kelas terkait
        $studyClass = $transaction->studyClass;
        if ($studyClass && in_array($studyClass->status, [StudyClassStatus::PENDING, StudyClassStatus::ACTIVE])) {
            $studyClass->transitionTo(StudyClassStatus::CANCELLED);
        }

        Log::info('Refund approved', [
            'transaction_id' => $transaction->id,
            'study_class_id' => $transaction->study_class_id,
            'amount' => $transaction->amount,
        ]);
    }

    /**
     * Admin menolak refund, status kembali ke paid.
     */
    public static function rejectRefund(Transaction $transaction): void
    {
        if ($transaction->status !== TransactionStatus::REFUND_REQUESTED) {
            throw new \Exception('Transaksi ini tidak dalam status refund_requested.');
        }

        $transaction->update([
            'status' => TransactionStatus::PAID,
        ]);

        Log::info('Refund rejected', [
            'transaction_id' => $transaction->id,
        ]);
    }
}
