<?php

namespace App\Http\Livewire;

use App\Models\Hmi;
use App\Models\Machine;
use Livewire\Component;

class MachineSelection extends Component
{
    public $machine;
    public $machine_name;
    public $hmi;

    protected $queryString = ['machine', 'hmi'];
    protected $listeners = ['updateMachineSelection', 'updateHmiSelection'];
    public function mount()
    {
        if ($this->hmi) {
            $this->machine_name = Machine::where('id', $this->machine)->get()->first() ? Machine::where('id', $this->machine)->get()->first()->machine_name : null;
        }
    }
    public function updateMachine($machine)
    {
        $this->machine = $machine;
        $this->machine_name = Machine::where('id', $this->machine)->get()->first()->machine_name;
        $this->emit('updateMachine', $machine);
    }
    public function updateMachineSelection($machine)
    {
        if ($machine) {
            $this->machine = $machine;
            $this->machine_name = Machine::where('id', $this->machine)->get()->first()->machine_name;
        }
    }
    public function updateHmiSelection($arg)
    {
        $this->hmi = $arg;
    }

    public function render()
    {
        $data = ['machines' => []];
        if ($this->hmi) {
            $hmi = Hmi::where('id', $this->hmi)->first();
            $data = [
                'machines' => Machine::where('line_id', $hmi->line_id)->get()
            ];
        }

        return view('livewire.machine-selection', $data);
    }
}
