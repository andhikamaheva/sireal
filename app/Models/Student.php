<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property  nim
 * @property  name
 * @property nickname
 * @property phone
 * @property email
 */
class Student extends Model
{
    //
    protected $table    = 'students';
    protected $fillable = ['nim','name','nickname','phone','email'];
    public $timestamps  = true;
}
