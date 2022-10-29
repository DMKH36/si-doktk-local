@extends('frontend.layouts.app')
@section('title', 'Detail Dokumen')
@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    @if ($documents->type == 'masuk')
                        <h2 class="font-weight-bold">Detail Dokumen Masuk</h2>
                        <ol>
                            <li><a href="/">Beranda</a></li>
                            <li><a href="/dokmasuk">Daftar Dokumen Masuk</a></li>
                            <li>Detail Dokumen Masuk</li>
                        </ol>
                    @else
                        <h2 class="font-weight-bold">Detail Dokumen Keluar</h2>
                        <ol>
                            <li><a href="/">Beranda</a></li>
                            <li><a href="/dokkeluar">Daftar Dokumen Keluar</a></li>
                            <li>Detail Dokumen Keluar</li>
                        </ol>
                    @endif
                </div>
            </div>
        </section><!-- Breadcrumbs Section -->

        <section id="portfolio-details" class="portfolio-details">
            <div class="card shadow-sm mx-5 bg-white rounded">
                <div class="d-sm-flex p-2">
                    @if ($documents->type == 'masuk')
                        <a href="/dokmasuk" class="btn btn-info btn-user float-right">
                            <i class="fas fa-angle-double-left"></i>&nbsp; {{ 'Kembali' }}
                        </a>
                    @else
                        <a href="/dokkeluar" class="btn btn-info btn-user float-right">
                            <i class="fas fa-angle-double-left"></i>&nbsp; {{ 'Kembali' }}
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="col-7 px-2">
                            <div class="card">
                                <div class="card-header" style="font-weight: bold; color: #3D59AB">
                                    <h5 class="m-2 p-0">Deskripsi Dokumen</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label" style="font-weight: bold">Nomor Surat</div>
                                        <div class="col-lg-9 col-md-8">{{ $documents->letter_number }}</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label" style="font-weight: bold">Tanggal Surat</div>
                                        <div class="col-lg-9 col-md-8">{{ $documents->letter_date }}</div>
                                    </div>
                                    <hr>
                                    @if ($documents->type == 'masuk')
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label" style="font-weight: bold">Tanggal Diterima
                                            </div>
                                            <div class="col-lg-9 col-md-8">{{ $documents->date_received }}</div>
                                        </div>
                                        <hr>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label" style="font-weight: bold">Pengirim Surat</div>
                                        <div class="col-lg-9 col-md-8">{{ $documents->sender_name }}</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label" style="font-weight: bold">Tujuan/Penerima Surat
                                        </div>
                                        <div class="col-lg-9 col-md-8">{{ $documents->receiver_name }}</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label" style="font-weight: bold">Perihal Surat</div>
                                        <div class="col-lg-9 col-md-8" style="text-align: justify">
                                            {{ $documents->regarding }}</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label" style="font-weight: bold">Keterangan</div>
                                        <div class="col-lg-9 col-md-8" style="text-align: justify">
                                            @if ($documents->description != null)
                                                {{ $documents->description }}
                                            @else
                                                Tidak Ada Keterangan
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 px-2">
                            <div class="card">
                                <div class="card-header d-flex" style="font-weight: bold; color: #3D59AB">
                                    <h5 class="m-2 p-0">File Surat - </h5>
                                    <div class="mt-1">
                                        <a href="{{ route('home.download', $documents->id) }}"
                                            class="btn px-2 py-1 btn-primary text-white"><i
                                                class="bi bi-download"></i>&nbsp;
                                            {{ 'Download Surat' }}
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <embed src="{{ asset($documents->file) }}" height="490" width="550"
                                            type="application/pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
