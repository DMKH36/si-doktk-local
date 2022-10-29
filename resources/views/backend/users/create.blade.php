@extends('backend.layouts.app')
@section('title', 'Tambah Pengguna')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Tambah Pengguna</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Data Pengguna</a></li>
                <li class="breadcrumb-item active">Tambah Pengguna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Create Operator Page -->
    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Data Pengguna</h5>
                    <a href="{{ route('user.index') }}" class="btn btn-warning">
                        << Kembali </a>
                            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data"
                                class="row">
                                @csrf
                                <!-- Kolom Nama -->
                                <div class="col-lg-12">
                                    <div class="col-12 mt-3">
                                        <label for="name" class="form-label">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" required
                                            value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kolom Kiri -->
                                <div class="col-lg-6">
                                    <div class="col-12 mt-3">
                                        <label for="nim" class="form-label">NIM <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="nim" name="nim" required
                                            value="{{ old('nim') }}"
                                            class="form-control @error('nim') is-invalid @enderror">
                                        @error('nim')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" required
                                            value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="role" class="form-label">Role <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <select id="role" name="role" aria-label="Default select example"
                                                class="form-select @error('role') is-invalid @enderror">
                                                <option disabled selected>Pilih Role</option>
                                                <option value="mahasiswa"
                                                    {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>
                                                    Mahasiswa
                                                </option>
                                                <option value="alumni" {{ old('role') == 'alumni' ? 'selected' : '' }}>
                                                    Alumni
                                                </option>
                                            </select>
                                        </div>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-lg-6">
                                    <div class="col-12 mt-3">
                                        <label for="gender" class="form-label">Jenis Kelamin</label>
                                        <div class="col-sm-12">
                                            <select id="gender" name="gender" aria-label="Default select example"
                                                class="form-select @error('gender') is-invalid @enderror">
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
                                    <div class="col-12 mt-3">
                                        <label for="mobile_number" class="form-label">No. Telephone</label>
                                        <input type="text" id="mobile_number" name="mobile_number"
                                            value="{{ old('mobile_number') }}"
                                            class="form-control @error('mobile_number') is-invalid @enderror">
                                        @error('mobile_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <fieldset class="col-12 mt-3">
                                        <legend class="col-form-label col-sm-2 pt-0">Status <span
                                                class="text-danger">*</span></legend>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status1"
                                                    value="1" {{ old('status') == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status1">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status2"
                                                    value="0" {{ old('status') == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status2">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <!-- Kolom Bawah -->
                                <div class="col-lg-12">
                                    <div class="col-12 mt-3">
                                        <label for="ktm" class="form-label">Foto KTM (Maksimal 1 MB)</label>
                                        <img class="ktm-preview img-fluid mb-3 text-center">
                                        <input type="file" name="ktm" id="ktm"
                                            class="form-control @error('ktm') is-invalid @enderror"
                                            onchange="previewKTM()">
                                        @error('ktm')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-12 mt-3">
                                        <label for="picture" class="form-label">Foto Profile (Maksimal 1 MB)</label>
                                        <img class="picture-preview rounded-circle mb-3 text-center">
                                        <input type="file" name="picture" id="picture"
                                            class="form-control @error('picture') is-invalid @enderror"
                                            onchange="previewPicture()">
                                        @error('picture')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="text-center mt-5">
                                    <button type="submit" class="btn btn-primary text-center">Submit</button>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        // Preview Foto
        function previewKTM() {
            const ktm = document.querySelector('#ktm');
            const ktmPreview = document.querySelector('.ktm-preview');

            ktmPreview.style.display = 'block';
            ktmPreview.style.margin = 'auto';
            ktmPreview.width = '500';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(ktm.files[0])

            oFReader.onload = function(oFREvent) {
                ktmPreview.src = oFREvent.target.result;
            }
        }

        function previewPicture() {
            const picture = document.querySelector('#picture');
            const picturePreview = document.querySelector('.picture-preview');

            picturePreview.style.display = 'block';
            picturePreview.style.margin = 'auto';
            picturePreview.height = '250';
            picturePreview.width = '250';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(picture.files[0])

            oFReader.onload = function(oFREvent) {
                picturePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
