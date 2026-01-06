<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "username" => "admin123",
                "password" => Hash::make("654321"),
                "status" => "admin",
                "created_at" => now(),
                "updated_at" => now(),
            ], [
                "username" => "admin321",
                "password" => Hash::make("654321"),
                "status" => "admin",
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ]);
    }
}
