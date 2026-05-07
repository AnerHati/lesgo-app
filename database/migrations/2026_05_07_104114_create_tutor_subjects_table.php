<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutor_subjects', function (Blueprint $table) {
            $table->id();
            // user_id difilter nantinya hanya untuk user dengan role tutor
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->integer('price_per_hour')->default(0); // Tarif per jam
            $table->timestamps();
            
            // Mencegah duplikasi: 1 tutor tidak boleh menambahkan pelajaran yang sama 2x
            $table->unique(['user_id', 'subject_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutor_subjects');
    }
};
