<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Transaction;
use App\Enums\TransactionStatus;
use App\Enums\StudyClassStatus;
use Carbon\Carbon;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Auto-cancel transaksi yang belum dibayar dalam 1x24 jam
Schedule::call(function () {
    $expiredTransactions = Transaction::where('status', TransactionStatus::PENDING)
        ->where('created_at', '<=', Carbon::now()->subDay())
        ->get();

    foreach ($expiredTransactions as $transaction) {
        $transaction->update(['status' => TransactionStatus::FAILED]);
        
        if ($transaction->studyClass && $transaction->studyClass->status === StudyClassStatus::PENDING) {
            $transaction->studyClass->update(['status' => StudyClassStatus::CANCELLED]);
            
            // Hapus cache siswa jika kelasnya otomatis dibatalkan
            \Illuminate\Support\Facades\Cache::forget("student.dashboard." . $transaction->studyClass->student_id);
        }
    }
})->hourly();
