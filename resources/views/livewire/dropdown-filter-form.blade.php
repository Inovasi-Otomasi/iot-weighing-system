    <div>
        <form action="/">
            <div class="btn-group flex-wrap mt-3">
                <div class="dropdown me-3 mb-2">
                    <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-line"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Line : {{ $line ?: 'All' }}
                    </button>
                    <input type="text" value="{{ $line }}" name="line" hidden>
                    <ul class="dropdown-menu {{ $line_search ? 'show' : '' }}" aria-labelledby="dropdown-line">
                        <li class="mb-1"><input wire:model="line_search" type="text" class="form-control">
                        </li>
                        <div class="overflow-auto" style="max-height: 280px;">
                            <li><span class="dropdown-item" wire:click="filterLine('')">All</span></li>
                            @foreach ($line_list as $line_row)
                                <li><span class="dropdown-item"
                                        wire:click="filterLine('{{ $line_row->line_name }}')">{{ $line_row->line_name }}</span>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
                <div class="dropdown me-3 mb-2">
                    <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-hmi"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        HMI : {{ $hmi ?: 'All' }}
                    </button>
                    <input type="text" value="{{ $hmi }}" name="hmi" hidden>
                    <ul class="dropdown-menu {{ $hmi_search ? 'show' : '' }}" aria-labelledby="dropdown-line">
                        <li class="mb-1"><input wire:model="hmi_search" type="text" class="form-control">
                        </li>
                        <div class="overflow-auto" style="max-height: 280px;">
                            <li><span class="dropdown-item" wire:click="filterHmi('')">All</span></li>
                            @foreach ($hmi_list as $hmi_row)
                                <li><span class="dropdown-item"
                                        wire:click="filterHmi('{{ $hmi_row->hmi_name }}')">{{ $hmi_row->hmi_name }}</span>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
                <div class="dropdown me-3 mb-2">
                    <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-machine"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Machine : {{ $machine ?: 'All' }}
                    </button>
                    <input type="text" value="{{ $machine }}" name="machine" hidden>
                    <ul class="dropdown-menu {{ $machine_search ? 'show' : '' }}" aria-labelledby="dropdown-machine">
                        <li class="mb-1"><input wire:model="machine_search" type="text" class="form-control">
                        </li>
                        <div class="overflow-auto" style="max-height: 280px;">
                            <li><span class="dropdown-item" wire:click="filterMachine('')">All</span></li>
                            @foreach ($machine_list as $machine_row)
                                <li><span class="dropdown-item"
                                        wire:click="filterMachine('{{ $machine_row->machine_name }}')">{{ $machine_row->machine_name }}</span>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
                <div class="dropdown me-3 mb-2">
                    <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-sku"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        SKU : {{ $sku ?: 'All' }}
                    </button>
                    <input type="text" value="{{ $sku }}" name="sku" hidden>
                    <ul class="dropdown-menu {{ $sku_search ? 'show' : '' }}" aria-labelledby="dropdown-sku">
                        <li class="mb-1"><input wire:model="sku_search" type="text" class="form-control">
                        </li>
                        <div class="overflow-auto" style="max-height: 280px;">
                            <li><span class="dropdown-item" wire:click="filterSku('')">All</span></li>
                            @foreach ($sku_list as $sku_row)
                                <li><span class="dropdown-item"
                                        wire:click="filterSku('{{ $sku_row->sku_name }}')">{{ $sku_row->sku_name }}</span>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
                <div class="dropdown me-3 mb-2">
                    <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-shift"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Shift :
                        {{ $shift ? $shift : 'All' }}
                    </button>
                    <input type="text" value="{{ $shift }}" name="shift" hidden>
                    <ul class="dropdown-menu {{ $shift_search ? 'show' : '' }}" aria-labelledby="dropdown-shift">
                        <li class="mb-1"><input wire:model="shift_search" type="text" class="form-control">
                        </li>
                        <div class="overflow-auto" style="max-height: 280px;">
                            <li><span class="dropdown-item" wire:click="filterShift('')">All</span></li>
                            @foreach ($shift_list as $shift_row)
                                <li><span class="dropdown-item"
                                        wire:click="filterShift('{{ $shift_row->shift_name }}')">{{ $shift_row->shift_name }}</span>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
                <div class="dropdown me-3 mb-2">
                    <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-group"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Group :
                        {{ $group ? $group : 'All' }}
                    </button>
                    <input type="text" value="{{ $group }}" name="group" hidden>
                    <ul class="dropdown-menu {{ $group_search ? 'show' : '' }}" aria-labelledby="dropdown-group">
                        <li class="mb-1"><input wire:model="group_search" type="text" class="form-control">
                        </li>
                        <div class="overflow-auto" style="max-height: 280px;">
                            <li><span class="dropdown-item" wire:click="filterGroup('')">All</span></li>
                            @foreach ($group_list as $group_row)
                                <li><span class="dropdown-item"
                                        wire:click="filterGroup('{{ $group_row->shift_group }}')">{{ $group_row->shift_group }}</span>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
                <div class="dropdown me-3 mb-2">
                    <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-user"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        User :
                        {{ $user ? $user : 'All' }}
                    </button>
                    <input type="text" value="{{ $user }}" name="user" hidden>
                    <ul class="dropdown-menu {{ $user_search ? 'show' : '' }}" aria-labelledby="dropdown-user">
                        <li class="mb-1"><input wire:model="user_search" type="text" class="form-control">
                        </li>
                        <div class="overflow-auto" style="max-height: 280px;">
                            <li><span class="dropdown-item" wire:click="filterUser('')">All</span></li>
                            @foreach ($user_list as $user_row)
                                <li><span class="dropdown-item"
                                        wire:click="filterUser('{{ $user_row->user }}')">{{ $user_row->user }}</span>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
                <div class="dropdown me-3 mb-2">
                    <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-pic"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        PIC :
                        {{ $pic ? $pic : 'All' }} {{ $nik ? '(' . $nik . ')' : '' }}
                    </button>
                    <input type="text" value="{{ $pic }}" name="pic" hidden>
                    <input type="text" value="{{ $nik }}" name="nik" hidden>
                    <ul class="dropdown-menu {{ $pic_search ? 'show' : '' }}" aria-labelledby="dropdown-pic">
                        <li class="mb-1"><input wire:model="pic_search" type="text" class="form-control">
                        </li>
                        <div class="overflow-auto" style="max-height: 280px;">
                            <li><span class="dropdown-item" wire:click="filterPic('','')">All</span></li>
                            @foreach ($pic_list as $pic_row)
                                <li><span class="dropdown-item"
                                        wire:click="filterPic('{{ $pic_row->pic }}','{{ $pic_row->nik }}')">{{ $pic_row->pic }}
                                        ({{ $pic_row->nik }})
                                    </span>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
                {{-- <div class="dropdown me-3 mb-2">
                <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-nik"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    NIK :
                    {{ $nik ? $nik : 'All' }}
                </button>
                <input type="text" value="{{ $nik }}" name="nik" hidden>
                <ul class="dropdown-menu overflow-auto {{ $nik_search ? 'show' : '' }}"
                    aria-labelledby="dropdown-nik" style="max-height: 280px;">
                    <li class="mb-1"><input wire:model="nik_search" type="text" class="form-control">
                    </li>
                    <li><span class="dropdown-item" wire:click="filterNik('')">All</span></li>
                    @foreach ($nik_list as $nik_row)
                        <li><span class="dropdown-item"
                                wire:click="filterNik('{{ $nik_row->nik }}')">{{ $nik_row->nik }}</span>
                        </li>
                    @endforeach
                </ul>
            </div> --}}
                <div class="dropdown me-3 mb-2">
                    <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-date"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Working Date :
                        {{ $working_date ? $working_date : 'All' }}
                    </button>
                    <input type="text" value="{{ $working_date }}" name="working_date" hidden>
                    <ul class="dropdown-menu {{ $working_date_search ? 'show' : '' }}"
                        aria-labelledby="dropdown-date">
                        <li class="mb-1"><input wire:model="working_date_search" type="text"
                                class="form-control">
                        </li>
                        <div class="overflow-auto" style="max-height: 280px;">
                            <li><span class="dropdown-item" wire:click="filterWorkingDate('')">All</span></li>
                            @foreach ($working_date_list as $working_date_row)
                                <li><span class="dropdown-item"
                                        wire:click="filterWorkingDate('{{ $working_date_row->working_date }}')">{{ $working_date_row->working_date }}</span>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
                <div class="dropdown me-3 mb-2">
                    <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-range"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Range :
                        {{ $from && $to ? date('Y-m-d H:i:s', $from) . ' to ' . date('Y-m-d H:i:s', $to) : ($range ? 'Last ' . $range . ' Day(s)' : 'Last 1 Day') }}
                    </button>
                    <input type="number" name="from" id="from" value="{{ $from }}" hidden>
                    <input type="number" name="to" id="to" value="{{ $to }}" hidden>
                    <input type="text" value="{{ $range }}" name="range" id="range" hidden>
                    <ul class="dropdown-menu overflow-auto " aria-labelledby="dropdown-range"
                        style="max-height: 280px;">
                        <div class="mx-4 my-2">
                            <div id="datetimerange"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                        <li><span class="dropdown-item" wire:click="filterRange('1')">Last 1 Day</span></li>
                        <li><span class="dropdown-item" wire:click="filterRange('7')">Last 7 Day(s)</span></li>
                        <li><span class="dropdown-item" wire:click="filterRange('30')">Last 30 Day(s)</span></li>
                        <li><span class="dropdown-item" wire:click="filterRange('90')">Last 90 Day(s)</span></li>
                    </ul>
                </div>
            </div>
            <div class="btn-group flex-wrap mt-3">
                <div class="form-group me-3 mb-2">
                    <div class="input-group">
                        <span class="input-group-text" id="lowFilter">Low</span>
                        <input wire:model="low" type="number" step="any" class="form-control" name="low"
                            aria-describedby="lowFilter">
                    </div>
                </div>
                <div class="form-group me-3 mb-2">
                    <div class="input-group">
                        <span class="input-group-text" id="highFilter">High</span>
                        <input wire:model="high" type="number" step="any" class="form-control" name="high"
                            aria-describedby="highFilter">
                    </div>
                </div>
                <div class="form-group me-3 mb-2">
                    <div class="input-group">
                        <span class="input-group-text" id="qcField">QC Field</span>
                        <input wire:model="qc_field" type="text" class="form-control" name="qc_field"
                            aria-describedby="qcField">
                    </div>
                </div>
                <div class="form-group me-3 mb-2">
                    <div class="input-group">
                        <span class="input-group-text" id="qcHead">QC Unit Head</span>
                        <input wire:model="qc_head" type="text" class="form-control" name="qc_head"
                            aria-describedby="qcHead">
                    </div>
                </div>
                <div class="dropdown me-3 mb-2">
                    <button class="btn btn-iot mb-0"type="submit">
                        <span class="btn-inner--text">Apply</span>
                    </button>
                </div>
                <div>
                    <button class="btn btn-outline-success mb-0 " type="button"
                        onclick="window.open('{{ route('export', request()->all()) }}','_blank')">
                        <span class="btn-inner--icon">
                            <i class="text-success fa-solid fa-file-excel"></i>
                        </span>
                        <span class="btn-inner--text">Export</span>
                    </button>
                </div>
            </div>

        </form>

        {{-- <div class="dropdown me-3 mb-2">
        <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-sku" data-bs-toggle="dropdown"
            aria-expanded="false">
            SKU : All
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdown-sku">
            <li><a class="dropdown-item" href="">All</a></li>
        </ul>
    </div> --}}
    </div>
