<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Profil khusus siswa
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('grade_level')->nullable();      // SD/SMP/SMA/Kuliah
            $table->string('school_name')->nullable();
            $table->text('bio')->nullable();
            $table->text('learning_goals')->nullable();      // Tujuan belajar
            $table->timestamps();

            $table->unique('user_id'); // 1 user = 1 student profile
        });

        // Profil khusus tutor
        Schema::create('tutor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('bio')->nullable();
            $table->decimal('hourly_rate', 12, 2)->nullable();  // Tarif per jam
            $table->integer('experience_years')->default(0);
            $table->string('education')->nullable();             // Pendidikan terakhir
            $table->text('teaching_method')->nullable();         // Metode mengajar
            $table->json('subjects_taught')->nullable();         // Mata pelajaran ["Matematika","Fisika"]
            $table->json('availability')->nullable();            // Jadwal tersedia
            $table->decimal('rating', 3, 2)->default(0);         // Rating rata-rata
            $table->integer('total_reviews')->default(0);
            $table->timestamps();

            $table->unique('user_id'); // 1 user = 1 tutor profile
        });

        // Profil khusus orang tua
        Schema::create('parent_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('occupation')->nullable();            // Pekerjaan
            $table->string('emergency_contact')->nullable();
            $table->timestamps();

            $table->unique('user_id'); // 1 user = 1 parent profile
        });

        // Relasi orang tua ↔ siswa
        Schema::create('parent_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->string('relationship')->default('anak');     // anak, keponakan, dll
            $table->timestamps();

            $table->unique(['parent_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_student');
        Schema::dropIfExists('parent_profiles');
        Schema::dropIfExists('tutor_profiles');
        Schema::dropIfExists('student_profiles');
    }
};
