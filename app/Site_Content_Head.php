<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_Content_Head extends Model
{
    //
    protected $table = 'site_content_heads';

    public function site_content_type()
    {
        return $this->belongsTo('App\Site_Content_Type' , 'site_content_type_id');
    }

}
