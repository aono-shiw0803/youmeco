<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $fillable = [
      'name', 'name_2', 'content', 'rank'
    ];

    public function post(){
      return $this->belongsTo('App\Post');
    }

    public function memos(){
      return $this->hasMany('App\Memo');
    }

    public function layout(){
      return $this->belongsTo('App\Layout');
    }

    public function getCreatedAtAttribute($date){
      return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y年m月d日 H:i:s');
    }
    public function getUpdatedAtAttribute($date){
      return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y年m月d日 H:i:s');
    }
}
