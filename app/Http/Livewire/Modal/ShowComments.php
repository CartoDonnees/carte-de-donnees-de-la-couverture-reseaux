<?php

namespace App\Http\Livewire\Modal;

use LivewireUI\Modal\ModalComponent;
use App\Models\Comment as Com;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class ShowComments extends ModalComponent
{
    public $comment;
    public $comments;
    public $my_comments;
    public $success;
    public $success_c = false;
    public $success_d = false;
    public $shwR;
    public $answ;
    
    public $page;
    public $action = 'all';
    public $hsrc_size = '1';
    public $shw_all_answ = false; 

    
    public function mount()
    {
        $this->comments = Com::orderBy('created_at', 'desc')->get();
        if(Auth::user() != null)
        {
            $this->my_comments = Com::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->take(10)->get();
        }
        else{
            $this->my_comments = [];
        }
    }

    public function render()
    {
        return view('livewire.modal.show-comments');
    }

    public function submitAnswer($id)
    {
        if($this->answ != null)
        {
            Answer::create([
                'comment_id' => $id,
                'types' => "comment",
                'from_id' => Auth::user()->id,
                'answer' => $this->answ,
            ]);

            $this->answ = '';
            $this->success = $id;
        }
        
        $this->comments = Com::orderBy('created_at', 'desc')->get();
        $this->success_c = false;
        $this->success_d = false;
    }

    public function like($id)
    {
        $comm = Com::find($id);
        $comm->likes = $comm->likes+1;
        $comm->save();

        $this->success_c = false;
        $this->success_d = false;

    }

    public function submitComment()
    {
        if($this->comment != null && $this->comment != "")
        {
            Com::create([
                'user_id' => Auth::user()->id,
                'comment' => $this->comment,
            ]);

            $details = [
                'title' => 'Cartodonnées',
                'body' => $this->comment,
                'from_name' => Auth::user()->name,
                'from_email' => Auth::user()->email
            ];

            //Mail::to("yaoparfaitartci@gmail.com")->bcc("yaoparfait48@gmail.com")->send(new alertComment($details));

            $this->comments = Com::orderBy('created_at', 'desc')->get();
            $this->my_comments = Com::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->take(10)->get();
            $this->comment = null;
            $this->success_c = true;
            $this->success_d = false;
        }
    }



    public function deleteComment($id){
        $comm = Com::find($id);
        $comm->delete();

        $this->success_c = false;
        $this->success_d = true;

    }

    public function rangeByDate()
    {
        $this->comments = Com::orderBy('created_at', 'desc')->get();
        $this->my_comments = Com::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->take(10)->get();
    }

    
    public function rangeByLike()
    {
        $this->comments = Com::orderBy('likes', 'desc')->get();
        $this->my_comments = Com::where('user_id', Auth::user()->id)->orderBy('likes', 'desc')->get();
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

    
    public function test()
    {
        $this->shwR = true;
    }
}
