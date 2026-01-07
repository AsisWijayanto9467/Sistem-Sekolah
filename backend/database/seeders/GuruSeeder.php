<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {

            $dataGuru = [
                [
                    "nip" => "81238787921737717321",
                    "kode_guru" => "GURU001",
                    "nama_lengkap" => "Wawan Rio",
                    "tempat_lahir" => "Jakarta",
                    "tanggal_lahir" => "1987-01-01",
                    "jenis_kelamin" => "laki-laki",
                    "gelar_depan" => "Drs.",
                    "gelar_belakang" => "M.Pd",
                    "alamat" => "Jakarta Selatan",
                    "honor_per_jam" => 90000,
                    "foto" => "wawan.png",
                    "mulai_tugas" => "2010-07-01",
                    "username" => "wawanrio",
                ],
                [
                    "nip" => "21377872738781781122",
                    "kode_guru" => "GURU002",
                    "nama_lengkap" => "Siti Aminah",
                    "tempat_lahir" => "Bandung",
                    "tanggal_lahir" => "1990-02-02",
                    "jenis_kelamin" => "perempuan",
                    "gelar_depan" => "S.Pd",
                    "gelar_belakang" => null,
                    "alamat" => "Bandung",
                    "honor_per_jam" => 85000,
                    "foto" => "siti.png",
                    "mulai_tugas" => "2012-07-01",
                    "username" => "sitiaminah",
                ],
                [
                    "nip" => "23172166376812637212",
                    "kode_guru" => "GURU003",
                    "nama_lengkap" => "Ahmad Fauzi",
                    "tempat_lahir" => "Surabaya",
                    "tanggal_lahir" => "1995-03-03",
                    "jenis_kelamin" => "laki-laki",
                    "gelar_depan" => null,
                    "gelar_belakang" => "M.Kom",
                    "alamat" => "Surabaya",
                    "honor_per_jam" => 95000,
                    "foto" => "ahmad.png",
                    "mulai_tugas" => "2018-07-01",
                    "username" => "ahmadfauzi",
                ],
            ];

            foreach ($dataGuru as $data) {
                $guru = Guru::create([
                    "nip" => $data["nip"],
                    "kode_guru" => $data["kode_guru"],
                    "nama_lengkap" => $data["nama_lengkap"],
                    "tempat_lahir" => $data["tempat_lahir"],
                    "tanggal_lahir" => $data["tanggal_lahir"],
                    "jenis_kelamin" => $data["jenis_kelamin"],
                    "gelar_depan" => $data["gelar_depan"],
                    "gelar_belakang" => $data["gelar_belakang"],
                    "alamat" => $data["alamat"],
                    "honor_per_jam" => $data["honor_per_jam"],
                    "foto" => $data["foto"],
                    "mulai_tugas" => $data["mulai_tugas"],
                    "created_at" => now(),
                    "updated_at" => now(),
                ]);

                User::create([
                    "guru_id" => $guru->id,
                    "siswa_id" => null,
                    "username" => $data["username"],
                    "password" => Hash::make("654321"),
                    "status" => "guru",
                    "created_at" => now(),
                    "updated_at" => now(),
                ]);
            }

        });
    }
}
