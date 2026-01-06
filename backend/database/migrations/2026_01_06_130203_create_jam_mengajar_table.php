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
        Schema::create('jam_mengajar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('guru')->restrictOnDelete();
            $table->integer('jumlah_jam')->default(0);
            $table->timestamps();
            $table->unique('guru_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jam_mengajar');
    }
};
