<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SwitchRoleTest extends TestCase
{
    use RefreshDatabase;

    private function createUserWithRoles(array $roleNames): User
    {
        $user = User::factory()->create(['active_role' => $roleNames[0]]);
        
        foreach ($roleNames as $roleName) {
            $role = Role::firstOrCreate(
                ['name' => $roleName],
                ['display_name' => ucfirst($roleName)]
            );
            $user->roles()->attach($role->id, [
                'registration_step' => 4,
                'is_verified' => true,
            ]);
        }

        return $user;
    }

    public function test_user_can_switch_to_owned_role(): void
    {
        $user = $this->createUserWithRoles(['siswa', 'tutor']);
        $this->assertEquals('siswa', $user->active_role);

        $response = $this->actingAs($user)->post('/switch-role', [
            'role' => 'tutor',
        ]);

        $response->assertRedirect(route('dashboard.tutor'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'active_role' => 'tutor',
        ]);
    }

    public function test_user_cannot_switch_to_unowned_role(): void
    {
        $user = $this->createUserWithRoles(['siswa']);

        $response = $this->actingAs($user)->post('/switch-role', [
            'role' => 'tutor',
        ]);

        $response->assertSessionHasErrors('role');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'active_role' => 'siswa', // Tidak berubah
        ]);
    }

    public function test_user_cannot_switch_to_invalid_role(): void
    {
        $user = $this->createUserWithRoles(['siswa']);

        $response = $this->actingAs($user)->post('/switch-role', [
            'role' => 'admin_palsu',
        ]);

        // Validasi in:siswa,tutor,orangtua harus menolak
        $response->assertSessionHasErrors('role');
    }

    public function test_switch_role_redirects_to_correct_dashboard(): void
    {
        $user = $this->createUserWithRoles(['siswa', 'tutor', 'orangtua']);

        // Switch ke tutor
        $response = $this->actingAs($user)->post('/switch-role', ['role' => 'tutor']);
        $response->assertRedirect(route('dashboard.tutor'));

        // Switch ke orangtua
        $response = $this->actingAs($user)->post('/switch-role', ['role' => 'orangtua']);
        $response->assertRedirect(route('dashboard.orangtua'));

        // Switch balik ke siswa
        $response = $this->actingAs($user)->post('/switch-role', ['role' => 'siswa']);
        $response->assertRedirect(route('dashboard.siswa'));
    }

    public function test_role_middleware_blocks_wrong_active_role(): void
    {
        $user = $this->createUserWithRoles(['siswa', 'tutor']);
        $user->update(['active_role' => 'siswa']);

        // Coba akses dashboard tutor dengan active_role siswa
        $response = $this->actingAs($user)->get('/dashboard-tutor');
        $response->assertStatus(403);
    }

    public function test_role_middleware_allows_correct_active_role(): void
    {
        $user = $this->createUserWithRoles(['siswa']);

        // Akses dashboard siswa dengan active_role siswa
        $response = $this->actingAs($user)->get('/dashboard-siswa');
        $response->assertStatus(200);
    }
}
