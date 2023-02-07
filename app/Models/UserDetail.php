<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    // role :
    // 1 super admin
    // 2 admin
    // 3 ppk
    // 4 konsultan
    // 5 kontraktor
    use HasFactory;
    protected $connection = 'mysql';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function uptd()
    {
        return $this->belongsTo(Uptd::class, 'uptd_id', 'id');
    }
}
