<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Rekap Dokumen Talikuat {{$uptd->nama_uptd}}</title>
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
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileDkh->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileDkh->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                @if ($item->fileKontrak->last() != null)
                <td class="text-center bg-success">
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileKontrak->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileKontrak->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                @if ($item->fileSpmk->last() != null)
                <td class="text-center bg-success">
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileSpmk->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileSpmk->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                @if ($item->fileUmum->last() != null)
                <td class="text-center bg-success">
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileUmum->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileUmum->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                @if ($item->fileSyaratKhusus->last() != null)
                <td class="text-center bg-success">
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileSyaratKhusus->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileSyaratKhusus->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                @if ($item->fileJadual->last() != null)
                <td class="text-center bg-success">
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileJadual->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileJadual->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                @if ($item->fileGambarRencana->last() != null)
                <td class="text-center bg-success">
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileGambarRencana->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileGambarRencana->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                @if ($item->fileSppbj->last() != null)
                <td class="text-center bg-success">
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileSppbj->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileSppbj->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                @if ($item->fileSpl->last() != null)
                <td class="text-center bg-success">
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileSpl->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileSpl->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                @if ($item->fileSpeckUmum->last() != null)
                <td class="text-center bg-success">
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileSpeckUmum->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileSpeckUmum->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                @if ($item->fileJaminan->last() != null)
                <td class="text-center bg-success">
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileJaminan->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileJaminan->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                @if ($item->fileBapl->last() != null)
                <td class="text-center bg-success">
                    <a href="{{ route('show.file.dataumum',['id'=>$item->id,'file'=>$item->fileBapl->last()->file_name] ) }}"
                        target="_blank" class="link-light link-offset-2">{{
                        preg_replace('/[\d_]+/', '',
                        $item->fileBapl->last()->file_name)
                        }}</a>
                </td>
                @else
                <td class="text-center bg-danger">Tidak Ada</td>
                @endif
                <td>
                    {{ floor(($item->fileDkh->count() + $item->fileKontrak->count() + $item->fileSpmk->count() +
                    $item->fileUmum->count() + $item->fileSyaratKhusus->count() + $item->fileJadual->count() +
                    $item->fileGambarRencana->count() + $item->fileSppbj->count() + $item->fileSpl->count() +
                    $item->fileSpeckUmum->count() + $item->fileJaminan->count() + $item->fileBapl->count()) / 12 * 100)
                    }}%
                </td>
                @if ($item->laporanUptdAproved->paket_selesai == true)
                <td class="text-center bg-success">Paket Sudah Selesai</td>
                @else
                <td>
                    {{ ceil($item->laporanUptdAproved->hari_terpakai / 7) . "/" .ceil($item->detail->lama_waktu / 7)}}
                </td>
                @endif
                <td>{{$item->laporanUptdAproved->rencana}}%</td>
                <td>{{$item->laporanUptdAproved->realisasi}}%</td>
                @if ($item->laporanUptdAproved->deviasi == 0)
                <td>0%</td>
                @elseif ($item->laporanUptdAproved->deviasi < 0) <td>
                    {{str_replace("-","+",$item->laporanUptdAproved->deviasi)}}%</td>
                    @else
                    <td>-{{$item->laporanUptdAproved->deviasi}}%</td>
                    @endif
                    <td>
                        @if ($item->laporanUptd->where('status','!=',1)->count() > 0)
                        <p class="text-danger">Laporan Belum Disetujui Oleh Kepala UPTD</p>
                        @endif
                        @if( $item->laporanUptd->count() == 0)
                        <p class="text-danger">Belum Ada laporan</p>
                        @endif
                        @if (count($item->detailWithJadual->jadualDetail) == 0)

                        <p class="text-danger">Jadual Belum Diisi</p>
                        @endif
                    </td>
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