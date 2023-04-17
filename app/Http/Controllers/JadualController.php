<?php

namespace App\Http\Controllers;

use App\Imports\JadualImport;
use App\Models\DataUmum;
use App\Models\DataUmumDetail;
use App\Models\Jadual;
use App\Models\JadualDetail;
use App\Models\JenisPekerjaan;
use App\Models\Konsultan;
use App\Models\Kontraktor;
use App\Models\RuasJalan;
use App\Models\TempFileJadual;
use App\Models\Uptd;
use stdClass;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class JadualController extends Controller
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
        } elseif (Auth::user()->userDetail->role == 5) {
            $data = DataUmum::with('uptd')->whereHas('detailWithJadual', function ($query) {
                $query->where('ppk_id', Auth::user()->userDetail->user_id);
            })->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        } else {
            $data = DataUmum::with('uptd')->whereHas('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        }

        return view('jadual.index', ['data_umum' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ruas = '';
        TempFileJadual::where('data_umum_detail_id', $id)->delete();
        if (Auth::user()->userDetail->uptd_id == 0) {
            $ruas = RuasJalan::all();
        } else {
            $ruas = RuasJalan::where('uptd_id', Auth::user()->userDetail->uptd_id)->get();
        }



        return view('jadual.create', [
            'detail' => DataUmumDetail::find($id),
            'kontraktors' => Kontraktor::all(),
            'konsultans' => Konsultan::all(),
            'ppks' => UserDetail::where([['role', 5], ['uptd_id', Auth::user()->userDetail->uptd_id]])->get(),
            'ruas' => $ruas,
            'uptds ' => Uptd::all(),
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
        try {
            $getFile = TempFileJadual::where('data_umum_detail_id', $id)->first();
            $file = storage_path('app/public/lampiran/jadual/' . $getFile->file_name);
            $list_jadual = Excel::toCollection(new JadualImport, $file);
            $data_umum = DataUmumDetail::where('id', $id)->where('is_active', 1)->first();

            $volume = $this->sumBobot($list_jadual);
            if ($volume < 99 || $volume > 105) {
                return redirect()->back()->with('error', 'Volume tidak sesuai');
            }
            DB::beginTransaction();
            foreach ($list_jadual as $val) {
                $val[0]['tanggal'] = Carbon::createFromTimestamp(Date::excelToTimestamp($val[0]['tanggal']));
                $val[0]['tanggal'] = date('Y-m-d', strtotime($val[0]['tanggal']));

                $jadual =  Jadual::create([
                    'data_umum_detail_id' => $id,
                    'nmp' => $val[0]['no_mata_pembayaran'],
                    'uraian' => $val[0]['uraian'],
                    'satuan' => $val[0]['satuan'],
                    'total_harga' => $val[0]['jumlah_harga_rp'],
                    'bobot' => $val[0]['bobot'],
                    'koefisien' => $val[0]['koefisien'],
                    'total_volume' => number_format($val[0]['volume'], 2, '.', '')
                ]);
                foreach ($val as $item) {
                    if (!is_string($item['tanggal'])) {
                        $item['tanggal'] = Carbon::createFromTimestamp(Date::excelToTimestamp($item['tanggal']));
                        $item['tanggal'] = date('Y-m-d', strtotime($item['tanggal']));
                    }
                    if ($item['no_mata_pembayaran'] != null) {
                        JadualDetail::create([
                            'jadual_id' => $jadual->id,
                            'nmp' => $item['no_mata_pembayaran'],
                            'uraian' => $item['uraian'],
                            'tanggal' => $item['tanggal'],
                            'satuan' => $item['satuan'],
                            'harga_satuan' => $item['harga_satuan_rp'],
                            'bobot' => $item['bobot'],
                            'koefisien' => $item['koefisien'],
                            'nilai' => $item['nilai'],
                            'volume' => $item['volume'],
                        ]);
                    }
                }
            }


            Storage::delete('public/lampiran/jadual/' . $getFile->file_name);
            $getFile->delete();
            DB::commit();
            return redirect()->route('jadual.index')->with('success', 'Jadual berhasil diinput');
        } catch (\Throwable $e) {
            dd($e);
            DB::rollback();
            return back()->with('error', 'Jadual gagal diinput');
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
        TempFileJadual::where('data_umum_detail_id', $id)->delete();
        if (Auth::user()->userDetail->uptd_id == 0) {
            $ruas = RuasJalan::all();
        } else {
            $ruas = RuasJalan::where('uptd_id', Auth::user()->userDetail->uptd_id)->get();
        }
        $data = DataUmumDetail::where('id', $id)->first();
        $data_umum = DataUmum::where('id', $data->data_umum_id)->with('detail')->first();
        $jadualDB = Jadual::where('data_umum_detail_id', $id)->with('detail')->get();
        $jadualDetail = new stdClass();
        $jadualDetail->data_umum = $data_umum;
        $jadualDetail->curva = [];
        foreach ($jadualDB as $val) {
            array_push($jadualDetail->curva, $val->detail);
        }
        $upd_id = Auth::user()->userDetail->uptd_id ?? Auth::user()->uptd_id;
        $ppk = UserDetail::where([['role', 5], ['uptd_id', $upd_id]])->get();
        if ($upd_id == 0) {
            $ppk = UserDetail::where('role', 5)->get();
        }

        return view('jadual.show', [
            'detail' => DataUmumDetail::find($id),
            'kontraktors' => Kontraktor::all(),
            'konsultans' => Konsultan::all(),
            'ppks' => $ppk,
            'ruas' => $ruas,
            'jadualDetail' => $jadualDetail
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
        TempFileJadual::where('data_umum_detail_id', $id)->delete();
        if (Auth::user()->userDetail->uptd_id == 0) {
            $ruas = RuasJalan::all();
        } else {
            $ruas = RuasJalan::where('uptd_id', Auth::user()->userDetail->uptd_id)->get();
        }
        $upd_id = Auth::user()->userDetail->uptd_id ?? Auth::user()->uptd_id;
        $ppk = UserDetail::where([['role', 5], ['uptd_id', $upd_id]])->get();
        if ($upd_id == 0) {
            $ppk = UserDetail::where('role', 5)->get();
        }

        return view('jadual.edit', [
            'detail' => DataUmumDetail::find($id),
            'kontraktors' => Kontraktor::all(),
            'konsultans' => Konsultan::all(),
            'ppks' => $ppk,
            'ruas' => $ruas,
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
            $getFile = TempFileJadual::where('data_umum_detail_id', $id)->first();
            $file = storage_path('app/public/lampiran/jadual/' . $getFile->file_name);
            $list_jadual = Excel::toCollection(new JadualImport, $file);
            $jadual =  Jadual::where('data_umum_detail_id', $id)->get();
            $volume = $this->sumBobot($list_jadual);
            if ($volume < 99 || $volume > 101) {
                return back()->with('error', 'Volume tidak sesuai');
            }


            DB::beginTransaction();
            foreach ($jadual as $val) {
                JadualDetail::where('jadual_id', $val->id)->delete();
            }
            Jadual::where('data_umum_detail_id', $id)->delete();
            foreach ($list_jadual as $val) {
                $val[0]['tanggal'] = Carbon::createFromTimestamp(Date::excelToTimestamp($val[0]['tanggal']));
                $val[0]['tanggal'] = date('Y-m-d', strtotime($val[0]['tanggal']));
                $jadual =  Jadual::create([
                    'data_umum_detail_id' => $id,
                    'nmp' => $val[0]['no_mata_pembayaran'],
                    'uraian' => $val[0]['uraian'],
                    'satuan' => $val[0]['satuan'],
                    'total_harga' => $val[0]['jumlah_harga_rp'],
                    'bobot' => $val[0]['bobot'],
                    'koefisien' => $val[0]['koefisien'],
                    'total_volume' => number_format($val[0]['volume'], 2, '.', '')
                ]);
                foreach ($val as $item) {
                    if (!is_string($item['tanggal'])) {
                        $item['tanggal'] = Carbon::createFromTimestamp(Date::excelToTimestamp($item['tanggal']));
                        $item['tanggal'] = date('Y-m-d', strtotime($item['tanggal']));
                    }
                    if ($item['no_mata_pembayaran'] != null) {
                        JadualDetail::create([
                            'jadual_id' => $jadual->id,
                            'nmp' => $item['no_mata_pembayaran'],
                            'uraian' => $item['uraian'],
                            'tanggal' => $item['tanggal'],
                            'satuan' => $item['satuan'],
                            'harga_satuan' => $item['harga_satuan_rp'],
                            'bobot' => $item['bobot'],
                            'koefisien' => $item['koefisien'],
                            'nilai' => $item['nilai'],
                            'volume' => $item['volume'],
                        ]);
                    }
                }
            }


            Storage::delete('app/public/lampiran/jadual/' . $getFile->file_name);
            $getFile->delete();
            DB::commit();
            return redirect()->route('jadual.index')->with('success', 'Jadual berhasil diupdate');
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', 'Jadual gagal diupdate');
        }
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
    public function excelToData(Request $request)
    {
        try {

            $file = $request->file('jadual_excel_file');
            $list_jadual = Excel::toCollection(new JadualImport, $file);
            $data_umum = DataUmum::where('id', $request->id)->with('detail')->first();
            $name = time() . "_" . $file->getClientOriginalName();
            TempFileJadual::where('data_umum_detail_id', $data_umum->detail->id,)->delete();
            DB::beginTransaction();
            TempFileJadual::create([
                'data_umum_detail_id' => $data_umum->detail->id,
                'file_name' => $name,
            ]);

            Storage::putFileAs('public/lampiran/jadual/', $file, $name);

            foreach ($list_jadual as $items) {
                $master_nmp = JenisPekerjaan::where('kd_jenis_pekerjaan', $items[0]['no_mata_pembayaran'])->first();
                if (!$master_nmp) {
                    return response()->json([
                        'status' => 'error',
                        'code' => '500',
                        'message' => 'Nomor Mata Pembayaran ' . $items[0]['no_mata_pembayaran'] . ' Salah Atau Tidak Terdaftar Pada Talikuat Mohon Hubungi Admin UPTD'
                    ], 500);
                }
            }

            foreach ($list_jadual as $val) {
                foreach ($val as $item) {
                    $item['tanggal'] = Carbon::createFromTimestamp(Date::excelToTimestamp($item['tanggal']));
                    $item['tanggal'] = date('Y-m-d', strtotime($item['tanggal']));
                }
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'code' => '200',
                'data_umum' => $data_umum,
                'curva' => $list_jadual
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                'status' => 'failed',
                'code' => '500',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    private function sumBobot($list)
    {
        $sum = 0;
        foreach ($list as $val) {
            foreach ($val as $item) {
                $sum += $item['nilai'];
            }
        }
        return $sum;
    }

    public function downloadTemplate($data_umum)
    {
        return response()->download(storage_path('app/public/template/jadual_talikuat.xlsx'), $data_umum . '.xlsx');
    }
}
