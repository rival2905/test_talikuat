@extends('layouts.app') @section('content')
<div class="container">
    {{-- Data Jenis Pekerjaan --}}
    <div class="card rounded-4 shadow-lg border-0 mb-4">
        <div class="card-header p-3 bg-gradient text-white fw-bold" style="background: #1e3c72;">
            Data Jenis Pekerjaan
        </div>
        <div class="card-body p-4">
            <div class="mb-3">
                <a class="btn btn-primary btn-lg rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#createJenisPekerjaan">
                    <i class="bx bx-plus me-1"></i> Tambah
                </a>
            </div>
            <div style="max-height:70vh; overflow-y:auto;">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light fw-semibold">
                        <tr>
                            <th>No</th>
                            <th>Kode Pekerjaan</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Satuan</th>
                            <th style="width:20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nmps as $item)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$item->kd_jenis_pekerjaan}}</td>
                            <td>{{$item->jenis_pekerjaan}}</td>
                            <td>{{$item->satuan}}</td>
                            <td>
                                <a class="btn btn-warning btn-sm rounded-pill shadow-sm me-1" data-bs-toggle="modal"
                                    data-bs-target="#updateJenisPekerjaan"
                                    data-id="{{ $item->id }}"
                                    data-kd_jenis_pekerjaan="{{ $item->kd_jenis_pekerjaan }}"
                                    data-jenis_pekerjaan="{{ $item->jenis_pekerjaan }}"
                                    data-satuan="{{ $item->satuan }}" onclick="updateJenisPekerjaan(this)">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>
                                @if(Auth::user()->userDetail->role == 1)
                                <a class="btn btn-danger btn-sm rounded-pill shadow-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteJenisPekerjaan"
                                    data-id="{{ $item->id }}"
                                    data-kd_jenis_pekerjaan="{{ $item->kd_jenis_pekerjaan }}" onclick="deleteJenisPekerjaan(this)">
                                    <i class="bx bx-trash"></i> Delete
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Data Kontraktor --}}
    <div class="card rounded-4 shadow-lg border-0 mb-4">
        <div class="card-header p-3 bg-gradient text-white fw-bold" style="background: #1e3c72;">
            Data Kontraktor
        </div>
        <div class="card-body p-4">
            <div class="mb-3">
                <a class="btn btn-primary btn-lg rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#createKontraktor">
                    <i class="bx bx-plus me-1"></i> Tambah
                </a>
            </div>
            <div style="max-height:80vh; overflow-y:auto;">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light fw-semibold">
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Nama Direktur</th>
                            <th>No. Telp</th>
                            <th style="width:22%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kontraktors as $item)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nama_direktur}}</td>
                            <td>{{$item->no_telp}}</td>
                            <td>
                                <a class="btn btn-warning btn-sm rounded-pill shadow-sm me-1" data-bs-toggle="modal"
                                    data-bs-target="#editKontraktor"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                    data-nama_direktur="{{ $item->nama_direktur }}"
                                    data-no_telp="{{ $item->no_telp }}"
                                    data-alamat="{{ $item->alamat }}"
                                    data-nama_gs="{{ $item->nama_gs }}"
                                    data-npwp="{{ $item->npwp }}"
                                    data-bank="{{ $item->bank }}"
                                    data-no_rek="{{ $item->no_rek }}"
                                    data-email="{{ $item->email }}" onclick="updateKontraktor(this)">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>
                                @if(Auth::user()->userDetail->role == 1)
                                <a class="btn btn-danger btn-sm rounded-pill shadow-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteKontraktor"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}" onclick="deleteKontraktor(this)">
                                    <i class="bx bx-trash"></i> Delete
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Data Konsultan --}}
    <div class="card rounded-4 shadow-lg border-0 mb-4">
        <div class="card-header p-3 bg-gradient text-white fw-bold" style="background: #1e3c72;">
            Data Konsultan
        </div>
        <div class="card-body p-4">
            <div class="mb-3">
                <a class="btn btn-primary btn-lg rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#createKonsultan">
                    <i class="bx bx-plus me-1"></i> Tambah
                </a>
            </div>
            <div style="max-height:80vh; overflow-y:auto;">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light fw-semibold">
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Nama Direktur</th>
                            <th>No. Telp</th>
                            <th style="width:22%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($konsultans as $item)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->nama_direktur}}</td>
                            <td>{{$item->no_telp}}</td>
                            <td>
                                <a class="btn btn-warning btn-sm rounded-pill shadow-sm me-1" data-bs-toggle="modal"
                                    data-bs-target="#editKonsultan"
                                    data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}"
                                    data-nama_direktur="{{ $item->nama_direktur }}"
                                    data-no_telp="{{ $item->no_telp }}"
                                    data-alamat="{{ $item->alamat }}"
                                    data-se="{{ $item->se }}"
                                    data-npwp="{{ $item->npwp }}"
                                    data-email="{{ $item->email }}" onclick="updateKonsultan(this)">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>
                                @if(Auth::user()->userDetail->role == 1)
                                <a class="btn btn-danger btn-sm rounded-pill shadow-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteKonsultan"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->name }}" onclick="deleteKonsultan(this)">
                                    <i class="bx bx-trash"></i> Delete
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Jenis Pekerjaan -->
<div class="modal fade" id="createJenisPekerjaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createJenisPekerjaanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4 bg-gradient" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold">Tambah Data Jenis Pekerjaan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('data-utama.create-nmp', 0) }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Pekerjaan</label>
                        <input type="text" class="form-control form-control-lg shadow-sm" name="kd_jenis_pekerjaan" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Pekerjaan</label>
                        <input type="text" class="form-control form-control-lg shadow-sm" name="jenis_pekerjaan" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Satuan</label>
                        <input type="text" class="form-control form-control-lg shadow-sm" name="satuan" />
                    </div>
                </div>
                <div class="modal-footer p-4 border-top-0">
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                        <i class="bx bx-plus me-1"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Jenis Pekerjaan -->
<div class="modal fade" id="updateJenisPekerjaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateJenisPekerjaanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4 bg-gradient" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold">Edit Data Jenis Pekerjaan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('data-utama.edit-nmp', 0) }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Pekerjaan</label>
                        <input type="text" class="form-control form-control-lg shadow-sm" name="kd_jenis_pekerjaan" id="kd_jenis_pekerjaan_edit" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Pekerjaan</label>
                        <input type="text" class="form-control form-control-lg shadow-sm" name="jenis_pekerjaan" id="jenis_pekerjaan_edit" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Satuan</label>
                        <input type="text" class="form-control form-control-lg shadow-sm" name="satuan" id="satuan_edit" />
                    </div>
                </div>
                <div class="modal-footer p-4 border-top-0">
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                        <i class="bx bx-save me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Jenis Pekerjaan -->
<div class="modal fade" id="deleteJenisPekerjaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteJenisPekerjaanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4 bg-gradient" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold">Delete Data Jenis Pekerjaan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer p-4 border-top-0">
                <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i> Close
                </button>
                <a class="btn btn-danger btn-lg rounded-pill shadow-sm" id="deleteConfirm">
                    <i class="bx bx-trash me-1"></i> Delete
                </a>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah Kontraktor -->
