<?php

namespace App\Http\Livewire\Admin;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Controle extends Component
{
    public $update;
    public $modification = 'table';


    public $deleteId;
    public $localM;
    public $presenceM;
    public $couvertureM;
    public $pop2GM;
    public $popTotM;
    public $techM;
    public $statutM;
    public $dateM;
    public $updateM;
    public $operateurM;
    public $demandeurM;

    public $alertUpdatedMessage;
    public $alertUpdatedColor;

    public function render()
    {
        $this->update = DB::table('memoire_tampon')->orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.controle');
    }

    public function syntheseCouverture($localite){

        $modif = DB::table('couverture_reseaux')->where('localite', $localite)->first();
        //2G
        if ($modif->couverture_2G_orange == 1 || $modif->couverture_2G_mtn == 1 || $modif->couverture_2G_moov == 1) {
            DB::table('couverture_reseaux')
            ->where('localite', $localite)
                ->update(['synthese_couverture_2G' => 1]);
        }
        //3G
        if ($modif->couverture_3G_orange == 1 || $modif->couverture_3G_mtn == 1 || $modif->couverture_3G_moov == 1) {
            DB::table('couverture_reseaux')
            ->where('localite', $localite)
                ->update(['synthese_couverture_3G' => 1]);
        }
        //3G
        if ($modif->couverture_4G_orange == 1 || $modif->couverture_4G_mtn == 1 || $modif->couverture_4G_moov == 1) {
            DB::table('couverture_reseaux')
            ->where('localite', $localite)
                ->update(['synthese_couverture_4G' => 1]);
        }
 
    }

    public function couvertureTechnologie($localite){
        $modif = DB::table('couverture_reseaux')->where('localite', $localite)->first();

        //ORANGE
        if($modif->couverture_4G_orange == 1){
            DB::table('couverture_reseaux')
            ->where('localite', $localite)
                ->update(['couverture_3G_orange' => 1, 'population_couverte_3G_orange' => $modif->population_totale,'couverture_2G_orange' => 1, 'population_2G_orange' => $modif->population_totale]);
        }
        if($modif->couverture_3G_orange == 1){
            DB::table('couverture_reseaux')
            ->where('localite', $localite)
                ->update(['couverture_2G_orange' => 1, 'population_2G_orange' => $modif->population_totale]);
        }

        //MTN
        if($modif->couverture_4G_mtn == 1){
            DB::table('couverture_reseaux')
            ->where('localite', $localite)
                ->update(['couverture_3G_mtn' => 1, 'population_couverte_3G_mtn' => $modif->population_totale,'couverture_2G_mtn' => 1, 'population_2G_mtn' => $modif->population_totale]);
        }
        if($modif->couverture_3G_mtn == 1){
            DB::table('couverture_reseaux')
            ->where('localite', $localite)
                ->update(['couverture_2G_mtn' => 1, 'population_2G_mtn' => $modif->population_totale]);
        }

        //MOOV
        if($modif->couverture_4G_moov == 1){
            DB::table('couverture_reseaux')
            ->where('localite', $localite)
                ->update(['couverture_3G_moov' => 1, 'population_couverte_3G_moov' => $modif->population_totale,'couverture_2G_moov' => 1, 'population_2G_moov' => $modif->population_totale]);
        }
        if($modif->couverture_3G_moov == 1){
            DB::table('couverture_reseaux')
            ->where('localite', $localite)
                ->update(['couverture_2G_moov' => 1, 'population_2G_moov' => $modif->population_totale]);
        }
    }

    public function editUpdate($id)
    {
        $this->alertUpdatedMessage = "";
        $this->alertUpdatedColor = "";
        $this->deleteId = $id;
        $modif = DB::table('memoire_tampon')->where('id', $id)->first();
        $this->operateurM = $modif->operateur;
        $this->demandeurM = $modif->demandeur;
        $this->localM = $modif->localite;
        $this->presenceM = $modif->presence;
        $this->couvertureM = $modif->couverture;
        $this->pop2GM = $modif->population_couverte;
        $this->popTotM = $modif->population_totale;
        $this->techM = $modif->technologie;
        $this->statutM = $modif->statut;
        $this->updateM = $modif->updated_at;
        $this->dateM = $modif->created_at;
        $this->modification = 'edit';
    }

