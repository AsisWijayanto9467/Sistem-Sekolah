<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "kelas";


    public function WaliKelas() {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }

    public function siswa() {
        return $this->hasMany(Siswa::class);
    }
}
