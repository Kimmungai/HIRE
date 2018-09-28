<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderViews extends Model
{
  public function order()
  {
    return $this->belongsTo('App\Order');
  }
}
