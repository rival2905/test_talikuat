<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUmumDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function data_umum()
    {
        return $this->belongsTo(DataUmum::class, 'data_umum_id');
    }

    public function ruas()
    {
        return $this->hasMany(DataUmumRuas::class, 'data_umum_detail_id', 'id');
    }

    public function kontraktor()
    {
        return $this->belongsTo(Kontraktor::class, 'kontraktor_id');
    }

    public function konsultan()
    {
        return $this->belongsTo(Konsultan::class, 'konsultan_id');
    }

    public function ppk()
    {
        return $this->belongsTo(UserProfile::class, 'ppk_id', 'user_id');
    }

    public function jadual()
    {
        return $this->hasMany(Jadual::class, 'data_umum_detail_id', 'id');
    }

    public function jadualDetail()
    {
        return $this->hasMany(Jadual::class, 'data_umum_detail_id', 'id')->with('detail');
    }
}
