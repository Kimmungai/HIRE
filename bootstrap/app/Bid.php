<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
  public function bidCompany()
  {
    return $this->belongsTo('App\BidCompany');
  }
}
