<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoLaporanMingguanKonsultan extends Model
{
    use HasFactory;
    protected $table = 'foto_laporan_mingguan_konsultans';

    protected $guarded = [];

    public function laporan()
    {
        return $this->belongsTo(LaporanMingguan::class, 'laporan_mingguan_id');
    }
}
