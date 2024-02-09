<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Suggestion as Sug;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\alertComment;

class CommentForm extends Component
{
    public $success;
    public $hsrc_size = 8;

    public $CheckPb;
    public $operateur;
    public $localite;
    public $internetLent;
    public $internetImpossible;
    public $appelFluide;
    public $appelImpossible;
    public $eSmsLent;
    public $rSmsLent;
    public $eSmsImpossible;
    public $rSmsImpossible;
    public $appliLente;
    public $pblAffichage;
    public $comment;
    public $mail;
    public $telephone;
    public $cities;
    

    // $path = public_path('dataFiles/json/citieName.json');
    //     $content = file_get_contents($path);
    

    protected $rules = [
        'telephone' => 'digits:10',
        'mail' => 'email',
    ];

    public function render()
    {
        $this->cities = json_decode(file_get_contents(public_path('dataFiles/json/citieName.json')), true);
        return view('livewire.comment-form');
    }

    public function submitComment()
    {
        $this->validate();

        Sug::create([
            'type_probleme' => $this->CheckPb,
            'operateur' => $this->operateur,
            'localite' => $this->localite,
            'connexion_lente' => (int) $this->internetLent,
            'connexion_impossible' => (int)$this->internetImpossible,
            'appel_non_fluide' => (int)$this->appelFluide,
            'appel_impossible' => (int)$this->appelImpossible,
            'envoi_sms_lent' => (int)$this->eSmsLent,
            'reception_sms_lente' => (int)$this->rSmsLent,
            'envoi_sms_impossible' => (int)$this->eSmsImpossible,
            'reception_sms_impossible' => (int)$this->rSmsImpossible,
            'application_lent' => (int)$this->appliLente,
            'probleme_affichage' => (int)$this->pblAffichage,
            'commentaire' => $this->comment,
            'mail' => $this->mail,
            'telephone' => $this->telephone,

        ]);
        // Mail::to('ygningninri@gmail.com')->send(new alertComment());
        $this->success = true;
    }
}
