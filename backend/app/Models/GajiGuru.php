<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GajiGuru extends Model
{
    protected $table = "gaji_guru";

    protected $fillable = [
        "guru_id",
        "bulan",
        "tahun",
        "pengabdian",
        "jumlah_jam_mengajar",
        "jabatan_struktural",
        "piket",
        "guru_tetap",
        "wali_kelas",
        "tunjangan_keluarga",
        "setoran_koperasi",
        "pinjaman_koperasi",
        "arisan",
        "dana_sosial",
        "total_gaji"
    ];

    public function guru() {
        return $this->belongsTo(Guru::class);
    }
}
