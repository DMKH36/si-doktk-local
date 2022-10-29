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
                    <h4 class="mt-3 text-center">{{ $data->name }}</h4>
                    <h5 class="card-title" style="padding: 0">{{ $data->lembaga }}</h5>
                    @if ($data->user_id == 0)
                        <h5><span class="badge bg-warning">Bukan User</span></h5>
                    @else
                        <h5><span class="badge bg-success">User</span></h5>
                    @endif
                    <div class="row">
                        <span class="text-center bg-info-light mt-3 mb-2"><strong>Profile Details</strong></span>

                        <div class="row">
                            <div class="col-lg-3 col-md-3 label ">Nama</div>
                            <div class="col-lg-1 col-md-1">
                                <strong class="text-primary">: </strong>
                            </div>
                            <div class="col-lg-8 col-md-8">{{ $data->name }}</div>
                        </div>
                        <hr class="mt-1 mb-1">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 label">Lembaga</div>
                            <div class="col-lg-1 col-md-1">
                                <strong class="text-primary">: </strong>
                            </div>
                            <div class="col-lg-8 col-md-8">{{ $data->lembaga }}</div>
                        </div>
                        <hr class="mt-1 mb-1">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 label">Email</div>
                            <div class="col-lg-1 col-md-1">
                                <strong class="text-primary">: </strong>
                            </div>
                            <div class="col-lg-8 col-md-8">{{ $data->email }}</div>
                        </div>
                        <hr class="mt-1 mb-1">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 label">No. HP</div>
                            <div class="col-lg-1 col-md-1">
                                <strong class="text-primary">: </strong>
                            </div>
                            <div class="col-lg-8 col-md-8">{{ $data->phone }}</div>
                        </div>
                        <hr class="mt-1 mb-1">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 label">Alamat</div>
                            <div class="col-lg-1 col-md-1">
                                <strong class="text-primary">: </strong>
                            </div>
                            <div class="col-lg-8 col-md-8">{{ $data->address }}</div>
                        </div>

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

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><strong>Edit Data Penerima Surat</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('receiver.update', $data->id) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('put')
                    <div class="col-12 mb-1 text-center">
                        @if ($data->user_id == 0)
                            <h4><span class="badge bg-warning">Bukan User</span></h4>
                        @else
                            <h4><span class="badge bg-success">User</span></h4>
                        @endif
                    </div>
                    <!-- Kolom From User -->
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Nama Penerima <span
                                class="text-danger">*</span></label>
                        <input type="text" name="name" required
                            value="{{ old('name') ? old('name') : $data->name }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Lembaga <span class="text-danger">*</span></label>
                        <input type="text" name="lembaga" required
                            value="{{ old('lembaga') ? old('lembaga') : $data->lembaga }}"
                            class="form-control @error('lembaga') is-invalid @enderror">
                        @error('lembaga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="address" class="form-label">Alamat Lembaga/Penerima</label>
                        <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror">{{ $data->address }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') ? old('email') : $data->email }}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="phone" class="form-label">Nomor HP</label>
                        <input type="text" name="phone"
                            value="{{ old('phone') ? old('phone') : $data->phone }}"
                            class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
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
                Jika anda yakin ingin menghapus <strong>{{ $data->name }}</strong>, Tekan Oke!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="{{ route('receiver.destroy', $data->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Oke</button>
                </form>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->
