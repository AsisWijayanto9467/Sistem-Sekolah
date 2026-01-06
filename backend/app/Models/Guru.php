<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table  = 'guru';

    public function user() {
        return $this->hasOne(User::class);
    }

    public function kelasWali() {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }

    public function mataPelajaran() {
        return $this->hasMany(MataPelajaran::class);
    }

    public function gajiGuru() {
        return $this->hasMany(GajiGuru::class);
    }
}
