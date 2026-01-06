<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriNilai extends Model
{
    protected $table = "kategori_nilai";

    protected $fillable = [
        "kode_kategori",
        "deskripsi"
    ];
}
