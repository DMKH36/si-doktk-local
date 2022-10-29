@extends('backend.layouts.app')
@section('title', 'Data Pengurus')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Data Pengurus</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Pengurus</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-16">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Pengurus</h5>
                        <a href="{{ route('operator.create') }}" class="btn btn-primary mb-3">
                            <i class="bi bi-person-plus text-white"></i>&nbsp; Tambah Pengurus
                        </a>
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('info'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <i class="bi bi-info-circle me-1"></i>
                                {{ session('info') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-octagon me-1"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col" width="65">No.</th>
                                    <th scope="col" class="text-center">Nama</th>
                                    <th scope="col" class="text-center">Email</th>
                                    <th scope="col" class="text-center">Role</th>
                                    <th scope="col" width="100" class="text-center">Status</th>
                                    <th scope="col" width="95" class="text-center">Detail</th>
                                    <th scope="col" width="175" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($operator as $data)
                                    <tr>
                                        <td style="vertical-align: middle"><strong>{{ $loop->iteration }}</strong></td>
                                        <td style="vertical-align: middle"><strong>{{ $data->name }}</strong></td>
                                        <td style="vertical-align: middle">{{ $data->email }}</td>
                                        <td style="vertical-align: middle">
                                            @if ($data->role == 'admin')
                                                Admin
                                            @elseif ($data->role == 'kadep')
                                                Kepala Departemen
                                            @elseif ($data->role == 'koor')
                                                Koordinator Kemahasiswaan
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle" class="text-center">
                                            <div class="btn-group">
                                                @if ($data->status == 0)
                                                    <a href="{{ route('operator.status', ['user_id' => encrypt($data->id), 'status' => 1]) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        Active
                                                    </a>
                                                    <label class="btn btn-sm btn-danger">
                                                        Inactive
                                                    </label>
                                                @elseif ($data->status == 1)
                                                    <label class="btn btn-sm btn-success">
                                                        Active
                                                    </label>
                                                    <a href="{{ route('operator.status', ['user_id' => encrypt($data->id), 'status' => 0]) }}"
                                                        class="btn btn-sm btn-outline-danger">
                                                        Inactive
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle" class="text-center">
                                            <button class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#showModal{{ $data->id }}">
                                                <i class="bi bi-eye-fill text-white"></i>
                                            </button>
                                        </td>
                                        <td style="vertical-align: middle" class="text-center">
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#resetModal{{ $data->id }}">
                                                <i class="bi bi-arrow-counterclockwise text-white"></i>
                                            </button>
                                            <a class="btn btn-primary" title="Edit"
                                                href="{{ route('operator.edit', ['operator' => encrypt($data->id)]) }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $data->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('backend.operators.modal')
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
