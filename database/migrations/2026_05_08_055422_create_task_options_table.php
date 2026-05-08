<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_question_id')->constrained()->cascadeOnDelete();
            $table->string('label')->nullable(); // A, B, C, D
            $table->string('value'); // Teks jawaban
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_options');
    }
};
