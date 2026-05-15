<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\StudyClass;
use App\Models\Task;
use App\Models\Subject;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TaskSecurityTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        Role::firstOrCreate(['name' => 'siswa'], ['display_name' => 'Siswa']);
        Role::firstOrCreate(['name' => 'tutor'], ['display_name' => 'Tutor']);
    }

    private function createStudentWithRole()
    {
        $student = User::factory()->create(['active_role' => 'siswa']);
        $role = Role::where('name', 'siswa')->first();
        $student->roles()->attach($role->id, ['registration_step' => 4, 'is_verified' => true]);
        return $student;
    }

    private function createTutorWithRole()
    {
        $tutor = User::factory()->create(['active_role' => 'tutor']);
        $role = Role::where('name', 'tutor')->first();
        $tutor->roles()->attach($role->id, ['registration_step' => 4, 'is_verified' => true]);
        return $tutor;
    }

    public function test_student_cannot_access_other_students_quiz(): void
    {
        // 1. Setup Students
        $studentA = $this->createStudentWithRole();
        $studentB = $this->createStudentWithRole();
        
        $tutor = $this->createTutorWithRole();
        $subject = Subject::create(['name' => 'Math']);

        // 2. Create Classes
        $classA = StudyClass::create([
            'student_id' => $studentA->id,
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
            'status' => 'active',
            'metode_belajar' => 'rumah',
            'paket_mengajar' => '4x',
        ]);

        $classB = StudyClass::create([
            'student_id' => $studentB->id,
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
            'status' => 'active',
            'metode_belajar' => 'rumah',
            'paket_mengajar' => '4x',
        ]);

        // 3. Create Tasks
        $taskA = Task::create([
            'study_class_id' => $classA->id,
            'title' => 'Task A',
            'status' => 'pending',
        ]);

        $taskB = Task::create([
            'study_class_id' => $classB->id,
            'title' => 'Task B',
            'status' => 'pending',
        ]);

        // Student A accesses Task A -> SUCCESS (200)
        $this->actingAs($studentA)
            ->getJson("/api/tasks/{$taskA->id}/quiz")
            ->assertStatus(200);

        // Student A accesses Task B -> FORBIDDEN (403)
        $this->actingAs($studentA)
            ->getJson("/api/tasks/{$taskB->id}/quiz")
            ->assertStatus(403);
    }

    public function test_student_cannot_submit_other_students_quiz(): void
    {
        // Setup same as above
        $studentA = $this->createStudentWithRole();
        $studentB = $this->createStudentWithRole();
        $tutor = $this->createTutorWithRole();
        $subject = Subject::create(['name' => 'Math']);

        $classB = StudyClass::create([
            'student_id' => $studentB->id,
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
            'status' => 'active',
            'metode_belajar' => 'rumah',
            'paket_mengajar' => '4x',
        ]);

        $taskB = Task::create([
            'study_class_id' => $classB->id,
            'title' => 'Task B',
            'status' => 'pending',
        ]);

        // Student A submits Task B -> FORBIDDEN (403)
        $this->actingAs($studentA)
            ->postJson("/api/tasks/{$taskB->id}/submit", [
                'answers' => [1 => 1]
            ])
            ->assertStatus(403);
    }

    public function test_tutor_cannot_add_question_to_other_tutors_task(): void
    {
        $tutorA = $this->createTutorWithRole();
        $tutorB = $this->createTutorWithRole();
        $student = $this->createStudentWithRole();
        $subject = Subject::create(['name' => 'Math']);

        $classB = StudyClass::create([
            'student_id' => $student->id,
            'tutor_id' => $tutorB->id,
            'subject_id' => $subject->id,
            'status' => 'active',
            'metode_belajar' => 'rumah',
            'paket_mengajar' => '4x',
        ]);

        $taskB = Task::create([
            'study_class_id' => $classB->id,
            'title' => 'Task B',
            'status' => 'pending',
        ]);

        // Tutor A adds question to Task B -> FORBIDDEN (403)
        $this->actingAs($tutorA)
            ->postJson("/api/tasks/{$taskB->id}/questions", [
                'question' => 'How much?',
                'type' => 'multiple_choice',
                'options' => [
                    ['label' => 'A', 'value' => '1', 'is_correct' => true],
                    ['label' => 'B', 'value' => '2', 'is_correct' => false],
                ]
            ])
            ->assertStatus(403);
    }
}
