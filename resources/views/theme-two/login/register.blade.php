<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Form Registrasi</title>
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}" />
    </head>
    <body>
        @include('flashalert.index')
        <div class="container mt-5">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">Data User</div>
                    <div class="card-body">
                        <div class="mb-1 row">
                            <label
                                for="staticEmail"
                                class="col-sm-2 col-form-label"
                                >Nama Lengkap :</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Nama Lengkap"
                                    required
                                    value="{{ old('name') }}"
                                />
                            </div>
                        </div>
                        
                        <div class="mb-1 row">
                            <label
                                for="staticEmail"
                                class="col-sm-2 col-form-label"
                                >Alamat :</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    name="alamat_user"
                                    class="form-control"
                                    placeholder="Masukan Alamat"
                                    required
                                    value="{{ old('alamat_user') }}"
                                />
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label
                                for="staticEmail"
                                class="col-sm-2 col-form-label"
                                >No. Telp :</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="tel"
                                    maxlength="12"
                                    class="form-control"
                                    id="tlp"
                                    placeholder="08221XXXXXXX"
                                    name="tlp_user"
                                    required
                                    value="{{ old('tlp_user') }}"
                                />
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label
                                for="staticEmail"
                                class="col-sm-2 col-form-label"
                                >NIK :</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nik"
                                    placeholder="327051XXXXXX"
                                    name="nik"
                                    value="{{ old('nik') }}"
                                    {{-- oninput="removeErr('#nik','#errNik')" --}}
                                />
                               
                                @error('nik')
                                    <div class="invalid-feedback" style="display: block; color:red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label
                                for="staticEmail"
                                class="col-sm-2 col-form-label"
                                >NIP :</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nip"
                                    placeholder="327051XXXXXX"
                                    name="nip"
                                    
                                    value="{{ old('nip') }}"
                                    {{-- oninput="removeErr('#nip','#errnip')" --}}
                                />
                                
                                @error('nip')
                                    <div class="invalid-feedback" style="display: block; color:red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label
                                for="staticEmail"
                                class="col-sm-2 col-form-label"
                                >Email :</label>
                            <div class="col-sm-10">
                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="example@example.com"
                                    name="email"
                                    required
                                    id="email"
                                    value="{{ old('email') }}"
                                    {{-- oninput="removeErr('#email','#errEmail')" --}}
                                />
                                
                                @error('email')
                                    <div class="invalid-feedback" style="display: block; color:red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Password :</label>
                            <div class="col-sm-10">
                                
                                <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="Masukkan Password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <div class="invalid-feedback" style="display: block; color:red">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Ulangi Password :</label>
                            <div class="col-sm-10">
                                <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Masukkan Kembali Password" class="form-control" required>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Data Perusahaan</div>
                    <div class="card-body">
                        <div class="mb-1 row">
                            <label for="jenis" class="col-sm-2 col-form-label"
                                >Jenis Perusahaan</label>
                            <div class="col-sm-10">
                                <select
                                    name="role"
                                    id="jenis"
                                    class="form-control"
                                    onchange="render(this.value)"
                                    required
                                    value="{{ old('jenis') }}"
                                >
                                    <option selected>Jenis Perusahaan</option>
                                    <option value="ADMIN-UPTD">
                                        ADMIN-UPTD
                                    </option>
                                    <option value="PPK">PPK</option>
                                    <option value="KONSULTAN">KONSULTAN</option>
                                    <option value="KONTRAKTOR">
                                        KONTRAKTOR
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-1 row" id="unor">
                            <label for="jenis" class="col-sm-2 col-form-label"
                                >Unit :</label>
                            <div class="col-sm-10">
                                <select
                                    name="unit"
                                    class="form-control"
                                    required
                                    value="{{ old('unit') }}"
                                >
                                    <option value="" selected></option>
                                    @foreach (@$uptd_list as $item)
                                        <option value="{{ $item->id }}" >{{ $item->nama }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        <div class="wrap-jenis" id="konsultan">
                            <div class="mb-1 row">
                                <label
                                    for="staticEmail"
                                    class="col-sm-2 col-form-label"
                                    >Jabatan :</label>
                                <div class="col-sm-10">
                                    <select
                                        name="jabatan_konsultan"
                                        class="form-control"
                                        id="jabatan_konsultan"
                                        value="{{ old('jabatan_konsultan') }}"
                                        placeholder="Jabatan Anda">
                                        <option value="" selected>Jabatan Anda</option>
                                        <option value="ADMIN">Admin</option>
                                        <option value="DIREKTUR">Direktur</option>
                                    </select>
                                    @error('jabatan_konsultan')
                                    <div class="invalid-feedback" style="display: block; color:red">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label
                                    for="staticEmail"
                                    class="col-sm-2 col-form-label"
                                    >Nama Perusahaan :</label
                                >
                                <div class="col-sm-10">
                                    @if(Session::get('nm_perusahaan_konsultan'))
                                    <input
                                        type="text"
                                        class="form-control text-uppercase"
                                        placeholder="Nama Perusahaan"
                                        name="nm_perusahaan_konsultan"
                                        id="nmKonsultan"
                                        value="{{
                                            old('nm_perusahaan_konsultan')
                                        }}"
                                        oninput="removeErr('#nmKonsultan','#errNmKon')"
                                    />
                                    <span
                                        class="err-msg text-danger"
                                        id="errNmKon"
                                        >Perusahaan Sudah Terdaftar</span
                                    >
                                    @else
                                    <input
                                        type="text"
                                        class="form-control text-uppercase"
                                        placeholder="Nama Perusahaan"
                                        name="nm_perusahaan_konsultan"
                                    />
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mb-1 row">
                                <label
                                    for="staticEmail"
                                    class="col-sm-2 col-form-label"
                                    >Alamat Perusahaan :</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="alamat_perusahaan_konsultan"
                                        placeholder="Alamat Perusahaan"
                                        value="{{
                                            old('alamat_perusahaan_konsultan')
                                        }}"
                                    />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label
                                    for="staticEmail"
                                    class="col-sm-2 col-form-label"
                                    >Nama Direktur :</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Nama Direktur"
                                        name="nm_direktur_konsultan"
                                        value="{{
                                            old('nm_direktur_konsultan')
                                        }}"
                                    />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label
                                    for="npwp"
                                    class="col-sm-2 col-form-label"
                                    >NPWP :</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="npwp"
                                        name="npwp_konsultan"
                                        placeholder="12.345.674.9-629.000"
                                        data-inputmask="'mask': '9999 9999 9999 9999'"
                                        value="{{ old('npwp') }}"
                                    />
                                    @error('npwp_konsultan')
                                        <div class="invalid-feedback" style="display: block; color:red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label
                                    for="tlp_perusahaan"
                                    class="col-sm-2 col-form-label"
                                    >No. Telp :</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="tlp_perusahaan_konsultan"
                                        placeholder="022-250XXXXX"
                                        value="{{ old('tlp_perusahaan') }}"
                                    />
                                    @error('tlp_perusahaan_konsultan')
                                        <div class="invalid-feedback" style="display: block; color:red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="wrap-jenis" id="kontraktor">
                            <div class="mb-1 row">
                                <label
                                    for="staticEmail"
                                    class="col-sm-2 col-form-label"
                                    >Jabatan :</label>
                                    <div class="col-sm-10">
                                        <select
                                            name="jabatan_kontraktor"
                                            class="form-control"
                                            id="jabatan_kontraktor"
                                            value="{{ old('jabatan_kontraktor') }}"
                                            placeholder="Jabatan Anda">
                                            <option value="" selected>Jabatan Anda</option>
                                            <option value="ADMIN">Admin</option>
                                            <option value="DIREKTUR">Direktur</option>
                                        </select>
                                        @error('jabatan_kontraktor')
                                        <div class="invalid-feedback" style="display: block; color:red">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                            </div>
                            <div class="mb-1 row">
                                <label
                                    for="staticEmail"
                                    class="col-sm-2 col-form-label"
                                    >Nama Perusahaan :</label
                                >
                                <div class="col-sm-10">
                                    @if(Session::get('nm_perusahaan_kontraktor'))
                                    <input
                                        type="text"
                                        class="form-control text-uppercase"
                                        name="nm_perusahaan_kontraktor"
                                        placeholder="Nama Perusahaan"
                                        id="nmKontraktor"
                                        value="{{
                                            old('nm_perusahaan_kontraktor')
                                        }}"
                                        oninput="removeErr('#nmKontraktor','#errNmKont')"
                                    />
                                    <span
                                        class="err-msg text-danger"
                                        id="errNmKont"
                                        >Perusahaan Sudah Terdaftar</span
                                    >
                                    @else
                                    <input
                                        type="text"
                                        class="form-control text-uppercase"
                                        name="nm_perusahaan_kontraktor"
                                        placeholder="Nama Perusahaan"
                                    />
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mb-1 row">
                                <label
                                    for="staticEmail"
                                    class="col-sm-2 col-form-label"
                                    >Alamat Perusahaan :</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="alamat_perusahaan_kontraktor"
                                        placeholder="Alamat Perusahaan"
                                        value="{{
                                            old('alamat_perusahaan_kontraktor')
                                        }}"
                                    />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label
                                    for="staticEmail"
                                    class="col-sm-2 col-form-label"
                                    >Nama Direktur :</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="nm_direktur"
                                        placeholder="Nama Direktur"
                                        value="{{
                                            old('nm_direktur_kontraktor')
                                        }}"
                                    />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label
                                    for="npwp"
                                    class="col-sm-2 col-form-label"
                                    >NPWP :</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="npwp_kontraktor"
                                        name="npwp"
                                        placeholder="12.345.674.9-629.000"
                                        data-inputmask="'mask': '9999 9999 9999 9999'"
                                        value="{{ old('npwp') }}"
                                    />
                                    @error('npwp')
                                        <div class="invalid-feedback" style="display: block; color:red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label
                                    for="tlp_perusahaan"
                                    class="col-sm-2 col-form-label"
                                    >No. Telp :</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="tlp_perusahaan"
                                        placeholder="022-250XXXXX"
                                        value="{{ old('tlp_perusahaan') }}"
                                    />
                                    @error('tlp_perusahaan')
                                        <div class="invalid-feedback" style="display: block; color:red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label
                                    for="bank"
                                    class="col-sm-2 col-form-label"
                                    >Bank :</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="bank"
                                        placeholder="BJB CABANG ...."
                                        value="{{ old('bank') }}"
                                    />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label
                                    for="norek"
                                    class="col-sm-2 col-form-label"
                                    >No. Rekening :</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="norek"
                                        name="no_rek"
                                        placeholder="280XXXXX"
                                        value="{{ old('no_rek') }}"
                                    />
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100 mt-2">
                    Submit
                </button>
            </form>
        </div>

        <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
        <script src="{{
                asset('vendor/bootstrap/js/bootstrap.min.js')
            }}"></script>
        <script src="{{ asset('assets/custom/register.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        
        <script>
            $(document).ready(function(){
            $('#npwp').mask('00.000.000.0-000.000');
            $('#npwp_kontraktor').mask('00.000.000.0-000.000');

            });
        </script>
    </body>
</html>
