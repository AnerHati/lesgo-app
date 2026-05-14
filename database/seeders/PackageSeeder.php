<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'slug' => '4x',
                'name' => '4x Pertemuan',
                'sessions_count' => 4,
                'discount_percentage' => 0,       // Tidak ada diskon
            ],
            [
                'slug' => '8x',
                'name' => '8x Pertemuan',
                'sessions_count' => 8,
                'discount_percentage' => 5.00,     // Diskon 5%
            ],
            [
                'slug' => '12x',
                'name' => '12x Pertemuan',
                'sessions_count' => 12,
                'discount_percentage' => 8.33,     // Diskon ~8.33%
            ],
        ];

        foreach ($packages as $pkg) {
            Package::updateOrCreate(
                ['slug' => $pkg['slug']],
                $pkg
            );
        }
    }
}
