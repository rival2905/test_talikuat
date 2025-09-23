@extends('layouts.app') @section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">Data Umum</div>
        <div class="card-body">
            <div class="row align-items-start mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Pemda</label>
                        <input type="text" name="pemda" id="pemda" value="PEMERINTAH PROVINSI JAWA BARAT" class="form-control" required readonly />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>OPD</label>
                        <input type="text" name="opd" id="opd" value="DINAS BINA MARGA DAN PENATAAN RUANG" class="form-control" required readonly />
                    </div>
                </div>
                @if(Auth::user()->userDetail->uptd_id == 0)
                <div class="col-md-4">
                    <div class="form-group">
                        <label>UPTD</label>
                        <input type="text" name="uptd_id" id="uptd_id" value="{{$detail->data_umum->uptd->nama_uptd}}" class="form-control" required readonly />
                    </div>
                </div>
                @else
                <div class="col-md-4">
                    <div class="form-group">
                        <label>UTPD</label>
                        <input type="text" name="uptd_id" id="uptd_id" value="{{Auth::user()->userDetail->uptd->nama_uptd}}" class="form-control" required readonly />
                    </div>
                </div>
                @endif
            </div>
            <div class="row align-items-start mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Kategori Paket Kegiatan</label>

                        <input type="text" value="{{$detail->data_umum->kategori_paket }}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Kegiatan / Paket</label>
                        <input type="text" name="nm_paket" readonly id="nm_paket" value="{{$detail->data_umum->nm_paket }}" class="form-control" required="" autocomplete="off" style="text-transform: uppercase" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nilai Kontrak</label>
                        <input type="text" name="nilai_kontrak" readonly id="nilaiKontrak" class="form-control" required value="{{ $detail->data_umum->detail->nilai_kontrak }}" autocomplete="off" oninput="formatRupiah(this)" />
                    </div>
                </div>
            </div>
            <div class="row align-items-start mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Kontrak</label>
                        <input type="date" name="tgl_kontrak" readonly value="{{ $detail->data_umum->tgl_kontrak }}" id="tgl_kontrak" class="form-control" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>No. Kontrak</label>
                        <input type="text" name="no_kontrak" readonly id="no_kontrak" class="form-control" value="{{ $detail->data_umum->no_kontrak }}" style="text-transform: uppercase" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>No. SPMK</label>
                        <input type="text" name="no_spmk" readonly id="no_spmk" value="{{ $detail->data_umum->no_spmk }}" class="form-control" required autocomplete="off" style="text-transform: uppercase" />
                    </div>
                </div>
            </div>
            <div class="row align-items-start mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal SPMK</label>
                        <input type="date" name="tgl_spmk" readonly id="tgl_spmk" value="{{ $detail->data_umum->tgl_spmk }}" class="form-control valid" required aria-invalid="false" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Panjang KM</label>
                        <input type="number" step="0.01" readonly name="panjang_km" value="{{ $detail->data_umum->detail->panjang_km }}" id="panjang_km" class="form-control" required autocomplete="off" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Waktu Pelaksanaan</label>
                        <input type="number" step="1" readonly value="{{ $detail->data_umum->detail->lama_waktu }}" name="lama_waktu" id="lama_waktu" class="form-control" required="" autocomplete="off" />
                    </div>
                </div>
            </div>
            <div class="row align-items-start mb-3">
                <div class="col">
                    <div class="form-group">
                        <label>Kontraktor</label>
                        <input type="text" value="{{$detail->data_umum->detail->kontraktor->nama}}" readonly class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Konsultan Supervisi</label>
                        <input type="text" class="form-control" readonly value="{{$detail->data_umum->detail->konsultan->name}}">
                    </div>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col">
                    <div class="form-group">
                        <label>PPK</label>
                        <input type="text" class="form-control" readonly value="{{$detail->data_umum->detail->ppk->nama}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>PPK Kegiatan</label>
                        <input type="text" name="ppk_kegiatan" value="{{$detail->data_umum->ppk_kegiatan}}" readonly class="form-control" required />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('jadual.update',$detail->id) }}" method="post">
        <div class="card">
            <div class="card-header">
                Data Jadual Pekerjaan
            </div>

            <div class="card-body mb-3">
                <div class="row">
                    <canvas id="chartCurva"></canvas>
                </div>

                <div class="contianer text-center">
                    <div class="row" id="dataJadual"></div>
                </div>
                @method('PUT')
                @csrf
                <div class="row" id="upload">
                    <div class="col-md-6 p-2">
                        <div class="form-group">
                            <label>File jadual</label>
                            <div class="input-group">
                                <input accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" class="form-control" id="fileJadual" name="file_jadual" aria-describedby="inputGroupFileAddon04" aria-label="Upload" />
                                <button class="btn btn-success" type="button">
                                    Upload
                                </button>
                            </div>
                        </div>

                        <div class="progress mt-2">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progressUpload">
                                0%
                            </div>
                        </div>

                        <div id="status"></div>
                        <span class="text-danger" style="font-size: small">Format File Salah</span>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-3 mb-5">
            Simpan
        </button>
    </form>
