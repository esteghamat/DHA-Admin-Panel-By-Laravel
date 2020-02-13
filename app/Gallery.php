<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    public function portfolio()
    {
        return $this->belongsTo('App\Portfolio' , 'ref_id');
    }

    public function get_gallery_images()
    {
        return $this->hasMany('App\Gallery_Image' , 'gallery_id');
    }
}
