<?php

namespace App\Http\Livewire;

use App\Models\Pic;
use Livewire\Component;

class PicSelection extends Component
{
    public $pic;

    protected $queryString = ['pic'];
    protected $listeners = ['updatePicSelection'];

    public function updatepic($pic)
    {
        $this->pic = $pic;
        $this->emit('updatePic', $this->pic);
    }
    public function updatePicSelection($pic)
    {
        $this->pic = $pic;
    }
    public function render()
    {
        $data = [
            'pic_list' => Pic::all()
        ];
        return view('livewire.pic-selection', $data);
    }
}
