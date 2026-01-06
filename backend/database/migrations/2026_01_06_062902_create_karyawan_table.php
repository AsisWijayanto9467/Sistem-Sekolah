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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nama_karyawan');
            $table->date("tanggal_lahir");
            $table->enum("jenis_kelamin", ["laki-laki", "perempuan"]);
            $table->text("alamat");
            $table->string('foto')->nullable();
            $table->decimal("honor_per_jam", 12, 2);
            $table->date("mulai_tugas");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
