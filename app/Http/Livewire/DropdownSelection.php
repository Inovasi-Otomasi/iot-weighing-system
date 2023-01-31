<?php

namespace App\Http\Livewire;

use App\Models\Hmi;
use App\Models\Line;
use App\Models\Machine;
use App\Models\Pic;
use App\Models\Shift;
use App\Models\Sku;
use Livewire\Component;

class DropdownSelection extends Component
{
    public $line;
    public $line_name;
    public $line_search;
    public $shift;
    public $shift_name;
    public $shift_search;
    public $sku;
    public $sku_name;
    public $sku_search;
    public $hmi;
    public $hmi_name;
    public $hmi_search;
    public $pic;
    public $pic_name;
    public $pic_nik;
    public $pic_search;
    public $machine;
    public $user;
    protected $listeners = ['updateSku', 'updateLine', 'updateShift', 'updateHmi', 'updateMachine', 'updateUser', 'updatePic'];
    protected $queryString = ['line', 'shift', 'sku', 'hmi', 'machine', 'user', 'pic'];
    public function mount()
    {
        if ($this->line) {
            $this->line_name = Line::where('id', $this->line)->first()->line_name;
        }
        if ($this->shift) {
            $this->shift_name = Shift::where('id', $this->shift)->first()->shift_name;
        }
        if ($this->sku) {
            $this->sku_name = Sku::where('id', $this->sku)->first()->sku_name;
        }
        if ($this->hmi) {
            $this->hmi_name = Hmi::where('id', $this->hmi)->first()->hmi_name;
        }
        if ($this->pic) {
            $this->pic_name = Pic::where('id', $this->pic)->first()->pic_name;
            $this->pic_nik = Pic::where('id', $this->pic)->first()->nik;
        }
    }
    // public function updateLine($arg)
    // {
    //     $this->line = $arg;
    //     $this->line_name = Line::where('id', $this->line)->first()->line_name;
    // }
    // public function updateShift($arg)
    // {
    //     // ddd($arg);
    //     $this->shift = $arg;
    //     $this->shift_name = Shift::where('id', $this->shift)->first()->shift_name;
    // }
    public function updateSku($arg)
    {
        // ddd($arg);
        $this->sku = $arg;
        $this->sku_name = Sku::where('id', $this->sku)->first()->sku_name;
        $data = [
            'sku_id' => $this->sku
        ];
        Hmi::where('id', $this->hmi)->update($data);
    }
    public function updateMachine($arg)
    {
        $this->machine = $arg;
        $data = [
            'machine_id' => $this->machine
        ];
        Hmi::where('id', $this->hmi)->update($data);
    }
    public function updateUser($arg)
    {
        $this->user = $arg;
        $data = [
            'user' => $this->user
        ];
        Hmi::where('id', $this->hmi)->update($data);
    }
    public function updatePic($arg)
    {
        $this->pic = $arg;
        $this->pic_name = Pic::where('id', $this->pic)->first()->pic_name;
        $this->pic_nik = Pic::where('id', $this->pic)->first()->nik;
        $data = [
            'pic_id' => $this->pic
        ];
        Hmi::where('id', $this->hmi)->update($data);
    }
    public function updateHmi($arg)
    {
        // ddd($arg);
        $this->hmi = $arg;
        $this->emit('updateHmiSelection', $this->hmi);
        $hmi = Hmi::where('id', $this->hmi)->first();
        $this->hmi_name = $hmi->hmi_name;
        $this->sku = $hmi->sku_id;
        $this->sku_name = Sku::where('id', $this->sku)->first() ? Sku::where('id', $this->sku)->first()->sku_name : '';
        $this->emit('updateSkuSelection', $this->sku);
        $this->machine = $hmi->machine_id;
        $this->emit('updateMachineSelection', $this->machine);
        $this->user = $hmi->user;
        $this->emit('updateUserSelection', $this->user);
        $this->pic = $hmi->pic_id;
        $this->pic_name = Pic::where('id', $this->pic)->first() ? Pic::where('id', $this->pic)->first()->pic_name : '';
        $this->pic_nik = Pic::where('id', $this->pic)->first() ? Pic::where('id', $this->pic)->first()->nik : '';
        $this->emit('updatePicSelection', $this->pic);
    }
    public function render()
    {
        // $data = [
        //     'lines' => Line::where('line_name', 'like', '%' . $this->line_search . '%')->get(),
        //     'shift' => Shift::where('shift_name', 'like', '%' . $this->shift_search . '%')->get(),
        //     'sku_list' => Sku::where('sku_name', 'like', '%' . $this->sku_search . '%')->get()
        // ];
        return view('livewire.dropdown-selection');
    }
}
