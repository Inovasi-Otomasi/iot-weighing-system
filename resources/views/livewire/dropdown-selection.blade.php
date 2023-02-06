{{-- <div class="mt-3 "> --}}
{{-- <div> --}}
{{-- <input wire:model="sku" type="" placeholder="Search posts by title...">
        <ul wire:poll.150ms>
            @foreach ($sku_list as $sku_row)
                <li>{{ $sku_row->sku_name }}</li>
            @endforeach
        </ul> --}}
{{-- <select class="form-select js-example-basic-single" wire:model="sku" id="sku-dropdown" name="sku" required>
            @foreach ($sku_list as $sku_row)
                <option {{ $sku == $sku_row->id ? 'selected' : '' }} value="{{ $sku_row->id }}">
                    {{ $sku_row->sku_name }}</option>
            @endforeach
        </select> --}}
{{-- <select class="form-select js-example-basic-single" wire:click="updateSKU" wire:model="sku">
            <option></option>
            <option>1</option>
            <option>2</option>
        </select> --}}
{{-- <select wire:click="updateSku($event.target.value)" id="sku-dropdown"
            class="form-select  @error('chapter_id') is-invalid @enderror" placeholder="Menu">
            @foreach ($sku_list as $sku_row)
                <option {{ $sku == $sku_row->id ? 'selected' : '' }} value="{{ $sku_row->id }}">
                    {{ $sku_row->sku_name }}</option>
            @endforeach
        </select> --}}
{{-- <select id="sku-dropdown-1" class="form-select js-example-basic-single">
            @foreach ($sku_list as $sku_row)
                <option {{ $sku == $sku_row->id ? 'selected' : '' }} value="{{ $sku_row->id }}">
                    {{ $sku_row->sku_name }}</option>
            @endforeach
        </select> --}}
{{-- <select class="form-control js-example-basic-single" wire:click="updateSku($event.target.value)">
            <option value="1">-- Select City --</option>
            <option value="2">-- Select City --</option>
        </select> --}}
{{-- <label for="line-dropdown">Line</label> --}}
{{-- </div> --}}
{{-- <div class="col-md">
        <div class="form-floating">
            <select class="form-select" id="line-dropdown" name="line" required>
                @foreach ($lines as $line_row)
                    <option wire:click="updateLine('{{ $line_row->id }}')" {{ $line == $line_row->id ? 'selected' : '' }}
                        value="{{ $line_row->id }}">
                        {{ $line_row->line_name }}</option>
                @endforeach
            </select>
            <label for="line-dropdown">Line</label>
        </div>
    </div> --}}
{{-- <div class="col-md">
        <div class="form-floating">
            <select class="form-select" id="sku-dropdown" name="sku" required>
                @foreach ($sku_list as $sku_row)
                    <option wire:click="updateSku('{{ $sku_row->id }}')" {{ $sku == $sku_row->id ? 'selected' : '' }}
                        value="{{ $sku_row->id }}">
                        {{ $sku_row->sku_name }}</option>
                @endforeach
            </select>
            <label for="line-dropdown">Line</label>
        </div>
    </div> --}}
{{-- <div class="col-md">
            <div class="form-floating">
                <select class="form-select" id="shift-dropdown" name="shift" required>
                    <option selected="true" disabled="disabled" value="">Not selected</option>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}"
                            {{ old('shift', request('shift')) == $shift->id ? 'selected' : '' }}>
                            {{ $shift->shift_name }}</option>
                    @endforeach
                </select>
                <label for="shift-dropdown">Shift</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating">
                <select class="form-select" id="sku-dropdown" name="sku" required>
                    <option selected="true" disabled="disabled" value="">Not selected</option>
                    @foreach ($sku_list as $sku)
                        <option value="{{ $sku->id }}"
                            {{ old('sku', request('sku')) == $sku->id ? 'selected' : '' }}>
                            {{ $sku->sku_name }}</option>
                    @endforeach
                </select>
                <label for="sku-dropdown">SKU</label>
            </div>
        </div> --}}
{{-- </div> --}}
<div>

    {{-- <div class="btn-group flex-wrap mt-3">
        <div class="dropdown me-3 mb-2">
            <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-line"
                data-bs-toggle="dropdown" aria-expanded="false">
                Line : {{ $line_name ?: 'Not Selected' }}
            </button>
            <ul class="dropdown-menu overflow-auto" aria-labelledby="dropdown-line" style="max-height: 280px;">
                @livewire('dropdown-search', ['parameter' => 'line'])
            </ul>
        </div>
    </div>
    <div class="btn-group flex-wrap mt-3">
        <div class="dropdown me-3 mb-2">
            <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-shift"
                data-bs-toggle="dropdown" aria-expanded="false">
                Shift : {{ $shift_name ?: 'Not Selected' }}
            </button>
            <ul class="dropdown-menu overflow-auto" aria-labelledby="dropdown-shift" style="max-height: 280px;">
                @livewire('dropdown-search', ['parameter' => 'shift'])
            </ul>
        </div>
    </div> --}}
    {{-- <div class=" flex-wrap mt-3">
        <div class="dropdown mb-2">
            <button class="w-100 btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-hmi"
                data-bs-toggle="dropdown" aria-expanded="false">
                HMI : {{ $hmi_name ?: 'Not Selected' }}
            </button>
            <ul class="dropdown-menu overflow-auto" aria-labelledby="dropdown-hmi" style="max-height: 280px;">
                @livewire('dropdown-search', ['parameter' => 'hmi'])
            </ul>
        </div>
    </div> --}}
    <div class=" flex-wrap mt-3">
        <div class="dropdown mb-2">
            <button class="w-100 btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-sku"
                data-bs-toggle="dropdown" aria-expanded="false">
                SKU : {{ $sku_name ?: 'Not Selected' }}
            </button>
            <ul class="dropdown-menu overflow-auto" aria-labelledby="dropdown-sku" style="max-height: 280px;">
                @livewire('dropdown-search', ['parameter' => 'sku'])
            </ul>
        </div>
    </div>
    <div class=" flex-wrap mt-3">
        <div class="dropdown mb-2">
            <button class="w-100 btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-pic"
                data-bs-toggle="dropdown" aria-expanded="false">
                PIC : {{ $pic_name ?: 'Not Selected' }} {{ $pic_nik ? '(' . $pic_nik . ')' : '' }}
            </button>
            <ul class="dropdown-menu overflow-auto" aria-labelledby="dropdown-pic" style="max-height: 280px;">
                @livewire('dropdown-search', ['parameter' => 'pic'])
            </ul>
        </div>
    </div>
</div>
