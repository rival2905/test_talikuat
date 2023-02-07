@extends('layouts.app') @section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">User Admin UPTD</div>
        <div class="card-body">
            <div class="container">
                <a
                    class="btn btn-mat btn-primary mb-3"
                    data-bs-toggle="modal"
                    data-bs-target="#createAdminUptd"
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
                <table id="adminUPTD" class="table table-striped">
                    <thead>
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
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->user->email}}</td>
                            <td>
                                {{ @$item->user->profile->no_pegawai}}
                            </td>
                            <td>{{$item->uptd->nama_uptd}}</td>
                            <td>
                                <a
                                    class="btn btn-mat btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editDataAdminUptd"
                                    data-id="{{ $item->user->id }}"
                                    data-name="{{ $item->user->name }}"
                                    data-email="{{ $item->user->email }}"
                                    data-no_pegawai="{{ @$item->user->profile->no_pegawai}}"
                                    data-no_telp="{{ @$item->user->profile->no_tlp}}"
                                    data-uptd="{{ $item->user->internal_role_id}}"
                                    onclick="updateAdminUptd(this)"
                                >
                                    <i class="mdi mdi-pencil"></i>
                                    Edit</a
                                >

                                <a
                                    class="btn btn-mat btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteKonsultan"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                    onclick="deleteKonsultan(this)"
                                >
                                    <i class="mdi mdi-delete"></i>
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">User Konsultan</div>
        <div class="card-body">
            <div class="container">
                <a
                    class="btn btn-mat btn-primary mb-3"
                    data-bs-toggle="modal"
                    data-bs-target="#createUserKonsultan"
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
                <table id="userKonsultan" class="table table-striped">
                    <thead>
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
                        <tr>
                            <td>{{$loop->index +1 }}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->konsultan->name}}</td>
                            <td>{{$item->uptd->nama_uptd}}</td>
                            <td>
                                <a
                                    class="btn btn-mat btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editDataKonsultan"
                                    data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}"
                                    data-email="{{ $item->email }}"
                                    data-nik="{{ $item->nik}}"
                                    data-uptd="{{ $item->uptd_id}}"
                                    data-no_telp="{{ $item->no_telp}}"
                                    data-konsultan_id="{{ $item->konsultan_id}}"
                                    data-jabatan="{{ $item->jabatan}}"
                                    onclick="updateUserKonsultan(this)"
                                >
                                    <i class="mdi mdi-pencil"></i>
                                    Edit</a
                                >

                                <a
                                    class="btn btn-mat btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteUserKonsultan"
                                    data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}"
                                    onclick="deleteUserKonsultan(this)"
                                >
                                    <i class="mdi mdi-delete"></i>
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">User PPK</div>
        <div class="card-body">
            <div class="container">
                <a
                    class="btn btn-mat btn-primary mb-3"
                    data-bs-toggle="modal"
                    data-bs-target="#createUserPPK"
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
                            <th>NIP</th>
                            <th>UPTD</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ppk as $item)
                        <tr>
                            <td>{{$loop->index +1 }}</td>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->user->email}}</td>
                            <td>{{$item->user->profile->no_pegawai}}</td>
                            <td>{{$item->uptd->nama_uptd}}</td>
                            <td>
                                <a
                                    class="btn btn-mat btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editUserPPK"
                                    data-id="{{ $item->user->id }}"
                                    data-name="{{ $item->user->name }}"
                                    data-email="{{ $item->user->email }}"
                                    data-nip="{{ $item->user->profile->no_pegawai}}"
                                    data-uptd="{{ $item->user->internal_role_id}}"
                                    data-no_telp="{{ $item->user->profile->no_tlp}}"
                                    onclick="updateUserPPK(this)"
                                >
                                    <i class="mdi mdi-pencil"></i>
                                    Edit</a
                                >

                                <a
                                    class="btn btn-mat btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteUserPPK"
                                    data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}"
                                    onclick="deleteUserPPK(this)"
                                >
                                    <i class="mdi mdi-delete"></i>
                                    Hapus
                                </a>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Admin UPTD -->
