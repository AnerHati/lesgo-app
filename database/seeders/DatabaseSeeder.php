<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed roles terlebih dahulu
        $this->call(RoleSeeder::class);
        
        // Seed data aplikasi
        $this->call(DummyDataSeeder::class);
    }
}
