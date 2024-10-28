@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrasi') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.custom') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama Lengkap') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>

                            <div class="col-md-6">
                                <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('No Handphone') }}</label>

                            <div class="col-md-6">
                                <input name="phone" id="phone" required type="text" class="form-control" title="gunakan nomor yang valid (08xx) atau (628xx)" pattern="(08|62)\d{10,11}"
                                    oninput="
                                        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
                                        if (this.value.length > 13) this.value = this.value.slice(0, 13);
                                        // validity.valid||(value='');
                                        if (typeof this.reportValidity === 'function') {
                                            this.reportValidity();
                                        }
                                    " 
                                />


                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input onkeyup='check();' id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <span id="eyePw" class="bi bi-eye-slash input-group-text" id="togglePassword" onclick="showPassword()"></span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Konfirmasi Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input onkeyup='check();' id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <span id="eyePwConfirm" class="bi bi-eye-slash input-group-text" id="togglePassword" onclick="showPasswordConfirm()"></span>
                                </div>
                                <p class="mt-1" id="errorMsg"></p>

                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="btn-submit" disabled type="submit" class="btn btn-success">
                                    {{ __('Registrasi') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showPassword() {
        var x = document.getElementById("password");
        var eye = document.getElementById("eyePw");

        if (x.type === "password") {
            x.type = "text";
            eye.className = "bi bi-eye input-group-text"
        } else {
            x.type = "password";
            eye.className = "bi bi-eye-slash input-group-text"
        }
    }

    function showPasswordConfirm() {
        var x = document.getElementById("password-confirm");
        var eye = document.getElementById("eyePwConfirm");

        if (x.type === "password") {
            x.type = "text";
            eye.className = "bi bi-eye input-group-text"
        } else {
            x.type = "password";
            eye.className = "bi bi-eye-slash input-group-text"
        }
    }

    var check = function() {
        let pw = document.getElementById('password');
        let pwC = document.getElementById('password-confirm');
        let msg = document.getElementById('errorMsg');
        let btn = document.getElementById('btn-submit');

        console.log(btn.disabled)
        if (pw.value == pwC.value) {
            if(pw.value.length > 0 || pwC.value.length > 0) {
                msg.style.color = 'green';
                msg.innerHTML = 'password cocok';
                btn.disabled = false;
            }
        } else {
            msg.style.color = 'red';
            msg.innerHTML = 'password tidak sama';
            btn.disabled = true;
        }
    }
</script>
@endsection
