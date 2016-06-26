<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditionScore extends Model
{
    //
    protected $table      = 'audition_scores';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'oprec_audition_id',
        'criteria',
        'score',
        'note'
    ];
    public    $timestamps = true;

}