<div class="modal fade" id="createKontraktor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createKontraktorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold">Tambah Data Kontraktor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('data-utama.create-kontraktor') }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Perusahaan Kontraktor</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="nama" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Direktur</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="nama_direktur" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama General Superintendent</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="nama_gs" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control form-control-lg shadow-sm" name="email" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Alamat</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="alamat" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NPWP</label>
                            <input type="text" class="form-control form-control-lg shadow-sm npwp" name="npwp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telp</label>
                            <input type="tel" class="form-control form-control-lg shadow-sm" name="no_telp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Bank</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="bank" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Rekening</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="no_rek" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-top-0">
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                        <i class="bx bx-plus me-1"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kontraktor -->
<div class="modal fade" id="editKontraktor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editKontraktorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold">Edit Data Kontraktor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('data-utama.edit-kontraktor', 0) }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Perusahaan Kontraktor</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="nama_edit" name="nama" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Direktur</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="nama_direktur_edit" name="nama_direktur" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama General Superintendent</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="nama_gs_edit" name="nama_gs" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control form-control-lg shadow-sm" id="email_edit" name="email" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Alamat</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="alamat_edit" name="alamat" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NPWP</label>
                            <input type="text" class="form-control form-control-lg shadow-sm npwp" id="npwp_edit" name="npwp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telp</label>
                            <input type="tel" class="form-control form-control-lg shadow-sm" id="no_telp_edit" name="no_telp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Bank</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="bank_edit" name="bank" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Rekening</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="no_rek_edit" name="no_rek" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-top-0">
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                        <i class="bx bx-save me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Kontraktor -->
<div class="modal fade" id="deleteKontraktor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteKontraktorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold">Delete Data Kontraktor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer p-4 border-top-0">
                <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i> Close
                </button>
                <a class="btn btn-danger btn-lg rounded-pill shadow-sm" id="deleteConfirm">
                    <i class="bx bx-trash me-1"></i> Delete
                </a>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah Konsultan -->
