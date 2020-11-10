<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    // protected fillable = [
    // ];

    public function posts(){
      return $this->hasMany('App\Post');
    }
}
