<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\BidCompany;
use App\CompanyViewableOrders;
use App\OrderViews;
use App\Bid;
use Session;
use App\ChatUsers;
use App\ChatMessages;
use Carbon\Carbon;
use Mail;
use App\Mail\NewOrder;
use App\Mail\orderDeadline;
use App\Mail\orderSuspended;


class admin extends Controller
{
    public function company_accounts()
    {
      $user_data=User::where('user_category','=',0)->where('admin_approved','<>',2)->where('is_admin','=',0)->paginate(10);
      session(['active_element'=>1]);
      return view('admin.company-accounts',compact('user_data'));
      //return $user_data;
    }
    public function search_company(Request $request)
    {
      if(session('active_element')==1){
        $user_category=0;
      }else{
        $user_category=1;
      }
      $search_query=$request->input('search-query');
      $user_data=User::where('company_name','like','%'.$search_query.'%')->where('user_category','=',$user_category)->where('last_name','like','%'.$search_query.'%')->where('first_name','like','%'.$search_query.'%')->where('company_name','like','%'.$search_query.'%')->where('admin_approved','<>',2)->orWhere('email','like','%'.$search_query.'%')->paginate(10);
      if(empty($user_data))
      {
          Session::flash('no-search-results', '見つかりません!');
          return back();
      }
      else {

        Session::flash('no-search-results', count($user_data).' 見つけた!');
      }
      return view('admin.company-accounts',compact('user_data'));
    }
    public function company_details($company_id)
    {
      $data=User::where('user_category','=',0)->where('id','=',$company_id)->where('admin_approved','<>',2)->get();
      session(['active_element'=>1]);
      return view('admin.company-accounts-details',compact('data'));
    }
    public function update_company_record(Request $request)
    {
      if($request->input('password')!='')
      {
        $updated_password=bcrypt($request->input('password'));
        User::where('id','=',$request->input('id'))->update(['password'=>$updated_password]);
      }
      User::where('id','=',$request->input('id'))->update([
        'company_name'=>$request->input('company_name'),
        'company_name_furigana'=>$request->input('company_name_furigana'),
        'last_name'=>$request->input('last_name'),
        'first_name'=>$request->input('first_name'),
        'last_name_furigana'=>$request->input('last_name_furigana'),
        'first_name_furigana'=>$request->input('first_name_furigana'),
        'address'=>$request->input('address'),
        'email'=>$request->input('email'),
        'tel'=>$request->input('tel'),
        'company_type'=>$request->input('company_type'),
        'admin_approved'=>$request->input('admin_approved')
      ]);
      Session::flash('update_success_admin', '更新しました!');
      //$data=User::where('user_category','=',0)->where('id','=',$request->input('id'))->get();
      //return view('admin.company-accounts-details',compact('data'));
      //return $request->input('id');
      return back();
    }
    public function delete_company_record(Request $request)
    {
      User::where('id','=',$request->input('id'))->update(['admin_approved'=>2]);
      Session::flash('no-search-results', '削除された!');
      //$data=User::where('user_category','=',0)->where('id','=',$request->input('id'))->where('admin_approved','<>',2)->get();
      return $this->company_accounts();
    }
    public function client_accounts()
    {
      $user_data=User::where('user_category','=',1)->where('admin_approved','<>',2)->where('is_admin','=',0)->paginate(10);
      session(['active_element'=>2]);
      return view('admin.client-accounts',compact('user_data'));
      //return $user_data;
    }
    public function client_details($client_id)
    {
      $data=User::where('user_category','=',1)->where('id','=',$client_id)->get();
      return view('admin.client-accounts-details',compact('data'));
    }

