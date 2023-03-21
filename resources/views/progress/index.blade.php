<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Progres</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/laporan_progress.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/loading.css') }}" />
</head>

<body class="loading">

    <input type="hidden" id="api-url" value="{{ route('get-data-pembangunan-by-uptd') }}" />
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <div class="input-group center">
                    <label class="input-group-text" for="inputGroupSelect01">UPTD</label>
                    <select class="form-select" id="uptd">
                        @foreach ($uptd as $item)
                        <option value=" {{ $item->id }}">
                            {{ $item->nama_uptd }}
                        </option>
                        @endforeach
                        <option value="all">Semua UPTD</option>
                    </select>
                </div>

                <div class="input-group center mt-3">
                    <label class="input-group-text" for="inputGroupSelect01">Tanggal awal</label>
                    <input type="date" name="date" id="date-start" class="form-select" />
                </div>
                <div class="input-group center mt-3">
                    <label class="input-group-text" for="inputGroupSelect01">Tanggal akhir</label>
                    <input type="date" name="date" id="date-end" class="form-select" />
                </div>
            </div>


        </div>

    </div>
    <div class="header mt-5">
        LAPORAN PROGRES MINGGUAN <br />
        PELAKSANAAN KEGIATAN PENINGKATAN / REHABILITASI JALAN DAN JEMBATAN
        <br />
        UPTD I S/D VI DINAS BINA MARGA DAN PENATAAN RUANG PROVINSI JAWA
        BARAT
        <br />
        TAHUN ANGGARAN {{date('Y')}}
    </div>
    <div class="d-flex">
        <span id="unor"></span>
        <span id="status">Status : </span>
    </div>
    <table class="table table-bordered">
        <thead>
            <th rowspan="4" style="width:25px;">NO</th>
            <th rowspan="4">NAMA KEGIATAN</th>
            <th rowspan="4" style="width:20px;">PANJANG PENANGANAN ( KM )</th>
            <th colspan="2">DATA KONTRAK</th>
            <th rowspan="2" style="width:15px;">WAKTU PELAKSANAAN</th>
            <th rowspan="4" style="font-size: 9px; width: 10rem; text-align: left">
                1. Nilai Kontrak <br />2. Tanggal Kontrak <br />3. Nilai
                Kontrak ADD. <br />4. Tanggal Kontrak ADD.
            </th>
            <th rowspan="4">KONSULTAN PENGAWASAN</th>
            <th colspan="4">PROGRES TERHADAP KONTRAK <br />FISIK</th>
            <th rowspan="4" style="width:40px;">Keterangan</th>
            <tr>
                <th>PENYEDIA JASA</th>
                <th style="width: 8rem">SPMK & PHO</th>
                <th>Minggu Ke</th>
                <th>Rencana %</th>
                <th>Realisasi %</th>
                <th>Deviasi %</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <div class="load">
        <!-- Place at bottom of page -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    <script>
        const apiUrl = $("#api-url").val();
    </script>
    <script src="{{ asset('assets/custom/laporan_progress.js') }}"></script>
</body>

</html>