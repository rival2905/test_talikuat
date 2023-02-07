<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMingguanKonsultan extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function dataUmum()
    {
        return $this->belongsTo(DataUmum::class, 'data_umum_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany(LaporanMingguanKonsultanDetail::class, 'laporan_mingguan_konsultan_id')->where('is_active', 1)->with('kontraktor', 'konsultan', 'ppk', 'ruas');
    }
}
