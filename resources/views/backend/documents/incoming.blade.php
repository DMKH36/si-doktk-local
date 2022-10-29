@extends('backend.layouts.app')
@section('title', 'Surat Masuk')
@section('content')
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Surat Masuk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Surat Masuk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-16">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Surat Masuk</h5>
                        @if ($user->role != 'kadep')
                            <div class="d-flex" style="justify-content: space-between">
                                <div>
                                    <button class="btn btn-success mb-1" data-bs-toggle="modal"
                                        data-bs-target="#importInModal">
                                        <i class="bi bi-box-arrow-in-down"></i>&nbsp; Import Data
                                    </button>
                                    <a href="{{ route('doc.inpdf', 'masuk') }}" class="btn btn-primary mb-1">
                                        <i class="bi bi-file-earmark-pdf"></i>&nbsp; Export PDF
                                    </a>
                                    <a href="{{ route('doc.inexport') }}" class="btn btn-primary mb-1">
                                        <i class="bi bi-file-earmark-excel"></i>&nbsp; Export Excel
                                    </a>
                                </div>
                                <div class="d-flex">
                                    <div class="text-center" style="margin-left: 10px">
                                        <label class="form-label">Awal</label>
                                        <input type="date" name="startdate" id="startdate" class="form-control">
                                    </div>
                                    <div class="text-center" style="margin-left: 10px">
                                        <label class="form-label">Akhir</label>
                                        <input type="date" name="enddate" id="enddate" class="form-control">
                                    </div>
                                    <div class="text-center mb-2" style="margin-left: 10px; margin-top: 31px;">
                                        <a class="btn btn-info" target="_blank"
                                            onclick="this.href='/dashboard/document/incoming/date/' + document.getElementById('startdate').value + '/' + document.getElementById('enddate').value">
                                            <i class="bi bi-calendar-range"></i>&nbsp; Export Sesuai Range Tanggal
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show">
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
                        @if ($user->role != 'kadep')
                            <div class="d-flex">
                                <div style="display: none" name="csrf-token" token="{{ csrf_token() }}"></div>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delCheckModal">
                                    <i class="bi bi-trash"></i>&nbsp;Hapus data terpilih
                                </button>
                            </div>
                        @endif
                        <table id="datatable" class="table datatable">
                            <thead>
                                <tr>
                                    @if ($user->role != 'kadep')
                                        <th scope="col" width="25" id="no-sort">
                                            <input type="checkbox" id="checkAll">
                                        </th>
                                    @endif
                                    <th scope="col" width="65">No.</th>
                                    <th scope="col">No. Surat</th>
                                    <th scope="col" width="150" class="text-center">Tanggal Surat</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col" class="text-center">Perihal</th>
                                    <th scope="col" width="100" class="text-center">Disposisi</th>
                                    <th scope="col" width="100" class="text-center">View</th>
                                    @if ($user->role == 'kadep')
                                        <th scope="col" width="100" class="text-center">Aksi</th>
                                    @else
                                        <th scope="col" width="180" class="text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masuk as $data)
                                    <tr id="tr_{{ $data->id }}">
                                        @if ($user->role != 'kadep')
                                            <td style="vertical-align: middle">
                                                <input type="checkbox" class="checkboxClass" data-id="{{ $data->id }}">
                                            </td>
                                        @endif
                                        <td style="vertical-align: middle"><strong>{{ $loop->iteration }}</strong></td>
                                        <td style="vertical-align: middle">{{ $data->letter_number }}</td>
                                        <td style="vertical-align: middle" class="text-center">
                                            {{ date('d-m-Y', strtotime($data->letter_date)) }}
                                        </td>
                                        <td style="vertical-align: middle">{{ $data->sender_name }}</td>
                                        <td style="vertical-align: middle">
                                            {{ Str::of($data->regarding)->words(5, '...') }}
                                        </td>
                                        <td style="vertical-align: middle" class="text-center">
                                            @if ($data->disposisi_set == 0)
                                                <span class="badge bg-primary">Tidak Perlu</span>
                                            @elseif ($data->disposisi_set == 1)
                                                <span class="badge bg-danger">Belum Ada</span>
                                            @elseif ($data->disposisi_set == 2)
                                                <span class="badge bg-success">Sudah Ada</span>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle" class="text-center">
                                            @if ($data->viewer == 'public')
                                                <span class="badge bg-success">Public</span>
                                            @elseif ($data->viewer == 'mahasiswa')
                                                <span class="badge bg-primary">Mahasiswa</span>
                                            @elseif ($data->viewer == 'alumni')
                                                <span class="badge bg-primary">Alumni</span>
                                            @elseif ($data->viewer == 'mahasiswa-alumni')
                                                <span class="badge bg-info">Mahasiswa-Alumni</span>
                                            @elseif ($data->viewer == 'private')
                                                <span class="badge bg-warning">User Terkait</span>
                                            @elseif ($data->viewer == 'secret')
                                                <span class="badge bg-danger">Rahasia</span>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle" class="text-center">
                                            @if ($user->role == 'kadep')
                                                <a class="btn btn-info"
                                                    href="{{ route('kadep.show', ['kadep' => encrypt($data->id)]) }}">
                                                    <i class="bi bi-eye-fill text-white"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-info"
                                                    href="{{ route('document.show', ['document' => encrypt($data->id)]) }}">
                                                    <i class="bi bi-eye-fill text-white"></i>
                                                </a>
                                                <a class="btn btn-primary"
                                                    href="{{ route('document.edit', ['document' => encrypt($data->id)]) }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $data->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @include('backend.documents.modal-delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.documents.modal')
