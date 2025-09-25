@extends('layouts.app')

@section('links')
<style>
    /* Custom premium style */
    .editable-score { cursor: pointer; position: relative; }
    .feedback-icon { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); }

    .breadcrumb {
        background: transparent;
        font-size: 0.95rem;
    }
    .breadcrumb-item a {
        text-decoration: none;
        color: #0d6efd;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: "\ea50";
        font-family: 'boxicons' !important;
        font-size: 1rem;
        color: #6c757d;
    }

    .card {
        border-radius: 1rem;
        border: none;
    }

    .table thead {
        background: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
    }

    .btn {
        border-radius: .65rem;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<div class="d-flex justify-content-center align-items-center">
    <div class="w-100"> 
        <div class="container-fluid py-4">

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('data-umum.index',date('Y')) }}">
                            <i class="bx bx-home-alt me-1"></i> Data Umum
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.data-umum.document-category.show', $du_dc->data_umum_id) }}">
                            <i class="bx bx-folder me-1"></i> Detail Data Umum
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-file me-1"></i>
                        {{ $du_dc->documentCategory->name ?? 'Detail File' }}
                    </li>
                </ol>
            </nav>

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">
                    <i class="bx bx-folder-open me-2"></i> 
                    File Kategori: <span class="text-primary">{{ $du_dc->documentCategory->name ?? '-' }}</span>
                </h3>
                @if ($du_dc->is_active == 1)
                <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addFileModal">
                    <i class="bx bx-plus me-1"></i> Tambah File
                </button>
                @endif
            </div>
            
            {{-- Tabel File --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white border-0 d-flex align-items-center">
        <i class="bx bx-collection text-primary me-2"></i>
        <h5 class="mb-0 fw-semibold">Dokumen</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle table-hover" id="data-table" 
                   data-update-url-template="{{ route('admin.du-dc.updateFileScore', ['du_dc_id' => 'PLACEHOLDER']) }}">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Nama File</th>
                        <th>Status</th>
                        <th style="width: 15%;">Score</th>
                        <th style="width: 25%;">Deskripsi</th>
                        <th style="width: 18%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($du_dc->details as $index => $file)
                        <tr data-id="{{ $file->id }}">
                            <td>{{ $index + 1 }}</td>
                            <td><i class="bx bx-file-blank me-1 text-secondary"></i>{{ $file->name }}</td>
                            {{-- Status Badge --}}
                            <td class="text-uppercase">
                                @php
                                    $statusClass = 'bg-secondary text-white';
                                    $statusIcon = 'bx bx-question-mark';
                                    switch (strtolower($file->status)) {
                                        case 'approved':
                                            $statusClass = 'bg-success text-white';
                                            $statusIcon = 'bx bx-check-circle';
                                            break;
                                        case 'pending':
                                            $statusClass = 'bg-warning text-dark';
                                            $statusIcon = 'bx bx-time-five';
                                            break;
                                        case 'revision':
                                            $statusClass = 'bg-danger text-white';
                                            $statusIcon = 'bx bx-error-circle';
                                            break;
                                    }
                                @endphp
                                <span class="badge rounded-pill px-3 py-2 shadow-sm {{ $statusClass }}">
                                    <i class="{{ $statusIcon }} me-1"></i> {{ ucfirst($file->status) }}
                                </span>
                            </td>

                            {{-- Kolom Score --}}
<td class="text-center fw-bold" 
    style="
        border-radius: 12px; 
        padding: 5px 12px; 
        box-shadow: 0 2px 4px rgba(0,0,0,0.15);
        @if($file->score >= 80)
            background: linear-gradient(135deg, #4caf50, #66bb6a); color: #fff;
        @elseif($file->score >= 60)
            background: linear-gradient(135deg, #ffeb3b, #fff176); color: #000;
        @elseif($file->score > 0)
            background: linear-gradient(135deg, #f44336, #e57373); color: #fff;
        @else
            background: #9e9e9e; color: #fff;
        @endif
    "
>
    @if(Auth::user()->userDetail->role == 1)
        <span class="view-mode">{{ $file->score }}</span>
        <input type="number" class="form-control edit-mode text-center" value="{{ $file->score }}" style="display: none; margin-top:5px; border-radius: 8px;">
</td>

                            {{-- Kolom Deskripsi --}}
                            <td>
                                <span class="view-mode">{{ $file->deskripsi }}</span>
                                <input type="text" class="form-control edit-mode" value="{{ $file->deskripsi }}" style="display: none;">
                            </td>
                            @else
                            <td style="{{ $badgeClass }}" class="text-center fw-bold">{{ $file->score }}</td>
                            <td>
                                {{ $file->deskripsi }}
                                @if ($file->created_by)
                                <p class="mb-1"><i class="bx bx-user me-1 text-muted"></i> Di Upload oleh: {{ @$file->creator->name }}</p>
                                @endif
                                @if ($file->pemeriksa_id)
                                <p class="mb-0"><i class="bx bx-user-check me-1 text-muted"></i> Pemeriksa: {{ @$file->userPemeriksa->name }}</p>
                                @endif
                            </td>
                            @endif

                            {{-- Kolom Aksi --}}
                            <td class="d-flex gap-1">
                                @php
                                    $is_delete = false;
                                    if(Auth::user()->userDetail->role == 1){
                                        $is_delete = true;
                                    } else if ($file->status == 'pending' && Auth::user()->userDetail->role == 5) {
                                        $is_delete = true;
                                    }
                                    $is_revision = false;
                                    if(($file->status == 'revision' && in_array(Auth::user()->userDetail->role,[1,5])) ||
                                       ($file->status == 'submit revision' && in_array(Auth::user()->userDetail->role,[1,5]))) {
                                        $is_revision = true;
                                    }
                                @endphp
                                <div class="view-mode">
                                    @if ($is_revision)
                                    <button type="button" class="btn btn-sm btn-warning shadow-sm" data-bs-toggle="modal" 
                                            data-bs-target="#EditFileModal" data-filename="{{ $file->name }}" data-idd="{{ $file->id }}">
                                        <i class="bx bx-transfer"></i>
                                    </button>
                                    @endif
                                    @if ($is_delete)
                                    <form action="{{ route('admin.du-dc-detail.destroy', $file->id) }}" method="POST" 
                                          class="d-inline" onsubmit="return confirm('Yakin ingin hapus file ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger shadow-sm"><i class="bx bx-trash"></i></button>
                                    </form>  
                                    @endif
                                    @if($file->files)
                                        <a href="{{ route('admin.du-dc.downloadFile',$file->id) }}" 
                                           class="btn btn-sm btn-success shadow-sm" target="_blank">
                                            <i class='bx bx-download'></i>
                                        </a>
                                    @endif
                                    @if (Auth::user()->userDetail->role == 1)
                                    <button class="btn btn-sm btn-primary shadow-sm btn-edit">
                                        <i class="bx bx-edit-alt btn-edit"></i>
                                    </button>
                                    @endif
                                </div>
                                <div class="edit-mode" style="display: none;">
                                    <button class="btn btn-sm btn-success shadow-sm btn-save"><i class="bx bx-save btn-save"></i></button>
                                    <button class="btn btn-sm btn-secondary shadow-sm btn-cancel"><i class="bx bx-undo btn-cancel"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                <i class="bx bx-info-circle me-1"></i> Belum ada file.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
 

            {{-- Modal Tambah --}}
            <div class="modal fade" id="addFileModal" tabindex="-1" aria-labelledby="addFileLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-3 shadow-lg">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addFileLabel"><i class="bx bx-plus me-2"></i> Tambah File</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('admin.du-dc-detail.store', $du_dc->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Upload File</label>
                                    <input type="file" name="files" class="form-control" required
                                           accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf,.xlsx,.doc,.docx,.xls">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary"><i class="bx bx-upload me-1"></i> Tambah File</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal Edit --}}
            <div class="modal fade" id="EditFileModal" tabindex="-1" aria-labelledby="EditFileLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-3 shadow-lg">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title" id="EditFileLabel"><i class="bx bx-edit-alt me-2"></i> Edit File</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form id="editFileForm" action="{{ route('admin.du-dc.file.update', 0) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Upload File Baru</label>
                                    <input type="file" name="files" class="form-control" 
                                           accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf,.xlsx,.doc,.docx,.xls">
                                    <small class="text-danger"><i class="bx bx-error-circle me-1"></i> Score dibawah 100 wajib Revisi.</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-warning"><i class="bx bx-save me-1"></i> Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    $('#EditFileModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var filename = button.data('filename');
        var id = button.data('idd');
        
        var modal = $(this);
        modal.find('.modal-title').text('Edit Dokumen: ' + filename);

        var form = modal.find('#editFileForm');
        var actionUrl = "{{ route('admin.du-dc.file.update', 0) }}"; // Ambil template URL dari Blade
        var newActionUrl = actionUrl.substring(0, actionUrl.lastIndexOf('/') + 1) + id;
        
        form.attr('action', newActionUrl);
    });
</script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    document.addEventListener('DOMContentLoaded', function () {
        const table = document.getElementById('data-table');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Event listener utama pada tabel
        table.addEventListener('click', function(e) {
            const target = e.target;
            const row = target.closest('tr');

            // Jika tombol 'Edit' diklik
            if (target.classList.contains('btn-edit')) {
                toggleRowEditMode(row, true);
            }

            // Jika tombol 'Batal' diklik
            if (target.classList.contains('btn-cancel')) {
                toggleRowEditMode(row, false);
            }

            // Jika tombol 'Simpan' diklik
            if (target.classList.contains('btn-save')) {
                const id = row.dataset.id;
                const scoreInput = row.querySelector('input[type="number"]');
                const descriptionInput = row.querySelector('input[type="text"]');

                const dataToSave = {
                    score: scoreInput.value,
                    description: descriptionInput.value
                };

                saveData(id, dataToSave, row);
            }
        });

        /**
         * Fungsi untuk mengubah antara mode tampilan dan mode edit
         * @param {HTMLElement} row - Elemen <tr> yang akan diubah
         * @param {boolean} isEditing - True untuk masuk mode edit, false untuk keluar
         */
        function toggleRowEditMode(row, isEditing) {
            const viewElements = row.querySelectorAll('.view-mode');
            const editElements = row.querySelectorAll('.edit-mode');

            if (isEditing) {
                viewElements.forEach(el => el.style.display = 'none');
                editElements.forEach(el => el.style.display = ''); // Tampilkan input dan tombol simpan/batal
            } else {
                // Reset nilai input ke nilai asli sebelum kembali ke view mode
                editElements.forEach(el => {
                    if (el.tagName === 'INPUT') {
                        const viewValue = el.previousElementSibling.textContent.trim();
                        el.value = viewValue;
                    }
                    el.style.display = 'none';
                });
                viewElements.forEach(el => el.style.display = '');
            }
        }

        /**
         * Fungsi untuk mengirim data ke server via AJAX
         * @param {string} id - ID record yang akan diupdate
         * @param {object} data - Data yang akan dikirim {score, description}
         * @param {HTMLElement} row - Elemen <tr> untuk update UI
         */
        function saveData(id, data, row) {
            const urlTemplate = table.dataset.updateUrlTemplate;
            const url = urlTemplate.replace('PLACEHOLDER', id);
            
            // Tampilkan notifikasi loading
            const saveButton = row.querySelector('.btn-save');
            saveButton.disabled = true;
            saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

            fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    // Coba baca error dari server jika ada
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(res => {
                // Update nilai di mode tampilan (span)
                row.querySelector('td:nth-child(4) .view-mode').textContent = data.score;
                row.querySelector('td:nth-child(5) .view-mode').textContent = data.description;
                
                // Kembali ke mode tampilan
                toggleRowEditMode(row, false);

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data berhasil disimpan!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            })
            .catch(error => {
                console.error('Error Response:', error); // Untuk debugging, lihat seluruh error di console

                let serverMessage = 'Gagal memperbarui data!'; // Pesan default

                // Cek apakah ada pesan error spesifik dari validasi Laravel
                if (error && error.errors) {
                    // Ambil pesan error pertama dari daftar error yang dikirim server
                    serverMessage = Object.values(error.errors)[0][0];
                }

                // Tampilkan pesan error dari server menggunakan SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops... Terjadi Kesalahan!',
                    text: serverMessage // Menampilkan pesan yang relevan dari backend
                });
            })
            .finally(() => {
                // Kembalikan tombol simpan ke kondisi normal
                saveButton.disabled = false;
                saveButton.textContent = 'Simpan';
            });
        }
    });
</script>
@endsection