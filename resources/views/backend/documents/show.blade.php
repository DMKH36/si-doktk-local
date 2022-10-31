@extends('backend.layouts.app')
@section('title', 'Detail Surat')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        @if ($doc->type == 'masuk')
            <h1>Detail Surat Masuk</h1>
        @endif
        @if ($doc->type == 'keluar')
            <h1>Detail Surat Keluar</h1>
        @endif
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                @if ($user->role == 'kadep')
                    @if ($doc->type == 'masuk')
                        <li class="breadcrumb-item"><a href="{{ route('kadep.incoming') }}">Daftar Surat Masuk</a></li>
                        <li class="breadcrumb-item active">Detail Surat Masuk</li>
                    @endif
                    @if ($doc->type == 'keluar')
                        <li class="breadcrumb-item"><a href="{{ route('kadep.outgoing') }}">Daftar Surat Keluar</a></li>
                        <li class="breadcrumb-item active">Detail Surat Keluar</li>
                    @endif
                @else
                    @if ($doc->type == 'masuk')
                        <li class="breadcrumb-item"><a href="{{ route('doc.incoming') }}">Daftar Surat Masuk</a></li>
                        <li class="breadcrumb-item active">Detail Surat Masuk</li>
                    @endif
                    @if ($doc->type == 'keluar')
                        <li class="breadcrumb-item"><a href="{{ route('doc.outgoing') }}">Daftar Surat Keluar</a></li>
                        <li class="breadcrumb-item active">Detail Surat Keluar</li>
                    @endif
                @endif
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        @if ($user->role == 'kadep')
                            @if ($doc->type == 'masuk')
                                <h5 class="card-title mt-2">Detail Surat Masuk</h5>
                                <a href="{{ route('kadep.incoming') }}" class="btn btn-warning">{{ '<< Kembali' }}</a>
                            @else
                                <h5 class="card-title mt-2">Detail Surat Keluar</h5>
                                <a href="{{ route('kadep.outgoing') }}" class="btn btn-warning">{{ '<< Kembali' }}</a>
                            @endif
                        @else
                            @if ($doc->type == 'masuk')
                                <h5 class="card-title mt-2">Detail Surat Masuk</h5>
                                <div class="d-flex" style="justify-content: space-between">
                                    <a href="{{ route('doc.incoming') }}" class="btn btn-warning">{{ '<< Kembali' }}</a>
                                    <div>
                                        <a class="btn btn-primary"
                                            href="{{ route('document.edit', ['document' => encrypt($doc->id)]) }}">
                                            <i class="bi bi-pencil-square"></i>&nbsp; Edit
                                        </a>
                                        <button class="btn btn-danger"data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="bi bi-trash"></i>&nbsp; Hapus
                                        </button>
                                    </div>
                                </div>
                            @else
                                <h5 class="card-title mt-2">Detail Surat Keluar</h5>
                                <div class="d-flex" style="justify-content: space-between">
                                    <a href="{{ route('doc.outgoing') }}" class="btn btn-warning">{{ '<< Kembali' }}</a>
                                    <div>
                                        <a class="btn btn-primary"
                                            href="{{ route('document.edit', ['document' => encrypt($doc->id)]) }}">
                                            <i class="bi bi-pencil-square"></i>&nbsp; Edit
                                        </a>
                                        <button class="btn btn-danger"data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="bi bi-trash"></i>&nbsp; Hapus
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endif

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
                                    <div class="col-lg-9 col-md-8">{{ date('D, d-m-Y', strtotime($doc->date_received)) }}
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
                            @if ($doc->type == 'masuk')
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Disposisi</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if ($doc->disposisi_set == 0)
                                            <h5><span class="badge bg-primary">Tidak Perlu Disposisi dari Kepala
                                                    Departemen</span></h5>
                                        @elseif ($doc->disposisi_set == 1)
                                            <h5><span class="badge bg-danger">Kepala Departemen Belum Memberikan
                                                    Disposisi</span></h5>
                                        @elseif ($doc->disposisi_set == 2)
                                            <h5><span class="badge bg-success">Kepala Departemen Telah Memberikan
                                                    Disposisi</span></h5>
                                            <div style="text-align: justify">{{ $doc->disposisi }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <hr>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Keterangan Tambahan</div>
                                <div class="col-lg-9 col-md-8" style="text-align: justify">{{ $doc->description }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        @if ($doc->type == 'masuk')
                            <h5 class="card-title">File Surat Masuk - <a href="{{ route('doc.download', $doc->id) }}"
                                    class="btn btn-info"><i class="bi bi-download"></i>&nbsp; Download Surat</a></h5>
                        @else
                            <h5 class="card-title">File Surat Keluar - <a href="{{ route('doc.download', $doc->id) }}"
                                    class="btn btn-info"><i class="bi bi-download"></i>&nbsp; Download Surat</a></h5>
                        @endif
                        <div class="row text-center">
                            <embed src="{{ asset($doc->file) }}" height="490" width="550" type="application/pdf">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.documents.modal-show')
@endsection
