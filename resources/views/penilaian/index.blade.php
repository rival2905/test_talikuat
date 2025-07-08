@extends('layouts.app') @section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="container">
                @if (Auth::user()->userDetail->role != 7)
                <a href="{{ route('data-umum.create') }}" class="btn btn-mat btn-primary mb-3">
                    <i class="mdi mdi-account-plus menu-icon"></i>
                    Tambah</a>

                @endif
                <a class="btn btn-mat btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#dataThn">
                    Pilih Tahun Database
                </a>
            </div>
            <div class="container">
                <table class="table table-bordered table-striped" id="table">
                    <thead>
                        <tr>
                            <th>ID Paket</th>
                            <th>Nama Kegiatan</th>
                            <th>kontraktor</th>
                            <th>PPK</th>
                            <th>Score</th>
                            <th style="width: 13%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr>
                            {{-- <td>{{$data->id}}</td>
                            <td class="text-uppercase">{{$data->nm_paket}}</td>
                            <td>{{$data->detail->kontraktor->nama}}</td>
                            <td>{{$data->detail->ppk->nama ?? ''}}</td>
                            <td>{{$data->detail->score ?? ''}}</td> --}}
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