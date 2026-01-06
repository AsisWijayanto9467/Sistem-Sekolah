<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JamMengajar extends Model
{
    protected $table = "jam_mengajar";

    protected $fillable = [
        "guru_id",
        "jumlah_jam",
    ];
}
