<?php

namespace App\Http\Controllers;

use App\Models\DataUmum;
use App\Models\LaporanMingguan;
use App\Models\LaporanMingguanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class LaporanMingguanController extends Controller
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
            $data = DataUmum::where('thn', date('Y'))->with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->orderBy('id', 'desc')->get();
        } elseif (Auth::user()->userDetail->role == 5) {
            $data = DataUmum::where('thn', date('Y'))->with('uptd')->whereHas('detailWithJadual', function ($query) {
                $query->where('ppk_id', Auth::user()->userDetail->user_id);
            })->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        } else {
            $data = DataUmum::where('thn', date('Y'))->with('uptd')->whereHas('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        }
        return view('laporan-mingguan-uptd.index', [
            'dataUmum' => $data
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
        $count =  $dataUmum->laporanUptd->count() + 1;
        $totalMinggu = $dataUmum->detail->lama_waktu / 7;
        $totalMinggu = (int)ceil($totalMinggu);
        $tgl = $count == 1 ? $dataUmum->tgl_spmk : $dataUmum->laporanUptd->sortByDesc('id')->first()->tgl_end;
        $getTgl = $this->getTgl($tgl, $count);
        $count = $count . " / " . $totalMinggu . ' Tanggal ' . $getTgl[0] . ' s/d ' . $getTgl[1];
        $rencana = 0;
        $tex = [];
        foreach ($dataUmum->detailWithJadual->jadualDetail as $jadual) {
            foreach ($jadual->detail as $detail) {
                if (strtotime($detail->tanggal) <= strtotime($getTgl[1]) && strtotime($detail->tanggal) >= strtotime($getTgl[0])) {
                    array_push($tex, $detail->nilai);
                    $rencana += floatval($detail->nilai);
                }
            }
        }
        dd($tex);

        $dataUmum->detailWithJadual->jadualDetail = number_format($rencana, 3, '.', '.');

        return view('laporan-mingguan-uptd.create', [
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
        $id = LaporanMingguan::create([
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
            LaporanMingguanDetail::create([
                'laporan_mingguan_id' => $id,
                'kd_jenis_pekerjaan' => $request->nmp[$i],
                'nmp' => $request->nmp[$i] . ' - ' . $request->uraian[$i],
                'volume' => $request->volume[$i],
            ]);
        }

        return redirect()->route('laporan-mingguan-uptd.index')->with('success', 'Data berhasil disimpan,Laporan Menunggu Persetujuan Kepala UPTD');
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

        return view('laporan-mingguan-uptd.edit', [
            'data' => LaporanMingguan::where('id', $id)->with('detail')->first()
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
        $file = str_replace('/home/www/talikuat/storage/app/', '', $request->file_path);
        $data = LaporanMingguan::where('id', $id)->first();
        $data->rencana = $request->rencana;
        $data->realisasi = $request->realisasi;
        $data->deviasi = $request->deviasi;
        $data->file_path = $file;
        $data->status = 0;
        foreach ($request->nmp as $key => $value) {
            $dataDetail = LaporanMingguanDetail::where([['laporan_mingguan_id', $id], ['nmp', $value]])->first();
            $dataDetail->volume = $request->volume[$key];
            $dataDetail->save();
        }

        $data->save();

        return redirect()->route('laporan-mingguan-uptd.index')->with('success', 'Data berhasil disimpan');
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

    public function approval(Request $request)
    {
        $data = LaporanMingguan::where('id', $request->id)->first();
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

    public function downloadTemplate($dataUmum)
    {
        return response()->download(storage_path('app/public/template/Laporan Mingguan.xlsx'), 'Laporan_Mingguan_' . $dataUmum . '.xlsx');
    }
}
