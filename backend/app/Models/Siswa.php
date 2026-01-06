<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = "siswa";

    protected $fillable = [
        "nis",
        "nama_lengkap",
        "tempat_lahir",
        "tanggal_lahir",
        "jenis_kelamin",
        "jurusan_id",
        "kelas_id",
        "nama_orang_tua",
        "alamat"
    ];

    protected $casts = [
        "tanggal_lahir" => "datetime"
    ];
    

    public function  kelas() {
        return $this->belongsTo(Kelas::class);
    }
    public function  jurusan() {
        return $this->belongsTo(Jurusan::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }

    public function transaksiSpp() {
        return $this->hasMany(TransaksiSpp::class);
    }
}
