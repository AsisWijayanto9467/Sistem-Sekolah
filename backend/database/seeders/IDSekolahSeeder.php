<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IDSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("identitas_sekolah")->insert([
            [
                "npsn" => "27831312",
                "nama_sekolah" => "SMKN 05 Priburu",
                "alamat_sekolah" => "Jawa Tengah",
                "kabupaten" => "Karanganyar",
                "kecamatan" => "Karangpandan",
                "desa" => "Piwulan",
                "kodepos" => "09271",
                "status" => "swasta",
                "nomor_telpon" => "0896547342271",
                "honor_transport" => "900000",
                "nama_kepala_sekolah" => "Burhan Harahap",
                "nama_bendahara" => "Pak Surya",
                "logo" => "logo.png",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}
