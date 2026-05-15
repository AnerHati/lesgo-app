<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ParentStudentPairingTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        Role::firstOrCreate(['name' => 'siswa'], ['display_name' => 'Siswa']);
        Role::firstOrCreate(['name' => 'orangtua'], ['display_name' => 'Orang Tua']);
    }

    public function test_student_can_generate_pairing_token(): void
    {
        $student = User::factory()->create(['active_role' => 'siswa']);

        $response = $this->actingAs($student)
            ->postJson('/api/pairing/token');

        $response->assertStatus(200);
        $response->assertJsonStructure(['token', 'expires_at']);

        $student->refresh();
        $this->assertNotNull($student->pairing_token);
    }

    public function test_parent_can_pair_with_student_using_token(): void
    {
        // 1. Setup Student and Token
        $student = User::factory()->create(['active_role' => 'siswa']);
        $token = $student->generatePairingToken();

        // 2. Setup Parent
        $parent = User::factory()->create(['active_role' => 'orangtua']);

        // 3. Action: Parent pairs with student
        $response = $this->actingAs($parent)
            ->postJson('/api/pairing/pair', [
                'token' => $token,
                'relationship' => 'anak'
            ]);

        // 4. Assertions
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('parent_student', [
            'parent_id' => $parent->id,
            'student_id' => $student->id,
            'relationship' => 'anak'
        ]);

        $student->refresh();
        $this->assertNull($student->pairing_token); // Token invalidated
    }

    public function test_pairing_fails_with_invalid_token(): void
    {
        $parent = User::factory()->create(['active_role' => 'orangtua']);

        $response = $this->actingAs($parent)
            ->postJson('/api/pairing/pair', [
                'token' => 'INVALID',
                'relationship' => 'anak'
            ]);

        $response->assertStatus(422);
    }
}