    public function rejectUpdate($id){
        
        DB::table('memoire_tampon')
        ->where('id', $id)
        ->update(['statut' => 2, 'updated_at' => (new \DateTime())]);
               
        $modif = DB::table('memoire_tampon')->where('id', $id)->first();

        $this->deleteId = $id;
        $this->operateurM = $modif->operateur;
        $this->demandeurM = $modif->demandeur;
        $this->localM = $modif->localite;
        $this->presenceM = $modif->presence;
        $this->couvertureM = $modif->couverture;
        $this->pop2GM = $modif->population_couverte;
        $this->popTotM = $modif->population_totale;
        $this->techM = $modif->technologie;
        $this->statutM = 2;
        $this->dateM = $modif->created_at;
        $this->modification = 'edit';

        $this->alertUpdatedMessage = "Mise à jour de l'opérateur " .$this->operateurM." rejeter";
        $this->alertUpdatedColor = "alert-danger";
        
    }

    public function acceptUpdate($id){

        $this->alertUpdatedMessage = "";
        $this->alertUpdatedColor = "";
        DB::table('memoire_tampon')
        ->where('id', $id)
        ->update(['statut' => 1, 'updated_at' => (new \DateTime())]);

        
        $modif = DB::table('memoire_tampon')->where('id', $id)->first();

        if ($modif->technologie == "2G") {
            switch ($modif->operateur) {
                case "orange":
                    DB::table('couverture_reseaux')
                    ->where('localite', $modif->localite)
                        ->update(['presence_2G_orange' => $modif->presence, 'couverture_2G_orange' => $modif->couverture, 'population_2G_orange' => $modif->population_couverte]);
                    break;
                case "mtn":
                    DB::table('couverture_reseaux')
                    ->where('localite', $modif->localite)
                        ->update(['presence_2G_mtn' => $modif->presence, 'couverture_2G_mtn' => $modif->couverture, 'population_2G_mtn' => $modif->population_couverte]);
                    break;
                case "moov":
                    DB::table('couverture_reseaux')
                    ->where('localite', $modif->localite)
                        ->update(['presence_2G_moov' => $modif->presence, 'couverture_2G_moov' => $modif->couverture, 'population_2G_moov' => $modif->population_couverte]);
                    break;
            }
        } elseif ($modif->technologie == "3G") {
            switch ($modif->operateur) {
                case "orange":
                    DB::table('couverture_reseaux')
                    ->where('localite', $modif->localite)
                        ->update(['presence_3G_orange' => $modif->presence, 'couverture_3G_orange' => $modif->couverture, 'population_couverte_3G_orange' => $modif->population_couverte]);
                    break;
                case "mtn":
                    DB::table('couverture_reseaux')
                    ->where('localite', $modif->localite)
                        ->update(['presence_3G_mtn' => $modif->presence, 'couverture_3G_mtn' => $modif->couverture, 'population_couverte_3G_mtn' => $modif->population_couverte]);
                    break;
                case "moov":
                    DB::table('couverture_reseaux')
                    ->where('localite', $modif->localite)
                        ->update(['presence_3G_moov' => $modif->presence, 'couverture_3G_moov' => $modif->couverture, 'population_couverte_3G_moov' => $modif->population_couverte]);
                    break;
            }
        } elseif ($modif->technologie == "4G") {
            switch ($modif->operateur) {
                case "orange":
                    DB::table('couverture_reseaux')
                    ->where('localite', $modif->localite)
                        ->update(['presence_4G_orange' => $modif->presence, 'couverture_4G_orange' => $modif->couverture, 'population_couverte_4G_orange' => $modif->population_couverte]);
                    break;
                case "mtn":
                    DB::table('couverture_reseaux')
                    ->where('localite', $modif->localite)
                        ->update(['presence_4G_mtn' => $modif->presence, 'couverture_4G_mtn' => $modif->couverture, 'population_couverte_4G_mtn' => $modif->population_couverte]);
                    break;
                case "moov":
                    DB::table('couverture_reseaux')
                    ->where('localite', $modif->localite)
                        ->update(['presence_4G_moov' => $modif->presence, 'couverture_4G_moov' => $modif->couverture, 'population_couverte_4G_moov' => $modif->population_couverte]);
                    break;
            }
        }else{}

        


        $this->deleteId = $id;
        $this->operateurM = $modif->operateur;
        $this->demandeurM = $modif->demandeur;
        $this->localM = $modif->localite;
        $this->presenceM = $modif->presence;
        $this->couvertureM = $modif->couverture;
        $this->pop2GM = $modif->population_couverte;
        $this->popTotM = $modif->population_totale;
        $this->techM = $modif->technologie;
        $this->statutM = 1;
        $this->dateM = $modif->created_at;
        $this->updateM = $modif->updated_at;

        $this->syntheseCouverture($modif->localite);
        $this->couvertureTechnologie($modif->localite);

        $this->alertUpdatedMessage = "Mise à jour de l'opérateur " .$this->operateurM."accepter";
        $this->alertUpdatedColor = "alert-success";
    }



}
