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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string("nip", 30)->unique();
            $table->string("kode_guru", 20)->unique();
            $table->string("nama_lengkap");
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->enum("jenis_kelamin", ['laki-laki', 'perempuan']);
            $table->string("gelar_depan")->nullable();
            $table->string("gelar_belakang")->nullable();
            $table->text("alamat");
            $table->decimal("honor_per_jam", 12, 2)->default(0);
            $table->string("foto")->nullable();
            $table->date("mulai_tugas");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
