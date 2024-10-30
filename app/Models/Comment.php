<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Carbon;

class Comment extends Model
{
    use HasFactory;
       
    protected $fillable = [
        'user_id',
        'comment',
        'likes',
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
