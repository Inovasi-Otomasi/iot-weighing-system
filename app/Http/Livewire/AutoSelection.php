<?php

namespace App\Http\Livewire;

use App\Models\Hmi;
use Livewire\Component;

class AutoSelection extends Component
{
    public $hmi;
    public $auto;
    protected $queryString = ['hmi'];
    protected $listeners = ['updateHmi'];
    // public
    public function mount()
    {
        if ($this->hmi) {
            $this->auto = Hmi::where('id', $this->hmi)->get()->first()->auto;
        }
    }
    public function updateHmi($arg)
    {
        $this->hmi = $arg;
        $this->auto = Hmi::where('id', $this->hmi)->get()->first()->auto;
    }
    public function updating($field, $value)
    {
        // ddd($value);
        if ($field == 'auto') {
            Hmi::where('id', $this->hmi)->update(['auto' => $value]);
        }
        // $this->model->setAttribute($this->field, $value)->save();

    }
    public function render()
    {
        return view('livewire.auto-selection');
    }
}
