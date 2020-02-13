<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marka extends Model
{
    
    public function portfolios()
    {
        return $this->hasMany('App\Portfolio' , 'marka_id');
    }

    public function contentitems()
    {
        return $this->hasMany('App\Site_Content_Item' , 'marka_id');
    }  
  
}
