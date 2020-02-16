<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_Config extends Model
{
    //
    protected $table = 'site_configs';
    
    public function config_type()
    {
        return $this->belongsTo('App\Config_Type' , 'configtype_id');
    }
}
