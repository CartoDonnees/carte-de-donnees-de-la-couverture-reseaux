<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public $couv_loc =true;


    public function render()
    {
        return view('livewire.sidebar');
    }

    public function showCouv()
    {
        dd('ok');
        if($this->couv_loc == true)
        {
            $this->couv_loc =  false;
        }
    }
}
