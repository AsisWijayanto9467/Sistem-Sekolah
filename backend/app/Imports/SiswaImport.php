<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    public array $nisList = [];

    public function model(array $row) {
        return DB::transaction(function () use ($row) {
            $this->nisList[] = $row['nis'];

            $siswa = Siswa::create([
                "nis" => (string) $row['nis'],
                "nama_lengkap" => (string) $row['nama_lengkap'],
                "tempat_lahir" => $row['tempat_lahir'],
                "tanggal_lahir" => $row['tanggal_lahir'],
                "jenis_kelamin" => $row['jenis_kelamin'],
                "jurusan_id" => $row['jurusan_id'],
                "kelas_id" => $row['kelas_id'],
                "nama_orang_tua" => $row['nama_orang_tua'],
                "alamat" => $row['alamat'],
            ]);

            User::create([
                "siswa_id" => $siswa->id,
                "guru_id" => null,
                "username" => $row['username'],              
                "password" => Hash::make($row['password']),  
                "status" => "siswa"
            ]);

            return $siswa;
        });
    }

    public function rules(): array {
        return [
            "*.nis" => "required|max:30|unique:siswa,nis",
            "*.nama_lengkap" => "required|string|unique:siswa,nama_lengkap",
            "*.tempat_lahir" => "required|string",
            "*.tanggal_lahir" => "required",
            "*.jenis_kelamin" => "required|in:laki-laki, perempuan",
            "*.jurusan_id" => "nullable|exists:jurusan,id",
            "*.kelas_id" => "nullable|exists:kelas,id",
            "*.nama_orang_tua" => "required|string",
            "*.alamat" => "required",
            "*.username" => "required|unique:users,username",
            "*.password" => "required"
        ];
    }
}
