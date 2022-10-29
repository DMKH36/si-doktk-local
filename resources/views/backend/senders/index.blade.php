@extends('backend.layouts.app')
@section('title', 'Pengirim Surat')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Pengirim Surat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Pengirim Surat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-16">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Data Pengirim Surat</h5>
                        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="bi bi-person-plus text-white"></i>&nbsp; Tambah Pengirim
                        </button>
                        @include('backend.senders.modal-add')
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ session('success') }}
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
                                    <th scope="col" class="text-center">Lembaga</th>
                                    <th scope="col" class="text-center">Email</th>
                                    <th scope="col" class="text-center">No. HP</th>
                                    <th scope="col" class="text-center" width="190">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sender as $data)
                                    <tr>
                                        <td style="vertical-align: middle"><strong>{{ $loop->iteration }}</strong></td>
                                        <td style="vertical-align: middle"><strong>{{ $data->name }}</strong></td>
                                        <td style="vertical-align: middle">{{ $data->lembaga }}</td>
                                        <td style="vertical-align: middle">{{ $data->email }}</td>
                                        <td style="vertical-align: middle" class="text-center">{{ $data->phone }}</td>
                                        <td style="vertical-align: middle" class="text-center">
                                            <button class="btn btn-info mx-2" data-bs-toggle="modal"
                                                data-bs-target="#showModal{{ $data->id }}">
                                                <i class="bi bi-eye-fill text-white"></i>
                                            </button>
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $data->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $data->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('backend.senders.modal')
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
    <script>
        $(document).ready(function() {
            $("#user_id").change(function() {
                var user_id = $(this).val();
                if (user_id == "0") {
                    $("#name").html(
                        `<input type="text" name="name" required class="form-control @error('name') is-invalid @enderror">`
                    );
                    $("#email").html(
                        `<input type="email" name="email" class="form-control @error('email') is-invalid @enderror">`
                    );
                    $("#phone").html(
                        `<input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror">`
                    );
                }

                $.ajax({
                    url: "/dashboard/sender/user/" + user_id,
                    type: "GET",
                    success: function(data) {
                        var people = data.people;
                        var html_name =
                            `<input type="text" name="name" readonly class="form-control @error('name') is-invalid @enderror" value="` +
                            people['name'] + `">`;
                        var html_email =
                            `<input type="email" name="email" readonly class="form-control @error('email') is-invalid @enderror" value="` +
                            people['email'] + `">`;
                        var html_phone =
                            `<input type="text" name="phone" readonly class="form-control @error('phone') is-invalid @enderror" value="` +
                            people['mobile_number'] + `">`;

                        $("#name").html(html_name);
                        $("#email").html(html_email);
                        $("#phone").html(html_phone);
                    }
                });
            });
        });
    </script>
@endsection
