<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GajiKaryawan extends Model
{
    protected $table = "gaji_karyawan";

    protected $fillable = [
        "guru_id",
        "bulan",
        "tahun",
        "pengabdian",
        "jumlah_jam_bekerja",
        "jabatan_struktural",
        "piket",
        "karyawan_tetap",
        "tunjangan_keluarga",
        "setoran_koperasi",
        "pinjaman_koperasi",
        "arisan",
        "dana_sosial",
        "total_gaji"
    ];
}
