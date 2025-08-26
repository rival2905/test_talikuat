<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function duDc()
    {
        return $this->hasMany(\App\Models\DataUmumDocumentCategory::class, 'document_category_id');
    }
}
