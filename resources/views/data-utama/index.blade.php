@extends('layouts.app') @section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Data Jenis Pekerjaan</div>
        <div class="card-body">
            <div class="container">
                <a
                    class="btn btn-mat btn-primary mb-3"
                    data-bs-toggle="modal"
                    data-bs-target="#createJenisPekerjaan"
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
                            <th>Kode Pekerjaan</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Satuan</th>
                            <th style="width: 20%">Aksi</th>
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
                                <a
                                    class="btn btn-mat btn-warning waves-effect waves-light"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateJenisPekerjaan"
                                    data-id="{{ $item->id }}"
                                    data-kd_jenis_pekerjaan="{{ $item->kd_jenis_pekerjaan }}"
                                    data-jenis_pekerjaan="{{ $item->jenis_pekerjaan }}"
                                    data-satuan="{{ $item->satuan }}"
                                    onclick="updateJenisPekerjaan(this)"
                                >
                                    <i class="bx bx-edit-alt"></i
                                ></a>

                                <a
                                    class="btn btn-mat btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteJenisPekerjaan"
                                    data-id="{{ $item->id }}"
                                    data-kd_jenis_pekerjaan="{{ $item->kd_jenis_pekerjaan }}"
                                    onclick="deleteJenisPekerjaan(this)"
                                >
                                    <i class="bx bx-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">Data kontraktor</div>
        <div class="card-body">
            <div class="container">
                <a
                    href="{{ route('data-umum.create') }}"
                    class="btn btn-mat btn-primary mb-3"
                    data-bs-toggle="modal"
                    data-bs-target="#createKontraktor"
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
                <table id="kontraktor" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Nama Direktur</th>
                            <th>No. Telp</th>
                            <th style="width: 22%">Aksi</th>
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
                                <a
                                    class="btn btn-mat btn-warning"
                                    data-bs-toggle="modal"
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
                                    data-email="{{ $item->email }}"
                                    onclick="updateKontraktor(this)"
                                >
                                    <i class="bx bx-edit-alt"></i
                                ></a>

                                <a
                                    class="btn btn-mat btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteJenisPekerjaan"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                    onclick="deleteKontraktor(this)"
                                >
                                    <i class="bx bx-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">Data Konsultan</div>
        <div class="card-body">
            <div class="container">
                <a
                    class="btn btn-mat btn-primary mb-3"
                    data-bs-toggle="modal"
                    data-bs-target="#createKonsultan"
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
                <table id="konsultan" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Nama Direktur</th>
                            <th>No. Telp</th>
                            <th style="width: 22%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($konsultans as $item)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->nama_direktur}}</td>
                            <td>{{$item->no_telp}}</td>
                            <td>
                                <a
                                    class="btn btn-mat btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editKonsultan"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                    data-nama_direktur="{{ $item->nama_direktur }}"
                                    data-no_telp="{{ $item->no_telp }}"
                                    data-alamat="{{ $item->alamat }}"
                                    data-se="{{ $item->se }}"
                                    data-npwp="{{ $item->npwp }}"
                                    data-email="{{ $item->email }}"
                                    onclick="updateKonsultan(this)"
                                >
                                    <i class="bx bx-edit-alt"></i
                                ></a>

                                <a
                                    class="btn btn-mat btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteKonsultan"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                    onclick="deleteKonsultan(this)"
                                >
                                    <i class="bx bx-trash"></i>
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
<!-- Modal Tambah Jenis Pekerjaan -->
<div
    class="modal fade"
    id="createJenisPekerjaan"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="createJenisPekerjaanLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createJenisPekerjaanLabel">
                    Tambah Data Jenis Pekerjaan
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                action="{{ route('data-utama.create-nmp', 0) }}"
                method="post"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kd_jenis_pekerjaan" class="form-label"
                            >Kode Pekerjaan
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="kd_jenis_pekerjaan"
                            name="kd_jenis_pekerjaan"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="jenis_pekerjaan" class="form-label"
                            >Jenis Pekerjaan
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="jenis_pekerjaan"
                            name="jenis_pekerjaan"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan </label>
                        <input
                            type="text"
                            class="form-control"
                            id="satuan"
                            name="satuan"
                        />
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
<!-- Modal Edit Jenis Pekerjaan -->
<div
    class="modal fade"
    id="updateJenisPekerjaan"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="updateJenisPekerjaanLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateJenisPekerjaanLabel">
                    Edit Data Jenis Pekerjaan
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form action="{{ route('data-utama.edit-nmp', 0) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kd_jenis_pekerjaan" class="form-label"
                            >Kode Pekerjaan
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="kd_jenis_pekerjaan"
                            name="kd_jenis_pekerjaan"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="jenis_pekerjaan" class="form-label"
                            >Jenis Pekerjaan
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="jenis_pekerjaan"
                            name="jenis_pekerjaan"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan </label>
                        <input
                            type="text"
                            class="form-control"
                            id="satuan"
                            name="satuan"
                        />
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
<!-- Modal Delete Jenis Pekerjaan -->
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
<!-- Modal Add Kontraktor -->
<div
    class="modal fade"
    id="createKontraktor"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="createKontraktorLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createKontraktorLabel">
                    Tambah Data Kontraktor
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                action="{{ route('data-utama.create-kontraktor') }}"
                method="post"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label"
                            >Nama Perusahaan Kontraktor
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama"
                            name="nama"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="nama_direktur" class="form-label"
                            >Nama Direktur
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama_direktur"
                            name="nama_direktur"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="nama_gs" class="form-label"
                            >Nama General Superintendent
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama_gs"
                            name="nama_gs"
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
                        <label for="alamat" class="form-label">Alamat</label>
                        <input
                            type="text"
                            class="form-control"
                            id="alamat"
                            name="alamat"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input
                            type="text"
                            class="form-control npwp"
                            id="npwp"
                            name="npwp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input
                            type="tel"
                            class="form-control"
                            id="no_telp"
                            name="no_telp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="bank" class="form-label">Bank</label>
                        <input
                            type="text"
                            class="form-control"
                            id="bank"
                            name="bank"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_rek" class="form-label"
                            >No. Rekening</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="no_rek"
                            name="no_rek"
                            required
                        />
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
<!-- Modal Edit Kontraktor -->
<div
    class="modal fade"
    id="editKontraktor"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editKontraktorLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editKontraktorLabel">
                    Tambah Data Kontraktor
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                action="{{ route('data-utama.create-kontraktor') }}"
                method="post"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label"
                            >Nama Perusahaan Kontraktor
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama"
                            name="nama"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="nama_direktur" class="form-label"
                            >Nama Direktur
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama_direktur"
                            name="nama_direktur"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="nama_gs" class="form-label"
                            >Nama General Superintendent
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama_gs"
                            name="nama_gs"
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
                        <label for="alamat" class="form-label">Alamat</label>
                        <input
                            type="text"
                            class="form-control"
                            id="alamat"
                            name="alamat"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input
                            type="text"
                            class="form-control npwp"
                            id="npwp"
                            name="npwp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input
                            type="tel"
                            class="form-control"
                            id="no_telp"
                            name="no_telp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="bank" class="form-label">Bank</label>
                        <input
                            type="text"
                            class="form-control"
                            id="bank"
                            name="bank"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_rek" class="form-label"
                            >No. Rekening</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="no_rek"
                            name="no_rek"
                            required
                        />
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
<!-- Modal Delete Kontraktor -->
<div
    class="modal fade"
    id="deleteKontraktor"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="deleteKontraktorLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteKontraktorLabel">
                    Delete Data Kontraktor
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
<!-- Modal Tambah Konsultan -->
<div
    class="modal fade"
    id="createKonsultan"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="createKonsultanLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createKonsultanLabel">
                    Tambah Data Konsultan
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                action="{{ route('data-utama.create-konsultan') }}"
                method="post"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label"
                            >Nama Perusahaan Konsultan
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama"
                            name="nama"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="nama_direktur" class="form-label"
                            >Nama Direktur
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama_direktur"
                            name="nama_direktur"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="nama_se" class="form-label"
                            >Nama Site Engineer
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama_se"
                            name="nama_se"
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
                        <label for="alamat" class="form-label">Alamat</label>
                        <input
                            type="text"
                            class="form-control"
                            id="alamat"
                            name="alamat"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input
                            type="text"
                            class="form-control npwp"
                            id="npwp"
                            name="npwp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input
                            type="tel"
                            class="form-control"
                            id="no_telp"
                            name="no_telp"
                            required
                        />
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
<!-- Modal Edit Konsultan -->
<div
    class="modal fade"
    id="editKonsultan"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editKonsultanLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editKonsultanLabel">
                    Tambah Data Konsultan
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                action="{{ route('data-utama.create-konsultan') }}"
                method="post"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label"
                            >Nama Perusahaan Konsultan
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama"
                            name="nama"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="nama_direktur" class="form-label"
                            >Nama Direktur
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama_direktur"
                            name="nama_direktur"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="nama_se" class="form-label"
                            >Nama Site Engineer
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama_se"
                            name="nama_se"
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
                        <label for="alamat" class="form-label">Alamat</label>
                        <input
                            type="text"
                            class="form-control"
                            id="alamat"
                            name="alamat"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input
                            type="text"
                            class="form-control npwp"
                            id="npwp"
                            name="npwp"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input
                            type="tel"
                            class="form-control"
                            id="no_telp"
                            name="no_telp"
                            required
                        />
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
<!-- Modal Delete Kontraktor -->
<div
    class="modal fade"
    id="deleteKonsultan"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="deleteKonsultanLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteKonsultanLabel">
                    Delete Data Kontraktor
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

