<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\StudyClass;
use App\Models\Message;
use App\Models\Subject;
use App\Enums\StudyClassStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private function setupUsersWithClass(string $status = 'active'): array
    {
        $student = User::factory()->create(['active_role' => 'siswa']);
        $tutor = User::factory()->create(['active_role' => 'tutor']);
        $subject = Subject::create(['name' => 'Bahasa Inggris', 'slug' => 'english']);

        // Assign roles
        $siswaRole = Role::create(['name' => 'siswa', 'display_name' => 'Siswa']);
        $tutorRole = Role::create(['name' => 'tutor', 'display_name' => 'Tutor']);
        $student->roles()->attach($siswaRole->id, ['registration_step' => 4, 'is_verified' => true]);
        $tutor->roles()->attach($tutorRole->id, ['registration_step' => 4, 'is_verified' => true]);

        $studyClass = StudyClass::create([
            'student_id' => $student->id,
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
            'status' => $status,
            'metode_belajar' => 'online',
            'paket_mengajar' => '4x Pertemuan',
            'progress_percentage' => 0,
        ]);

        return compact('student', 'tutor', 'studyClass');
    }

    public function test_student_can_send_message_to_connected_tutor(): void
    {
        $data = $this->setupUsersWithClass('active');

        $response = $this->actingAs($data['student'])->postJson('/api/chat/messages', [
            'receiver_id' => $data['tutor']->id,
            'message' => 'Halo pak, besok jadi belajar?',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('messages', [
            'sender_id' => $data['student']->id,
            'receiver_id' => $data['tutor']->id,
        ]);
    }

    public function test_student_cannot_send_message_to_unconnected_user(): void
    {
        $data = $this->setupUsersWithClass('active');
        $stranger = User::factory()->create(['active_role' => 'tutor']);

        $response = $this->actingAs($data['student'])->postJson('/api/chat/messages', [
            'receiver_id' => $stranger->id,
            'message' => 'Halo pak',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('messages', [
            'sender_id' => $data['student']->id,
            'receiver_id' => $stranger->id,
        ]);
    }

    public function test_student_cannot_message_tutor_with_pending_class(): void
    {
        $data = $this->setupUsersWithClass('pending');

        $response = $this->actingAs($data['student'])->postJson('/api/chat/messages', [
            'receiver_id' => $data['tutor']->id,
            'message' => 'Halo pak',
        ]);

        $response->assertStatus(403);
    }

    public function test_student_can_fetch_messages_from_connected_tutor(): void
    {
        $data = $this->setupUsersWithClass('active');

        // Buat pesan dulu
        Message::create([
            'sender_id' => $data['tutor']->id,
            'receiver_id' => $data['student']->id,
            'message' => 'Selamat pagi!',
            'is_read' => false,
        ]);

        $response = $this->actingAs($data['student'])->getJson('/api/chat/messages/' . $data['tutor']->id);

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function test_student_cannot_fetch_messages_from_unconnected_user(): void
    {
        $data = $this->setupUsersWithClass('active');
        $stranger = User::factory()->create();

        $response = $this->actingAs($data['student'])->getJson('/api/chat/messages/' . $stranger->id);

        $response->assertStatus(403);
    }

    public function test_tutor_can_send_message_to_connected_student(): void
    {
        $data = $this->setupUsersWithClass('active');

        $response = $this->actingAs($data['tutor'])->postJson('/api/chat/messages', [
            'receiver_id' => $data['student']->id,
            'message' => 'Jangan lupa kerjakan PR ya!',
        ]);

        $response->assertStatus(200);
    }
}
