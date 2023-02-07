@extends('layouts.app') @section('header')
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" />
<link rel="stylesheet" href="{{ asset('assets/css/loading.css') }}" />
<style>
    th {
        width: fit-content !important;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <form action="{{ route('laporan-mingguan-uptd.store',$dataUmum->id) }}" method="POST" id="form-laporan-mingguan-uptd">
                @csrf
                <input type="hidden" name="file_path" id="file_path" />
                <input type="hidden" name="data_umum_id" id="data_umum_id" value="{{Request::segment(4)}}" />
                <input type="hidden" name="tgl_start" value="{{ $getTgl[0] }}" />
                <input type="hidden" name="tgl_end" value="{{ $getTgl[1] }}" />
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Paket</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{$dataUmum->nm_paket}}" required readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Minggu Ke</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $count }}" name="priode" readonly />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Upload File Laporan</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="file" class="form-control" id="file_laporan" name="file_laporan" required accept="application/pdf" />

                                <div class="invalid-feedback" id="invalid-file_laporan" style="display: block; color: red"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Rencana</label>
                                <input type="text" name="rencana" id="rencana" class="form-control" required />
                                @error('rencana')
                                <div class="invalid-feedback" style="display: block; color: red">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Realisasi</label>
                                <input type="text" name="realisasi" id="realisasi" class="form-control" required />
                                @error('realisasi')
                                <div class="invalid-feedback" style="display: block; color: red">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Deviasi</label>
                                <input type="text" name="deviasi" id="deviasi" class="form-control" required />
                                @error('deviasi')
                                <div class="invalid-feedback" style="display: block; color: red">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <h4 class="text-center fw-bolder fs-3 mt-4 mb-4">Detail Nomor Mata Pembayaran</h4>
                    @foreach($dataUmum->detail->jadual as $item)
                    <div class="form-group row mb-3">
                        <label class="text-wrap">{{$item->nmp}} - {{$item->uraian}}</label>
                        <div class="input-group">
                            <input type="text" name="nmp[]" id="nmp" value="" class="form-control" utocomplete="off" />
                        </div>
                    </div>
                    @endforeach

                </div>
                <button type="submit" class="btn btn-primary mr-2" data-bs-toggle="modal" data-bs-target="#saveData">
                    Save
                </button>
            </form>
        </div>
    </div>
</div>


@endsection @section('scripts')
<div class="load">
    <!-- Place at bottom of page -->
</div>
<script>
    $("#file_laporan").on("change", function() {
        $("body").addClass("loading");
        var data = new FormData();
        data.append("filePdf", $("#file_laporan")[0].files[0]);
        $.ajax({
                url: "https://tk.temanjabar.net/node-ocrapi/parse-pdf",
                type: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(res) {
                $("body").removeClass("loading");
                console.log(res);
                $("#rencana").val(res.data.rencana);
                $("#realisasi").val(res.data.realisasi);
                $("#deviasi").val(res.data.deviasi);
                $("#file_path").val(res.data.filePath);
                $("body").removeClass("loading");
            })
            .fail(function(res) {
                $("#invalid-file_laporan").html(
                    "File tidak dapat diproses, pastikan file yang diupload sesuai dengan format"
                );

                $("body").removeClass("loading");
            });
    });


    $("#btn-save").on("click", function() {
        $("body").addClass("loading");
        $('#form-laporan-mingguan-uptd').submit();
    });
</script>
@endsection