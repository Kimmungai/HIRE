<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Order;
use App\BidCompany;
use App\Bid;
use Auth;
use DB;
use App\User;
use Session;
class orders extends Controller
{
    public function new_order_confirm(Request $request)
    {
      $input=$request->all();
      $request->flash();
      return view('new_order_check', compact('input'));
    }
    public function new()
    {
      return view('new_order');
    }
    public function create(Request $request)
    {
      $new_order = new Order;
      $user_id = Auth::id();
      $new_order ->user_id=$user_id;
      $new_order ->order_name=$request->old('order_name');
      $new_order ->pick_up_date=$request->old('start_date');
      $new_order ->pick_up_time=$request->old('start_time');
      $new_order ->pick_up_address=$request->old('pick_up_address');
      $new_order ->drop_off_date=$request->old('end_date');
      $new_order ->drop_off_time=$request->old('end_time');
      $new_order ->drop_off_address=$request->old('drop_off_address');
      $new_order ->num_of_cars=$request->old('car_num');
      $new_order ->number_of_people=$request->old('people_num');
      $new_order ->luggage_num=$request->old('baggage');
      $new_order ->car_type=$request->old('car_type');
      $new_order ->remarks=$request->old('details');
      $new_order ->bid_id=$user_id;
      $new_order->save();
      $all_user_orders=Order::with(['BidCompany','Bid'])->where('user_id', '=', $user_id)->where('bid_status','<>',2)->orderBy('id','Desc')->get();
      return view('client_order_view_all', compact('all_user_orders'));
    }
    public function all_orders()
    {
      $orders=Order::with(['BidCompany','Bid'])->where('bid_status','<>',2)->orderBy('id','desc')->get();
      return view('company_order_view_all',compact('orders'));
      //return $orders;

    }
    public function bid(Request $request)
    {
      $user=Auth::user();
      $user_id = $user['id'];
      $order_id=$request->input('order-num');
      $check_existence=BidCompany::where('user_id', '=', $user_id)->where('order_id', '=', $order_id)->get();
      if(!count($check_existence))
      {
        $new_company_bid=new BidCompany;
        $new_company_bid ->order_id=$request->input('order-num');
        $new_company_bid ->user_id=$user_id;
        $new_company_bid->save();
      }
      //if the company has already bidded, update its bid, otherwise insert new bid

      //$user_bidded=BidCompany::where('order_id', '=', $order_id)->value('user_id');
      $bid_company_id=BidCompany::where('order_id', '=', $order_id)->where('user_id', '=', $user_id)->value('id');
      /*if(($user_id==$user_bidded)&&($user['user_category']==0)&&(count($check_existence))){
        Bid::where('bid_company_id',$bid_company_id[0])->update(['price' => $request->input('bid-price')]);
      }
      else{*/
        $new_bid=new Bid;
        $company_name=Auth::user()->company_name;
        $new_bid->bid_company_id=$bid_company_id;
        $new_bid->price=$request->input('bid-price');
        $new_bid->message=$request->input('bid-message');
        $new_bid->company_name=$company_name;
        $new_bid->save();
        //$orders=Order::with(['BidCompany','Bid'])->get();
      //return view('company_order_view_all',compact('orders'));
      Session::flash('bid-successful', 'Bid successful!');
      return back();
      //return $bid_company_id;
    }
    public function bid_with_message(Request $request)
    {
        $user=Auth::user();
        $user_id = $user['id'];
        $order_id=$request->input('order-num');
        $check_existence=BidCompany::where('user_id', '=', $user_id)->where('order_id', '=', $order_id)->get();
        if(!count($check_existence))
        {
          $new_company_bid=new BidCompany;
          $new_company_bid ->order_id=$request->input('order-num');
          $new_company_bid ->user_id=$user_id;
          $new_company_bid->save();
        }

        $bid_company_id=BidCompany::where('order_id', '=', $order_id)->where('user_id', '=', $user_id)->value('id');
        $new_bid=new Bid;
        $company_name=Auth::user()->company_name;
        $new_bid->bid_company_id=$bid_company_id;
        $new_bid->price=$request->input('bid-price');
        $new_bid->message=$request->input('bid-message');
        $new_bid->company_name=$company_name;
        Session::flash('bid-successful', 'Bid successful!');
        $new_bid->save();
      return back();
    }
    public function open_bids()
    {
      $orders=Order::where('bid_status','=',0)->where('bid_status','<>',2)->with(['BidCompany','Bid'])->get();
      return view('company_order_view_all',compact('orders'));
    }
    public function closed_bids()
    {
      $orders=Order::where('bid_status','=',1)->where('bid_status','<>',2)->with(['BidCompany','Bid'])->get();
      return view('company_order_view_all',compact('orders'));
    }
    public function view_order($order_id)
    {
      $orders=Order::where('id','=',$order_id)->where('bid_status','<>',2)->with(['BidCompany','Bid'])->get();
      //$orders=collect($orders)->reverse();
      $user_id=Order::where('id','=',$order_id)->where('bid_status','<>',2)->value('user_id');
      $user_name=User::where('id','=',$user_id)->value('company_name');
      $num_orders=Order::where('user_id','=',$user_id)->where('bid_status','<>',2)->select('id')->get();
      //$other_orders_lists=Order::where('id','<>',$order_id)->with(['BidCompany','Bid'])->get();
      return view('company_order_view',compact('orders','user_name','num_orders'));
    }
    public function open_bid_comment($order_id, $price)
    {
      $orders=Order::where('id','=',$order_id)->where('bid_status','<>',2)->with(['BidCompany','Bid'])->get();
      //$orders=collect($orders)->reverse();
      $user_id=Order::where('id','=',$order_id)->where('bid_status','<>',2)->value('user_id');
      $user_name=User::where('id','=',$user_id)->value('company_name');
      $num_orders=Order::where('user_id','=',$user_id)->where('bid_status','<>',2)->select('id')->get();
      //$other_orders_lists=Order::where('id','<>',$order_id)->with(['BidCompany','Bid'])->get();
      return view('company_order_view',compact('orders','user_name','num_orders','price'));
    }
}
