<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SemesterSubject extends Model
{
    //
    // use SoftDeletes;
    protected $table      = 'semester_subjects';
    protected $fillable   = [
        'SEMESTER_ID',
        'SUBJECT_ID'
    ];

}
