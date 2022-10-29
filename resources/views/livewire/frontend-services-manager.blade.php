<div>
    <header class="row g-3 mb-3">
        <div class="col-md-11">
            <h5 class="card-title col-md-11">Footer - Layanan</h5>
        </div>
        <div class="col-md-1 mt-5">
            <button wire:click="add()" type="button" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
        </div>
    </header>

    @if (session()->has('successServices'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('successServices') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @foreach ($frontendservices as $index => $service)
        <div class="row g-3 mb-3">
            <div class="col-md-11">
                <input wire:model="frontendservices.{{ $index }}.text" type="text" id="text"
                    name="text"
                    class="form-control @error('frontendservices.' . $index . '.text') is-invalid @enderror">
                @error('frontendservices.' . $index . '.text')
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
