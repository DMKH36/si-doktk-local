<!-- Show Modal -->
<div class="modal fade" id="showModal{{ $data->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white"><strong>{{ $data->name }}</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    @if ($data->picture != null)
                        <img src="{{ Storage::url($data->picture) }}" alt="Profile" class="rounded-circle"
                            height="100">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ $data->name }}" alt="Profile"
                            class="rounded-circle" height="100">
                    @endif
                    <h4 class="mt-3 text-center">{{ $data->name }}</h4>
                    <h5 class="card-title" style="padding: 0">
                        @if ($data->role == 'mahasiswa')
                            Mahasiswa
                        @elseif ($data->role == 'alumni')
                            Alumni
                        @endif
                    </h5>
                    <div class="row">
                        <span class="text-center bg-info-light mt-3 mb-2"><strong>Profile Details</strong></span>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 label ">Nama</div>
                            <div class="col-lg-8 col-md-8">
                                <strong class="text-primary">: </strong>{{ $data->name }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 label">NIM</div>
                            <div class="col-lg-8 col-md-8">
                                <strong class="text-primary">: </strong>{{ $data->nim }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 label">Email</div>
                            <div class="col-lg-8 col-md-8">
                                <strong class="text-primary">: </strong>{{ $data->email }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 label">No. HP</div>
                            <div class="col-lg-8 col-md-8">
                                <strong class="text-primary">: </strong>{{ $data->mobile_number }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 label">Jenis Kelamin</div>
                            <div class="col-lg-8 col-md-8">
                                <strong class="text-primary">: </strong>
                                @if ($data->gender == 'L')
                                    Laki-Laki
                                @elseif ($data->gender == 'P')
                                    Perempuan
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 label">Status</div>
                            <div class="col-lg-8 col-md-8">
                                <strong class="text-primary">: </strong>
                                @if ($data->status == 0)
                                    <span class="badge bg-danger">Inactive</span>
                                @elseif ($data->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </div>
                        </div>
                        @if ($data->ktm != null)
                            <div class="mt-3 text-center">
                                <img src="{{ Storage::url($data->ktm) }}" alt="KTM" width="350">
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Basic Modal-->

<!-- Reset Modal -->
<div class="modal fade" id="resetModal{{ $data->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Apakah anda yakin me-Reset Password Akun tersebut?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Jika anda yakin ingin me-Reset Password dari Akun <strong>{{ $data->name }}</strong>, Tekan Oke!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="{{ route('user.reset', ['user_id' => $data->id]) }}">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-primary">Oke</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Apakah anda yakin menghapus Data ini?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Jika anda yakin ingin menghapus Akun <strong>{{ $data->name }}</strong>, Tekan Oke!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="{{ route('user.destroy', ['user_id' => $data->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Oke</button>
                </form>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->
