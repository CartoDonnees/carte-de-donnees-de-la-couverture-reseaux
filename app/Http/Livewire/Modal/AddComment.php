<?php

namespace App\Http\Livewire\Modal;


use LivewireUI\Modal\ModalComponent;
use App\Models\Suggestion as Sug;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\alertComment;

class AddComment extends ModalComponent
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
    public $isLoading = -1;

    public $error = false;
    

    public $isSelect = false;


    protected $rules = [
        'telephone' => 'digits:10',
        'mail' => 'email',
    ];
    public function render()
    {
        return view('livewire.modal.add-comment');
    }

    public function submitComment()
    {
        if($this->CheckPb  == 1){
            if(($this->appliLente != null || $this->pblAffichage != null) || ($this->comment != null || $this->comment != "")){

                Sug::create([
                    'type_probleme' => $this->CheckPb  == 2 ? 'Reseau' : 'Appli' ,
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
            else{
                $this->error = true;
            }
        }
        if($this->CheckPb  == 2){
            if(($this->internetLent != null || 
            $this->internetImpossible != null || 
            $this->appelFluide || 
            $this->appelImpossible || 
            $this->eSmsLent || 
            $this->rSmsLent || 
            $this->eSmsImpossible || 
            $this->rSmsImpossible) ||  ($this->comment != null || $this->comment != "")){
                Sug::create([
                    'type_probleme' => $this->CheckPb  == 2 ? 'Reseau' : 'Appli' ,
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

            }else{
                $this->error = true;
            }
        }
    }

    public function handleBack() {
        $this->isSelect = false;
        $this->operateur = null;
        $this->localite = null;
        $this->internetLent = null;
        $this->internetImpossible = null;
        $this->appelFluide = null;
        $this->appelImpossible = null;
        $this->eSmsLent = null;
        $this->rSmsLent = null;
        $this->eSmsImpossible = null;
        $this->rSmsImpossible = null;
        $this->appliLente = null;
        $this->pblAffichage = null;
        $this->comment = null;
        $this->mail = null;
        $this->telephone = null;
        $this->error = null;


    }

    public function selectNetworkProbleme(){
        $this->isLoading = true;
        $this->CheckPb = 2;
        $this->isSelect = true;
    }

    public function selectApplicationProbleme(){
        $this->CheckPb = 1;
        $this->isSelect = true;
    }

    public function initLoading() {
        $this->isLoading = false;
        $this->isSelect = true;
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