<div class="modal fade" id="createKonsultan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createKonsultanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold">Tambah Data Konsultan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('data-utama.create-konsultan') }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Perusahaan Konsultan</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="name" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Direktur</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="nama_direktur" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Site Engineer</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="nama_se" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control form-control-lg shadow-sm" name="email" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Alamat</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="alamat" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NPWP</label>
                            <input type="text" class="form-control form-control-lg shadow-sm npwp" name="npwp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telp</label>
                            <input type="tel" class="form-control form-control-lg shadow-sm" name="no_telp" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-top-0">
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                        <i class="bx bx-plus me-1"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Konsultan -->
<div class="modal fade" id="editKonsultan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editKonsultanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold">Edit Data Konsultan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('data-utama.edit-konsultan', 0) }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Perusahaan Konsultan</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="nama_edit" name="name" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Direktur</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="nama_direktur_edit" name="nama_direktur" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Site Engineer</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="nama_se_edit" name="nama_se" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control form-control-lg shadow-sm" id="email_edit" name="email" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Alamat</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="alamat_edit" name="alamat" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NPWP</label>
                            <input type="text" class="form-control form-control-lg shadow-sm npwp" id="npwp_edit" name="npwp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telp</label>
                            <input type="tel" class="form-control form-control-lg shadow-sm" id="no_telp_edit" name="no_telp" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-top-0">
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                        <i class="bx bx-save me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Konsultan -->
<div class="modal fade" id="deleteKonsultan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteKonsultanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold">Delete Data Konsultan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer p-4 border-top-0">
                <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i> Close
                </button>
                <a class="btn btn-danger btn-lg rounded-pill shadow-sm" id="deleteConfirm">
                    <i class="bx bx-trash me-1"></i> Delete
                </a>
            </div>
        </div>
    </div>
</div>


@endsection @section('scripts')

<script>
$(document).ready(function() {
    // DataTable
    $("#nmp").DataTable();
    $("#kontraktor").DataTable();
    $("#konsultan").DataTable();

    // Mask NPWP
    $(".npwp").mask("99.999.999.9-999.999");

    // Show card sesuai query param
    var params = new URLSearchParams(window.location.search);
    if(params.has('nmp')) {
        $("#card-nmp").show();
        $("#card-kontraktor").hide();
        $("#card-konsultan").hide();
    } else if(params.has('kontraktor')) {
        $("#card-nmp").hide();
        $("#card-kontraktor").show();
        $("#card-konsultan").hide();
    } else if(params.has('konsultan')) {
        $("#card-nmp").hide();
        $("#card-kontraktor").hide();
        $("#card-konsultan").show();
    }
});

