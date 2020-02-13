<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_Content_Type extends Model
{
    //
    protected $table = 'site_content_types';

    public function get_site_content_head()
    {
        return $this->hasOne('App\Site_Content_Head' , 'site_content_type_id');
    }

    public function get_site_content_item()
    {
        return $this->hasMany('App\Site_Content_Item' , 'site_content_type_id');
    }  

}
