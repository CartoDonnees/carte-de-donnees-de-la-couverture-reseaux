<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Updating extends Component
{
    use WithFileUploads;

    public $locCouvs;
    public $datas;
    public $success;
    public $last_action;
    public $history;
    public $couvertureReseau;

    // Updated form

    public $updated = "dashboard";
    public $local;
    public $couverture;
    public $presence;
    public $technologie;
    public $pop2G;
    public $popTot;
    public $updatedCrud = "view";
    public $alertUpdatedMessage;
    public $alertUpdatedColor;
    public $popCo;
    public $loCo;


    public function render()
    {
        return view('livewire.admin.updating');
    }




    public function loadNoCouverture()
    {
        $fichier  = fopen('dataFiles/js/dwdNoData.js', 'c+b');
        fwrite($fichier, '');
        fclose($fichier);
        $noLocCouvs = DB::select('select * from couverture_reseaux where couverture_2G_orange = 0 or couverture_2G_mtn = 0 or couverture_2G_moov = 0 or couverture_3G_orange = 0 or couverture_3G_mtn = 0 or couverture_3G_moov = 0 or couverture_4G_orange = 0 or couverture_4G_mtn = 0 or couverture_4G_moov = 0');

        $fichier  = fopen('dataFiles/js/dwdNoData.js', 'c+b');
        $content = '';
        foreach ($noLocCouvs as $couvs) {
            $content = $content . $couvs->OBJECTID . ':{
                "loc":"' . $couvs->localite . '",
                "sp":"' . $couvs->sous_prefecture . '",
                "dp":"' . $couvs->departement . '",
                "rg":"' . $couvs->region . '",
                "dt":"' . $couvs->district . '",
                "pop":"' . intval($couvs->population_totale) . '",
                "S2G":' . intval($couvs->synthese_couverture_2G) . ',
                "S3G":' . intval($couvs->synthese_couverture_3G) . ',
                "S4G":' . intval($couvs->synthese_couverture_4G) . ',
            },';
        }
        $content = 'var dwdNoData ={' . $content . '}';

        file_put_contents('dataFiles/js/dwdNoData.js', $content);
        $this->last_action = "Données de couverture réseau";
        dd('ok');
    }

    public function loadProperty()
    {
        $fichier  = fopen('dataFiles/js/data.js', 'c+b');
        fwrite($fichier, '');
        fclose($fichier);

        $pops = null;
        $couvTotpop = null;
        $nbcouvOr = null;
        $nbcouvMt = null;
        $nbcouvMo = null;
        $nbLocOr2G = null;
        $nbLocOr3G = null;
        $nbLocOr4G = null;
        $nbLocMt2G = null;
        $nbLocMt3G = null;
        $nbLocMt4G = null;
        $nbLocMo2G = null;
        $nbLocMo3G = null;
        $nbLocMo4G = null;
        $po2GOr = null;
        $po3GOr = null;
        $po4GOr = null;

        $po2GMt = null;
        $po3GMt = null;
        $po4GMt = null;
        $po2GMo = null;
        $po3GMo = null;
        $po4GMo = null;


        $fichier  = fopen('dataFiles/js/data.js', 'c+b');
        $content = '';

        $pops = DB::select("select population_totale from couverture_reseaux");
        $pops = intval(collect($pops)->sum('population_totale'));

        $couvTotpop = DB::select("select * from couverture_reseaux where couverture_2G_orange = 1 or couverture_2G_mtn = 1 or couverture_2G_moov = 1 or couverture_3G_orange = 1 or couverture_3G_mtn = 1 or couverture_3G_moov = 1 or couverture_4G_orange = 1 or couverture_4G_mtn = 1 or couverture_4G_moov = 1");
        $couvTotpop = count($couvTotpop);

        $nbcouvOr = DB::select("select population_totale from couverture_reseaux where couverture_2G_orange = 1 or couverture_3G_orange = 1 or couverture_4G_orange = 1");
        $nbcouvOr = intval(collect($nbcouvOr)->sum('population_totale'));

        $nbcouvMt = DB::select("select population_totale from couverture_reseaux where couverture_2G_mtn = 1 or couverture_3G_mtn = 1 or couverture_4G_mtn = 1");
        $nbcouvMt = intval(collect($nbcouvMt)->sum('population_totale'));

        $nbcouvMo = DB::select("select population_totale from couverture_reseaux where couverture_2G_moov = 1 or couverture_3G_moov = 1 or couverture_4G_moov = 1");
        $nbcouvMo = intval(collect($nbcouvMo)->sum('population_totale'));

        //populaton_totales couvertes
        $po2GOr = DB::select("select population_totale from couverture_reseaux where couverture_2G_orange = 1");
        $po2GOr = intval(collect($po2GOr)->sum('population_totale'));

        $po3GOr = DB::select("select population_totale from couverture_reseaux where couverture_3G_orange = 1");
        $po3GOr = intval(collect($po3GOr)->sum('population_totale'));

        $po4GOr = DB::select("select population_totale from couverture_reseaux where couverture_4G_orange = 1");
        $po4GOr = intval(collect($po4GOr)->sum('population_totale'));

        $po2GMt = DB::select("select population_totale from couverture_reseaux where couverture_2G_mtn = 1");
        $po2GMt = intval(collect($po2GMt)->sum('population_totale'));

        $po3GMt = DB::select("select population_totale from couverture_reseaux where couverture_3G_mtn = 1");
        $po3GMt = intval(collect($po3GMt)->sum('population_totale'));

        $po4GMt = DB::select("select population_totale from couverture_reseaux where couverture_4G_mtn = 1");
        $po4GMt = intval(collect($po4GMt)->sum('population_totale'));

        $po2GMo = DB::select("select population_totale from couverture_reseaux where couverture_2G_moov = 1");
        $po2GMo = intval(collect($po2GMo)->sum('population_totale'));

        $po3GMo = DB::select("select population_totale from couverture_reseaux where couverture_3G_moov= 1");
        $po3GMo = intval(collect($po3GMo)->sum('population_totale'));

        $po4GMo = DB::select("select population_totale from couverture_reseaux where couverture_4G_moov = 1");
        $po4GMo = intval(collect($po4GMo)->sum('population_totale'));

        //Localités couvertes
        $nbLocOr2G = DB::select("select localite from couverture_reseaux where couverture_2G_orange = 1");
        $nbLocOr2G = count($nbLocOr2G);

        $nbLocOr3G = DB::select("select localite from couverture_reseaux where couverture_3G_orange = 1");
        $nbLocOr3G = count($nbLocOr3G);

        $nbLocOr4G = DB::select("select localite from couverture_reseaux where couverture_4G_orange = 1");
        $nbLocOr4G = count($nbLocOr4G);

        $nbLocMt2G = DB::select("select localite from couverture_reseaux where couverture_2G_mtn = 1");
        $nbLocMt2G = count($nbLocMt2G);

        $nbLocMt3G = DB::select("select localite from couverture_reseaux where couverture_3G_mtn = 1");
        $nbLocMt3G = count($nbLocMt3G);

        $nbLocMt4G = DB::select("select localite from couverture_reseaux where couverture_4G_mtn = 1");
        $nbLocMt4G = count($nbLocMt4G);

        $nbLocMo2G = DB::select("select localite from couverture_reseaux where couverture_2G_moov = 1");
        $nbLocMo2G = count($nbLocMo2G);

        $nbLocMo3G = DB::select("select localite from couverture_reseaux where couverture_3G_moov = 1");
        $nbLocMo3G = count($nbLocMo3G);

        $nbLocMo4G = DB::select("select localite from couverture_reseaux where couverture_4G_moov = 1");
        $nbLocMo4G = count($nbLocMo4G);

        $content = "var pops = " . $pops . ";var couvTotpop = " . $couvTotpop . ";var nbcouvOr = " . $nbcouvOr . ";var nbcouvMt = " . $nbcouvMt . ";var nbcouvMo = " . $nbcouvMo . ";var nbLocOr2G=" . $nbLocOr2G . ";var nbLocOr3G=" . $nbLocOr3G . ";var nbLocOr4G=" . $nbLocOr4G . ";var nbLocMt2G=" . $nbLocMt2G . ";var nbLocMt3G=" . $nbLocMt3G . ";var nbLocMt4G=" . $nbLocMt4G . ";var nbLocMo2G=" . $nbLocMo2G . ";var nbLocMo3G=" . $nbLocMo3G . ";var nbLocMo4G=" . $nbLocMo4G . ";var pops=" . $pops . ";var po2GOr=" . $po2GOr . ";var po3GOr=" . $po3GOr . ";var po4GOr=" . $po4GOr . ";var po2GMt=" . $po2GMt . ";var po3GMt=" . $po3GMt . ";var po4GMt=" . $po4GMt . ";var po2GMo=" . $po2GMo . ";var po3GMo=" . $po3GMo . ";var po4GMo=" . $po4GMo;

        fwrite($fichier, $content);
        fclose($fichier);
        dd('ok');
    }


    public function loadCouverture()
    {
        $fichier  = fopen('dataFiles/js/dwdData.js', 'c+b');
        fwrite($fichier, '');
        fclose($fichier);
        $locCouvs = DB::select('select * from couverture_reseaux where couverture_2G_orange = 1 or couverture_2G_mtn = 1 or couverture_2G_moov = 1 or couverture_3G_orange = 1 or couverture_3G_mtn = 1 or couverture_3G_moov = 1 or couverture_4G_orange = 1 or couverture_4G_mtn = 1 or couverture_4G_moov = 1');

        $fichier  = fopen('dataFiles/js/dwdData.js', 'c+b');
        $content = '';
        foreach ($locCouvs as $couvs) {
            $content = $content . $couvs->OBJECTID . ':{
                "loc":"' . $couvs->localite . '",
                "sp":"' . $couvs->SOUS_PREFECTURE . '",
                "dp":"' . $couvs->DEPARTEMENT . '",
                "rg":"' . $couvs->REGION . '",
                "dt":"' . $couvs->DISTRICT . '",
                "pop":"' . intval($couvs->population_totale) . '",
                "S2G":' . intval($couvs->SYNTHESE_COUVERTURE_2G) . ',
                "S3G":' . intval($couvs->SYNTHESE_COUVERTURE_3G) . ',
                "S4G":' . intval($couvs->SYNTHESE_COUVERTURE_4G) . ',
            },';
        }
        $content = 'var  ={' . $content . '}';

        file_put_contents('dataFiles/js/dwdData.js', $content);
        $this->last_action = "Données de couverture telechargeable";
        dd('ok');
    }

    public function updateStatDistrict()
    {
        $fichier  = fopen('dataFiles/js/ddata.js', 'c+b');
        fwrite($fichier, '');
        fclose($fichier);

        $districts = DB::select('select * from LIMITE_DISTRICT');

        $nbLocCouv = null;
        $pop = null;
        $pop2gOr = null;
        $pop2gMtn = null;
        $pop2gMoov = null;
        $pop3gOr = null;
        $pop3gMtn = null;
        $pop3gMoov = null;
        $pop4gOr = null;
        $pop4gMtn = null;
        $pop4gMoov = null;


        $fichier  = fopen('dataFiles/js/ddata.js', 'c+b');
        $content = '';

        foreach ($districts as $dist) {
            if ($dist->DISTRICT != 'DISTRICT AUTONOME D\'ABIDJAN' && $dist->DISTRICT != 'N\'ZI') {
                $nbpops = DB::select("select POP_TOTAL from STATISTIQUE_SP_COUVERT where DISTRICT = '" . $dist->DISTRICT . "'");
                $nbpops = intval(collect($nbpops)->sum('POP_TOTAL'));

                $nbpopcouv = DB::select("select NBRE_populaton_totale_COUVERTE from STATISTIQUE_SP_COUVERT where DISTRICT ='" . $dist->DISTRICT . "'");
                $nbpopcouv = intval(collect($nbpopcouv)->sum('NBRE_populaton_totale_COUVERTE'));

                $nbnopopcouv = DB::select("select POP_NON_COUVERT from STATISTIQUE_SP_COUVERT where DISTRICT ='" . $dist->DISTRICT . "'");
                $nbnopopcouv = intval(collect($nbnopopcouv)->sum('POP_NON_COUVERT'));




                $nbLocCouv = DB::select("select NBRE_localite_COUVERTE from STATISTIQUE_SP_COUVERT where DISTRICT ='" . $dist->DISTRICT . "'");
                $nbLocCouv = intval(collect($nbLocCouv)->sum('NBRE_localite_COUVERTE'));

                $nbNoLocCouv = DB::select("select LOC_NON_COUVERT from STATISTIQUE_SP_COUVERT where DISTRICT ='" . $dist->DISTRICT . "'");
                $nbNoLocCouv = intval(collect($nbNoLocCouv)->sum('LOC_NON_COUVERT'));

                $nbLoc = DB::select("select LOC_TOTAL from STATISTIQUE_SP_COUVERT where DISTRICT ='" . $dist->DISTRICT . "'");
                $nbLoc = intval(collect($nbLoc)->sum('LOC_TOTAL'));


                $txcouvloc = DB::select("select TAUX_COUVERT_LOC from STATISTIQUE_SP_COUVERT where DISTRICT ='" . $dist->DISTRICT . "'");
                $tcount = count($txcouvloc);
                $txcouvloc = intval(collect($txcouvloc)->sum('TAUX_COUVERT_LOC'));
                $txcouvloc = round($txcouvloc / $tcount, 2);

                $txcouvpop = DB::select("select TAUX_COUVERT_POP from STATISTIQUE_SP_COUVERT where DISTRICT ='" . $dist->DISTRICT . "'");
                $tcount = count($txcouvpop);
                $txcouvpop = intval(collect($txcouvpop)->sum('TAUX_COUVERT_POP'));
                $txcouvpop = round($txcouvpop / $tcount, 2);

                $pop2gOr = DB::select("select * from couverture_reseaux where couverture_2G_orange = 1 and CODE_DISTRICT ='" . $dist->CODE_DISTRICT . "'");
                $nbcouv2gOr = count($pop2gOr);
                $pop2gOr = intval(collect($pop2gOr)->sum('population_totale'));

                $pop2gMtn = DB::select("select * from couverture_reseaux where couverture_2G_mtn = 1 and CODE_DISTRICT ='" . $dist->CODE_DISTRICT . "'");
                $nbcouv2gMtn = count($pop2gMtn);
                $pop2gMtn = intval(collect($pop2gMtn)->sum('population_totale'));

                $pop2gMoov = DB::select("select * from couverture_reseaux where couverture_2G_moov = 1 and CODE_DISTRICT ='" . $dist->CODE_DISTRICT . "'");
                $nbcouv2gMoov = count($pop2gMoov);
                $pop2gMoov = intval(collect($pop2gMoov)->sum('population_totale'));

                $pop3gOr = DB::select("select * from couverture_reseaux where couverture_3G_orange = 1 and CODE_DISTRICT ='" . $dist->CODE_DISTRICT . "'");
                $nbcouv3gOr = count($pop3gOr);
                $pop3gOr = intval(collect($pop3gOr)->sum('population_totale'));

                $pop3gMtn = DB::select("select * from couverture_reseaux where couverture_3G_mtn = 1 and CODE_DISTRICT ='" . $dist->CODE_DISTRICT . "'");
                $nbcouv3gMtn = count($pop3gMtn);
                $pop3gMtn = intval(collect($pop3gMtn)->sum('population_totale'));

                $pop3gMoov = DB::select("select * from couverture_reseaux where couverture_3G_moov = 1 and CODE_DISTRICT ='" . $dist->CODE_DISTRICT . "'");
                $nbcouv3gMoov = count($pop3gMoov);
                $pop3gMoov = intval(collect($pop3gMoov)->sum('population_totale'));

                $pop4gOr = DB::select("select * from couverture_reseaux where couverture_4G_orange = 1 and CODE_DISTRICT ='" . $dist->CODE_DISTRICT . "'");
                $nbcouv4gOr = count($pop4gOr);
                $pop4gOr = intval(collect($pop4gOr)->sum('population_totale'));

                $pop4gMtn = DB::select("select * from couverture_reseaux where couverture_4G_mtn = 1 and CODE_DISTRICT ='" . $dist->CODE_DISTRICT . "'");
                $nbcouv4gMtn = count($pop4gMtn);
                $pop4gMtn = intval(collect($pop4gMtn)->sum('population_totale'));

                $pop4gMoov = DB::select("select * from couverture_reseaux where couverture_4G_moov = 1 and CODE_DISTRICT ='" . $dist->CODE_DISTRICT . "'");
                $nbcouv4gMoov = count($pop4gMoov);
                $pop4gMoov = intval(collect($pop4gMoov)->sum('population_totale'));
            } else {
                $nbpops = DB::select("select POP_TOTAL from STATISTIQUE_SP_COUVERT where DISTRICT = 'DISTRICT AUTONOME D''ABIDJAN'");
                $nbpops = intval(collect($nbpops)->sum('POP_TOTAL'));

                $nbpopcouv = DB::select("select NBRE_populaton_totale_COUVERTE from STATISTIQUE_SP_COUVERT where DISTRICT ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbpopcouv = intval(collect($nbpopcouv)->sum('NBRE_populaton_totale_COUVERTE'));

                $nbnopopcouv = DB::select("select POP_NON_COUVERT from STATISTIQUE_SP_COUVERT where DISTRICT ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbnopopcouv = intval(collect($nbnopopcouv)->sum('POP_NON_COUVERT'));


                $nbLocCouv = DB::select("select NBRE_localite_COUVERTE from STATISTIQUE_SP_COUVERT where DISTRICT ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbLocCouv = intval(collect($nbLocCouv)->sum('NBRE_localite_COUVERTE'));

                $nbNoLocCouv = DB::select("select LOC_NON_COUVERT from STATISTIQUE_SP_COUVERT where DISTRICT ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbNoLocCouv = intval(collect($nbNoLocCouv)->sum('LOC_NON_COUVERT'));

                $nbLoc = DB::select("select LOC_TOTAL from STATISTIQUE_SP_COUVERT where DISTRICT ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbLoc = intval(collect($nbLoc)->sum('LOC_TOTAL'));


                $txcouvloc = DB::select("select TAUX_COUVERT_LOC from STATISTIQUE_SP_COUVERT where DISTRICT ='DISTRICT AUTONOME D''ABIDJAN'");
                $tcount = count($txcouvloc);
                $txcouvloc = intval(collect($txcouvloc)->sum('TAUX_COUVERT_LOC'));
                $txcouvloc = round($txcouvloc / $tcount, 2);

                $txcouvpop = DB::select("select TAUX_COUVERT_POP from STATISTIQUE_SP_COUVERT where DISTRICT ='DISTRICT AUTONOME D''ABIDJAN'");
                $tcount = count($txcouvpop);
                $txcouvpop = intval(collect($txcouvpop)->sum('TAUX_COUVERT_POP'));
                $txcouvpop = round($txcouvpop / $tcount, 2);

                $pop2gOr = DB::select("select * from couverture_reseaux where couverture_2G_orange = 1 and CODE_DISTRICT ='DI1'");
                $nbcouv2gOr = count($pop2gOr);
                $pop2gOr = intval(collect($pop2gOr)->sum('population_totale'));

                $pop2gMtn = DB::select("select * from couverture_reseaux where couverture_2G_mtn = 1 and CODE_DISTRICT ='DI1'");
                $nbcouv2gMtn = count($pop2gMtn);
                $pop2gMtn = intval(collect($pop2gMtn)->sum('population_totale'));

                $pop2gMoov = DB::select("select * from couverture_reseaux where couverture_2G_moov = 1 and CODE_DISTRICT ='DI1'");
                $nbcouv2gMoov = count($pop2gMoov);
                $pop2gMoov = intval(collect($pop2gMoov)->sum('population_totale'));

                $pop3gOr = DB::select("select * from couverture_reseaux where couverture_3G_orange = 1 and CODE_DISTRICT ='DI1'");
                $nbcouv3gOr = count($pop3gOr);
                $pop3gOr = intval(collect($pop3gOr)->sum('population_totale'));

                $pop3gMtn = DB::select("select * from couverture_reseaux where couverture_3G_mtn = 1 and CODE_DISTRICT ='DI1'");
                $nbcouv3gMtn = count($pop3gMtn);
                $pop3gMtn = intval(collect($pop3gMtn)->sum('population_totale'));

                $pop3gMoov = DB::select("select * from couverture_reseaux where couverture_3G_moov = 1 and CODE_DISTRICT ='DI1'");
                $nbcouv3gMoov = count($pop3gMoov);
                $pop3gMoov = intval(collect($pop3gMoov)->sum('population_totale'));

                $pop4gOr = DB::select("select * from couverture_reseaux where couverture_4G_orange = 1 and CODE_DISTRICT ='DI1'");
                $nbcouv4gOr = count($pop4gOr);
                $pop4gOr = intval(collect($pop4gOr)->sum('population_totale'));

                $pop4gMtn = DB::select("select * from couverture_reseaux where couverture_4G_mtn = 1 and CODE_DISTRICT ='DI1'");
                $nbcouv4gMtn = count($pop4gMtn);
                $pop4gMtn = intval(collect($pop4gMtn)->sum('population_totale'));

                $pop4gMoov = DB::select("select * from couverture_reseaux where couverture_4G_moov = 1 and CODE_DISTRICT ='DI1'");
                $nbcouv4gMoov = count($pop4gMoov);
                $pop4gMoov = intval(collect($pop4gMoov)->sum('population_totale'));
            }



            $content = $content . 'var ' . $dist->CODE_DISTRICT . ' = {
                "district":"' . $dist->DISTRICT . '",
                "population_totale":' . $nbpops . ',
                "popcouv":' . $nbpopcouv . ',
                "nopopcouv":' . $nbnopopcouv . ',
                "nbcouvloc":' . $nbLocCouv . ',
                "nbnocouvloc":' . $nbNoLocCouv . ',
                "nbloc":' . $nbLoc . ',
                "txcouvloc":' . $txcouvloc . ',
                "txpopcouv":' . $txcouvpop . ',
                "nbcouv2gOr":' . $nbcouv2gOr . ',
                "nbcouv2gMtn":' . $nbcouv2gMtn . ',
                "nbcouv2gMoov":' . $nbcouv2gMoov . ',
                "nbcouv3gOr":' . $nbcouv3gOr . ',
                "nbcouv3gMtn":' . $nbcouv3gMtn . ',
                "nbcouv3gMoov":' . $nbcouv3gMoov . ',
                "nbcouv4gOr":' . $nbcouv4gOr . ',
                "nbcouv4gMtn":' . $nbcouv4gMtn . ',
                "nbcouv4gMoov":' . $nbcouv4gMoov . ',
                "popOrange2G":' . $pop2gOr . ',
                "popMtn2G":' . $pop2gMtn . ',
                "popMoov2G":' . $pop2gMoov . ',
                "popOrange3G":' . $pop3gOr . ',
                "popMtn3G":' . $pop3gMtn . ',
                "popMoov3G":' . $pop3gMoov . ',
                "popOrange4G":' . $pop4gOr . ',
                "popMtn4G":' . $pop4gMtn . ',
                "popMoov4G":' . $pop4gMoov . ',
            };';
        }


        fseek($fichier, filesize('dataFiles/js/ddata.js'));
        fwrite($fichier, $content);
        fclose($fichier);
        dd('ok');
    }

    public function updateStatRegion()
    {
        $fichier  = fopen('dataFiles/js/rdata.js', 'c+b');
        fwrite($fichier, '');
        fclose($fichier);

        $regions = DB::select('select * from LIMITE_REGIONS');

        $nbLocCouv = null;
        $pop = null;
        $pop2gOr = null;
        $pop2gMtn = null;
        $pop2gMoov = null;
        $pop3gOr = null;
        $pop3gMtn = null;
        $pop3gMoov = null;
        $pop4gOr = null;
        $pop4gMtn = null;
        $pop4gMoov = null;


        $fichier  = fopen('dataFiles/js/rdata.js', 'c+b');
        $content = '';

        foreach ($regions as $reg) {
            if ($reg->NEW_REGION != 'DISTRICT AUTONOME D\'ABIDJAN' && $reg->NEW_REGION != 'N\'ZI') {

                $nbpops = DB::select("select POP_TOTAL from STATISTIQUE_SP_COUVERT where REGION = '" . $reg->NEW_REGION . "'");
                $nbpops = intval(collect($nbpops)->sum('POP_TOTAL'));

                $nbpopcouv = DB::select("select NBRE_populaton_totale_COUVERTE from STATISTIQUE_SP_COUVERT where REGION ='" . $reg->NEW_REGION . "'");
                $nbpopcouv = intval(collect($nbpopcouv)->sum('NBRE_populaton_totale_COUVERTE'));

                $nbnopopcouv = DB::select("select POP_NON_COUVERT from STATISTIQUE_SP_COUVERT where REGION ='" . $reg->NEW_REGION . "'");
                $nbnopopcouv = intval(collect($nbnopopcouv)->sum('POP_NON_COUVERT'));




                $nbLocCouv = DB::select("select NBRE_localite_COUVERTE from STATISTIQUE_SP_COUVERT where REGION ='" . $reg->NEW_REGION . "'");
                $nbLocCouv = intval(collect($nbLocCouv)->sum('NBRE_localite_COUVERTE'));

                $nbNoLocCouv = DB::select("select LOC_NON_COUVERT from STATISTIQUE_SP_COUVERT where REGION ='" . $reg->NEW_REGION . "'");
                $nbNoLocCouv = intval(collect($nbNoLocCouv)->sum('LOC_NON_COUVERT'));

                $nbLoc = DB::select("select LOC_TOTAL from STATISTIQUE_SP_COUVERT where REGION ='" . $reg->NEW_REGION . "'");
                $nbLoc = intval(collect($nbLoc)->sum('LOC_TOTAL'));


                $txcouvloc = DB::select("select TAUX_COUVERT_LOC from STATISTIQUE_SP_COUVERT where REGION ='" . $reg->NEW_REGION . "'");
                $tcount = count($txcouvloc);
                $txcouvloc = intval(collect($txcouvloc)->sum('TAUX_COUVERT_LOC'));
                $txcouvloc = round($txcouvloc / $tcount, 2);

                $txcouvpop = DB::select("select TAUX_COUVERT_POP from STATISTIQUE_SP_COUVERT where REGION ='" . $reg->NEW_REGION . "'");
                $tcount = count($txcouvpop);
                $txcouvpop = intval(collect($txcouvpop)->sum('TAUX_COUVERT_POP'));
                $txcouvpop = round($txcouvpop / $tcount, 2);

                $pop2gOr = DB::select("select * from couverture_reseaux where couverture_2G_orange = 1 and REGION ='" . $reg->NEW_REGION . "'");
                $nbcouv2gOr = count($pop2gOr);
                $pop2gOr = intval(collect($pop2gOr)->sum('population_totale'));

                $pop2gMtn = DB::select("select * from couverture_reseaux where couverture_2G_mtn = 1 and REGION ='" . $reg->NEW_REGION . "'");
                $nbcouv2gMtn = count($pop2gMtn);
                $pop2gMtn = intval(collect($pop2gMtn)->sum('population_totale'));

                $pop2gMoov = DB::select("select * from couverture_reseaux where couverture_2G_moov = 1 and REGION ='" . $reg->NEW_REGION . "'");
                $nbcouv2gMoov = count($pop2gMoov);
                $pop2gMoov = intval(collect($pop2gMoov)->sum('population_totale'));

                $pop3gOr = DB::select("select * from couverture_reseaux where couverture_3G_orange = 1 and REGION ='" . $reg->NEW_REGION . "'");
                $nbcouv3gOr = count($pop3gOr);
                $pop3gOr = intval(collect($pop3gOr)->sum('population_totale'));

                $pop3gMtn = DB::select("select * from couverture_reseaux where couverture_3G_mtn = 1 and REGION ='" . $reg->NEW_REGION . "'");
                $nbcouv3gMtn = count($pop3gMtn);
                $pop3gMtn = intval(collect($pop3gMtn)->sum('population_totale'));

                $pop3gMoov = DB::select("select * from couverture_reseaux where couverture_3G_moov = 1 and REGION ='" . $reg->NEW_REGION . "'");
                $nbcouv3gMoov = count($pop3gMoov);
                $pop3gMoov = intval(collect($pop3gMoov)->sum('population_totale'));

                $pop4gOr = DB::select("select * from couverture_reseaux where couverture_4G_orange = 1 and REGION ='" . $reg->NEW_REGION . "'");
                $nbcouv4gOr = count($pop4gOr);
                $pop4gOr = intval(collect($pop4gOr)->sum('population_totale'));

                $pop4gMtn = DB::select("select * from couverture_reseaux where couverture_4G_mtn = 1 and REGION ='" . $reg->NEW_REGION . "'");
                $nbcouv4gMtn = count($pop4gMtn);
                $pop4gMtn = intval(collect($pop4gMtn)->sum('population_totale'));

                $pop4gMoov = DB::select("select * from couverture_reseaux where couverture_4G_moov = 1 and REGION ='" . $reg->NEW_REGION . "'");
                $nbcouv4gMoov = count($pop4gMoov);
                $pop4gMoov = intval(collect($pop4gMoov)->sum('population_totale'));


                $content = $content . 'var ' . substr($reg->NEW_REGION, 0, 3) . ' = {
                    "region":"' . $reg->NEW_REGION . '",
                    "district":"' . $reg->DISTRICT . '",
                    "population_totale":' . $nbpops . ',
                    "popcouv":' . $nbpopcouv . ',
                    "nopopcouv":' . $nbnopopcouv . ',
                    "nbcouvloc":' . $nbLocCouv . ',
                    "nbnocouvloc":' . $nbNoLocCouv . ',
                    "nbloc":' . $nbLoc . ',
                    "txcouvloc":' . $txcouvloc . ',
                    "txpopcouv":' . $txcouvpop . ',
                    "nbcouv2gOr":' . $nbcouv2gOr . ',
                    "nbcouv2gMtn":' . $nbcouv2gMtn . ',
                    "nbcouv2gMoov":' . $nbcouv2gMoov . ',
                    "nbcouv3gOr":' . $nbcouv3gOr . ',
                    "nbcouv3gMtn":' . $nbcouv3gMtn . ',
                    "nbcouv3gMoov":' . $nbcouv3gMoov . ',
                    "nbcouv4gOr":' . $nbcouv4gOr . ',
                    "nbcouv4gMtn":' . $nbcouv4gMtn . ',
                    "nbcouv4gMoov":' . $nbcouv4gMoov . ',
                    "popOrange2G":' . $pop2gOr . ',
                    "popMtn2G":' . $pop2gMtn . ',
                    "popMoov2G":' . $pop2gMoov . ',
                    "popOrange3G":' . $pop3gOr . ',
                    "popMtn3G":' . $pop3gMtn . ',
                    "popMoov3G":' . $pop3gMoov . ',
                    "popOrange4G":' . $pop4gOr . ',
                    "popMtn4G":' . $pop4gMtn . ',
                    "popMoov4G":' . $pop4gMoov . ',
                };';
            } else if ($reg->NEW_REGION == "DISTRICT AUTONOME D'ABIDJAN") {
                $nbpops = DB::select("select POP_TOTAL from STATISTIQUE_SP_COUVERT where REGION = 'DISTRICT AUTONOME D''ABIDJAN'");
                $nbpops = intval(collect($nbpops)->sum('POP_TOTAL'));

                $nbpopcouv = DB::select("select NBRE_populaton_totale_COUVERTE from STATISTIQUE_SP_COUVERT where REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbpopcouv = intval(collect($nbpopcouv)->sum('NBRE_populaton_totale_COUVERTE'));

                $nbnopopcouv = DB::select("select POP_NON_COUVERT from STATISTIQUE_SP_COUVERT where REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbnopopcouv = intval(collect($nbnopopcouv)->sum('POP_NON_COUVERT'));




                $nbLocCouv = DB::select("select NBRE_localite_COUVERTE from STATISTIQUE_SP_COUVERT where REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbLocCouv = intval(collect($nbLocCouv)->sum('NBRE_localite_COUVERTE'));

                $nbNoLocCouv = DB::select("select LOC_NON_COUVERT from STATISTIQUE_SP_COUVERT where REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbNoLocCouv = intval(collect($nbNoLocCouv)->sum('LOC_NON_COUVERT'));

                $nbLoc = DB::select("select LOC_TOTAL from STATISTIQUE_SP_COUVERT where REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbLoc = intval(collect($nbLoc)->sum('LOC_TOTAL'));


                $txcouvloc = DB::select("select TAUX_COUVERT_LOC from STATISTIQUE_SP_COUVERT where REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $tcount = count($txcouvloc);
                $txcouvloc = intval(collect($txcouvloc)->sum('TAUX_COUVERT_LOC'));
                $txcouvloc = round($txcouvloc / $tcount, 2);

                $txcouvpop = DB::select("select TAUX_COUVERT_POP from STATISTIQUE_SP_COUVERT where REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $tcount = count($txcouvpop);
                $txcouvpop = intval(collect($txcouvpop)->sum('TAUX_COUVERT_POP'));
                $txcouvpop = round($txcouvpop / $tcount, 2);

                $pop2gOr = DB::select("select * from couverture_reseaux where couverture_2G_orange = 1 and REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbcouv2gOr = count($pop2gOr);
                $pop2gOr = intval(collect($pop2gOr)->sum('population_totale'));

                $pop2gMtn = DB::select("select * from couverture_reseaux where couverture_2G_mtn = 1 and REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbcouv2gMtn = count($pop2gMtn);
                $pop2gMtn = intval(collect($pop2gMtn)->sum('population_totale'));

                $pop2gMoov = DB::select("select * from couverture_reseaux where couverture_2G_moov = 1 and REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbcouv2gMoov = count($pop2gMoov);
                $pop2gMoov = intval(collect($pop2gMoov)->sum('population_totale'));

                $pop3gOr = DB::select("select * from couverture_reseaux where couverture_3G_orange = 1 and REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbcouv3gOr = count($pop3gOr);
                $pop3gOr = intval(collect($pop3gOr)->sum('population_totale'));

                $pop3gMtn = DB::select("select * from couverture_reseaux where couverture_3G_mtn = 1 and REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbcouv3gMtn = count($pop3gMtn);
                $pop3gMtn = intval(collect($pop3gMtn)->sum('population_totale'));

                $pop3gMoov = DB::select("select * from couverture_reseaux where couverture_3G_moov = 1 and REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbcouv3gMoov = count($pop3gMoov);
                $pop3gMoov = intval(collect($pop3gMoov)->sum('population_totale'));

                $pop4gOr = DB::select("select * from couverture_reseaux where couverture_4G_orange = 1 and REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbcouv4gOr = count($pop4gOr);
                $pop4gOr = intval(collect($pop4gOr)->sum('population_totale'));

                $pop4gMtn = DB::select("select * from couverture_reseaux where couverture_4G_mtn = 1 and REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbcouv4gMtn = count($pop4gMtn);
                $pop4gMtn = intval(collect($pop4gMtn)->sum('population_totale'));

                $pop4gMoov = DB::select("select * from couverture_reseaux where couverture_4G_moov = 1 and REGION ='DISTRICT AUTONOME D''ABIDJAN'");
                $nbcouv4gMoov = count($pop4gMoov);
                $pop4gMoov = intval(collect($pop4gMoov)->sum('population_totale'));


                $content = $content . 'var ' . substr($reg->NEW_REGION, 0, 3) . ' = {
                    "region":"' . $reg->NEW_REGION . '",
                    "district":"' . $reg->DISTRICT . '",
                    "population_totale":' . $nbpops . ',
                    "popcouv":' . $nbpopcouv . ',
                    "nopopcouv":' . $nbnopopcouv . ',
                    "nbcouvloc":' . $nbLocCouv . ',
                    "nbnocouvloc":' . $nbNoLocCouv . ',
                    "nbloc":' . $nbLoc . ',
                    "txcouvloc":' . $txcouvloc . ',
                    "txpopcouv":' . $txcouvpop . ',
                    "nbcouv2gOr":' . $nbcouv2gOr . ',
                    "nbcouv2gMtn":' . $nbcouv2gMtn . ',
                    "nbcouv2gMoov":' . $nbcouv2gMoov . ',
                    "nbcouv3gOr":' . $nbcouv3gOr . ',
                    "nbcouv3gMtn":' . $nbcouv3gMtn . ',
                    "nbcouv3gMoov":' . $nbcouv3gMoov . ',
                    "nbcouv4gOr":' . $nbcouv4gOr . ',
                    "nbcouv4gMtn":' . $nbcouv4gMtn . ',
                    "nbcouv4gMoov":' . $nbcouv4gMoov . ',
                    "popOrange2G":' . $pop2gOr . ',
                    "popMtn2G":' . $pop2gMtn . ',
                    "popMoov2G":' . $pop2gMoov . ',
                    "popOrange3G":' . $pop3gOr . ',
                    "popMtn3G":' . $pop3gMtn . ',
                    "popMoov3G":' . $pop3gMoov . ',
                    "popOrange4G":' . $pop4gOr . ',
                    "popMtn4G":' . $pop4gMtn . ',
                    "popMoov4G":' . $pop4gMoov . ',
                };';
            } else if ($reg->NEW_REGION == "N'ZI") {
                $nbpops = DB::select("select POP_TOTAL from STATISTIQUE_SP_COUVERT where REGION = 'N''ZI'");
                $nbpops = intval(collect($nbpops)->sum('POP_TOTAL'));

                $nbpopcouv = DB::select("select NBRE_populaton_totale_COUVERTE from STATISTIQUE_SP_COUVERT where REGION ='N''ZI'");
                $nbpopcouv = intval(collect($nbpopcouv)->sum('NBRE_populaton_totale_COUVERTE'));

                $nbnopopcouv = DB::select("select POP_NON_COUVERT from STATISTIQUE_SP_COUVERT where REGION ='N''ZI'");
                $nbnopopcouv = intval(collect($nbnopopcouv)->sum('POP_NON_COUVERT'));




                $nbLocCouv = DB::select("select NBRE_localite_COUVERTE from STATISTIQUE_SP_COUVERT where REGION ='N''ZI'");
                $nbLocCouv = intval(collect($nbLocCouv)->sum('NBRE_localite_COUVERTE'));

                $nbNoLocCouv = DB::select("select LOC_NON_COUVERT from STATISTIQUE_SP_COUVERT where REGION ='N''ZI'");
                $nbNoLocCouv = intval(collect($nbNoLocCouv)->sum('LOC_NON_COUVERT'));

                $nbLoc = DB::select("select LOC_TOTAL from STATISTIQUE_SP_COUVERT where REGION ='N''ZI'");
                $nbLoc = intval(collect($nbLoc)->sum('LOC_TOTAL'));


                $txcouvloc = DB::select("select TAUX_COUVERT_LOC from STATISTIQUE_SP_COUVERT where REGION ='N''ZI'");
                $tcount = count($txcouvloc);
                $txcouvloc = intval(collect($txcouvloc)->sum('TAUX_COUVERT_LOC'));
                $txcouvloc = round($txcouvloc / $tcount, 2);

                $txcouvpop = DB::select("select TAUX_COUVERT_POP from STATISTIQUE_SP_COUVERT where REGION ='N''ZI'");
                $tcount = count($txcouvpop);
                $txcouvpop = intval(collect($txcouvpop)->sum('TAUX_COUVERT_POP'));
                $txcouvpop = round($txcouvpop / $tcount, 2);

                $pop2gOr = DB::select("select * from couverture_reseaux where couverture_2G_orange = 1 and REGION ='N''ZI'");
                $nbcouv2gOr = count($pop2gOr);
                $pop2gOr = intval(collect($pop2gOr)->sum('population_totale'));

                $pop2gMtn = DB::select("select * from couverture_reseaux where couverture_2G_mtn = 1 and REGION ='N''ZI'");
                $nbcouv2gMtn = count($pop2gMtn);
                $pop2gMtn = intval(collect($pop2gMtn)->sum('population_totale'));

                $pop2gMoov = DB::select("select * from couverture_reseaux where couverture_2G_moov = 1 and REGION ='N''ZI'");
                $nbcouv2gMoov = count($pop2gMoov);
                $pop2gMoov = intval(collect($pop2gMoov)->sum('population_totale'));

                $pop3gOr = DB::select("select * from couverture_reseaux where couverture_3G_orange = 1 and REGION ='N''ZI'");
                $nbcouv3gOr = count($pop3gOr);
                $pop3gOr = intval(collect($pop3gOr)->sum('population_totale'));

                $pop3gMtn = DB::select("select * from couverture_reseaux where couverture_3G_mtn = 1 and REGION ='N''ZI'");
                $nbcouv3gMtn = count($pop3gMtn);
                $pop3gMtn = intval(collect($pop3gMtn)->sum('population_totale'));

                $pop3gMoov = DB::select("select * from couverture_reseaux where couverture_3G_moov = 1 and REGION ='N''ZI'");
                $nbcouv3gMoov = count($pop3gMoov);
                $pop3gMoov = intval(collect($pop3gMoov)->sum('population_totale'));

                $pop4gOr = DB::select("select * from couverture_reseaux where couverture_4G_orange = 1 and REGION ='N''ZI'");
                $nbcouv4gOr = count($pop4gOr);
                $pop4gOr = intval(collect($pop4gOr)->sum('population_totale'));

                $pop4gMtn = DB::select("select * from couverture_reseaux where couverture_4G_mtn = 1 and REGION ='N''ZI'");
                $nbcouv4gMtn = count($pop4gMtn);
                $pop4gMtn = intval(collect($pop4gMtn)->sum('population_totale'));

                $pop4gMoov = DB::select("select * from couverture_reseaux where couverture_4G_moov = 1 and REGION ='N''ZI'");
                $nbcouv4gMoov = count($pop4gMoov);
                $pop4gMoov = intval(collect($pop4gMoov)->sum('population_totale'));


                $content = $content . 'var ' . substr($reg->NEW_REGION, 0, 3) . ' = {
                    "region":"' . $reg->NEW_REGION . '",
                    "district":"' . $reg->DISTRICT . '",
                    "population_totale":' . $nbpops . ',
                    "popcouv":' . $nbpopcouv . ',
                    "nopopcouv":' . $nbnopopcouv . ',
                    "nbcouvloc":' . $nbLocCouv . ',
                    "nbnocouvloc":' . $nbNoLocCouv . ',
                    "nbloc":' . $nbLoc . ',
                    "txcouvloc":' . $txcouvloc . ',
                    "txpopcouv":' . $txcouvpop . ',
                    "nbcouv2gOr":' . $nbcouv2gOr . ',
                    "nbcouv2gMtn":' . $nbcouv2gMtn . ',
                    "nbcouv2gMoov":' . $nbcouv2gMoov . ',
                    "nbcouv3gOr":' . $nbcouv3gOr . ',
                    "nbcouv3gMtn":' . $nbcouv3gMtn . ',
                    "nbcouv3gMoov":' . $nbcouv3gMoov . ',
                    "nbcouv4gOr":' . $nbcouv4gOr . ',
                    "nbcouv4gMtn":' . $nbcouv4gMtn . ',
                    "nbcouv4gMoov":' . $nbcouv4gMoov . ',
                    "popOrange2G":' . $pop2gOr . ',
                    "popMtn2G":' . $pop2gMtn . ',
                    "popMoov2G":' . $pop2gMoov . ',
                    "popOrange3G":' . $pop3gOr . ',
                    "popMtn3G":' . $pop3gMtn . ',
                    "popMoov3G":' . $pop3gMoov . ',
                    "popOrange4G":' . $pop4gOr . ',
                    "popMtn4G":' . $pop4gMtn . ',
                    "popMoov4G":' . $pop4gMoov . ',
                };';
            }


            fseek($fichier, filesize('dataFiles/js/rdata.js'));
            fwrite($fichier, $content);
        }
        fclose($fichier);
    }

    public function selectUpdate($id){

        //ORANGE
        if ($id == 8){ //2G
            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_2G_orange','couverture_2G_orange', 'population_2G_orange', 'population_totale')->get();
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_orange', 1)->sum('population_2G_orange');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G') )*100;
            
            $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_orange', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;
            $this->updated = "orange2g";
        }
        if ($id == 9){ //3G
            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_3G_orange','couverture_3G_orange', 'population_couverte_3G_orange', 'population_totale')->get();
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_orange', 1)->sum('population_couverte_3G_orange');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_3G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_orange', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;
            $this->updated = "orange3g";
        }
        if ($id == 10){ //4G
            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_4G_orange', 'couverture_4G_orange', 'population_couverte_4G_orange', 'population_totale')->get();
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_orange', 1)->sum('population_couverte_4G_orange');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G') )*100;
            
            $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_orange', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;
            $this->updated = "orange4g";
        }

        //MTN
        if ($id == 11){ //2G
            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_2G_mtn','couverture_2G_mtn', 'population_2G_mtn', 'population_totale')->get();
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_mtn', 1)->sum('population_2G_mtn');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_mtn', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;
            $this->updated = "mtn2g";
        }
        if ($id == 12){ //3G
            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite','presence_3G_mtn','couverture_3G_mtn', 'population_couverte_3G_mtn', 'population_totale')->get();
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_mtn', 1)->sum('population_couverte_3G_mtn');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_3G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_mtn', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;
            $this->updated = "mtn3g";
        }
        if ($id == 13){ //4G
            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_4G_mtn','couverture_4G_mtn', 'population_couverte_4G_mtn', 'population_totale')->get();
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_mtn', 1)->sum('population_couverte_4G_mtn');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_mtn', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;
            $this->updated = "mtn4g";
        }

        //MOOV
        if ($id == 14){ //2G
            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_2G_moov','couverture_2G_moov', 'population_2G_moov', 'population_totale')->get();
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_moov', 1)->sum('population_2G_moov');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_moov', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;
            $this->updated = "moov2g";
        }
        if ($id == 15){ //3G
            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_3G_moov','couverture_3G_moov', 'population_couverte_3G_moov', 'population_totale')->get();
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_moov', 1)->sum('population_couverte_3G_moov');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_3G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_moov', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;
            $this->updated = "moov3g";
        }
        if ($id == 16){ //4G
            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_4G_moov','couverture_4G_moov', 'population_couverte_4G_moov', 'population_totale')->get();
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_moov', 1)->sum('population_couverte_4G_moov');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_moov', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;
            $this->updated = "moov4g";
        }
    }

    public function selectEditUpdate($id, $endroit){

        // ORANGE
        if($id == 8) { //2G
            $modif = DB::table('couverture_reseaux')->where('localite', $endroit)->first();
            $this->local = $endroit;
            $this->presence = $modif->presence_2G_orange;
            $this->couverture = $modif->couverture_2G_orange;
            $this->pop2G = $modif->population_2G_orange;
            $this->popTot = $modif->population_totale;
            $this->updatedCrud = "update";
        }
        if ($id == 9) { //3G
            //$this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'couverture_2G_orange', 'population_2G_orange')->get();
            $modif = DB::table('couverture_reseaux')->where('localite', $endroit)->first();
            $this->local = $endroit;
            $this->presence = $modif->presence_3G_orange;
            $this->couverture = $modif->couverture_3G_orange;
            $this->pop2G = $modif->population_couverte_3G_orange;
            $this->popTot = $modif->population_totale;
            $this->updatedCrud = "update";
        }
        if ($id == 10) { //4G
            //$this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'couverture_2G_orange', 'population_2G_orange')->get();
            $modif = DB::table('couverture_reseaux')->where('localite', $endroit)->first();
            $this->local = $endroit;
            $this->presence = $modif->presence_3G_orange;
            $this->couverture = $modif->couverture_3G_orange;
            $this->pop2G = $modif->population_couverte_3G_orange;
            $this->popTot = $modif->population_totale;
            $this->updatedCrud = "update";
        }

        // MTN
        if($id == 11) { //2G
            //$this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'couverture_2G_orange', 'population_2G_orange')->get();
            $modif = DB::table('couverture_reseaux')->where('localite', $endroit)->first();
            $this->local = $endroit;
            $this->presence = $modif->presence_2G_mtn;
            $this->couverture = $modif->couverture_2G_mtn;
            $this->pop2G = $modif->population_2G_mtn;
            $this->popTot = $modif->population_totale;
            $this->updatedCrud = "update";
        }
        if ($id == 12) { //3G
            //$this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'couverture_2G_orange', 'population_2G_orange')->get();
            $modif = DB::table('couverture_reseaux')->where('localite', $endroit)->first();
            $this->local = $endroit;
            $this->presence = $modif->presence_3G_mtn;
            $this->couverture = $modif->couverture_3G_mtn;
            $this->pop2G = $modif->population_couverte_3G_mtn;
            $this->popTot = $modif->population_totale;
            $this->updatedCrud = "update";
        }
        if ($id == 13) { //4G
            //$this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'couverture_2G_orange', 'population_2G_orange')->get();
            $modif = DB::table('couverture_reseaux')->where('localite', $endroit)->first();
            $this->local = $endroit;
            $this->presence = $modif->presence_4G_mtn;
            $this->couverture = $modif->couverture_4G_mtn;
            $this->pop2G = $modif->population_couverte_4G_mtn;
            $this->popTot = $modif->population_totale;
            $this->updatedCrud = "update";
        }

        // MOOV
        if($id == 14) { //2G
            //$this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'couverture_2G_orange', 'population_2G_orange')->get();
            $modif = DB::table('couverture_reseaux')->where('localite', $endroit)->first();
            $this->local = $endroit;
            $this->presence = $modif->presence_2G_moov;
            $this->couverture = $modif->couverture_2G_moov;
            $this->pop2G = $modif->population_2G_moov;
            $this->popTot = $modif->population_totale;
            $this->updatedCrud = "update";
        }
        if ($id == 15) { //3G
            $modif = DB::table('couverture_reseaux')->where('localite', $endroit)->first();
            $this->local = $endroit;
            $this->presence = $modif->presence_3G_moov;
            $this->couverture = $modif->couverture_3G_moov;
            $this->pop2G = $modif->population_couverte_3G_moov;
            $this->popTot = $modif->population_totale;
            $this->updatedCrud = "update";
        }
        if ($id == 16) { //4G
            $modif = DB::table('couverture_reseaux')->where('localite', $endroit)->first();
            $this->local = $endroit;
            $this->presence = $modif->presence_4G_moov;
            $this->couverture = $modif->couverture_4G_moov;
            $this->pop2G = $modif->population_couverte_4G_moov;
            $this->popTot = $modif->population_totale;
            $this->updatedCrud = "update";
        }
    }

    public function retourUpdate($id)
    {
        //ORANGE
        if ($id == 8) { //2G
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_orange', 1)->sum('population_2G_orange');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G') )*100;
            
            $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_orange', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;

            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_2G_orange','couverture_2G_orange', 'population_2G_orange', 'population_totale')->get();
        }
        if ($id == 9) { //3G
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_orange', 1)->sum('population_couverte_3G_orange');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_3G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_orange', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;

            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_3G_orange','couverture_3G_orange', 'population_couverte_3G_orange', 'population_totale')->get();
        }
        if ($id == 10) { //4G
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_orange', 1)->sum('population_couverte_4G_orange');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G') )*100;
            
            $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_orange', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;

            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_4G_orange','couverture_4G_orange', 'population_couverte_4G_orange', 'population_totale')->get();
        }

        //MTN
        if ($id == 11) { //2G
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_mtn', 1)->sum('population_2G_mtn');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_mtn', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;

            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_2G_mtn','couverture_2G_mtn', 'population_2G_mtn', 'population_totale')->get();
        }
        if ($id == 12) { //3G
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_mtn', 1)->sum('population_couverte_3G_mtn');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_3G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_mtn', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;

            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_3G_mtn','couverture_3G_mtn', 'population_couverte_3G_mtn', 'population_totale')->get();
        }
        if ($id == 13) { //4G
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_mtn', 1)->sum('population_couverte_4G_mtn');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_mtn', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;

            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_4G_mtn' ,'couverture_4G_mtn', 'population_couverte_4G_mtn', 'population_totale')->get();
        }

        //MOOV
        if ($id == 14) { //2G
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_2G_moov', 1)->sum('population_2G_moov');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverture_2G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_2G_moov', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;

            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_2G_moov','couverture_2G_moov', 'population_2G_moov', 'population_totale')->get();
        }
        if ($id == 15) { //3G
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_3G_moov', 1)->sum('population_couverte_3G_moov');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_3G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_3G_moov', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;

            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_3G_moov','couverture_3G_moov', 'population_couverte_3G_moov', 'population_totale')->get();
        }
        if ($id == 16) { //4G
            $this->popCo = DB::table('couverture_reseaux')->where('couverture_4G_moov', 1)->sum('population_couverte_4G_moov');
            $this->popPercent = ($this->popCo/DB::table('couverture_reseaux')->sum('synthese_population_couverte_4G') )*100;

            $this->loCo = DB::table('couverture_reseaux')->where('couverture_4G_moov', 1)->count();
            $this->loPercent= ($this->loCo/8518)*100;

            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'presence_4G_moov','couverture_4G_moov', 'population_couverte_4G_moov', 'population_totale')->get();
        }
        $this->alertUpdatedMessage = '';
        $this->alertUpdatedColor = '';
        
        $this->updatedCrud = "view";
    }

    public function retourAccueil(){
        $this->updated = "dashboard";
    }

    public function validateUpdate($id)
    {
        //ORANGE
        if ($id == 8) { //2G
            $test = null;
            if ($this->couverture == 1) {
                $test = 'OUI';
                DB::table('couverture_reseaux')
                ->where('localite', $this->local)
                    ->update(['presence_2G_orange' => $this->presence, 'couverture_2G_orange' => 1, 'population_2G_orange' => $this->pop2G]);

                DB::table('memoire_tampon')
                    ->insert(['operateur' => 'orange', 'demandeur' => Auth::user()->email, 'technologie' => '2G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => 1, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' =>(new \DateTime()) ]);
              
            } else {
                $test = 'NON';
                $this->pop2G = 0;
                DB::table('couverture_reseaux')
                ->where('localite', $this->local)
                    ->update(['presence_2G_orange' =>0, 'couverture_2G_orange' => 0, 'population_2G_orange' => 0]);

                DB::table('memoire_tampon')
                    ->insert(['operateur' => 'orange', 'demandeur' => Auth::user()->email, 'technologie' => '2G', 'localite' => $this->local, 'presence' => 0, 'couverture' => 0, 'population_couverte' => 0, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' =>(new \DateTime())]);
              
            }

            $this->alertUpdatedMessage = "Mise à jour effectué { Localité : " . $this->local . " ; Couverture 2G Orange : " . $test . " ; population 2G Orange : " . $this->pop2G . "}";
            $this->alertUpdatedColor = "alert-success";
            
        }
        if ($id == 9) { //3G
            $test = null;
            if ($this->couverture == 1) {
                $test = 'OUI';
                DB::table('couverture_reseaux')
                ->where('localite', $this->local)
                    ->update(['presence_3G_orange'=> $this->presence,'couverture_3G_orange' => 1, 'population_couverte_3G_orange' => $this->pop2G]);

                DB::table('memoire_tampon')
                    ->insert(['operateur' => 'orange', 'demandeur' => Auth::user()->email, 'technologie' => '3G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => 1, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' =>(new \DateTime())]);
              
            } else {
                $test = 'NON';
                $this->pop2G = 0;
                DB::table('couverture_reseaux')
                ->where('localite', $this->local)
                    ->update(['presence_3G_orange' => 0, 'couverture_3G_orange' => 0, 'population_couverte_3G_orange' => 0]);

                    DB::table('memoire_tampon')
                    ->insert(['operateur' => 'orange', 'demandeur' => Auth::user()->email, 'technologie' => '3G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => 1, 'population_couverte' => 0, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' =>(new \DateTime())]);
              
            }

            $this->alertUpdatedMessage = "Mise à jour effectué { Localité : " . $this->local . " ; Couverture 3G Orange : " . $test . " ; population 3G Orange : " . $this->pop2G . "}";
            $this->alertUpdatedColor = "alert-success";
        }
        if ($id == 10) { //4G
            $test = null;
            if ($this->couverture == 1) {
                $test = 'OUI';
                DB::table('couverture_reseaux')
                    ->where('localite', $this->local)
                    ->update(['presence_4G_orange' => $this->presence, 'couverture_4G_orange' => 1, 'population_couverte_4G_orange' => $this->pop2G]);

                DB::table('memoire_tampon')
                    ->insert(['operateur' => 'orange', 'demandeur' => Auth::user()->email, 'technologie' => '4G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => 1, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
              
            } else {
                $test = 'NON';
                $this->pop2G = 0;
                DB::table('couverture_reseaux')
                    ->where('localite', $this->local)
                    ->update(['presence_4G_orange' => 0, 'couverture_4G_orange' => 0, 'population_couverte_4G_orange' => 0]);
                DB::table('memoire_tampon')
                    ->insert(['operateur' => 'orange', 'demandeur' => Auth::user()->email, 'technologie' => '4G', 'localite' => $this->local, 'presence' => 0, 'couverture' => 0, 'population_couverte' => 0, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
            }

            $this->alertUpdatedMessage = "Mise à jour effectué { Localité : " . $this->local . " ; Couverture 4G Orange : " . $test . " ; population 4G Orange : " . $this->pop2G . "}";
            $this->alertUpdatedColor = "alert-success";
        }

        //MTN
        if ($id == 11) { //2G
            $test = null;
            if ($this->couverture == 1) {
                $test = 'OUI';
                DB::table('couverture_reseaux')
                    ->where('localite', $this->local)
                    ->update(['presence_2G_mtn' => $this->presence, 'couverture_2G_mtn' => 1, 'population_2G_mtn' => $this->pop2G]);

                DB::table('memoire_tampon')
                    ->insert(['operateur' => 'mtn', 'demandeur' => Auth::user()->email, 'technologie' => '2G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => 1, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
              
            } else {
                $test = 'NON';
                $this->pop2G = 0;
                DB::table('couverture_reseaux')
                    ->where('localite', $this->local)
                    ->update(['presence_2G_mtn' => 0, 'couverture_2G_mtn' => 0, 'population_2G_mtn' => 0]);

                DB::table('memoire_tampon')
                    ->insert(['operateur' => 'mtn', 'demandeur' => Auth::user()->email, 'technologie' => '2G', 'localite' => $this->local, 'presence' => 0, 'couverture' => 0, 'population_couverte' => 0, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
              
            }

            $this->alertUpdatedMessage = "Mise à jour effectué { Localité : " . $this->local . " ; Couverture 2G MTN : " . $test . " ; population 2G MTN: " . $this->pop2G . "}";
            $this->alertUpdatedColor = "alert-success";
        }
        if ($id == 12
        ) { //3G
            $test = null;
            if ($this->couverture == 1) {
                $test = 'OUI';
                DB::table('couverture_reseaux')
                ->where('localite', $this->local)
                ->update(['presence_3G_mtn' => $this->presence, 'couverture_3G_mtn' => 1, 'population_couverte_3G_mtn' => $this->pop2G]);

                DB::table('memoire_tampon')
                ->insert(['operateur' => 'mtn', 'demandeur' => Auth::user()->email, 'technologie' => '3G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => 1, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
            } else {
                $test = 'NON';
                $this->pop2G = 0;
                DB::table('couverture_reseaux')
                    ->where('localite', $this->local)
                    ->update(['presence_3G_mtn' => 0, 'couverture_3G_mtn' => 0, 'population_couverte_3G_mtn' => 0]);

                DB::table('memoire_tampon')
                    ->insert(['operateur' => 'mtn', 'demandeur' => Auth::user()->email, 'technologie' => '3G', 'localite' => $this->local, 'presence' => 0, 'couverture' => 0, 'population_couverte' => 0, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
                
            }

            $this->alertUpdatedMessage = "Mise à jour effectué { Localité : " . $this->local . " ; Couverture 3G MTN : " . $test . " ; population 3G MTN : " . $this->pop2G . "}";
            $this->alertUpdatedColor = "alert-success";
        }
        if ($id == 13) { //4G
            $test = null;
            if ($this->couverture == 1) {
                $test = 'OUI';
                DB::table('couverture_reseaux')
                ->where('localite', $this->local)
                ->update(['presence_4G_mtn' => $this->presence, 'couverture_4G_mtn' => 1, 'population_couverte_4G_mtn' => $this->pop2G]);
                DB::table('memoire_tampon')
                ->insert(['operateur' => 'mtn', 'demandeur' => Auth::user()->email, 'technologie' => '4G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => 1, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
                
            } else {
                $test = 'NON';
                $this->pop2G = 0;
                DB::table('couverture_reseaux')
                    ->where('localite', $this->local)
                    ->update(['presence_4G_mtn' => 0, 'couverture_4G_mtn' => 0, 'population_couverte_4G_mtn' => 0]);
                DB::table('memoire_tampon')
                    ->insert(['operateur' => 'mtn', 'demandeur' => Auth::user()->email, 'technologie' => '4G', 'localite' => $this->local, 'presence' => 0, 'couverture' => 0, 'population_couverte' => 0, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
                    
            }

            $this->alertUpdatedMessage = "Mise à jour effectué { Localité : " . $this->local . " ; Couverture 4G MTN : " . $test . " ; population 4G MTN : " . $this->pop2G . "}";
            $this->alertUpdatedColor = "alert-success";
        }

        //MOOV
        if ($id == 14) { //2G
            $test = null;
            if ($this->couverture == 1) {
                $test = 'OUI';
                DB::table('couverture_reseaux')
                ->where('localite', $this->local)
                    ->update(['presence_2G_moov' => $this->presence, 'couverture_2G_moov' => 1, 'population_2G_moov' => $this->pop2G]);
                DB::table('memoire_tampon')
                ->insert(['operateur' => 'moov', 'demandeur' => Auth::user()->email, 'technologie' => '2G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => 1, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
            } else {
                $test = 'NON';
                $this->pop2G = 0;
                DB::table('couverture_reseaux')
                ->where('localite', $this->local)
                    ->update(['presence_2G_moov' => 0, 'couverture_2G_moov' => 0, 'population_2G_moov' => 0]);
                DB::table('memoire_tampon')
                ->insert(['operateur' => 'moov', 'demandeur' => Auth::user()->email, 'technologie' => '2G', 'localite' => $this->local, 'presence' => 0, 'couverture' => 0, 'population_couverte' => 0, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
            }

            $this->alertUpdatedMessage = "Mise à jour effectué { Localité : " . $this->local . " ; Couverture 2G MOOV : " . $test . " ; population 2G MOOV: " . $this->pop2G . "}";
            $this->alertUpdatedColor = "alert-success";
        }
        if ($id == 15) { //3G
            $test = null;
            if ($this->couverture == 1) {
                $test = 'OUI';
                DB::table('couverture_reseaux')
                ->where('localite', $this->local)
                    ->update(['presence_3G_moov' => $this->presence, 'couverture_3G_moov' => 1, 'population_couverte_3G_moov' => $this->pop2G]);
                DB::table('memoire_tampon')
                ->insert(['operateur' => 'moov', 'demandeur' => Auth::user()->email, 'technologie' => '3G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => 1, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
            } else {
                $test = 'NON';
                $this->pop2G = 0;
                DB::table('couverture_reseaux')
                    ->where('localite', $this->local)
                    ->update(['presence_3G_moov' => 0, 'couverture_3G_moov' => 0, 'population_couverte_3G_moov' => 0]);
                DB::table('memoire_tampon')
                    ->insert(['operateur' => 'moov', 'demandeur' => Auth::user()->email, 'technologie' => '3G', 'localite' => $this->local, 'presence' => 0, 'couverture' => 0, 'population_couverte' => 0, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
            }

            $this->alertUpdatedMessage = "Mise à jour effectué { Localité : " . $this->local . " ; Couverture 3G MOOV : " . $test . " ; population 3G MOOV : " . $this->pop2G . "}";
            $this->alertUpdatedColor = "alert-success";
        }
        if ($id == 16) { //4G
            $test = null;
            if ($this->couverture == 1) {
                $test = 'OUI';
                DB::table('couverture_reseaux')
                ->where('localite', $this->local)
                    ->update(['presence_4G_moov' => $this->presence, 'couverture_4G_moov' => 1, 'population_couverte_4G_moov' => $this->pop2G]);

                DB::table('memoire_tampon')
                ->insert(['operateur' => 'moov', 'demandeur' => Auth::user()->email, 'technologie' => '4G', 'localite' => $this->local, 'presence' => $this->presence, 'couverture' => 1, 'population_couverte' => $this->pop2G, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
            } else {
                $test = 'NON';
                $this->pop2G = 0;
                DB::table('couverture_reseaux')
                    ->where('localite', $this->local)
                    ->update(['presence_4G_moov' => 0, 'couverture_4G_moov' => 0, 'population_couverte_4G_moov' => 0]);

                DB::table('memoire_tampon')
                    ->insert(['operateur' => 'moov', 'demandeur' => Auth::user()->email, 'technologie' => '4G', 'localite' => $this->local, 'presence' => 0, 'couverture' => 0, 'population_couverte' => 0, 'population_totale' => $this->popTot, 'statut' => 1, 'created_at' => (new \DateTime()), 'updated_at' => (new \DateTime())]);
            }

            $this->alertUpdatedMessage = "Mise à jour effectué { Localité : " . $this->local . " ; Couverture 4G MOOV : " . $test . " ; population 4G MOOV : " . $this->peuple . "}";
            $this->alertUpdatedColor = "alert-success";
        }
    }

    public function updateData($id)
    {
        if ($id == 0) {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_2G_orange = 0 and couverture_2G_mtn = 0 and couverture_2G_moov = 0 and couverture_3G_orange = 0 and couverture_3G_mtn = 0 and couverture_3G_moov = 0 and couverture_4G_orange = 0 and couverture_4G_mtn = 0 and couverture_4G_moov = 0');
        }
        if ($id == 1) //Toute les données
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_2G_orange = 1 or couverture_2G_mtn = 1 or couverture_2G_moov = 1 or couverture_3G_orange = 1 or couverture_3G_mtn = 1 or couverture_3G_moov = 1 or couverture_4G_orange = 1 or couverture_4G_mtn = 1 or couverture_4G_moov = 1');
        } elseif ($id == 2) //Donnees 2G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_2G_mtn = 1 or couverture_2G_orange = 1 or couverture_2G_moov = 1');
        } elseif ($id == 3) //Donnees 3G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_3G_mtn = 1 or couverture_3G_orange = 1 or couverture_3G_moov = 1');
        } elseif ($id == 4) //Donnees 4G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_4G_mtn = 1 or couverture_4G_orange = 1 or couverture_4G_moov = 1');
        } elseif ($id == 5) //Donnees Orange
        {
            $this->datas = DB::select('select distinct * from couverture_reseaux where couverture_2G_orange = 1 or couverture_3G_orange = 1 or couverture_4G_orange = 1');
        } elseif ($id == 6) //Donnees Mtn
        {
            $this->datas = DB::select('select distinct  * from couverture_reseaux where couverture_2G_mtn = 1 or couverture_3G_mtn = 1 or couverture_4G_mtn = 1');
        } elseif ($id == 7) //Donnees Moov
        {
            $this->datas = DB::select('select distinct * from couverture_reseaux where couverture_2G_moov = 1 or couverture_3G_moov = 1 or couverture_4G_moov = 1');
        } elseif ($id == 8) //Donnees Orange 2G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_2G_orange = 1');
        } elseif ($id == 9) //Donnees Orange 3G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_3G_orange = 1');
        } elseif ($id == 10) //Donnees Orange 4G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_4G_orange = 1');
        } elseif ($id == 11) //Donnees Mtn 2G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_2G_mtn = 1');
        } elseif ($id == 12) //Donnees Mtn 3G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_3G_mtn = 1');
        } elseif ($id == 13) //Donnees Mtn 4G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_4G_mtn = 1');
        } elseif ($id == 14) //Donnees Moov 2G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_2G_moov = 1');
        } elseif ($id == 15) //Donnees Moov 3G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_3G_moov = 1');
        } elseif ($id == 16) //Donnees Moov 4G
        {
            $this->datas = DB::select('select * from couverture_reseaux where couverture_4G_moov = 1');
        } elseif ($id == 17) {
            $this->datas = DB::select('select * from couverture_reseaux');
        } elseif ($id == 18) {
            $this->datas = DB::select('select * from couverture_reseaux');
        }

        $content = '{"type": "Feature","properties": {"code_loc":"","localite":"","region":"","departement":"","sous_prefect":"","pop":0,"pop2gOr":0,"pop2gMtn":0,"pop2gMoov":0,"pop3gOr":0,"pop3gMtn":0,"pop3gMoov":0,"pop4gOr":0,"pop4gMtn":0,"pop4gMoov":0},"geometry": {"coordinates": [0,0],"type": "Point"}}';

        foreach ($this->datas as $d) {
            $pop = $d->population_totale;
            $pop2gOr = $d->population_2G_orange;
            $pop2gMtn = $d->population_2G_mtn;
            $pop2gMoov = $d->population_2G_moov;
            $pop3gOr = $d->population_couverte_3G_orange;
            $pop3gMtn = $d->population_couverte_3G_mtn;
            $pop3gMoov = $d->population_couverte_3G_moov;
            $pop4gOr = $d->population_couverte_4G_mtn;
            $pop4gMtn = $d->population_couverte_4G_orange;
            $pop4gMoov = $d->population_couverte_4G_moov;

            $var = array($pop, $pop2gOr, $pop2gMtn, $pop2gMoov, $pop3gOr, $pop3gMtn, $pop3gMoov, $pop4gOr, $pop4gMtn, $pop4gMoov);

            $vars = array();

            //Transformer les 0.000000000000000000000000000000000000 en 0

            foreach ($var as $v) {
                if ($v == 0) {
                    $v = 0;
                }
                $vars[] = $v;
            }

            if ($id == 6 || $id == 11 || $id == 12 || $id == 13) {
                $lng = $d->longitude != null ? $d->longitude + 0.0015 : 4;
                $lat = $d->latitude != null ? $d->latitude : 4;
            } elseif ($id == 7 || $id == 14 || $id == 15 || $id == 16) {
                $lng = $d->longitude != null ? $d->longitude - 0.0015 : 4;
                $lat = $d->latitude != null ? $d->latitude : 4;
            } else {
                $lng = $d->longitude != null ? $d->longitude : 4;
                $lat = $d->latitude != null ? $d->latitude : 4;
            }
            $content = $content . ',{"type": "Feature","properties": {"code_loc": "' . $d->code_localite . '","localite":"' . $d->localite . '","departement":"' . $d->departement . '","sous_prefect":"' . $d->sous_prefecture . '","pop":' . $vars[0] . ',"pop2gOr":' . $vars[1] . ',"pop2gMtn":' . $vars[2] . ',"pop2gMoov":' . $vars[3] . ',"pop3gOr":' . $vars[4] . ',"pop3gMtn":' . $vars[5] . ',"pop3gMoov":' . $vars[6] . ',"pop4gOr":' . $vars[7] . ',"pop4gMtn":' . $vars[8] . ',"pop4gMoov":' . $vars[9] . '},"geometry": {"coordinates": [' . round(floatval($lng), 6) . ',' . round(floatval($lat), 6) . '],"type": "Point"}}';
        }

        $content = '{"type": "FeatureCollection","features": [' . $content . ']}';

        if ($id == 0) // NO DATA
        {
            file_put_contents('dataFiles/geojson/nodata.geojson', $content);
            $this->last_action = "Localités non couvertes";
        } elseif ($id == 1) // ALL DATA
        {
            file_put_contents('dataFiles/geojson/alldata.geojson', $content);
            $this->last_action = "Toute les données";
        } elseif ($id == 2) //2G
        {
            file_put_contents('dataFiles/geojson/data2G.geojson', $content);
        } elseif ($id == 3) //3G
        {
            file_put_contents('dataFiles/geojson/data3G.geojson', $content);
        } elseif ($id == 4) //4G
        {
            file_put_contents('dataFiles/geojson/data4G.geojson', $content);
        } elseif ($id == 5) //ORANGE
        {
            file_put_contents('dataFiles/geojson/dataOrange.geojson', $content);
        } elseif ($id == 6) //MTN
        {
            file_put_contents('dataFiles/geojson/dataMtn.geojson', $content);
        } elseif ($id == 7) //MOOV
        {
            file_put_contents('dataFiles/geojson/dataMoov.geojson', $content);
        } elseif ($id == 8) //2G ORANGE
        {
            file_put_contents('dataFiles/geojson/dataOrange2G.geojson', $content);
        } elseif ($id == 9) //3G ORANGE
        {
            file_put_contents('dataFiles/geojson/dataOrange3G.geojson', $content);
        } elseif ($id == 10) //4G ORANGE
        {
            file_put_contents('dataFiles/geojson/dataOrange4G.geojson', $content);
        } elseif ($id == 11) //2G MTN
        {
            file_put_contents('dataFiles/geojson/dataMtn2G.geojson', $content);
        } elseif ($id == 12) //3G MTN
        {
            file_put_contents('dataFiles/geojson/dataMtn3G.geojson', $content);
        } elseif ($id == 13) //4G MTN
        {
            file_put_contents('dataFiles/geojson/dataMtn4G.geojson', $content);
        } elseif ($id == 14) //2G MOOV
        {
            file_put_contents('dataFiles/geojson/dataMoov2G.geojson', $content);
        } elseif ($id == 15) //3G MOOV
        {
            file_put_contents('dataFiles/geojson/dataMoov3G.geojson', $content);
        } elseif ($id == 16) //4G MOOV
        {
            file_put_contents('dataFiles/geojson/dataMoov4G.geojson', $content);
        } elseif ($id == 17) {
            file_put_contents('dataFiles/geojson/dataWhiteArea.geojson', $content);
        } elseif ($id == 18) {
            file_put_contents('dataFiles/geojson/dataGreat.geojson', $content);
        }


        $this->success = true;
    }

    public function updateStationData($id)
    {
        $datas = null;

        if ($id == 1) {
            $datas = DB::select("select * from TYPE_STATION where technologies = '2G'");
        } elseif ($id == 2) {
            $datas = DB::select("select * from TYPE_STATION where technologies = '3G'");
        } elseif ($id == 3) {
            $datas = DB::select("select * from TYPE_STATION where technologies = '4G FDD'");
        }

        $content = '{"type": "Feature","properties": {"code":"","Site_Name":"","region":"","district":"","technologie":0},"geometry": {"coordinates": [0,0],"type": "Point"}}';

        foreach ($datas as $d) {
            $code = $d->Cell_Id;
            $s_name = $d->Site_Name;
            $region = $d->Région;
            $distr = $d->DISTRICT;
            $tech = $d->technologies;
            $lng = null;
            $lat = null;


            if ($id == 1) {
                $lng = $d->longitude != null ? $d->longitude + 0.00015 : 4;
                $lat = $d->latitude != null ? $d->latitude : 4;
            } elseif ($id == 2) {
                $lng = $d->longitude != null ? $d->longitude : 4;
                $lat = $d->latitude != null ? $d->latitude : 4;
            } else {
                $lng = $d->longitude != null ? $d->longitude - 0.00015 : 4;
                $lat = $d->latitude != null ? $d->latitude : 4;
            }

            $content =  $content . ',{"type": "Feature","properties": {"code":"' . $code . '","Site_Name":"' . $s_name . '","region":"' . $region . '","district":"' . $distr . '","technologie":"' . $tech . '"},"geometry": {"coordinates": [' . round($lng, 6) . ',' . round($lat, 6) . '],"type": "Point"}}';
        }

        $content = '{"type": "FeatureCollection","features": [' . $content . ']}';

        if ($id == 1) {
            file_put_contents('dataFiles/geojson/station2Gdata.geojson', $content);
            $this->last_action = "Sations 2G mobiles";
        } else if ($id == 2) {
            file_put_contents('dataFiles/geojson/station3Gdata.geojson', $content);
            $this->last_action = "Sations 3G mobiles";
        } else if ($id == 3) {
            file_put_contents('dataFiles/geojson/station4Gdata.geojson', $content);
            $this->last_action = "Sations 4G mobiles";
        }

        dd('ok');
    }
}
