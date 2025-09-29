@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row g-4">
        {{-- Penyedia Jasa --}}
        <div class="col-md">
            <div class="card card-premium card-bg-success">
                <a href="{{ route('data-utama.index') }}">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-0">Penyedia Jasa</p>
                                <h2>{{ $kontraktor }}</h2>
                            </div>
                            <i class="fa-solid fa-person-digging icon-circle-premium"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Konsultan Supervisi --}}
        <div class="col-md">
            <div class="card card-premium card-bg-blue">
                <a href="{{ route('data-utama.index') }}">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-0">Konsultan Supervisi</p>
                                <h2>{{ $konsultan }}</h2>
                            </div>
                            <i class="fa-solid fa-person-shelter icon-circle-premium"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- PPK --}}
        <div class="col-md">
            <div class="card card-premium card-bg-yellow">
                <a href="{{ route('data-utama.index') }}">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-0">PPK</p>
                                <h2>{{ $ppk }}</h2>
                            </div>
                            <i class="fa-solid fa-user-secret icon-circle-premium"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Paket Pekerjaan --}}
        <div class="col-md">
            <div class="card card-premium card-bg-lightblue">
                <a href="{{ route('data-umum.index', date('Y')) }}">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-0">Paket Pekerjaan</p>
                                <h2>{{ $paket }}</h2>
                            </div>
                            <i class="fa-solid fa-signs-post icon-circle-premium"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- TOMBOL PILIH TAHUN --}}
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            <a class="btn btn-warning d-flex align-items-center justify-content-center" 
               style="width: 75%; height: 50px;" 
               data-bs-toggle="modal" 
               data-bs-target="#dataThn">
                Pilih Tahun Database
            </a>
        </div>
    </div>

    {{-- GRAFIK BAR --}}
    <div class="row mt-5">
        <div class="col-12">
            <div class="card card-premium">
                <div class="card-body">
                    <h5 class="card-title mb-4">Grafik Kendali Kontrak ({{ request('y', date('Y')) }})</h5>
                    <div id="kendaliKontrakChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- LIST PAKET --}}
    @if($data->count() > 0)
    <div class="container mt-5">
        <div class="card card-premium">
            <div class="card-body p-5">
                <div class="row mb-3 justify-content-center text-center">
                    <div class="col"><i class="fa-solid fa-circle" style="color: blue;"></i> <strong>Rencana</strong></div>
                    <div class="col"><i class="fa-solid fa-circle" style="color: green;"></i> <strong>Realisasi</strong></div>
                    <div class="col"><i class="fa-solid fa-circle" style="color: red;"></i> <strong>Deviasi</strong></div>
                    <div class="col"><i class="fa-solid fa-circle" style="color: #f0ad4e;"></i> <strong>Waktu</strong></div>
                </div>
                <hr>
                <div class="mt-3" style="max-height:60vh; overflow-y:auto; overflow-x:hidden;">
                    @foreach($data as $item)
                    <strong class="text-uppercase">{{ $item->nm_paket }}</strong>
                    <div class="row mt-2">
                        <div class="col-sm-2 align-self-center">
                            <a href="{{ route('curva-s.index', $item->id) }}" target="_blank">
                                <h4>{{ $item->id }}</h4>
                            </a>
                        </div>
                        <div class="col-sm-9">
                            <div class="progress progress-premium">
                                <div class="progress-bar progress-bar-premium progress-bar-primary" style="width:{{ $item->laporanUptdAproved->rencana }}%">
                                    {{ $item->laporanUptdAproved->rencana }}%
                                </div>
                            </div>
                            <div class="progress progress-premium">
                                <div class="progress-bar progress-bar-premium progress-bar-success" style="width:{{ $item->laporanUptdAproved->realisasi }}%">
                                    {{ $item->laporanUptdAproved->realisasi }}%
                                </div>
                            </div>
                            <div class="progress progress-premium">
                                <div class="progress-bar progress-bar-premium progress-bar-danger" style="width: {{ $item->laporanUptdAproved->deviasi < 0 ? 5 : $item->laporanUptdAproved->deviasi+10 }}%">
                                    {{ $item->laporanUptdAproved->deviasi <0 ? str_replace('-','+',$item->laporanUptdAproved->deviasi) : '-'.$item->laporanUptdAproved->deviasi }}%
                                </div>
                            </div>
                            <div class="progress progress-premium">
                                <div class="progress-bar progress-bar-premium progress-bar-warning" style="width:{{ $item->laporanUptdAproved->paket_selesai ? 100 : $item->laporanUptdAproved->persen }}%">
                                    {{ $item->laporanUptdAproved->paket_selesai ? 'Paket Sudah Selesai' : $item->laporanUptdAproved->hari_terpakai.' Hari / '.$item->detail->lama_waktu.' Hari' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($item->laporanUptd->where('status','!=',1)->count()>0)
                    <p class="text-danger">Laporan Belum Disetujui Oleh Kepala UPTD</p>
                    @endif
                    @if($item->laporanUptd->count()==0)
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
        <div class="card card-premium">
            <div class="card-body text-center">
                <h5>Belum ada data kegiatan paket</h5>
            </div>
        </div>
    </div>
    @endif

    {{-- MODAL PILIH TAHUN --}}
    <div class="modal fade" id="dataThn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Tahun Database</h5>
                </div>
                <div class="modal-body">
                    <select id="thn" class="form-select">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach($thn as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- amCharts -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<script>
$(document).ready(function() {
    const url = `{{ route('dashboard') }}`;
    $('#submit').click(function() {
        var thn = $('#thn').val();
        if(thn!=''){
            window.location.href = `${url}?y=${thn}`;
        } else {
            alert('Pilih Tahun Database');
        }
    });

    am4core.ready(function() {
        am4core.useTheme(am4themes_animated);

        var chart = am4core.create("kendaliKontrakChart", am4charts.XYChart);

        chart.data = [
            { "uptd": "I", "terdapat": 20, "list": 18, "upload": 5, "diperiksa": 4 },
            { "uptd": "II", "terdapat": 48, "list": 36, "upload": 12, "diperiksa": 8 },
            { "uptd": "IV", "terdapat": 33, "list": 29, "upload": 9, "diperiksa": 7 },
            { "uptd": "V", "terdapat": 22, "list": 20, "upload": 5, "diperiksa": 5 },
            { "uptd": "VI", "terdapat": 15, "list": 12, "upload": 7, "diperiksa": 7 },
        ];

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "uptd";
        categoryAxis.title.text = "UPTD";
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.cellStartLocation = 0.2;
        categoryAxis.renderer.cellEndLocation = 0.8;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Jumlah Paket";

        function createSeries(field, name, color) {
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = field;
            series.dataFields.categoryX = "uptd";
            series.name = name;
            series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
            series.columns.template.fill = am4core.color(color);
            series.columns.template.stroke = am4core.color(color);

            series.clustered = true;
        }

        createSeries("terdapat", "JUMLAH PAKET YANG TERDAPAT DI UPTD", "#1e3c72");
        createSeries("list", "JUMLAH PAKET YANG DILIST PADA WEB", "#f0ad4e");
        createSeries("upload", "JUMLAH PAKET YANG SUDAH UPLOAD", "#006400");
        createSeries("diperiksa", "JUMLAH PAKET YANG SUDAH DIPERIKSA", "#00bfff");

        chart.legend = new am4charts.Legend();
        chart.legend.position = "bottom";
    });
});
</script>
@endsection
