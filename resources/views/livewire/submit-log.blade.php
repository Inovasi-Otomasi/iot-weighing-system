<div>
    <div class="d-flex justify-content-center">
        <button wire:click="sendLog()" class="btn btn-iot mt-2 mb-0 btn-lg"
            style="border-radius:70%!important;padding:2rem!important;">
            <i class="fa-solid fa-play icon-lg"></i>
        </button>

        {{-- {{ $machine }}
    {{ $line }}
    {{ $sku }}
    {{ $user }}
    {{ $shift }} --}}
    </div>
    @if (session()->has('successMsg'))
        <div class="alert alert-success alert-dismissible text-center mt-5">
            {{ session('successMsg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-dark">&times;</span>
            </button>
        </div>
    @elseif(session()->has('failedMsg'))
        <div class="alert alert-danger alert-dismissible text-center mt-5">
            {{ session('failedMsg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-dark">&times;</span>
            </button>
        </div>
    @endif
    {{-- <div class="text-center mt-2">
        <h2 class="text-{{ $sent_color }}">{{ $sent_text }} ({{ $sent_weight }})</h2>
    </div> --}}
</div>
