@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card bg-warning">
                <a href="https://tk.temanjabar.net/admin/master_kontraktor" style="text-decoration: none">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 text-white">Penyedia Jasa</p>
                                <h2 class="text-white">35</h2>
                            </div>
                            <i class="fa-solid fa-person-digging" style="
                                    font-size: 48px;
                                    color: #fff;
                                    background-color: #16a75c;
                                    padding: 20px;
                                    border-radius: 50%;
                                "></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card bg-info">
                <a href="https://tk.temanjabar.net/admin/master_kontraktor" style="text-decoration: none">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 text-white">
                                    Konsultan Surpervisi
                                </p>
                                <h2 class="text-white">35</h2>
                            </div>

                            <i class="fa-solid fa-person-shelter" style="
                                    font-size: 48px;
                                    color: #fff;
                                    background-color: #16a75c;
                                    padding: 20px;
                                    border-radius: 50%;
                                "></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card bg-primary">
                <a href="https://tk.temanjabar.net/admin/master_kontraktor" style="text-decoration: none">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 text-white">PPK</p>
                                <h2 class="text-white">35</h2>
                            </div>

                            <i class="fa-solid fa-user-secret" style="
                                    font-size: 48px;
                                    color: #fff;
                                    background-color: #16a75c;
                                    padding: 20px;
                                    border-radius: 50%;
                                "></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card bg-warning">
                <a href="https://tk.temanjabar.net/admin/master_kontraktor" style="text-decoration: none">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 text-white">Paket Pekerjaan</p>
                                <h2 class="text-white">35</h2>
                            </div>
                            <i class="fa-solid fa-signs-post" style="
                                    font-size: 48px;
                                    color: #fff;
                                    background-color: #16a75c;
                                    padding: 20px;
                                    border-radius: 50%;
                                "></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@if($data->count() > 0)
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
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
            @foreach ($data as $item)
            <div class="row">
                <div class="col-sm-2 align-self-center">
                    <h4>{{$item->id}}</h4>
                </div>
                <div class="col">
                    <div class="progress progress-bar-striped" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar" style="width: {{$item->detailWithJadual->jadualDetail}}%">
                            Rencana Jadual {{$item->detailWithJadual->jadualDetail}} %

                        </div>
                    </div>
                    <div class="progress progress-bar-striped mt-2" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" style="width: {{$item->laporanUptd[0]->realisasi}}%">
                            Realisasi Sesuai Laporan UPTD {{$item->laporanUptd[0]->realisasi}} %
                        </div>
                    </div>
                    <div class="progress progress-bar-striped mt-2" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-danger" style="width: {{$item->detailWithJadual->jadualDetail - $item->laporanUptd[0]->realisasi}}%">
                            Deviasi {{$item->laporanUptd[0]->realisasi - $item->detailWithJadual->jadualDetail}} %
                        </div>
                    </div>
                    <div class="progress mt-2 progress-bar-striped" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-warning" style="width: 0%">


                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
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
            @foreach ($data as $item)
            <div class="row">
                <div class="col-sm-2 align-self-center">
                    <h4>{{$item->id}}</h4>
                </div>
                <div class="col">
                    <div class="progress progress-bar-striped" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar" style="width: {{$item->detailWithJadual->jadualDetail}}%">
                            Rencana Jadual {{$item->detailWithJadual->jadualDetail}} %

                        </div>
                    </div>
                    <div class="progress progress-bar-striped mt-2" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" style="width: {{$item->laporanUptd[0]->realisasi}}%">
                            Realisasi Sesuai Laporan UPTD {{$item->laporanUptd[0]->realisasi}} %
                        </div>
                    </div>
                    <div class="progress progress-bar-striped mt-2" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-danger" style="width: {{$item->detailWithJadual->jadualDetail - $item->laporanUptd[0]->realisasi}}%">
                            Deviasi {{$item->laporanUptd[0]->realisasi - $item->detailWithJadual->jadualDetail}} %
                        </div>
                    </div>
                    <div class="progress mt-2 progress-bar-striped" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-warning" style="width: 0%">


                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@else
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="text-center">Belum ada data kegiatan paket</h5>
        </div>
    </div>
</div>
@endif
@endsection