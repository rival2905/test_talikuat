<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"
        integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg=="
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h4 style='text-align: center;'>LEMBAR PENILAIAN KINERJA PENYEDIA PELAKSANA KONSTRUKSI</h4>
        <table style="width: fit-content; font-size:small;" align='center'>
            <thead>
                <th>PELAKSANAAN KONSTRUKSI</th>
                <th></th>
                <th></th>
                <th>Tahun</th>
                <th>
                    {{ $data->dataUmum->thn }}
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>Unit Kerja</td>
                    <td>:</td>
                    <td>
                        {{ $data->dataUmum->uptd->nama_uptd }}
                    </td>
                </tr>
                <tr>
                    <td>Nama Perusahaan</td>
                    <td>:</td>
                    <td>
                        {{ $data->kontraktor->nama }}
                    </td>
                </tr>
                <tr>
                    <td>Alamat Perusahaan</td>
                    <td>:</td>
                    <td>
                        {{ $data->kontraktor->alamat }}
                    </td>
                </tr>
                <tr>
                    <td>Paket Pekerjaan</td>
                    <td>:</td>
                    <td>
                        {{ $data->dataUmum->nm_paket }}
                    </td>
                </tr>
                <tr>
                    <td>Lokasi Pekerjaan</td>
                    <td>:</td>
                    <td>

                        @foreach ($data->dataUmum->detail->ruas as $ruas)
                        {{ $ruas->ruas_id}} - {{ $ruas->segment_jalan }} <br>
                        @endforeach

                    </td>
                </tr>
                <tr>
                    <td>Nilai Kontrak</td>
                    <td>:</td>
                    <td class="nilai">
                        {{ $data->dataUmum->detail->nilai_kontrak }}
                    </td>
                </tr>
                <tr>
                    <td>Nomor Kontrak</td>
                    <td>:</td>
                    <td>
                        {{ $data->dataUmum->no_kontrak }}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Kontrak</td>
                    <td>:</td>
                    <td>
                        {{ date('Y-m-d', strtotime($data->dataUmum->tgl_kontrak)) }}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal SPMK</td>
                    <td>:</td>
                    <td>
                        {{ date('Y-m-d', strtotime($data->dataUmum->tgl_spmk)) }}
                    </td>
                </tr>
                <tr>
                    <td>Jangka Waktu Pelaksanaan</td>
                    <td>:</td>
                    <td>
                        {{ $data->dataUmum->detail->lama_waktu }} Hari
                    </td>
                </tr>
                <tr>
                    <td>Tanggal PHO</td>
                    <td>:</td>
                    <td>
                        {{ date('d-m-Y', strtotime($data->dataUmum->tgl_spmk . ' + ' .
                        $data->dataUmum->detail->lama_waktu . ' days')) }}
                    </td>
                </tr>
                <tr>
                    <td>Bulan Ke
                    <td>:</td>
                    <td>
                        {{ $data->periode }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <table align='center' border='1' cellspacing='0' cellpadding='1' width='900px' style='text-align: center;'>
        <thead>
            <tr>
                <td rowspan='2'>ASPEK KINERJA</td>
                <td rowspan='2'>Bobot(%)</td>
                <td rowspan='2'>Kode</td>
                <td rowspan='2'>INDIKATOR KERJA</td>
                <td colspan='1'>Penilaian</td>
                <td rowspan='2'>NILAI</td>
                <td rowspan='2'>KETERANGAN</td>
            </tr>
            <tr>
                <td>Ya / Tidak</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style='background-color: green;'>
                    <p class='font-weight-bold'>A. Persiapan</p>
                <td style='background-color: green;'>
                    {{ $data->a_bobot }}
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>

            </tr>
            @if ($data->text_a1 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_a1 }}</td>
                <td>{{ $data->a_1 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->a_1, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_a2 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_a2 }}</td>
                <td>{{ $data->a_2 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->a_2, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_a3 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_a3 }}</td>
                <td>{{ $data->a_2 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->a_3, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_a4 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_a4}}</td>
                <td>{{ $data->a_4 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->a_4, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            <tr>
                <td colspan='5' style='background-color:yellow;'>Jumlah - A </td>
                <td style='background-color:yellow;'>
                    {{ number_format($data->a_total, 2, ',', '.') }}
                <td style='background-color:yellow;'></td>
            </tr>
            <tr>
                <td style='background-color: green;'>
                    <p class='font-weight-bold'>B. Pelaksanaan</p>

                <td style='background-color: green;'>
                    {{ $data->b_bobot }}
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
            </tr>
            @if ($data->text_b1 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b1 }}</td>
                <td>{{ $data->b_1 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_1, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b2 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b2 }}</td>
                <td>{{ $data->b_2 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_2, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b3 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b3 }}</td>
                <td>{{ $data->b_3 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_3, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b4 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b4 }}</td>
                <td>{{ $data->b_4 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_4, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b5 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b5 }}</td>
                <td>{{ $data->b_5 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_5, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b6 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b6 }}</td>
                <td>{{ $data->b_6 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_6, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b7 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b7 }}</td>
                <td>{{ $data->b_7 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_7, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b8 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b8 }}</td>
                <td>{{ $data->b_8 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_8, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b9 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b9 }}</td>
                <td>{{ $data->b_9 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_9, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b10 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b10 }}</td>
                <td>{{ $data->b_10 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_10, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b11 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b11 }}</td>
                <td>{{ $data->b_11 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_11, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b12 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b12 }}</td>
                <td>{{ $data->b_12 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_12, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b13 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b13 }}</td>
                <td>{{ $data->b_13 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_13, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b14 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b14 }}</td>
                <td>{{ $data->b_14 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_14, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b15 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b15 }}</td>
                <td>{{ $data->b_15 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_15, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b16 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b16 }}</td>
                <td>{{ $data->b_16 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_16, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_b17 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_b17 }}</td>
                <td>{{ $data->b_17 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->b_17, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            <tr>
                <td colspan='5' style='background-color:yellow;'>Jumlah - B </td>
                <td style='background-color:yellow;'>
                    {{ number_format($data->b_total, 2, ',', '.') }}
                <td style='background-color:yellow;'></td>
            </tr>
            <tr>
                <td style='background-color: green;'>
                    <p class='font-weight-bold'>C. Progress dan Laporan </p>
                <td style='background-color: green;'>
                    {{ $data->c_bobot }}
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
            </tr>
            @if ($data->text_c1 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_c1 }}</td>
                <td>{{ $data->c_1 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->c_1, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_c2 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_c2 }}</td>
                <td>{{ $data->c_2 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->c_2, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_c3 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_c3 }}</td>
                <td>{{ $data->c_3 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->c_3, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_c4 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_c4 }}</td>
                <td>{{ $data->c_4 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->c_4, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_c5 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_c5 }}</td>
                <td>{{ $data->c_5 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->c_5, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_c6 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_c6 }}</td>
                <td>{{ $data->c_6 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->c_6, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            <tr>
                <td colspan='5' style='background-color:yellow;'>Jumlah - C </td>
                <td style='background-color:yellow;'>
                    {{ number_format($data->c_total, 2, ',', '.') }}
                <td style='background-color:yellow;'></td>
            </tr>
            <tr>
                <td style='background-color: green;'>
                    <p class='font-weight-bold'>D. Penyelesaian Masa Pelaksanaan</p>
                <td style='background-color: green;'>
                    {{ $data->d_bobot }}
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
                <td style='background-color: green;'></td>
            </tr>
            @if ($data->text_d1 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_d1 }}</td>
                <td>{{ $data->d_1 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->d_1, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_d2 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_d2 }}</td>
                <td>{{ $data->d_2 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->d_2, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_d3 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_d3 }}</td>
                <td>{{ $data->d_3 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->d_3, 2, ',', '.') }}</td>
                <td></td>

            </tr>
            @endif
            @if ($data->text_d4 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_d4 }}</td>
                <td>{{ $data->d_4 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->d_4, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_d5 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_d5 }}</td>
                <td>{{ $data->d_5 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->d_5, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            @if ($data->text_d6 != null)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $data->text_d6 }}</td>
                <td>{{ $data->d_6 == null ? 'Tidak' : 'Ya' }}</td>

                <td>{{ number_format($data->d_6, 2, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
            <tr>
                <td colspan='5' style='background-color:yellow;'>Jumlah - D </td>
                <td style='background-color:yellow;'>
                    {{ number_format($data->d_total, 2, ',', '.') }}
                <td style='background-color:yellow;'></td>
            </tr>
        </tbody>
    </table>
    <table border='1' cellspacing='0' cellpadding='3' style='text-align: center;' align='left' class="mt-3">
        <tr>
            <th colspan='2'>KRITERIA PENILAIAN</th>
        </tr>
        <tr>
            <th>Sangat Kurang</th>
            <th> 50</th>
        </tr>
        <tr>
            <th>Kurang</th>
            <th>51 - 60</th>
        </tr>
        <tr>
            <th>Cukup</th>
            <th>61 - 70</th>
        </tr>
        <tr>
            <th>Baik</th>
            <th>71 -80</th>
        </tr>
        <tr>
            <th>Sangat Baik</th>
            <th>81 - 100</th>
        </tr>
    </table>
    <table border='1' cellspacing='0' cellpadding='3' style='text-align: center;' width='250px' align='right'
        class="mt-3">
        <thead>
            <tr>
                <th>NILAI</th>
            </tr>
            <tr>
                <th>{{ number_format($data->nilai, 2, ',', '.') }}</th>
            </tr>
            <tr>
                <th>{{
                    $data->nilai >= 81 ? 'Sangat Baik' : ($data->nilai >= 71 ? 'Baik' : ($data->nilai >= 61 ? 'Cukup' :
                    ($data->nilai >= 51 ? 'Kurang' : 'Sangat Kurang'))) }}
                </th>
            </tr>
        </thead>
    </table>

    <table border='1' cellspacing='0' cellpadding='3' style='text-align: center;' align='center' class="mt-3 mb-3">
        <thead>
            <tr>
                <th>NO</th>
                <th>ASPEK KINERJA</th>
                <th>BOBOT</th>
                <th>NILAI AKHIR</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>PERSIAPAN</td>
                <td>{{ $data->a_bobot }}</td>
                <td>{{ number_format($data->a_total, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>PELAKSANAAN</td>
                <td>{{ $data->b_bobot }}</td>
                <td>{{ number_format($data->b_total, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>PROGRESS DAN LAPORAN</td>
                <td>{{ $data->c_bobot }}</td>
                <td>{{ number_format($data->c_total, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>PENYELESAIAN MASA PELAKSANAAN</td>
                <td>{{ $data->d_bobot }}</td>
                <td>{{ number_format($data->d_total, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan='2'>JUMLAH</td>
                <td>{{ $data->a_bobot + $data->b_bobot + $data->c_bobot + $data->d_bobot }}</td>
                <td>{{ number_format($data->nilai, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="container">
            <p style='text-align:center;'>
                Mengetahui: <br>
                KEPALA UPTD PELAKSANAAN JALAN DAN JEMBATAN <br>
                WILAYAH PELAYANAN ….
            </p><br><br><br><br><br><br><br>
            <p style='text-align:center;'>NIP ..........................................</p>
        </div>

        <div class="container">
            <p style='text-align:center;'>
                DINILAI OLEH: <br>
                PEJABAT PEMBUAT KOMITMEN (PPK) <br>
                PENINGKATAN/REHABILITASI JALAN DAN JEMBATAN <br>
            </p><br><br><br><br><br><br><br>
            <p style='text-align:center;'>NIP ..........................................</p>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous">
    </script>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script>
        const nilai = $('.nilai').text();
        $('.nilai').text(formatRupiah(nilai.slice(0,-3),"Rp.")+nilai.slice(-3).replace('.',','))

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }
            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>
</body>

</html>