@extends('login.layout.index') @section('title','Login') @section('content')
<div class="login-form">
    @include('flashalert.index')

    <form
        class="login100-form validate-form"
        action="{{ route('login.post') }}"
        method="POST"
    >
        @csrf

        <span class="login100-form-title"> Talikuat Bima Jabar </span>

        <div class="wrap-input100">
            <input
                class="input100"
                type="text"
                name="email"
                placeholder="NIP | NIK | E-MAIL"
                required
            />
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-id-card" aria-hidden="true"></i>
            </span>
        </div>

        <div
            class="wrap-input100 validate-input"
            data-validate="Password Tidak Boleh Kosong"
        >
            <input
                class="input100"
                type="password"
                name="password"
                placeholder="Password"
            />
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>
        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="submit">
                Login
            </button>
        </div>
    </form>

    <div class="container-login100-form-btn">
        {{--
        <a href="{{ url('/register') }}" class="w-100">
            <button class="login100-form-btn bg-warning" type="button">
                Daftar
            </button></a
        >
        --}}
    </div>

    @error('email')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>
@endsection
