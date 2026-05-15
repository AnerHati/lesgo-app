<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\TutorAvailability;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TutorAvailabilityTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        Role::firstOrCreate(['name' => 'tutor'], ['display_name' => 'Tutor']);
        Role::firstOrCreate(['name' => 'siswa'], ['display_name' => 'Siswa']);
    }

    private function createTutorWithRole()
    {
        $tutor = User::factory()->create(['active_role' => 'tutor']);
        $role = Role::where('name', 'tutor')->first();
        $tutor->roles()->attach($role->id, ['registration_step' => 4, 'is_verified' => true]);
        return $tutor;
    }

    public function test_tutor_can_store_bulk_availabilities(): void
    {
        $tutor = $this->createTutorWithRole();

        $response = $this->actingAs($tutor)
            ->post('/tutor/ketersediaan', [
                'availabilities' => [
                    ['day_of_week' => 1, 'start_time' => '08:00', 'end_time' => '10:00'],
                    ['day_of_week' => 2, 'start_time' => '13:00', 'end_time' => '15:00'],
                ]
            ]);

        $response->assertStatus(302); // Redirect back
        
        $this->assertDatabaseHas('tutor_availabilities', [
            'tutor_id' => $tutor->id,
            'day_of_week' => 1,
            'start_time' => '08:00',
        ]);

        $this->assertEquals(2, $tutor->availabilities()->count());
    }

    public function test_tutor_can_sync_availabilities_overwriting_old_ones(): void
    {
        $tutor = $this->createTutorWithRole();
        
        // Old availability
        TutorAvailability::create([
            'tutor_id' => $tutor->id,
            'day_of_week' => 5,
            'start_time' => '10:00',
            'end_time' => '11:00',
            'is_active' => true
        ]);

        $this->actingAs($tutor)
            ->post('/tutor/ketersediaan', [
                'availabilities' => [
                    ['day_of_week' => 1, 'start_time' => '09:00', 'end_time' => '12:00'],
                ]
            ]);

        // Old one (day 5) should be gone
        $this->assertDatabaseMissing('tutor_availabilities', ['day_of_week' => 5]);
        $this->assertDatabaseHas('tutor_availabilities', ['day_of_week' => 1]);
        $this->assertEquals(1, $tutor->availabilities()->count());
    }

    public function test_non_tutor_cannot_store_availability(): void
    {
        $student = User::factory()->create(['active_role' => 'siswa']);
        
        $response = $this->actingAs($student)
            ->post('/tutor/ketersediaan', [
                'availabilities' => []
            ]);

        $response->assertSessionHasErrors(['message']);
    }
}
