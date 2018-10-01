<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyViewableOrders extends Model
{
  public function Order()
  {
    return $this->belongsTo('App\Order');
  }
}
