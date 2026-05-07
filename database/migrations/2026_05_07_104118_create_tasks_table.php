<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_class_id')->constrained()->cascadeOnDelete();
            $table->string('title'); // Contoh: Transformasi Geometri
            $table->text('description')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->string('status')->default('pending'); // pending, submitted, graded
            $table->integer('score')->nullable(); // Nilai tugas
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
