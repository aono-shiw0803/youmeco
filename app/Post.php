<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
      'matter', 'matter_2', 'task', 'staff', 'hour', 'start_date', 'end_date', 'content', 'status', 'important', 'salestaff', 'salestaff_bg','windowstaff', 'type', 'delivery_number', 'delivery_date'
    ];

    public function matters(){
      return $this->hasMany('App\Matter');
    }

    public function tasks(){
      return $this->hasMany('App\Task');
    }

    public function files(){
      return $this->hasMany('App\File');
    }

    public function user(){
      return $this->belongsTo('App\User', 'staff', 'id');
    }

    public function notice(){
      return $this->belongsTo('App\Notice');
    }

    public function getCreatedAtAttribute($date){
      return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y年m月d日 H:i:s');
    }
    public function getUpdatedAtAttribute($date){
      return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y年m月d日 H:i:s');
    }
}
