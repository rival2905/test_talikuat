<?php

namespace App\Http\Controllers;

use App\Models\DataUmum;
use App\Models\LaporanBulananKonsultan;
use App\Models\LaporanBulananKonsultanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanBulananKonsultanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUmum = '';
        if (Auth::guard('external')->check()) {
            $user = Auth::guard('external')->user();
        } else {
            $user = Auth::user()->userDetail;
        }
        if ($user->uptd_id == 0) {
            $dataUmum = DataUmum::where('thn', date('Y'))->with('laporanBulananKonsultan')->orderBy('id', 'desc')->get();
        } else {
            $dataUmum = DataUmum::where('thn', date('Y'))->with('laporanBulananKonsultan')->where('uptd_id', $user->uptd_id)->orderBy('id', 'desc')->get();
        }
        return view('laporan-bulanan-konsultan.index', [
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
        $dataUmum = DataUmum::where('id', $id)->with('laporanBulananKonsultan')->first();

        return view('laporan-bulanan-konsultan.create', [
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
        $id = LaporanBulananKonsultan::create([
            'data_umum_id' => $id,
            'bulan' => $request->bulan,
            'rencana' => $request->rencana,
            'realisasi' => $request->realisasi,
            'deviasi' => $request->deviasi,
            'file_path' => $file,
        ])->id;
        for ($i = 0; $i < count($request->nmp); $i++) {
            LaporanBulananKonsultanDetail::create([
                'laporan_bulanan_id' => $id,
                'kd_jenis_pekerjaan' => $request->nmp[$i],
                'nmp' => $request->nmp[$i] . ' - ' . $request->uraian[$i],
                'volume' => $request->volume[$i],
            ]);
        }
        return redirect()->route('laporan-bulanan-konsultan.index')->with('success', 'Data berhasil disimpan');
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
        //
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
        //
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
