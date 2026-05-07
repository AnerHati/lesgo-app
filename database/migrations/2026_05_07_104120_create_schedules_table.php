<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_class_id')->constrained()->cascadeOnDelete();
            $table->dateTime('start_time'); // Kapan dimulai (hari & jam)
            $table->dateTime('end_time'); // Kapan selesai
            $table->string('status')->default('scheduled'); // scheduled, ongoing, completed, cancelled
            $table->string('meeting_link')->nullable(); // Link Google Meet / Zoom
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
