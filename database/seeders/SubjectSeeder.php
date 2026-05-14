<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['name' => 'Matematika', 'icon' => '📐', 'color' => '#3B82F6'],
            ['name' => 'Fisika', 'icon' => '🍎', 'color' => '#EF4444'],
            ['name' => 'Kimia', 'icon' => '🧪', 'color' => '#10B981'],
            ['name' => 'Biologi', 'icon' => '🧬', 'color' => '#8B5CF6'],
            ['name' => 'Bahasa Inggris', 'icon' => '🇺🇸', 'color' => '#F59E0B'],
            ['name' => 'Bahasa Indonesia', 'icon' => '🇮🇩', 'color' => '#EC4899'],
            ['name' => 'Bahasa Jepang', 'icon' => '🇯🇵', 'color' => '#EF4444'],
            ['name' => 'Sejarah', 'icon' => '🏛️', 'color' => '#D97706'],
            ['name' => 'Geografi', 'icon' => '🌍', 'color' => '#14B8A6'],
            ['name' => 'Ekonomi', 'icon' => '📈', 'color' => '#059669'],
            ['name' => 'Sosiologi', 'icon' => '🤝', 'color' => '#6366F1'],
            ['name' => 'Pemrograman', 'icon' => '💻', 'color' => '#334155'],
        ];

        foreach ($subjects as $subject) {
            Subject::firstOrCreate(
                ['name' => $subject['name']],
                [
                    'icon' => $subject['icon'],
                    'color' => $subject['color'],
                ]
            );
        }
    }
}
