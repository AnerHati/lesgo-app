<?php

namespace App\Services;

use App\Models\StudyClass;
use App\Models\Schedule;
use App\Models\Package;
use App\Models\User;
use App\Models\Transaction;
use App\Enums\StudyClassStatus;
use App\Enums\TransactionStatus;
use App\Enums\ScheduleStatus;
use App\Notifications\NewBookingNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudyClassService
{
    /**
     * Create a new booking.
     */
    public function createBooking(array $data): StudyClass
    {
        return DB::transaction(function () use ($data) {
            // Check for existing active/pending booking for the same student-tutor-subject
            $existing = StudyClass::where('student_id', Auth::id())
                ->where('tutor_id', $data['tutor_id'])
                ->where('subject_id', $data['subject_id'])
                ->whereIn('status', [StudyClassStatus::PENDING, StudyClassStatus::ACTIVE])
                ->first();

            if ($existing) {
                throw new \Exception('Anda sudah memiliki pesanan aktif atau tertunda untuk tutor dan mata pelajaran ini.');
            }

            $package = Package::where('slug', $data['paket_mengajar'])->firstOrFail();
            $tutor = User::findOrFail($data['tutor_id']);
            
            // Security Check: Pastikan tutor sudah diverifikasi oleh admin
            $tutorPivot = $tutor->getRolePivot('tutor');
            if (!$tutorPivot || !$tutorPivot->is_verified) {
                throw new \Exception('Tutor ini belum diverifikasi oleh admin dan belum dapat menerima pesanan.');
            }

            $tutorSubject = $tutor->taughtSubjects()
                ->where('subject_id', $data['subject_id'])
                ->first();

            if (!$tutorSubject) {
                throw new \Exception('Tutor tidak mengajar mata pelajaran ini.');
            }

            $pricePerHour = $tutorSubject->pivot->price_per_hour;
            $amount = (int) round($pricePerHour * $package->sessions_count * (1 - $package->discount_percentage / 100));

            $studyClass = StudyClass::create([
                'student_id' => Auth::id(),
                'tutor_id' => $data['tutor_id'],
                'subject_id' => $data['subject_id'],
                'metode_belajar' => $data['metode_belajar'],
                'paket_mengajar' => $package->name,
                'status' => StudyClassStatus::PENDING,
                'progress_percentage' => 0,
                'preferred_start_time' => $data['preferred_start_time'] ?? null,
            ]);

            // Create pending transaction
            Transaction::create([
                'study_class_id' => $studyClass->id,
                'amount' => $amount,
                'status' => TransactionStatus::PENDING,
            ]);

            // Notify tutor
            $studyClass->load('student', 'subject');
            $tutor->notify(new NewBookingNotification($studyClass));

            return $studyClass;
        });
    }

    /**
     * Accept a booking and generate schedules based on the package and preferred time.
     */
    public function acceptBooking(StudyClass $studyClass): StudyClass
    {
        return DB::transaction(function () use ($studyClass) {
            $studyClass->transitionTo(StudyClassStatus::ACTIVE);

            // Extract session count from package name (e.g., "4x Pertemuan" -> 4)
            $packageName = $studyClass->paket_mengajar;
            $sessionCount = (int) filter_var($packageName, FILTER_SANITIZE_NUMBER_INT);
            
            if ($sessionCount === 0) {
                $sessionCount = 1;
            }

            // Determine base start time
            $startTime = $studyClass->preferred_start_time 
                ? Carbon::parse($studyClass->preferred_start_time)
                : Carbon::now()->addDays(7)->setHour(15)->setMinute(0);

            if ($startTime->isPast()) {
                $startTime = $startTime->addWeeks(1);
            }

            // Generate schedules
            for ($i = 0; $i < $sessionCount; $i++) {
                $sessionStart = $startTime->copy()->addWeeks($i);
                $sessionEnd = $sessionStart->copy()->addMinutes(90);

                Schedule::create([
                    'study_class_id' => $studyClass->id,
                    'start_time' => $sessionStart,
                    'end_time' => $sessionEnd,
                    'status' => ScheduleStatus::SCHEDULED
                ]);
            }

            // Notify Student
            $studyClass->load(['student', 'subject']);
            $studyClass->student->notify(new \App\Notifications\BookingAcceptedNotification($studyClass));

            return $studyClass;
        });
    }

    /**
     * Reject a booking.
     */
    public function rejectBooking(StudyClass $studyClass): StudyClass
    {
        $studyClass->transitionTo(StudyClassStatus::CANCELLED);
        
        // Notify Student
        $studyClass->load(['student', 'subject']);
        $studyClass->student->notify(new \App\Notifications\BookingRejectedNotification($studyClass));

        return $studyClass;
    }
}
