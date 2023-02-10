<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DataUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{

    public function getDataPembangunan()
    {
        $data = DataUmum::with('uptd')->with('detail')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->get();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
    public function getDataPembangunanbyUptd(Request $request)
    {
        if ($request->uptd == 'all') {
            $data = DataUmum::with('uptd')->with('detail')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->get();
        } else {
            $data = DataUmum::with('uptd')->with('detail')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', $request->uptd)->get();
        }
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getDataPembangunan2022()
    {
        $data =   DB::connection('talikuat22')->table('data_umum')->get();

        foreach ($data as $key => $value) {
            $data[$key]->laporan_konsultan =  DB::connection('talikuat22')->table('laporan_konsultan')->where('data_umum_id', $value->id)->get();
        }


        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
