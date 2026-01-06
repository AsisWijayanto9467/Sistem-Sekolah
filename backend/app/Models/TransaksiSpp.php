<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiSpp extends Model
{
    protected $table = "transaksi_spp";

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function detail() {
        return $this->hasMany(TransaksiSppDetail::class);
    }
}
