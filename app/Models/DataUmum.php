<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUmum extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'id' => 'string'
    ];
    public function uptd()
    {
        return $this->belongsTo(Uptd::class, 'uptd_id', 'id');
    }
    public function detail()
    {
        return $this->hasOne(DataUmumDetail::class, 'data_umum_id')->where('is_active', 1)->with('kontraktor', 'konsultan', 'ppk', 'ruas');
    }

    public function detailWithJadualAwal()
    {
        return $this->hasOne(DataUmumDetail::class, 'data_umum_id')->where('is_active', 0)->with('jadualDetail');
    }

    public function detailWithJadual()
    {
        return $this->hasOne(DataUmumDetail::class, 'data_umum_id')->where('is_active', 1)->with('kontraktor', 'konsultan', 'ppk', 'ruas', 'jadualDetail');
    }

    public function laporanUptdAproved()
    {
        return $this->hasMany(LaporanMingguan::class, 'data_umum_id')->where('status', 1)->orderBy('id', 'ASC')->with('detail', 'fotoLaporan');
    }

    public function laporanUptd()
    {
        return $this->hasMany(LaporanMingguan::class, 'data_umum_id')->orderBy('id', 'ASC')->with('detail', 'fotoLaporan');
    }

    public function laporanKonsultan()
    {
        return $this->hasMany(LaporanMingguanKonsultan::class, 'data_umum_id')->orderBy('id', 'ASC')->with('detail', 'fotoLaporan');
    }

    public function laporanBulananUPTDAproved()
    {
        return $this->hasMany(LaporanBulananUptd::class, 'data_umum_id')->where('status', 1)->orderBy('id', 'ASC')->with('detail', 'fotoLaporan');
    }

    public function laporanBulananUPTD()
    {
        return $this->hasMany(LaporanBulananUptd::class, 'data_umum_id')->orderBy('id', 'ASC')->with('detail');
    }

    public function laporanBulananKonsultan()
    {
        return $this->hasMany(LaporanBulananKonsultan::class, 'data_umum_id')->orderBy('id', 'ASC')->with('detail');
    }

    public function fileDataUmum()
    {
        return $this->hasMany(FileDataUmum::class, 'data_umum_id')->orderBy('created_at', 'DESC');
    }

    public function fileDkh()
    {
        return $this->fileDataUmum()->where('file_label', 'file_dkh')->orderBy('created_at', 'DESC');
    }

    public function fileKontrak()
    {
        return $this->fileDataUmum()->where('file_label', 'file_kontrak')->orderBy('created_at', 'DESC');
    }

    public function fileSpmk()
    {
        return $this->fileDataUmum()->where('file_label', 'file_spmk')->orderBy('created_at', 'DESC');
    }

    public function fileUmum()
    {
        return $this->fileDataUmum()->where('file_label', 'file_umum')->orderBy('created_at', 'DESC');
    }

    public function fileSyaratUmum()
    {
        return $this->fileDataUmum()->where('file_label', 'file_syarat_umum')->orderBy('created_at', 'DESC');
    }

    public function fileSyaratKhusus()
    {
        return $this->fileDataUmum()->where('file_label', 'file_syarat_khusus')->orderBy('created_at', 'DESC');
    }

    public function fileJadual()
    {
        return $this->fileDataUmum()->where('file_label', 'file_jadual')->orderBy('created_at', 'DESC');
    }

    public function fileGambarRencana()
    {
        return $this->fileDataUmum()->where('file_label', 'file_gambar_rencana')->orderBy('created_at', 'DESC');
    }

    public function fileSppbj()
    {
        return $this->fileDataUmum()->where('file_label', 'file_sppbj')->orderBy('created_at', 'DESC');
    }

    public function fileSpl()
    {
        return $this->fileDataUmum()->where('file_label', 'file_spl')->orderBy('created_at', 'DESC');
    }

    public function fileSpeckUmum()
    {
        return $this->fileDataUmum()->where('file_label', 'file_speck_umum')->orderBy('created_at', 'DESC');
    }

    public function fileJaminan()
    {
        return $this->fileDataUmum()->where('file_label', 'file_jaminan')->orderBy('created_at', 'DESC');
    }

    public function fileBapl()
    {
        return $this->fileDataUmum()->where('file_label', 'file_bapl')->orderBy('created_at', 'DESC');
    }

    public function penilaianPenyedia()
    {
        return $this->hasMany(PenilaianPenyedia::class, 'data_umum_id')->orderBy('periode', 'desc');
    }

    public function duDc()
    {
        return $this->hasMany(\App\Models\DataUmumDocumentCategory::class, 'data_umum_id', 'id');
    }

    public function duDc_details_total_doc()
    {
        return $this->hasManyThrough(
            DuDcDetail::class, // Model tujuan akhir
            DataUmumDocumentCategory::class,        // Model perantara
            'data_umum_id',
            'du_dc_id',
            'id',
            'id'
        )->where('data_umum_document_categories.is_active', 1);
    }
    public function duDc_details_total_pending()
    {
        return $this->hasManyThrough(
            DuDcDetail::class, // Model tujuan akhir
            DataUmumDocumentCategory::class,        // Model perantara
            'data_umum_id',
            'du_dc_id',
            'id',
            'id'
        )->where('du_dc_details.status', 'pending')->where('data_umum_document_categories.is_active', 1);
    }
    public function duDc_details_total_review()
    {
        return $this->hasManyThrough(
            DuDcDetail::class, // Model tujuan akhir
            DataUmumDocumentCategory::class,        // Model perantara
            'data_umum_id',
            'du_dc_id',
            'id',
            'id'
        )->whereIn('du_dc_details.status', ['review', 're-review'])->where('data_umum_document_categories.is_active', 1);
    }
    public function duDc_details_total_revision()
    {
        return $this->hasManyThrough(
            DuDcDetail::class, // Model tujuan akhir
            DataUmumDocumentCategory::class,        // Model perantara
            'data_umum_id',
            'du_dc_id',
            'id',
            'id'
        )->whereIn('du_dc_details.status', ['revision', 'submit revision'])->where('data_umum_document_categories.is_active', 1);
    }
    public function duDc_details_total_complete()
    {
        return $this->hasManyThrough(
            DuDcDetail::class, // Model tujuan akhir
            DataUmumDocumentCategory::class,        // Model perantara
            'data_umum_id',
            'du_dc_id',
            'id',
            'id'
        )->where('du_dc_details.status', 'complete')->where('data_umum_document_categories.is_active', 1);
    }

    /**
     * Relasi ke kategori dokumen.
     */
    public function categories()
    {
        return $this->hasMany(DataUmumDocumentCategory::class, 'data_umum_id')->where('is_active', 1);
    }

    /**
     * Mendapatkan hanya kategori yang "Not Complete"
     * (yaitu yang memiliki setidaknya satu file dengan status revisi).
     */
    public function notCompleteCategories()
    {
        return $this->categories()->whereHas('details', function ($query) {
            $query->whereIn('status', ['revision', 'submit revision']);
        });
    }

    /**
     * Menghitung kategori yang "Complete".
     * Yaitu yang MEMILIKI detail DAN TIDAK MEMILIKI satu pun detail yang statusnya BUKAN 'complete'.
     */
    public function completeCategories()
    {
        return $this->categories()
                    ->has('details') // <-- KONDISI PENTING 1: Pastikan ada detail
                    ->whereDoesntHave('details', function ($query) {
                        // Kondisi 2: Pastikan tidak ada detail yang statusnya BUKAN 'complete'
                        $query->where('status', '!=', 'complete')
                              ->orWhereNull('status'); // Termasuk yang statusnya masih null
                    });
    }

    /**
     * Menghitung kategori yang "Nothing" (kosong).
     * Yaitu yang TIDAK MEMILIKI detail sama sekali.
     */
    public function nothingCategories()
    {
        return $this->categories()->doesntHave('details');
    }
}
