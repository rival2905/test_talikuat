@extends('layouts.app') @section('header')

@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card">
                @csrf
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
                        <label class="col-sm-2 col-form-label">Upload File Laporan</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="file" class="form-control" id="file_laporan" name="file_laporan" required accept="application/pdf" />

                                <div class="invalid-feedback" id="invalid-file_laporan" style="display: block; color: red"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" name="jumlah" value="" required oninput="formatRupiah(this)" />
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <button type="submit" class="btn btn-primary mt-2 w-100">
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
    function formatRupiah(el) {
        el.value = convertToRupiah(el.value, "Rp. ");
    }

    function convertToRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }
        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
</script>
@endsection