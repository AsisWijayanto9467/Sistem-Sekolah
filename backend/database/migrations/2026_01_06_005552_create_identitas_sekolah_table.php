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
        Schema::create('identitas_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string("npsn")->unique();
            $table->string('nama_sekolah');
            $table->text("alamat_sekolah");
            $table->string("kabupaten");
            $table->string("kecamatan");
            $table->string("desa");
            $table->string("kodepos", 10);
            $table->enum("status", ['negeri', 'swasta']);
            $table->string("nomor_telpon", 20)->nullable();
            $table->decimal("honor_transport", 12, 2)->default(0);
            $table->string("nama_kepala_sekolah");
            $table->string('nama_bendahara');
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas_sekolah');
    }
};
