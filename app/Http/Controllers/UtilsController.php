<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataUmum;
use App\Models\Konsultan;
use App\Models\Kontraktor;
use App\Models\Uptd;
use App\Models\UserDetail;
use DateTime;
use Faker\Core\File;
use Illuminate\Support\Facades\Auth;

class UtilsController extends Controller
{
    public function progressAll()
    {
        $data = '';
        if (Auth::user()->userDetail->uptd_id == 0) {

            $ppk = UserDetail::count();
        } else {


            $ppk = UserDetail::where('uptd_id', Auth::user()->userDetail->uptd_id)->count();
        }

        if (Auth::user()->userDetail->uptd_id == 0) {
            $data = DataUmum::with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->orderBy('id', 'desc')->get();
        } elseif (Auth::user()->userDetail->role == 5) {
            $data = DataUmum::with('uptd')->whereHas('detailWithJadual', function ($query) {
                $query->where('ppk_id', Auth::user()->userDetail->user_id);
            })->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        } else {
            $data = DataUmum::with('uptd')->whereHas('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        }
        foreach ($data as $d) {
            $rencana = 0;
            $realisasi = 0;
            $deviasi = 0;
            $days = 0;
            $now = date('Y-m-d');
            $start = date('Y-m-d', strtotime($d->tgl_spmk));
            $end_date = date('Y-m-d', strtotime($d->tgl_spmk . "+" . $d->detailWithJadual->lama_waktu . " days"));
            $d1 = new DateTime($now);
            $d2 = new DateTime($start);
            $d3 = new DateTime($end_date);
            $days = $d1->diff($d2)->format("%a");
            $days2 = $d1->diff($d3)->format("%a");


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
            $d->laporanUptdAproved->reaming = $days;
            $d->laporanUptdAproved->enddate = $days2;
            $d->laporanUptdAproved->realisasi =  number_format($realisasi, 2, '.', '.');
            $d->laporanUptdAproved->rencana = number_format($rencana, 2, '.', '.');
            $d->laporanUptdAproved->deviasi = number_format($rencana - $realisasi, 2, '.', '.');
        }

        return view('progres-all', [
            'data' => $data,
            'uptd' => Uptd::all(),
            'paket' => count($data),
            'ppk' => $ppk,
            'konsultan' => Konsultan::count(),
            'kontraktor' => Kontraktor::count()
        ]);
    }

    public function progressUptd($uptd)
    {
        $data = '';
        if (Auth::user()->userDetail->uptd_id == 0) {

            $ppk = UserDetail::count();
        } else {


            $ppk = UserDetail::where('uptd_id', Auth::user()->userDetail->uptd_id)->count();
        }
        $data = DataUmum::with('uptd')->whereHas('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', $uptd)->orderBy('id', 'desc')->get();

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
            if (!Auth::guard('external')->check())

                if ($d->laporanUptdAproved->count() == 0) {
                    $realisasi = 0;
                } else {
                    $realisasi = $d->laporanUptdAproved[count($d->laporanUptdAproved) - 1]->realisasi;
                }
            else {
                if ($d->laporanKonsultan->count() == 0) {
                    $realisasi = 0;
                } else {
                    $realisasi = $d->laporanKonsultan[count($d->laporanKonsultan) - 1]->realisasi;
                }
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

        return view('progres-all', [
            'data' => $data,
            'uptd' => Uptd::all(),
            'paket' => count($data),
            'ppk' => $ppk,
            'konsultan' => Konsultan::count(),
            'kontraktor' => Kontraktor::count()
        ]);
    }

    public function fileLaporan($fname)
    {
        $path = storage_path('app/public/lampiran/laporan_konsultan/' . $fname);

        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path);
    }

    public function rekapDokumen($uptd)
    {
        $data = DataUmum::with('uptd')->where([['uptd_id', $uptd], ['thn', date('Y')]])->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('fileDkh', 'fileKontrak', 'fileSpmk', 'fileUmum', 'fileSyaratUmum', 'fileSyaratKhusus', 'fileJadual', 'fileGambarRencana', 'fileSppbj', 'fileSpl', 'fileSpeckUmum', 'fileJaminan', 'fileBapl')
            ->orderBy('id', 'desc')->get();
        return view('rekap-dokumen.index', [
            'data' => $data,

        ]);
    }
}
