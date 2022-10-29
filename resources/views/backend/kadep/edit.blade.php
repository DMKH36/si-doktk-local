@extends('backend.layouts.app')
@section('title', 'Detail Surat')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Detail Surat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kadep.index') }}">Daftar Surat Untuk Kadep</a></li>
                <li class="breadcrumb-item active">Detail Surat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-2">Detail Surat</h5>
                        <a href="{{ route('kadep.index') }}" class="btn btn-warning">{{ '<< Kembali' }}</a>
                        <div class="profile-overview mt-4">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nomor Surat</div>
                                <div class="col-lg-9 col-md-8">{{ $doc->letter_number }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tanggal Surat</div>
                                <div class="col-lg-9 col-md-8">{{ date('D, d-m-Y', strtotime($doc->letter_date)) }}</div>
                            </div>
                            <hr>
                            @if ($doc->type == 'masuk')
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tanggal Diterima</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ date('D, d-m-Y', strtotime($doc->date_received)) }}
                                    </div>
                                </div>
                                <hr>
                            @endif
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Pengirim Surat</div>
                                <div class="col-lg-9 col-md-8">{{ $doc->sender_name }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tujuan/Penerima Surat</div>
                                <div class="col-lg-9 col-md-8">{{ $doc->receiver_name }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Perihal Surat</div>
                                <div class="col-lg-9 col-md-8" style="text-align: justify">{{ $doc->regarding }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Viewer</div>
                                <div class="col-lg-9 col-md-8">
                                    @if ($doc->viewer == 'public')
                                        <h5><span class="badge bg-success">Public</span></h5>
                                    @elseif ($doc->viewer == 'mahasiswa')
                                        <h5><span class="badge bg-primary">Mahasiswa</span></h5>
                                    @elseif ($doc->viewer == 'alumni')
                                        <h5><span class="badge bg-primary">Alumni</span></h5>
                                    @elseif ($doc->viewer == 'mahasiswa-alumni')
                                        <h5><span class="badge bg-info">Mahasiswa-Alumni</span></h5>
                                    @elseif ($doc->viewer == 'private')
                                        <h5><span class="badge bg-warning">User Terkait</span></h5>
                                    @elseif ($doc->viewer == 'secret')
                                        <h5><span class="badge bg-danger">Rahasia</span></h5>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Keterangan Tambahan</div>
                                <div class="col-lg-9 col-md-8" style="text-align: justify">{{ $doc->description }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Status Disposisi</div>
                                <div class="col-lg-9 col-md-8">
                                    @if ($doc->disposisi_set == 0)
                                        <h5><span class="badge bg-primary">Tidak Perlu Disposisi dari Kepala
                                                Departemen</span></h5>
                                    @elseif ($doc->disposisi_set == 1)
                                        <h5><span class="badge bg-danger">Anda Belum Memberikan
                                                Disposisi</span></h5>
                                    @elseif ($doc->disposisi_set == 2)
                                        <h5><span class="badge bg-success">Anda Telah Memberikan
                                                Disposisi</span></h5>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('kadep.update', ['kadep' => $doc->id]) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <label for="disposisi" class="col-lg-3 col-md-4 label">Disposisi</label>
                                    <div class="col-lg-9 col-md-8">
                                        <textarea id="disposisi" name="disposisi" class="form-control @error('disposisi') is-invalid @enderror">{{ old('disposisi') ? old('disposisi') : $doc->disposisi }}</textarea>
                                        @error('disposisi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-center">
                                    @if ($doc->disposisi_set == 1)
                                        <button type="submit" class="btn btn-success">Tambah Disposisi</button>
                                    @else
                                        <button type="submit" class="btn btn-primary">Update Disposisi</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">File Surat - <a href="{{ route('kadep.download', $doc->id) }}"
                                class="btn btn-info"><i class="bi bi-download"></i>&nbsp; Download Surat</a></h5>
                        <div class="row text-center">
                            <embed src="{{ asset($doc->file) }}" height="490" width="550" type="application/pdf">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
