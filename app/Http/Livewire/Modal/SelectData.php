<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SelectData extends Component
{
    public $locCouvs = false;
    public $setData = true;
    public $test;
    public $area;

    
    protected $listeners = ['setInitdata'];


    public function render()
    {
        return view('livewire.modal.select-data');
    }

    
    public function setInitdata()
    {
        $this->setData = true;
    }

    public function setShowData($datas)
    {
        $this->locCouvs = $datas;
    }

    public function exportPDF()
    {
        
    }

    public function export()
    {
        return Excel::download(new dataExport, 'data.xlsx');
    }
}
