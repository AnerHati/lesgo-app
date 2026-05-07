<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'siswa', 'display_name' => 'Siswa'],
            ['name' => 'tutor', 'display_name' => 'Tutor'],
            ['name' => 'orangtua', 'display_name' => 'Orang Tua'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
