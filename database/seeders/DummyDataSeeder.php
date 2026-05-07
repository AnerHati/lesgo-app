<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use App\Models\StudyClass;
use App\Models\Schedule;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Mata Pelajaran
        $math = Subject::create(['name' => 'Matematika', 'icon' => '📐', 'color' => '#3B82F6']);
        $japanese = Subject::create(['name' => 'Bahasa Jepang', 'icon' => '🇯🇵', 'color' => '#EF4444']);
        Subject::create(['name' => 'Bahasa Indonesia', 'icon' => '🇮🇩', 'color' => '#10B981']);

        // Ambil Role
        $roleSiswa = Role::where('name', 'siswa')->first();
        $roleTutor = Role::where('name', 'tutor')->first();

        // 2. Buat Tutor
        $tutorIsyana = User::create(['name' => 'Isyana Randini', 'email' => 'isyana@tutor.com', 'password' => Hash::make('password'), 'active_role' => 'tutor']);
        $tutorIsyana->roles()->attach($roleTutor, ['registration_step' => 4]);
        $tutorIsyana->tutorProfile()->create(['bio' => 'Guru Matematika berpengalaman 5 tahun.', 'hourly_rate' => 100000]);
        $tutorIsyana->taughtSubjects()->attach($math->id, ['price_per_hour' => 100000]);

        $tutorRenata = User::create(['name' => 'Renata', 'email' => 'renata@tutor.com', 'password' => Hash::make('password'), 'active_role' => 'tutor']);
        $tutorRenata->roles()->attach($roleTutor, ['registration_step' => 4]);
        $tutorRenata->tutorProfile()->create(['bio' => 'Lulusan Sastra Jepang terbaik.', 'hourly_rate' => 120000]);
        $tutorRenata->taughtSubjects()->attach($japanese->id, ['price_per_hour' => 120000]);

        // 3. Buat Siswa (Kenzo)
        $siswaKenzo = User::create(['name' => 'Kenzo', 'email' => 'kenzo@siswa.com', 'password' => Hash::make('password'), 'active_role' => 'siswa']);
        $siswaKenzo->roles()->attach($roleSiswa, ['registration_step' => 4]);
        $siswaKenzo->studentProfile()->create(['school_name' => 'SMA Negeri 1', 'grade_level' => '10']);

        // 4. Buat Kelas (Kenzo mendaftar kelas dengan Isyana & Renata)
        $classMath = StudyClass::create(['student_id' => $siswaKenzo->id, 'tutor_id' => $tutorIsyana->id, 'subject_id' => $math->id, 'status' => 'active', 'progress_percentage' => 15]);
        $classJepang = StudyClass::create(['student_id' => $siswaKenzo->id, 'tutor_id' => $tutorRenata->id, 'subject_id' => $japanese->id, 'status' => 'active', 'progress_percentage' => 65]);

        // 5. Buat Jadwal
        Schedule::create([
            'study_class_id' => $classMath->id,
            'start_time' => Carbon::today()->addHours(15), // Hari ini jam 15:00
            'end_time' => Carbon::today()->addHours(17)->addMinutes(30),
            'status' => 'scheduled'
        ]);
        Schedule::create([
            'study_class_id' => $classJepang->id,
            'start_time' => Carbon::tomorrow()->addHours(10), // Besok jam 10:00
            'end_time' => Carbon::tomorrow()->addHours(12),
            'status' => 'scheduled'
        ]);

        // 6. Buat Tugas
        Task::create([
            'study_class_id' => $classMath->id, 
            'title' => 'Transformasi Geometri', 
            'description' => 'Kerjakan soal LKS hal 45.', 
            'deadline' => Carbon::today()->addHours(23),
            'status' => 'pending'
        ]);
        Task::create([
            'study_class_id' => $classJepang->id, 
            'title' => 'Huruf Hiragana', 
            'description' => 'Tulis ulang huruf A-N 10 kali.', 
            'deadline' => Carbon::tomorrow()->addHours(8),
            'status' => 'pending'
        ]);
    }
}
