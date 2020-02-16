<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config_Type extends Model
{
    //
    protected $table = 'config_types';

    public function site_configs()
    {
        return $this->hasMany('App\Site_Config' , 'configtype_id');
    }
}
