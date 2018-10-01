<?php

namespace App\Providers;
use App\Order;
use App\OrderViews;
use App\CompanyViewableOrders;
use Illuminate\Support\ServiceProvider;
//use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer('*', function($view) {
            $allowed_orders=count(CompanyViewableOrders::where('user_id','=',auth()->id())->get());
            //$all_orders=count(Order::where('bid_status','<>',2)->get());
            $all_viewed_orders=count(OrderViews::where('user_id','=',auth()->id())->get());
            $num_orders=$allowed_orders-$all_viewed_orders;
            $view->with('num_orders', $num_orders);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
