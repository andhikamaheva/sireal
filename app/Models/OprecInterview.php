<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OprecInterview extends Model
{
    //
    protected $table      = 'oprec_interview';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'user_id',
        'oprec_id'
    ];
    public    $timestamps = true;
}
