<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $table      = 'subjects';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'name',
        'code'
    ];
    public    $timestamps = true;

    public function semesters()
    {
        return $this->belongsToMany('App\Models\Semester');
    }

    public function oprecs()
    {
        return $this->belongsToMany('App\Models\Oprec');
    }

    public function coordinators()
    {
        return $this->belongsToMany('App\Models\User', 'subject_coordinators',
            'subject_id', 'user_id');
    }
}
