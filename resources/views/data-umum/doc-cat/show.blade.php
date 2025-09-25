@extends('layouts.app')

@section('links')
@if ($point)
    <style>
        body {
            background-color: #f0f2f5;
        }
        .progress {
            height: 28px;
            border-radius: 50px;
            overflow: hidden;
        }
        .progress-bar {
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: .5px;
        }
        .card-premium {
            border: none;
            border-radius: 1rem;
            transition: all 0.3s ease-in-out;
        }
        .card-premium:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.12);
        }
        .table thead th {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .modal-content {
            border-radius: 1rem;
            border: none;
            box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,.1);
        }
    </style>
@endif
@endsection

@section('content')
<div class="container py-4">
    @if (!$point)
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class='bx bx-file text-primary me-2'></i>
            Detail Data Umum: 
            <span class="text-primary">{{ $data_umum->nm_paket ?? $data_umum->name ?? '-' }}</span>
        </h3>
    </div>

    {{-- Progress --}}
<div class="progress mb-4" style="height: 32px; border-radius: 8px; overflow: hidden;">
    <div class="progress-bar bg-gradient bg-primary progress-bar-striped progress-bar-animated d-flex align-items-center justify-content-center fw-bold"
         role="progressbar"
         style="width: {{ $data_umum->nkk }}%;"
         aria-valuenow="{{ $data_umum->nkk }}"
         aria-valuemin="0"
         aria-valuemax="100">
         <i class='bx bx-stats me-2'></i> {{ round($data_umum->nkk, 2) }}%
    </div>
