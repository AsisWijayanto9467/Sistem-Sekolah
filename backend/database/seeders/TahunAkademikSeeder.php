<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("tahun_akademik")->insert([
            [
                "tahun" => "2022/2023",
                "status" => "tidak aktif",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "tahun" => "2023/2024",
                "status" => "tidak aktif",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "tahun" => "2024/2025",
                "status" => "aktif",
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ]);
    }
}
