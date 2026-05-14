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
        Schema::table('study_classes', function (Blueprint $table) {
            $table->index(['student_id', 'status']);
            $table->index(['tutor_id', 'status']);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->index(['sender_id', 'receiver_id']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->index(['study_class_id', 'status']);
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->index(['study_class_id', 'start_time']);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->index(['study_class_id', 'status']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('study_classes', function (Blueprint $table) {
            $table->dropIndex(['study_classes_student_id_status_index']);
            $table->dropIndex(['study_classes_tutor_id_status_index']);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex(['messages_sender_id_receiver_id_index']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropIndex(['transactions_study_class_id_status_index']);
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->dropIndex(['schedules_study_class_id_start_time_index']);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropIndex(['tasks_study_class_id_status_index']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['users_latitude_longitude_index']);
        });
    }
};
