<?php

namespace App\Http\Livewire;

use App\Models\Hmi;
use Livewire\Component;

class HmiSelection extends Component
{
    public $hmi;

    protected $queryString = ['hmi'];

    public function updateHmi($hmi)
    {
        $this->hmi = $hmi;
        $this->emit('updateHmi', $hmi);
    }

    public function render()
    {
        $data = [
            'machines' => Hmi::all()
        ];
        return view('livewire.hmi-selection', $data);
    }
}
