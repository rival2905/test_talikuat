@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="card rounded-4 shadow-lg border-0">
                <div class="card-header p-3 fw-bold text-white" style="background: #1e3c72;">
                    Penilaian Penyedia - {{ $data_umum->nm_paket }}
                </div>
                <div class="card-body p-4">
                    <div class="mb-3 d-flex justify-content-end">
                        @if (Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 5)
                        <a href="{{ route('penilaian-penyedia.create', $data_umum->id) }}" 
                           class="btn btn-primary btn-lg shadow-sm rounded-pill">
                           <i class="bx bx-plus me-1"></i> Tambah Penilaian
                        </a>
                        @endif
                    </div>

                    <div style="max-height:70vh; overflow-y:auto;">
                        <table class="table table-striped table-hover align-middle text-center" id="table">
                            <thead class="table-light fw-semibold" style="background: #1e3c72; color: white;">
                                <tr>
                                    <th style="width:5%">No</th>
                                    <th>Periode</th>
                                    <th>ID Paket</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Kontraktor</th>
                                    <th>PPK</th>
                                    <th style="width:10%">Skor</th>
                                    <th style="width:20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_umum->penilaianPenyedia as $no => $data)
                                <tr>
                                    <td class="fw-semibold">{{ ++$no }}</td>
                                    <td>{{ $data->periode }}</td>
                                    <td>{{ $data->dataUmum->id }}</td>
                                    <td class="text-uppercase fw-bold">{{ $data->dataUmum->nm_paket }}</td>
                                    <td>{{ $data->kontraktor->nama }}</td>
                                    <td>{{ $data_umum->detail->ppk?->name ?? '-' }}</td>
                                    <td>{{ $data->nilai }} / {{ $data->bobot }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <a href="{{ route('penilaian-penyedia.show', $data->id) }}" 
                                               class="btn btn-sm btn-primary shadow-sm rounded-pill" target="_blank">
                                               <i class="bx bx-printer me-1"></i> Cetak
                                            </a>
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
                searchPlaceholder: "Cari penilaian..."
            }
        });
    });
</script>
@endsection
