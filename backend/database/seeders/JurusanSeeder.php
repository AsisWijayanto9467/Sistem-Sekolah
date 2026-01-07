<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("jurusan")->insert([
            [
                "kode_jurusan" => "989217",
                "nama_jurusan" => "RPL",
                "created_at" => now(),
                "updated_at" => now()
            ],[
                "kode_jurusan" => "3746723",
                "nama_jurusan" => "Mesin",
                "created_at" => now(),
                "updated_at" => now()
            ],[
                "kode_jurusan" => "3284672",
                "nama_jurusan" => "Ototronik",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}
