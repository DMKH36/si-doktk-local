@extends('frontend.layouts.app')
@section('title', 'Dokumen Keluar')
@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="font-weight-bold"><a href="/dokkeluar" style="color: #444">Daftar Dokumen Keluar</a></h2>
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li>Daftar Dokumen Keluar</li>
                    </ol>
                </div>
            </div>
        </section><!-- Breadcrumbs Section -->

        <section class="dokumen mb-5" id="dokumen">
            <div class="container">
                <div class="section-header d-flex" style="justify-content: space-between">
                    <h2><a href="/dokkeluar" style="color: #0c2e8a">Dokumen Keluar</a></h2>
                    <form action="" method="GET" class="text-center mt-2">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari Dokumen"
                                value="{{ $keyword }}">
                            <button class="btn btn-outline-secondary input-group-text" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div data-aos="fade-up">
                    <div class="row dokumen-container">
                        @if ($documents->count())
                            @foreach ($documents as $doc)
                                <div class="col-lg-4 col-md-6 dokumen-item">
                                    <div class="text-center">
                                        <iframe src="{{ asset($doc->file) }}" class="img-fluid">
                                            Browser Anda tidak support dengan penampilan PDF, silahkan lihat detail!
                                        </iframe>
                                    </div>
                                    <div class="dokumen-info">
                                        <div class="dokumen-view-box">
                                            @if ($doc->viewer == 'public')
                                                <div class="dokumen-view bg-success">
                                                    <h6 class="view">Public</h6>
                                                </div>
                                            @elseif ($doc->viewer == 'mahasiswa')
                                                <div class="dokumen-view bg-primary">
                                                    <h6 class="view">Mahasiswa</h6>
                                                </div>
                                            @elseif ($doc->viewer == 'alumni')
                                                <div class="dokumen-view bg-primary">
                                                    <h6 class="view">Alumni</h6>
                                                </div>
                                            @elseif ($doc->viewer == 'mahasiswa-alumni')
                                                <div class="dokumen-view bg-info">
                                                    <h6 class="view">Mahasiswa-Alumni</h6>
                                                </div>
                                            @elseif ($doc->viewer == 'private')
                                                <div class="dokumen-view bg-warning">
                                                    <h6 class="view">User Terkait</h6>
                                                </div>
                                            @elseif ($doc->viewer == 'secret')
                                                <div class="dokumen-view bg-danger">
                                                    <h6 class="view">Rahasia</h6>
                                                </div>
                                            @endif
                                            <div class="dokumen-date">
                                                <p class="date">
                                                    <strong>{{ $doc->letter_date }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <h4 class="pt-1"><a class="text-white"
                                                href="{{ route('home.show', ['id' => encrypt($doc->id)]) }}">{{ $doc->letter_number }}</a>
                                        </h4>
                                        <p class="m-0 p-0"><strong>{{ $doc->receiver_name }}</strong></p>
                                        <p class="m-0 p-0">{{ Str::of($doc->regarding)->words(7, '...') }}</p>
                                        <a class="details-link" title="Detail Dokumen"
                                            href="{{ route('home.show', ['id' => encrypt($doc->id)]) }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row text-center">
                                <h4>Dokumen Tidak Ditemukan.</h4>
                            </div>
                        @endif
                    </div>
                    {{ $documents->links() }}
                </div>
            </div>
        </section>

    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
