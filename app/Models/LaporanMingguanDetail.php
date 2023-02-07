<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMingguanDetail extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function laporanMingguan()
    {
        return $this->belongsTo(LaporanMingguan::class, 'laporan_mingguan_id', 'id');
    }
}
