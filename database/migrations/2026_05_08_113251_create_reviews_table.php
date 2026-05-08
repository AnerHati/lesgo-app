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
       Schema::create('reviews', function (Blueprint $table) {
    $table->id();
    $table->foreignId('study_class_id')->constrained()->cascadeOnDelete();
    $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('tutor_id')->constrained('users')->cascadeOnDelete();
    $table->tinyInteger('rating'); // 1-5 bintang
    $table->text('comment')->nullable();
    $table->boolean('is_visible')->default(true); // untuk moderasi
    $table->timestamps();

    // Satu siswa hanya bisa review 1x per kelas
    $table->unique(['study_class_id', 'student_id']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
