<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semester extends Model
{
    //
    use SoftDeletes;

    protected $table      = 'semesters';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'name',
        'start_at',
        'end_at',
        'status'
    ];
    public    $timestamps = true;

    /* function getStartAtAttribute($date)
     {
         setlocale(LC_TIME, 'id_ID.utf8');
         return Carbon::createFromFormat('Y-m-d H:i:s', $date)->formatLocalized('%d %B %Y');
     }

     function getEndAtAttribute($date)
     {
         setlocale(LC_TIME, 'id_ID.utf8');
         return Carbon::createFromFormat('Y-m-d H:i:s', $date)->formatLocalized('%d %B %Y');
     }*/

    protected $dates = [ 'deleted_at' ];

    public function batches()
    {
        return $this->hasMany('App\Models\Batch');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject', 'semester_subjects',
            'semester_id', 'subject_id');
    }
}
