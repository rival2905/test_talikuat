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
                                <h2 class="text-white">{{$kontraktor}}</h2>
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
                                <h2 class="text-white">{{$konsultan}}</h2>
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
                                <h2 class="text-white">{{$ppk}}</h2>
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
                                <h2 class="text-white">{{$paket}}</h2>
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
            <div class="mt-3" style="max-height: 60vh; overflow-y: auto;padding:0px;overflow-x: hidden;">
                @foreach ($data as $item)

                <strong class="text-uppercase"> {{$item->nm_paket}}</strong>
                <div class="row mt-2">
                    <div class="col-sm-2 align-self-center">
                        <a href="{{route('curva-s.index',$item->id)}}" target="_blank" rel="noopener noreferrer">
                            <h4 data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{$item->nm_paket}}">{{$item->id}}</h4>
                        </a>
                    </div>
                    <div class="col-sm-9">
                        <div class="progress progress-bar-striped" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: {{$item->laporanUptdAproved->rencana}}%">
                                {{$item->laporanUptdAproved->rencana}} %
                            </div>
                        </div>
                        <div class="progress progress-bar-striped mt-2" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success" style="width: {{$item->laporanUptdAproved->realisasi}}%">
                                {{$item->laporanUptdAproved->realisasi}}%
                            </div>
                        </div>
                        <div class="progress progress-bar-striped mt-2" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-danger" style="width: {{$item->laporanUptdAproved->deviasi < 0  ? 5 : $item->laporanUptdAproved->deviasi }}%">
                                {{ $item->laporanUptdAproved->deviasi < 0 ?str_replace("-","+",$item->laporanUptdAproved->deviasi): "-".$item->laporanUptdAproved->deviasi   }}%
                            </div>
                        </div>
                        <div class="progress mt-2 progress-bar-striped" style="height: 25px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-warning" style="width: {{$item->laporanUptdAproved->reaming == 0 ? '100%' : $item->laporanUptdAproved->reaming}}">
                                {{ $item->laporanUptdAproved->reaming == 0 ? "Paket Sudah Selesai" : $item->laporanUptdAproved->reaming." Hari"  }}
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