<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaktuMengajar extends Model
{
    protected $table = "waktu_mengajar";

    protected $fillable = [
        "jam_ke",
        "waktu"
    ];
}
