<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><strong>Tambah Data Penerima Surat</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('receiver.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <!-- Kolom From User -->
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label"><strong>Penerima </strong><span
                                class="text-danger">*</span></label>
                        <select id="user_id" name="user_id" aria-label="Default select example"
                            class="form-select @error('user_id') is-invalid @enderror" onchange="getdata(this)">
                            <option class="fw-bold text-success" value="0"
                                {{ old('user_id') == '0' ? 'selected' : '' }}>
                                Penerima Bukan User
                            </option>
                            @foreach ($people as $data)
                                <option value="{{ $data->id }}" {{ old('user_id') == $data->id ? 'selected' : '' }}>
                                    {{ $data->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Nama Penerima <span
                                class="text-danger">*</span></label>
                        <div id="name">
                            <input type="text" name="name" required
                                class="form-control @error('name') is-invalid @enderror">
                        </div>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Lembaga <span class="text-danger">*</span></label>
                        <input type="text" id="lembaga" name="lembaga" required value="{{ old('lembaga') }}"
                            class="form-control @error('lembaga') is-invalid @enderror">
                        @error('lembaga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="address" class="form-label">Alamat Lembaga/Penerima</label>
                        <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror"></textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div id="email">
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror">
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="phone" class="form-label">Nomor HP</label>
                        <div id="phone">
                            <input type="text" name="phone"
                                class="form-control @error('phone') is-invalid @enderror">
                        </div>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
