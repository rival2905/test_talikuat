<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuasJalan extends Model
{
    use HasFactory;
    protected $connection = 'temanjabar';
    protected $table = 'user_master_ruas_jalan';
    protected $guarded = [];
}
