@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card bg-warning">
                <a
                    href="https://tk.temanjabar.net/admin/master_kontraktor"
                    style="text-decoration: none"
                >
                    <div class="card-body px-3 py-4">
                        <div
                            class="d-flex justify-content-between align-items-start"
                        >
                            <div class="color-card">
                                <p class="mb-0 text-white">Penyedia Jasa</p>
                                <h2 class="text-white">35</h2>
                            </div>
                            <i
                                class="fa-solid fa-person-digging"
                                style="
                                    font-size: 48px;
                                    color: #fff;
                                    background-color: #16a75c;
                                    padding: 20px;
                                    border-radius: 50%;
                                "
                            ></i>
                        </div></div
                ></a>
            </div>
        </div>
        <div class="col">
            <div class="card bg-info">
                <a
                    href="https://tk.temanjabar.net/admin/master_kontraktor"
                    style="text-decoration: none"
                >
                    <div class="card-body px-3 py-4">
                        <div
                            class="d-flex justify-content-between align-items-start"
                        >
                            <div class="color-card">
                                <p class="mb-0 text-white">
                                    Konsultan Surpervisi
                                </p>
                                <h2 class="text-white">35</h2>
                            </div>

                            <i
                                class="fa-solid fa-person-shelter"
                                style="
                                    font-size: 48px;
                                    color: #fff;
                                    background-color: #16a75c;
                                    padding: 20px;
                                    border-radius: 50%;
                                "
                            ></i>
                        </div></div
                ></a>
            </div>
        </div>
        <div class="col">
            <div class="card bg-primary">
                <a
                    href="https://tk.temanjabar.net/admin/master_kontraktor"
                    style="text-decoration: none"
                >
                    <div class="card-body px-3 py-4">
                        <div
                            class="d-flex justify-content-between align-items-start"
                        >
                            <div class="color-card">
                                <p class="mb-0 text-white">PPK</p>
                                <h2 class="text-white">35</h2>
                            </div>

                            <i
                                class="fa-solid fa-user-secret"
                                style="
                                    font-size: 48px;
                                    color: #fff;
                                    background-color: #16a75c;
                                    padding: 20px;
                                    border-radius: 50%;
                                "
                            ></i>
                        </div></div
                ></a>
            </div>
        </div>
        <div class="col">
            <div class="card bg-warning">
                <a
                    href="https://tk.temanjabar.net/admin/master_kontraktor"
                    style="text-decoration: none"
                >
                    <div class="card-body px-3 py-4">
                        <div
                            class="d-flex justify-content-between align-items-start"
                        >
                            <div class="color-card">
                                <p class="mb-0 text-white">Paket Pekerjaan</p>
                                <h2 class="text-white">35</h2>
                            </div>
                            <i
                                class="fa-solid fa-signs-post"
                                style="
                                    font-size: 48px;
                                    color: #fff;
                                    background-color: #16a75c;
                                    padding: 20px;
                                    border-radius: 50%;
                                "
                            ></i>
                        </div></div
                ></a>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <i class="fa-solid fa-circle" style="color: blue"></i>
                    <strong>Rencana</strong>
                </div>
                <div class="col">
                    <i class="fa-solid fa-circle" style="color: green"></i>
                    <strong>Realisasi</strong>
                </div>
                <div class="col">
                    <i class="fa-solid fa-circle" style="color: red"></i>
                    <strong>Deviasi</strong>
                </div>
                <div class="col">
                    <i class="fa-solid fa-circle" style="color: yellow"></i>
                    <strong>Waktu</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <h4>PW-1124365254</h4>
                </div>
                <div class="col">
                    <div
                        class="progress"
                        style="height: 25px"
                        role="progressbar"
                        aria-label="Example with label"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        <div class="progress-bar" style="width: 25%">
                            Rencana 25%
                        </div>
                    </div>
                    <div
                        class="progress mt-2"
                        style="height: 25px"
                        role="progressbar"
                        aria-label="Example with label"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        <div class="progress-bar bg-success" style="width: 25%">
                            Realisasi 25%
                        </div>
                    </div>
                    <div
                        class="progress mt-2"
                        style="height: 25px"
                        role="progressbar"
                        aria-label="Example with label"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        <div class="progress-bar bg-danger" style="width: 25%">
                            Deviasi 25%
                        </div>
                    </div>
                    <div
                        class="progress mt-2 bg-success progress-bar-striped"
                        style="height: 25px"
                        role="progressbar"
                        aria-label="Example with label"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        <div class="progress-bar bg-warning" style="width: 25%">
                            Waktu 25%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
