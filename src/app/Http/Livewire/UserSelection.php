<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserSelection extends Component
{
    public $user;

    protected $queryString = ['user'];
    protected $listeners = ['updateUserSelection'];

    public function updateUser($user)
    {
        $this->user = $user;
        $this->emit('updateUser', $this->user);
    }
    public function updateUserSelection($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user-selection');
    }
}
