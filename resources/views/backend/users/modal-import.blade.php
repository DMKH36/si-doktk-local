<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">
                    <i class="bi bi-file-earmark-excel"></i>&nbsp; Import Data Mahasiswa
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center row">
                <h4><strong>Format Import Data</strong></h4>
                <a href="{{ asset('backend/file/Format_Import_User.xlsx') }}" download="Format_Import_User.xlsx">
                    <i class="bi bi-download"></i>&nbsp; Download Format
                </a>
                <p class="text-danger mb-0 mt-2">Pastikan NIM dan Email tidak ada yang sama</p>
                <p class="mt-0">No. HP Boleh Kosong</p>
                <img src="{{ asset('backend/img/import-user.png') }}" alt="user-import">
            </div>
            <div class="modal-footer" style="justify-content: center">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button> --}}
                <form method="POST" action="{{ route('user.import') }}" enctype="multipart/form-data" class="col-12">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="file" id="file" class="form-control">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
