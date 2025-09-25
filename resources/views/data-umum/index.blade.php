@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card rounded-4 shadow-lg border-0">
        <div class="card-header p-3 fw-bold text-white" style="background: #1e3c72;">
            Data Umum
        </div>
        <div class="card-body p-4">
            <div class="mb-3 d-flex gap-2 flex-wrap">
    @if (Auth::user()->userDetail->role != 7)
    <a href="{{ route('data-umum.create') }}" class="btn btn-primary btn-md rounded-pill shadow-sm">
        <i class="mdi mdi-account-plus me-1"></i> Tambah
    </a>
    @endif
    <a class="btn btn-warning btn-md rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#dataThn">
        <i class="mdi mdi-calendar-range me-1"></i> Pilih Tahun Database
    </a>
    <a href="{{ route('admin.du-dc.export-rekap',$year) }}" target="_blank"
       class="btn btn-success btn-md rounded-pill shadow-sm">
       <i class="mdi mdi-file-download-outline me-1"></i> Rekap Kendali Kontrak
    </a>
</div>


            <div style="max-height:70vh; overflow-y:auto;">
                <table class="table table-striped table-hover align-middle text-center" id="table">
                    <thead class="table-light fw-semibold" style="background: #1e3c72; color:white;">
                        <tr>
                            <th>ID</th>
                            <th>Nama Kegiatan</th>
                            <th>Kontraktor</th>
                            <th>Konsultan</th>
                            <th>PPK</th>
                            <th class="text-wrap">Nilai Kendali Kontrak</th>
                            <th style="width:20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_umums as $data)
                        <tr class="align-middle">
                            <td class="fw-semibold">{{$data->id}}</td>
                            <td class="text-uppercase fw-semibold">{{$data->nm_paket}}</td>
                            <td>{{$data->detail->kontraktor->nama ?? ""}}</td>
                            <td>{{$data->detail->konsultan->name ?? ""}}</td>
                            <td>{{$data->detail->ppk->nama ?? ''}}</td>
                            <td class="text-wrap">
                                @if ($data->duDc()->where('is_active', 1)->count() >0)
                                    {{$data->nkk}}%
                                    <br>
                                    {{ $data->duDc()->where('score', 100)->where('is_active', 1)->count() }}/{{ $data->duDc()->where('is_active', 1)->count() }} Doc
                                @else
                                    <span class="badge bg-danger">Undefine</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-warning btn-sm rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAction"
                                   data-id="{{ $data->id }}" onclick="handleAction(this)">
                                   Proses
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Modal Pilih Tahun -->
<div class="modal fade" id="dataThn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="dataThnLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="dataThnLabel">Pilih Tahun Database</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <select name="thn" id="thn" class="form-control" required>
                    <option value="">-- Pilih Tahun --</option>
                    @foreach ($thn as $item)
                    <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" id="submit" class="btn btn-success btn-lg rounded-pill shadow-sm">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Action -->
<div class="modal fade" id="modalAction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="modalActionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="modalActionLabel">Pilih</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center">
                <div class="d-flex justify-center flex-wrap gap-2">
                    <a href="#" class="btn btn-success btn-lg rounded-pill shadow-sm fs-6">Detail</a>
                    <a href="#" class="btn btn-warning btn-lg rounded-pill shadow-sm fs-6">Edit</a>
                    <a href="#" class="btn btn-primary btn-lg rounded-pill shadow-sm fs-6">Dokumen Kontrak</a>
                    <a href="#" class="btn btn-danger btn-lg rounded-pill shadow-sm fs-6">Penilaian Penyedia</a>
                    <a href="#" class="btn btn-info btn-lg rounded-pill shadow-sm fs-6">Kendali Kontrak</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    const url = `{{ route('data-umum.index',1) }}`.replace('1', '')
    $("#table").DataTable({
        responsive: true,
        autoWidth: false,
        lengthChange: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari data umum..."
        },
        rowCallback: function(row, data) {
            $(row).hover(
                function() { $(this).css('background-color','#f0f8ff'); },
                function() { $(this).css('background-color',''); }
            );
        }
    });

    $('#submit').click(function() {
        var thn = $('#thn').val();
        if (thn != '') {
            window.location.href = url + thn;
        } else {
            alert('Pilih Tahun Database');
        }
    });
});

function handleAction(event) {
    const id = event.getAttribute('data-id');
    const urls = [
        `{{ route('data-umum.show',1) }}`.replace('1', id),
        `{{ route('data-umum.edit',1) }}`.replace('1', id),
        `{{ route('upload.dataumum',1) }}`.replace('1', id),
        `{{ route('penilaian-penyedia.index',1) }}`.replace('1', id),
        `{{ route('admin.data-umum.document-category.show',1) }}`.replace('1', id),
    ];
    const modal = document.getElementById('modalAction');
    const links = modal.querySelectorAll('a');
    links.forEach((link,i) => link.setAttribute('href', urls[i]));
}
</script>
@endsection
