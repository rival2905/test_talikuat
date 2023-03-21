<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExternal extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'user_externals';
    protected $guarded = [];

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
