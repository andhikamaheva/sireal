<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oprec extends Model
{
    //
    protected $table      = 'oprecs';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'batch_id',
        'student_id',
        'file_id',
        'status'
    ];
    public    $timestamps = true;

    public function selectedsubject()
    {
        return $this->belongsToMany('App\Models\Subject', 'selected_subject',
            'oprec_id', 'subject_id');
    }

    public function students(){
        return $this->belongsTo('App\Models\Student');
    }
}
