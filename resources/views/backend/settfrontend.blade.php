@extends('backend.layouts.app')
@section('title', 'Frontend Setting')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Frontend Setting</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Frontend Setting</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Alert -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <!-- Header -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Header</h5>
                        <form class="row g-3" action="/dashboard/setfrontend/header" method="post">
                            @csrf
                            @method('put')
                            <div class="col-12">
                                <label for="telephone" class="form-label">Nomor Telepon Departemen</label>
                                <input type="text" id="telephone" name="telephone" required
                                    class="form-control @error('telephone') is-invalid @enderror"
                                    value="{{ $frontend->telephone }}">
                                @error('telephone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email Departemen</label>
                                <input type="email" id="email" name="email" required
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ $frontend->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="facebook" class="form-label">Link Facebook</label>
                                <input type="text" id="facebook" name="facebook" required
                                    class="form-control @error('facebook') is-invalid @enderror"
                                    value="{{ $frontend->facebook }}">
                                @error('facebook')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="twitter" class="form-label">Link Twitter</label>
                                <input type="text" id="twitter" name="twitter" required
                                    class="form-control @error('twitter') is-invalid @enderror"
                                    value="{{ $frontend->twitter }}">
                                @error('twitter')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="instagram" class="form-label">Link Instagram</label>
                                <input type="text" id="instagram" name="instagram" required
                                    class="form-control @error('instagram') is-invalid @enderror"
                                    value="{{ $frontend->instagram }}">
                                @error('instagram')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="wanumber" class="form-label">No. WA Layanan</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                    <input type="tel" id="wanumber" name="wanumber" aria-describedby="basic-addon1"
                                        value="{{ $frontend->wanumber }}" onkeypress="return isNumberKey(event)"
                                        maxlength="11" class="form-control @error('wanumber') is-invalid @enderror">
                                </div>
                                @error('wanumber')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Header Form -->
                    </div>
                </div>

                <!-- Body -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Body Paragraf</h5>
                        <form class="row g-3" action="/dashboard/setfrontend/paragraf" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <!-- P1 -->
                            <div class="col-12">
                                <div class="card-subtitle">
                                    Paragraf Pertama
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="title1" class="form-label">Judul Pertama</label>
                                <input type="text" id="title1" name="title1" required
                                    class="form-control @error('title1') is-invalid @enderror"
                                    value="{{ $frontend->title1 }}">
                                @error('title1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="subtitle1" class="form-label">Sub Judul Pertama</label>
                                <input type="text" id="subtitle1" name="subtitle1" required
                                    class="form-control @error('subtitle1') is-invalid @enderror"
                                    value="{{ $frontend->subtitle1 }}">
                                @error('subtitle1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="picture1" class="form-label">Gambar</label>
                                <input type="hidden" name="oldPicture1" value="{{ $frontend->picture1 }}">
                                @if ($frontend->picture1)
                                    <div class="text-center">
                                        <img src="{{ asset($frontend->picture1) }}"
                                            class="picture1-preview img-fluid mb-3 col-sm-5">
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img class="picture1-preview img-fluid mb-3 col-sm-5">
                                    </div>
                                @endif
                                <input type="file" id="picture1" name="picture1" onchange="previewPicture1()"
                                    class="form-control @error('picture1') is-invalid @enderror">
                                @error('picture1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="body1" class="form-label">Isi Paragraf Pertama</label>
                                <textarea style="height: 100px" id="body1" name="body1"
                                    class="form-control @error('body1') is-invalid @enderror">{{ $frontend->body1 }}</textarea>
                                @error('body1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- P2 -->
                            <div class="col-12">
                                <div class="card-subtitle mt-3">
                                    Paragraf Kedua
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="title2" class="form-label">Judul Kedua</label>
                                <input type="text" id="title2" name="title2" required
                                    class="form-control @error('title2') is-invalid @enderror"
                                    value="{{ $frontend->title2 }}">
                                @error('title2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="subtitle2" class="form-label">Sub Judul Kedua</label>
                                <input type="text" id="subtitle2" name="subtitle2" required
                                    class="form-control @error('subtitle2') is-invalid @enderror"
                                    value="{{ $frontend->subtitle2 }}">
                                @error('subtitle2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="picture2" class="form-label">Gambar</label>
                                <input type="hidden" name="oldPicture2" value="{{ $frontend->picture2 }}">
                                @if ($frontend->picture2)
                                    <div class="text-center">
                                        <img src="{{ asset($frontend->picture2) }}"
                                            class="picture2-preview img-fluid mb-3 col-sm-5">
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img class="picture2-preview img-fluid mb-3 col-sm-5">
                                    </div>
                                @endif
                                <input class="form-control @error('picture2') is-invalid @enderror" type="file"
                                    id="picture2" name="picture2" onchange="previewPicture2()">
                                @error('picture2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="body2" class="form-label">Isi Paragraf Kedua</label>
                                <textarea style="height: 100px" id="body2" name="body2"
                                    class="form-control @error('body2') is-invalid @enderror">{{ $frontend->body2 }}</textarea>
                                @error('body2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Body Form -->
                    </div>
                </div>
            </div>

            <div class="col-lg-6">

                <!-- Footer Contact -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Footer - Kontak</h5>
                        <!-- Footer Contact Form -->
                        <livewire:frontend-contacts-manager />

                    </div>
                </div>

                <!-- Footer Layanan -->
                <div class="card">
                    <div class="card-body">
                        <!-- Footer Service Form -->
                        <livewire:frontend-services-manager />
                    </div>
                </div>

                <!-- Hero Picture -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Hero Pictures</h5>
                        <div class="row g-3 text-center">
                            @foreach ($picture as $item)
                                <div class="col-md-12">
                                    <img class="col-sm-5" src="{{ asset($item->picture) }}">
                                    <form class="pt-2" method="post" enctype="multipart/form-data"
                                        action="/dashboard/setfrontend/picturedelete/{{ $item->id }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin akan menghapus gambar ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach

                            <form class="col-md-12 mt-3" enctype="multipart/form-data" method="post"
                                action="/dashboard/setfrontend/pictureadd">
                                @csrf
                                <img class="picture-preview img-fluid mb-3 col-sm-5 text-center">
                                <input type="file" name="picture" id="picture"
                                    class="form-control @error('picture') is-invalid @enderror"
                                    onchange="previewPicture()">
                                @error('picture')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-success">
                                        <i class="ri-image-add-line text-white"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('script')
    <!-- Preview Image -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous">
    </script>

    <!-- Preview Image -->
    <script>
        function previewPicture() {
            const picture = document.querySelector('#picture');
            const picturePreview = document.querySelector('.picture-preview');

            picturePreview.style.display = 'block';
            picturePreview.style.margin = 'auto';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(picture.files[0])

            oFReader.onload = function(oFREvent) {
                picturePreview.src = oFREvent.target.result;
            }
        }

        function previewPicture1() {
            const picture1 = document.querySelector('#picture1');
            const picture1Preview = document.querySelector('.picture1-preview');

            picture1Preview.style.display = 'block';
            picture1Preview.style.margin = 'auto';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(picture1.files[0])

            oFReader.onload = function(oFREvent) {
                picture1Preview.src = oFREvent.target.result;
            }
        }

        function previewPicture2() {
            const picture2 = document.querySelector('#picture2');
            const picture2Preview = document.querySelector('.picture2-preview');

            picture2Preview.style.display = 'block';
            picture2Preview.style.margin = 'auto';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(picture2.files[0])

            oFReader.onload = function(oFREvent) {
                picture2Preview.src = oFREvent.target.result;
            }
        }
    </script>

    <!-- Only Number Input -->
    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

@endsection
