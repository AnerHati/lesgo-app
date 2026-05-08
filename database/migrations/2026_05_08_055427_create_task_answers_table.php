<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_submission_id')->constrained()->cascadeOnDelete();
            $table->foreignId('task_question_id')->constrained()->cascadeOnDelete();
            $table->foreignId('task_option_id')->nullable()->constrained()->cascadeOnDelete();
            $table->text('essay_answer')->nullable(); // Berjaga-jaga jika ada jawaban essay
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_answers');
    }
};
