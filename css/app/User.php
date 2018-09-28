<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','verified','email_token','is_admin','user_category'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verified()
    {
        $this->verified = 1;
        $this->email_token = null;
        $this->save();
    }
    public function order()
    {
      return $this->hasMany('App\Order');
    }
    public function chat_users()
    {
      return $this->hasMany('App\ChatUsers');
    }
    public function chat_messages()
    {
      return $this->hasManyThrough('App\ChatMessages','App\ChatUsers');
    }
}
