<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    //
    use SoftDeletes;
    protected $table      = 'batches';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'semester_id',
        'name',
        'start_at',
        'end_at',
        'status'
    ];
    public    $timestamps = true;
    protected $dates      = [ 'deleted_at' ];

    public function semesters()
    {
        return $this->belongsTo('App\Models\Semester', 'semester_id');
    }

    public function batchactivities()
    {
        return $this->hasMany('App\Models\BatchActivity');
    }
}
