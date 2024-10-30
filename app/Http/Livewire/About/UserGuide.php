<?php

namespace App\Http\Livewire\About;

use Livewire\Component;

class UserGuide extends Component
{
    public function render()
    {
        return view('livewire.about.user-guide')->layout('layouts.guest');
    }
}
