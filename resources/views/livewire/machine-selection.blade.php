{{-- <div class="card-body">
    <h5 class="card-title text-center">MACHINE</h5>
    <div class="row overflow-auto" style="max-height:220px;">
        @foreach ($machines as $machine)
            <div class="col-6">
                <a class="btn btn-outline-iot w-100 {{ request('machine') == $machine->id ? 'active' : '' }}"
                    href="{{ $request->fullUrlWithQuery(['machine' => $machine->id]) }}">{{ $machine->machine_name }}</a>
            </div>
        @endforeach
    </div>
</div> --}}
<div class="card-body">
    {{-- <h5 class="card-title text-center">USER</h5>
    <button wire:click="updateUser('Operator')"
        class="btn btn-outline-iot w-100 {{ $user == 'Operator' ? 'active' : '' }}">Operator</button>
    <button wire:click="updateUser('QC')"
        class="btn btn-outline-iot w-100 {{ $user == 'QC' ? 'active' : '' }}">QC</button> --}}

    <h5 class="card-title text-center">MACHINE : {{ $machine_name }}</h5>
    <div class="my-3">
        <input wire:model="machine_search" type="text" class="form-control">
    </div>
    <div class="row overflow-auto" style="max-height:250px;">
        @foreach ($machines as $machine_row)
            <div class="col-6">
                <button wire:click="updateMachine({{ $machine_row->id }})"
                    class="btn btn-outline-iot py-3 w-100 {{ $machine == $machine_row->id ? 'active' : '' }}">
                    <span style="font-size: 200%">{{ $machine_row->machine_name }}</span>
                </button>
                {{-- <a class="btn btn-outline-iot w-100 {{ request('machine') == $machine->id ? 'active' : '' }}"
                    href="{{ $request->fullUrlWithQuery(['machine' => $machine->id]) }}">{{ $machine->machine_name }}</a> --}}
            </div>
        @endforeach
    </div>
</div>
