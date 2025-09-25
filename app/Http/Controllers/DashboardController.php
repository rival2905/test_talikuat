<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataUmum;
use App\Models\DataUmumDocumentCategory;
use App\Models\Konsultan;
use App\Models\Kontraktor;
use App\Models\Uptd;
use App\Models\UserDetail;
use DateTime;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->has('y') ? $request->y : date('Y');

        // =================== Hitung PPK ===================
        if (Auth::guard('external')->check()) {
            $uptd_id = Auth::guard('external')->user()->uptd_id;
            $ppk = $uptd_id == 0 ? UserDetail::count() : UserDetail::where('uptd_id', $uptd_id)->count();
        } else {
            $uptd_id = Auth::user()->userDetail->uptd_id;
            $ppk = $uptd_id == 0 ? UserDetail::count() : UserDetail::where('uptd_id', $uptd_id)->count();
        }

        // =================== Ambil DataUmum ===================
        $user = Auth::guard('external')->check() ? Auth::guard('external')->user() : Auth::user()->userDetail;

        if ($uptd_id == 0) {
            $data = DataUmum::where('thn', $year)
                ->with(['uptd', 'detailWithJadual', 'laporanUptdAproved', 'laporanUptd', 'laporanKonsultan'])
                ->orderBy('id', 'desc')->get();
        } elseif ($user->role == 5) {
            $data = DataUmum::where('thn', $year)
                ->where('uptd_id', $uptd_id)
                ->with(['uptd', 'laporanUptdAproved', 'laporanUptd', 'laporanKonsultan'])
                ->whereHas('detailWithJadual', function ($q) use ($user) {
                    $q->where('ppk_id', $user->user_id);
                })
                ->orderBy('id', 'desc')->get();
        } else {
            $data = DataUmum::where('thn', $year)
                ->where('uptd_id', $uptd_id)
                ->with(['uptd', 'detailWithJadual', 'laporanUptdAproved', 'laporanUptd', 'laporanKonsultan'])
                ->orderBy('id', 'desc')->get();
        }

        // =================== Hitung rencana, realisasi, deviasi ===================
        foreach ($data as $d) {
            if ($d->detailWithJadual == null) {
                $d->detailWithJadual = (object) ['lama_waktu' => 0, 'jadualDetail' => []];
            }

            $rencana = 0;
            $realisasi = 0;
            $now = date('Y-m-d');
            $spmk = new DateTime($d->tgl_spmk);
            $today = new DateTime($now);
            $interval = $spmk->diff($today);
            $hari_terpakai = $interval->days;
            $persen = $d->detailWithJadual->lama_waktu > 0 ? ($hari_terpakai / $d->detailWithJadual->lama_waktu) * 100 : 0;

            foreach ($d->detailWithJadual->jadualDetail as $jadual) {
                foreach ($jadual->detail as $detail) {
                    if (strtotime($detail->tanggal) <= strtotime($now)) {
                        $rencana += floatval($detail->nilai);
                    }
                }
            }

            if (!Auth::guard('external')->check()) {
                $realisasi = $d->laporanUptdAproved->count() ? $d->laporanUptdAproved->last()->realisasi : 0;
            } else {
                $realisasi = $d->laporanKonsultan->count() ? $d->laporanKonsultan->last()->realisasi : 0;
            }

            $d->laporanUptdAproved->persen = $persen;
            $d->laporanUptdAproved->tersisa = $d->detailWithJadual->lama_waktu - $hari_terpakai;
            $d->laporanUptdAproved->enddate = date('Y-m-d', strtotime($d->tgl_spmk . "+" . $d->detailWithJadual->lama_waktu . " days"));
            $d->laporanUptdAproved->hari_terpakai = $hari_terpakai;
            $d->laporanUptdAproved->paket_selesai = $now > $d->laporanUptdAproved->enddate;
            $d->laporanUptdAproved->realisasi = number_format($realisasi, 2, '.', '.');
            $d->laporanUptdAproved->rencana = number_format($rencana, 2, '.', '.');
            $d->laporanUptdAproved->deviasi = number_format($rencana - $realisasi, 2, '.', '.');
        }

        // =================== Ambil data DataUmumDocumentCategory untuk grafik ===================
        $kendaliKontrak = DataUmumDocumentCategory::selectRaw('DATE(created_at) as date, AVG(score) as avg_score')
            ->whereYear('created_at', $year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // =================== Return view ===================
        return view('home', [
            'data' => $data,
            'uptd' => Uptd::all(),
            'paket' => count($data),
            'ppk' => $ppk,
            'konsultan' => Konsultan::count(),
            'kontraktor' => Kontraktor::count(),
            'thn' => DataUmum::pluck('thn')->unique(),
            'kendaliKontrak' => $kendaliKontrak, // untuk chart line
        ]);
    }
}
