<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidCompany extends Model
{
  public function order()
  {
    return $this->belongsTo('App\Order');
  }
  public function bid()
  {
    return $this->hasMany('App\Bid');
  }
}
