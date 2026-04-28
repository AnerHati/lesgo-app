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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('ktp_path')->nullable();
            $table->string('ijazah_path')->nullable();
            $table->integer('registration_step')->default(1);
            $table->boolean('is_verified')->default(false);
            $table->string('profile_photo_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'address', 'ktp_path', 'ijazah_path', 'registration_step', 'is_verified', 'profile_photo_path']);
        });
    }
};
