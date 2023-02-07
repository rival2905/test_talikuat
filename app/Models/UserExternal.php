<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExternal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kontraktor()
    {
        return $this->belongsTo(Kontraktor::class);
    }

    public function konsultan()
    {
        return $this->belongsTo(Konsultan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Uptd()
    {
        return $this->belongsTo(Uptd::class);
    }
}