</div>

<div class="modal fade" id="jadualDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteKonsultanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteKonsultanLabel">
                    Detail Jadual Pekerjaan
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table-bordered display">
                    <thead>
                        <th>Tanggal</th>
                        <th>No Mata Pembayaran</th>
                        <th>Harga Satuan</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Bobot</th>
                        <th>Koefisien</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>
@endsection @section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
<script src="{{ asset('assets/custom/jadual.js') }}"></script>
<script>
    $(document).ready(() => {
        $('button[type="submit"]').hide();
        $('#chartCurva').hide();
        $(".card-footer").hide();
        $(".progress").hide();
        $("#fileJadual").change((e) => {
            e.preventDefault();
            $(".col-md-6").removeClass("border border-danger");
            $(".text-danger").hide();
        });

        $(".text-danger").hide();
        $(".btn-success").click((e) => {
            e.preventDefault();
            const file = $("#fileJadual").val();
            if (file == "") {
                $(".col-md-6").addClass("border border-danger");
                $(".text-danger").text("Format File Salah");
                $(".text-danger").show();
                return false;
            }
            if (file.replace(/^.*\./, "") != "xlsx") {
                $(".col-md-6").addClass("border border-danger");
                $(".text-danger").text("Format File Salah");
                $(".text-danger").show();
                return false;
            }

            const formData = new FormData();
            formData.append("jadual_excel_file", $("#fileJadual")[0].files[0]);
            formData.append("id", "{{$detail->data_umum->id}}");
            formData.append("_token", "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('jadual.exceltodata') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                xhr: () => {
                    const xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener(
                        "progress",
                        function(e) {
                            $(".progress").show();
                            const file1Size = $("#fileJadual")[0].files[0].size;
                            let percent = Math.round(
                                (e.loaded / file1Size) * 100
                            );
                            if (e.loaded <= file1Size) {
                                $("#progressUpload")
                                    .width(percent + "%")
                                    .html(percent + "%");
                            }
                            $("#progressUpload")
                                .width(percent + "%")
                                .html(percent + "%");
                        },
                        false
                    );
                    return xhr;
                },
                success: (res) => {
                    $(".progress").hide();
                    nonAdendum(res);
                    $("#upload").hide();
                    $(".card-footer").show();
                    $('#chartCurva').show();
                    $('button[type="submit"]').show();
                },
                error: (error) => {
                    console.log(error);
                    $(".progress").hide();
                    $("#upload").addClass("border border-danger");
                    $(".text-danger").text('Format File Salah');
                    $(".text-danger").show();
                },
            });
        });
    });
    $(".btn-warning").click(() => {
        location.reload();
    });
</script>
@endsection