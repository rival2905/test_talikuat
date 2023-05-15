<?php

namespace App\Http\Controllers;

use App\Models\DataUmum;
use App\Models\LaporanMingguanKonsultan;
use App\Models\LaporanMingguanKonsultanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class LaporanKonsultan extends Controller
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
            $dataUmum = DataUmum::where('thn', date('Y'))->with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->orderBy('id', 'desc')->get();
        } else {
            $dataUmum = DataUmum::where('thn', date('Y'))->with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        }
        return view('laporan-mingguan-konsultan.index', [
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
        $dataUmum = DataUmum::where('id', $id)->with('detail', 'laporanUptd', 'detailWithJadual')->first();
        $count = $dataUmum->laporanUptd->count() + 1;
        $totalMinggu = $dataUmum->detail->lama_waktu / 7;
        $totalMinggu = (int)ceil($totalMinggu);
        $tgl = $count == 1 ? $dataUmum->tgl_spmk : $dataUmum->laporanUptd->last()->tgl_end;
        $getTgl = $this->getTgl($tgl, $count);
        $count = $count . " / " . $totalMinggu . ' Tanggal ' . $getTgl[0] . ' s/d ' . $getTgl[1];
        $rencana = 0;
        $days = 0;
        $now = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime($dataUmum->tgl_spmk . "+" . $dataUmum->detailWithJadual->lama_waktu . " days"));
        $now = new DateTime($now);
        $end = new DateTime($end_date);
        $interval = $end->diff($now);
        $days = $interval->days;

        foreach ($dataUmum->detailWithJadual->jadualDetail as $jadual) {
            foreach ($jadual->detail as $detail) {
                if (strtotime($detail->tanggal) <= strtotime($getTgl[1])) {
                    $rencana += floatval($detail->nilai);
                }
            }
        }
        $dataUmum->detailWithJadual->jadualDetail = number_format($rencana, 2, '.', '.');
        return view('laporan-mingguan-konsultan.create', [
            'dataUmum' => $dataUmum,
            'count' => $count,
            'getTgl' => $getTgl
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
        $id = LaporanMingguanKonsultan::create([
            'data_umum_id' => $id,
            'tgl_start' => $request->tgl_start,
            'tgl_end' => $request->tgl_end,
            'priode' => $request->priode,
            'rencana' => $request->rencana,
            'realisasi' => $request->realisasi,
            'deviasi' => $request->deviasi,
            'file_path' => $file,
        ])->id;
        for ($i = 0; $i < count($request->nmp); $i++) {
            LaporanMingguanKonsultanDetail::create([
                'laporan_mingguan_id' => $id,
                'kd_jenis_pekerjaan' => $request->nmp[$i],
                'nmp' => $request->nmp[$i] . ' - ' . $request->uraian[$i],
                'volume' => $request->volume[$i],
            ]);
        }

        return redirect()->route('laporan-mingguan-konsultan.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    public function showFile($path)
    {

        $file = storage_path('app/public/lampiran/laporan_konsultan/' . $path);

        return response()->file($file);
    }

    private  function getTgl($tgl, $minggu)
    {
        if ($minggu == 1) {
            $tglStart = strtotime($tgl);
        } else {
            $tglStart = strtotime($tgl);
            $tglStart = strtotime("+1 day", $tglStart);
        }

        $tglEnd = strtotime("+6 day", $tglStart);
        $tglEnd = date('d-m-Y', $tglEnd);
        $tglStart = date('d-m-Y', $tglStart);
        return [$tglStart, $tglEnd];
    }
}
