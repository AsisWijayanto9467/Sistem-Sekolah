<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = "mata_pelajaran";


    public function guru() {
        return $this->belongsTo(Guru::class);
    }
}
