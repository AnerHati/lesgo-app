<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed data master
        $this->call([
            RoleSeeder::class,
            SubjectSeeder::class,
            PackageSeeder::class,
        ]);
        
        // Seed data dummy/testing
        $this->call(DummyDataSeeder::class);
    }
}
