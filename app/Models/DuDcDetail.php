<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuDcDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function duDc()
    {
        return $this->belongsTo(DataUmumDocumentCategory::class, 'du_dc_id');
    }

    public function userPemeriksa()
    {
        return $this->belongsTo(User::class, 'pemeriksa_id', 'id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
