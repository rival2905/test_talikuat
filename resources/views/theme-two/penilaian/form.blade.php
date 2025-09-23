@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container">
    <div class="card p-2">
        <form action="{{ route('penilaian-penyedia.store', $data->id) }}" method="POST" id="form-laporan-mingguan-uptd"
            enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                {{-- Nama Paket --}}
                <div class="form-group row mb-3">
                    <label class=" col-form-label">Nama Paket</label>
                    <div class="col">
                        <input type="text" class="form-control" value="{{ $data->nm_paket }}" required readonly />
                    </div>
                </div>

                {{-- Kontraktor --}}
                <div class="form-group row mb-3">
                    <label class=" col-form-label">Kontraktor</label>
                    <div class="col">
                        <input type="text" class="form-control" value="{{ $kontraktor->nama }}" required readonly />
                        <input type="hidden" value="{{ $kontraktor->id }}" name="kontraktor_id" />
                    </div>
                </div>

                {{-- Tanggal & Nomor Kontrak --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Kontrak</label>
                            <input type="date" name="tgl_kontrak" value="{{ $data->tgl_kontrak }}" id="tgl_kontrak"
                                class="form-control" required readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>No. Kontrak</label>
                            <input type="text" name="no_kontrak" id="no_kontrak" class="form-control text-uppercase"
                                value="{{ $data->no_kontrak }}" required readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>No. SPMK</label>
                            <input type="text" name="no_spmk" id="no_spmk" value="{{ $data->no_spmk }}"
                                class="form-control text-uppercase" required readonly />
                        </div>
                    </div>
                </div>

                {{-- Tanggal SPMK, Panjang KM, Waktu Pelaksanaan --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal SPMK</label>
                            <input type="date" name="tgl_spmk" id="tgl_spmk" value="{{ $data->tgl_spmk }}"
                                class="form-control" required readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Panjang KM</label>
                            <input type="number" step="0.01" name="panjang_km" id="panjang_km"
                                value="{{ $data->detail->panjang_km }}" class="form-control" required readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Waktu Pelaksanaan</label>
                            <input type="number" step="1" name="lama_waktu" id="lama_waktu"
                                value="{{ $data->detail->lama_waktu }}" class="form-control" required readonly />
                        </div>
                    </div>
                </div>

                {{-- Tanggal PHO --}}
                <div class="form-group row mb-3">
                    <label class=" col-form-label">Tanggal PHO</label>
                    <div class="col">
                        <input type="text" class="form-control" value="{{ $tgl_pho }}" required readonly />
                    </div>
                </div>

                {{-- Mobilisasi --}}
                <div class="form-group row mb-3">
                    <label class="col-form-label">Persiapan (Mobilisasi) s/d:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="persiapan_m" value="{{ $tgl_start }}" readonly />
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="persiapan_s" value="{{ $tgl_end }}" readonly />
                    </div>
                </div>

                {{-- Pelaksanaan --}}
                <div class="form-group row mb-3">
                    <label class=" col-form-label">Pelaksanaan s/d:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="pelaksanaan_m" value="{{ $data->tgl_spmk }}"
                            readonly />
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="pelaksanaan_s" value="{{ $tgl_pho }}" readonly />
                    </div>
                </div>

                {{-- Bulan Ke --}}
                <div class="form-group row mb-3">
                    <label class=" col-form-label">Bulan Ke-</label>
                    <div class="col">
                        <input type="text" class="form-control" value="{{ $penilaian_count }}" required readonly
                            name="bulan_ke" />
                    </div>
                </div>
            </div>

            {{-- A --}}
            <div class="row" id="tableA">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            A. Aspek Kinerja ( Persiapan )
                        </div>
                        <div class="card-body">

                            {{-- Pengajuan Jadwal Pelaksanaan Pekerjaan sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'A',1)" name="bobot"
                                            class="form-check-input" id="check_a1">
                                        <input type="hidden" name="text_a1"
                                            value="Pengajuan Jadwal Pelaksanaan Pekerjaan sesuai dengan jadwal">
                                        <label for="check_a1" class="form-check-label">
                                            Pengajuan Jadwal Pelaksanaan Pekerjaan sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_a1" value="ya"
                                                onchange="getValue(this,'A')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_a1" value="tidak"
                                                onchange="getValue(this,'A')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_a1" readonly>
                                    <input type="hidden" class="temp" name="nilai_a1">
                                </div>
                            </div>
                            {{-- Pengajuan Laporan Kajian Teknis sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'A')" name="bobot"
                                            class="form-check-input" id="check_a2">
                                        <input type="hidden" name="text_a2"
                                            value="Pengajuan laporan Kajian Teknis sesuai dengan jadwal">
                                        <label for="check_a2" class="form-check-label">
                                            Pengajuan laporan Kajian Teknis sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_a2" value="ya"
                                                onchange="getValue(this,'A')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_a2" value="tidak"
                                                onchange="getValue(this,'A')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_a2" readonly>
                                    <input type="hidden" class="temp" name="nilai_a2">
                                </div>
                            </div>
                            {{-- Pengajuan Program Mutu sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'A')" name="bobot"
                                            class="form-check-input" id="check_a3">
                                        <input type="hidden" name="text_a3"
                                            value="Pengajuan Program Mutu sesuai dengan jadwal">
                                        <label for="check_a3" class="form-check-label">
                                            Pengajuan Program Mutu sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_a3" value="ya"
                                                onchange="getValue(this,'A')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_a3" value="tidak"
                                                onchange="getValue(this,'A')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_a3" readonly>
                                    <input type="hidden" class="temp" name="nilai_a3">
                                </div>
                            </div>
                            {{-- Pelaksanaan Mobilisasi sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'A')" name="bobot"
                                            class="form-check-input" id="check_a4">
                                        <input type="hidden" name="text_a4"
                                            value="Pelaksanaan Mobilisasi sesuai dengan jadwal">
                                        <label for="check_a4" class="form-check-label">
                                            Pelaksanaan Mobilisasi sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_a4" value="ya"
                                                onchange="getValue(this,'A')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_a4" value="tidak"
                                                onchange="getValue(this,'A')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_a4" readonly>
                                    <input type="hidden" class="temp" name="nilai_a4">
                                </div>
                            </div>

                            <!-- Summary Section -->
                            <div class="form-group row align-items-center mt-4">
                                <label for="bobot_b" class="col-sm-6 col-form-label font-weight-bold">Bobot</label>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="bobot_a" readonly>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="total_b" class="col-sm-6 col-form-label font-weight-bold">Total</label>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="total_a" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- B --}}
            <div class="row mt-3" id="tableB">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            B. Aspek Kinerja ( Pelaksanaan Pekerjaan )
                        </div>
                        <div class="card-body">
                            {{-- Pengajuan Shop Drawing sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',1)" name="bobot"
                                            class="form-check-input" id="check_b1">
                                        <input type="hidden" name="text_b1"
                                            value="Pengajuan Shop Drawing sesuai dengan jadwal">
                                        <label for="check_b1" class="form-check-label">
                                            Pengajuan Shop Drawing sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b1" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b1" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b1" readonly>
                                    <input type="hidden" class="temp" name="nilai_b1">
                                </div>
                            </div>
                            {{-- Pengajuan uji bahan sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',2)" name="bobot"
                                            class="form-check-input" id="check_b2">
                                        <input type="hidden" name="text_b2"
                                            value="Pengajuan uji bahan sesuai dengan jadwal">

                                        <label for="check_b2" class="form-check-label">
                                            Pengajuan uji bahan sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b2" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b2" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b2" readonly>
                                    <input type="hidden" class="temp" name="nilai_b2">
                                </div>
                            </div>
                            {{-- Pengajuan Request sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',3)" name="bobot"
                                            class="form-check-input" id="check_b3">
                                        <input type="hidden" name="text_b3"
                                            value="Pengajuan Request sesuai dengan jadwal">
                                        <label for="check_b3" class="form-check-label">
                                            Pengajuan Request sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b3" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b3" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b3" readonly>
                                    <input type="hidden" class="temp" name="nilai_b3">
                                </div>
                            </div>
                            {{-- Jumlah dan kualifikasi pekerja sesuai dengan Request --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',4)" name="bobot"
                                            class="form-check-input" id="check_b4">
                                        <input type="hidden" name="text_b4"
                                            value="Jumlah dan kualifikasi pekerja sesuai dengan Request">

                                        <label for="check_b4" class="form-check-label">
                                            Jumlah dan kualifikasi pekerja sesuai dengan Request
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b4" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b4" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b4" readonly>
                                    <input type="hidden" class="temp" name="nilai_b4">
                                </div>
                            </div>
                            {{-- Jumlah, Jenis, dan kapasitas alat sesuai dengan Request --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',5)" name="bobot"
                                            class="form-check-input" id="check_b5">
                                        <input type="hidden" name="text_b5"
                                            value="Jumlah, Jenis, dan kapasitas alat sesuai dengan Request">
                                        <label for="check_b5" class="form-check-label">
                                            Jumlah, Jenis, dan kapasitas alat sesuai dengan Request
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b5" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b5" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b5" readonly>
                                    <input type="hidden" class="temp" name="nilai_b5">
                                </div>
                            </div>
                            {{-- Kualitas dan kuantitas pasokan bahan sesuai dengan Request --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',6)" name="bobot"
                                            class="form-check-input" id="check_b6">
                                        <input type="hidden" name="text_b6"
                                            value="Kualitas dan kuantitas pasokan bahan sesuai dengan Request">
                                        <label for="check_b6" class="form-check-label">
                                            Kualitas dan kuantitas pasokan bahan sesuai dengan Request
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b6" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b6" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b6" readonly>
                                    <input type="hidden" class="temp" name="nilai_b6">
                                </div>
                            </div>
                            {{-- Volume hasil pekerjaan sesuai dengan target --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',7)" name="bobot"
                                            class="form-check-input" id="check_b7">
                                        <input type="hidden" name="text_b7"
                                            value="Volume hasil pekerjaan sesuai dengan target">
                                        <label for="check_b7" class="form-check-label">
                                            Volume hasil pekerjaan sesuai dengan target
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b7" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b7" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b7" readonly>
                                    <input type="hidden" class="temp" name="nilai_b7">
                                </div>
                            </div>
                            {{-- Tidak terjadi masalah pada peralatan --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',8)" name="bobot"
                                            class="form-check-input" id="check_b8">
                                        <input type="hidden" name="text_b8"
                                            value="Tidak terjadi masalah pada peralatan">
                                        <label for="check_b8" class="form-check-label">
                                            Tidak terjadi masalah pada peralatan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b8" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b8" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b8" readonly>
                                    <input type="hidden" class="temp" name="nilai_b8">
                                </div>
                            </div>
                            {{-- Tidak terjadi masalah dalam penyediaan bahan --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',9)" name="bobot"
                                            class="form-check-input" id="check_b9">
                                        <input type="hidden" name="text_b9"
                                            value="Tidak terjadi masalah dalam penyediaan bahan">
                                        <label for="check_b9" class="form-check-label">
                                            Tidak terjadi masalah dalam penyediaan bahan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b9" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b9" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b9" readonly>
                                    <input type="hidden" class="temp" name="nilai_b9">
                                </div>
                            </div>
                            {{-- Tidak terjadi perbaikan pekerjaan akibat kegagalan hasil pekerjaan atau uji hasil
                            pekerjaan tidak memenuhi syarat --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',10)" name="bobot"
                                            class="form-check-input" id="check_b10">
                                        <input type="hidden" name="text_b10"
                                            value="Tidak terjadi perbaikan pekerjaan akibat kegagalan hasil pekerjaan atau uji hasil pekerjaan tidak memenuhi syarat">
                                        <label for="check_b10" class="form-check-label">
                                            Tidak terjadi perbaikan pekerjaan akibat kegagalan hasil pekerjaan atau uji
                                            hasil pekerjaan tidak memenuhi syarat
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b10" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b10" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b10" readonly>
                                    <input type="hidden" class="temp" name="nilai_b10">
                                </div>
                            </div>
                            {{-- Kelengkapan K3 untuk pekerja Terpenuhi --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',11)" name="bobot"
                                            class="form-check-input" id="check_b11">
                                        <input type="hidden" name="text_b11"
                                            value="Kelengkapan K3 untuk pekerja Terpenuhi">
                                        <label for="check_b11" class="form-check-label">
                                            Kelengkapan K3 untuk pekerja Terpenuhi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b11" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b11" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b11" readonly>
                                    <input type="hidden" class="temp" name="nilai_b11">
                                </div>
                            </div>
                            {{-- Pengendalian Lalu Lintas terpenuhi --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',12)" name="bobot"
                                            class="form-check-input" id="check_b12">
                                        <input type="hidden" name="text_b12" value="Pengendalian Lalu Lintas terpenuhi">
                                        <label for="check_b12" class="form-check-label">
                                            Pengendalian Lalu Lintas terpenuhi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b12" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b12" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b12" readonly>
                                    <input type="hidden" class="temp" name="nilai_b12">
                                </div>
                            </div>
                            {{-- Tidak terjadi kecelakaan kerja --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',13)" name="bobot"
                                            class="form-check-input" id="check_b13">
                                        <input type="hidden" name="text_b13" value="Tidak terjadi kecelakaan kerja">
                                        <label for="check_b13" class="form-check-label">
                                            Tidak terjadi kecelakaan kerja
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b13" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b13" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b13" readonly>
                                    <input type="hidden" class="temp" name="nilai_b13">
                                </div>
                            </div>
                            {{-- Tidak menerima surat teguran berkaitan dengan pelaksanaan pekerjaan --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',14)" name="bobot"
                                            class="form-check-input" id="check_b14">
                                        <input type="hidden" name="text_b14"
                                            value="Tidak menerima surat teguran berkaitan dengan pelaksanaan pekerjaan">
                                        <label for="check_b14" class="form-check-label">
                                            Tidak menerima surat teguran berkaitan dengan pelaksanaan pekerjaan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b14" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b14" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b14" readonly>
                                    <input type="hidden" class="temp" name="nilai_b14">
                                </div>
                            </div>
                            {{-- Sosialisasi/Pemberitahuan ke lingkungan sekitar pekerjaan dilakukan --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',15)" name="bobot"
                                            class="form-check-input" id="check_b15">
                                        <input type="hidden" name="text_b15"
                                            value="Sosialisasi/Pemberitahuan ke lingkungan sekitar pekerjaan dilakukan">
                                        <label for="check_b15" class="form-check-label">
                                            Sosialisasi/Pemberitahuan ke lingkungan sekitar pekerjaan dilakukan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b15" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b15" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b15" readonly>
                                    <input type="hidden" class="temp" name="nilai_b15">
                                </div>
                            </div>
                            {{-- Tidak ada Komplain/Permasalahan dengan Lingkungan sekitar --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',16)" name="bobot"
                                            class="form-check-input" id="check_b16">
                                        <input type="hidden" name="text_b16"
                                            value="Tidak ada Komplain/Permasalahan dengan Lingkungan sekitar">
                                        <label for="check_b16" class="form-check-label">
                                            Tidak ada Komplain/Permasalahan dengan Lingkungan sekitar
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b16" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b16" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b16" readonly>
                                    <input type="hidden" class="temp" name="nilai_b16">
                                </div>
                            </div>
                            {{-- Progres Item Pekerjaan tidak mengalami keterlambatan --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'B',17)" name="bobot"
                                            class="form-check-input" id="check_b17">
                                        <input type="hidden" name="text_b17"
                                            value="Progres Item Pekerjaan tidak mengalami keterlambatan">
                                        <label for="check_b17" class="form-check-label">
                                            Progres Item Pekerjaan tidak mengalami keterlambatan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_b17" value="ya"
                                                onchange="getValue(this,'B')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_b17" value="tidak"
                                                onchange="getValue(this,'B')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_b17" readonly>
                                    <input type="hidden" class="temp" name="nilai_b17">
                                </div>
                            </div>



                            <!-- Summary Section -->
                            <div class="form-group row align-items-center mt-4">
                                <label for="bobot_b" class="col-sm-6 col-form-label font-weight-bold">Bobot</label>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="bobot_b" readonly>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="total_b" class="col-sm-6 col-form-label font-weight-bold">Total</label>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="total_b" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- C --}}
            <div class="row mt-3" id="tableC">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            C. Aspek Kinerja ( Progres dan Pelaporan )
                        </div>
                        <div class="card-body">
                            {{-- Progres Pekerjaan Tidak mengalami keterlambatan --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'C',1)" name="bobot"
                                            class="form-check-input" id="check_c1">
                                        <input type="hidden" name="text_c1"
                                            value="Progres Pekerjaan Tidak mengalami keterlambatan">
                                        <label for="check_c1" class="form-check-label">
                                            Progres Pekerjaan Tidak mengalami keterlambatan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_c1" value="ya"
                                                onchange="getValue(this,'C')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_c1" value="tidak"
                                                onchange="getValue(this,'C')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_c1" readonly>
                                    <input type="hidden" class="temp" name="nilai_c1">
                                </div>
                            </div>
                            {{-- Tidak dalam kontrak kritis --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'C',2)" name="bobot"
                                            class="form-check-input" id="check_c2">
                                        <input type="hidden" name="text_c2" value="Tidak dalam kontrak kritis">
                                        <label for="check_c2" class="form-check-label">
                                            Tidak dalam kontrak kritis
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_c2" value="ya"
                                                onchange="getValue(this,'C')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_c2" value="tidak"
                                                onchange="getValue(this,'C')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_c2" readonly>
                                    <input type="hidden" class="temp" name="nilai_c2">
                                </div>
                            </div>
                            {{-- Pengajuan Laporan Harian sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'C',3)" name="bobot"
                                            class="form-check-input" id="check_c3">
                                        <input type="hidden" name="text_c3"
                                            value="Pengajuan Laporan Harian sesuai dengan jadwal">
                                        <label for="check_c3" class="form-check-label">
                                            Pengajuan Laporan Harian sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_c3" value="ya"
                                                onchange="getValue(this,'C')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_c3" value="tidak"
                                                onchange="getValue(this,'C')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_c3" readonly>
                                    <input type="hidden" class="temp" name="nilai_c3">
                                </div>
                            </div>
                            {{-- Pengajuan Back Up Kualitas sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'C',4)" name="bobot"
                                            class="form-check-input" id="check_c4">
                                        <input type="hidden" name="text_c4"
                                            value="Pengajuan Back Up Kualitas sesuai dengan jadwal">
                                        <label for="check_c4" class="form-check-label">
                                            Pengajuan Back Up Kualitas sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_c4" value="ya"
                                                onchange="getValue(this,'C')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_c4" value="tidak"
                                                onchange="getValue(this,'C')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_c4" readonly>
                                    <input type="hidden" class="temp" name="nilai_c4">
                                </div>
                            </div>
                            {{-- Pengajuan Back Up Kuantitas sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'C',5)" name="bobot"
                                            class="form-check-input" id="check_c5">
                                        <input type="hidden" name="text_c5"
                                            value="Pengajuan Back Up Kuantitas sesuai dengan jadwal">
                                        <label for="check_c5" class="form-check-label">
                                            Pengajuan Back Up Kuantitas sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_c5" value="ya"
                                                onchange="getValue(this,'C')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_c5" value="tidak"
                                                onchange="getValue(this,'C')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_c5" readonly>
                                    <input type="hidden" class="temp" name="nilai_c5">
                                </div>
                            </div>
                            {{-- Pengajuan MC sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'C',6)" name="bobot"
                                            class="form-check-input" id="check_c6">
                                        <input type="hidden" name="text_c6" value="Pengajuan MC sesuai dengan jadwal">
                                        <label for="check_c6" class="form-check-label">
                                            Pengajuan MC sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_c6" value="ya"
                                                onchange="getValue(this,'C')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_c6" value="tidak"
                                                onchange="getValue(this,'C')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_c6" readonly>
                                    <input type="hidden" class="temp" name="nilai_c6">
                                </div>
                            </div>
                            <!-- Summary Section -->
                            <div class="form-group row align-items-center mt-4">
                                <label for="bobot_b" class="col-sm-6 col-form-label font-weight-bold">Bobot</label>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="bobot_c" readonly>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="total_b" class="col-sm-6 col-form-label font-weight-bold">Total</label>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="total_c" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- D --}}
            <div class="row mt-3" id="tableD">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            D. Aspek Kinerja ( Penyelesaian Masa Pelaksanaan )
                        </div>
                        <div class="card-body">
                            {{-- Tidak melewati masa pelaksanaan --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'D',1)" name="bobot"
                                            class="form-check-input" id="check_d1">
                                        <input type="hidden" name="text_d1" value="Tidak melewati masa pelaksanaan">
                                        <label for="check_d1" class="form-check-label">
                                            Tidak melewati masa pelaksanaan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_d1" value="ya"
                                                onchange="getValue(this,'D')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_d1" value="tidak"
                                                onchange="getValue(this,'D')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_d1" readonly>
                                    <input type="hidden" class="temp" name="nilai_d1">
                                </div>
                            </div>
                            {{-- Tidak terjadi perubahan signifikan antara kuantitas hasil Kajian Teknis dengan
                            kuantitas akhir --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'D',2)" name="bobot"
                                            class="form-check-input" id="check_d2">
                                        <input type="hidden" name="text_d2"
                                            value="Tidak terjadi perubahan signifikan antara kuantitas hasil Kajian Teknis dengan kuantitas akhir">
                                        <label for="check_d2" class="form-check-label">
                                            Tidak terjadi perubahan signifikan antara kuantitas hasil Kajian Teknis
                                            dengan kuantitas akhir
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_d2" value="ya"
                                                onchange="getValue(this,'D')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_d2" value="tidak"
                                                onchange="getValue(this,'D')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_d2" readonly>
                                    <input type="hidden" class="temp" name="nilai_d2">
                                </div>
                            </div>
                            {{-- Pengajuan As Built Drawing sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'D',3)" name="bobot"
                                            class="form-check-input" id="check_d3">
                                        <input type="hidden" name="text_d3"
                                            value="Pengajuan As Built Drawing sesuai dengan jadwal">
                                        <label for="check_d3" class="form-check-label">
                                            Pengajuan As Built Drawing sesuai dengan jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_d3" value="ya"
                                                onchange="getValue(this,'D')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_d3" value="tidak"
                                                onchange="getValue(this,'D')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_d3" readonly>
                                    <input type="hidden" class="temp" name="nilai_d3">
                                </div>
                            </div>
                            {{-- Pengajuan Pernyataan Akhir pekerjaan (lengkap dengan back up) sesuai dengan jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'D',4)" name="bobot"
                                            class="form-check-input" id="check_d4">
                                        <input type="hidden" name="text_d4"
                                            value="Pengajuan Pernyataan Akhir pekerjaan (lengkap dengan back up) sesuai dengan jadwal">
                                        <label for="check_d4" class="form-check-label">
                                            Pengajuan Pernyataan Akhir pekerjaan (lengkap dengan back up) sesuai dengan
                                            jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_d4" value="ya"
                                                onchange="getValue(this,'D')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_d4" value="tidak"
                                                onchange="getValue(this,'D')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_d4" readonly>
                                    <input type="hidden" class="temp" name="nilai_d4">
                                </div>
                            </div>
                            {{-- Pengajuan Jaminan Pemeliharaan Sesuai jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'D',5)" name="bobot"
                                            class="form-check-input" id="check_d5">
                                        <input type="hidden" name="text_d5"
                                            value="Pengajuan Jaminan Pemeliharaan Sesuai jadwal">
                                        <label for="check_d5" class="form-check-label">
                                            Pengajuan Jaminan Pemeliharaan Sesuai jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_d5" value="ya"
                                                onchange="getValue(this,'D')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_d5" value="tidak"
                                                onchange="getValue(this,'D')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_d5" readonly>
                                    <input type="hidden" class="temp" name="nilai_d5">
                                </div>
                            </div>
                            {{-- Pengajuan Jadwal Pemeliharaan sesuai jadwal --}}
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" onchange="countColom(this.checked,'D',6)" name="bobot"
                                            class="form-check-input" id="check_d6">
                                        <input type="hidden" name="text_d6"
                                            value="Pengajuan Jadwal Pemeliharaan sesuai jadwal">
                                        <label for="check_d6" class="form-check-label">
                                            Pengajuan Jadwal Pemeliharaan sesuai jadwal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-success text-white">
                                            <input type="radio" name="nilai_d6" value="ya"
                                                onchange="getValue(this,'D')"> Ya
                                        </label>
                                        <label class="btn bg-danger text-white">
                                            <input type="radio" name="nilai_d6" value="tidak"
                                                onchange="getValue(this,'D')"> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_d6" readonly>
                                    <input type="hidden" class="temp" name="nilai_d6">
                                </div>
                            </div>
                            <!-- Summary Section -->
                            <div class="form-group row align-items-center mt-4">
                                <label for="bobot_b" class="col-sm-6 col-form-label font-weight-bold">Bobot</label>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="bobot_d" readonly>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="total_b" class="col-sm-6 col-form-label font-weight-bold">Total</label>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="total_d" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="card-footer">
                <button type="submit" class="btn btn-primary w-100 mt-2">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/custom/penilaian.js') }}"></script>
@endsection