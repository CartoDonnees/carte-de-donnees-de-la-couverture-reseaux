<?php

namespace App\Http\Livewire\Operateur;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Main extends Component
{
    public $update;
    public $action = 'main';
    public $modification = 'table';

    //edit 
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


    public function render()
    {
        $this->update = DB::table('memoire_tampon')->where('operateur', Auth::user()->role )->orderBy('created_at', 'DESC')->get();
        return view('livewire.operateur.main');
    }

    public function editUpdate($id)
    {
        $this->deleteId = $id;
        $modif = DB::table('memoire_tampon')->where('id', $id)->first();
        $this->localM = $modif->localite;
        $this->presenceM = $modif->presence;
        $this->couvertureM = $modif->couverture;
        $this->pop2GM = $modif->population_couverte;
        $this->popTotM = $modif->population_totale;
        $this->techM = $modif->technologie;
        $this->statutM = $modif->statut;
        $this->updateM = date("d/m/Y à H:i:s", strtotime($modif->updated_at));
        $this->dateM = date("d/m/Y à H:i:s", strtotime($modif->created_at));
        $this->modification = 'edit';
    }

    public function deleteUpdate($id){
        DB::table('memoire_tampon')->where('id',$id)->delete();
        $this->modification = 'table';
    }
}
