<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_Content_Item extends Model
{

    //
    protected $table = 'site_content_items';

    public function site_content_type()
    {
        return $this->belongsTo('App\Site_Content_Type' , 'site_content_type_id');
    }
    
    public function marka()
    {
        return $this->belongsTo('App\Marka' , 'marka_id');
    }
    
    public function filter()
    {
        return $this->belongsTo('App\Filter' , 'filter_id');
    }

}
