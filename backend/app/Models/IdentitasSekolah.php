<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentitasSekolah extends Model
{
    protected $table = "identitas_sekolah";

    protected $fillable = [
        "npsn",
        "nama_sekolah",
        "alamat_sekolah",
        "kabupaten",
        "kecamatan",
        "desa",
        "kodepos",
        "status",
        "nomor_telpon",
        "honor_transport",
        "nama_kepala_sekolah",
        "nama_bendahara",
        "logo"
    ];
}
