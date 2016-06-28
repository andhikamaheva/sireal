<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $table      = 'files';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'ktp',
        'photo',
        'app_letter',
        'cv',
        'transcript',
        'status'
    ];
    public    $timestamps = true;
}
