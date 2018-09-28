<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model
{
  public function chat_users()
  {
    return $this->belongsTo('App\ChatUsers');
  }
}
