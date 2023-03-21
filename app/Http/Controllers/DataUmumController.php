<?php

namespace App\Http\Controllers;

use App\Models\DataUmum;
use App\Models\DataUmumDetail;
use App\Models\DataUmumRuas;
use App\Models\FileDataUmum;
use App\Models\Jadual;
use App\Models\Konsultan;
use App\Models\Kontraktor;
use App\Models\RuasJalan;
use App\Models\Uptd;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DataUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = '';
        if (Auth::user()->userDetail->uptd_id == 0) {
            $data = DataUmum::with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->orderBy('id', 'desc')->get();
        } else {
            $data = DataUmum::with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        }
        return view('data-umum.index', [
            'data_umums' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ruas = '';
        $ppk = '';
        if (Auth::user()->userDetail->uptd_id == 0) {
            $ruas = RuasJalan::all();
            $ppk = UserDetail::where('role', 5)->get();
        } else {
            $ruas = RuasJalan::where('uptd_id', Auth::user()->userDetail->uptd_id)->get();
            $ppk = UserDetail::where([['role', 5], ['uptd_id', Auth::user()->userDetail->uptd_id]])->get();
        }
        return view('data-umum.create', [
            'ruas' => $ruas,
            'kontraktors' => Kontraktor::all(),
            'konsultans' => Konsultan::all(),
            'ppks' => $ppk,
            'uptds' => Uptd::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $get_id = DataUmum::count();
        $get_id = $get_id  == 0 ? 1 : $get_id + 1;
        $uptd = str_replace('UPTD ', '', $request->uptd_id);
        $id = 'PK-' . $uptd . '-' . $request->id_ruas_jalan[0] . '-' . $get_id;
        try {
            DB::beginTransaction();
            DataUmum::create([
                'id' => $id,
                'pemda' => $request->pemda,
                'opd' => $request->opd,
                'nm_paket' => $request->nm_paket,
                'no_kontrak' => $request->no_kontrak,
                'tgl_kontrak' => $request->tgl_kontrak,
                'no_spmk' => $request->no_spmk,
                'tgl_spmk' => $request->tgl_spmk,
                'kategori_paket' => $request->kategori_paket_id,
                'uptd_id' => $uptd,
                'ppk_kegiatan' => $request->ppk_kegiatan,
            ]);
            $detail_id = DataUmumDetail::create([
                'data_umum_id' => $id,
                'nilai_kontrak' => $request->nilai_kontrak,
                'panjang_km' => $request->panjang_km,
                'lama_waktu' => $request->lama_waktu,
                'kontraktor_id' => $request->kontraktor_id,
                'konsultan_id' => $request->konsultan_id,
                'ppk_id' => $request->ppk_user_id,
                'keterangan' => 'Kontrak Awal'
            ])->id;
            for ($i = 0; $i < count($request->id_ruas_jalan); $i++) {
                DataUmumRuas::create([
                    'data_umum_detail_id' => $detail_id,
                    'ruas_id' => $request->id_ruas_jalan[$i],
                    'segment_jalan' => $request->segmen_jalan[$i],
                    'lat_awal' => $request->lat_awal[$i],
                    'long_awal' => $request->long_awal[$i],
                    'lat_akhir' => $request->lat_akhir[$i],
                    'long_akhir' => $request->long_akhir[$i],
                ]);
            }

            DB::commit();
            return redirect()->route('upload.dataumum', $id)->with('success', 'Data berhasil ditambahkan silahkan upload file');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->route('data-umum.index')->with('error', 'Data gagal ditambahkan');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ruas = '';
        $ppk = '';
        if (Auth::user()->userDetail->uptd_id == 0) {
            $ruas = RuasJalan::all();
            $ppk = UserDetail::where('role', 5)->get();
        } else {
            $ruas = RuasJalan::where('uptd_id', Auth::user()->userDetail->uptd_id)->get();
            $ppk = UserDetail::where([['role', 5], ['uptd_id', Auth::user()->userDetail->uptd_id]])->get();
        }
        return view('data-umum.show', [
            'data_umum' => DataUmum::find($id),
            'ruas' => $ruas,
            'kontraktors' => Kontraktor::all(),
            'konsultans' => Konsultan::all(),
            'ppks' => $ppk,
            'uptds' => Uptd::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ruas = '';
        $ppk = '';
        if (Auth::user()->userDetail->uptd_id == 0) {
            $ruas = RuasJalan::all();
            $ppk = UserDetail::where('role', 5)->get();
        } else {
            $ruas = RuasJalan::where('uptd_id', Auth::user()->userDetail->uptd_id)->get();
            $ppk = UserDetail::where([['role', 5], ['uptd_id', Auth::user()->userDetail->uptd_id]])->get();
        }
        return view('data-umum.edit', [
            'data_umum' => DataUmum::find($id),
            'ruas' => $ruas,
            'kontraktors' => Kontraktor::all(),
            'konsultans' => Konsultan::all(),
            'ppks' => $ppk,
            'uptds' => Uptd::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $uptd = str_replace('UPTD ', '', $request->uptd_id);
            DB::beginTransaction();
            DataUmum::where('id', $id)->update([
                'pemda' => $request->pemda,
                'opd' => $request->opd,
                'nm_paket' => $request->nm_paket,
                'no_kontrak' => $request->no_kontrak,
                'tgl_kontrak' => $request->tgl_kontrak,
                'no_spmk' => $request->no_spmk,
                'tgl_spmk' => $request->tgl_spmk,
                'kategori_paket' => $request->kategori_paket_id,
                'uptd_id' => $uptd,
                'ppk_kegiatan' => $request->ppk_kegiatan,
            ]);
            DataUmumRuas::where('data_umum_detail_id', $id)->delete();
            for ($i = 0; $i < count($request->id_ruas_jalan); $i++) {
                DataUmumRuas::create([
                    'data_umum_detail_id' => $id,
                    'ruas_id' => $request->id_ruas_jalan[$i],
                    'segment_jalan' => $request->segmen_jalan[$i],
                    'lat_awal' => $request->lat_awal[$i],
                    'long_awal' => $request->long_awal[$i],
                    'lat_akhir' => $request->lat_akhir[$i],
                    'long_akhir' => $request->long_akhir[$i],
                ]);
            }
            DataUmumDetail::where('data_umum_id', $id)->update([
                'nilai_kontrak' => $request->nilai_kontrak,
                'panjang_km' => $request->panjang_km,
                'lama_waktu' => $request->lama_waktu,
                'kontraktor_id' => $request->kontraktor_id,
                'konsultan_id' => $request->konsultan_id,
                'ppk_id' => $request->ppk_user_id,
                'keterangan' => 'Kontrak Awal'
            ]);
            DB::commit();
            return redirect()->route('data-umum.index')->with('success', 'Data Umum berhasil diubah');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->route('data-umum.index')->with('error', 'Data Umum gagal diubah');
        }
    }

    public function createAdendum(Request $request, $id)
    {
        try {
            $jadual = Jadual::where('data_umum_detail_id', $id);
            if ($jadual == null) {
                return redirect()->route('data-umum.index')->with('error', 'Harap Upload Jadual Kontak Awal Terlebih Dahulu');
            }
            $uptd = str_replace('UPTD ', '', $request->uptd_id);
            DB::beginTransaction();
            DataUmum::where('id', $id)->update([
                'pemda' => $request->pemda,
                'opd' => $request->opd,
                'nm_paket' => $request->nm_paket,
                'no_kontrak' => $request->no_kontrak,
                'tgl_kontrak' => $request->tgl_kontrak,
                'no_spmk' => $request->no_spmk,
                'tgl_spmk' => $request->tgl_spmk,
                'kategori_paket' => $request->kategori_paket_id,
                'uptd_id' => $uptd,
                'ppk_kegiatan' => $request->ppk_kegiatan,
            ]);
            DataUmumRuas::where('data_umum_detail_id', $id)->delete();
            for ($i = 0; $i < count($request->id_ruas_jalan); $i++) {
                DataUmumRuas::create([
                    'data_umum_detail_id' => $id,
                    'ruas_id' => $request->id_ruas_jalan[$i],
                    'segment_jalan' => $request->segmen_jalan[$i],
                    'lat_awal' => $request->lat_awal[$i],
                    'long_awal' => $request->long_awal[$i],
                    'lat_akhir' => $request->lat_akhir[$i],
                    'long_akhir' => $request->long_akhir[$i],
                ]);
            }
            $data = DataUmumDetail::where([['data_umum_id', $id], ['is_active', 1]]);
            $data->update([
                'is_active' => 0
            ]);
            DataUmumDetail::where('data_umum_id', $id)->create([
                'nilai_kontrak' => $request->nilai_kontrak,
                'panjang_km' => $request->panjang_km,
                'lama_waktu' => $request->lama_waktu,
                'kontraktor_id' => $request->kontraktor_id,
                'konsultan_id' => $request->konsultan_id,
                'ppk_id' => $request->ppk_user_id,
                'keterangan' => 'Adendum',
                'is_active' => 0
            ]);
            DB::commit();
            return redirect()->route('data-umum.index')->with('success', 'Data Umum berhasil diubah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('data-umum.index')->with('error', 'Data Umum gagal diubah');
        }
    }

    public function fileUpload($id)
    {
        $data = DataUmum::find($id);



        $fileDkh = new \stdClass;
        $fileDkh->label = 'Daftar Kuantitas dan Harga (DKH)';
        $fileDkh->name = 'file_dkh';
        $fileDkh->file = $data->fileDkh ? $data->fileDkh : null;


        $fileKontrak = new \stdClass;
        $fileKontrak->label = 'Perjanjian Kontrak';
        $fileKontrak->name = 'file_kontrak';
        $fileKontrak->file = $data->fileKontrak ? $data->fileKontrak : null;

        $fileSPMK = new \stdClass;
        $fileSPMK->label = 'SPMK';
        $fileSPMK->name = 'file_spmk';
        $fileSPMK->file = $data->fileSPMK ? $data->fileSPMK : null;

        $fileUmum = new \stdClass;
        $fileUmum->label = 'Syarat Umum';
        $fileUmum->name = 'file_umum';
        $fileUmum->file = $data->fileUmum ? $data->fileUmum : null;

        $fileSyaratKhusus = new \stdClass;
        $fileSyaratKhusus->label = 'Syarat Khusus';
        $fileSyaratKhusus->name = 'file_syarat_khusus';
        $fileSyaratKhusus->file = $data->fileSyaratKhusus ? $data->fileSyaratKhusus : null;

        $fileJadual = new \stdClass;
        $fileJadual->label = 'Jadual Pelaksanaan Pekerjaan';
        $fileJadual->name = 'file_jadual';
        $fileJadual->file = $data->fileJadual ? $data->fileJadual : null;

        $fileGambarRencana = new \stdClass;
        $fileGambarRencana->label = 'Gambar Rencana';
        $fileGambarRencana->name = 'file_gambar_rencana';
        $fileGambarRencana->file = $data->fileGambarRencana ? $data->fileGambarRencana : null;

        $fileSPPBJ = new \stdClass;
        $fileSPPBJ->label = 'SPPBJ';
        $fileSPPBJ->name = 'file_sppbj';
        $fileSPPBJ->file = $data->fileSPPBJ ? $data->fileSPPBJ : null;

        $fileSPL = new \stdClass;
        $fileSPL->label = 'SPL';
        $fileSPL->name = 'file_spl';
        $fileSPL->file = $data->fileSPL ? $data->fileSPL : null;

        $fileSpeckUmum = new \stdClass;
        $fileSpeckUmum->label = 'Spesifikasi Umum';
        $fileSpeckUmum->name = 'file_speck_umum';
        $fileSpeckUmum->file = $data->fileSpeckUmum ? $data->fileSpeckUmum : null;

        $fileJaminan = new \stdClass;
        $fileJaminan->label = 'Jaminan - Jaminan';
        $fileJaminan->name = 'file_jaminan';
        $fileJaminan->file = $data->fileJaminan ? $data->fileJaminan : null;

        $fileBAPL = new \stdClass;
        $fileBAPL->label = 'BAPL';
        $fileBAPL->name = 'file_bapl';
        $fileBAPL->file = $data->fileBAPL ? $data->fileBAPL : null;

        $fileInit = [$fileDkh, $fileKontrak, $fileSPMK, $fileUmum, $fileSyaratKhusus, $fileJadual, $fileGambarRencana, $fileSPPBJ, $fileSPL, $fileSpeckUmum, $fileJaminan, $fileBAPL];

        return view('data-umum.file-upload')->with(
            [
                'data' => $data,
                'file_init' => $fileInit
            ]
        );
    }

    public function store_file(Request $request, $id)
    {
        try {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            Storage::putFileAs('public/data_umum/' . $id, $file, $file_name);
            FileDataUmum::create([
                'data_umum_id' => $id,
                'file_label' => $request->file_name,
                'file_name' => $file_name
            ]);

            return response()->json(['success' => true, 'message' => 'File Berhasil di Upload']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function show_file($id, $file_name)
    {
        $file = storage_path('app/public/data_umum/' . $id . '/' . $file_name);
        return response()->file($file);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
