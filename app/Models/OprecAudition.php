<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OprecAudition extends Model
{
    //
    protected $table      = 'oprec_auditions';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'user_id',
        'oprec_id',
        'score'
    ];
    public    $timestamps = true;

    public function auditionscores()
    {
        return $this->hasMany('App\Models\AuditionScore', 'oprec_audition_id');
    }
}
