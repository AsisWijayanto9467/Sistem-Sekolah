<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = "siswa";

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
