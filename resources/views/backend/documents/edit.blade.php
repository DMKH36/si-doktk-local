@extends('backend.layouts.app')
@section('title', 'Edit Surat')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        @if ($doc->type == 'masuk')
            <h1>Edit Surat Masuk</h1>
        @endif
        @if ($doc->type == 'keluar')
            <h1>Edit Surat Keluar</h1>
        @endif
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                @if ($doc->type == 'masuk')
                    <li class="breadcrumb-item"><a href="{{ route('doc.incoming') }}">Daftar Surat Masuk</a></li>
                @endif
                @if ($doc->type == 'keluar')
                    <li class="breadcrumb-item"><a href="{{ route('doc.outgoing') }}">Daftar Surat Keluar</a></li>
                @endif
                <li class="breadcrumb-item active">Edit Surat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    @if ($doc->type == 'masuk')
                        <div class="row">
                            <h5 class="card-title">Edit Surat Masuk</h5>
                            <div class="d-flex" style="justify-content: space-between">
                                <a href="{{ route('doc.incoming') }}" class="btn btn-warning">{{ '<< Kembali' }}</a>
                                <button class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#ubahTipeModal{{ $doc->id }}">
                                    <i class="bi bi-journal-arrow-down"></i> <i class="bi bi-arrow-right-short"></i>
                                    <i class="bi bi-journal-arrow-up"></i> Ubah Menjadi Surat Keluar
                                </button>
                            </div>
                        </div>
                    @endif
                    @if ($doc->type == 'keluar')
                        <div class="row">
                            <h5 class="card-title">Edit Surat Keluar</h5>
                            <div class="d-flex" style="justify-content: space-between">
                                <a href="{{ route('doc.outgoing') }}" class="btn btn-warning">{{ '<< Kembali' }}</a>
                                <button class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#ubahTipeModal{{ $doc->id }}">
                                    <i class="bi bi-journal-arrow-up"></i> <i class="bi bi-arrow-right-short"></i>
                                    <i class="bi bi-journal-arrow-down"></i> Ubah Menjadi Surat Masuk
                                </button>
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('document.update', ['document' => $doc->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mt-4">
                            <label for="type" class="col-form-label col-2">Jenis Surat <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                @if ($doc->type == 'masuk')
                                    <input type="hidden" id="type" name="type" value="masuk">
                                    <input type="text" readonly class="form-control" value="Surat Masuk">
                                @else
                                    <input type="hidden" id="type" name="type" value="keluar">
                                    <input type="text" readonly class="form-control" value="Surat Keluar">
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="letter_number" class="col-2 col-form-label">Nomor Surat <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                <input type="text" id="letter_number" name="letter_number" required
                                    class="form-control @error('letter_number') is-invalid @enderror"
                                    value="{{ old('letter_number') ? old('letter_number') : $doc->letter_number }}">
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
                                    value="{{ old('letter_date') ? old('letter_date') : $doc->letter_date }}">
                                @error('letter_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        @if ($doc->type == 'masuk')
                            <div class="row mt-3">
                                <label for="date_received" class="col-2 col-form-label">Tanggal Diterima</label>
                                <div class="col-10">
                                    <input type="date" id="date_received" name="date_received"
                                        class="form-control @error('date_received') is-invalid @enderror"
                                        value="{{ old('date_received') ? old('date_received') : $doc->date_received }}">
                                    @error('date_received')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="row mt-3">
                            <label for="sender_id" class="col-form-label col-2">Pengirim Surat <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                <select id="sender_id" name="sender_id" aria-label="Default select example" required
                                    class="form-select @error('sender_id') is-invalid @enderror">
                                    <option disabled selected>Pilih Pengirim Surat</option>
                                    @foreach ($senders as $sender)
                                        @if (old('sender_id', $doc->sender_id) == $sender->id)
                                            <option value="{{ $sender->id }}" selected>{{ $sender->name }}</option>
                                        @else
                                            <option value="{{ $sender->id }}">{{ $sender->name }}</option>
                                        @endif
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
                                        @if (old('receiver_id', $doc->receiver_id) == $receiver->id)
                                            <option value="{{ $receiver->id }}" selected>{{ $receiver->name }}</option>
                                        @else
                                            <option value="{{ $receiver->id }}">{{ $receiver->name }}</option>
                                        @endif
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
                                <textarea id="regarding" name="regarding" required class="form-control @error('regarding') is-invalid @enderror">{{ old('regarding') ? old('regarding') : $doc->regarding }}</textarea>
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
                                <input type="hidden" name="oldFile" class="form-control" value="{{ $doc->file }}">
                                @if ($doc->file)
                                    <embed src="{{ asset($doc->file) }}" height="375" width="500"
                                        class="pdf-preview" type="application/pdf">
                                @else
                                    <embed class="pdf-preview" type="application/pdf">
                                @endif
                                <input type="file" id="file" name="file" onchange="previewPDF()"
                                    class="form-control @error('file') is-invalid @enderror">
                                @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="viewer" class="col-2 col-form-label">Viewer <span
                                    class="text-danger">*</span></label>
                            <div class="col-10">
                                <select id="viewer" name="viewer" aria-label="Default select example" required
                                    class="form-select @error('viewer') is-invalid @enderror">
                                    <option class="text-success" value="public"
                                        {{ old('viewer') ? (old('viewer') == 'public' ? 'selected' : '') : ($doc->viewer == 'public' ? 'selected' : '') }}>
                                        Public - Semua pengunjung dapat melihat Dokumen ini
                                    </option>
                                    <option class="text-primary" value="mahasiswa"
                                        {{ old('viewer') ? (old('viewer') == 'mahasiswa' ? 'selected' : '') : ($doc->viewer == 'mahasiswa' ? 'selected' : '') }}>
                                        Mahasiswa - Semua Mahasiswa yang login
                                    </option>
                                    <option class="text-primary" value="alumni"
                                        {{ old('viewer') ? (old('viewer') == 'alumni' ? 'selected' : '') : ($doc->viewer == 'alumni' ? 'selected' : '') }}>
                                        Alumni - Semua Alumni yang login
                                    </option>
                                    <option class="text-info" value="mahasiswa-alumni"
                                        {{ old('viewer') ? (old('viewer') == 'mahasiswa-alumni' ? 'selected' : '') : ($doc->viewer == 'mahasiswa-alumni' ? 'selected' : '') }}>
                                        Mahasiswa & Alumni - Mahasiswa dan Alumni yang login
                                    </option>
                                    <option class="text-warning" value="private"
                                        {{ old('viewer') ? (old('viewer') == 'private' ? 'selected' : '') : ($doc->viewer == 'private' ? 'selected' : '') }}>
                                        Private - Hanya User dengan Email yang sama dengan Email Penerima/Pengirim Surat
                                    </option>
                                    <option class="text-danger" value="secret"
                                        {{ old('viewer') ? (old('viewer') == 'secret' ? 'selected' : '') : ($doc->viewer == 'secret' ? 'selected' : '') }}>
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
                        @if ($doc->disposisi_set != 2)
                            <fieldset class="row mt-3">
                                <legend class="col-2 col-form-label pt-0">Butuh Disposisi Kadep <span
                                        class="text-danger">*</span>
                                </legend>
                                <div class="col-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="disposisi_set"
                                            id="status1" value="1"
                                            {{ old('disposisi_set') ? (old('disposisi_set') == 1 ? 'checked' : '') : ($doc->disposisi_set == 1 ? 'checked' : '') }}>
                                        <label class="form-check-label" for="status1">
                                            Perlu Disposisi Kepala Departemen
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="disposisi_set"
                                            id="status2" value="0"
                                            {{ old('disposisi_set') ? (old('disposisi_set') == 0 ? 'checked' : '') : ($doc->disposisi_set == 0 ? 'checked' : '') }}>
                                        <label class="form-check-label" for="status2">
                                            Tidak Perlu Disposisi Kepala Departemen
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        @else
                            <fieldset class="row mt-3">
                                <legend class="col-2 col-form-label pt-0">Butuh Disposisi Kadep <span
                                        class="text-danger">*</span>
                                </legend>
                                <div class="col-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="disposisi_set"
                                            id="status1" value="2" checked>
                                        <label class="form-check-label" for="status1">
                                            Kepala Departemen telah memberikan Disposisi
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row mt-3">
                                <label for="disposisi" class="col-2 col-form-label pt-0">Disposisi dari Kadep</label>
                                <div class="col-10">
                                    <textarea id="disposisi" name="disposisi" readonly class="form-control @error('disposisi') is-invalid @enderror">{{ $doc->disposisi }}</textarea>
                                    @error('disposisi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="row mt-3">
                            <label for="description" class="col-2 col-form-label pt-0">Keterangan Tambahan
                                (Opsional)</label>
                            <div class="col-10">
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') ? old('description') : $doc->description }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('backend.documents.modal-change')
@endsection

@section('script')
    <script>
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
