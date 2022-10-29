<div>
    <header class="row g-3 mb-3">
        <div class="col-md-4">
            <label for="name" class="form-label">Nama</label>
        </div>
        <div class="col-md-7">
            <label for="text" class="form-label">Keterangan</label>
        </div>
        <div class="col-md-1">
            <button wire:click="add()" type="button" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
        </div>
    </header>

    @if (session()->has('successContacts'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('successContacts') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @foreach ($frontendcontacts as $index => $contact)
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <input wire:model="frontendcontacts.{{ $index }}.name" type="text" id="name"
                    name="name"
                    class="form-control @error('frontendcontacts.' . $index . '.name') is-invalid @enderror">
                @error('frontendcontacts.' . $index . '.name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-7">
                <input wire:model="frontendcontacts.{{ $index }}.text" type="text" id="text"
                    name="text"
                    class="form-control @error('frontendcontacts.' . $index . '.text') is-invalid @enderror">
                @error('frontendcontacts.' . $index . '.text')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-1">
                <button wire:click="delete({{ $index }})" type="button" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    @endforeach

    <div class="text-center">
        <button wire:click="save()" type="button" class="btn btn-primary">Submit</button>
    </div>
</div>
