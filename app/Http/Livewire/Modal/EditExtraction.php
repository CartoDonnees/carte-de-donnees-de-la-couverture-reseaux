<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\DB;

class EditExtraction extends ModalComponent
{
    public $district;
    public $regions;
    public $region;
    public $departements;
    public $departement;
    public $sous_prefs;
    public $sous_pref;
    public $localites;
    public $localite;
    public $datas;
    public $action = 'district';


    public function render()
    {
        return view('livewire.modal.edit-extraction');
    }

    public function submitMySelect()
    {
        if ($this->district != null) {

            $this->regions =  DB::table('limite_regions')->whereIn('district', $this->district)
                ->select('new_region')->get();
            $this->action = 'region';
        }
    }

    public function submitRegionSelect()
    {
        if ($this->region!= null) {
            $this->departements =  DB::table('limite_departements')->whereIn('new_region', $this->region)
                ->select('new_departement')->distinct()->get();
            $this->action = 'departement';
        }
        else{

            $this->regions =  DB::table('limite_regions')->whereIn('district', $this->district)
                ->select('new_region')->get();
            $this->action = 'region';
        }

    }

    public function submitDepartSelect()
    {
        if ($this->departement != null) {
            $this->sous_prefs =  DB::table('limite_sous_prefectures')->whereIn('departement', $this->departement)
                ->select('sous_prefecture')->distinct()->get();
            $this->action = 'sous_pref';
        }
        else{
            $this->departements =  DB::table('limite_departements')->whereIn('new_region', $this->region)
                ->select('new_departement')->distinct()->get();
            $this->action = 'departement';
        }
    }

    public function submitSous_prefSelect()
    {
        if ($this->sous_pref != null) {
            $this->localites =  DB::table('localites')->whereIn('sous_prefecture', $this->sous_pref)
                ->select('localite')->get();
            $this->action = 'localite';
        }
        else{
            $this->sous_prefs =  DB::table('limite_sous_prefectures')->whereIn('departement', $this->departement)
                ->select('sous_prefecture')->distinct()->get();
            $this->action = 'sous_pref';
        }
    }

    public function extratDistrict()
    {
        if ($this->district != null) {
            $this->datas = DB::table('couverture_reseaux')->whereIn('district', $this->district)
                ->select('localite', 'sous_prefecture', 'departement', 'region', 'district', 'couverture_2G_mtn', 'couverture_2G_orange','couverture_2G_moov','synthese_couverture_2G', 'couverture_3G_mtn', 'couverture_3G_orange', 'couverture_3G_moov','synthese_couverture_3G', 'couverture_4G_mtn', 'couverture_4G_orange', 'couverture_4G_moov', 'synthese_couverture_4G', 'population_totale')
                ->get();
            $this->action = 'data';
        }
    }

    public function extratRegion()
    {
        if ($this->region!= null) {
            $this->datas = DB::table('couverture_reseaux')->whereIn('REGION', $this->region)
                ->select('localite', 'sous_prefecture', 'departement', 'region', 'district', 'couverture_2G_mtn', 'couverture_2G_orange','couverture_2G_moov','synthese_couverture_2G', 'couverture_3G_mtn', 'couverture_3G_orange', 'couverture_3G_moov','synthese_couverture_3G', 'couverture_4G_mtn', 'couverture_4G_orange', 'couverture_4G_moov', 'synthese_couverture_4G', 'population_totale')
                ->get();
            $this->action = 'data';
        } else {
            $this->datas = DB::table('couverture_reseaux')->whereIn('DISTRICT', $this->district)
                ->select('localite', 'sous_prefecture', 'departement', 'region', 'district', 'couverture_2G_mtn', 'couverture_2G_orange','couverture_2G_moov','synthese_couverture_2G', 'couverture_3G_mtn', 'couverture_3G_orange', 'couverture_3G_moov','synthese_couverture_3G', 'couverture_4G_mtn', 'couverture_4G_orange', 'couverture_4G_moov', 'synthese_couverture_4G', 'population_totale')
                ->get();
            $this->action = 'data';
        }
    }

    public function extratDepartement()
    {
        if ($this->departement != null) {
            $this->datas = DB::table('couverture_reseaux')->whereIn('DEPARTEMENT', $this->departement)
                ->select('localite', 'sous_prefecture', 'departement', 'region', 'district', 'couverture_2G_mtn', 'couverture_2G_orange','couverture_2G_moov','synthese_couverture_2G', 'couverture_3G_mtn', 'couverture_3G_orange', 'couverture_3G_moov','synthese_couverture_3G', 'couverture_4G_mtn', 'couverture_4G_orange', 'couverture_4G_moov', 'synthese_couverture_4G', 'population_totale')
                ->get();
            $this->action = 'data';
        } else {
            $this->datas = DB::table('couverture_reseaux')->whereIn('REGION', $this->region)
                ->select('localite', 'sous_prefecture', 'departement', 'region', 'district', 'couverture_2G_mtn', 'couverture_2G_orange','couverture_2G_moov','synthese_couverture_2G', 'couverture_3G_mtn', 'couverture_3G_orange', 'couverture_3G_moov','synthese_couverture_3G', 'couverture_4G_mtn', 'couverture_4G_orange', 'couverture_4G_moov', 'synthese_couverture_4G', 'population_totale')
                ->get();
            $this->action = 'data';
        }
    }

