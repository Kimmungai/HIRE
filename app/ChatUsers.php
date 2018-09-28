<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatUsers extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }
    public function chat_messages()
    {
      return $this->hasMany('App\ChatMessages');
    }
}
