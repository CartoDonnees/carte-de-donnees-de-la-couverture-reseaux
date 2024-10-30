<?php

namespace App\Http\Livewire\Operateur;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class Updating extends Component
{
    use WithFileUploads;

    public $updated = "dashboard";
    public $updatedCrud = "view";
    public $couvertureReseau;
    public $popCo;
    public $popPerCent;
    public $loCo;

    public $local;
    public $couverture;
    public $pop2G;
    public $popTot;
    public $presence;
    public $alertUpdatedMessage;
    public $alertUpdatedColor;

    public function render()
    {
        return view('livewire.operateur.updating');
    }

    public function selectUpdate($id)
    {

        //2G
        if ($id == 2) {

            //ORANGE
            if ( Auth::user()->role == 'orange') { //2G
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_2G_orange', 'couverture_2G_orange', 'population_2G_orange', 'population_totale')->get();
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_orange', 1)->sum('population_2G_orange');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G')) * 100;

                $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_orange', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->updated = "2g";
            }
            //MTN
            if (Auth::user()->role == 'mtn') {
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_2G_mtn', 'couverture_2G_mtn', 'population_2G_mtn', 'population_totale')->get();
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_mtn', 1)->sum('population_2G_mtn');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G')) * 100;

                $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_mtn', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->updated = "2g";
            }

            //MOOV
            if (Auth::user()->role == 'moov') { //2G
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_2G_moov', 'couverture_2G_moov', 'population_2G_moov', 'population_totale')->get();
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_moov', 1)->sum('population_2G_moov');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G')) * 100;

                $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_moov', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->updated = "2g";
            }

        }

        //3G
        if ($id == 3) {

            //ORANGE
            if ( Auth::user()->role == 'orange') {
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_3G_orange', 'couverture_3G_orange', 'population_couverte_3G_orange', 'population_totale')->get();
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_orange', 1)->sum('population_couverte_3G_orange');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverte_3G')) * 100;

                $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_orange', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->updated = "3g";
            }
            //MTN
            if (Auth::user()->role == 'mtn') { 
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_3G_mtn', 'couverture_3G_mtn', 'population_3G_mtn', 'population_totale')->get();
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_mtn', 1)->sum('population_3G_mtn');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverte_3G')) * 100;

                $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_mtn', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->updated = "3g";
            }

            //MOOV
            if (Auth::user()->role == 'moov') { //2G
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_3G_moov', 'couverture_3G_moov', 'population_couverte_3G_moov', 'population_totale')->get();
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_moov', 1)->sum('population_couverte_3G_moov');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverte_3G')) * 100;

                $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_moov', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->updated = "3g";
            }

        }

        //4G
        if ($id == 4) {

            //ORANGE
            if ( Auth::user()->role == 'orange') {
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_4G_orange', 'couverture_4G_orange', 'population_couverte_4G_orange', 'population_totale')->get();
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_orange', 1)->sum('population_couverte_4G_orange');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G')) * 100;

                $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_orange', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->updated = "4g";
            }
            //MTN
            if (Auth::user()->role == 'mtn') { 
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_4G_mtn', 'couverture_4G_mtn', 'population_couverte_4G_mtn', 'population_totale')->get();
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_mtn', 1)->sum('population_couverte_4G_mtn');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G')) * 100;

                $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_mtn', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->updated = "4g";
            }

            //MOOV
            if (Auth::user()->role == 'moov') { //2G
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_4G_moov', 'couverture_4G_moov', 'population_couverte_4G_moov', 'population_totale')->get();
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_moov', 1)->sum('population_couverte_4G_moov');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G')) * 100;

                $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_moov', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->updated = "4g";
            }

        }
    }

    public function selectEditUpdate($id, $endroit)
    {

        // 2G
        if ($id == 2) {

            //ORANGE
            if (Auth::user()->role == 'orange') { //2G
                $this->local = $endroit;
                $this->presence = DB::table('couverture_reseaux')->where('localite', $endroit)->value('presence_2G_orange');;
                $this->couverture = DB::table('couverture_reseaux')->where('localite', $endroit)->value('couverture_2G_orange');
                $this->pop2G = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_2G_orange');
                $this->popTot = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_totale');
                $this->updatedCrud = "update";
            }

            //MTN
            if (Auth::user()->role == 'mtn') {
                $this->local = $endroit;
                $this->presence = DB::table('couverture_reseaux')->where('localite', $endroit)->value('presence_2G_mtn');;
                $this->couverture = DB::table('couverture_reseaux')->where('localite', $endroit)->value('couverture_2G_mtn');
                $this->pop2G = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_2G_mtn');
                $this->popTot = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_totale');
                $this->updatedCrud = "update";
            }

            //MOOV
            if (Auth::user()->role == 'moov') {
                $this->local = $endroit;
                $this->presence = DB::table('couverture_reseaux')->where('localite', $endroit)->value('presence_2G_moov');;
                $this->couverture = DB::table('couverture_reseaux')->where('localite', $endroit)->value('couverture_2G_moov');
                $this->pop2G = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_2G_moov');
                $this->popTot = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_totale');
                $this->updatedCrud = "update";
            }
        }

        if ($id == 3) {

            //ORANGE
            if (Auth::user()->role == 'orange') { //2G
                $this->local = $endroit;
                $this->presence = DB::table('couverture_reseaux')->where('localite', $endroit)->value('presence_3G_orange');;
                $this->couverture = DB::table('couverture_reseaux')->where('localite', $endroit)->value('couverture_3G_orange');
                $this->pop2G = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_couverte_3G_orange');
                $this->popTot = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_totale');
                $this->updatedCrud = "update";
            }

            //MTN
            if (Auth::user()->role == 'mtn') {
                $this->local = $endroit;
                $this->presence = DB::table('couverture_reseaux')->where('localite', $endroit)->value('presence_3G_mtn');;
                $this->couverture = DB::table('couverture_reseaux')->where('localite', $endroit)->value('couverture_3G_mtn');
                $this->pop2G = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_3G_mtn');
                $this->popTot = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_totale');
                $this->updatedCrud = "update";
            }

            //MOOV
            if (Auth::user()->role == 'moov') {
                $this->local = $endroit;
                $this->presence = DB::table('couverture_reseaux')->where('localite', $endroit)->value('presence_3G_moov');;
                $this->couverture = DB::table('couverture_reseaux')->where('localite', $endroit)->value('couverture_3G_moov');
                $this->pop2G = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_couverte_3G_moov');
                $this->popTot = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_totale');
                $this->updatedCrud = "update";
            }
        }

        if ($id == 4) {

            //ORANGE
            if (Auth::user()->role == 'orange') { //2G
                $this->local = $endroit;
                $this->presence = DB::table('couverture_reseaux')->where('localite', $endroit)->value('presence_4G_orange');;
                $this->couverture = DB::table('couverture_reseaux')->where('localite', $endroit)->value('couverture_4G_orange');
                $this->pop2G = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_couverte_4G_orange');
                $this->popTot = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_totale');
                $this->updatedCrud = "update";
            }

            //MTN
            if (Auth::user()->role == 'mtn') {
                $this->local = $endroit;
                $this->presence = DB::table('couverture_reseaux')->where('localite', $endroit)->value('presence_4G_mtn');;
                $this->couverture = DB::table('couverture_reseaux')->where('localite', $endroit)->value('couverture_4G_mtn');
                $this->pop2G = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_couverte_4G_mtn');
                $this->popTot = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_totale');
                $this->updatedCrud = "update";
            }

            //MOOV
            if (Auth::user()->role == 'moov') {
                $this->local = $endroit;
                $this->presence = DB::table('couverture_reseaux')->where('localite', $endroit)->value('presence_4G_moov');;
                $this->couverture = DB::table('couverture_reseaux')->where('localite', $endroit)->value('couverture_4G_moov');
                $this->pop2G = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_couverte_4G_moov');
                $this->popTot = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_totale');
                $this->updatedCrud = "update";
            }
        }
    }

    public function validateUpdate($id)
    {
        //2G
        if ($id == 2) {
            //ORANGE
            if (Auth::user()->role == 'orange') {

                if ($this->couverture == 1) {
                    DB::table('memoire_tampon')
                        ->insert(['operateur' => 'orange', 'demandeur' =>Auth::user()->email, 'technologie' => '2G' ,'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime()) ]);
                } else {
                    $this->presence = 0;
                    $this->pop2G = 0;
                    DB::table('memoire_tampon')
                        ->insert(['operateur' => 'orange','demandeur'=>Auth::user()->email,'technologie' => '2G' ,'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot,'statut' => 0,'created_at' => (new \DateTime())  ]);
                }
            }

            //MTN
            if (Auth::user()->role == 'mtn') {

                if ($this->couverture == 1) {
                    DB::table('memoire_tampon')
                        ->insert(['operateur' => 'mtn', 'demandeur'=>Auth::user()->email,'technologie' => '2G' ,'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())  ]);
                } else {
                    $this->presence = 0;
                    $this->pop2G = 0;
                    DB::table('memoire_tampon')
                        ->insert(['operateur' => 'mtn', 'demandeur'=>Auth::user()->email,'technologie' => '2G' ,'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())  ]);
                }
            }

            //MOOV
            if (Auth::user()->role == 'moov') {

                if ($this->couverture == 1) {
                    DB::table('memoire_tampon')
                        ->insert(['operateur' => 'moov', 'demandeur'=>Auth::user()->email,'technologie' => '2G' ,'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())  ]);
                } else {
                    $this->presence = 0;
                    $this->pop2G = 0;
                    DB::table('memoire_tampon')
                        ->insert(['operateur' => 'moov', 'demandeur'=>Auth::user()->email,'technologie' => '2G' ,'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())  ]);
                }
            }

            
        }

        if ($id == 3) {
            //ORANGE
            if (Auth::user()->role == 'orange') {

                if ($this->couverture == 1) {
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'orange', 'demandeur'=>Auth::user()->email,'technologie' => '3G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                } else {
                    $this->presence = 0;
                    $this->pop2G = 0;
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'orange', 'demandeur'=>Auth::user()->email,'technologie' => '3G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                }
            }

            //MTN
            if (Auth::user()->role == 'mtn') {

                if ($this->couverture == 1) {
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'mtn', 'demandeur'=>Auth::user()->email,'technologie' => '3G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                } else {
                    $this->presence = 0;
                    $this->pop2G = 0;
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'mtn', 'demandeur'=>Auth::user()->email,'technologie' => '3G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                }
            }

            //MOOV
            if (Auth::user()->role == 'moov') {

                if ($this->couverture == 1) {
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'moov', 'demandeur'=>Auth::user()->email,'technologie' => '3G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                } else {
                    $this->presence = 0;
                    $this->pop2G = 0;
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'moov', 'demandeur'=>Auth::user()->email,'technologie' => '3G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                }
            }
        }

        if ($id == 4) {
            //ORANGE
            if (Auth::user()->role == 'orange') {

                if ($this->couverture == 1) {
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'orange', 'demandeur'=>Auth::user()->email,'technologie' => '4G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                } else {
                    $this->presence = 0;
                    $this->pop2G = 0;
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'orange', 'demandeur'=>Auth::user()->email,'technologie' => '4G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                }
            }

            //MTN
            if (Auth::user()->role == 'mtn') {

                if ($this->couverture == 1) {
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'mtn', 'demandeur'=>Auth::user()->email,'technologie' => '4G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                } else {
                    $this->presence = 0;
                    $this->pop2G = 0;
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'mtn', 'demandeur'=>Auth::user()->email,'technologie' => '4G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                }
            }

            //MOOV
            if (Auth::user()->role == 'moov') {

                if ($this->couverture == 1) {
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'moov', 'demandeur'=>Auth::user()->email,'technologie' => '4G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                } else {
                    $this->presence = 0;
                    $this->pop2G = 0;
                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'moov', 'demandeur'=>Auth::user()->email,'technologie' => '4G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => $this->couverture, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 0,'created_at' => (new \DateTime())]);
                }
            }
        }

        $this->alertUpdatedMessage = "Demande de mise à jour envoyée";
        $this->alertUpdatedColor = "alert-success";

        
        
    }

    public function retourUpdate($id)
    {
        //2G
        if($id == 2){

            //ORANGE
            if (Auth::user()->role == 'orange') { //2G
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_orange', 1)->sum('population_2G_orange');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G')) * 100;
    
                $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_orange', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite' , 'presence_2G_orange','couverture_2G_orange', 'population_2G_orange','population_totale')->get();
            }
            
            //MTN
            if (Auth::user()->role == 'mtn') { //2G
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_mtn', 1)->sum('population_2G_mtn');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G')) * 100;
    
                $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_mtn', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_2G_mtn','couverture_2G_mtn', 'population_2G_mtn' ,'population_totale')->get();
            }

            //MOOV
            if (Auth::user()->role == 'moov') { //2G
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_orange', 1)->sum('population_2G_moov');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G')) * 100;
    
                $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_moov', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_2G_moov','couverture_2G_moov','population_2G_moov', 'population_totale')->get();
            }
            
        }

        //3G
        if($id == 3){

            //ORANGE
            if (Auth::user()->role == 'orange') { 
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_orange', 1)->sum('population_couverte_3G_orange');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverture_3G')) * 100;
    
                $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_orange', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite' , 'presence_3G_orange','couverture_3G_orange', 'population_couverte_3G_orange','population_totale')->get();
            }
            
            //MTN
            if (Auth::user()->role == 'mtn') { 
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_mtn', 1)->sum('population_couverte_3G_mtn');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverture_3G')) * 100;
    
                $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_mtn', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_3G_mtn','couverture_3G_mtn', 'population_couverte_3G_mtn' ,'population_totale')->get();
            }

            //MOOV
            if (Auth::user()->role == 'moov') { 
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_moov', 1)->sum('population_couverte_3G_moov');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverture_3G')) * 100;
    
                $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_moov', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_3G_moov','couverture_3G_moov','population_couverte_3G_moov', 'population_totale')->get();
            }
            
        }

        //3G
        if($id == 4){

            //ORANGE
            if (Auth::user()->role == 'orange') { 
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_orange', 1)->sum('population_couverte_4G_orange');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G')) * 100;
    
                $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_orange', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite' , 'presence_4G_orange','couverture_4G_orange', 'population_couverte_4G_orange','population_totale')->get();
            }
            
            //MTN
            if (Auth::user()->role == 'mtn') { 
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_mtn', 1)->sum('population_couverte_4G_mtn');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G')) * 100;
    
                $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_mtn', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_4G_mtn','couverture_4G_mtn', 'population_couverte_4G_mtn' ,'population_totale')->get();
            }

            //MOOV
            if (Auth::user()->role == 'moov') { 
                $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_moov', 1)->sum('population_couverte_4G_moov');
                $this->popPercent = ($this->popCo / DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G')) * 100;
    
                $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_moov', 1)->count();
                $this->loPercent = ($this->loCo / 8518) * 100;
                $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_4G_moov','couverture_4G_moov','population_couverte_4G_moov', 'population_totale')->get();
            }
            
        }

        $this->alertUpdatedMessage = '';
        $this->alertUpdatedColor = '';
        $this->updatedCrud = "view";
    }

    public function retourAccueil()
    {
        $this->updated = "dashboard";
    }
}