    public function extratSousPref()
    {
        if ($this->sous_pref != null) {
            $this->datas = DB::table('couverture_reseaux')->whereIn('sous_prefecture', $this->sous_pref)
                ->select('localite', 'sous_prefecture', 'departement', 'region', 'district', 'couverture_2G_mtn', 'couverture_2G_orange','couverture_2G_moov','synthese_couverture_2G', 'couverture_3G_mtn', 'couverture_3G_orange', 'couverture_3G_moov','synthese_couverture_3G', 'couverture_4G_mtn', 'couverture_4G_orange', 'couverture_4G_moov', 'synthese_couverture_4G', 'population_totale')
                ->get();
            $this->action = 'data';
        } else {
            $this->datas = DB::table('couverture_reseaux')->whereIn('DEPARTEMENT', $this->departement)
                ->select('localite', 'sous_prefecture', 'departement', 'region', 'district', 'couverture_2G_mtn', 'couverture_2G_orange','couverture_2G_moov','synthese_couverture_2G', 'couverture_3G_mtn', 'couverture_3G_orange', 'couverture_3G_moov','synthese_couverture_3G', 'couverture_4G_mtn', 'couverture_4G_orange', 'couverture_4G_moov', 'synthese_couverture_4G', 'population_totale')
                ->get();
            $this->action = 'data';
        }
    }

    public function extratLocalite()
    {
        if ($this->localite != null) {
            $this->datas = DB::table('couverture_reseaux')->whereIn('LOCALITE', $this->localite)->whereIn('sous_prefecture', $this->sous_pref)->whereIn('DEPARTEMENT', $this->departement)
                ->select('localite', 'sous_prefecture', 'departement', 'region', 'district', 'couverture_2G_mtn', 'couverture_2G_orange','couverture_2G_moov','synthese_couverture_2G', 'couverture_3G_mtn', 'couverture_3G_orange', 'couverture_3G_moov','synthese_couverture_3G', 'couverture_4G_mtn', 'couverture_4G_orange', 'couverture_4G_moov', 'synthese_couverture_4G', 'population_totale')
                ->get();
            $this->action = 'data';
        } else {
            $this->datas = DB::table('couverture_reseaux')->whereIn('sous_prefecture', $this->sous_pref)
                ->select('localite', 'sous_prefecture', 'departement', 'region', 'district', 'couverture_2G_mtn', 'couverture_2G_orange','couverture_2G_moov','synthese_couverture_2G', 'couverture_3G_mtn', 'couverture_3G_orange', 'couverture_3G_moov','synthese_couverture_3G', 'couverture_4G_mtn', 'couverture_4G_orange', 'couverture_4G_moov', 'synthese_couverture_4G', 'population_totale')
                ->get();
            $this->action = 'data';
        }
    }

    public function precedent()
    {
        if ($this->localite != null){
            $this->action = 'localite';
            $this->localites =  DB::table('localites')->whereIn('sous_prefecture', $this->sous_pref)
                ->select('localite')->get();
            
        }
        elseif($this->sous_pref != null){
            $this->action = 'sous_pref';
            $this->sous_prefs =  DB::table('limite_sous_prefectures')->whereIn('departement', $this->departement)
                ->select('sous_prefecture')->distinct()->get();
        }
        elseif($this->departement != null){
            $this->action = 'departement';
            $this->departements =  DB::table('limite_departements')->whereIn('new_region', $this->region)
                ->select('new_departement')->distinct()->get();
            
        }
        elseif($this->region!= null){
            $this->action = 'region';
            $this->regions =  DB::table('limite_regions')->whereIn('district', $this->district)
                ->select('new_region')->get();
        }
        else{
            $this->action = 'district';
        }

    }

    public function precedentDistrict()
    {
        $this->action = 'district';
    }

    public function precedentRegion()
    {
        $this->action = 'region';
        $this->regions =  DB::table('limite_regions')->whereIn('district', $this->district)
            ->select('new_region')->get();
    }

    public function precedentDepartement()
    {
        $this->action = 'departement';
        $this->departements =  DB::table('limite_departements')->whereIn('new_region', $this->region)
            ->select('new_departement')->distinct()->get();
    }

    public function precedentSousPrefecture()
    {
        $this->action = 'sous_pref';
        $this->sous_prefs =  DB::table('limite_sous_prefectures')->whereIn('departement', $this->departement)
            ->select('sous_prefecture')->distinct()->get();
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
