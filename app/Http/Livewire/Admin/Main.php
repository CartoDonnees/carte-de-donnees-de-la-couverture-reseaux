<?php

namespace App\Http\Livewire\Admin;

use App\Models\Answer;
use App\Models\Comment;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\Crypt;

class Main extends Component
{
    use WithFileUploads;

    public $locCouvs;
    public $datas;
    public $success;
    public $last_action;
    public $history;
    public $users;
    public $comments;
    public $answers;
    public $couvertureReseau;
    public $action = 'main';
    

    //User form
    public $userId;
    public $name;
    public $firstName;
    public $role;
    public $email;
    public $alertMessage;
    public $alertColor;

    public $userCrud = "view";
    public $userEdit;

    //Comment form

    public $commentCrud = "nothing";
    public $commentEdit;
    public $commentDate;
    public $commentText;
    public $commentUser;
    public $commentId;
    public $alertCommentColor;
    public $alertCommentMessage;

    // Updated form

    public $updated = "dashboard";
    public $local;
    public $drap;
    public $peuple;
    public $updatedCrud = "view";
    public $alertUpdatedMessage;
    public $alertUpdatedColor;


    public function mount()
    {
        //$this->pops = collect($alldata)->sum('population_totale');
        //$this->history = Sess::all();
        $this->users = User::orderBy('role', 'ASC')->orderBy('name', 'DESC')->get();
        // $this->comments = Comment::select('comments.*', 'users.name')
        //     ->join('users', 'comments.user_id', '=', 'users.id')
        //     ->orderBy('created_at', 'DESC')
        //     ->get();
        
    }

    // public function updated()
    // {
    //     $this->users = User::orderBy('role', 'ASC')->orderBy('name', 'DESC') ->get();
    //     $this->comments = Comment::select('comments.*', 'users.name')
    //                                             ->join('users', 'comments.user_id', '=', 'users.id')
    //                                             ->orderBy('created_at', 'DESC')
    //                                             ->get();
    // }


    // public function submitUsers()
    // {
    //     $this->alertColor = null;
    //     $this->alertMessage = null;
    //     $this->userId = null;
    //     $u_name = $u_email = $u_role = $u_password = null;

    //     if ($this->name != null and $this->firstName != null) {
    //         $u_name = $this->name . ' ' . $this->firstName;
    //     } else {
    //         $this->alertColor = "alert-danger";
    //         $this->alertMessage = "veuillez entrer les noms et prénoms";
    //     }

    //     if ($this->email != null) {
    //         if (User::where('email', $this->email)->exists()) {

    //             $this->alertColor = "alert-danger";
    //             $this->alertMessage = "Mail déja utilisé";
    //         } else {
    //             $u_email = $this->email;
    //         }
    //     } else {
    //         $this->alertColor = "alert-danger";
    //         $this->alertMessage = "veuillez entrer l'adresse mail";
    //     }

    //     if ($this->role != null) {
    //         $u_role = $this->role;
    //     } else {
    //         $this->alertColor = "alert-danger";
    //         $this->alertMessage = "veuillez choisir l'agence";
    //     }

    //     if ($this->password != null) {
    //         $u_password = $this->password;
    //     } else {
    //         $this->alertColor = "alert-danger";
    //         $this->alertMessage = "veuillez entrer le mot de passe";
    //     }

    //     if ($u_name != null and $u_role != null and $u_email != null and $u_password != null) {
    //         User::create([
    //             'name' => $u_name,
    //             'role' => $u_role,
    //             'email' => $u_email,
    //             'password' =>  Crypt::encryptString($u_password),
    //             ]);


    //         $this->alertColor = "alert-success";
    //         $this->alertMessage = "Ajout effectué";

    //         $this->name = '';
    //         $this->firstName = '';
    //         $this->email = '';
    //         $this->password = '';
    //     }
    // }

    public function selectViewComment($id){
        
        $this->commentEdit = Comment::find($id);
        $this->commentDate = $this->commentEdit->created_at;
        $this->commentText = $this->commentEdit->comment;
        $this->commentUser = User::find($this->commentEdit->user_id)->email;
        $this->commentCrud = "view";

    }

