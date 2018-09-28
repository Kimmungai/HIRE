<?php

namespace App\Providers;
use App\Order;
use App\OrderViews;
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

      //$viewed_orders=count(OrderViews::where('user_id','=',Auth::id())->get());
      //$num_orders=Auth::id();
      //view()->share('num_orders', $num_orders);
      view()->composer('*', function($view) {
            $two_days_ago=date('Y-m-d H:i:s',time()-172800);
            $recent_orders=count(Order::where('bid_status','<>',2)->where('created_at','>=',$two_days_ago)->get());
            $viewed_orders=count(OrderViews::where('user_id','=',auth()->id())->get());
            $num_orders=$recent_orders-$viewed_orders;
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
