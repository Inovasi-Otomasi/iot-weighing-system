<div class="card-body">
    <h5 class="card-title text-center">PIC</h5>
    <div class="overflow-auto" style="max-height:100px;">
        @foreach ($pic_list as $pic_row)
            <button wire:click="updatePic({{ $pic_row->id }})"
                class="btn btn-outline-iot w-100 {{ $pic == $pic_row->id ? 'active' : '' }}">{{ $pic_row->pic_name }}</button>
        @endforeach
    </div>

    {{-- <button wire:click="updateUser('Operator')"
        class="btn btn-outline-iot w-100 {{ $user == 'Operator' ? 'active' : '' }}">Operator</button>
    <button wire:click="updateUser('QC')"
        class="btn btn-outline-iot w-100 {{ $user == 'QC' ? 'active' : '' }}">QC</button> --}}
</div>
