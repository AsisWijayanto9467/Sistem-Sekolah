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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string("nis", 30)->unique();
            $table->string("nama_lengkap");
            $table->string("tempat_lahir");
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ["laki-laki","perempuan"]);
            $table->foreignId("jurusan_id")->constrained("jurusan")->restrictOnDelete();
            $table->foreignId("kelas_id")->constrained("kelas")->restrictOnDelete();
            $table->string("nama_orang_tua");
            $table->text("alamat");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
