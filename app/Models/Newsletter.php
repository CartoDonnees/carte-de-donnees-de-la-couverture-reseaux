<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Newsletter extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'title',
        'image_link',
        'file_link',
        'video_link',
        'description',
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
