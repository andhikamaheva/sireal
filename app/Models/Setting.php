<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $table      = 'settings';
    protected $primaryKey = 'id';
    protected $fillable   = ['setting_key', 'setting_value'];
    public $timestamps    = false;

    public static function getSetting($key)
    {
        $setting = Setting::where('setting_key', '=', $key)->first();
        return $setting->setting_value;
    }
    
}
