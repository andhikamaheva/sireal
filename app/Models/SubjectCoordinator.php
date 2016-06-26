<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectCoordinator extends Model
{
    //
    protected $table    = 'subject_coordinators';
    protected $fillable = [ 'user_id',
        'subject_id'
    ];
}
