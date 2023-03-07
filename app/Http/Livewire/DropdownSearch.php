<?php

namespace App\Http\Livewire;

use App\Models\Hmi;
use App\Models\Line;
use App\Models\Pic;
use App\Models\Shift;
use App\Models\Sku;
use Livewire\Component;

class DropdownSearch extends Component
{

    public $line;
    public $line_search;
    public $shift;
    public $shift_search;
    public $sku;
    public $sku_search;
    public $hmi;
    public $hmi_search;
    public $pic;
    public $pic_search;
    public $parameter;

    protected $queryString = ['sku', 'line', 'shift', 'hmi', 'pic'];
    protected $listeners = ['updateHmiSelection'];
    public function updateSku($arg)
    {
        $this->sku = $arg;
        $sku = Sku::where('id', $this->sku)->first() ? Sku::where('id', $this->sku)->first() : '';
        $this->emit('updateSkuAJAX', $sku);
        $this->emit('updateSku', $this->sku);
    }
    public function updateLine($arg)
    {
        $this->line = $arg;
        $this->emit('updateLine', $this->line);
    }
    public function updateShift($arg)
    {
        $this->shift = $arg;
        $this->emit('updateShift', $this->shift);
    }
    public function updateHmi($arg)
    {
        $this->hmi = $arg;
        $this->emit('updateHmi', $this->hmi);
    }
    public function updatePic($arg)
    {
        $this->pic = $arg;
        $this->emit('updatePic', $this->pic);
    }
    public function updateHmiSelection($arg)
    {
        $this->hmi = $arg;
    }
    // public function updateHmiSelection($arg)
    // {
    //     $this->hmi = $arg;
    // }
    public function render()
    {
        $hmi = Hmi::where('id', $this->hmi)->first();
        // dd(Sku::where('line_id', $hmi->line_id)->where('sku_name', 'like', '%' . $this->sku_search . '%')->get());
        $data = [
            'lines' => Line::where('line_name', 'like', '%' . $this->line_search . '%')->get(),
            'shifts' => Shift::where('shift_name', 'like', '%' . $this->shift_search . '%')->orWhere('shift_group', 'like', '%' . $this->shift_search . '%')->get(),
            'sku_list' => $hmi ? Sku::where('line_id', $hmi->line_id)->where('sku_name', 'like', '%' . $this->sku_search . '%')->get() : [],
            'hmi_list' =>  Hmi::where('hmi_name', 'like', '%' . $this->hmi_search . '%')->get(),
            'pic_list' => Pic::where('pic_name', 'like', '%' . $this->pic_search . '%')->orWhere('nik', 'like', '%' . $this->pic_search . '%')->get()
        ];
        return view('livewire.dropdown-search', $data);
    }
}
