@extends('backend.layouts.app')
@section('title', 'Surat Untuk Kadep')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Surat Untuk Kepala Departemen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Surat Untuk Kepala Departemen</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Surat untuk Kepala Departemen</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
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
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col" width="65">No.</th>
                                <th scope="col">No. Surat</th>
                                <th scope="col">Tanggal Surat</th>
                                <th scope="col">Pengirim</th>
                                <th scope="col" class="text-center">Perihal</th>
                                <th scope="col" width="100" class="text-center">Disposisi</th>
                                <th scope="col" width="95" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doc as $data)
                                <tr>
                                    <td style="vertical-align: middle"><strong>{{ $loop->iteration }}</strong></td>
                                    <td style="vertical-align: middle">{{ $data->letter_number }}</td>
                                    <td style="vertical-align: middle">
                                        {{ date('d-m-Y', strtotime($data->letter_date)) }}
                                    </td>
                                    <td style="vertical-align: middle">{{ $data->sender_name }}</td>
                                    <td style="vertical-align: middle">
                                        {{ Str::of($data->regarding)->words(5, '...') }}
                                    </td>
                                    <td style="vertical-align: middle" class="text-center">
                                        @if ($data->disposisi_set == 1)
                                            <span class="badge bg-danger">Belum ada Disposisi</span>
                                        @else
                                            <span class="badge bg-success">Sudah diberi Disposisi</span>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle" class="text-center">
                                        <a class="btn btn-info mx-2"
                                            href="{{ route('kadep.edit', ['kadep' => encrypt($data->id)]) }}">
                                            <i class="bi bi-eye-fill text-white"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