    public function retourComment(){
        $this->alertCommentColor = null;
        $this->alertcommentMessage = null;
        $this->commentEdit = '';
        $this->commentDate = '' ;
        $this->commentText = '' ;
        $this->commentUser = '';
        $this->commentCrud = "nothing";
    }

    public function selectDeleteComment($id){
        $this->commentEdit = Comment::find($id);
        $this->commentId = $this->commentEdit->id;
        $this->commentDate = $this->commentEdit->created_at;
        $this->commentText = $this->commentEdit->comment;
        $this->commentUser = User::find($this->commentEdit->user_id)->email;
        $this->commentCrud = "delete";
    }

    public function submitDeleteComment()
    {
        Comment::where('id', $this->commentId)->delete();

        $this->alertCommentColor = "alert-success";
        $this->alertCommentMessage = "Supression effectué";
        $this->commentEdit = '';
        $this->commentDate = '';
        $this->commentText = '';
        $this->commentUser = '';
        $this->commentCrud = "nothing";
    }



    public function selectEditUser($id)
    {
        $this->userEdit = User::find($id);
        $this->name = $this->userEdit->name;   //explode(" ", $this->userEdit->name)[0];
        $this->firstName = $this->userEdit->pseudo; //substr(strstr($this->userEdit->name, " "), 1);
        $this->email = $this->userEdit->email;
        $this->role = $this->userEdit->role;
        $this->d_role = $this->userEdit->role;
        $this->dateCreation = date("d/m/Y à H:i:s", strtotime($this->userEdit->created_at));
        $this->userId = $this->userEdit->id;
        $this->alertColor = null;
        $this->alertMessage = null;
        $this->userCrud = "edit";
    }

    public function submitEditUser()
    {

        $u_role = null;
        $role_liste = array("user", "mtn", "moov", "orange", "admin");
        $this->userEdit = User::find($this->userId);

        $u_role = $this->role;

        if (in_array($u_role, $role_liste)) {
            User::where('id', $this->userEdit->id)->update(['role' => $u_role]);
            $this->role = $u_role;
            $this->d_role = $u_role;
            $this->alertColor = "alert-success";
            $this->alertMessage = "Changement de statut effectué avec succès";
        }
    }

    public function userRetour()
    {
        $this->alertColor = null;
        $this->alertMessage = null;
        $this->name = '';
        $this->firstName = '';
        $this->role = '';
        $this->email = '';

        $this->userCrud = "view";
    }

    public function selectDeleteUser($id){
        $this->userEdit = User::find($id);
        $this->name = $this->userEdit->name;   //explode(" ", $this->userEdit->name)[0];
        $this->firstName = $this->userEdit->pseudo; //substr(strstr($this->userEdit->name, " "), 1);
        $this->email = $this->userEdit->email;
        $this->role = $this->userEdit->role;
        $this->dateCreation = date("d/m/Y à H:i:s", strtotime($this->userEdit->created_at));
        $this->userId = $this->userEdit->id;
        $this->alertColor = null;
        $this->alertMessage = null;
        $this->userCrud = "delete";
    }

    public function submitDeletetUser()
    {
        User::where('id',$this->userId)->delete();
        $this->alertColor = "alert-success";
        //$this->alertMessage = "Supression effectué";
        $this->userCrud = "view";
    } 

    public function render()
    {
        $this->users = User::orderBy('role', 'ASC')->orderBy('name', 'DESC')->get();
        // $this->comments = Comment::select('comments.*', 'users.name')
        //     ->join('users', 'comments.user_id', '=', 'users.id')
        //     ->orderBy('created_at', 'DESC')
        //     ->get();
        return view('livewire.admin.main');
    }

    public function test($data)
    {
        dd($data);
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
        $content = 'var dwdData ={' . $content . '}';

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

        if ($id == 8){
            $this->couvertureReseau = DB::table('couverture_reseaux')->select('localite', 'couverture_2G_orange', 'population_2G_orange')->get();
            $this->updated = "orange2g";
        }
    }

    public function selectEditUpdate($id, $endroit){

        if ($id == 8){
            $this->local = $endroit;
            $this->drap = DB::table('couverture_reseaux')->where('localite', $endroit)->value('couverture_2G_orange');
            $this->peuple = DB::table('couverture_reseaux')->where('localite', $endroit)->value('population_2G_orange');
            $this->updatedCrud = "update";

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
