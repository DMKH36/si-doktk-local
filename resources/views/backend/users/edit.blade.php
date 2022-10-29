@extends('backend.layouts.app')
@section('title', 'Edit Pengguna')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Edit Pengurus</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Data Pengurus</a></li>
                <li class="breadcrumb-item active">Edit Pengurus</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <!-- Create User Page -->
    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Data Pengguna</h5>
                    <div class="d-flex" style="justify-content: space-between;">
                        <a href="{{ route('user.index') }}" class="btn btn-warning">{{ '<< Kembali' }}</a>
                        @if ($pengguna->picture)
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delpictureModal">
                                <i class="bi bi-trash"></i> Hapus Foto Profil
                            </button>
                        @endif
                    </div>
                    <form action="{{ route('user.update', $pengguna->id) }}" method="post" enctype="multipart/form-data"
                        class="row">
                        @csrf
                        @method('put')
                        <!-- Kolom Nama -->
                        <div class="col-lg-12">
                            <div class="col-12 mt-3">
                                <label for="name" class="form-label">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" required
                                    value="{{ old('name') ? old('name') : $pengguna->name }}"
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
                                <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                                <input type="text" id="nim" name="nim" required
                                    value="{{ old('nim') ? old('nim') : $pengguna->nim }}"
                                    class="form-control @error('nim') is-invalid @enderror">
                                @error('nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" required
                                    value="{{ old('email') ? old('email') : $pengguna->email }}"
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <select id="role" name="role" aria-label="Default select example"
                                        class="form-select @error('role') is-invalid @enderror">
                                        <option disabled selected>Pilih Role</option>
                                        <option value="mahasiswa"
                                            {{ old('role') ? (old('role') == 'mahasiswa' ? 'selected' : '') : ($pengguna->role == 'mahasiswa' ? 'selected' : '') }}>
                                            Mahasiswa
                                        </option>
                                        <option value="alumni"
                                            {{ old('role') ? (old('role') == 'alumni' ? 'selected' : '') : ($pengguna->role == 'alumni' ? 'selected' : '') }}>
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
                                        <option value="L"
                                            {{ old('gender') ? (old('gender') == 'L' ? 'selected' : '') : ($pengguna->gender == 'L' ? 'selected' : '') }}>
                                            Laki-Laki
                                        </option>
                                        <option value="P"
                                            {{ old('gender') ? (old('gender') == 'P' ? 'selected' : '') : ($pengguna->gender == 'P' ? 'selected' : '') }}>
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
                                    value="{{ old('mobile_number') ? old('mobile_number') : $pengguna->mobile_number }}"
                                    class="form-control @error('mobile_number') is-invalid @enderror">
                                @error('mobile_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <fieldset class="col-12 mt-3">
                                <legend class="col-form-label col-sm-2 pt-0">Status <span class="text-danger">*</span>
                                </legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status1"
                                            value="1"
                                            {{ old('status') ? (old('status') == 1 ? 'checked' : '') : ($pengguna->status == 1 ? 'checked' : '') }}>
                                        <label class="form-check-label" for="status1">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status2"
                                            value="0"
                                            {{ old('status') ? (old('status') == 0 ? 'checked' : '') : ($pengguna->status == 0 ? 'checked' : '') }}>
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
                                <input type="hidden" name="oldKtm" value="{{ $pengguna->ktm }}">
                                @if ($pengguna->ktm)
                                    <img src="{{ asset($pengguna->ktm) }}" width="500"
                                        class="ktm-preview img-fluid mb-3 text-center d-block">
                                @else
                                    <img class="ktm-preview img-fluid mb-3 text-center">
                                @endif
                                <input type="file" name="ktm" id="ktm" onchange="previewKTM()"
                                    class="form-control @error('ktm') is-invalid @enderror">
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
                                <input type="hidden" name="oldPicture" value="{{ $pengguna->picture }}">
                                @if ($pengguna->picture)
                                    <img src="{{ asset($pengguna->picture) }}" height="250" width="250"
                                        class="picture-preview rounded-circle mb-3 text-center d-block">
                                @else
                                    <img class="picture-preview rounded-circle mb-3 text-center">
                                @endif
                                <input type="file" name="picture" id="picture" onchange="previewPicture()"
                                    class="form-control @error('picture') is-invalid @enderror">
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
    @include('backend.users.modal-delpicture')
@endsection

@section('script')
    <script>
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
