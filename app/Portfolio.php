<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gallery;

class Portfolio extends Model
{
    
    public function marka()
    {
        return $this->belongsTo('App\Marka' , 'marka_id');
    }
    
    /*
    $portfolio = App\Portfolio::find(1);
    echo $portfolio->marka->marka_name;
    */
    
    // public function category()
    // {
    //     return $this->belongsTo('App\Category' , 'category_id');
    // }
    /*
    $portfolio = App\Portfolio::find(1);
    echo $portfolio->category->category_name;
    */

    public function filter()
    {
        return $this->belongsTo('App\Filter' , 'filter_id');
    }
    
    public function get_galleries() 
    {
        return $this->hasOne('App\Gallery' , 'ref_id' );
    }
    //$gallery = Portfolio::find(1)->gallery;


}
