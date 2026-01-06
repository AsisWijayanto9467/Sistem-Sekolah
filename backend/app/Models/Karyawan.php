<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = "karyawan";

    protected $fillable = [
        "nip",
        "nama_karyawan",
        "tanggal_lahir",
        "jenis_kelamin",
        "alamat",
        "foto",
        "honor_per_jam",
        "mulai_tugas"
    ];

    protected $casts = [
        "tanggal_lahir" => "datetime"
    ];
}
