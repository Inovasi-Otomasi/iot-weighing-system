{{-- <div> --}}
{{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
{{-- </div> --}}
<div class="d-flex align-items-center" wire:poll.250ms>
    <span class="text-sm text-{{ $result['color'] }} font-weight-bolder">
        <i class="fa fa-chevron-{{ $result['arrow'] }} text-xs me-1" aria-hidden="true"></i>{{ $result['percentage'] }}%
    </span>
    <span class="text-sm ms-1">from {{ $result['target'] }} gram (target).</span>
</div>
