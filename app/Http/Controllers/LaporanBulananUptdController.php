<?php

namespace App\Http\Controllers;

use App\Models\DataUmum;
use App\Models\LaporanBulananUptd;
use App\Models\LaporanBulananUptdDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanBulananUptdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUmum = '';
        if (Auth::user()->userDetail->uptd_id == 0) {
            $dataUmum = DataUmum::where('thn', date('Y'))->with('laporanBulananUPTD')->orderBy('id', 'desc')->get();
        } else {
            $dataUmum = DataUmum::where('thn', date('Y'))->with('laporanBulananUPTD')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        }
        return view('laporan-bulanan-uptd.index', [
            'dataUmum' => $dataUmum
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $dataUmum = DataUmum::where('id', $id)->with('laporanBulananUPTD')->first();

        return view('laporan-bulanan-uptd.create', [
            'dataUmum' => $dataUmum,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $file = str_replace('/home/www/talikuat/storage/app/', '', $request->file_path);
        $id = LaporanBulananUptd::create([
            'data_umum_id' => $id,
            'bulan' => $request->bulan,
            'rencana' => $request->rencana,
            'realisasi' => $request->realisasi,
            'deviasi' => $request->deviasi,
            'file_path' => $file,
        ])->id;
        for ($i = 0; $i < count($request->nmp); $i++) {
            LaporanBulananUptdDetail::create([
                'laporan_bulanan_id' => $id,
                'kd_jenis_pekerjaan' => $request->nmp[$i],
                'nmp' => $request->nmp[$i] . ' - ' . $request->uraian[$i],
                'volume' => $request->volume[$i],
            ]);
        }
        return redirect()->route('laporan-bulanan-uptd.index')->with('success', 'Data berhasil disimpan,Laporan Menunggu Persetujuan Kepala UPTD');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaporanBulananUptd  $laporanBulananUptd
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanBulananUptd  $laporanBulananUptd
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('laporan-bulanan-uptd.edit', [
            'data' => LaporanBulananUptd::where('id', $id)->with('detail')->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanBulananUptd  $laporanBulananUptd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = str_replace('/home/www/talikuat/storage/app/', '', $request->file_path);
        $data = LaporanBulananUptd::where('id', $id)->first();
        $data->rencana = $request->rencana;
        $data->realisasi = $request->realisasi;
        $data->deviasi = $request->deviasi;
        $data->file_path = $file;
        $data->bulan = $request->bulan;
        $data->status = 0;
        foreach ($request->nmp as $key => $value) {
            $dataDetail = LaporanBulananUptdDetail::where([['laporan_bulanan_id', $id], ['nmp', $value]])->first();
            $dataDetail->volume = $request->volume[$key];
            $dataDetail->save();
        }

        $data->save();

        return redirect()->route('laporan-bulanan-uptd.index')->with('success', 'Data berhasil disimpan');
    }

    public function approval(Request $request)
    {
        $data = LaporanBulananUptd::where('id', $request->id)->first();
        if ($request->status == 2) {
            $data->status = $request->status;
            $data->keterangan = $request->keterangan;
            $data->save();
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            $data->status = $request->status;
            $data->save();
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanBulananUptd  $laporanBulananUptd
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanBulananUptd $laporanBulananUptd)
    {
        //
    }
}
