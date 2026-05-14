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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('amount');
            $table->string('reason'); // e.g., 'quiz_completed', 'class_finished'
            $table->morphs('source'); // Reference to StudyClass, TaskSubmission, etc.
            $table->timestamps();
        });

        // Add total_points column to users table for quick access
        Schema::table('users', function (Blueprint $table) {
            $table->integer('total_points')->default(0)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('total_points');
        });
        Schema::dropIfExists('points');
    }
};
