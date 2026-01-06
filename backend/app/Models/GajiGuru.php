<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GajiGuru extends Model
{
    protected $table = "gaji_guru";

    public function guru() {
        return $this->belongsTo(Guru::class);
    }
}
