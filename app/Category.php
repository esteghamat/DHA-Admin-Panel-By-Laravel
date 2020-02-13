<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
 
  public function get_parent()
  {
      return $this->belongsTo(Category::class, 'parent_id');
  }

  public function get_children()
  {
      return $this->hasMany(Category::class, 'parent_id');
  }

  // public function portfolios()
  // {
  //     return $this->hasMany('App\Portfolio' , 'category_id');
  // }

}
