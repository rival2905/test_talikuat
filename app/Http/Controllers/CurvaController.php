<?php

namespace App\Http\Controllers;

use App\Models\DataUmum;
use App\Models\JadualDetail;
use Illuminate\Http\Request;

class CurvaController extends Controller
{

    public function index($id)
    {
        $data = DataUmum::where('id', $id)->with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->first();
        $jadualId = [];
        $tgl_spmk = $data->tgl_spmk;
        $end_date = date('Y-m-d', strtotime($tgl_spmk . ' + ' . $data->detailWithJadual->lama_waktu . ' days'));
        $today = date('Y-m-d');
        $jml_minggu = is_float($data->detailWithJadual->lama_waktu / 7) ? floor($data->detailWithJadual->lama_waktu / 7) + 1 : floor($data->detailWithJadual->lama_waktu / 7);
        $sortedDate = $this->sortDateAsWeek($tgl_spmk, $jml_minggu, $end_date);
        $rencana = [];
        $realisasi = [];
        foreach ($data->laporanUptdAproved as $k => $value) {
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
        foreach ($data->detailWithJadual->jadualDetail as $key => $value) {
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
        $newdata->data = DataUmum::where('id', $id)->with('uptd', 'detail')->first();
        $newdata->rencana = $rencana;
        $newdata->realisasi = $realisasi;
        $newdata->tanggal = $sortedDate;

        return view('curva.index', [
            'data' => $newdata
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