<div
    class="modal fade"
    id="createAdminUptd"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="createAdminUptdLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createAdminUptdLabel">
                    Tambah Data User Admin UPTD
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                action="{{ route('user-manajement.create-admin-uptd') }}"
                method="post"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama </label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_pegawai" class="form-label"
                            >NIP / NIK
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="no_pegawai"
                            name="no_pegawai"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password
                        </label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_tlp" class="form-label">No. Telp</label>
                        <input
                            type="text"
                            class="form-control"
                            id="no_tlp"
                            name="no_tlp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password
                        </label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="uptd" class="form-label">UPTD </label>
                        <select name="uptd" class="form-select" required>
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
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Admin UPTD -->
<div
    class="modal fade"
    id="editDataAdminUptd"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editDataAdminUptdLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editDataAdminUptdLabel">
                    Edit Data Jenis Pekerjaan
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                action="{{ route('user-manajement.update-admin-uptd', 0) }}"
                method="post"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama </label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_pegawai" class="form-label"
                            >NIP / NIK
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="no_pegawai"
                            name="no_pegawai"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_tlp" class="form-label">No. Telp</label>
                        <input
                            type="text"
                            class="form-control"
                            id="no_tlp"
                            name="no_tlp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password
                        </label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="uptd" class="form-label">UPTD </label>
                        <select
                            name="uptd"
                            id="uptd"
                            class="form-select"
                            required
                        >
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
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Delete Admin UPTD -->
<div
    class="modal fade"
    id="deleteJenisPekerjaan"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="deleteJenisPekerjaanLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteJenisPekerjaanLabel">
                    Delete Data Jenis Pekerjaan
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
                <a class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User Konsultan -->
<div
    class="modal fade"
    id="createUserKonsultan"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="createUserKonsultanLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createUserKonsultanLabel">
                    Tambah Data User Konsultan
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                action="{{ route('user-manajement.create-admin-konsultan') }}"
                method="post"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama </label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nik"
                            name="nik"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input
                            type="text"
                            class="form-control"
                            id="no_telp"
                            name="no_telp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input
                            type="text"
                            class="form-control"
                            id="jabatan"
                            name="jabatan"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password
                        </label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="konsultan_id" class="form-label"
                            >Konsultan</label
                        >
                        <select
                            name="konsultan_id"
                            class="form-select"
                            required
                        >
                            <option value="">Pilih Konsultan</option>
                            @foreach ($dataKonsultan as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="uptd" class="form-label">UPTD </label>
                        <select name="uptd" class="form-select" required>
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
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit User Konsultan -->
<div
    class="modal fade"
    id="editDataKonsultan"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editDataKonsultanLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editDataKonsultanLabel">
                    Tambah Data User Konsultan
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                action="{{ route('user-manajement.create-admin-konsultan') }}"
                method="post"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama </label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nik"
                            name="nik"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input
                            type="text"
                            class="form-control"
                            id="no_telp"
                            name="no_telp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input
                            type="text"
                            class="form-control"
                            id="jabatan"
                            name="jabatan"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password
                        </label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="konsultan_id" class="form-label"
                            >Konsultan</label
                        >
                        <select
                            name="konsultan_id"
                            id="konsultan_id"
                            class="form-select"
                            required
                        >
                            <option value="">Pilih Konsultan</option>
                            @foreach ($dataKonsultan as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="uptd" class="form-label">UPTD </label>
                        <select
                            name="uptd"
                            id="uptd"
                            class="form-select"
                            required
                        >
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
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Delete User Konsultan -->
<div
    class="modal fade"
    id="deleteUserKonsultan"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="deleteUserKonsultanLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteUserKonsultanLabel">
                    Delete User
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
                <a class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User PPK -->
<div
    class="modal fade"
    id="createUserPPK"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="createUserPPKLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createUserPPKLabel">
                    Tambah Data User PPK
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                action="{{ route('user-manajement.create-admin-ppk') }}"
                method="post"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama </label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_pegawai" class="form-label">NIP </label>
                        <input
                            type="text"
                            class="form-control"
                            id="no_pegawai"
                            name="no_pegawai"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="no_tlp" class="form-label">No. Telp</label>
                        <input
                            type="text"
                            class="form-control"
                            id="no_tlp"
                            name="no_tlp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password
                        </label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="uptd" class="form-label">UPTD </label>
                        <select name="uptd" class="form-select" required>
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
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit User PPK -->
<div
    class="modal fade"
    id="editUserPPK"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editUserPPKLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editUserPPKLabel">
                    Tambah Data User PPK
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama </label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_pegawai" class="form-label">NIP </label>
                        <input
                            type="text"
                            class="form-control"
                            id="no_pegawai"
                            name="no_pegawai"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="no_tlp" class="form-label">No. Telp</label>
                        <input
                            type="text"
                            class="form-control"
                            id="no_tlp"
                            name="no_tlp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password
                        </label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="uptd" class="form-label">UPTD </label>
                        <select
                            name="uptd"
                            id="uptd"
                            class="form-select"
                            required
                        >
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
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-success">Save</button>
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
    $(document).ready(function () {
        $("#adminUPTD").DataTable();
        $("#userKonsultan").DataTable();
    });

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
