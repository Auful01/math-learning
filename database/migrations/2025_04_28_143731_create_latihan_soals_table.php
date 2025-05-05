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
        Schema::create('latihan_soals', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->json('options'); // ["A" => "Pilihan A", "B" => "Pilihan B", ...]
            $table->string('correct_answer'); // A, B, C, D
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihan_soals');
    }
};
