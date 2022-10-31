@extends('backend.layouts.app')
@section('title', 'Tambah Surat')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Tambah Surat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tambah Surat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Surat</h5>
                    @if (session()->has('success'))
                        <div class="mt-3 alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-2">
                            <label for="type" class="col-form-label col-2">Jenis Surat <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                <select id="type" name="type" aria-label="Default select example" required
                                    class="form-select @error('type') is-invalid @enderror">
                                    <option disabled selected>Pilih Jenis Surat</option>
                                    <option value="masuk" {{ old('type') == 'masuk' ? 'selected' : '' }}>
                                        Surat Masuk
                                    </option>
                                    <option value="keluar" {{ old('type') == 'keluar' ? 'selected' : '' }}>
                                        Surat Keluar
                                    </option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="letter_number" class="col-2 col-form-label">Nomor Surat <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                <input type="text" id="letter_number" name="letter_number" required
                                    class="form-control @error('letter_number') is-invalid @enderror"
                                    value="{{ old('letter_number') }}">
                                @error('letter_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="letter_date" class="col-2 col-form-label">Tanggal Surat <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                <input type="date" id="letter_date" name="letter_date" required
                                    class="form-control @error('letter_date') is-invalid @enderror"
                                    value="{{ old('letter_date') }}">
                                @error('letter_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div id="surat_masuk" style="display: none">
                            <div class="row mt-3">
                                <label for="date_received" class="col-2 col-form-label">Tanggal Diterima</label>
                                <div class="col-10">
                                    <input type="date" id="date_received" name="date_received"
                                        class="form-control @error('date_received') is-invalid @enderror"
                                        value="{{ old('date_received') }}">
                                    @error('date_received')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="sender_id" class="col-form-label col-2">Pengirim Surat <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                <select id="sender_id" name="sender_id" aria-label="Default select example" required
                                    class="form-select @error('sender_id') is-invalid @enderror">
                                    <option disabled selected>Pilih Pengirim Surat</option>
                                    @foreach ($senders as $sender)
                                        <option value="{{ $sender->id }}"
                                            {{ old('sender_id') == $sender->id ? 'selected' : '' }}>{{ $sender->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sender_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="receiver_id" class="col-2 col-form-label">Tujuan/Penerima Surat <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                <select id="receiver_id" name="receiver_id" aria-label="Default select example" required
                                    class="form-select @error('receiver_id') is-invalid @enderror">
                                    <option disabled selected>Pilih Tujuan/Penerima Surat</option>
                                    @foreach ($receivers as $receiver)
                                        <option value="{{ $receiver->id }}"
                                            {{ old('receiver_id') == $receiver->id ? 'selected' : '' }}>
                                            {{ $receiver->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('receiver_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="regarding" class="col-2 col-form-label pt-0">Perihal Surat <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                <textarea id="regarding" name="regarding" required class="form-control @error('regarding') is-invalid @enderror">{{ old('regarding') }}</textarea>
                                @error('regarding')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="file" class="col-2 col-form-label">File (.pdf) <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                <embed class="pdf-preview" type="application/pdf">
                                <input type="file" id="file" name="file" required onchange="previewPDF()"
                                    class="form-control @error('file') is-invalid @enderror">
                                @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="viewer" class="col-2 col-form-label">View <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                <select id="viewer" name="viewer" aria-label="Default select example" required
                                    class="form-select @error('viewer') is-invalid @enderror">
                                    <option disabled selected>Pilih User yang Dapat Melihat Dokumen Ini</option>
                                    <option class="text-success" value="public"
                                        {{ old('viewer') == 'public' ? 'selected' : '' }}>
                                        Public - Semua pengunjung dapat melihat Dokumen ini
                                    </option>
                                    <option class="text-primary" value="mahasiswa"
                                        {{ old('viewer') == 'mahasiswa' ? 'selected' : '' }}>
                                        Mahasiswa - Semua Mahasiswa yang login
                                    </option>
                                    <option class="text-primary" value="alumni"
                                        {{ old('viewer') == 'alumni' ? 'selected' : '' }}>
                                        Alumni - Semua Alumni yang login
                                    </option>
                                    <option class="text-info" value="mahasiswa-alumni"
                                        {{ old('viewer') == 'mahasiswa-alumni' ? 'selected' : '' }}>
                                        Mahasiswa & Alumni - Mahasiswa dan Alumni yang login
                                    </option>
                                    <option class="text-warning" value="private"
                                        {{ old('viewer') == 'private' ? 'selected' : '' }}>
                                        Private - Hanya User dengan Email yang sama dengan Email Penerima/Pengirim Surat
                                    </option>
                                    <option class="text-danger" value="secret"
                                        {{ old('viewer') == 'secret' ? 'selected' : '' }}>
                                        Rahasia - Hanya tertampil di Dashboard
                                    </option>
                                </select>
                                @error('viewer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div id="setting-disposisi">
                            <fieldset class="row mt-3">
                                <legend class="col-2 col-form-label pt-0">Butuh Disposisi Kadep <span
                                        class="text-danger">*</span>
                                </legend>
                                <div class="col-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="disposisi_set"
                                            id="status1" value="1"
                                            {{ old('disposisi_set') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status1">
                                            Perlu Disposisi Kepala Departemen
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="disposisi_set"
                                            id="status2" value="0"
                                            {{ old('disposisi_set') == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status2">
                                            Tidak Perlu Disposisi Kepala Departemen
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="row mt-3">
                            <label for="description" class="col-2 col-form-label pt-0">Keterangan Tambahan
                                (Opsional)</label>
                            <div class="col-10">
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        // Show Hide Tanggal Terima dan Setting Disposisi
        $(document).ready(function() {
            $("#type").change(function() {
                var type = $(this).val();
                var tanggalterima = document.getElementById('surat_masuk')
                var setdisposisi = document.getElementById('setting-disposisi')
                if (type == "masuk") {
                    tanggalterima.style.display = 'block';
                    setdisposisi.style.display = 'block';
                    // $("#surat_masuk").show();
                } else {
                    tanggalterima.style.display = 'none'
                    setdisposisi.style.display = 'none';
                    // $("#surat_masuk").hide();
                }
            });
        });

        // PDF Preview
        function previewPDF() {
            const pdf = document.querySelector('#file');
            const pdfPreview = document.querySelector('.pdf-preview');

            pdfPreview.height = '375';
            pdfPreview.width = '500';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(pdf.files[0])

            ofReader.onload = function(ofREvent) {
                pdfPreview.src = ofREvent.target.result;
            }
        }
    </script>
@endsection
