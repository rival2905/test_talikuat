<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DataUmum;
use App\Models\JadualDetail;
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
        $response = [];
        foreach ($data as $d) {
            $jadualId = [];
            $tgl_spmk = $d->tgl_spmk;
            $end_date = date('Y-m-d', strtotime($tgl_spmk . ' + ' . $d->detailWithJadual->lama_waktu . ' days'));
            $today = date('Y-m-d');
            $jml_minggu = is_float($d->detailWithJadual->lama_waktu / 7) ? floor($d->detailWithJadual->lama_waktu / 7) + 1 : floor($d->detailWithJadual->lama_waktu / 7);
            $sortedDate = $this->sortDateAsWeek($tgl_spmk, $jml_minggu, $end_date);
            $rencana = [];
            $realisasi = [];
            foreach ($d->laporanUptdAproved as $k => $value) {
                $lapNmp = [];
                $obj = new \stdClass;
                $obj->minggu = $k + 1;
                $obj->tanggal = $value->priode;
                $obj->nilai = $value->realisasi;
                foreach ($value->detail as $key => $p) {
                    if (array_key_exists($p->nmp, $lapNmp)) {
                        $lapNmp[$p->nmp] += floatval($p->volume);
                    } else {
                        $lapNmp[$p->nmp] = floatval($p->volume);
                    }
                }
                $obj->detail = $lapNmp;
                $realisasi[$k] = $obj;
            }
            foreach ($d->detailWithJadual->jadualDetail as $key => $value) {
                $jadualId[] = $value->id;
            }
            for ($i = 0; $i < count($sortedDate); $i++) {
                $sum = 0;
                $detail = [];
                $nmp = [];
                $dataJadual = JadualDetail::whereIn('jadual_id', $jadualId)->whereBetween('tanggal', [$sortedDate[$i], $this->addDayswithdate($sortedDate[$i], 6)])->get();
                foreach ($dataJadual as $value) {
                    if (array_key_exists($value->nmp . ' - ' . $value->uraian, $nmp)) {
                        $nmp[$value->nmp . ' - ' . $value->uraian] += floatval($value->nilai);
                    } else {
                        $nmp[$value->nmp . ' - ' . $value->uraian] = floatval($value->nilai);
                    }
                    $sum += floatval($value->nilai);
                    array_push($detail, $value);
                }

                $obj = new \stdClass;
                $obj->minggu = $i + 1;
                $obj->tanggal = $sortedDate[$i] . ' - ' . $this->addDayswithdate($sortedDate[$i], 6);
                $obj->nilai_this_week = floatval($sum);
                $obj->detail = $nmp;
                $obj->nilai = floatval($sum);
                $rencana[$i] = $obj;
            }

            foreach ($rencana as $key => $ren) {
                if ($key == 0) {

                    $ren->nilai == floatval($ren->nilai_this_week);
                } else {
                    $ren->nilai = floatval($rencana[$key - 1]->nilai) + floatval($ren->nilai_this_week);
                }
            }

            foreach ($sortedDate as $key => $date) {
                $sortedDate[$key] = $date . ' - ' . $this->addDayswithdate($date, 6);
            }

            $newdata = new \stdClass;
            $newdata->data_umum = DataUmum::where('id', $d->id)->with('uptd', 'detail')->first();
            $newdata->rencana = $rencana;
            $newdata->realisasi = $realisasi;
            $newdata->tanggal = $sortedDate;
            array_push($response, $newdata);
        }

        return response()->json([
            'status' => 'success',
            'data' => $response
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

    private function addDayswithdate($date, $days)
    {
        $date = strtotime("+" . $days . " days", strtotime($date));
        return date("Y-m-d", $date);
    }

    private function sortDateAsWeek($start, $week, $end_date)
    {
        $tglWeek = [];
        $start = date_create($start);
        $end = date_create($end_date);
        $interval = date_diff($start, $end);
        $interval = $interval->format('%a');
        $interval = $interval / 7;
        $interval = floor($interval);
        $interval = $interval + 1;
        $tglWeek[] = $start->format('Y-m-d');
        for ($i = 1; $i < $interval; $i++) {
            $start->modify('+7 day');
            $tglWeek[] = $start->format('Y-m-d');
        }


        return $tglWeek;
    }
}
