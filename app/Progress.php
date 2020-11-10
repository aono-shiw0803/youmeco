<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $fillable = [
      'measures', 'month', 'completion', 'company', 'no', 'title', 'matter_content', 'original_staff', 'original_done', 'original_content',
      'check_staff', 'check_done', 'check_content', 'update_staff', 'update_done', 'update_content', 'file_staff', 'file_done', 'file_content',
      'sale_staff', 'sale_done', 'sale_content', 'final_staff', 'final_done', 'final_content', 'delivery'
    ];

    public function users(){
      return $this->belongsTo('App\User');
    }
}
