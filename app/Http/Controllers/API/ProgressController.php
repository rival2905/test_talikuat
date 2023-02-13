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
            $realisasi = 0;
            $days = 0;
            $now = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime($d->tgl_spmk . "+" . $d->detailWithJadual->lama_waktu . " days"));
            $now = new DateTime($now);
            $end = new DateTime($end_date);
            $interval = $end->diff($now);
            $days = $d->detailWithJadual->lama_waktu - $interval->days;
            if ($days < 0) {
                $days = 0;
            }
            foreach ($d->detailWithJadual->jadualDetail as $jadual) {
                foreach ($jadual->detail as $detail) {
                    if (strtotime($detail->tanggal) <= strtotime(date('Y-m-d'))) {
                        $rencana += floatval($detail->nilai);
                    }
                }
            }
            foreach ($d->laporanUptdAproved as $laporan) {
                $realisasi += floatval($laporan->realisasi);
            }
            $d["days"] = $days;
            $d['realisasi'] =  number_format($realisasi, 2, '.', '.');
            $d['rencana'] = number_format($rencana, 2, '.', '.');
            $d['deviasi'] = number_format($rencana - $realisasi, 2, '.', '.');
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getDataPembangunan2022()
    {
        $data = DB::connection('talikuat22')->table('data_umum')->get();
        foreach ($data as $key => $value) {
            $value->laporan_konsultan =  DB::connection('talikuat22')->table('laporan_konsultan')->where('data_umum_id', $value->id)->orderBy('id', 'asc')->get();
            $value->data_umum_detail = DB::connection('talikuat22')->table('data_umum_detail')->where([['id', $value->id], ['is_active', 1]])->first();
            $value->data_umum_detail->jadual = DB::connection('talikuat22')->table('jadual')->where('data_umum_detail_id', $value->data_umum_detail->id)->get();
            if (count($value->data_umum_detail->jadual) == 0) {
                unset($value);
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
