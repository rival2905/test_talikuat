@extends('layouts.app') @section('content')
<div class="container my-5">
    @foreach($dataUmum as $data)
    <div class="card rounded-4 shadow-lg border-0 mb-4">
        <div class="card-header p-3 fw-bold text-white" style="background: #1e3c72;">
            {{$data->id}} - {{$data->nm_paket}}
            @if(Auth::user()->userDetail->role != 6 && Auth::user()->userDetail->role != 4)
            <a href="{{ route('laporan-keuangan.create',$data->id) }}" 
               class="btn btn-warning btn-sm shadow-sm rounded-pill float-end"
               data-bs-toggle="tooltip" data-bs-placement="bottom" title="Buat Laporan Keuangan">
               Buat Laporan <i class="bx bxs-file-doc"></i>
            </a>
            @endif
        </div>
        <div class="card-body p-4">
            <div style="max-height:70vh; overflow-y:auto;">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead class="table-light fw-semibold" style="background: #1e3c72; color:white;">
                        <tr>
                            <th>Periode</th>
                            <th>Rencana</th>
                            <th>Realisasi</th>
                            <th>Deviasi</th>
                            <th>Status</th>
                            <th style="width:20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->laporanUptd as $laporan)
                        <tr>
                            <td>{{ $laporan->priode }}</td>
                            <td>{{ $laporan->rencana }}</td>
                            <td>{{ $laporan->realisasi }}</td>
                            <td>{{ $laporan->deviasi }}</td>
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
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <!-- Detail -->
                                    <button class="btn btn-info btn-sm shadow-sm rounded-pill"
                                        data-bs-target="#detailModal" data-bs-toggle="tooltip" 
                                        data-bs-placement="bottom" title="Detail Laporan"
                                        data-bs-data="{{$laporan}}" onclick="renderDetailModal(this)">
                                        <i class="bx bx-search-alt-2"></i>
                                    </button>

                                    <!-- Approval -->
                                    @if(Auth::user()->userDetail->role == 6 && $laporan->status == 0)
                                    <button class="btn btn-warning btn-sm shadow-sm rounded-pill"
                                        data-bs-target="#approvalModal" data-bs-toggle="tooltip" 
                                        data-bs-placement="bottom" title="Approval Laporan"
                                        data-bs-priode="{{$laporan->priode}}" data-bs-id="{{$laporan->id}}" 
                                        onclick="renderModal(this)">
                                        <i class="bx bxs-file-doc"></i>
                                    </button>
                                    @endif

                                    <!-- Edit -->
                                    @if($laporan->status == 2)
                                    <a href="{{ route('laporan-mingguan-uptd.edit',$laporan->id) }}"
                                        class="btn btn-danger btn-sm shadow-sm rounded-pill"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Laporan">
                                        <i class='bx bxs-edit-alt'></i>
                                    </a>
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
    @endforeach
</div>

<!-- Modal Approval -->
<div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
    <form action="" method="post">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="approvalModalLabel">Approval Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="1">Setuju</option>
                            <option value="2">Tolak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
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

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="background:#1e3c72; color:white;">
                <h5 class="modal-title fw-bold" id="detailModalLabel">Detail Laporan Keuangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-5">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">ID Paket</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nmPaket" readonly />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Periode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="priode" readonly />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">File</label>
                    <div class="col-sm-10">
                        <a href="" target="_blank" id="fileLink"></a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Rencana</label>
                        <input type="text" class="form-control" id="rencana" readonly />
                    </div>
                    <div class="col-md-4">
                        <label>Realisasi</label>
                        <input type="text" class="form-control" id="realisasi" readonly />
                    </div>
                    <div class="col-md-4">
                        <label>Deviasi</label>
                        <input type="text" class="form-control" id="deviasi" readonly />
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
    $(function(){
    $('[data-bs-toggle="tooltip"]').tooltip();
});

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
    });

    function renderDetailModal(el) {
        var data = $(el).data('bs-data');
        $('#detailModal').modal('show');
        $('#nmPaket').val(data.data_umum_id);
        $('#priode').val(data.priode);
        console.log(data);
        $('#detailModal a').attr('href', data.file_path).html(data.file_path.replace('public/lampiran/laporan_konsultan/', ''));
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
        return `<div class="form-group row mb-3">
                    <label class="text-wrap">${nmp}</label>
                    <div class="input-group">
                        <input type="text" class="form-control" value="${volume}" required autocomplete="off" />
                    </div>
                </div>`;
    }
</script>
@endsection