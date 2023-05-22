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
        <form action="{{ route('laporan-mingguan-uptd.update',$data->id) }}" method="POST" id="form-laporan-mingguan-uptd">
            <div class="card">
                @csrf
                @method('PUT')
                <input type="hidden" name="file_path" id="file_path" />
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Note Kepala UPTD : </label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <p class="text-danger col-form-label">{{$data->keterangan}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">ID Paket</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{$data->data_umum_id}}" required readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Minggu Ke</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $data->priode }}" name="priode" readonly />
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
                                <input type="text" name="rencana" value="{{$data->rencana}}" id="rencana" class="form-control" required readonly />
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
                                <input type="text" name="realisasi" id="realisasi" value="{{$data->realisasi}}" class="form-control" required />
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
                                <input type="text" name="deviasi" id="deviasi" value="{{$data->deviasi}}" class="form-control" required readonly />
                                @error('deviasi')
                                <div class="invalid-feedback" style="display: block; color: red">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <h4 class="text-center fw-bolder fs-3 mt-4 mb-4">Detail Nomor Mata Pembayaran</h4>
                    @foreach($data->detail as $item)
                    <div class="form-group row mb-3">
                        <label class="text-wrap">{{$item->nmp}}</label>
                        <div class="input-group">
                            <input type="hidden" name="nmp[]" value="{{$item->nmp}}" />
                            <input type="text" name="volume[]" id="nmp" value="{{$item->volume}}" class="form-control" required autocomplete="off" />
                        </div>
                    </div>
                    @endforeach
                    <p id="totalParent">Total : <span class="text-danger" id="total"></span></p>
                </div>

            </div>
            <button type="button" class="btn btn-primary mt-2 w-100" onclick="validate()">
                Save
            </button>
        </form>
    </div>
</div>


@endsection @section('scripts')
<div class="load">
    <!-- Place at bottom of page -->
</div>
<script>
    $(document).ready(function() {
        $('#totalParent').hide();


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
                    var deviasi = res.data.realisasi - $('#rencana').val().replace(/,/g, '.');
                    console.log(res.data);
                    if (deviasi < 0) {
                        $('#deviasi').val(deviasi.toFixed(2));
                        $('#deviasi').css('color', 'red');
                    } else {
                        $('#deviasi').val(deviasi.toFixed(2));
                        $('#deviasi').css('color', 'green');
                    }
                    $("#realisasi").val(res.data.realisasi.toFixed(2));
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
        $('#realisasi').change(function() {
            var rencana = $('#rencana').val();
            var realisasi = $('#realisasi').val().replace(/,/g, '.');
            var deviasi = realisasi - rencana;
            if (deviasi < 0) {
                $('#deviasi').val(deviasi.toFixed(2));
                $('#deviasi').css('color', 'red');
            } else {
                $('#deviasi').val(deviasi.toFixed(2));
                $('#deviasi').css('color', 'green');
            }

        });
    });

    function validate() {
        var file_laporan = $('#file_laporan').val();
        var realisasi = $('#realisasi').val();
        var deviasi = $('#deviasi').val();
        var volume = $("input[name='volume[]']").map(function() {
            return $(this).val();
        }).get();
        var volume = volume.filter(function(el) {
            return el != "";
        });
        var nmp = $("input[name='nmp[]']").map(function() {
            return $(this).val();
        }).get();
        var nmp = nmp.filter(function(el) {
            return el != "";
        });
        var totalVolume = 0;
        for (var i = 0; i < volume.length; i++) {
            totalVolume += parseFloat(volume[i]);
        }
        if (file_laporan == '') {
            alert('File laporan harus diisi');
            return false;
        } else if (realisasi == '') {
            alert('Realisasi harus diisi');
            return false;
        } else if (volume.length != nmp.length) {
            alert('Nomor mata pembayaran harus diisi isi 0 jika tidak ada');
            return false;
        } else if (totalVolume.toFixed(3) != realisasi.toFixed(3)) {
            console.log(totalVolume);
            console.log(realisasi);
            $('#totalParent').show();
            $('#total').html(totalVolume.toFixed(2));
            alert('Total volume harus sama dengan realisasi');
            return false;
        } else {
            event.preventDefault();
            $("body").addClass("loading");
            $('#form-laporan-mingguan-uptd').submit();
        }
    }
</script>
@endsection