<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DataUmum;
use App\Models\Kontraktor;
use App\Models\PenilaianPenyedia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PenilaianPenyediaController extends Controller
{
    public function index($id)
    {
        $data = DataUmum::where('id', $id)
            ->with(['penilaianPenyedia' => function ($query) {
                $query->orderBy('periode', 'desc');
            }])
            ->first();

        return response()->json([
            'status' => true,
            'message' => 'Data Penilaian Penyedia',
            'data' => $data
        ]);
    }


    public function getDateMobilisasi($id)
    {
        $data = DataUmum::where('id', $id)->first();

        $tgl_pho =  date('d-m-Y', strtotime($data->tgl_spmk . ' + ' . $data->detail->lama_waktu . ' days'));

        $mobilisasi = $data->detailWithJadual->jadualDetail->where('uraian', 'Mobilisasi')->first()->detail;

        $tgl_start = $mobilisasi->first()->tanggal;
        $tgl_end = $mobilisasi->last()->tanggal;




        $penilaian_count = PenilaianPenyedia::where('data_umum_id', $id)->count() + 1;

        return response()->json([
            'status' => true,
            'message' => 'Data Penilaian Penyedia',
            'data' => [
                'tgl_pho' => $tgl_pho,
                'tgl_start' => $tgl_start,
                'tgl_end' => $tgl_end,
                'penilaian_count' => $penilaian_count
            ]
        ]);
    }


    public function downloadPenilaianPenyedia($id)
    {
        $data = PenilaianPenyedia::where('id', $id)
            ->with(['dataUmum', 'kontraktor'])
            ->first();

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Penilaian Penyedia tidak ditemukan',
            ], 404);
        }


        $indicator_a = ['Pengajuan Jadwal Pelaksanaan Pekerjaan sesuai dengan jadwal', 'Pengajuan laporan Kajian Teknis sesuai dengan jadwal', 'Pengajuan Program Mutu sesuai dengan jadwal', 'Pelaksanaan Mobilisasi sesuai dengan jadwal'];
        $indicator_b = [
            'Pengajuan Shop Drawing sesuai dengan jadwal',
            'Pengajuan uji bahan sesuai dengan jadwal',
            'Pengajuan Request sesuai dengan jadwal',
            'Jumlah dan kualifikasi pekerja sesuai dengan Request',
            'Jumlah, Jenis, dan kapasitas alat sesuai dengan Request',
            'Kualitas dan kuantitas pasokan bahan sesuai dengan Request',
            'Volume hasil pekerjaan sesuai dengan target',
            'Tidak terjadi masalah pada peralatan',
            'Tidak terjadi masalah dalam penyediaan bahan',
            'Tidak terjadi perbaikan pekerjaan akibat kegagalan hasil pekerjaan atau uji hasil pekerjaan tidak memenuhi syarat',
            'Kelengkapan K3 untuk pekerja Terpenuhi',
            'Pengendalian Lalu Lintas terpenuhi',
            'Tidak terjadi kecelakaan kerja',
            'Tidak menerima surat teguran berkaitan dengan pelaksanaan pekerjaan',
            'Sosialisasi/Pemberitahuan ke lingkungan sekitar pekerjaan dilakukan',
            'Tidak ada Komplain/Permasalahan dengan Lingkungan sekitar',
            'Progres Item Pekerjaan tidak mengalami keterlambatan'
        ];
        $indicator_c = [
            'Progres Pekerjaan Tidak mengalami keterlambatan',
            'Tidak dalam kontrak kritis',
            'Pengajuan Laporan Harian sesuai dengan jadwal',
            'Pengajuan Back Up Kualitas sesuai dengan jadwal',
            'Pengajuan Back Up Kuantitas sesuai dengan jadwal',
            'Pengajuan MC sesuai dengan jadwal'
        ];
        $indicator_d = [
            'Tidak melewati masa pelaksanaan',
            'Tidak terjadi perubahan signifikan antara kuantitas hasil Kajian Teknis dengan kuantitas akhir',
            'Pengajuan As Built Drawing sesuai dengan jadwal',
            'Pengajuan Pernyataan Akhir pekerjaan (lengkap dengan back up) sesuai dengan jadwal',
            'Pengajuan Jaminan Pemeliharaan Sesuai jadwal',
            'Pengajuan Jadwal Pemeliharaan sesuai jadwal'
        ];
        //set paper size to letter and orientation to portrait

        $pdf = Pdf::loadView('penilaian.print', [
            'data' => $data,
            'indicator_a' => $indicator_a,
            'indicator_b' => $indicator_b,
            'indicator_c' => $indicator_c,
            'indicator_d' => $indicator_d
        ])->setPaper('letter', 'portrait')->setOptions([
            'dpi' => 115,
        ]);




        return $pdf->download('penilaian-penyedia-' . $data->dataUmum->nm_paket . '.pdf');
    }


    public function store(Request $request, $id)
    {
        try {
            $sum_nilai = $request->input('total_a') + $request->input('total_b') + $request->input('total_c') + $request->input('total_d');
            $sum_bobot = $request->input('bobot_a') + $request->input('bobot_b') + $request->input('bobot_c') + $request->input('bobot_d');

            PenilaianPenyedia::create([
                'data_umum_id' => $id,
                'kontraktor_id' => $request->input('kontraktor_id'),
                'periode' => $request->input('bulan_ke'),
                'text_a1' => $request->input('text_a1'),
                'text_a2' => $request->input('text_a2'),
                'text_a3' => $request->input('text_a3'),
                'text_a4' => $request->input('text_a4'),
                'a_1' =>  $request->input('nilai_a1'),
                'a_2' =>  $request->input('nilai_a2'),
                'a_3' =>  $request->input('nilai_a3'),
                'a_4' =>  $request->input('nilai_a4'),
                'a_bobot' => $request->input('bobot_a'),
                'a_total' => $request->input('total_a'),
                'text_b1' => $request->input('text_b1'),
                'text_b2' => $request->input('text_b2'),
                'text_b3' => $request->input('text_b3'),
                'text_b4' => $request->input('text_b4'),
                'text_b5' => $request->input('text_b5'),
                'text_b6' => $request->input('text_b6'),
                'text_b7' => $request->input('text_b7'),
                'text_b8' => $request->input('text_b8'),
                'text_b9' => $request->input('text_b9'),
                'text_b10' => $request->input('text_b10'),
                'text_b11' => $request->input('text_b11'),
                'text_b12' => $request->input('text_b12'),
                'text_b13' => $request->input('text_b13'),
                'text_b14' => $request->input('text_b14'),
                'text_b15' => $request->input('text_b15'),
                'text_b16' => $request->input('text_b16'),
                'text_b17' => $request->input('text_b17'),
                'b_1' =>  $request->input('nilai_b1'),
                'b_2' =>  $request->input('nilai_b2'),
                'b_3' => $request->input('nilai_b3'),
                'b_4' => $request->input('nilai_b4'),
                'b_5' => $request->input('nilai_b5'),
                'b_6' => $request->input('nilai_b6'),
                'b_7' => $request->input('nilai_b7'),
                'b_8' => $request->input('nilai_b8'),
                'b_9' => $request->input('nilai_b9'),
                'b_10' => $request->input('nilai_b10'),
                'b_11' => $request->input('nilai_b11'),
                'b_12' => $request->input('nilai_b12'),
                'b_13' => $request->input('nilai_b13'),
                'b_14' => $request->input('nilai_b14'),
                'b_15' => $request->input('nilai_b15'),
                'b_16' => $request->input('nilai_b16'),
                'b_17' => $request->input('nilai_b17'),
                'b_bobot' => $request->input('bobot_b'),
                'b_total' => $request->input('total_b'),
                'text_c1' => $request->input('text_c1'),
                'text_c2' => $request->input('text_c2'),
                'text_c3' => $request->input('text_c3'),
                'text_c4' => $request->input('text_c4'),
                'text_c5' => $request->input('text_c5'),
                'text_c6' => $request->input('text_c6'),
                'c_1' => $request->input('nilai_c1'),
                'c_2' => $request->input('nilai_c2'),
                'c_3' => $request->input('nilai_c3'),
                'c_4' => $request->input('nilai_c4'),
                'c_5' => $request->input('nilai_c5'),
                'c_6' => $request->input('nilai_c6'),
                'c_bobot' => $request->input('bobot_c'),
                'c_total' => $request->input('total_c'),
                'text_d1' => $request->input('text_d1'),
                'text_d2' => $request->input('text_d2'),
                'text_d3' => $request->input('text_d3'),
                'text_d4' => $request->input('text_d4'),
                'text_d5' => $request->input('text_d5'),
                'text_d6' => $request->input('text_d6'),
                'd_1' => $request->input('nilai_d1'),
                'd_2' => $request->input('nilai_d2'),
                'd_3' => $request->input('nilai_d3'),
                'd_4' => $request->input('nilai_d4'),
                'd_5' => $request->input('nilai_d5'),
                'd_6' => $request->input('nilai_d6'),
                'd_bobot' => $request->input('bobot_d'),
                'd_total' => $request->input('total_d'),
                'nilai' => $sum_nilai,
                'bobot' => $sum_bobot
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Penilaian Penyedia berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan Penilaian Penyedia: ' . $e->getMessage(),
            ], 500);
        }
    }
}
