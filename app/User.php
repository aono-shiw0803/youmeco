<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'icon', 'rank'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
      return $this->hasMany('App\Post');
    }
    public function progresses(){
      return $this->hasMany('App\Progress');
    }

    public function getCreatedAtAttribute($date){
      return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y年m月d日 H:i:s');
    }
    public function getUpdatedAtAttribute($date){
      return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y年m月d日 H:i:s');
    }
}
