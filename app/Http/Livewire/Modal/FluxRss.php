<?php

namespace App\Http\Livewire\Modal;

use LivewireUI\Modal\ModalComponent;
use App\Models\Comment as Com;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FluxRss extends ModalComponent
{
    public $news;
    public $selected;
    public $s_new;
    public $answ;
    public $success;
    public $search;
    public $shw_all_answ = false; 

    public function render()
    {
        return view('livewire.modal.flux-rss',[
            'results_news' => $this->news
        ]);
    }
    public function mount()
    {
        $this->news =  DB::table('memoire_tampon')
        ->where('statut', 1)
        ->latest()
            ->select('localite', 'operateur', 'technologie', 'couverture', 'updated_at')
            ->get();
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
}
