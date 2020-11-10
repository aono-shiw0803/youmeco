<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
      'title', 'bg'
    ];

    public function post(){
      return $this->belongsTo('App\Post');
    }

    public function getCreatedAtAttribute($date){
      return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y年m月d日 H:i:s');
    }
    public function getUpdatedAtAttribute($date){
      return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y年m月d日 H:i:s');
    }
}
