@extends('layouts.app')

@section('content')
<div class="container py-4">


    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Detail Data Umum: {{ $data_umum->nm_paket ?? $data_umum->name ?? '-' }}</h3>
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
                            <th>Total File</th>
                            <th>Total Score</th>

                            <th style="width: 5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_umum->duDc as $index => $du_dc)
                            <tr>
                                <td>{{ $du_dc->documentCategory->code ?? '-' }}</td>
                                <td>{{ $du_dc->documentCategory->name ?? '-' }}</td>
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
                                        @if ($du_dc->is_active)
                                        <a href="{{ route('admin.du-dc.index.updateStatus', $du_dc->id) }}" class="btn btn-sm btn-success">Active</a>
                                        
                                        @else
                                        <a href="{{ route('admin.du-dc.index.updateStatus', $du_dc->id) }}" class="btn btn-sm btn-danger">Non-Active</a>

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
                    <td></td>
                </tr>
                <tr>
                    <th>Konsultan:</th>
                    <td></td>
                </tr>
                <tr>
                    <th>PPK:</th>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
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
@endsection
