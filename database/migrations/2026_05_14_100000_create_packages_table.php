<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();           // '4x', '8x', '12x'
            $table->string('name');                      // '4x Pertemuan', '8x Pertemuan', '12x Pertemuan'
            $table->unsignedInteger('sessions_count');    // 4, 8, 12
            $table->decimal('discount_percentage', 5, 2)->default(0); // 0, 5, 8.33
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
