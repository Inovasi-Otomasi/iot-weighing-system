{{-- <div class="card-body">
    <h5 class="card-title text-center">USER</h5>
    <a class="btn btn-outline-iot w-100 {{ request('user') == 'Operator' ? 'active' : '' }}"
        href="{{ $request->fullUrlWithQuery(['user' => 'Operator']) }}">Operator</a>
    <a class="btn btn-outline-iot w-100 {{ request('user') == 'QC' ? 'active' : '' }}"
        href="{{ $request->fullUrlWithQuery(['user' => 'QC']) }}">QC</a>
</div> --}}

{{-- <div>
    <input class="btn btn-outline-iot" wire:model="operator" type="button">
    <input wire:model="test" type="search" placeholder="Search posts by title...">
</div> --}}
{{-- <div>
    <button wire:click="like">Like Post</button>
</div> --}}

<div class="card-body">
    <h5 class="card-title text-center">USER : {{ $user }}</h5>
    <button wire:click="updateUser('Operator')"
        class="btn btn-outline-iot w-100 {{ $user == 'Operator' ? 'active' : '' }}">Operator</button>
    <button wire:click="updateUser('QC')"
        class="btn btn-outline-iot w-100 {{ $user == 'QC' ? 'active' : '' }}">QC</button>
</div>
