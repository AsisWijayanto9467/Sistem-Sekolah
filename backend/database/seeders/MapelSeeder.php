<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("mata_pelajaran")->insert([
            [
                "kode_mapel" => "7821738",
                "nama_mapel" => "Matematika",
                "guru_id" => 1,
                "kkm" => 75,
                "created_at" => now(),
                "updated_at" => now(),
            ],[
                "kode_mapel" => "73246711",
                "nama_mapel" => "Fisika",
                "guru_id" => 2,
                "kkm" => 80,
                "created_at" => now(),
                "updated_at" => now(),
            ],[
                "kode_mapel" => "73612511",
                "nama_mapel" => "Biologi",
                "guru_id" => 3,
                "kkm" => 76,
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ]);
    }
}
