<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DataUmum;
use App\Models\JadualDetail;
use Carbon\Carbon;
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
        if ($request->year == '2022') {
            return $this->getOldDataPembangunan($request->uptd);
        }

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

    public function getOldDataPembangunan($uptd)
    {
        $response = array();

        if ($uptd == 'all') {
            $listPaket = DB::connection('talikuat22')->table('data_umum')->get();
        } else {
            $listPaket = DB::connection('talikuat22')->table('data_umum')->where('id_uptd', '=', $uptd)->get();
        }

        foreach ($listPaket as $paket) {
            $paket_id = $paket->id;

            // Setup Detail Data Umum
            $detail = DB::connection('talikuat22')
                ->table('data_umum_detail')
                ->where('data_umum_id', '=', $paket_id)
                ->first();

            $jadual = DB::connection('talikuat22')->table('jadual')->where('data_umum_detail_id', '=', $detail->id)->get();

            if (count($jadual) == 0) {
                continue;
            }

            $paket_obj = (object)array();

            $paket->id = "PW-" . $paket->id_uptd . "-" . $paket->id;
            $paket->uptd = DB::connection('temanjabar')->table('master_uptd_dpa')->where('id', '=', $paket->id_uptd)->first();

            unset($detail->jadual);
            $detail->data_umum_id = $paket->id;
            $detail->kontraktor = DB::connection('talikuat22')->table('master_kontraktor')->where('id', '=', $detail->kontraktor_id)->first();
            $detail->konsultan = DB::connection('talikuat22')->table('master_konsultan')->where('id', '=', $detail->konsultan_id)->first();
            $detail->ppk = DB::connection('talikuat22')->table('master_ppk')->where('id', '=', $detail->ppk_id)->first();
            $detail->ruas = DB::connection('talikuat22')->table('data_umum_ruas')->where('data_umum_detail_id', '=', $detail->id)->get();

            $paket->detail = $detail;

            // Setup Rencana
            $list_rencana = array();

            $jumlah_minggu = ceil($detail->lama_waktu / 7);
            $cumulative_nilai_rencana = 0;
            $tanggal = [];
            $start_time = Carbon::createFromFormat("Y-m-d", $paket->tgl_spmk);
            for ($i = 0; $i < $jumlah_minggu; $i++) {
                $end_time = $start_time->copy()->addDays(6);

                $rencana = (object)array();
                $rencana->minggu = $i + 1;
                $rencana->tanggal = $start_time->toDateString() . ' - ' . $end_time->toDateString();
                array_push($tanggal, $start_time->toDateString() . ' - ' . $end_time->toDateString());

                $nilai = DB::connection('talikuat22')->select("SELECT SUM(nilai) AS nilai FROM (SELECT * FROM jadual_detail WHERE jadual_id IN (SELECT id FROM jadual WHERE data_umum_detail_id = " . $detail->id . ")) AS j WHERE tanggal BETWEEN DATE('" . $start_time->toDateString() . "') AND DATE('" . $end_time->toDateString() . "')")[0]->nilai;
                $cumulative_nilai_rencana += $nilai != null ? $nilai : 0;
                $rencana->nilai_this_week = $nilai != null ? $nilai : 0;
                $rencana->nilai = $cumulative_nilai_rencana;

                $detail_rencana = DB::connection('talikuat22')->select("SELECT nmp, uraian, SUM(nilai) AS nilai FROM (SELECT * FROM jadual_detail WHERE jadual_id IN (SELECT id FROM jadual WHERE data_umum_detail_id = " . $detail->id . ")) AS j WHERE tanggal BETWEEN DATE('" . $start_time->toDateString() . "') AND DATE('" . $end_time->toDateString() . "') GROUP BY nmp, uraian");
                $detail_rencana_object = (object)array();
                foreach ($detail_rencana as $item) {
                    $key = $item->nmp . ' - ' . $item->uraian;
                    $detail_rencana_object->$key = $item->nilai;
                }
                $rencana->detail = $detail_rencana_object;

                array_push($list_rencana, $rencana);

                $start_time = $end_time->copy()->addDay();
            }

            // Setup Realisasi
            $list_realisasi = DB::connection('talikuat22')->table('laporan_konsultan')->where('data_umum_id', '=', $detail->id)->get();
            if (count($list_realisasi) >= $jumlah_minggu) {
                $list_realisasi = $list_realisasi->slice(0, $jumlah_minggu);
                if ($list_realisasi[$jumlah_minggu - 1]->realisasi < 100) {
                    $list_realisasi[$jumlah_minggu - 1]->realisasi = 100;
                }
            } else {
                $selisih_minggu = $jumlah_minggu - count($list_realisasi);
                $selisih_realisasi = 100 - floatval($list_realisasi->last() != null ? $list_realisasi->last()->realisasi : 0);
                $markup_realisasi_per_minggu = $selisih_realisasi / $selisih_minggu;

                $start_time = Carbon::createFromFormat("Y-m-d", $paket->tgl_spmk)->addDays(7 * count($list_realisasi));
                for ($i = 0; $i < $selisih_minggu; $i++) {
                    $end_time = $start_time->copy()->addDays(6);

                    $realisasi_obj = (object)array();
                    $realisasi_obj->priode = count($list_realisasi) + 1 . ' / ' . $jumlah_minggu . ' Tanggal ' . $start_time->format("d-m-Y") . ' s/d ' . $end_time->format("d-m-Y");
                    $realisasi_obj->realisasi = floatval($list_realisasi->last() != null ? $list_realisasi->last()->realisasi : 0) + $markup_realisasi_per_minggu;

                    $list_realisasi->push($realisasi_obj);

                    $start_time = $end_time->copy()->addDay();
                }
            }

            $final_list_realisasi = [];
            foreach ($list_realisasi as $key => $realisasi) {
                $realisasi_obj = (object)array();
                $realisasi_obj->minggu = $key + 1;
                $realisasi_obj->tanggal = $realisasi->priode;
                $realisasi_obj->nilai = $realisasi->realisasi;

                array_push($final_list_realisasi, $realisasi_obj);
            }

            $paket_obj->data_umum = $paket;
            $paket_obj->rencana = $list_rencana;
            $paket_obj->realisasi = $final_list_realisasi;
            $paket_obj->tanggal = $tanggal;

            array_push($response, $paket_obj);
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
            $value->laporan_konsultan = DB::connection('talikuat22')->table('laporan_konsultan')->where('data_umum_id', $value->id)->orderBy('id', 'asc')->get();
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

    public function mapsApi(Request $request)
    {
        if ($request->uptd == 'all') {
            $data = DataUmum::with('uptd')->with('detail')->with('laporanKonsultan')->get();
        } else {
            $data = DataUmum::with('uptd')->with('detail')->with('laporanKonsultan')->where('id_uptd', $request->uptd)->get();
        }


        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
