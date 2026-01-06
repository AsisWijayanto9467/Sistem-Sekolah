<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = "penilaian";

    protected $fillable = [
        "mata_pelajaran_id",
        "kelas_id",
        "kategori_nilai_id",
        "siswa_id",
        "nilai"
    ];

    public function mataPelajaran(){
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function kategoriNilai(){
        return $this->belongsTo(KategoriNilai::class, 'kategori_nilai_id');
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
