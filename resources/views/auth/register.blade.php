@extends('frontend.layouts.app')
@section('title', 'Register')
@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="font-weight-bold">Daftar Akun</h2>
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li>Daftar Akun</li>
                    </ol>
                </div>
            </div>
        </section><!-- Breadcrumbs Section -->
        <!-- ======= Register Section ======= -->
        <section id="register">
            <div class="container" data-aos="fade-up">
                <div class="col text-center mt-2">
                    <h2 style="color: #0c2e8a">Form Registrasi</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="form-register">
                            <form action="{{ route('register.action') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-2">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="name">Nama <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            placeholder="ex. Muhammad Abdul Majid" required value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 mt-3 mt-md-0">
                                        <label class="form-label" for="gender">Jenis Kelamin <span
                                                class="text-danger">*</span></label>
                                        <div class="form-outline">
                                            <select name="gender" id="gender"
                                                class="form-control custom-select @error('gender') is-invalid @enderror">
                                                <option disabled selected>Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>
                                                    Laki-Laki
                                                </option>
                                                <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="nim">NIM <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="nim"
                                            class="form-control @error('nim') is-invalid @enderror" id="nim"
                                            placeholder="ex. 21120118140042" required value="{{ old('nim') }}">
                                        @error('nim')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 mt-3 mt-md-0">
                                        <label class="form-label" for="email">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            placeholder="ex. mail@gmail.com" required value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="role">Status <span
                                                class="text-danger">*</span></label>
                                        <div class="form-outline">
                                            <select name="role" id="role"
                                                class="form-control custom-select @error('role') @enderror">
                                                <option disabled selected>Pilih Status</option>
                                                <option value="mahasiswa"
                                                    {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>
                                                    Mahasiswa
                                                </option>
                                                <option value="alumni" {{ old('role') == 'alumni' ? 'selected' : '' }}>
                                                    Alumni
                                                </option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 mt-3 mt-md-0">
                                        <label class="form-label" for="mobile_number">No Telephone <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="mobile_number"
                                            class="form-control @error('mobile_number') is-invalid @enderror"
                                            id="mobile_number" placeholder="ex. 080111222333" required
                                            value="{{ old('mobile_number') }}">
                                        @error('mobile_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="ktm" class="form-label">KTM/KTA (max 1 MB) <span
                                            class="text-danger">*</span></label>
                                    <img class="ktm-preview img-fluid mb-3 col-sm-5 text-center">
                                    <input type="file" name="ktm" id="ktm"
                                        class="form-control @error('ktm') is-invalid @enderror" onchange="previewKTM()">
                                    @error('ktm')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="password">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="....." required>
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 mt-3 mt-md-0">
                                        <label class="form-label" for="password-confirm">Konfirmasi Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="password-confirm"
                                            class="form-control @error('password-confirm') is-invalid @enderror"
                                            id="password-confirm" placeholder="....." required>
                                        @error('password-confirm')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="mt-4">Daftar</button>
                                </div>
                            </form>
                            <div class="text-center">
                                <small class="d-block mt-3">Sudah memiliki akun?
                                    <a style="color: #0c2e8a" href="{{ route('login') }}">Login Sekarang!</a>
                                </small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script src="{{ asset('frontend/js/show-hide-password-group.js') }}"></script>
    <script>
        // Show Hide Password
        $(document).ready(function() {
            $('input[type=\'password\']').showHidePassword();
        });

        // Preview KTM
        function previewKTM() {
            const ktm = document.querySelector('#ktm');
            const ktmPreview = document.querySelector('.ktm-preview');

            ktmPreview.style.display = 'block';
            ktmPreview.style.margin = 'auto';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(ktm.files[0])

            oFReader.onload = function(oFREvent) {
                ktmPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
