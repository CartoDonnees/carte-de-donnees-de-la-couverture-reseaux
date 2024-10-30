<?php

namespace App\Http\Livewire\Admin;


use Carbon\Carbon;
use App\Models\Suggestion as Sug;
use App\Models\Comment;
use Livewire\Component;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Component
{
    use HasFactory;
    public $com = 'table';
    public $comments;
    public $AppComments;
    public $commentLocalite;
    public $commentOperateur;
    public $commentId;
    public $commentEdit;
    public $commentInternet;
    public $commentAppel;
    public $commentSms;
    public $commentAppli;
    public $commentCreation;
    public $commentSolution;
    public $commentText;
    public $mail;
    public $telephone;
    public $statut;

    public $alertCommentMessage;


    public function render()
    {
        return view('livewire.admin.comments');
    }

    public function mount()
    {
        $this->comments = Sug::orderBy('created_at', 'desc')->where('type_probleme', 'Reseau')->get();
        $this->AppComments = Sug::orderBy('created_at', 'desc')->where('type_probleme', 'Appli')->get();
    }

    public function selectComment($id)
    {
        $this->commentEdit = Sug::find($id);


        $this->commentId = $id;
        $this->commentOperateur = $this->commentEdit->operateur;
        $this->commentLocalite = $this->commentEdit->localite;

        // Problème Internet
        if($this->commentEdit->connexion_lente == 1){
            $this->commentInternet = "Connexion lente \n";
        }
        if($this->commentEdit->connexion_impossible == 1){
            $this->commentInternet .= 'Connexion innexistant';
        }

        // Problème Appel
        if($this->commentEdit->appel_non_fluide == 1){
            $this->commentAppel = "Appel non fluide \n";
        }
        if($this->commentEdit->appel_impossible == 1){
            $this->commentAppel .= "Appel impossible";
        }

        //Problème SMS
        if ($this->commentEdit->envoi_sms_lent == 1) {
            $this->commentSms =  "Lenteur de l'envoi des \n";
        }
        if ($this->commentEdit->reception_sms_lente == 1) {
            $this->commentSms .=  "Lenteur de la reception des sms\n";
        }
        if ($this->commentEdit->envoi_sms_impossible == 1) {
            $this->commentSms .=  "Envoi des sms impossible\n";
        }
        if ($this->commentEdit->reception_sms_impossible == 1) {
            $this->commentSms .=  "Reception des sms impossible";
        }

        //Problème d'application
        if($this->commentEdit->application_lent == 1){
            $this->commentAppli = "Application lent\n";
        }
        if($this->commentEdit->probleme_affichage == 1){
            $this->commentAppli .= "Problème d'affichage";
        }

        //Commentaire
        $this->commentText = $this->commentEdit->commentaire;

        //Contacts

        $this->mail = $this->commentEdit->mail;
        $this->telephone = $this->commentEdit->telephone;


        //Statut
        $this->commentCreation = date("d/m/Y à H:i:s", strtotime($this->commentEdit->created_at));
        $this->commentSolution = date("d/m/Y à H:i:s", strtotime($this->commentEdit->updated_at));

        if ($this->commentCreation == $this->commentSolution) {
            $this->statut = 'Non Traiter';
        } else {
            $this->statut = 'Traiter';
        }
        $this->com = 'traiter';
        $this->alertCommentMessage = null;
}

    public function commentUpdate($id)
    {
        Sug::where('id', $id)
            ->update(['updated_at' => Carbon::now()->toDateTimeString()]);
        $this->alertCommentMessage = 'Le post à été traité';
    }

    public function commentDelete($id){
        $delete = Sug::where('id', $id)->delete();
        $this->alertCommentMessage = 'Le post a été supprimé';
        $this->com = 'table';
        
    }

    public function retourComment(){
        $this->alertCommentMessage = null;
        $this->com = 'table';
    }
}