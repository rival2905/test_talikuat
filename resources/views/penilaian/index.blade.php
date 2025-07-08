@extends('layouts.app') @section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="container">
                @if (Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 5)
                <a href="{{ route('penilaian-penyedia.create',$data_umum->id) }}" class="btn btn-mat btn-primary mb-3">
                    <i class="mdi mdi-account-plus menu-icon"></i>
                    Tambah Penilaian Penyedia
                </a>

                @endif
            </div>
            <div class="container">
                <table class="table table-bordered table-striped" id="table">
                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th>ID Paket</th>
                            <th>Nama Kegiatan</th>
                            <th>kontraktor</th>
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
                            <td>{{ $data_umum->detail->ppk->nama}}</td>
                            <td>{{ $data->nilai }} / {{ $data->bobot }}</td>

                            <td>
                                <a href="{{ route('penilaian-penyedia.show', $data->id) }}"
                                    class="btn btn-sm btn-primary" target="_blank">
                                    <i class="mdi mdi-print menu-icon"></i>
                                    Cetak
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
@endsection @section('scripts')


@endsection