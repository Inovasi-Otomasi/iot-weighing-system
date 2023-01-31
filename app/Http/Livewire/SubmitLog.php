<?php

namespace App\Http\Livewire;

use App\Models\Historical;
use App\Models\Hmi;
use App\Models\Line;
use App\Models\Machine;
use App\Models\Shift;
use App\Models\Sku;
use Livewire\Component;

class SubmitLog extends Component
{
    public $line;
    public $shift;
    public $sku;
    public $machine;
    public $user;
    public $hmi;
    public $pic;

    public $sent_weight;
    public $sent_color;
    public $sent_text;
    public $toggleSuccess;

    protected $queryString = ['sku', 'line', 'shift', 'machine', 'user', 'hmi', 'pic'];
    protected $listeners = ['updateSku', 'updateLine', 'updateShift', 'updateMachine', 'updateUser', 'updateHmi', 'updateMachine', 'updateUser', 'updatePic', 'updateSkuSelection', 'updatePicSelection'];

    public function mount()
    {
        $this->sent_weight = 0;
        $this->sent_color = 'danger';
        $this->sent_text = 'FAILED';
    }
    public function updateSku($arg)
    {
        $this->sku = $arg;
    }
    public function updateLine($arg)
    {
        $this->line = $arg;
    }
    public function updateShift($arg)
    {
        $this->shift = $arg;
    }
    public function updateMachine($arg)
    {
        $this->machine = $arg;
    }
    public function updateUser($arg)
    {
        $this->user = $arg;
    }
    public function updatePic($arg)
    {
        $this->pic = $arg;
    }
    public function updateHmi($arg)
    {
        $this->hmi = $arg;
        $hmi = Hmi::where('id', $this->hmi)->first();
        $this->sku = $hmi->sku_id;
        $this->machine = $hmi->machine_id;
        $this->user = $hmi->user;
        $this->pic = $hmi->pic_id;
    }

    public function updateSkuSelection($arg)
    {
        $this->sku = $arg;
    }
    public function updateMachineSelection($arg)
    {
        $this->machine = $arg;
    }
    public function updateUserSelection($arg)
    {
        $this->user = $arg;
    }
    public function updatePicSelection($arg)
    {
        $this->pic = $arg;
    }

    public function sendLog()
    {
        if ($this->sku && $this->machine && $this->user && $this->hmi && $this->pic) {
            $status = 'UNDER';
            // $sku = Sku::where('id', $this->sku)->first();
            $hmi = Hmi::where('id', $this->hmi)->first();
            if ($hmi->weight <= $hmi->hmi_th) {
                session()->flash('failedMsg', 'Failed to submit. (Lower than HMI threshold)');
                return;
            }
            // $line = Line::where('id', $this->line)->first();
            // $shift = Shift::where('id', $this->shift)->first();
            // $machine = Machine::where('id', $this->machine)->first();
            $sku = $hmi->sku;
            $line = $hmi->line;
            $shift = $hmi->shift;
            $machine = $hmi->machine;
            $pic = $hmi->pic;
            $user = $hmi->user;
            if ($hmi->weight <= $sku->th_L) {
                $status = 'UNDER';
            } elseif ($hmi->weight >= $sku->th_H) {
                $status = 'OVER';
            } else {
                $status = 'PASS';
            }
            $data = [
                'line_name' => $line->line_name,
                'sku_name' => $sku->sku_name,
                'machine_name' => $machine->machine_name,
                'shift_name' => $shift ? $shift->shift_name : NULL,
                'shift_group' => $shift ? $shift->shift_group : NULL,
                'shift_start' => $shift ? $shift->shift_start : NULL,
                'shift_end' => $shift ? $shift->shift_end : NULL,
                'hmi_name' => $hmi->hmi_name,
                'user' => $user,
                'pic' => $pic->pic_name,
                'nik' => $pic->nik,
                'weight' => round($hmi->weight, 3),
                'target' => $sku->target,
                'th_H' => $sku->th_H,
                'th_L' => $sku->th_L,
                'status' => $status,
                'working_date' => now()->subHours(7)
            ];


            $affected_row =  Historical::Create($data);
            // dd($affected_row);
            if ($affected_row) {
                $this->emit('sendLog');
                // $this->sent_weight = $data['weight'];
                // $this->sent_color = 'success';
                // $this->sent_text = 'SUCCESS';
                session()->flash('successMsg', 'Data submitted (Weight : ' . $data['weight'] . ').');
            } else {
                session()->flash('failedMsg', 'Failed to submit.');
                // $this->sent_weight = 0;
                // $this->sent_color = 'danger';
                // $this->sent_text = 'FAILED';
            }
        } else {
            // $this->sent_weight = 0;
            // $this->sent_color = 'danger';
            // $this->sent_text = 'FAILED';
            session()->flash('failedMsg', 'Failed to submit.');
        }
    }
    public function render()
    {
        return view('livewire.submit-log');
    }
}
