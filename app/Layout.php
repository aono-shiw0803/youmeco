<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    public function matters(){
      return $this->hasMany('App\Matter');
    }

    public function tasks(){
      return $this->hasMany('App\Task');
    }

    public function users(){
      return $this->hasMany('App\User');
    }
}
