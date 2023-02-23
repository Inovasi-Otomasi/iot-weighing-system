<?php

namespace App\Http\Livewire;

use App\Models\Historical;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DropdownFilterForm extends Component
{
    public $sku;
    public $sku_search;
    public $line;
    public $line_search;
    public $shift;
    public $shift_search;
    public $group;
    public $group_search;
    public $hmi;
    public $hmi_search;
    public $machine;
    public $machine_search;
    public $range;
    public $user;
    public $user_search;
    public $pic;
    public $pic_search;
    public $working_date;
    public $working_date_search;
    public $nik;
    // public $nik_search;
    public $from;
    public $to;
    public $low;
    public $high;
    public $qc_field;
    public $qc_head;

    protected $queryString = ['line', 'shift', 'sku', 'group', 'hmi', 'machine', 'user', 'range', 'pic', 'nik', 'from', 'to', 'low', 'high', 'qc_field', 'qc_head', 'working_date'];

    public function filterSku($arg)
    {
        $this->sku = $arg;
        $this->reset('sku_search');
    }
    public function filterLine($arg)
    {
        $this->line = $arg;
        $this->reset('line_search');
    }
    public function filterHmi($arg)
    {
        $this->hmi = $arg;
        $this->reset('hmi_search');
    }
    public function filterShift($arg1)
    {
        $this->shift = $arg1;
        $this->reset('shift_search');
    }
    public function filterGroup($arg1)
    {
        $this->group = $arg1;
        $this->reset('group_search');
    }
    public function filterRange($arg1)
    {
        $this->range = $arg1;
        $this->from = null;
        $this->to = null;
    }
    public function filterMachine($arg1)
    {
        $this->machine = $arg1;
        $this->reset('machine_search');
    }
    public function filterUser($arg1)
    {
        $this->user = $arg1;
        $this->reset('user_search');
    }
    public function filterPic($arg1, $arg2)
    {
        $this->pic = $arg1;
        $this->nik = $arg2;
        $this->reset('pic_search');
    }
    public function filterWorkingDate($arg1)
    {
        $this->working_date = $arg1;
        $this->reset('working_date_search');
    }
    // public function filterNik($arg1)
    // {
    //     $this->nik = $arg1;
    //     $this->reset('nik_search');
    // }

    public function render()
    {
        $data = [
            'sku_list' => DB::table('historical_log')->select('sku_name')->distinct()->where('sku_name', 'like', '%' . $this->sku_search . '%')->orderBy('sku_name')->get(),
            'line_list' => DB::table('historical_log')->select('line_name')->distinct()->where('line_name', 'like', '%' . $this->line_search . '%')->orderBy('line_name')->get(),
            'hmi_list' => DB::table('historical_log')->select('hmi_name')->distinct()->where('hmi_name', 'like', '%' . $this->hmi_search . '%')->orderBy('hmi_name')->get(),
            'machine_list' => DB::table('historical_log')->select('machine_name')->distinct()->where('machine_name', 'like', '%' . $this->machine_search . '%')->orderBy('machine_name')->get(),
            'shift_list' => DB::table('historical_log')->select('shift_name')->distinct()->where('shift_name', 'like', '%' . $this->shift_search . '%')->orderBy('shift_name')->get(),
            'group_list' => DB::table('historical_log')->select('shift_group')->distinct()->where('shift_group', 'like', '%' . $this->group_search . '%')->orderBy('shift_group')->get(),
            'user_list' => DB::table('historical_log')->select('user')->distinct()->where('user', 'like', '%' . $this->user_search . '%')->orderBy('pic')->get(),
            'pic_list' => DB::table('historical_log')->select('nik', 'pic')->distinct()->where('pic', 'like', '%' . $this->pic_search . '%')->orWhere('nik', 'like', '%' . $this->pic_search . '%')->get(),
            'working_date_list' => DB::table('historical_log')->select('working_date')->distinct()->where('working_date', 'like', '%' . $this->working_date_search . '%')->orderByDesc('working_date')->get(),
            // 'nik_list' => DB::table('historical_log')->select('nik')->distinct()->where('nik', 'like', '%' . $this->nik_search . '%')->get(),
        ];
        return view('livewire.dropdown-filter-form', $data);
    }
}