    public function update_client_record(Request $request)
    {
      if($request->input('password')!='')
      {
        $updated_password=bcrypt($request->input('password'));
        User::where('id','=',$request->input('id'))->update(['password'=>$updated_password]);
      }
      User::where('id','=',$request->input('id'))->update([
        'company_name'=>$request->input('company_name'),
        'company_name_furigana'=>$request->input('company_name_furigana'),
        'last_name'=>$request->input('last_name'),
        'first_name'=>$request->input('first_name'),
        'last_name_furigana'=>$request->input('last_name_furigana'),
        'first_name_furigana'=>$request->input('first_name_furigana'),
        'address'=>$request->input('address'),
        'email'=>$request->input('email'),
        'tel'=>$request->input('tel')
      ]);
      Session::flash('update_success_admin', '更新しました!');
      //$data=User::where('user_category','=',0)->where('id','=',$request->input('id'))->get();
      //return view('admin.company-accounts-details',compact('data'));
      //return $request->input('id');
      return back();
    }
    public function delete_client_record(Request $request)
    {
      User::where('id','=',$request->input('id'))->update(['admin_approved'=>2]);
      Session::flash('no-search-results', '削除された!');
      //$data=User::where('user_category','=',0)->where('id','=',$request->input('id'))->where('admin_approved','<>',2)->get();
      return $this->client_accounts();
    }
    public function admin_orders()
    {
      $data=Order::paginate(10);
      session(['active_element'=>3]);
      return view('admin.orders',compact('data'));
    }
    public function order_details($order_id)
    {
      $data=Order::with(['CompanyViewableOrders'])->where('id','=',$order_id)->get();
      $bid_companies=BidCompany::where('order_id','=',$order_id)->get();
      $count=0;
      foreach($bid_companies as $bid_company)
      {
        $bidder_email[$count]=User::where('id','=',$bid_company['user_id'])->value('email');
        $bidder_name[$count]=User::where('id','=',$bid_company['user_id'])->value('first_name');
        $bidder_latest_price[$count]=Bid::where('bid_company_id','=',$bid_company['id'])->orderBy('id','desc')->value('price');
        $count++;
      }
      $all_companies=User::where('user_category','=',0)->where('admin_approved','=',1)->where('is_admin','=',0)->get();
      session(['active_element'=>3]);
      return view('admin.order-details',compact('data','bid_companies','bidder_email','bidder_name','bidder_latest_price','all_companies'));
    }
    public function transactions()
    {
      $data=Order::where('bid_status','=',1)->where('suspended','=',0)->paginate(10); //get finalized orders
      $count=0;
      foreach($data as $order)
      {
        $client_email[$count]=User::where('id','=',$order['user_id'])->value('email');
        $client_name[$count]=User::where('id','=',$order['user_id'])->value('company_name');

        $seller_id=BidCompany::where('order_id','=',$order['id'])->value('user_id');
        $seller_name[$count]=User::where('id','=',$seller_id)->value('company_name');
        $seller_email[$count]=User::where('id','=',$seller_id)->value('email');

        $count++;
      }
      session(['active_element'=>4]);
      return view('admin.transactions',compact('data','client_email','client_name','seller_name','seller_email'));
    }
    public function transaction_details($order_id)
    {
      $data=Order::with('user')->where('id','=',$order_id)->where('bid_status','=',1)->get();
      if(count(BidCompany::all()))
      {
        $seller_id=BidCompany::where('order_id','=',$order_id)->whereNotNull('price_agreed')->value('user_id');
        $seller=User::where('id','=',$seller_id)->get();
        if($seller)
        {
          $closing_bid=BidCompany::where('user_id','=',$seller_id)->whereNotNull('price_agreed')->get();
        }
      }
      else
      {
        $seller=0;
      }
      session(['active_element'=>4]);
      return view('admin.transactions-details',compact('data','seller','closing_bid'));
      //return $data;
    }
    public function deleted_companies()
    {
      $data=User::where('admin_approved','=',2)->where('is_admin','=',0)->paginate(10);
      session(['active_element'=>6]);
      return view('admin.trash',compact('data'));
    }
    public function deleted_company_details($user_id)
    {
      $data=user::where('id','=',$user_id)->where('admin_approved','=',2)->where('is_admin','=',0)->get();
      session(['active_element'=>6]);
      return view('admin.trash-details',compact('data'));
    }
    public function restore_company_record(Request $request)
    {
      User::where('id','=',$request->input('id'))->update(['admin_approved'=>1]);//user now approved by admin
      Session::flash('trash_page', 'Company '.$request->input('company_name').' 復元された!');
      return $this->deleted_companies();
    }
    public function delete_record_permanently(Request $request)
    {
        User::where('id','=',$request->input('id'))->delete();//admin_approved value 10 indicates permanet deletion
        Order::where('user_id','=',$request->input('id'))->delete();
        ChatUsers::where('client_id','=',$request->input('id'))->delete();
        ChatUsers::where('company_id','=',$request->input('id'))->delete();
        ChatMessages::where('recipient_id','=',$request->input('id'))->delete();
        ChatMessages::where('user_id','=',$request->input('id'))->delete();
        BidCompany::where('user_id','=',$request->input('id'))->delete();
        Bid::where('bidder_id','=',$request->input('id'))->delete();
        Session::flash('trash_page', 'Company '.$request->input('company_name').' 永久に削除されました!');
      return $this->deleted_companies();
    }
    public function message_hist()
    {
        $chatusers=ChatUsers::get();
        $count=0;
        if(!count($chatusers)){$client_data=0;$message_data=0;return view('admin.message-hist',compact('client_data','message_data'));}
        foreach ($chatusers as $chatuser)
        {
          //$company_data[$count]=User::where('id','=',$chatuser['company_id'])->get();
          $client_data[$count]=User::where('id','=',$chatuser['client_id'])->get();
          $message_data[$count]=ChatMessages::where('chat_users_id','=',$chatuser['id'])->orderBy('id','DESC')->get();
          $count++;
        }
        session(['active_element'=>5]);
        return view('admin.message-hist',compact('client_data','message_data'));
    }
    public function message_details($chat_users_id)
    {
      $chatusers=ChatUsers::where('id','=',$chat_users_id)->get();
      $client_data=User::where('id','=',$chatusers[0]['client_id'])->get();
      $company_data=User::where('id','=',$chatusers[0]['company_id'])->get();
      $message_data=ChatMessages::where('chat_users_id','=',$chat_users_id)->get();
      session(['active_element'=>5]);
      return view('admin.message-details',compact('client_data','company_data','message_data'));
    }
    public function chat_messages_duration()
    {
      if($_GET['chat_messages_duration']==1)
      {
        $message_data=ChatMessages::where('chat_users_id','=',$_GET['chat_users_id'])->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()])->get();
      }
      else if($_GET['chat_messages_duration']==2)
      {
        $message_data=ChatMessages::where('chat_users_id','=',$_GET['chat_users_id'])->whereBetween('created_at', [Carbon::now()->subMonth(6), Carbon::now()])->get();
      }
      else if($_GET['chat_messages_duration']==3)
      {
        $message_data=ChatMessages::where('chat_users_id','=',$_GET['chat_users_id'])->whereBetween('created_at', [Carbon::now()->subMonth(12), Carbon::now()])->get();
      }
      else if($_GET['chat_messages_duration']==3)
      {
        $message_data=ChatMessages::where('chat_users_id','=',$_GET['chat_users_id'])->where('created_at', '>', Carbon::now()->subMonth(12))->get();
      }
      return $message_data;
    }
    public function admin_order_option(Request $request){
      if($request->input("admin-option")==-1){
        Order::where('id','=',$request->input("admin-option-order-id"))->update([
          "admin_approved" => 0
        ]);
        Session::flash('update_success_admin', '更新しました!');
        return back();
      }elseif($request->input("admin-option")==0){
        Order::where('id','=',$request->input("admin-option-order-id"))->update([
          "admin_approved" => 1
        ]);
        Session::flash('update_success_admin', '更新しました!');
        return back();
      }elseif($request->input("admin-option")==1){
        Order::where('id','=',$request->input("admin-option-order-id"))->update([
          "suspended" => 1
        ]);
        Session::flash('update_success_admin', '更新しました!');
        return back();
      }elseif($request->input("admin-option")==2){
        Order::with(['BidCompany','Bid'])->where('id','=',$request->input("admin-option-order-id"))->delete();
        Session::flash('update_success_admin', '更新しました!');
        return back();
      }
      Session::flash('update_success_admin', '間違い!');
      return back();
    }
    public function admin_order_send_option(Request $request){
      $order_id=$request->input("admin-order-id-send-option");
      $user_id=$request->input("admin-send-option");

      if(!count(CompanyViewableOrders::where('order_id','=',$order_id)->where('user_id','=',$user_id)->get())){
        $company=User::where('id','=',$user_id)->first();
        $order=Order::where('id','=',$order_id)->first();
        $email = new NewOrder($company,$order);
        Mail::to($company->email)->send($email);
        $new_viewable=new CompanyViewableOrders;
        $new_viewable->user_id = $user_id;
        $new_viewable->order_id = $order_id;
        $new_viewable->save();
        Session::flash('update_success_admin', '更新しました!');
        return back();
      }
      Session::flash('update_success_admin', 'もう存在している!');
      return back();
    }
    public function housekeeper()
    {
      $all_orders=Order::where('bid_status','=',0)->where('suspended','=',0)->where('admin_approved','=',1)->where('bid_status','<>',2)->get();
      foreach($all_orders as $order){
        $dt = Carbon::now();
        $deadline=Carbon::createFromTimeStamp(strtotime($order['deadline-date']));
        $days=$dt->diffInDays($deadline);
        if($days < env('DAYS_BEFORE_DEADLINE_TO_NOTIFY',2)){
          $user=User::where('id','=',$order['user_id'])->first();
          $email = new orderDeadline($user,$order);
          Mail::to($user->email)->send($email);
        }elseif($days == env('DAYS_BEFORE_DEADLINE_TO_NOTIFY',2)){
          $user=User::where('id','=',$order['user_id'])->first();
          $email = new orderSuspended($user,$order);
          Mail::to($user->email)->send($email);
          Order::where('id','=',$order['id'])->update([
            "suspended" => 1
          ]);
        }
      }
      return '';
    }
    public function admin_update_order(Request $request){
      if(Order::where('id','=',$request->input('order_id'))->update([
        "bid_status" => $request->input('bid_status'),
        "pick_up_date" => $request->input('pick_up_date'),
        "pick_up_time" => $request->input('pick_up_time'),
        "pick_up_address" => $request->input('pick_up_address'),
        "journey" => $request->input('journey'),
        "drop_off_date" => $request->input('drop_off_date'),
        "drop_off_time" => $request->input('drop_off_time'),
        "drop_off_address" => $request->input('drop_off_address'),
        "num_of_cars" => $request->input('num_of_cars'),
        "number_of_people" => $request->input('number_of_people'),
        "luggage_num" => $request->input('luggage_num'),
        "car_type" => $request->input('car_type'),
        "remarks" => $request->input('remarks'),
        "deadline-date" => $request->input('deadline-date')
      ])){
        Session::flash('update_success_admin', '更新しました!');
      }else{
        Session::flash('update_success_admin', '間違い!');
      }

      return back();
    }
    public function admin_delete_order($order_id){
      $order=Order::where('id','=',$order_id)->first();
      $bid_companies=BidCompany::where('order_id','=',$order['id'])->get();
      foreach($bid_companies as $bid_company){
        Bid::where('bid_company_id','=',$bid_company['id'])->delete();
      }
      BidCompany::where('order_id','=',$order['id'])->delete();
      CompanyViewableOrders::where('order_id','=',$order['id'])->delete();
      OrderViews::where('order_id','=',$order['id'])->delete();
      Order::where('id','=',$order_id)->delete();
      return redirect('/admin-orders');
    }
}
