<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelectedSubject extends Model
{
    //
    protected $table      = 'selected_subject';
    protected $fillable   = [ 'oprec_id',
        'subject_id',
        'status'
    ];
    public    $timestamps = false;
}
