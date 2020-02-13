<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_Head_Content extends Model
{
    //
    protected $table = 'site_head_contents';

    public function site_content_types()
    {
        return $this->belongsTo('App\Site_Content_Type' , 'site_content_type_id');
    }

}
