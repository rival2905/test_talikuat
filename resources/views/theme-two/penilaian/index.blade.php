@extends('layouts.app')

@section('content')
<div class="d-flex flex-column vh-100">
    <!-- Header bagian atas -->
    <div class="py-3 px-4 bg-light border-bottom">
        @if (Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 5)
        <a href="{{ route('penilaian-penyedia.create', $data_umum->id) }}" class="btn btn-primary">
            <i class="mdi mdi-account-plus menu-icon"></i>
            Tambah Penilaian Penyedia
        </a>
        @endif
    </div>

    <div class="flex-grow-1 overflow-auto px-4 pb-4">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table">
                <thead class="table-light">
                    <tr>
                        <th>Periode</th>
                        <th>ID Paket</th>
                        <th>Nama Kegiatan</th>
                        <th>Kontraktor</th>
                        <th>PPK</th>
                        <th style="width: 10%">Skor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_umum->penilaianPenyedia as $data)
                    <tr>
                        <td>{{ $data->periode }}</td>
                        <td>{{ $data->dataUmum->id }}</td>
                        <td>{{ $data->dataUmum->nm_paket }}</td>
                        <td>{{ $data->kontraktor->nama }}</td>
                        <td>{{ $data_umum->detail->ppk->nama }}</td>
                        <td>{{ $data->nilai }} / {{ $data->bobot }}</td>
                        <td>
                            <a href="{{ route('penilaian-penyedia.show', $data->id) }}" class="btn btn-sm btn-primary"
                                target="_blank">
                                <i class="mdi mdi-print menu-icon"></i> Cetak
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
        });

   
    });
</script>
@endsection