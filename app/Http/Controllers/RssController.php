<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RssController extends Controller
{
    // Le flux RSS des mises à jours
    public function courses () {

    	// On récupère les cours
        $courses = DB::table('memoire_tampon')
        ->where('statut', 1)
        ->latest()
        ->select('localite', 'operateur', 'technologie','couverture', 'updated_at')->get();
            
    	

    	// La réponse avec la vue et le header spécifique
    	return response()
    			->view("rss", compact("courses"))
    			->header('Content-Type', 'application/xml');
    }
}