@endsection
@section('script')
    <script>
        // Disable Sorting on Checkbox
        $("#no-sort").ready(function() {
            const check = document.querySelector('#no-sort');
            const nosorter = document.querySelector('#no-sort .dataTable-sorter');

            nosorter.style.display = 'none';

            $(check).html(
                `<input type="checkbox" id="checkAll">`
            );
        });

        // All Check Checkbox
        $(function(e) {
            $("#checkAll").click(function() {
                $(".checkboxClass").prop('checked', $(this).prop('checked'));
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.check-delete').on('click', function(e) {
                var allVals = [];
                $(".checkboxClass:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });
                if (allVals.length <= 0) {
                    alert("Pilih data terlebih dahulu!");
                } else {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('div[name="csrf-token"]').attr('token')
                        },
                        data: 'ids=' + join_selected_values,
                        success: function(data) {
                            if (data['success']) {
                                $(".checkboxClass:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                    $.each(allVals, function(index, value) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            });
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function(event, element) {
                    element.trigger('confirm');
                }
            });
            $(document).on('confirm', function(e) {
                var ele = e.target;
                e.preventDefault();
                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('div[name="csrf-token"]').attr('token')
                    },
                    success: function(data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function(data) {
                        alert(data.responseText);
                    }
                });
                return false;
            });
        });
    </script>

    <script>
        // $(document).ready(function() {
        //     $(".check-delete").on('click', function(e) {
        //         e.preventDefault();
        //         var allids = [];

        //         $("input:checkbox[name=idd]:checked").each(function() {
        //             allids.push($(this).val());
        //         });

        //         $.ajax({
        //             url: "{{ route('doc.delcheck') }}",
        //             type: "DELETE",
        //             data: {
        //                 _token: $("input[name=_token]").val(),
        //                 idd: allids
        //             },
        //             success: function(response) {
        //                 $.each(allids, function(key, val) {
        //                     $("#dataid" + val).remove();
        //                 });
        //             }
        //         });
        //     });
        // });

        // $(document).ready(function() {
        //     $("#deleteCheck").click(function(e) {
        //         e.preventDefault();
        //         var allids = [];

        //         $("input:checkbox[name=idd]:checked").each(function() {
        //             allids.push($(this).val());
        //         });

        //         $.ajax({
        //             url: "{{ route('doc.delcheck') }}",
        //             type: "DELETE",
        //             data: {
        //                 _token: $("input[name=_token]").val(),
        //                 idd: allids
        //             },
        //             success: function(response) {
        //                 $.each(allids, function(key, val) {
        //                     $("#dataid" + val).remove();
        //                 });
        //             }
        //         });
        //     });
        // });
    </script>
@endsection
