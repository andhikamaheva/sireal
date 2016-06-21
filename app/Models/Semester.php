<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //
    protected $table      = 'semesters';
    protected $primaryKey = 'id';
    protected $fillable   = [ 'name',
        'start_at',
        'end_at',
        'status'
    ];
    public    $timestamps = true;

    function getStartAtAttribute($date)
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->formatLocalized('%d %B %Y');
    }

    function getEndAtAttribute($date)
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->formatLocalized('%d %B %Y');
    }

}
