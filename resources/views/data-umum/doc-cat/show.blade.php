@extends('layouts.app')

@section('links')

@if ($point)
    <style>
        body {
            background-color: #f0f2f5;
        }
        /* Membuat teks di dalam progress bar terlihat jelas */
        .progress-bar {
            color: #fff;
            font-weight: bold;
        }
    </style>
@endif

@endsection
@section('content')

<div class="container py-4">

    @if (!$point)
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Detail Data Umum: {{ $data_umum->nm_paket ?? $data_umum->name ?? '-' }}</h3>
    </div>
    <div class="progress" style="height: 25px;">
        <div class="progress-bar progress-bar-striped progress-bar-animated" 
             role="progressbar" 
             style="width: {{ $data_umum->nkk }}%;"  {{-- Lebar bar diisi oleh persentase --}}
             aria-valuenow="{{ $data_umum->nkk }}" 
             aria-valuemin="0" 
             aria-valuemax="100">
             
             {{-- Tampilkan teks persentase di dalam bar --}}
             <strong>{{ round($data_umum->nkk, 2) }}%</strong>
        </div>
    </div>
    <div class="row mt-3">
        
        <div class="col-xl col-md mb-4">
            <a href="{{ route('admin.du-dc.status',[$data_umum->id,'all']) }}">

                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        
                        <div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total File</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{-- $totalDokumen --}} {{ $data_umum->du_dc_details_total_doc_count }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl col-md mb-4">
            
            <div class="card shadow-sm h-100">
                    <a href="{{ route('admin.du-dc.status',[$data_umum->id,'pending']) }}" class="stretched-link">
                    <div class="card-body d-flex align-items-center">
                        
                        <div>
                            <div class="text-xs font-weight-bold text-default text-uppercase mb-1">Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{-- $sedangDireview --}} {{ $data_umum->du_dc_details_total_pending_count }}</div>
                        </div>
                    </div>
                </a>
                </div>
        </div>
        <div class="col-xl col-md mb-4">
            <a href="{{ route('admin.du-dc.status',[$data_umum->id,'review']) }}">

                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        
                        <div>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Sedang di Review</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{-- $sedangDireview --}} {{ $data_umum->du_dc_details_total_review_count }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl col-md mb-4">
            <a href="{{ route('admin.du-dc.status',[$data_umum->id,'revision']) }}">

                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        
                        <div>
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Revisi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{-- $jumlahRevisi --}} {{ $data_umum->du_dc_details_total_revision_count }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl col-md mb-4">
            <a href="{{ route('admin.du-dc.status',[$data_umum->id,'complete']) }}">

                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        
                        <div>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Lengkap</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{-- $dokumenLengkap --}} {{ $data_umum->du_dc_details_total_complete_count }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
    {{-- Tabel Relasi Kategori --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Dokumen</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th style="width: 50%">Nama</th>
                            <th>Nilai Dokumen</th>
                            <th>Total File</th>
                            <th>Skor File</th>

                            <th style="width: 5%">Aksi</th>
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
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Info Data Umum</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>ID:</th>
                    <td>{{ $data_umum->id ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Kegiatan:</th>
                    <td>{{ $data_umum->nm_paket ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kontraktor:</th>
                    <td>{{$data_umum->detail->kontraktor->nama ?? '-'}}</td>
                </tr>
                <tr>
                    <th>Konsultan:</th>
                    <td>{{$data_umum->detail->konsultan->name ?? '-'}}</td>
                </tr>
                <tr>
                    <th>PPK:</th>
                    <td>{{$data_umum->detail->ppk->nama ?? ''}}</td>
                </tr>
            </table>
        </div>
    </div>
        
    @endif
</div>

{{-- Modal Tambah Relasi --}}
<div class="modal fade" id="addRelasiModal" tabindex="-1" aria-labelledby="addRelasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRelasiLabel">Tambah Relasi Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.data-umum.document-category.store', $data_umum->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="document_category_id" class="form-select" required>
                            <option value="">-- Pilih Category --</option>
                            @foreach($document_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Score</label>
                        <input type="number" name="score" class="form-control" value="0">
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="is_active" class="form-select" required>
                            <option value="1" selected>Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Relasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if ($point)
<div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="progressModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="progressModalLabel">Generating Data...</h5>
                {{-- Tombol close disembunyikan selama proses --}}
            </div>
            <div class="modal-body">
                <p id="modal-info-text">Please wait a moment, we are preparing your data...</p>
                <p id="modal-info-text" class="text-danger fw-5">We only do this once for each data item.</p>

                
                <div class="progress" style="height: 25px;">
                    <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- Tombol Refresh awalnya disembunyikan --}}
                <button id="refresh-btn" type="button" class="btn btn-success" style="display: none;">
                    Finish & Refresh
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
        
        // --- KONFIGURASI ---
        const DURATION_IN_SECONDS = 3; // Atur durasi total animasi dalam detik
    
        // --- ELEMEN HTML ---
        const modal = $('#progressModal');
        const modalLabel = $('#progressModalLabel');
        const modalInfoText = $('#modal-info-text');
        const progressBar = $('#progressBar');
        const refreshBtn = $('#refresh-btn');
    
        // Variabel untuk animasi
        let progressValue = 0;
        const intervalTime = (DURATION_IN_SECONDS * 1000) / 100;
        let animationInterval;
    
        // Fungsi untuk menjalankan animasi
        function startAnimation() {
            animationInterval = setInterval(updateProgress, intervalTime);
        }
    
        // Fungsi yang dipanggil berulang kali untuk update progress
        function updateProgress() {
            progressValue++;
            
            // Update progress bar Bootstrap
            progressBar.css('width', progressValue + '%');
            progressBar.text(progressValue + '%');
            progressBar.attr('aria-valuenow', progressValue);
    
            // Jika sudah 100%
            if (progressValue >= 100) {
                clearInterval(animationInterval); // Hentikan animasi
                
                // Update tampilan modal
                modalLabel.text('Process Complete!');
                modalInfoText.text('The data has been processed successfully.');
                progressBar.removeClass('progress-bar-animated').addClass('bg-success');
                progressBar.text('Selesai!');
                
                // Tampilkan tombol refresh
                refreshBtn.show();
            }
        }
    
        // Event listener untuk tombol refresh
        refreshBtn.on('click', function() {
            location.reload();
        });
    
        // Memicu modal saat halaman siap
        modal.modal('show');
    
        // Memicu animasi setelah modal sepenuhnya tampil
        modal.on('shown.bs.modal', function () {
            startAnimation();
        });
    });
</script>
@endif
@endsection