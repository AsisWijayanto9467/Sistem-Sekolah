<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaUpdateImport implements ToCollection, WithHeadingRow, WithValidation
{
    public array $updatedNis = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            DB::transaction(function () use ($row) {

                $siswa = Siswa::where('nis', $row['nis'])->first();

                if (!$siswa) {
                    return;
                }

                $siswa->update([
                    "nama_lengkap" => (string) $row['nama_lengkap'],
                    "tempat_lahir" => $row['tempat_lahir'],
                    "tanggal_lahir" => $row['tanggal_lahir'],
                    "jenis_kelamin" => $row['jenis_kelamin'],
                    "jurusan_id" => $row['jurusan_id'],
                    "kelas_id" => $row['kelas_id'],
                    "nama_orang_tua" => $row['nama_orang_tua'],
                    "alamat" => $row['alamat'],
                ]);

                User::updateOrCreate(['siswa_id' => $siswa->id],
            [
                        'username' => $row['username'],
                        'password' => Hash::make($row['password']),
                        'status'   => 'siswa'
                    ]
                );

                $this->updatedNis[] = $row['nis'];
            });
        }
    }

    public function rules(): array {
        return [
            "*.nis" => "required|max:30|exists:siswa,nis",
            "*.nama_lengkap" => "required|string",
            "*.tempat_lahir" => "required|string",
            "*.tanggal_lahir" => "required",
            "*.jenis_kelamin" => "required|in:laki-laki, perempuan",
            "*.jurusan_id" => "nullable|exists:jurusan,id",
            "*.kelas_id" => "nullable|exists:kelas,id",
            "*.nama_orang_tua" => "required|string",
            "*.alamat" => "required",
            "*.username" => "required",
            "*.password" => "required"
        ];
    }
}
