<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Document</title>
    <style>
        /* CARD PREMIUM */
        .card-premium {
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-premium:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.35);
        }

        /* PROGRESS BAR PREMIUM */
        .progress-premium {
            height: 25px;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-bar-premium {
            font-weight: 500;
            text-align: center;
            line-height: 25px;
            color: #fff;
            transition: width 0.5s ease-in-out;
        }

        .progress-bar-rencana {
            background: linear-gradient(90deg, #0d6efd, #3d8bfd);
        }

        .progress-bar-realisasi {
            background: linear-gradient(90deg, #16a75c, #1dbf73);
        }

        .progress-bar-deviasi {
            background: linear-gradient(90deg, #dc3545, #e4606d);
        }

        .progress-bar-waktu {
            background: linear-gradient(90deg, #ffc107, #e0a800);
        }

        a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card card-premium">
            <div class="card-body p-5">
                <div class="row mb-3 justify-content-center">
                    <div class="col text-center">
                        <i class="fa-solid fa-circle" style="color: #0d6efd"></i>
                        <strong>Rencana</strong>
                    </div>
                    <div class="col text-center">
                        <i class="fa-solid fa-circle" style="color: #16a75c"></i>
                        <strong>Realisasi</strong>
                    </div>
                    <div class="col text-center">
                        <i class="fa-solid fa-circle" style="color: #dc3545"></i>
                        <strong>Deviasi</strong>
                    </div>
                    <div class="col text-center">
                        <i class="fa-solid fa-circle" style="color: #ffc107"></i>
                        <strong>Waktu</strong>
                    </div>
                </div>
                <hr>
                <div class="mt-3" style="max-height: 60vh; overflow-y: auto; overflow-x: hidden;">

                    @foreach ($data as $item)

                    <strong class="text-uppercase"> {{$item->nm_paket}}</strong>
                    <div class="row mt-2">
                        <div class="col-sm-2 align-self-center">
                            <a href="{{ route('curva-s.index', $item->id) }}" target="_blank" rel="noopener noreferrer">
                                <h4 data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{$item->nm_paket}}">
                                    {{$item->id}}
                                </h4>
                            </a>
                        </div>
                        <div class="col-sm-9">
                            {{-- Rencana --}}
                            <div class="progress progress-premium">
                                <div class="progress-bar progress-bar-premium progress-bar-rencana"
                                    style="width: {{$item->laporanUptdAproved->rencana}}%">
                                    {{$item->laporanUptdAproved->rencana}} %
                                </div>
                            </div>

                            {{-- Realisasi --}}
                            <div class="progress progress-premium">
                                <div class="progress-bar progress-bar-premium progress-bar-realisasi"
                                    style="width: {{$item->laporanUptdAproved->realisasi}}%">
                                    {{$item->laporanUptdAproved->realisasi}} %
                                </div>
                            </div>

                            {{-- Deviasi --}}
                            <div class="progress progress-premium">
                                <div class="progress-bar progress-bar-premium progress-bar-deviasi"
                                    style="width: {{$item->laporanUptdAproved->deviasi < 0 ? 5 : $item->laporanUptdAproved->deviasi + 10}}%">
                                    {{$item->laporanUptdAproved->deviasi < 0 ? str_replace('-','+',$item->laporanUptdAproved->deviasi) : '-'.$item->laporanUptdAproved->deviasi}} %
                                </div>
                            </div>

                            {{-- Waktu --}}
                            <div class="progress progress-premium">
                                <div class="progress-bar progress-bar-premium progress-bar-waktu"
                                    style="width: {{$item->laporanUptdAproved->paket_selesai == true ? 100 : $item->laporanUptdAproved->persen}}%">
                                    {{$item->laporanUptdAproved->paket_selesai == true ? "Paket Sudah Selesai" : $item->laporanUptdAproved->hari_terpakai." Hari / ".$item->detail->lama_waktu." Hari"}}
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
