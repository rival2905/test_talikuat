@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card rounded-4 shadow-lg border-0">
        <div class="card-header p-3 fw-bold text-white" style="background: #1e3c72;">
            Daftar Jadwal
        </div>
        <div class="card-body p-4">
            <div style="max-height:70vh; overflow-y:auto;">
                <table class="table table-striped table-hover align-middle text-center" id="table">
                    <thead class="table-light fw-semibold" style="background: #1e3c72; color:white;">
                        <tr>
                            <th style="width: 8%">ID</th>
                            <th>Nama Kegiatan</th>
                            <th>UPTD</th>
                            <th>Kontraktor</th>
                            <th>Konsultan</th>
                            <th>PPK</th>
                            <th style="width:20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_umum as $data)
                        <tr>
                            <td class="fw-semibold">{{ $data->id }}</td>
                            <td class="text-uppercase fw-semibold">
                                {{ $data->nm_paket }}
                                @if(str_contains($data->detail->keterangan ?? '', "Adendum"))
                                    ( {{ $data->detail->keterangan }} )
                                @endif
                            </td>
                            <td>{{ $data->uptd->nama_uptd ?? '-' }}</td>
                            <td>{{ $data->detail->kontraktor->nama ?? '-' }}</td>
                            <td>{{ $data->detail->konsultan->name ?? '-' }}</td>
                            <td>{{ $data->detail->ppk->name ?? '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    @if($data->detail->jadual->count() == 0)
                                        @if (Auth::user()->userDetail->role != 7)
                                        <a href="{{ route('jadual.create', $data->detail->id) }}" 
                                           class="btn btn-warning btn-sm shadow-sm rounded-pill" 
                                           data-bs-toggle="tooltip" data-bs-placement="bottom" title="Upload Jadwal">
                                           <i class='bx bxs-calendar-alt'></i>
                                        </a>
                                        @else
                                        <span class="text-muted">Belum Diupload</span>
                                        @endif
                                    @else
                                        <a href="{{ route('jadual.show', $data->detail->id) }}" 
                                           class="btn btn-success btn-sm shadow-sm rounded-pill" 
                                           data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail">
                                           <i class="bx bx-search-alt-2"></i>
                                        </a>
                                        @if (Auth::user()->userDetail->role != 7)
                                        <a href="{{ route('jadual.edit', $data->detail->id) }}" 
                                           class="btn btn-warning btn-sm shadow-sm rounded-pill" 
                                           data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                           <i class="bx bx-edit-alt"></i>
                                        </a>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $("#table").DataTable({
        responsive: true,
        autoWidth: false,
        lengthChange: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari jadwal..."
        }
    });
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>
@endsection
