@extends('layouts.app') @section('content')
<div class="container">
    <form id="updateDataUmum" action="{{ route('data-umum.update',$data_umum->id) }}" method="post">
        @csrf @method('PUT')
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
                            <select name="uptd_id" class="form-select">
                                @foreach ($uptds as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama_uptd }}
                                </option>
                                @endforeach
                            </select>
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

                            <select name="kategori_paket_id" required>
                                @if($data_umum->kategori_paket)
                                <option value="{{$data_umum->kategori_paket }}" selected>
                                    {{$data_umum->kategori_paket }}
                                </option>
                                @endif
                                <option value="">Pilih Kategori Paket</option>
                                <option value="Pembangunan Jalan">
                                    Pembangunan Jalan
                                </option>
                                <option value="Pelebaran Jalan Menuju Standar">
                                    Pelebaran Jalan Menuju Standar
                                </option>
                                <option value="Pelebaran Jalan Menambah Jalur">
                                    Pelebaran Jalan Menambah Jalur
                                </option>
                                <option value="Rekonstruksi Jalan">
                                    Rekonstruksi Jalan
                                </option>
                                <option value="Rehabilitasi Jalan">
                                    Rehabilitasi Jalan
                                </option>
                                <option value="Pemeliharaan Berkala Jalan">
                                    Pemeliharaan Berkala Jalan
                                </option>
                                <option value="Pembangunan Jembatan">
                                    Pembangunan Jembatan
                                </option>
                                <option value="Pembangunan Flyover">
                                    Pembangunan Flyover
                                </option>
                                <option value="Pembangunan Underpass">
                                    Pembangunan Underpass
                                </option>
                                <option value="Pembangunan Terowongan/Tunnel">
                                    Pembangunan Terowongan/Tunnel
                                </option>
                                <option value="Penggantian Jembatan">
                                    Penggantian Jembatan
                                </option>
                                <option value="Pelebaran Jembatan">
                                    Pelebaran Jembatan
                                </option>
                                <option value="Rehabilitasi Jembatan">
                                    Rehabilitasi Jembatan
                                </option>
                                <option value="Pemeliharaan Berkala Jembatan">
                                    Pemeliharaan Berkala Jembatan
                                </option>
                                <option value="Penanggulangan Bencana/Tanggap Darurat">
                                    Penanggulangan Bencana/Tanggap Darurat
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Kegiatan / Paket</label>
                            <input type="text" name="nm_paket" id="nm_paket" value="{{$data_umum->nm_paket }}" class="form-control" required="" autocomplete="off" style="text-transform: uppercase" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nilai Kontrak</label>
                            <input type="text" name="nilai_kontrak" id="nilaiKontrak" class="form-control" required value="{{ $data_umum->detail->nilai_kontrak }}" autocomplete="off" oninput="formatRupiah(this)" />
                        </div>
                    </div>
                </div>
                <div class="row align-items-start mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Kontrak</label>
                            <input type="date" name="tgl_kontrak" value="{{ $data_umum->tgl_kontrak }}" id="tgl_kontrak" class="form-control" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>No. Kontrak</label>
                            <input type="text" name="no_kontrak" id="no_kontrak" class="form-control" value="{{ $data_umum->no_kontrak }}" style="text-transform: uppercase" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>No. SPMK</label>
                            <input type="text" name="no_spmk" id="no_spmk" value="{{ $data_umum->no_spmk }}" class="form-control" required autocomplete="off" style="text-transform: uppercase" />
                        </div>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal SPMK</label>
                            <input type="date" name="tgl_spmk" id="tgl_spmk" value="{{ $data_umum->tgl_spmk }}" class="form-control valid" required aria-invalid="false" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Panjang KM</label>
                            <input type="number" step="0.01" name="panjang_km" value="{{ $data_umum->detail->panjang_km }}" id="panjang_km" class="form-control" required autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Waktu Pelaksanaan</label>
                            <input type="number" step="1" value="{{ $data_umum->detail->lama_waktu }}" name="lama_waktu" id="lama_waktu" class="form-control" required="" autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">Ruas Jalan</div>
            <div class="card-body">
                <div class="container">
                    <div class="mb-4 d-flex">
                        <div class="mr-2 w-50">
                            <select id="ruasJalan" required>
                                <option value="">Pilih Ruas Jalan</option>
                                @foreach ($ruas as $item)
                                @if($data_umum->detail->ruas[0]->ruas_id == $item->id_ruas_jalan)
                                <option value="{{$item->id_ruas_jalan}}" selected>
                                    {{ $item->id_ruas_jalan }} -
                                    {{ $item->nama_ruas_jalan }}
                                </option>
                                @endif

                                <option value="{{$item->id_ruas_jalan}}">
                                    {{ $item->id_ruas_jalan }} -
                                    {{ $item->nama_ruas_jalan }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="ms-2">
                            <button type="button" class="btn btn-success" id="tambahRuas">
                                Tambah
                            </button>
                        </div>
                    </div>

                    <table class="table table-bordered" id="tableRuas">
                        <thead>
                            <th>Kode Ruas Jalan</th>
                            <th>Segmen Jalan</th>
                            <th>Koordinat Awal Lat</th>
                            <th>Koordinat Awal Long</th>
                            <th>Koordinat Akhir Lat</th>
                            <th>Koordinat Akhir Long</th>
                            <th>Cek Lokasi</th>
                            <th>Hapus</th>
                        </thead>

                        <tbody>
                            @foreach ($data_umum->detail->ruas as $item)
                            <tr>
                                <td><input type="text" class="form-control" name="id_ruas_jalan[]" value="{{$item->ruas_id}}" autocomplete="off" required readonly></td>
                                <td><input type="text" class="form-control" name="segmen_jalan[]" value="{{$item->segment_jalan}}" autocomplete="off" placeholder="Km Bdg... s/d Km...Bdg" required></td>
                                <td><input type="text" class="form-control" name="lat_awal[]" value="{{$item->lat_awal}}" autocomplete="off" placeholder="-7.123456" required></td>
                                <td><input type="text" class="form-control" name="long_awal[]" value="{{$item->long_awal}}" autocomplete="off" placeholder="107.12345" required></td>
                                <td><input type="text" class="form-control" name="lat_akhir[]" value="{{$item->lat_akhir}}" autocomplete="off" placeholder="-7.12345" required></td>
                                <td><input type="text" class="form-control" name="long_akhir[]" value="{{$item->long_akhir}}" autocomplete="off" placeholder="107.12345" required></td>
                                <td><button type="button" onclick="checkLok(this)" class="btn btn-primary">Lokasi</button></td>
                                <td><button type="button" class="btn btn-danger" onclick="remove(this)">Delete</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Data Anggota</div>
            <div class="card-body">
                <div class="row align-items-start mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label>Kontraktor</label>
                            <select name="kontraktor_id" id="kontraktor_id" class="form-control" required>

                                @foreach($kontraktors as $item)
                                @if($data_umum->detail->kontraktor_id == $item->id)
                                <option value="{{ $item->id }}" selected>
                                    {{ $item->nama }}
                                </option>
                                @endif
                                <option value="{{ $item->id }}">
                                    {{ $item->nama }}
                                </option>

                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Konsultan Supervisi</label>
                            <select name="konsultan_id" id="konsultan_id" required>

                                @foreach($konsultans as $item)
                                @if($data_umum->detail->konsultan_id == $item->id)
                                <option value="{{ $item->id }}" selected>
                                    {{ $item->name }}
                                </option>
                                @endif
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col">
                        <div class="form-group">
                            <label>PPK</label>
                            <select name="ppk_user_id" id="ppk" class="form-control" required>
                                <option value="">Pilih PPK</option>
                                @foreach($ppks as $item)
                                @if($data_umum->detail->ppk_id == $item->user->id)
                                <option value="{{ $item->user->id }}" selected>
                                    {{ $item->user->name }}
                                </option>
                                @endif
                                <option value="{{ $item->user->id }}">
                                    {{ $item->user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>PPK Kegiatan</label>
                            <input type="text" name="ppk_kegiatan" value="{{$data_umum->ppk_kegiatan}}" class="form-control" required />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-3">
            <div class="col"><button type="submit" class="btn btn-success  w-100">Update</button></div>
            <div class="col"><a href="{{route('upload.dataumum',$data_umum->id)}}" class="btn btn-warning  w-100">Upload File</a></div>
            <div class="col"><button type="button" data-bs-toggle="modal" data-bs-target="#adendumModal" class="btn btn-dark  w-100" data-id="{{$data_umum->detail->id}}" onclick="adendum(this)">Adendum</button></div>
        </div>
    </form>
</div>
<div class="modal fade" id="adendumModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="adendumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="adendumModalLabel">
                    Adendum
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menambah adendum ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Close
                </button>
                <a class="btn btn-success" onclick="submitForm()">Ya</a>
            </div>
        </div>
    </div>
</div>
@endsection @section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<script>
    $(document).ready(function() {
        $("select").selectize({
            sortField: "text",
        });
    });

    function adendum(el) {
        const url = "{{route('adendum.create', ':id')}}";
        const id = $(el).data("id");
        $("#updateDataUmum").attr("action", url.replace(":id", id));
    }

    function submitForm(el) {
        $('#updateDataUmum').submit();
    }

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
    $("#tambahRuas").click(function() {
        var text = $("#ruasJalan").val();

        $("#tableRuas tbody").append(`
        <tr>
        <td><input type="text" class="form-control" name="id_ruas_jalan[]" value="${text}" autocomplete="off" required readonly></td>
        <td><input type="text" class="form-control" name="segmen_jalan[]" autocomplete="off" placeholder="Km Bdg... s/d Km...Bdg" required></td>
        <td><input type="text" class="form-control"  name="lat_awal[]" autocomplete="off" placeholder="-7.123456" required></td>
        <td><input type="text" class="form-control"  name="long_awal[]" autocomplete="off" placeholder="107.12345" required></td>
        <td><input type="text" class="form-control" name="lat_akhir[]" autocomplete="off" placeholder="-7.12345" required></td>
        <td><input type="text" class="form-control" name="long_akhir[]" autocomplete="off" placeholder="107.12345" required></td>
        <td><button type="button" onclick="checkLok(this)" class="btn btn-primary">Lokasi</button></td>
        <td><button type="button" class="btn btn-danger" onclick="remove(this)">Delete</button></td>
        </tr>`);
    });

    function remove(el) {
        $(el).closest("tr").remove();
    }

    function PopupCenter(url, title, w, h) {
        var dualScreenLeft =
            window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop =
            window.screenTop != undefined ? window.screenTop : screen.top;

        width = window.innerWidth ?
            window.innerWidth :
            document.documentElement.clientWidth ?
            document.documentElement.clientWidth :
            screen.width;
        height = window.innerHeight ?
            window.innerHeight :
            document.documentElement.clientHeight ?
            document.documentElement.clientHeight :
            screen.height;

        var left = width / 2 - w / 2 + dualScreenLeft;
        var top = height / 2 - h / 2 + dualScreenTop;
        var newWindow = window.open(
            url,
            title,
            "scrollbars=no, width=" +
            w +
            ", height=" +
            h +
            ", top=" +
            top +
            ", left=" +
            left
        );

        // Puts focus on the newWindow
        if (window.focus) {
            newWindow.focus();
        }
    }

    function checkLok(e) {
        var parents = $(e).closest("tr");
        var row = parents.find("input");
        var latawal = row[2].value;
        var longawal = row[3].value;
        var latakhir = row[4].value;
        var longakhir = row[5].value;
        var url = "https://www.google.com/maps/dir/?api=1";
        var origin = "&origin=" + latawal + "," + longawal;
        var destination = "&destination=" + latakhir + "," + longakhir;
        var newUrl = new URL(url + origin + destination);
        PopupCenter(newUrl, "Google Maps", 1200, 650);
    }
</script>
@endsection