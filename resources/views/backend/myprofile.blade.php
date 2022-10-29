@extends('backend.layouts.app')
@section('title', 'My Profile')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>My Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">My Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if ($user->picture != null)
                            <img src="{{ Storage::url($user->picture) }}" alt="Profile" class="rounded-circle"
                                height="100">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="Profile"
                                class="rounded-circle" height="100">
                        @endif
                        <h2>{{ $user->name }}</h2>
                        <h3>
                            @if ($user->role == 'admin')
                                Admin
                            @elseif ($user->role == 'kadep')
                                Kepala Departemen
                            @elseif ($user->role == 'koor')
                                Koordinator Kemahasiswaan
                            @endif
                        </h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
                                    Detail
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                    Edit Profile
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">
                                    Ubah Password
                                </button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Detail Profile</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">NIP</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->nim }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No. Handphone</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->mobile_number }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if ($user->gender == 'L')
                                            Laki-Laki
                                        @elseif ($user->gender == 'P')
                                            Perempuan
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <!-- Profile Picture Edit Form -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        @if ($user->picture)
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delpictureModal">
                                                <i class="bi bi-trash"></i> Hapus Foto Profile
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <form action="{{ route('dashboard.profile.edit') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row mb-3">
                                        <label for="picture" class="col-md-4 col-lg-3 col-form-label">
                                            Foto Profile
                                        </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="hidden" name="oldPicture" value="{{ $user->picture }}">
                                            @if ($user->picture)
                                                <img src="{{ asset($user->picture) }}" class="picture-preview mb-2">
                                            @else
                                                <img class="picture-preview mb-2">
                                            @endif
                                            <input type="file" id="picture" name="picture" onchange="previewPicture()"
                                                class="form-control @error('picture') is-invalid @enderror">
                                            @error('picture')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" id="name" required
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') ? old('name') : $user->name }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nim" class="col-md-4 col-lg-3 col-form-label">NIP <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nim" type="text" id="nim" required
                                                class="form-control @error('nim') is-invalid @enderror"
                                                value="{{ old('nim') ? old('nim') : $user->nim }}">
                                            @error('nim')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" id="email" required
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') ? old('email') : $user->email }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="mobile_number" class="col-md-4 col-lg-3 col-form-label">No. HP</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="mobile_number" type="text" id="mobile_number"
                                                class="form-control @error('mobile_number') is-invalid @enderror"
                                                value="{{ old('mobile_number') ? old('mobile_number') : $user->mobile_number }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Jenis
                                            Kelamin</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select id="gender" name="gender" aria-label="Default select example"
                                                class="form-select @error('gender') is-invalid @enderror">
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
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Ubah Profile</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="{{ route('dashboard.profile.password') }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="row mb-3">
                                        <label for="password_old" class="col-md-4 col-lg-3 col-form-label">
                                            Password Sekarang
                                        </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password_old" type="password" id="password_old"
                                                class="form-control @error('password_old') is-invalid @enderror">
                                            @error('password_old')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <label for="password_new" class="col-md-4 col-lg-3 col-form-label">
                                            Password Baru
                                        </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password_new" type="password" id="password_new"
                                                class="form-control @error('password_new') is-invalid @enderror">
                                            @error('password_new')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="password_confirm" class="col-md-4 col-lg-3 col-form-label">
                                            Konfirmasi Password Baru
                                        </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password_confirm" type="password" id="password_confirm"
                                                class="form-control @error('password_confirm') is-invalid @enderror">
                                            @error('password_confirm')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
    @include('backend.myprofile-modal')
@endsection

@section('script')
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

            const oFReader = new FileReader();
            oFReader.readAsDataURL(picture.files[0])

            oFReader.onload = function(oFREvent) {
                picturePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
