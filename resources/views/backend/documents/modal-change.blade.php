<!-- Change Type Document Modal -->
<div class="modal fade" id="ubahTipeModal{{ $doc->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Apakah anda yakin mengubah jenis Surat ini?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> Jika anda yakin ingin mengubah jenis Surat dengan Nomor
                <strong>{{ $doc->letter_number }}</strong>, Tekan Oke!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                @if ($doc->type == 'masuk')
                    <a class="btn btn-primary"
                        href="{{ route('doc.change', ['doc_id' => encrypt($doc->id), 'type' => 'keluar']) }}">Oke</a>
                @elseif ($doc->type == 'keluar')
                    <a class="btn btn-primary"
                        href="{{ route('doc.change', ['doc_id' => encrypt($doc->id), 'type' => 'masuk']) }}">Oke</a>
                @endif
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->
