<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OprecInterviewScore extends Model
{
    //
    protected $table      = 'oprec_interview_scores';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'oprec_interview_id',
        'criteria',
        'score',
        'note'
    ];
    public    $timestamps = true;
}
