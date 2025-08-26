@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Breadcrumb --}}
    {{-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.data-umum.index') }}">Data Umum</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.data-umum.show', $du_dc->data_umum_id) }}">Detail Data Umum</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $du_dc->documentCategory->name ?? 'Detail File' }}
            </li>
        </ol>
    </nav> --}}

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>File Kategori: {{ $du_dc->documentCategory->name ?? '-' }}</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFileModal">
            + Tambah File
        </button>
    </div>

    {{-- Tabel File --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">Dokumen</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama File</th>
                            <th style="width: 120px;">Score</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($du_dc->details as $index => $file)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $file->name }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $file->score }} / 100</span>
                                </td>
                                <td class="d-flex gap-1">
                                   
                                    @if($file->files)
                                        <a href="{{ route('admin.du-dc.downloadFile',$file->id) }}" 
                                           class="btn btn-sm btn-success" target="_blank">Download</a>
                                    @endif
                            
                                    <form action="{{ route('admin.du-dc-detail.destroy', $file->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin hapus file ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada file.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Tambah--}}
    <div class="modal fade" id="addFileModal" tabindex="-1" aria-labelledby="addFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFileLabel">Tambah File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.du-dc-detail.store', $du_dc->id) }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Upload File</label>
                            <input type="file" name="files" class="form-control" required
                                   accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, Word, Excel. Max 10MB</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Score (0 - 100)</label>
                            <input type="number" name="score" class="form-control" value="0" min="0" max="100" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
