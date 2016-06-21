<?php

namespace app\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use EntrustUserTrait;
    use SoftDeletes;

    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $fillable   = ['name', 'email', 'username', 'user_password', 'remember_token'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'user_password',
    ];

    public $timestamps = true;

    public function setUserPasswordAttribute($value)
    {
        $this->attributes['user_password'] = bcrypt($value);
    }

    public function getAuthPassword()
    {
        return $this->user_password;
    }
    /*
    public function getAuthIdentifier()
     {
      return $this->Email;
      }
    */
    protected $dates = ['deleted_at'];
}
