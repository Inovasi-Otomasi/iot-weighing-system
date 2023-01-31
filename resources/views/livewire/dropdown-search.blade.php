@if ($parameter == 'sku')
    <div>
        <li class="mb-1"><input wire:model="sku_search" type="text" class="form-control">
        </li>
        @foreach ($sku_list as $sku_row)
            <li wire:click="updateSku('{{ $sku_row->id }}')"><span class="dropdown-item">{{ $sku_row->sku_name }}</span>
            </li>
        @endforeach
    </div>
@elseif ($parameter == 'line')
    <div>
        <li class="mb-1"><input wire:model="line_search" type="text" class="form-control">
        </li>
        @foreach ($lines as $line_row)
            <li wire:click="updateLine('{{ $line_row->id }}')"><span
                    class="dropdown-item">{{ $line_row->line_name }}</span>
            </li>
        @endforeach
    </div>
@elseif ($parameter == 'shift')
    <div>
        <li class="mb-1"><input wire:model="shift_search" type="text" class="form-control">
        </li>
        @foreach ($shifts as $shift_row)
            <li wire:click="updateShift('{{ $shift_row->id }}')"><span
                    class="dropdown-item">{{ $shift_row->shift_name }} ({{ $shift_row->shift_group }})</span>
            </li>
        @endforeach
    </div>
@elseif ($parameter == 'hmi')
    <div>
        <li class="mb-1"><input wire:model="hmi_search" type="text" class="form-control">
        </li>
        @foreach ($hmi_list as $hmi_row)
            <li wire:click="updateHmi('{{ $hmi_row->id }}')"><span
                    class="dropdown-item">{{ $hmi_row->hmi_name }}</span>
            </li>
        @endforeach
    </div>
@elseif ($parameter == 'pic')
    <div>
        <li class="mb-1"><input wire:model="pic_search" type="text" class="form-control">
        </li>
        @foreach ($pic_list as $pic_row)
            <li wire:click="updatePic('{{ $pic_row->id }}')"><span class="dropdown-item">{{ $pic_row->pic_name }}
                    ({{ $pic_row->nik }})</span>
            </li>
        @endforeach
    </div>
@endif
