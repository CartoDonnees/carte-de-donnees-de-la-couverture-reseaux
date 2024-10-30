<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Carbon;

class Answer extends Model
{
    use HasFactory;
       
    protected $fillable = [
        'comment_id',
        'from_id',
        'types',
        'answer',
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
