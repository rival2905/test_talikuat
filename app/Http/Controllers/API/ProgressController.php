<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DataUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

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
            $data = DataUmum::with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->get();
        } else {
            $data = DataUmum::with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', $request->uptd)->get();
        }
        foreach ($data as $d) {
            $rencana = 0;
            $days = 0;
            $now = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime($d->tgl_spmk . "+" . $d->detailWithJadual->lama_waktu . " days"));
            $now = new DateTime($now);
            $end = new DateTime($end_date);
            $interval = $end->diff($now);
            $days = $interval->days;

            foreach ($d->detailWithJadual->jadualDetail as $jadual) {
                foreach ($jadual->detail as $detail) {
                    if (strtotime($detail->tanggal) <= strtotime(date('Y-m-d'))) {
                        $rencana += floatval($detail->nilai);
                    }
                }
            }
            $d->detailWithJadual->jadualDetail = $rencana;
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
            $data[$key]->laporan_konsultan =  DB::connection('talikuat22')->table('laporan_konsultan')->where('data_umum_id', $value->id)->orderBy('id', 'asc')->get();
            $data[$key]->data_umum_detail = DB::connection('talikuat22')->table('data_umum_detail')->where([['id', $value->id], ['is_active', 1]])->first();
            $data[$key]->data_umum_detail->jadual = DB::connection('talikuat22')->table('jadual')->where('data_umum_detail_id', $data[$key]->data_umum_detail->id)->get();
            if (count($data[$key]->data_umum_detail->jadual) == 0) {
                unset($data[$key]);
            }
        }
        foreach ($data as $item) {
            if (count($item->laporan_konsultan) != 0) {
                $item->laporan_konsultan = $item->laporan_konsultan[count($item->laporan_konsultan) - 1];
                if ($item->laporan_konsultan->realisasi != 100) {
                    $item->laporan_konsultan->realisasi = 100;
                    $item->laporan_konsultan->rencana = 100;
                }
            } else {
                unset($item);
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
