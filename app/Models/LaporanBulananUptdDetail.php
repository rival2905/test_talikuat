<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBulananUptdDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function laporanBulananUPTD()
    {
        return $this->belongsTo(LaporanBulananUptd::class);
    }
}
