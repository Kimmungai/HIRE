<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Order;
use App\BidCompany;
use App\OrderViews;
use App\CompanyViewableOrders;
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
      //$request->flash();
      session()->put('order_name', request()->input('order_name'));
      session()->put('start_date', request()->input('start_date'));
      session()->put('start_time', request()->input('start_time'));
      session()->put('pick_up_address', request()->input('pick_up_address'));
      session()->put('end_date', request()->input('end_date'));
      session()->put('end_time', request()->input('end_time'));
      session()->put('drop_off_address', request()->input('drop_off_address'));
      session()->put('car_num', request()->input('car_num'));
      session()->put('people_num', request()->input('people_num'));
      session()->put('baggage', request()->input('baggage'));
      session()->put('car_type', request()->input('car_type'));
      session()->put('journey', request()->input('journey'));
      session()->put('details', request()->input('details'));
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
      $new_order ->order_name=session('order_name');session()->forget('order_name');
      $new_order ->pick_up_date=session('start_date');session()->forget('start_date');
      $new_order ->pick_up_time=session('start_time');session()->forget('start_time');
      $new_order ->pick_up_address=session('pick_up_address');session()->forget('pick_up_address');
      $new_order ->drop_off_date=session('end_date');session()->forget('end_date');
      $new_order ->drop_off_time=session('end_time');session()->forget('end_time');
      $new_order ->drop_off_address=session('drop_off_address');session()->forget('drop_off_address');
      $new_order ->num_of_cars=session('car_num');session()->forget('car_num');
      $new_order ->number_of_people=session('people_num');session()->forget('people_num');
      $new_order ->luggage_num=session('baggage');session()->forget('baggage');
      $new_order ->car_type=session('car_type');session()->forget('car_type');
      $new_order ->journey=session('journey');session()->forget('journey');
      $new_order ->remarks=session('details');session()->forget('details');
      $new_order ->bid_id=$user_id;
      $new_order->save();
      $all_user_orders=Order::with(['BidCompany','Bid'])->where('user_id', '=', $user_id)->where('suspended','=',0)->where('bid_status','<>',2)->orderBy('id','Desc')->paginate(env('ORDERS_PER_PAGE',5));
      //return view('client_order_view_all', compact('all_user_orders'));
      return redirect('/client_order_view_all');
    }
    public function all_orders()
    {
      if(Session::get('active_breadcrumb')!=2 && Session::get('active_breadcrumb')!=3){
        Session::flash('active_breadcrumb', 1);
      }
      $orders=Order::with(['BidCompany','Bid'])->where('suspended','=',0)->where('admin_approved','=',1)->where('bid_status','<>',2)->orderBy('id','desc')->paginate(env('ORDERS_PER_PAGE',5));
      $current_allowed_orders=CompanyViewableOrders::where('user_id','=',Auth::id())->pluck('order_id')->toArray();
      foreach($orders as $order){
        if(!count(OrderViews::where('order_id','=',$order['id'])->where('user_id','=',Auth::id())->get())){
          $newOrderView=new OrderViews;
          $newOrderView->order_id=$order['id'];
          $newOrderView->user_id=Auth::id();
          $newOrderView->save();
        }
      }
      return view('company_order_view_all',compact('orders','current_allowed_orders'));
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
        $new_bid->bidder_id=Auth::id();
        $new_bid->save();
        //$orders=Order::with(['BidCompany','Bid'])->get();
      //return view('company_order_view_all',compact('orders'));
      Session::flash('bid-successful', '入札しました。');
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

        $already_bidded=Bid::where('bid_company_id','=',$bid_company_id)->first();
        if(count($already_bidded)){
          Session::flash('bid-successful', '一度しか入札できません!');
          return back();
        }

        $new_bid=new Bid;
        $company_name=Auth::user()->company_name;
        $new_bid->bid_company_id=$bid_company_id;
        $new_bid->price=$request->input('bid-price');
        $new_bid->message=$request->input('bid-message');
        $new_bid->company_name=$company_name;
        $new_bid->bidder_id=Auth::id();
        Session::flash('bid-successful', '入札しました。');
        $new_bid->save();
      return back();
    }
    public function open_bids()
    {
      Session::flash('active_breadcrumb', 3);
      $orders=Order::where('bid_status','=',0)->where('admin_approved','=',1)->where('suspended','=',0)->where('bid_status','<>',2)->with(['BidCompany','Bid'])->paginate(env('ORDERS_PER_PAGE',5));
      foreach($orders as $order){
        if(!count(OrderViews::where('order_id','=',$order['id'])->where('user_id','=',Auth::id())->get())){
          $newOrderView=new OrderViews;
          $newOrderView->order_id=$order['id'];
          $newOrderView->user_id=Auth::id();
          $newOrderView->save();
        }
      }
      $current_allowed_orders=CompanyViewableOrders::where('user_id','=',Auth::id())->pluck('order_id')->toArray();
      return view('company_order_view_all',compact('orders','current_allowed_orders'));
    }
    public function my_bids()
    {
      $my_orders=BidCompany::with(['Order' => function ($query){$query->where('bid_status','<>',2)->where('suspended','=',0);},'Bid'])->where('user_id','=',Auth::id())->orderBy('id','desc')->paginate(env('ORDERS_PER_PAGE',5));
      foreach($my_orders as $order){
        if(!count(OrderViews::where('order_id','=',$order['id'])->where('user_id','=',Auth::id())->get())){
          $newOrderView=new OrderViews;
          $newOrderView->order_id=$order['id'];
          $newOrderView->user_id=Auth::id();
          $newOrderView->save();
        }
      }
      //return $my_orders;
      $current_allowed_orders=CompanyViewableOrders::where('user_id','=',Auth::id())->pluck('order_id')->toArray();
      //$orders=Order::with(['BidCompany','Bid'])->where('bid_status','<>',2)->orderBy('id','desc')->paginate(env('ORDERS_PER_PAGE',5));
      return view('company_order_view_all',compact('my_orders','current_allowed_orders'));

      /*$bid_company_ids=Bid::where('bidder_id','=',Auth::id())->get();
      $count=0;
      $order_ids=array();
      $my_orders=array();
      foreach($bid_company_ids as $bid_company_id)
      {
        $order_ids[$count]=BidCompany::where('id','=',$bid_company_id['bid_company_id'])->value('order_id');
        $count++;
      }
      for($count=0;$count<count($order_ids); $count++)
      {
        $my_orders[$count]=Order::where('bid_status','=',0)->where('id','=',$order_ids[$count])->where('bid_status','<>',2)->with(['BidCompany','Bid'])->get();
      }
      //$my_orders=array_unique($my_orders);//remove duplicates
      $my_orders=collect($my_orders);
      //$orders=Order::where('bid_status','=',0)->where('bid_status','<>',2)->with(['BidCompany','Bid'])->get();
      return view('company_order_view_all',compact('my_orders','order_ids'));*/
    }
    public function closed_bids()
    {
      Session::flash('active_breadcrumb', 2);
      $orders=Order::where('bid_status','=',1)->where('admin_approved','=',1)->where('suspended','=',0)->where('bid_status','<>',2)->with(['BidCompany','Bid'])->paginate(env('ORDERS_PER_PAGE',5));
      foreach($orders as $order){
        if(!count(OrderViews::where('order_id','=',$order['id'])->where('user_id','=',Auth::id())->get())){
          $newOrderView=new OrderViews;
          $newOrderView->order_id=$order['id'];
          $newOrderView->user_id=Auth::id();
          $newOrderView->save();
        }
      }
      $current_allowed_orders=CompanyViewableOrders::where('user_id','=',Auth::id())->pluck('order_id')->toArray();
      return view('company_order_view_all',compact('orders','current_allowed_orders'));
    }
    public function view_order($order_id)
    {
      $orders=Order::where('id','=',$order_id)->where('bid_status','<>',2)->with(['BidCompany','Bid'])->get();
      //$orders=collect($orders)->reverse();
      $user_id=Order::where('id','=',$order_id)->where('bid_status','<>',2)->value('user_id');
      $user_name=User::where('id','=',$user_id)->value('first_name').' '.User::where('id','=',$user_id)->value('last_name');
      //$num_orders=Order::where('user_id','=',$user_id)->where('bid_status','<>',2)->select('id')->get();
      //$other_orders_lists=Order::where('id','<>',$order_id)->with(['BidCompany','Bid'])->get();
      return view('company_order_view',compact('orders','user_name'));
    }
    public function open_bid_comment($order_id, $price)
    {
      $orders=Order::where('id','=',$order_id)->where('bid_status','<>',2)->with(['BidCompany','Bid'])->get();
      //$orders=collect($orders)->reverse();
      $user_id=Order::where('id','=',$order_id)->where('bid_status','<>',2)->value('user_id');
      $user_name=User::where('id','=',$user_id)->value('first_name').' '.User::where('id','=',$user_id)->value('last_name');
      $bid_company_id=BidCompany::where('order_id', '=', $order_id)->where('user_id', '=', Auth::id())->value('id');

      $already_bidded=Bid::where('bid_company_id','=',$bid_company_id)->first();
      if(count($already_bidded)){
        Session::flash('bid-successful', '一度しか入札できません!');
        //return back();
      }
      //$num_orders=Order::where('user_id','=',$user_id)->where('bid_status','<>',2)->select('id')->get();
      //$other_orders_lists=Order::where('id','<>',$order_id)->with(['BidCompany','Bid'])->get();
      return view('company_order_view',compact('orders','user_name','price'));
    }
    public function set_deadline()
    {
      $order_id=$_GET['order_id'];
      $deadline=$_GET['deadline'];
      if(Order::where('id','=',$order_id)->update([
        'deadline-date' => $deadline
      ])){
        return 1;
      }
      return 0;
    }
}
