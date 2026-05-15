<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\StudyClass;
use App\Models\Task;
use App\Models\TaskQuestion;
use App\Models\TaskOption;
use App\Models\Subject;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TaskQuizTest extends TestCase
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
        $student = User::factory()->create(['active_role' => 'siswa', 'learning_points' => 0]);
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

    public function test_student_gets_dynamic_points_on_quiz_submission(): void
    {
        // 1. Setup
        $student = $this->createStudentWithRole();
        $tutor = $this->createTutorWithRole();
        $subject = Subject::create(['name' => 'IPA']);

        $class = StudyClass::create([
            'student_id' => $student->id,
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
            'status' => 'active',
            'metode_belajar' => 'rumah',
            'paket_mengajar' => '4x',
        ]);

        $task = Task::create([
            'study_class_id' => $class->id,
            'title' => 'Quiz IPA 1',
            'status' => 'pending',
        ]);

        // Create 2 questions
        $q1 = TaskQuestion::create(['task_id' => $task->id, 'question' => '1+1?', 'type' => 'multiple_choice']);
        $o1_correct = TaskOption::create(['task_question_id' => $q1->id, 'label' => 'A', 'value' => '2', 'is_correct' => true]);
        $o1_wrong = TaskOption::create(['task_question_id' => $q1->id, 'label' => 'B', 'value' => '3', 'is_correct' => false]);

        $q2 = TaskQuestion::create(['task_id' => $task->id, 'question' => '2+2?', 'type' => 'multiple_choice']);
        $o2_correct = TaskOption::create(['task_question_id' => $q2->id, 'label' => 'A', 'value' => '4', 'is_correct' => true]);

        // 2. Action: Submit with 1 correct answer (Score 50)
        $response = $this->actingAs($student)
            ->postJson("/api/tasks/{$task->id}/submit", [
                'answers' => [
                    $q1->id => $o1_correct->id,
                    $q2->id => $o1_wrong->id, // Send wrong option for Q2 (using o1_wrong is fine for testing logic)
                ]
            ]);

        // 3. Assertions
        $response->assertStatus(200);
        $response->assertJsonPath('score', 50);

        // Expected Points: 10 (base) + (50 / 2) = 10 + 25 = 35
        $student->refresh();
        $this->assertEquals(35, $student->learning_points);
        
        $this->assertDatabaseHas('task_submissions', [
            'task_id' => $task->id,
            'student_id' => $student->id,
            'score' => 50
        ]);
    }

    public function test_student_gets_maximum_points_for_perfect_score(): void
    {
        $student = $this->createStudentWithRole();
        $tutor = $this->createTutorWithRole();
        $subject = Subject::create(['name' => 'IPA']);

        $class = StudyClass::create([
            'student_id' => $student->id,
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
            'status' => 'active',
            'metode_belajar' => 'rumah',
            'paket_mengajar' => '4x',
        ]);

        $task = Task::create([
            'study_class_id' => $class->id,
            'title' => 'Quiz IPA 2',
            'status' => 'pending',
        ]);

        $q1 = TaskQuestion::create(['task_id' => $task->id, 'question' => '1+1?', 'type' => 'multiple_choice']);
        $o1_correct = TaskOption::create(['task_question_id' => $q1->id, 'label' => 'A', 'value' => '2', 'is_correct' => true]);

        // Submit correct answer (Score 100)
        $this->actingAs($student)
            ->postJson("/api/tasks/{$task->id}/submit", [
                'answers' => [$q1->id => $o1_correct->id]
            ])
            ->assertStatus(200);

        // Expected Points: 10 + (100 / 2) = 60
        $student->refresh();
        $this->assertEquals(60, $student->learning_points);
    }
}
