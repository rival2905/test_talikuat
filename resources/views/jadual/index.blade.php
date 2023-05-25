@extends('layouts.app') @section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <table class="table table-bordered table-striped" id="table">
                    <thead>
                        <tr>
                            <th style="width: 13%">ID</th>
                            <th>Nama Kegiatan</th>

                            <th>UPTD</th>
                            <th>kontraktor</th>
                            <th>Konsultan</th>
                            <th>PPK</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_umum as $data)

                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->nm_paket}}@if(str_contains($data->detail->keterangan,"Adendum")) ( {{$data->detail->keterangan}} )@endif</td>

                            <td>{{$data->uptd->nama_uptd}}</td>
                            <td>{{$data->detail->kontraktor->nama}}</td>
                            <td>{{$data->detail->konsultan->name}}</td>
                            <td>{{$data->detail->ppk->nama}}</td>
                            <td>
                                @if($data->detail->jadual->count() ==0)
                                @if (Auth::user()->userDetail->role != 7)
                                <a href="{{route('jadual.create',$data->detail->id)}}" class="btn btn-mat btn-warning waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Upload Jadual"><i class='bx bxs-calendar-alt'></i></a>
                                @else
                                Belum Diupload
                                @endif
                                @else

                                <a href="{{route('jadual.show',$data->detail->id)}}" class="btn btn-mat btn-success waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Detail"><i class="bx bx-search-alt-2"></i></a>
                                @if (Auth::user()->userDetail->role != 7)
                                <a href="{{route('jadual.edit',$data->detail->id)}}" class="btn btn-mat btn-warning waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit"><i class="bx bx-edit-alt"></i></a>
                                @endif
                                @endif


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