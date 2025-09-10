<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUmumDocumentCategory extends Model
{
    use HasFactory;
    protected $table = 'data_umum_document_categories';
    protected $guarded = [];

    // protected $fillable = [
    //     'data_umum_id',
    //     'document_category_id',
    //     'score',
    //     'is_active',
    //     'deskripsi',
    // ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function dataUmum()
    {
        return $this->belongsTo(DataUmum::class, 'data_umum_id', 'id');
    }

    public function documentCategory()
    {
        return $this->belongsTo(DocumentCategory::class, 'document_category_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(DuDcDetail::class, 'du_dc_id', 'id');
    }

    public function userPemeriksa()
    {
        return $this->belongsTo(User::class, 'pemeriksa_id', 'id');
    }
    
}
