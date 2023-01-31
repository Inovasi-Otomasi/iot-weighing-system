<?php

namespace App\Http\Livewire;

use App\Models\Machine;
use App\Models\Sku;
use Livewire\Component;

class Passing extends Component
{
    public $request;

    public function mount($request)
    {
        $this->request = $request;
    }
    public function render()
    {
        $result = [
            'status' => 'UNDER',
            'color' => 'danger'
        ];
        if (isset($this->request['sku']) && isset($this->request['machine'])) {
            $sku = Sku::where('id', $this->request['sku'])->first();
            $machine = Machine::where('id', $this->request['machine'])->first();
            $result['color'] = $machine->weight <= $sku->th_L || $machine->weight >= $sku->th_H ? 'danger' : 'success';
            if ($machine->weight <= $sku->th_L) {
                $result['status'] = 'UNDER';
            } elseif ($machine->weight >= $sku->th_H) {
                $result['status'] = 'OVER';
            } else {
                $result['status'] = 'PASS';
            }
        }

        return view('livewire.passing', ['result' => $result]);
    }
}
