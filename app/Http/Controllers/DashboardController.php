<?php

namespace App\Http\Controllers;

use App\Models\DataUmum;
use App\Models\Konsultan;
use App\Models\Kontraktor;
use App\Models\Uptd;
use App\Models\UserDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = '';
        if (Auth::user()->userDetail->uptd_id == 0) {

            $ppk = UserDetail::count();
        } else {


            $ppk = UserDetail::where('uptd_id', Auth::user()->userDetail->uptd_id)->count();
        }

        if (Auth::user()->userDetail->uptd_id == 0) {
            $data = DataUmum::where('thn', date('Y'))->with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->orderBy('id', 'desc')->get();
        } elseif (Auth::user()->userDetail->role == 5) {
            $data = DataUmum::where('thn', date('Y'))->with('uptd')->whereHas('detailWithJadual', function ($query) {
                $query->where('ppk_id', Auth::user()->userDetail->user_id);
            })->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        } else {
            $data = DataUmum::where('thn', date('Y'))->with('uptd')->whereHas('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        }
        foreach ($data as $d) {
            if ($d->detailWithJadual == null) {
                $d->detailWithJadual = (object) [
                    'lama_waktu' => 0,
                    'jadualDetail' => []
                ];
            }
            $rencana = 0;
            $realisasi = 0;
            $deviasi = 0;
            $days = 0;
            $now = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime($d->tgl_spmk . "+" . $d->detailWithJadual->lama_waktu . " days"));
            $spmk = new DateTime($d->tgl_spmk);
            $today = new DateTime($now);
            $interval = $spmk->diff($today);
            $hari_terpakai = $interval->days;
            $persen = ($hari_terpakai / $d->detailWithJadual->lama_waktu) * 100;



            if ($days < $d->tgl_spmk) {
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
            $d->laporanUptdAproved->persen = $persen;
            $d->laporanUptdAproved->tersisa = $d->detailWithJadual->lama_waktu - $hari_terpakai;
            $d->laporanUptdAproved->enddate = $end_date;
            $d->laporanUptdAproved->hari_terpakai = $hari_terpakai;
            $d->laporanUptdAproved->paket_selesai = $now > $end_date ? true : false;
            $d->laporanUptdAproved->realisasi =  number_format($realisasi, 2, '.', '.');
            $d->laporanUptdAproved->rencana = number_format($rencana, 2, '.', '.');
            $d->laporanUptdAproved->deviasi = number_format($rencana - $realisasi, 2, '.', '.');
        }

        return view('home', [
            'data' => $data,
            'uptd' => Uptd::all(),
            'paket' => count($data),
            'ppk' => $ppk,
            'konsultan' => Konsultan::count(),
            'kontraktor' => Kontraktor::count()
        ]);
    }
}
