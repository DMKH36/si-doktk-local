<!-- Checked Delete Modal -->
<div class="modal fade" id="delCheckModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Apakah anda yakin menghapus Dokumen ini?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Jika anda yakin ingin menghapus beberapa Dokumen tersebut, Tekan Oke!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary check-delete" data-url="{{ route('doc.delcheck') }}">Oke</button>
            </div>
        </div>
    </div>
</div>

<!-- Import In Modal -->
<div class="modal fade" id="importInModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">
                    <i class="bi bi-file-earmark-excel"></i><strong>&nbsp; Import Data Surat Masuk</strong>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('doc.inimport') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="text-center row">
                        <h4><strong>Format Import Data</strong></h4>
                        <a href="{{ asset('backend/file/Format_Import_DocumentIn.xlsx') }}"
                            download="Format_Import_Dokumen_Masuk.xlsx">
                            <i class="bi bi-download"></i>&nbsp; Download Format
                        </a>
                        <img src="{{ asset('backend/img/import-document-in.png') }}" alt="user-import" class="mt-2"
                            style="border: 1px solid #555;">
                        <p class="text-danger mb-0 mt-2">Pastikan Nama File Surat di Excel dan di dalam ZIP sudah
                            sesuai, dan tidak ada nama yang sama!</p>
                        <p class="mb-0">Disarankan nama file.pdf dalam zip berupa tipe surat diikuti tanggal ketika
                            import dan diikuti urutan,<br>Misal : masuk_19-10-2022 (1)</p>
                        <p class="mb-1">(Agar tidak terjadi error di import selanjutnya)</p>
                    </div>
                    <!-- Kolom From User -->
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Import Data (.csv/.xls/.xlsx) <span
                                class="text-danger">*</span></label>
                        <input type="file" name="excel" id="excel" required
                            class="form-control @error('excel') is-invalid @enderror">
                        @error('excel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Import File (.zip berisi file .pdf) <span
                                class="text-danger">*</span></label>
                        <input type="file" name="zip" id="zip" required
                            class="form-control @error('zip') is-invalid @enderror">
                        @error('zip')
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


<!-- Import Out Modal -->
<div class="modal fade" id="importOutModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">
                    <i class="bi bi-file-earmark-excel"></i><strong>&nbsp; Import Data Surat Keluar</strong>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('doc.outimport') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="text-center row">
                        <h4><strong>Format Import Data</strong></h4>
                        <a href="{{ asset('backend/file/Format_Import_DocumentOut.xlsx') }}"
                            download="Format_Import_Dokumen_Keluar.xlsx">
                            <i class="bi bi-download"></i>&nbsp; Download Format
                        </a>
                        <img src="{{ asset('backend/img/import-document-out.png') }}" alt="user-import" class="mt-2"
                            style="border: 1px solid #555;">
                        <p class="text-danger mb-0 mt-2">Pastikan Nama File Surat di Excel dan di dalam ZIP sudah
                            sesuai, dan tidak ada nama yang sama!</p>
                        <p class="mb-0">Disarankan nama file.pdf dalam zip berupa tipe surat diikuti tanggal ketika
                            import dan diikuti urutan,<br>Misal : keluar_19-10-2022 (1)</p>
                        <p class="mb-1">(Agar tidak terjadi error di import selanjutnya)</p>
                    </div>
                    <!-- Kolom From User -->
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Import Data (.csv/.xls/.xlsx) <span
                                class="text-danger">*</span></label>
                        <input type="file" name="excel" id="excel" required
                            class="form-control @error('excel') is-invalid @enderror">
                        @error('excel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Import File (.zip berisi file .pdf) <span
                                class="text-danger">*</span></label>
                        <input type="file" name="zip" id="zip" required
                            class="form-control @error('zip') is-invalid @enderror">
                        @error('zip')
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
