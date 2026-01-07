<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("kelas")->insert([
            [
                "kode_kelas" => "271371",
                "nama_kelas" => "XRB",
                "wali_kelas_id" => 1,
                "jumlah_pembayaran" => "150000",
                "created_at" => now(),
                "updated_at" => now(),
            ],[
                "kode_kelas" => "893284",
                "nama_kelas" => "XIOA",
                "wali_kelas_id" => 3,
                "jumlah_pembayaran" => "150000",
                "created_at" => now(),
                "updated_at" => now(),
            ],[
                "kode_kelas" => "834832",
                "nama_kelas" => "XIIMA",
                "wali_kelas_id" => 3,
                "jumlah_pembayaran" => "150000",
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ]);
    }
}
