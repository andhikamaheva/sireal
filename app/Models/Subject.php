<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $table      = 'subjects';
    protected $primaryKey = 'id';
    protected $fillable   = ['name', 'code'];
    public $timestamps    = true;
}
