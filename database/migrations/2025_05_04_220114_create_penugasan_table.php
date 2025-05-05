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
        Schema::create('penugasan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('materi_id')->constrained()->onDelete('cascade');
            $table->string('file')->nullable();
            $table->string('status')->default('belum dikumpulkan');
            $table->string('nilai')->nullable();
            $table->timestamps();
        });

        Schema::table('materis', function (Blueprint $table) {
            $table->timestamp('batas_waktu')->nullable();
            $table->boolean('is_penugasan')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->string('file_type')->nullable();
            $table->string('file_size')->nullable();
        });

        Schema::table('latihan_soals', function (Blueprint $table) {
            $table->boolean('is_archived')->default(false);
        });

        Schema::table('diskusis', function (Blueprint $table) {
            $table->boolean('is_archived')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penugasan');
    }
};
