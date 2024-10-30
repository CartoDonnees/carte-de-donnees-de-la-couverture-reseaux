<?php

namespace App\Http\Livewire\Modal;

use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Newsletter;
use App\Models\Answer;

class ShowNewsletter extends ModalComponent
{
    public $news;
    public $selected;
    public $s_new;
    public $answ;
    public $success;
    public $search;
    public $shw_all_answ = false; 

    public function mount()
    {
        $this->news = Newsletter::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.modal.show-newsletter', [
            'results_news' => $this->search != null && $this->search != "" ? Newsletter::where('title', 'like', '%' . $this->search . '%')->get() : $this->news,
        ]);
    }

    public function selectNews($id)
    {
        $this->s_new = Newsletter::find($id);
        $this->selected = true;
    }

    
    public function like($id)
    {
        $neww = Newsletter::find($id);
        $neww->likes = $neww->likes+1;
        $neww->save();

    }

    
    public function submitAnswer($id)
    {
        if($this->answ != null)
        {
            Answer::create([
                'comment_id' => $id,
                'types' => "newsletter",
                'from_id' => Auth::user()->id,
                'answer' => $this->answ,
            ]);

            $this->news = Newsletter::orderBy('created_at', 'desc')->get();
            $this->success = true;
        }
    }

    public function rangeByDate()
    {
        $this->news = Newsletter::orderBy('created_at', 'desc')->get();
    }

    
    public function rangeByLike()
    {
        $this->news = Newsletter::orderBy('likes', 'desc')->get();
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
        return '6xl';
    }
}
