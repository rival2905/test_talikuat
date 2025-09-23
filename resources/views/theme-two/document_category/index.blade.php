@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="input-group-prepend">
                            <a href="{{ route('admin.category.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                        </div>
        
                        <table class="table table-bordered table-striped mt-3" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $no => $data)
                                <tr>
                                    <td>{{++$no}}</td>
                                    <td>{{$data->code}}</td>
                                    <td class="text-uppercase">{{$data->name}}</td>
                                    <td>{{$data->slug}}</td>
                                    <td>
                                        

                                        <div class="flex space-x-1 space-y-2 justify-center">
                                            <a href="{{ Route('admin.category.edit',$data->id) }}" class="btn btn-mat btn-success waves-effect waves-light">
                                                <i class="bx bx-edit"></i>
                                            </a>    
                                            @if (Auth::user()->userDetail->role == 1)
                                                @if ($data->is_active)
                                                <a href="{{ route('admin.category.updateStatus', $data->id) }}" class="btn btn-mat btn-success">Active</a>
                                                @else
                                                <a href="{{ route('admin.category.updateStatus', $data->id) }}" class="btn btn-mat btn-danger">Non-Active</a>
    
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