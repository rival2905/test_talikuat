<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMingguanKonsultanDetail extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function laporanMingguanKonsultan()
    {
        return $this->belongsTo(LaporanMingguanKonsultan::class, 'laporan_mingguan_konsultan_id', 'id');
    }
}
