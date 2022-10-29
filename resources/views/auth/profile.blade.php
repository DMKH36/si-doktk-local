@extends('frontend.layouts.app')
@section('title', 'My Profile')
@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="font-weight-bold">Detail Profile</h2>
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li>My Profile</li>
                    </ol>
                </div>
            </div>
        </section><!-- Breadcrumbs Section -->

        <section class="section">
            <div class="container-fluid">
                <div class="card shadow mb-4 border-0 bgdark">
                    <div class="card-body mb-5">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-octagon me-1"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                {{ session('warning') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-3">
                                <div class="row">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        @if ($user->picture != null)
                                            <img src="{{ Storage::url($user->picture) }}" class="rounded-circle mb-3"
                                                width="100" height="100">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ $user->name }}"
                                                class="rounded-circle mb-3" width="100">
                                        @endif
                                        <span style="font-weight: bold">{{ $user->name }}</span>
                                        <span>{{ $user->nim }}</span>
                                        <span>{{ $user->email }}</span>
                                        @if ($user->role == 'mahasiswa')
                                            <h5><span class="badge bg-info mt-2">Mahasiswa</span></h5>
                                        @elseif ($user->role == 'alumni')
                                            <h5><span class="badge bg-info mt-2">Alumni</span></h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <!-- Edit Profile -->
                                <form action="{{ route('profile.update') }}" method="POST" class="mt-5 row">
                                    @csrf
                                    @method('put')
                                    <h4 class="text-center">Edit Profile</h4>
                                    <div class="col-md-4 mt-2">
                                        <label class="labels">Nama <span class="text-danger">*</span></label>
                                        <input autocomplete="off" type="text" name="name" required
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') ? old('name') : $user->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label class="labels">NIM <span class="text-danger">*</span></label>
                                        <input autocomplete="off" type="text" name="nim" required
                                            class="form-control @error('nim') is-invalid @enderror"
                                            value="{{ old('nim') ? old('nim') : $user->nim }}">
                                        @error('nim')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label class="labels">Email <span class="text-danger">*</span></label>
                                        <input autocomplete="off" type="email" name="email" required
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') ? old('email') : $user->email }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label class="labels">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select name="gender"
                                            class="form-control form-control-user @error('gender') is-invalid @enderror">
                                            <option disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="L"
                                                {{ old('gender') ? (old('gender') == 'L' ? 'selected' : '') : ($user->gender == 'L' ? 'selected' : '') }}>
                                                Laki-Laki
                                            </option>
                                            <option value="P"
                                                {{ old('gender') ? (old('gender') == 'P' ? 'selected' : '') : ($user->gender == 'P' ? 'selected' : '') }}>
                                                Perempuan
                                            </option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label class="labels">Nomor Telepon</label>
                                        <input autocomplete="off" type="text" name="mobile_number"
                                            class="form-control @error('mobile_number') is-invalid @enderror"
                                            value="{{ old('mobile_number') ? old('mobile_number') : $user->mobile_number }}">
                                        @error('mobile_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-3 text-center">
                                        <button class="btn btn-primary profile-button"
                                            type="submit">{{ 'Update Profile' }}
                                        </button>
                                    </div>
                                </form>
                                <hr class="mt-3" style="height: 5px; background: black;">
                                <div class="row">
                                    <!-- Edit Picture -->
                                    <form class="col-md-6 mt-3" action="{{ route('profile.picture') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        @if ($user->picture != null)
                                            <h4 class="text-center">Ubah Foto Profile</h4>
                                        @else
                                            <h4 class="text-center">Tambah Foto Profile</h4>
                                        @endif
                                        <label class="labels">Foto Profile (Max 1 MB)</label>
                                        <div class="text-center" style="justify-content: center">
                                            <input type="hidden" name="oldPicture" value="{{ $user->picture }}">
                                            @if ($user->picture)
                                                <img src="{{ asset($user->picture) }}"
                                                    class="picture-preview rounded-circle mb-2" width="200"
                                                    height="200">
                                            @else
                                                <img class="picture-preview rounded-circle mb-2">
                                            @endif
                                            <input type="file" id="picture" name="picture"
                                                onchange="previewPicture()" required
                                                class="form-control @error('picture') is-invalid @enderror">
                                        </div>
                                        @error('picture')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="text-center mt-3">
                                            @if ($user->picture != null)
                                                <button class="btn btn-primary profile-button"
                                                    type="submit">{{ 'Ubah Foto Profile' }}
                                                </button>
                                            @else
                                                <button class="btn btn-success profile-button"
                                                    type="submit">{{ 'Tambah Foto Profile' }}
                                                </button>
                                            @endif
                                        </div>
                                    </form>
                                    <!-- Edit KTM -->
                                    <form class="col-md-6 mt-3" action="{{ route('profile.ktm') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        @if ($user->ktm != null)
                                            <h4 class="text-center">Ubah KTM</h4>
                                        @else
                                            <h4 class="text-center">Tambah KTM</h4>
                                        @endif
                                        <label class="labels">KTM (Max 1 MB)</label>
                                        <div class="text-center" style="justify-content: center">
                                            <input type="hidden" name="oldKtm" value="{{ $user->ktm }}">
                                            @if ($user->ktm)
                                                <img src="{{ asset($user->ktm) }}" class="ktm-preview mb-2"
                                                    height="200">
                                            @else
                                                <img class="ktm-preview mb-2">
                                            @endif
                                            <input type="file" id="ktm" name="ktm" required
                                                onchange="previewKTM()"
                                                class="form-control @error('ktm') is-invalid @enderror">
                                        </div>
                                        @error('ktm')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="text-center mt-3">
                                            @if ($user->ktm != null)
                                                <button class="btn btn-primary profile-button"
                                                    type="submit">{{ 'Ubah KTM' }}
                                                </button>
                                            @else
                                                <button class="btn btn-success profile-button"
                                                    type="submit">{{ 'Tambah KTM' }}
                                                </button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <hr class="mt-3" style="height: 5px; background: black;">
                                <form class="row" action="{{ route('profile.password') }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <h4 class="text-center mt-3">Ubah Password</h4>
                                    <div class="col-md-4 mt-2">
                                        <label class="labels">Password Saat Ini <span class="text-danger">*</span></label>
                                        <input autocomplete="off" type="password" name="password_old" required
                                            class="form-control @error('password_old') is-invalid @enderror">
                                        @error('password_old')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label class="labels">Password Baru <span class="text-danger">*</span></label>
                                        <input autocomplete="off" type="password" name="password_new" required
                                            class="form-control @error('password_new') is-invalid @enderror">
                                        @error('password_new')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label class="labels">Konfirmasi Password Baru <span
                                                class="text-danger">*</span></label>
                                        <input autocomplete="off" type="password" name="password_confirm" required
                                            class="form-control @error('password_confirm') is-invalid @enderror">
                                        @error('password_confirm')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="text-center mt-3">
                                        <button class="btn btn-warning profile-button"
                                            type="submit">{{ 'Ubah Password' }}
                                        </button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script src="{{ asset('frontend/js/show-hide-password.js') }}"></script>
    <script>
        // Show Hide Password
        $(document).ready(function() {
            $('input[type=\'password\']').showHidePassword();
        });

        // Preview Foto Profile
        function previewPicture() {
            const picture = document.querySelector('#picture');
            const picturePreview = document.querySelector('.picture-preview');

            picturePreview.style.display = 'block';
            picturePreview.style.margin = 'auto';
            picturePreview.height = '200';
            picturePreview.width = '200';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(picture.files[0])

            oFReader.onload = function(oFREvent) {
                picturePreview.src = oFREvent.target.result;
            }
        }

        // Preview KTM
        function previewKTM() {
            const ktm = document.querySelector('#ktm');
            const ktmPreview = document.querySelector('.ktm-preview');

            ktmPreview.style.display = 'block';
            ktmPreview.style.margin = 'auto';
            ktmPreview.height = '200';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(ktm.files[0])

            oFReader.onload = function(oFREvent) {
                ktmPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
