<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uptd extends Model
{
    use HasFactory;
    protected $connection = 'temanjabar';
    protected $table = 'master_uptd_dpa';
    protected $guarded = [];


    public function user()
    {
        return $this->hasMany(UserDetail::class, 'uptd_id', 'id');
    }

    public function data_umum()
    {
        return $this->hasMany(DataUmum::class, 'uptd_id', 'id');
    }
}
