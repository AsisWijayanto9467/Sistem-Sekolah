<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table  = 'guru';

    protected $fillable = [
        "nip",
        "kode_guru",
        "nama_lengkap",
        "tempat_lahir",
        "tanggal_lahir",
        "jenis_kelamin",
        "gelar_depan",
        "gelar_belakang",
        "alamat",
        "honor_per_jam",
        "foto",
        "mulai_tugas"
    ];

    protected $casts = [
        "mulai_tugas" => "datetime"
    ];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function kelasWali() {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }

    public function mataPelajaran() {
        return $this->hasMany(MataPelajaran::class);
    }

    public function gajiGuru() {
        return $this->hasMany(GajiGuru::class);
    }
}
