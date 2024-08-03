<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body p-5">
                <div class="row mb-3 justify-content-center">
                    <div class="col">
                        <i class="fa-solid fa-circle" style="color: blue"></i>
                        <strong>Rencana</strong>
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-circle" style="color: green"></i>
                        <strong>Realisasi</strong>
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-circle" style="color: red"></i>
                        <strong>Deviasi</strong>
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-circle" style="color: yellow"></i>
                        <strong>Waktu</strong>
                    </div>
                </div>
                <hr>
                <div class="mt-3">
                    @foreach ($data as $item)

                    <strong class="text-uppercase"> {{$item->nm_paket}}</strong>
                    <div class="row mt-2">
                        <div class="col-sm-2 align-self-center">
                            <a href="{{route('curva-s.index',$item->id)}}" target="_blank" rel="noopener noreferrer">
                                <h4 data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-title="{{$item->nm_paket}}">
                                    {{$item->id}}</h4>
                            </a>
                        </div>
                        <div class="col-sm-9">
                            <div class="progress progress-bar-striped" style="height: 25px" role="progressbar"
                                aria-label="Example with label" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100">
                                <div class="progress-bar" style="width: {{$item->laporanUptdAproved->rencana}}%">
                                    {{$item->laporanUptdAproved->rencana}} %
                                </div>
                            </div>
                            <div class="progress progress-bar-striped mt-2" style="height: 25px" role="progressbar"
                                aria-label="Example with label" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100">
                                <div class="progress-bar bg-success"
                                    style="width: {{$item->laporanUptdAproved->realisasi}}%">
                                    {{$item->laporanUptdAproved->realisasi}}%
                                </div>
                            </div>
                            <div class="progress progress-bar-striped mt-2" style="height: 25px" role="progressbar"
                                aria-label="Example with label" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100">
                                <div class="progress-bar bg-danger"
                                    style="width: {{$item->laporanUptdAproved->deviasi < 0  ? 5 : $item->laporanUptdAproved->deviasi }}%">
                                    {{ $item->laporanUptdAproved->deviasi < 0 ?str_replace("-","+",$item->
                                        laporanUptdAproved->deviasi): "-".$item->laporanUptdAproved->deviasi }}%
                                </div>
                            </div>
                            <div class="progress mt-2 progress-bar-striped" style="height: 25px" role="progressbar"
                                aria-label="Example with label" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100">
                                <div class="progress-bar bg-warning"
                                    style="width: {{$item->laporanUptdAproved->paket_selesai == true ? 100 : $item->laporanUptdAproved->persen}}%">
                                    {{$item->laporanUptdAproved->paket_selesai == true ? "Paket Sudah Selesai" :
                                    $item->laporanUptdAproved->hari_terpakai . " Hari"}}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($item->laporanUptd->where('status','!=',1)->count() > 0)
                    <p class="text-danger">Laporan Belum Disetujui Oleh Kepala UPTD</p>
                    @endif
                    @if( $item->laporanUptd->count() == 0)
                    <p class="text-danger">Belum Ada laporan</p>
                    @endif
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</body>

</html>