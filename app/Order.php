<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function User()
    {
      return $this->belongsTo('App\User');
    }
    public function bidcompany()
    {
      return $this->hasMany('App\BidCompany');
    }
    public function bid()
    {
      return $this->hasManyThrough('App\Bid','App\BidCompany');
    }
    public function company_viewable_orders()
    {
      return $this->hasMany('App\CompanyViewableOrders');
    }

}
