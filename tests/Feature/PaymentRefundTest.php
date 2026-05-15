<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\StudyClass;
use App\Models\Transaction;
use App\Models\Subject;
use App\Models\Role;
use App\Enums\TransactionStatus;
use App\Enums\StudyClassStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PaymentRefundTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        Role::firstOrCreate(['name' => 'siswa'], ['display_name' => 'Siswa']);
        Role::firstOrCreate(['name' => 'tutor'], ['display_name' => 'Tutor']);
    }

    public function test_student_can_request_refund_for_paid_transaction(): void
    {
        // 1. Setup
        $student = User::factory()->create(['active_role' => 'siswa']);
        $tutor = User::factory()->create(['active_role' => 'tutor']);
        $subject = Subject::create(['name' => 'Fisika']);

        $class = StudyClass::create([
            'student_id' => $student->id,
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
            'status' => StudyClassStatus::ACTIVE,
            'metode_belajar' => 'rumah',
            'paket_mengajar' => '4x',
        ]);

        $transaction = Transaction::create([
            'study_class_id' => $class->id,
            'amount' => 500000,
            'status' => TransactionStatus::PAID,
        ]);

        // 2. Action: Request Refund
        $response = $this->actingAs($student)
            ->postJson("/api/payment/{$transaction->id}/refund");

        // 3. Assertions
        $response->assertStatus(200);
        $transaction->refresh();
        $this->assertEquals(TransactionStatus::REFUND_REQUESTED, $transaction->status);
    }

    public function test_refund_fails_if_class_has_completed_schedules(): void
    {
        $student = User::factory()->create(['active_role' => 'siswa']);
        $tutor = User::factory()->create(['active_role' => 'tutor']);
        $subject = Subject::create(['name' => 'Biologi']);

        $class = StudyClass::create([
            'student_id' => $student->id,
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
            'status' => StudyClassStatus::ACTIVE,
            'metode_belajar' => 'rumah',
            'paket_mengajar' => '4x',
        ]);

        $transaction = Transaction::create([
            'study_class_id' => $class->id,
            'amount' => 500000,
            'status' => TransactionStatus::PAID,
        ]);

        // Create a completed schedule
        $class->schedules()->create([
            'start_time' => now()->subDay(),
            'end_time' => now()->subDay()->addHour(),
            'status' => 'completed'
        ]);

        $response = $this->actingAs($student)
            ->postJson("/api/payment/{$transaction->id}/refund");

        $response->assertStatus(422);
        $response->assertJsonFragment(['message' => 'Tidak bisa refund karena sudah ada 1 sesi yang telah selesai.']);
    }
}
