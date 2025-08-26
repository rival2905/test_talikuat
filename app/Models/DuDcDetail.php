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
}
