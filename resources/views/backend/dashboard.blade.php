@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

        <div class="row">
            <!-- Row 1 -->
            <div class="row">
                <!-- Surat Masuk -->
                <div class="col-4">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Surat Masuk</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-journal-arrow-down"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $total_masuk }}</h6>
                                    <span class="text-primary small pt-1 fw-bold">Surat Masuk</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Surat Masuk -->

                <!-- Surat Keluar -->
                <div class="col-4">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Surat Keluar</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-journal-arrow-up"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $total_keluar }}</h6>
                                    <span class="text-success small pt-1 fw-bold">Surat Keluar</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Surat Keluar -->

                <!-- Disposisi -->
                <div class="col-4">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Surat Butuh Disposisi</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-journal-medical"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $disposisi }}</h6>
                                    <span class="text-danger small pt-1 fw-bold">Surat Tanpa Disposisi</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- End Disposisi -->
            </div> <!-- End Row 1 -->

            <!-- Row 2 -->
            <div class="row">
                <!-- Recent Surat Masuk -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Surat Masuk Terbaru</h5>

                            <div class="activity">
                                @foreach ($masuk as $in)
                                    <div class="activity-item d-flex">
                                        <div class="activite-label col-3">
                                            {{ Str::limit($in->letter_number, 15, '...') }}
                                        </div>
                                        <div class="col-9 d-flex">
                                            <i
                                                class='bi bi-circle-fill activity-badge align-self-start 
                                                @if ($in->viewer == 'public') text-success
                                                @elseif ($in->viewer == 'mahasiswa') text-primary
                                                @elseif ($in->viewer == 'alumni') text-primary
                                                @elseif ($in->viewer == 'mahasiswa-alumni') text-info
                                                @elseif ($in->viewer == 'private') text-warning
                                                @elseif ($in->viewer == 'secret') text-danger @endif'>
                                            </i>
                                            <div class="activity-content" style="text-align: justify">
                                                {{ Str::of($in->regarding)->words(20, '...') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- End Surat Masuk-->
                            </div>

                        </div>
                    </div><!-- End Recent Surat Masuk -->
                </div>

                <!-- Recent Surat Keluar -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Surat Keluar Terbaru</h5>

                            <div class="activity">
                                @foreach ($keluar as $out)
                                    <div class="activity-item d-flex">
                                        <div class="activite-label col-3">
                                            {{ Str::limit($out->letter_number, 15, '...') }}
                                        </div>
                                        <div class="col-9 d-flex">
                                            <i
                                                class='bi bi-circle-fill activity-badge align-self-start 
                                                @if ($out->viewer == 'public') text-success
                                                @elseif ($out->viewer == 'mahasiswa') text-primary
                                                @elseif ($out->viewer == 'alumni') text-primary
                                                @elseif ($out->viewer == 'mahasiswa-alumni') text-info
                                                @elseif ($out->viewer == 'private') text-warning
                                                @elseif ($out->viewer == 'secret') text-danger @endif'>
                                            </i>
                                            <div class="activity-content" style="text-align: justify">
                                                {{ Str::of($out->regarding)->words(20, '...') }}
                                            </div>
                                        </div>
                                    </div><!-- End activity item-->
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div><!-- Recent Surat Keluar -->

            </div> <!-- End Row 2 -->

        </div>
    </section>
@endsection
