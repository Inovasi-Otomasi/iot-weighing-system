<?php

namespace App\Http\Livewire;

use App\Models\Machine;
use App\Models\Sku;
use Livewire\Component;

class PercentageWeight extends Component
{
    public $request;


    public function mount($request)
    {
        $this->request = $request;
    }
    public function render()
    {
        $result = [
            'percentage' => 0,
            'target' => 0,
            'arrow' => 'down',
            'color' => 'danger'
        ];
        if (isset($this->request['sku']) && isset($this->request['machine'])) {
            $sku = Sku::where('id', $this->request['sku'])->first();
            $machine = Machine::where('id', $this->request['machine'])->first();
            $result['target'] = $sku->target;
            $result['percentage'] = ($machine->weight * 100 / $result['target']) - 100;
            $result['arrow'] = $result['percentage'] < 0 ? 'down' : 'up';
            $result['color'] = $machine->weight <= $sku->th_L || $machine->weight >= $sku->th_H ? 'danger' : 'success';
        }

        return view('livewire.percentage-weight', ['result' => $result]);
    }
}
