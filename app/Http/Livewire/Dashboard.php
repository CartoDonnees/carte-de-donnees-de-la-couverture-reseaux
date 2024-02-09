<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{

    public $Localite = 'false';

    public function render()
    {
        return view('livewire.dashboard');
    }
}
