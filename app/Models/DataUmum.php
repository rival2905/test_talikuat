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
        return $this->hasMany(LaporanMingguan::class, 'data_umum_id')->where('status', 1)->orderBy('id', 'ASC')->with('detail');
    }

    public function laporanUptd()
    {
        return $this->hasMany(LaporanMingguan::class, 'data_umum_id')->orderBy('id', 'ASC')->with('detail');
    }

    public function laporanKonsultan()
    {
        return $this->hasMany(LaporanMingguanKonsultan::class, 'data_umum_id')->orderBy('id', 'ASC')->with('detail');
    }

    public function laporanBulananUPTDAproved()
    {
        return $this->hasMany(LaporanBulananUptd::class, 'data_umum_id')->where('status', 1)->orderBy('id', 'ASC')->with('detail');
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
}
