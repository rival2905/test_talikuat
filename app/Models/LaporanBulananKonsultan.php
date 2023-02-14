<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBulananKonsultan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function dataUmum()
    {
        return $this->belongsTo(DataUmum::class, 'data_umum_id', 'id');
    }

    public function detail()
    {
        return $this->hasOne(LaporanBulananKonsultanDetail::class, 'laporan_bulanan_konsultan_id');
    }
}
