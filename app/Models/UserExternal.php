<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExternal extends User
{
    protected $guarded = [];
    protected $connection = 'mysql';
    protected $table = 'user_externals';

    public function kontraktor()
    {
        return $this->belongsTo(Kontraktor::class);
    }

    public function konsultan()
    {
        return $this->belongsTo(Konsultan::class);
    }

    public function uptd()
    {
        return $this->belongsTo(Uptd::class);
    }
}
