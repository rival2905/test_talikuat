@extends('layouts.app') @section('content')
<div class="container my-5">

    @if(Auth::user()->userDetail->role == 1)
    {{-- User Admin PPK --}}
    <div class="card mb-4 shadow-lg rounded-5 border-0">
        <div class="card-header fw-bold text-white" style="letter-spacing: 0.5px; background-color: #1e3c72;">
            User Admin PPK
        </div>
        <div class="card-body p-4">
            <div class="mb-3">
                <a class="btn btn-primary btn-lg rounded-pill shadow-sm text-white"
                   data-bs-toggle="modal" data-bs-target="#createAdminUptd"
                   style="border:none;">
                   <i class="bx bx-plus me-1"></i> Tambah
                </a>
            </div>

            <div class="table-responsive" style="max-height: 70vh; overflow-y:auto;">
                <table id="adminUPTD" class="table table-hover table-borderless align-middle text-center shadow-sm">
                    <thead class="table-light text-dark text-uppercase">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIP/ NIk</th>
                            <th>UPTD</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adminUPTD as $item)
                        <tr style="transition: all 0.3s; cursor:pointer;">
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ @$item->user->name }}</td>
                            <td>{{ @$item->user->email }}</td>
                            <td>{{ $item->user->profile->no_pegawai ?? '' }}</td>
                            <td>{{ $item->uptd->nama_uptd }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm rounded-pill shadow-sm"
                                   data-bs-toggle="modal" data-bs-target="#editDataAdminUptd"
                                   data-id="{{ @$item->user->id }}" data-name="{{ @$item->user->name }}"
                                   data-email="{{ @$item->user->email }}" data-no_pegawai="{{ @$item->user->profile->no_pegawai }}"
                                   data-no_telp="{{ @$item->user->profile->no_tlp }}" data-uptd="{{ @$item->user->internal_role_id }}"
                                   onclick="updateAdminUptd(this)">
                                   <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- User Konsultan --}}
    <div class="card mb-4 shadow-lg rounded-5 border-0">
        <div class="card-header fw-bold text-white" style="letter-spacing: 0.5px; background-color: #1e3c72;">
            User Konsultan
        </div>
        <div class="card-body p-4">
            <div class="mb-3">
                <a class="btn btn-primary btn-lg rounded-pill shadow-sm text-white"
                   data-bs-toggle="modal" data-bs-target="#createUserKonsultan"
                   style="border:none;">
                   <i class="bx bx-plus me-1"></i> Tambah
                </a>
            </div>

            <div class="table-responsive" style="max-height: 70vh; overflow-y:auto;">
                <table id="userKonsultan" class="table table-hover table-borderless align-middle text-center shadow-sm">
                    <thead class="table-light text-dark text-uppercase">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nama Konsultan</th>
                            <th>UPTD</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($konsultan as $item)
                        <tr style="transition: all 0.3s; cursor:pointer;">
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->konsultan->name }}</td>
                            <td>{{ $item->uptd->nama_uptd }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm rounded-pill shadow-sm"
                                   data-bs-toggle="modal" data-bs-target="#editDataKonsultan"
                                   data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-email="{{ $item->email }}"
                                   data-nik="{{ $item->nik}}" data-uptd="{{ $item->uptd_id}}" data-no_telp="{{ $item->no_telp}}"
                                   data-konsultan_id="{{ $item->konsultan_id}}" data-jabatan="{{ $item->jabatan}}"
                                   onclick="updateUserKonsultan(this)">
                                   <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>

                                <a class="btn btn-danger btn-sm rounded-pill shadow-sm"
                                   data-bs-toggle="modal" data-bs-target="#deleteUserKonsultan"
                                   data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                   onclick="deleteUserKonsultan(this)">
                                   <i class="bx bx-trash me-1"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    {{-- User PPK --}}
    <div class="card shadow-lg rounded-5 border-0">
        <div class="card-header fw-bold text-white" style="letter-spacing: 0.5px; background-color: #1e3c72;">
            User PPK
        </div>
        <div class="card-body p-4">
            <div class="mb-3">
                <a class="btn btn-primary btn-lg rounded-pill shadow-sm text-white"
                   data-bs-toggle="modal" data-bs-target="#createUserPPK"
                   style="border:none;">
                   <i class="bx bx-plus me-1"></i> Tambah
                </a>
            </div>

            <div class="table-responsive" style="max-height: 70vh; overflow-y:auto;">
                <table id="nmp" class="table table-hover table-borderless align-middle text-center shadow-sm">
                    <thead class="table-light text-dark text-uppercase">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIP</th>
                            <th>UPTD</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ppk as $item)
                        <tr style="transition: all 0.3s; cursor:pointer;">
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ @$item->user->name }}</td>
                            <td>{{ @$item->user->email }}</td>
                            <td>{{ $item->user->profile->no_pegawai ?? '' }}</td>
                            <td>{{ $item->uptd->nama_uptd }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm rounded-pill shadow-sm"
                                   data-bs-toggle="modal" data-bs-target="#editUserPPK"
                                   data-id="{{ @$item->user->id }}" data-name="{{ @$item->user->name }}"
                                   data-email="{{ @$item->user->email }}" data-nip="{{ $item->user->profile->no_pegawai ?? '' }}"
                                   data-uptd="{{ @$item->user->internal_role_id}}" data-no_telp="{{ $item->user->profile->no_tlp ?? ''}}"
                                   onclick="updateUserPPK(this)">
                                   <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>

                                <a class="btn btn-danger btn-sm rounded-pill shadow-sm"
                                   data-bs-toggle="modal" data-bs-target="#deletePPK"
                                   data-id="{{  @$item->user->id }}" data-name="{{ @$item->user->name }}"
                                   onclick="deletePPK(this)">
                                   <i class="bx bx-trash me-1"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<!-- Modal Tambah Admin UPTD -->
<div class="modal fade" id="createAdminUptd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createAdminUptdLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold" id="createAdminUptdLabel">Tambah Data User Admin UPTD</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user-manajement.create-admin-uptd') }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="name" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control form-control-lg shadow-sm" name="email" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIP / NIK</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="no_pegawai" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telp</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="no_tlp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control form-control-lg shadow-sm" name="password" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">UPTD</label>
                            <select name="uptd" class="form-select form-select-lg shadow-sm" required>
                                <option value="">Pilih UPTD</option>
                                <option value="56">UPTD 1</option>
                                <option value="115">UPTD 2</option>
                                <option value="58">UPTD 3</option>
                                <option value="66">UPTD 4</option>
                                <option value="73">UPTD 5</option>
                                <option value="80">UPTD 6</option>
                            </select>
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

<!-- Modal Edit Admin UPTD -->
<div class="modal fade" id="editDataAdminUptd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDataAdminUptdLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold">Edit Data User Admin UPTD</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user-manajement.update-admin-uptd', 0) }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="name" name="name" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control form-control-lg shadow-sm" id="email" name="email" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIP / NIK</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="no_pegawai" name="no_pegawai" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telp</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="no_tlp" name="no_tlp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control form-control-lg shadow-sm" id="password" name="password" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">UPTD</label>
                            <select name="uptd" class="form-select form-select-lg shadow-sm" required>
                                <option value="">Pilih UPTD</option>
                                <option value="56">UPTD 1</option>
                                <option value="115">UPTD 2</option>
                                <option value="58">UPTD 3</option>
                                <option value="66">UPTD 4</option>
                                <option value="73">UPTD 5</option>
                                <option value="80">UPTD 6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-top-0">
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow-sm">
                        <i class="bx bx-edit-alt me-1"></i> Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Delete Admin UPTD -->
<div class="modal fade" id="deleteDataAdminUptd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteDataAdminUptdLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-3" style="background: #dc3545;">
                <h5 class="modal-title text-white fw-bold" id="deleteDataAdminUptdLabel">Hapus Admin UPTD</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0 fw-semibold">Apakah Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer p-3 border-top-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary rounded-pill shadow-sm" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i> Close
                </button>
                <a class="btn btn-danger rounded-pill shadow-sm">
                    <i class="bx bx-trash me-1"></i> Delete
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User Konsultan -->
<div class="modal fade" id="createUserKonsultan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserKonsultanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold">Tambah Data User Konsultan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user-manajement.create-admin-konsultan') }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="name" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control form-control-lg shadow-sm" name="email" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIK</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="nik" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telp</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="no_telp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jabatan</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="jabatan" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control form-control-lg shadow-sm" name="password" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Konsultan</label>
                            <select name="konsultan_id" class="form-select form-select-lg shadow-sm" required>
                                <option value="">Pilih Konsultan</option>
                                @foreach ($dataKonsultan as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">UPTD</label>
                            <select name="uptd" class="form-select form-select-lg shadow-sm" required>
                                <option value="">Pilih UPTD</option>
                                <option value="1">UPTD 1</option>
                                <option value="2">UPTD 2</option>
                                <option value="3">UPTD 3</option>
                                <option value="4">UPTD 4</option>
                                <option value="5">UPTD 5</option>
                                <option value="6">UPTD 6</option>
                            </select>
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
<!-- Modal Edit User Konsultan -->
<div class="modal fade" id="editDataKonsultan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDataKonsultanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold" id="editDataKonsultanLabel">Edit Data User Konsultan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user-manajement.update-admin-konsultan', 0) }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="name" name="name" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control form-control-lg shadow-sm" id="email" name="email" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIK</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="nik" name="nik" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telp</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="no_telp" name="no_telp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jabatan</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="jabatan" name="jabatan" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control form-control-lg shadow-sm" id="password" name="password" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Konsultan</label>
                            <select name="konsultan_id" id="konsultan_id" class="form-select form-select-lg shadow-sm" required>
                                <option value="">Pilih Konsultan</option>
                                @foreach ($dataKonsultan as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">UPTD</label>
                            <select name="uptd" id="uptd" class="form-select form-select-lg shadow-sm" required>
                                <option value="">Pilih UPTD</option>
                                <option value="1">UPTD 1</option>
                                <option value="2">UPTD 2</option>
                                <option value="3">UPTD 3</option>
                                <option value="4">UPTD 4</option>
                                <option value="5">UPTD 5</option>
                                <option value="6">UPTD 6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-top-0">
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow-sm">
                        <i class="bx bx-edit-alt me-1"></i> Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete User PPK -->
<div class="modal fade" id="deletePPK" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deletePPKLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-3" style="background: #dc3545;">
                <h5 class="modal-title text-white fw-bold" id="deletePPKLabel">Hapus User PPK</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0 fw-semibold">Apakah Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer p-3 border-top-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary rounded-pill shadow-sm" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i> Close
                </button>
                <a class="btn btn-danger rounded-pill shadow-sm">
                    <i class="bx bx-trash me-1"></i> Delete
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete User Konsultan -->
<div class="modal fade" id="deleteUserKonsultan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteUserKonsultanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-3" style="background: #dc3545;">
                <h5 class="modal-title text-white fw-bold" id="deleteUserKonsultanLabel">Hapus User Konsultan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0 fw-semibold">Apakah Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer p-3 border-top-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary rounded-pill shadow-sm" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i> Close
                </button>
                <a class="btn btn-danger rounded-pill shadow-sm">
                    <i class="bx bx-trash me-1"></i> Delete
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User PPK -->
<div class="modal fade" id="createUserPPK" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserPPKLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold" id="createUserPPKLabel">Tambah Data User PPK</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user-manajement.create-admin-ppk') }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="name" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control form-control-lg shadow-sm" name="email" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIP</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="no_pegawai" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telp</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="no_tlp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control form-control-lg shadow-sm" name="password" required />
                        </div>
                        @if(Auth::user()->userDetail->role == 1)
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">UPTD</label>
                            <select name="uptd" class="form-select form-select-lg shadow-sm" required>
                                <option value="">Pilih UPTD</option>
                                <option value="55">UPTD 1</option>
                                <option value="88">UPTD 2</option>
                                <option value="64">UPTD 3</option>
                                <option value="68">UPTD 4</option>
                                <option value="74">UPTD 5</option>
                                <option value="81">UPTD 6</option>
                            </select>
                        </div>
                        @endif
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


<!-- Modal Edit User PPK -->
<div class="modal fade" id="editUserPPK" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUserPPKLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-4" style="background: #1e3c72;">
                <h5 class="modal-title text-white fw-bold" id="editUserPPKLabel">Edit Data User PPK</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user-manajement.update-admin-ppk', 0) }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="name" name="name" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control form-control-lg shadow-sm" id="email" name="email" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIP</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="no_pegawai" name="no_pegawai" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telp</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="no_tlp" name="no_tlp" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control form-control-lg shadow-sm" id="password" name="password" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">UPTD</label>
                            <select name="uptd" id="uptd" class="form-select form-select-lg shadow-sm" required>
                                <option value="">Pilih UPTD</option>
                                <option value="55">UPTD 1</option>
                                <option value="88">UPTD 2</option>
                                <option value="64">UPTD 3</option>
                                <option value="68">UPTD 4</option>
                                <option value="74">UPTD 5</option>
                                <option value="81">UPTD 6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-top-0">
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow-sm">
                        <i class="bx bx-edit-alt me-1"></i> Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <div class="card mb-4">
        <div class="card-header">User Kontraktor</div>
        <div class="card-body">
            <div class="container">
                <a
                    class="btn btn-mat btn-primary mb-3"
                    data-bs-toggle="modal"
                    data-bs-target="#"
                >
                    Tambah</a
                >

                <a
                    href="https://tk.temanjabar.net/export-to-excel"
                    class="btn btn-mat btn-success mb-3"
                    target="_blank"
                >
                    <i class="mdi mdi-export"></i>
                    Export</a
                >
            </div>
            <div class="container" style="max-height: 80vh; overflow-y: auto">
                <table id="nmp" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nama Kontraktor</th>
                            <th>UPTD</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div> -->
@endsection @section('scripts')

<script>
    $(document).ready(function() {
        $("#adminUPTD").DataTable();
        $("#userKonsultan").DataTable();
    });

    let dataPPK = `{!! json_encode($ppk) !!}`;

    dataPPK = JSON.parse(dataPPK);
    console.log(dataPPK);

    function updateAdminUptd(el) {
        const url = "{{ route('user-manajement.update-admin-uptd', 0) }}";
        var id = $(el).data("id");
        var name = $(el).data("name");
        var email = $(el).data("email");
        var no_pegawai = $(el).data("no_pegawai");
        var no_tlp = $(el).data("no_telp");
        var uptd = $(el).data("uptd");
        $("#editDataAdminUptd form").attr("action", url.replace("0", id));
        $("#editDataAdminUptd #name").val(name);
        $("#editDataAdminUptd #email").val(email);
        $("#editDataAdminUptd #no_pegawai").val(no_pegawai);
        $("#editDataAdminUptd #no_tlp").val(no_tlp);
        $("#editDataAdminUptd #uptd")
            .find("option[value=" + uptd + "]")
            .attr("selected", true);
    }


    function updateUserKonsultan(el) {
        const url = "{{ route('user-manajement.update-admin-konsultan', 0) }}";
        var id = $(el).data("id");
        var name = $(el).data("name");
        var email = $(el).data("email");
        var nik = $(el).data("nik");
        var no_telp = $(el).data("no_telp");
        var jabatan = $(el).data("jabatan");
        var konsultan_id = $(el).data("konsultan_id");
        var uptd = $(el).data("uptd");
        console.log(konsultan_id);

        $("#editDataKonsultan form").attr("action", url.replace("0", id));
        $("#editDataKonsultan #name").val(name);
        $("#editDataKonsultan #email").val(email);
        $("#editDataKonsultan #nik").val(nik);
        $("#editDataKonsultan #no_telp").val(no_telp);
        $("#editDataKonsultan #jabatan").val(jabatan);
        $("#editDataKonsultan #konsultan_id")
            .find("option[value=" + konsultan_id + "]")
            .attr("selected", true);
        $("#editDataKonsultan #uptd")
            .find("option[value=" + uptd + "]")
            .attr("selected", true);
    }



        function deletePPK(el) {
        const url = "{{ route('user-manajement.delete-admin-ppk', 0) }}";
        var id = $(el).data("id");
        var name = $(el).data("name");
        console.log(name);
        $("#deletePPKLabel").text("Delete User " + name);
        $("#deletePPK .modal-footer a").attr(
            "href",
            url.replace("0", id)
        );
    }

    function deleteUserKonsultan(el) {
        const url = "{{ route('user-manajement.delete-admin-konsultan', 0) }}";
        var id = $(el).data("id");
        var name = $(el).data("name");
        $("#deleteUserKonsultanLabel").text("Delete User " + name);
        $("#deleteUserKonsultan .modal-footer a").attr(
            "href",
            url.replace("0", id)
        );
    }

    function updateUserPPK(el) {
        const url = "{{ route('user-manajement.update-admin-ppk', 0) }}";
        var id = $(el).data("id");
        var name = $(el).data("name");
        var email = $(el).data("email");
        var nip = $(el).data("nip");
        var no_telp = $(el).data("no_telp");
        var uptd = $(el).data("uptd");

        $("#editUserPPK form").attr("action", url.replace("0", id));
        $("#editUserPPK #name").val(name);
        $("#editUserPPK #email").val(email);
        $("#editUserPPK #no_pegawai").val(nip);
        $("#editUserPPK #no_tlp").val(no_telp);
        $("#editUserPPK #uptd")
            .find("option[value=" + uptd + "]")
            .attr("selected", true);
    }
</script>
@endsection