<?php

namespace App\Http\Livewire;

use App\Models\Machine;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ActualWeight extends Component
{
    public $request;
    public $machine;
    protected $listeners = ['updateMachine'];
    protected $queryString = ['machine'];

    // public function mount($request)
    // {
    // dd($request);
    // $this->machine = $request['machine'];
    // }
    public function updateMachine($test)
    {
        $this->machine = $test;
    }
    public function render()
    {
        // dd($this->request);
        $result = 'Check machine';
        if (isset($this->machine)) {
            $result = Machine::where('id', $this->machine)->first()->weight;
        }

        return view('livewire.actual-weight', ['result' => $result]);
    }
}
