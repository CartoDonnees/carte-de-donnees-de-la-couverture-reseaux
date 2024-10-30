<?php

namespace App\Http\Livewire\Modal;

use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class Error extends ModalComponent
{
    public function render()
    {
        return view('livewire.modal.error');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm'
        // 'md'
        // 'lg'
        // 'xl'
        // '2xl'
        // '3xl'
        // '4xl'
        // '5xl'
        // '6xl'
        // '7xl'
        return '4xl';
    }
}
