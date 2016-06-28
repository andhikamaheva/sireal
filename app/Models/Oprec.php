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

    public function selectedsubjects()
    {
        return $this->belongsToMany('App\Models\Subject', 'selected_subject',
            'oprec_id', 'subject_id', 'score')->withPivot('score');
    }

    public function file()
    {
        return $this->hasone('App\Models\File', 'id', 'file_id');
    }

    public function students()
    {
        return $this->belongsTo('App\Models\Student', 'student_id', 'id');
    }
}