</div>


    {{-- Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-xl col-md-6">
            <a href="{{ route('admin.du-dc.status',[$data_umum->id,'all']) }}" class="text-decoration-none">
                <div class="card card-premium shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <i class='bx bx-archive bx-lg text-primary mb-2'></i>
                        <h6 class="text-uppercase text-muted small mb-1">Total File</h6>
                        <h4 class="fw-bold text-dark">{{ $data_umum->du_dc_details_total_doc_count }}</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl col-md-6">
            <a href="{{ route('admin.du-dc.status',[$data_umum->id,'pending']) }}" class="text-decoration-none">
                <div class="card card-premium shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <i class='bx bx-time-five bx-lg text-warning mb-2'></i>
                        <h6 class="text-uppercase text-muted small mb-1">Pending</h6>
                        <h4 class="fw-bold text-warning">{{ $data_umum->du_dc_details_total_pending_count }}</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl col-md-6">
            <a href="{{ route('admin.du-dc.status',[$data_umum->id,'review']) }}" class="text-decoration-none">
                <div class="card card-premium shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <i class='bx bx-search-alt bx-lg text-primary mb-2'></i>
                        <h6 class="text-uppercase text-muted small mb-1">Sedang di Review</h6>
                        <h4 class="fw-bold text-primary">{{ $data_umum->du_dc_details_total_review_count }}</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl col-md-6">
            <a href="{{ route('admin.du-dc.status',[$data_umum->id,'revision']) }}" class="text-decoration-none">
                <div class="card card-premium shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <i class='bx bx-edit bx-lg text-danger mb-2'></i>
                        <h6 class="text-uppercase text-muted small mb-1">Revisi</h6>
                        <h4 class="fw-bold text-danger">{{ $data_umum->du_dc_details_total_revision_count }}</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl col-md-6">
            <a href="{{ route('admin.du-dc.status',[$data_umum->id,'complete']) }}" class="text-decoration-none">
                <div class="card card-premium shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <i class='bx bx-check-circle bx-lg text-success mb-2'></i>
                        <h6 class="text-uppercase text-muted small mb-1">Lengkap</h6>
                        <h4 class="fw-bold text-success">{{ $data_umum->du_dc_details_total_complete_count }}</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-0 d-flex align-items-center">
            <i class='bx bx-folder-open text-primary me-2'></i>
            <h5 class="mb-0 fw-bold text-dark">Dokumen</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><i class='bx bx-barcode me-1'></i>Code</th>
                            <th style="width: 40%"><i class='bx bx-file-blank me-1'></i>Nama</th>
                            <th><i class='bx bx-award me-1'></i>Nilai Dokumen</th>
                            <th><i class='bx bx-archive-in me-1'></i>Total File</th>
                            <th><i class='bx bx-pie-chart-alt me-1'></i>Skor File</th>
                            <th class="text-center"><i class='bx bx-cog me-1'></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_umum->duDc as $index => $du_dc)
                            <tr>
                                <td>{{ $du_dc->documentCategory->code ?? '-' }}</td>
                                <td>{{ $du_dc->documentCategory->name ?? '-' }}</td>
                                <td>{{ $du_dc->score_temp ?? '-' }}</td>

                                <td>
                                    @php
                                        $totalFiles = $du_dc->details->count();
                                        $avgScore = $du_dc->details->avg('score');
                                        $badgeClass = 'bg-secondary';
                                        if ($avgScore >= 80) $badgeClass = 'bg-success';
                                        elseif ($avgScore >= 60) $badgeClass = 'bg-warning text-dark';
                                        elseif ($avgScore > 0) $badgeClass = 'bg-danger';
                                    @endphp

                                    {{ $totalFiles }}
                                    
                                </td>
                                <td>
                                    @if($totalFiles > 0)
                                        <span class="badge {{ $badgeClass }} ms-1">
                                            {{ number_format($avgScore, 2) }}%
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.du-dc.index', $du_dc->id) }}" class="btn btn-sm btn-info">Detail</a>
                                        {{-- <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editRelasiModal{{ $du_dc->id }}">Edit</button> --}}
                                        @if (Auth::user()->userDetail->role == 1)
                                            @if ($du_dc->is_active)
                                            <a href="{{ route('admin.du-dc.index.updateStatus', $du_dc->id) }}" class="btn btn-sm btn-success">Active</a>
                                            
                                            @else
                                            <a href="{{ route('admin.du-dc.index.updateStatus', $du_dc->id) }}" class="btn btn-sm btn-danger">Non-Active</a>

                                            @endif
                                        @endif
                                        
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="editRelasiModal{{ $du_dc->id }}" tabindex="-1" aria-labelledby="editRelasiLabel{{ $du_dc->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editRelasiLabel{{ $du_dc->id }}">Edit Relasi Kategori</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.data-umum.document-category.update', $du_dc->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Category</label>
                                                    <select name="document_category_id" class="form-select" required>
                                                        @foreach($document_categories as $category)
                                                            <option value="{{ $category->id }}" {{ $category->id == $du_dc->document_category_id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control">{{ $du_dc->deskripsi }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Status</label>
                                                    <select name="is_active" class="form-select" required>
                                                        <option value="1" {{ $du_dc->is_active ? 'selected' : '' }}>Aktif</option>
                                                        <option value="0" {{ !$du_dc->is_active ? 'selected' : '' }}>Nonaktif</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada relasi kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Tabel Info Data Umum --}}
<div class="card shadow-lg border-0 rounded-4 mb-4">
    <div class="card-header bg-white d-flex align-items-center border-0 py-3">
        <i class="bx bx-info-circle fs-4 text-primary me-2"></i>
        <h5 class="mb-0 fw-bold text-dark">Info Data Umum</h5>
    </div>
    <div class="card-body">
        <table class="table table-borderless align-middle">
            <tr>
                <th class="text-muted w-25"><i class="bx bx-id-card me-1 text-primary"></i> ID:</th>
                <td class="fw-semibold">{{ $data_umum->id ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-muted"><i class="bx bx-briefcase-alt me-1 text-primary"></i> Nama Kegiatan:</th>
                <td class="fw-semibold">{{ $data_umum->nm_paket ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-muted"><i class="bx bx-building-house me-1 text-primary"></i> Kontraktor:</th>
                <td class="fw-semibold">{{$data_umum->detail->kontraktor->nama ?? '-'}}</td>
            </tr>
            <tr>
                <th class="text-muted"><i class="bx bx-user-voice me-1 text-primary"></i> Konsultan:</th>
                <td class="fw-semibold">{{$data_umum->detail->konsultan->name ?? '-'}}</td>
            </tr>
            <tr>
                <th class="text-muted"><i class="bx bx-user-pin me-1 text-primary"></i> PPK:</th>
                <td class="fw-semibold">{{$data_umum->detail->ppk->nama ?? ''}}</td>
            </tr>
        </table>
    </div>
</div>
@endif
</div>

{{-- Modal Tambah Relasi --}}
<div class="modal fade" id="addRelasiModal" tabindex="-1" aria-labelledby="addRelasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <i class="bx bx-link-alt fs-4 me-2"></i>
                <h5 class="modal-title fw-bold" id="addRelasiLabel">Tambah Relasi Kategori</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.data-umum.document-category.store', $data_umum->id) }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="bx bx-category-alt me-1"></i> Category</label>
                        <select name="document_category_id" class="form-select rounded-3" required>
                            <option value="">-- Pilih Category --</option>
                            @foreach($document_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="bx bx-star me-1"></i> Score</label>
                        <input type="number" name="score" class="form-control rounded-3" value="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="bx bx-file me-1"></i> Deskripsi</label>
                        <textarea name="deskripsi" class="form-control rounded-3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="bx bx-check-shield me-1"></i> Status</label>
                        <select name="is_active" class="form-select rounded-3" required>
                            <option value="1" selected>Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-light border rounded-3" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary rounded-3">
                        <i class="bx bx-plus-circle me-1"></i> Tambah Relasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($point)
{{-- Modal Progress --}}
<div class="modal fade" id="progressModal" tabindex="-1" aria-labelledby="progressModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header bg-warning text-dark rounded-top-4">
                <i class="bx bx-loader-circle bx-spin fs-4 me-2"></i>
                <h5 class="modal-title fw-bold" id="progressModalLabel">Generating Data...</h5>
            </div>
            <div class="modal-body p-4">
                <p id="modal-info-text" class="mb-2">Please wait a moment, we are preparing your data...</p>
                <p id="modal-info-text" class="text-danger small fw-semibold">We only do this once for each data item.</p>
                <div class="progress mt-3" style="height: 25px;">
                    <div id="progressBar" 
                         class="progress-bar progress-bar-striped progress-bar-animated bg-primary fw-bold"
                         role="progressbar" style="width: 0%;" 
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button id="refresh-btn" type="button" class="btn btn-success rounded-3 d-none">
                    <i class="bx bx-refresh me-1"></i> Finish & Refresh
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
@if ($point)
<script>
    $(document).ready(function() {
        const DURATION_IN_SECONDS = 3;
        const modal = $('#progressModal');
        const modalLabel = $('#progressModalLabel');
        const modalInfoText = $('#modal-info-text');
        const progressBar = $('#progressBar');
        const refreshBtn = $('#refresh-btn');

        let progressValue = 0;
        const intervalTime = (DURATION_IN_SECONDS * 1000) / 100;
        let animationInterval;

        function startAnimation() {
            animationInterval = setInterval(updateProgress, intervalTime);
        }

        function updateProgress() {
            progressValue++;
            progressBar.css('width', progressValue + '%');
            progressBar.text(progressValue + '%');
            progressBar.attr('aria-valuenow', progressValue);

            if (progressValue >= 100) {
                clearInterval(animationInterval);
                modalLabel.text('Process Complete!');
                modalInfoText.text('The data has been processed successfully.');
                progressBar.removeClass('progress-bar-animated bg-primary')
                           .addClass('bg-success');
                progressBar.text('Selesai!');
                refreshBtn.removeClass('d-none');
            }
        }

        refreshBtn.on('click', function() {
            location.reload();
        });

        modal.modal('show');
        modal.on('shown.bs.modal', function () {
            startAnimation();
        });
    });
</script>
@endif
@endsection
