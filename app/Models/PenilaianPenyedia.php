<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPenyedia extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function dataUmum()
    {
        return $this->belongsTo(DataUmum::class, 'data_umum_id');
    }

    public function kontraktor()
    {
        return $this->belongsTo(Kontraktor::class, 'kontraktor_id');
    }
}
