<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $connection = 'temanjabar';
    protected $table = 'user_pegawai';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
