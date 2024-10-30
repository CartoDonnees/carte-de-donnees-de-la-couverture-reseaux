<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_probleme',
        'operateur',
        'localite',
        'connexion_lente',
        'connexion_impossible',
        'appel_non_fluide',
        'appel_impossible',
        'envoi_sms_lent',
        'reception_sms_lente',
        'envoi_sms_impossible',
        'reception_sms_impossible',
        'application_lent',
        'probleme_affichage',
        'commentaire',
        'mail',
        'telephone',
    ];

    public function fromDateTime($value)
    {
        // Only for MSSQL
        if (env('DB_CONNECTION') == 'sqlsrv') {
            return Carbon::parse(parent::fromDateTime($value))->format('Y-d-m H:i:s');
        }
        return $value;
    }
}