@endsection @section('scripts')

<script>
    $(document).ready(function () {
        $("#nmp").DataTable();
        $("#kontraktor").DataTable();
        $("#konsultan").DataTable();
        $(".npwp").mask("99.999.999.9-999.999");
    });

    function updateJenisPekerjaan(el) {
        const url = "{{ route('data-utama.edit-nmp', 0) }}";
        var id = $(el).data("id");
        var kd_jenis_pekerjaan = $(el).data("kd_jenis_pekerjaan");
        var jenis_pekerjaan = $(el).data("jenis_pekerjaan");
        var satuan = $(el).data("satuan");
        $("#updateJenisPekerjaan form").attr("action", url.replace("0", id));
        $("#updateJenisPekerjaan").modal("show");
        $("#updateJenisPekerjaan #kd_jenis_pekerjaan").val(kd_jenis_pekerjaan);
        $("#updateJenisPekerjaan #jenis_pekerjaan").val(jenis_pekerjaan);
        $("#updateJenisPekerjaan #satuan").val(satuan);
    }

    function deleteJenisPekerjaan(el) {
        const url = "{{ route('data-utama.delete-nmp', 0) }}";
        var id = $(el).data("id");
        var kd_jenis_pekerjaan = $(el).data("kd_jenis_pekerjaan");
        $("#deleteJenisPekerjaanLabel").html(
            "Delete Data Jenis Pekerjaan " + kd_jenis_pekerjaan
        );

        $("#deleteJenisPekerjaan .btn-danger").attr(
            "href",
            url.replace("0", id)
        );
        $("#deleteJenisPekerjaan").modal("show");
    }

    function updateKontraktor(el) {
        const url = "{{ route('data-utama.edit-kontraktor', 0) }}";
        var id = $(el).data("id");
        var nama = $(el).data("nama");
        var nama_direktur = $(el).data("nama_direktur");
        var nama_gs = $(el).data("nama_gs");
        var email = $(el).data("email");
        var alamat = $(el).data("alamat");
        var npwp = $(el).data("npwp");
        var no_telp = $(el).data("no_telp");
        var bank = $(el).data("bank");
        var no_rek = $(el).data("no_rek");
        $("#editKontraktor form").attr("action", url.replace("0", id));
        $("#editKontraktor").modal("show");
        $("#editKontraktor #nama").val(nama);
        $("#editKontraktor #nama_direktur").val(nama_direktur);
        $("#editKontraktor #nama_gs").val(nama_gs);
        $("#editKontraktor #email").val(email);
        $("#editKontraktor #alamat").val(alamat);
        $("#editKontraktor #npwp").val(npwp);
        $("#editKontraktor #no_telp").val(no_telp);
        $("#editKontraktor #bank").val(bank);
        $("#editKontraktor #no_rek").val(no_rek);
    }

    function deleteKontraktor(el) {
        const url = "{{ route('data-utama.delete-kontraktor', 0) }}";
        var id = $(el).data("id");
        var nama = $(el).data("nama");
        $("#deleteKontraktorLabel").html("Delete Data Kontraktor " + nama);
        $("#deleteKontraktor .btn-danger").attr("href", url.replace("0", id));
        $("#deleteKontraktor").modal("show");
    }

    function updateKonsultan(el) {
        const url = "{{ route('data-utama.edit-konsultan', 0) }}";
        var id = $(el).data("id");
        var nama = $(el).data("nama");
        var nama_direktur = $(el).data("nama_direktur");
        var se = $(el).data("se");
        var email = $(el).data("email");
        var alamat = $(el).data("alamat");
        var npwp = $(el).data("npwp");
        var no_telp = $(el).data("no_telp");
        var bank = $(el).data("bank");
        var no_rek = $(el).data("no_rek");
        $("#editKonsultan form").attr("action", url.replace("0", id));
        $("#editKonsultan").modal("show");
        $("#editKonsultan #nama").val(nama);
        $("#editKonsultan #nama_direktur").val(nama_direktur);
        $("#editKonsultan #nama_se").val(se);
        $("#editKonsultan #email").val(email);
        $("#editKonsultan #alamat").val(alamat);
        $("#editKonsultan #npwp").val(npwp);
        $("#editKonsultan #no_telp").val(no_telp);
    }

    function deleteKonsultan(el) {
        const url = "{{ route('data-utama.delete-konsultan', 0) }}";
        var id = $(el).data("id");
        var nama = $(el).data("nama");
        $("#deleteKonsultanLabel").html("Delete Data Konsultan " + nama);
        $("#deleteKonsultan .btn-danger").attr("href", url.replace("0", id));
        $("#deleteKonsultan").modal("show");
    }
</script>
@endsection
