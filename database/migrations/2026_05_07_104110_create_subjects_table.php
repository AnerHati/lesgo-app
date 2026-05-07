<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: Matematika, Bahasa Jepang
            $table->string('icon')->nullable(); // Contoh: 📐, 🇯🇵
            $table->string('color')->nullable(); // Contoh: #3B82F6
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
