<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoLaporanMingguanUPTD extends Model
{
    use HasFactory;
    protected $table = 'foto_laporan_mingguan_uptds';
    protected $guarded = [];

    public function laporan()
    {
        return $this->belongsTo(LaporanMingguan::class, 'laporan_mingguan_id');
    }
}
