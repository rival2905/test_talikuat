<?php

namespace App\Http\Controllers;

use App\Models\DataUmum;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = '';
        if (Auth::user()->userDetail->uptd_id == 0) {
            $data = DataUmum::with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->get();
        } else {
            $data = DataUmum::with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->get();
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
        return view('home', [
            'data' => $data
        ]);
    }
}
