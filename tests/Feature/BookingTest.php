<?php

namespace Tests\Feature;

use App\Models\Package;
use App\Models\Subject;
use App\Models\User;
use App\Models\StudyClass;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewBookingNotification;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_book_a_tutor(): void
    {
        Notification::fake();

        // 1. Setup Data
        $student = User::factory()->create(['active_role' => 'siswa']);
        $siswaRole = \App\Models\Role::firstOrCreate(['name' => 'siswa'], ['display_name' => 'Siswa']);
        $student->roles()->attach($siswaRole->id, ['registration_step' => 4, 'is_verified' => true]);
        
        $tutor = User::factory()->create();
        $subject = Subject::create(['name' => 'Matematika']);
        
        $package = Package::create([
            'name' => '4x Pertemuan',
            'slug' => '4x',
            'sessions_count' => 4,
            'discount_percentage' => 0,
            'price' => 400000
        ]);

        // Attach subject to tutor with price
        $tutor->taughtSubjects()->attach($subject->id, ['price_per_hour' => 100000]);

        // 2. Action
        $response = $this->actingAs($student)->post('/booking-tutor', [
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
            'metode_belajar' => 'rumah',
            'paket_mengajar' => '4x',
        ]);

        // 3. Assertions
        $response->assertRedirect();
        
        $this->assertDatabaseHas('study_classes', [
            'student_id' => $student->id,
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
            'status' => 'pending',
        ]);

        $studyClass = StudyClass::first();
        
        $this->assertDatabaseHas('transactions', [
            'study_class_id' => $studyClass->id,
            'amount' => 400000,
            'status' => 'pending',
        ]);

        Notification::assertSentTo($tutor, NewBookingNotification::class);
    }
}
