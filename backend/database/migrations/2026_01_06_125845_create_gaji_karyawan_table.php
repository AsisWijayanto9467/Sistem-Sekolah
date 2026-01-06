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
        Schema::create('gaji_karyawan', function (Blueprint $table) {
            $table->id();
            $table->foreignId("karyawan_id")->constrained('karyawan')->restrictOnDelete();
            $table->unsignedTinyInteger('bulan');
            $table->year('tahun');

            // tambahan
            $table->decimal("pengabdian", 12, 2)->default(0);
            $table->decimal("jumlah_jam_bekerja")->default(0);
            $table->decimal("jabatan_struktural", 12, 2)->default(0);
            $table->decimal("piket", 12, 2)->default(0);
            $table->decimal("karyawan_tetap", 12, 2)->default(0);
            $table->decimal("tunjangan_keluarga", 12, 2)->default(0);

            // potongan
            $table->decimal("setoran_koperasi", 12, 2)->default(0);
            $table->decimal("pinjaman_koperasi", 12, 2)->default(0);
            $table->decimal("arisan", 12, 2)->default(0);
            $table->decimal("dana_sosial", 12, 2)->default(0);
            $table->decimal("total_gaji", 12, 2)->default(0);
            $table->unique([
                "karyawan_id",
                'bulan',
                'tahun'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji_karyawan');
    }
};
