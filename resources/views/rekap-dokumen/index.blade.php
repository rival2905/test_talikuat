<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Rekap Dokumen UPTD</title>
</head>

<body>
    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th rowspan="4" style="width:25px;">NO</th>
                <th rowspan="4">NAMA PAKET</th>
                <th colspan="13" class="text-center">DOKUMEN</th>
                <th colspan="4" class="text-center">PROGRESS</th>
                <th rowspan="4">Keterangan</th>
            </tr>
            <tr>
                <th>Daftar Kuantitas dan Harga (DKH)</th>
                <th>Perjanjian Kontrak</th>
                <th>SPMK</th>
                <th>Syarat Umum</th>
                <th>Syarat Khusus</th>
                <th>Jadual Pelaksanaan Pekerjaan</th>
                <th>Gambar Rencana</th>
                <th>SPPBJ</th>
                <th>SPL ( Penyerahan Lapangan )</th>
                <th>Spesifikasi Umum</th>
                <th>Jaminan - Jaminan</th>
                <th>BA PHO ( Serah Terima Pertama )</th>
                <th>Persentase Upload Dokumen</th>
                <th rowspan="3">Minggu Saat Ini</th>
                <th rowspan="3">Rencana</th>
                <th rowspan="3">Realisasi</th>
                <th rowspan="3">Deviasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nm_paket }}</td>
                @if ($item->fileDkh->last() != null)
                <td class="text-center bg-success">
                    <a href="" class="text-dark link-offset-2 link-underline link-underline-opacity-0">{{
                        preg_replace('/\d+/', '', $item->fileDkh->last()->file_name) }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                <td>Ada</td>
                <td>Ada</td>
                <td>Ada</td>
                <td>Ada</td>
                <td>Ada</td>
                <td>Tidak Ada</td>
                <td>Ada</td>
                <td>Ada</td>
                <td>Ada</td>
                <td>Ada</td>
                <td>75%</td>
                <td>10%</td>
                <td>8%</td>
                <td>-2%</td>
                <td>Tidak ada masalah</td>
            </tr>

            @endforeach
            <!-- Tambahkan baris data sesuai kebutuhan -->
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>