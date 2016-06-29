<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    //
    protected $table      = 'weights';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'tpa',
        'audition',
        'interview'
    ];

    public $timestamps = false;
}
