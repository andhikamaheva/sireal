<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OprecInterview extends Model
{
    //
    protected $table      = 'oprec_interviews';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'user_id',
        'oprec_id',
        'appearance',
        'background',
        'creativity',
        'communication',
        'score'
    ];
    public    $timestamps = true;
}