// ------------------- NMP -------------------
function updateJenisPekerjaan(el) {
    const url = "{{ route('data-utama.edit-nmp', 0) }}";
    var id = $(el).data("id");
    var kd_jenis_pekerjaan = $(el).data("kd_jenis_pekerjaan");
    var jenis_pekerjaan = $(el).data("jenis_pekerjaan");
    var satuan = $(el).data("satuan");

    $("#updateJenisPekerjaan form").attr("action", url.replace("0", id));
    $("#updateJenisPekerjaan #kd_jenis_pekerjaan_edit").val(kd_jenis_pekerjaan);
    $("#updateJenisPekerjaan #jenis_pekerjaan_edit").val(jenis_pekerjaan);
    $("#updateJenisPekerjaan #satuan_edit").val(satuan);
    $("#updateJenisPekerjaan").modal("show");
}

function deleteJenisPekerjaan(el) {
    const url = "{{ route('data-utama.delete-nmp', 0) }}";
    var id = $(el).data("id");
    var kd_jenis_pekerjaan = $(el).data("kd_jenis_pekerjaan");

    $("#deleteJenisPekerjaanLabel").html("Delete Data Jenis Pekerjaan " + kd_jenis_pekerjaan);
    $("#deleteJenisPekerjaan #deleteConfirm").attr("href", url.replace("0", id));
    $("#deleteJenisPekerjaan").modal("show");
}

// ------------------- Kontraktor -------------------
function updateKontraktor(el) {
    const url = "{{ route('data-utama.edit-kontraktor', 0) }}";
    var id = $(el).data("id");
    $("#editKontraktor form").attr("action", url.replace("0", id));

    $("#editKontraktor #nama_edit").val($(el).data("nama"));
    $("#editKontraktor #nama_direktur_edit").val($(el).data("nama_direktur"));
    $("#editKontraktor #nama_gs_edit").val($(el).data("nama_gs"));
    $("#editKontraktor #email_edit").val($(el).data("email"));
    $("#editKontraktor #alamat_edit").val($(el).data("alamat"));
    $("#editKontraktor #npwp_edit").val($(el).data("npwp"));
    $("#editKontraktor #no_telp_edit").val($(el).data("no_telp"));
    $("#editKontraktor #bank_edit").val($(el).data("bank"));
    $("#editKontraktor #no_rek_edit").val($(el).data("no_rek"));

    $("#editKontraktor").modal("show");
}

function deleteKontraktor(el) {
    const url = "{{ route('data-utama.delete-kontraktor', 0) }}";
    var id = $(el).data("id");
    var nama = $(el).data("nama");

    $("#deleteKontraktor .modal-title").text("Delete Data Kontraktor " + nama);
    $("#deleteKontraktor #deleteConfirm").attr("href", url.replace("0", id));
    $("#deleteKontraktor").modal("show");
}

// ------------------- Konsultan -------------------
function updateKonsultan(el) {
    const url = "{{ route('data-utama.edit-konsultan', 0) }}";
    var id = $(el).data("id");
    $("#editKonsultan form").attr("action", url.replace("0", id));

    $("#editKonsultan #nama_edit").val($(el).data("name"));
    $("#editKonsultan #nama_direktur_edit").val($(el).data("nama_direktur"));
    $("#editKonsultan #nama_se_edit").val($(el).data("se"));
    $("#editKonsultan #email_edit").val($(el).data("email"));
    $("#editKonsultan #alamat_edit").val($(el).data("alamat"));
    $("#editKonsultan #npwp_edit").val($(el).data("npwp"));
    $("#editKonsultan #no_telp_edit").val($(el).data("no_telp"));

    $("#editKonsultan").modal("show");
}

function deleteKonsultan(el) {
    const url = "{{ route('data-utama.delete-konsultan', 0) }}";
    var id = $(el).data("id");
    var nama = $(el).data("nama");

    $("#deleteKonsultan .modal-title").text("Delete Data Konsultan " + nama);
    $("#deleteKonsultan #deleteConfirm").attr("href", url.replace("0", id));
    $("#deleteKonsultan").modal("show");
}
</script>

@endsection