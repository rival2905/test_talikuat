@extends('layouts.app') @section('content')
<div class="container">
    @foreach($dataUmum as $data)
    <div class="card mb-3" style="max-height: 100vh; overflow-y: auto;">
        <div class="card-body">
            <h5 class="card-title">{{$data->id}} - {{$data->nm_paket}} </h5>

            @if(Auth::user()->userDetail->role != 6 && Auth::user()->userDetail->role != 4)
            <a href="{{route('laporan-mingguan-uptd.create',$data->id)}}"
                class="btn btn-mat btn-dark waves-effect waves-light" data-bs-toggle="tooltip"
                data-bs-placement="bottom" data-bs-title="Buat Laporan Mingguan">Buat Laporan<i
                    class="bx bxs-file-doc"></i></a>
            @endif
            <hr>
            <div class="container mt-2">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th>Rencana</th>
                            <th>Realisasi</th>
                            <th>Deviasi</th>
                            <th>Status</th>
                            <th style="width: 13%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->laporanUptd as $laporan)
                        <tr>
                            <td>{{$laporan->priode}}</td>
                            <td>{{$laporan->rencana}}</td>
                            <td>{{$laporan->realisasi}}</td>
                            <td>{{$laporan->deviasi}}</td>
                            <td>
                                @if($laporan->status == 0)
                                <span class="badge bg-warning">Belum Disetujui</span>
                                @elseif($laporan->status == 1)
                                <span class="badge bg-success">Disetujui</span>
                                @else
                                <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-mat btn-info waves-effect waves-light"
                                    data-bs-target="#detailModal" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-title="Detail Laporan" data-bs-data="{{$laporan}}"
                                    onclick="renderDetailModal(this)"><i class="bx bx-search-alt-2"></i></button>
                                @if(Auth::user()->userDetail->role == 6 || Auth::user()->userDetail->role == 1 &&
                                $laporan->status == 0)
                                <button class="btn btn-mat btn-warning waves-effect waves-light"
                                    data-bs-target="#approvalModal" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-title="Approval Laporan" data-bs-priode="{{$laporan->priode}}"
                                    data-bs-id="{{$laporan->id}}" onclick="renderModal(this)"><i
                                        class="bx bxs-file-doc"></i></button>
                                @endif
                                @if($laporan->status == 2)
                                <a href="{{route('laporan-mingguan-uptd.edit',$laporan->id)}}"
                                    class="btn btn-mat btn-danger waves-effect waves-light" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Edit Laporan"><i
                                        class='bx bxs-edit-alt'></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
    <form action="" method="post">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="approvalModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="1">Setuju</option>
                            <option value="2">Tolak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>

        </div>
    </form>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailModalLabel">Detail Laporan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">ID Paket</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" id="nmPaket" value="" required readonly />
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Periode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="" id="priode" readonly />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">File</label>
                    <div class="col-sm-10">
                        <a href="" target="_blank"></a>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label" id="headerFoto">Foto Laporan</label>

                </div>
                <div class="row align-items-start">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Rencana</label>
                            <input type="text" name="rencana" value="" id="rencana" class="form-control" required
                                readonly />

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Realisasi</label>
                            <input type="text" name="realisasi" id="realisasi" class="form-control" required readonly />

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Deviasi</label>
                            <input type="text" name="deviasi" id="deviasi" class="form-control" required readonly />
                        </div>
                    </div>
                </div>
                <h4 class="text-center fw-bolder fs-3 mt-4 mb-3" id="headerDetailNMP">Detail Nomor Mata Pembayaran</h4>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>

    </div>
</div>
@endsection @section('scripts')
<script>
    $(document).ready(function() {
        $(".table").DataTable({
            responsive: true,
            autoWidth: false,
        });
        $('#status').change(function() {
            if ($(this).val() == 2) {
                $('#keterangan').attr('required', true);
            } else {
                $('#keterangan').attr('required', false);
            }
        });

        //modal event
        $('#detailModal').on('hidden.bs.modal', function() {
            $('#headerDetailNMP').nextAll('.nmp-data').remove();
            $('#headerFoto').nextAll('.row').remove();
            $('#deviasi').removeClass('text-danger text-success');
        });
    });

    function renderDetailModal(el) {
        const urlFile = "{{route('file-laporan.index', ':path')}}".replace(':path', '');
        $('.nmp-data').remove();
        var data = $(el).data('bs-data');
        $('#detailModal').modal('show');
        $('#nmPaket').val(data.data_umum_id);
        $('#priode').val(data.priode);
        $('#detailModal a').attr('href', urlFile + data.file_path.replace('public/lampiran/laporan_konsultan/', '')).html(data.file_path.replace('public/lampiran/laporan_konsultan/', ''));
        $('#rencana').val(data.rencana);
        $('#realisasi').val(data.realisasi);
        $('#deviasi').val(data.deviasi);
        if (data.deviasi < 0) {
            $('#deviasi').addClass('text-danger');
        } else {
            $('#deviasi').addClass('text-success');
        }
        var nmp = '';
        data.detail.forEach(function(item) {
            nmp += nmpBuilder(item.nmp, item.volume);
        });
        $('#headerDetailNMP').after(nmp);
        var foto = data.foto_laporan;
        $('#headerFoto').after(renderFotoLaporan(foto));
    }

    function renderModal(el) {
        var url = "{{route('laporan-mingguan-uptd.approval',':id')}}";
        var id = $(el).data('bs-id');
        var priode = $(el).data('bs-priode');
        $('#approvalModal').modal('show');
        $('#approvalModalLabel').html('Approval Laporan Priode ' + priode);
        url = url.replace(':id', id);
        $('#approvalModal form').attr('action', url);
    }

    function nmpBuilder(nmp, volume) {
        return `<div class="form-group row mb-3 nmp-data">
                    <label class="text-wrap">${nmp}</label>
                    <div class="input-group">
                        <input type="text" class="form-control" value="${volume}" required autocomplete="off" />
                    </div>
                </div>`;
    }

    function renderFotoLaporan(foto) {
        console.log(foto);
        var html = '';
        for (let i = 0; i < foto.length; i++) {
            html += `
                <div class="col-md-4 mb-3">
                    <img src="{{asset('storage/')}}/${foto[i].foto.replace('public', '')}" class="img-fluid" alt="Foto Laporan ${i+1}">
                </div>
            `;
        }
        return `<div class="row">${html}</div>`;
    }
</script>
@endsection