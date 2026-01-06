<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiSppDetail extends Model
{
    protected $table = "transaksi_spp_detail";

    protected $fillable = [
        "transaksi_spp_id",
        "siswa_id",
        "bulan",
        "tahun",
        "nominal_spp"
    ];

    public function transaksi() {
        return $this->belongsTo(TransaksiSpp::class);
    }

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }
}
