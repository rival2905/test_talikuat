@extends('layouts.app') @section('content')
<div class="container">
    <div class="card ">
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
                           
                            <td>{{$data->detail->kontraktor->nama ?? ""}}</td>
                            <td>{{$data->detail->konsultan->name ?? ""}}</td>
                            <td>{{$data->detail->ppk->nama ?? ''}}</td>
                            <td>
                        <a class="btn btn-mat btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#modalAction"
                                data-id="{{ $data->id }}"
                                onclick="handleAction(this)"
                        >
                            Proses
                        </a>
                                {{-- <div class="flex space-x-1 space-y-2 justify-center">
                                    <a href="{{route('data-umum.show',$data->id) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Detail"
                                        class="btn btn-mat btn-success waves-effect waves-light"><i
                                            class="bx bx-search-alt-2"></i></a>
                                    @if (Auth::user()->userDetail->role != 7 && date('Y') == $data->thn)
                                    <a href="{{ route('data-umum.edit', $data->id) }}"
                                        class="btn btn-mat btn-warning waves-effect waves-light"><i
                                            class="bx bx-edit-alt"></i></a>
                                    @endif
                                    <a href="{{route('upload.dataumum',$data->id)}}"
                                        class="btn btn-mat btn-primary waves-effect waves-light"><i
                                            class="bx bxs-file-doc"></i></a>
                                    @if (Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 2 || Auth::user()->userDetail->role ==5)
                                    <a href="{{ route('penilaian-penyedia.index', $data->id) }}"
                                        class="btn btn-mat btn-warning waves-effect waves-light mt-1"><i
                                            class='bx bxs-file-doc'></i>
                                    </a>
                                    @endif
                                    @if (Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 2 || Auth::user()->userDetail->role ==5)
                                    <a href="{{route('admin.data-umum.document-category.show',$data->id) }}"
                                        class="btn btn-mat btn-sm btn-success waves-effect waves-light">KKK</a>
                                    @endif
                                </div> --}}

                                {{-- <div class="flex space-x-1 space-y-2 justify-center">
                                    <a href="{{route('data-umum.show',$data->id) }}"
                                        class="btn btn-mat btn-success waves-effect waves-light fs-6">Detail</a>
                                    @if (Auth::user()->userDetail->role != 7 && date('Y') == $data->thn)
                                    <a href="{{ route('data-umum.edit', $data->id) }}"
                                        class="btn btn-mat btn-warning waves-effect waves-light fs-6">Edit</a>
                                    @endif
                                    <a href="{{route('upload.dataumum',$data->id)}}"
                                        class="btn btn-mat btn-primary waves-effect waves-light fs-6">Dokumen Kontrak</a>
                                    @if (Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 2 || Auth::user()->userDetail->role ==5)
                                    <a href="{{ route('penilaian-penyedia.index', $data->id) }}"
                                        class="btn btn-mat btn-warning waves-effect waves-light mt-1 fs-6">Penilaian Penyedia
                                    </a>
                                    @endif
                                    @if (Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 2 || Auth::user()->userDetail->role ==5)
                                    <a href="{{route('admin.data-umum.document-category.show',$data->id) }}"
                                        class="btn btn-mat btn-sm btn-success waves-effect waves-light fs-6">Kendali Kontrak</a>
                                    @endif
                                </div> --}}

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalAction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalActionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalActionLabel">Pilih</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body d-flex justify-content-center align-items-center">
        
                <div class="d-flex  justify-center flex-wrap gap-1 ">
                    <a href="{{route('data-umum.show',0) }}"
                     class="btn btn-mat btn-success waves-effect waves-light fs-6" >Detail</a>
                 @if (Auth::user()->userDetail->role != 7 && date('Y') == $data->thn)
                 <a href="{{ route('data-umum.edit', 0) }}"
                     class="btn btn-mat btn-warning waves-effect waves-light ">Edit</a>
                 @endif
                 <a href="{{route('upload.dataumum',0)}}"
                     class="btn btn-mat btn-primary waves-effect waves-light ">Dokumen Kontrak</a>
                 @if (Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 2 || Auth::user()->userDetail->role ==5)
                 <a href="{{ route('penilaian-penyedia.index', 0) }}"
                     class="btn btn-mat btn-danger waves-effect waves-light ">Penilaian Penyedia
                 </a>
                 @endif
                 @if (Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 2 || Auth::user()->userDetail->role ==5)
                 <a href="{{route('admin.data-umum.document-category.show',0) }}"
                     class="btn btn-mat  btn-info waves-effect waves-light ">Kendali Kontrak</a>
                 @endif
             </div>
            </div>
            
        </div>

    </div>
</div>
<div class="modal fade" id="dataThn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="dataThnLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="dataThnLabel">Pilih Tahun Database</h1>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Tahun</label>
                    <select name="thn" id="thn" class="form-control" required>
                        <option value="">-- Pilih Tahun --</option>
                        @foreach ($thn as $item)
                        <option value="{{$item}}">{{$item}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="btn" id="submit" class="btn btn-success">Submit</button>
            </div>
        </div>

    </div>
</div>
@endsection @section('scripts')
<script>
    $(document).ready(function() {
        const url = `{{ route('data-umum.index',1) }}`.replace('1', '')
        $("#table").DataTable({
            responsive: true,
            autoWidth: false,
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
        console.log(event);
        const id = event.getAttribute('data-id');
        console.log(id);
        const urlShow = `{{ route('data-umum.show',1) }}`.replace('1', id)
        const urlEdit = `{{ route('data-umum.edit',1) }}`.replace('1', id)
        const urlUpload = `{{ route('upload.dataumum',1) }}`.replace('1', id)
        const urlPenilaian = `{{ route('penilaian-penyedia.index',1) }}`.replace('1', id)
        const urlKendali = `{{ route('admin.data-umum.document-category.show',1) }}`.replace('1', id)

        const modal = document.getElementById('modalAction');
        const links = modal.querySelectorAll('a');

        links[0].setAttribute('href', urlShow);
        links[1].setAttribute('href', urlEdit);
        links[2].setAttribute('href', urlUpload);
        links[3].setAttribute('href', urlPenilaian);
        links[4].setAttribute('href', urlKendali);
    }
</script>
@endsection