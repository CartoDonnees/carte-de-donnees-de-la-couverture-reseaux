<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\Comment as Com;
use Illuminate\Support\Facades\Auth;

class EditUser extends ModalComponent
{
    public $test;
    
    public $comment;
    public $comments;
    public $my_comments;
    public $success;
    public $shwR;

    public function mount()
    {
        $this->comments = Com::orderBy('created_at', 'desc')->get();
        if(Auth::user() != null)
        {
            $this->my_comments = Com::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }
        else{
            $this->my_comments = [];
        }
    }



    public function render()
    {
        return view('livewire.edit-user');
    }

    public function test(){
        $this->test = true;
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
        return '7xl';
    }

    public function closeMo(){
        $this->emit("closeModal");
    }
}
