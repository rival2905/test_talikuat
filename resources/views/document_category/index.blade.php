@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="card rounded-4 shadow-lg border-0">
                <div class="card-header p-3 fw-bold text-white" style="background: #1e3c72;">
                    Daftar Kategori
                </div>
                <div class="card-body p-4">
                    <div class="mb-3 d-flex justify-content-end">
                        <a href="{{ route('admin.category.create') }}" 
                           class="btn btn-primary btn-lg shadow-sm rounded-pill">
                           <i class="bx bx-plus me-1"></i> Tambah Kategori
                        </a>
                    </div>

                    <div style="max-height:70vh; overflow-y:auto;">
                        <table class="table table-striped table-hover align-middle text-center" id="table">
                            <thead class="table-light fw-semibold" style="background: #1e3c72; color: white;">
                                <tr>
                                    <th style="width:5%">No</th>
                                    <th style="width:10%">Code</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th style="width:20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $no => $data)
                                <tr>
                                    <td class="fw-semibold">{{ ++$no }}</td>
                                    <td class="fw-semibold">{{ $data->code }}</td>
                                    <td class="text-uppercase fw-bold">{{ $data->name }}</td>
                                    <td class="text-muted">{{ $data->slug }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <a href="{{ route('admin.category.edit',$data->id) }}" 
                                               class="btn btn-warning btn-sm shadow-sm rounded-pill">
                                               <i class="bx bx-edit me-1"></i> Edit
                                            </a>    
                                            @if (Auth::user()->userDetail->role == 1)
                                                @if ($data->is_active)
                                                <a href="{{ route('admin.category.updateStatus', $data->id) }}" 
                                                   class="btn btn-success btn-sm shadow-sm rounded-pill">
                                                   Active
                                                </a>
                                                @else
                                                <a href="{{ route('admin.category.updateStatus', $data->id) }}" 
                                                   class="btn btn-danger btn-sm shadow-sm rounded-pill">
                                                   Non-Active
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
                searchPlaceholder: "Cari kategori..."
            }
        });
    });
</script>
@endsection
