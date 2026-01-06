<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SppTarif extends Model
{
    protected $table = 'spp_tarif';

    protected $fillable = [
        "nominal",
        "berlaku_mulai",
        "berlaku_sampai",
        "aktif"
    ];
}
