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
            </div>
            <div class="container">
                <table class="table table-bordered table-striped" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kegiatan</th>
                            <th>kontraktor</th>
                            <th>Konsultan</th>
                            <th>PPK</th>
                            <th style="width: 13%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_umums as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td class="text-uppercase">{{$data->nm_paket}}</td>
                            <td>{{$data->detail->kontraktor->nama}}</td>
                            <td>{{$data->detail->konsultan->name}}</td>
                            <td>{{$data->detail->ppk->nama}}</td>
                            <td>
                                <a href="{{route('data-umum.show',$data->id) }}" class="btn btn-mat btn-success waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Detail"><i class="bx bx-search-alt-2"></i></a>
                                @if (Auth::user()->userDetail->role != 7)
                                <a href="{{ route('data-umum.edit', $data->id) }}" class="btn btn-mat btn-warning waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit"><i class="bx bx-edit-alt"></i></a>
                                @endif
                                <a href="{{route('upload.dataumum',$data->id)}}" class="btn btn-mat btn-primary waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Data Kontrak"><i class="bx bxs-file-doc"></i></a>

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
<script>
    $(document).ready(function() {
        $("#table").DataTable({
            responsive: true,
            autoWidth: false,
        });
    });
</script>
@endsection