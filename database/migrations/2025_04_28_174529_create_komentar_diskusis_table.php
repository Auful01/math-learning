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
        Schema::create('komentar_diskusis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diskusi_id')->constrained()->onDelete('cascade'); // komentar untuk diskusi mana
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // siapa yang komen
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar_diskusis');
    }
};
