<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiSpp extends Model
{
    protected $table = "transaksi_spp";

    protected $fillable = [
        "siswa_id",
        "kode_transaksi",
        "tanggal_bayar",
        "jumlah_bulan",
        "total_bayar"
    ];

    protected $casts = [
        "tanggal_bayar" => "datetime"
    ];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function detail() {
        return $this->hasMany(TransaksiSppDetail::class);
    }
}
