@extends('layouts.app')

@section('links')
<style>
    /* Sedikit style tambahan */
    .editable-score { cursor: pointer; position: relative; }
    .feedback-icon { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
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
                <table class="table table-hover align-middle" id="data-table" 
       data-update-url-template="{{ route('admin.du-dc.updateFileScore', ['du_dc_id' => 'PLACEHOLDER']) }}">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama File</th>
                            <th style="width: 120px;">Score</th>
                            <th>Deskripsi</th>

                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($du_dc->details as $index => $file)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $file->name }}</td>
                                {{-- <td>
                                    <span class="badge bg-info">{{ $file->score }} / 100</span>
                                </td> --}}
                                @php
                                    $badgeClass = 'background-color: rgb(233, 176, 176); border-radius: 10px;';
                                    if ($file->score >= 80) $badgeClass = 'background-color: rgb(119, 230, 91); border-radius: 10px;';
                                    elseif ($file->score >= 60) $badgeClass = 'background-color: rgb(233, 218, 176); border-radius: 10px;';
                                    elseif ($file->score > 0) $badgeClass = 'background-color: rgb(233, 176, 176); border-radius: 10px;';
                                @endphp
                                <td class="editable-cell" style="{{ $badgeClass }}" data-id="{{ $file->id }}" data-field="score">
                                    <span class="cell-value">{{ $file->score }}</span>
                                    <span class="feedback-icon"></span>
                                </td>
                                <td class="editable-cell" data-id="{{ $file->id }}" data-field="description">
                                    <span class="cell-value">{{ $file->deskripsi }}</span>
                                    <span class="feedback-icon"></span>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('data-table');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    table.addEventListener('click', function(e) {
        // Gunakan .editable-cell yang lebih generik
        const cell = e.target.closest('.editable-cell');
        if (cell) {
            makeCellEditable(cell);
        }
    });

    function makeCellEditable(cell) {
        if (cell.querySelector('input')) return;

        const valueSpan = cell.querySelector('.cell-value');
        const originalValue = valueSpan.textContent.trim();
        const recordId = cell.dataset.id;
        const fieldName = cell.dataset.field; // Ambil nama field dari data-field

        valueSpan.style.display = 'none';
        
        const input = document.createElement('input');
        // Tipe input disesuaikan dengan field
        input.type = (fieldName === 'score') ? 'number' : 'text'; 
        input.className = 'form-control';
        input.value = originalValue;
        
        cell.prepend(input);
        input.focus();

        const onFinishEditing = () => {
            const newValue = input.value;
            input.remove();
            valueSpan.style.display = 'inline';
            if (newValue !== originalValue) {
                // Kirim nama field ke fungsi save
                saveData(cell, recordId, fieldName, newValue, originalValue);
            }
        };

        input.addEventListener('blur', onFinishEditing);
        input.addEventListener('keydown', e => {
            if (e.key === 'Enter') input.blur();
            if (e.key === 'Escape') {
                input.value = originalValue;
                input.blur();
            }
        });
    }
    
    // Ganti fungsi saveData Anda dengan yang ini
    function saveData(cell, id, fieldName, newValue, originalValue) {
        const urlTemplate = table.dataset.updateUrlTemplate;
        const url = urlTemplate.replace('PLACEHOLDER', id);
        
        const feedbackIcon = cell.querySelector('.feedback-icon');
        const valueSpan = cell.querySelector('.cell-value');
        
        feedbackIcon.innerHTML = '<i class="fas fa-spinner fa-spin text-primary"></i>';

        fetch(url, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                [fieldName]: newValue
            })
        })
        .then(response => {
            if (!response.ok) throw new Error('Update failed');
            return response.json();
        })
        .then(data => {
            valueSpan.textContent = newValue;
            feedbackIcon.innerHTML = '<i class="fas fa-check-circle text-success"></i>';

            // --- NOTIFIKASI SWEETALERT DIMULAI DI SINI ---
            // Cek apakah field yang diupdate adalah 'score'
            if (fieldName === 'score') {
                // Tampilkan notifikasi toast yang akan hilang otomatis
                Swal.fire({
                    toast: true,
                    position: 'top-end', // Muncul di pojok kanan atas
                    icon: 'success',
                    title: `Skor berhasil diupdate menjadi ${newValue}!`,
                    showConfirmButton: false,
                    timer: 3000, // Hilang setelah 3 detik
                    timerProgressBar: true
                });
            }
            // --- AKHIR NOTIFIKASI ---
        })
        .catch(error => {
            console.error('Error:', error);
            valueSpan.textContent = originalValue;
            feedbackIcon.innerHTML = '<i class="fas fa-times-circle text-danger"></i>';
            
            // Ganti alert standar dengan SweetAlert error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Gagal memperbarui data!'
            });
        })
        .finally(() => {
            setTimeout(() => { feedbackIcon.innerHTML = ''; }, 2000);
        });
    }
});
</script>
@endsection