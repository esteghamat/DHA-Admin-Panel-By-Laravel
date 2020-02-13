<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
  protected $table = 'filters';

  public function portfolios()
  {
      return $this->hasMany('App\Portfolio' , 'filter_id');
  }  

  public function contentitems()
  {
      return $this->hasMany('App\Site_Content_Item' , 'filter_id');
  }  

}
