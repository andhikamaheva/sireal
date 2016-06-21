<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
