<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\users;
use App\User;
use App\Order;
use App\BidCompany;
use App\Bid;
use App\ChatUsers;
use App\ChatMessages;
use Auth;
use App\Mail\EmailVerification;
use Mail;
use Session;
use DB;
use Carbon\Carbon;

class users extends Controller
{
    public function index()
    {
      $client_data=Order::orderBy('id','Desc')->where('bid_status','=',1)->paginate(10);
      $count=0;
      foreach($client_data as $client_datum)
      {
        $price_agreed[$count]=BidCompany::where('order_id','=',$client_datum['id'])->where('price_agreed','<>','')->value('price_agreed');
        $num_companies_bidding[$count]=count(BidCompany::with('Bid')->where('order_id','=',$client_datum['id'])->get());
        $company_id=$client_datum['user_id'];
        $company_name[$count]=User::where('id','=',$company_id)->value('company_name');
        $count++;
      }
      if(Auth::user())
      {
        if((Auth::user()->user_category)==0)
        {
          $two_days_ago=date('Y-m-d H:i:s',time()-172800);
          $num_orders=count(Order::where('bid_status','<>',2)->where('created_at','>=',$two_days_ago)->get());
          return view('company-top', compact('client_data','price_agreed','num_companies_bidding','company_name','num_orders'));//company data
        }
        else if((Auth::user()->user_category)==1)
        {
          return view('client-top', compact('client_data','price_agreed','company_name'));
        }
      }
      return view('client-top', compact('client_data','price_agreed','company_name'));
      //return $client_data;
    }
    public function client_order($order_id)
    {
        $user_id = Auth::id();
        $client_order=Order::with(['BidCompany','Bid'])->where('bid_status','<>',2)->where('id','=',$order_id)->get();
        return view('client_order_view', compact('client_order'));
    }
    public function client_orders_all()
    {
        $user_id = Auth::id();
        $all_user_orders=Order::with(['BidCompany','Bid'])->where('bid_status','<>',2)->where('user_id','=',$user_id)->orderBy('id','Desc')->get();
        return view('client_order_view_all',compact('all_user_orders'));
    }
    public function open_client_bids()
    {
      $user_id = Auth::id();
      $all_user_orders=Order::with(['BidCompany','Bid'])->where('user_id', '=', $user_id)->where('bid_status','=',0)->orderBy('id','Desc')->get();
      return view('client_order_view_all',compact('all_user_orders'));
    }
    public function closed_client_bids()
    {
      $user_id = Auth::id();
      $all_user_orders=Order::with(['BidCompany','Bid'])->where('user_id', '=', $user_id)->where('bid_status','=',1)->orderBy('id','Desc')->get();
      return view('client_order_view_all',compact('all_user_orders'));
    }
    public function set_pass(Request $request)
    {
        $user=new User;
        if($request->input('password')==$request->input('password_check'))
        {
          $user_id = Auth::id();
          $updated_password=bcrypt($request->input('password'));
          DB::table('users')->where('id', $user_id)->update(['password' => $updated_password]);
          return redirect('/');
        }
        else
        {
          return back();
        }
    }
    public function client_myapage()
    {
      $user_details=Auth::user();
      return view('user-info',compact('user_details'));
    }
    public function update_reg_details(Request $request)
    {
      $user_id=Auth::id();
      User::where('id','=',$user_id)->update([
        'company_name'=>$request->input('company_name'),
        'company_name_furigana'=>$request->input('company_name_furigana'),
        'last_name'=>$request->input('last_name'),
        'first_name'=>$request->input('first_name'),
        'last_name_furigana'=>$request->input('last_name_furigana'),
        'first_name_furigana'=>$request->input('first_name_furigana'),
        'address'=>$request->input('address')
      ]);
      Session::flash('user_updates_reg_details', 'Saved!');
      return back();
    }
    public function cancel_order($order_id)
    {
      Order::where('id','=',$order_id)->update(['bid_status' => 2]);
      return $this->client_orders_all();
    }
    public function choose_company(Request $request)
    {
      Order::where('id','=',$request->input('order'))->update(['bid_status' => 1]);
      $bid=Bid::where('id','=',$request->input('bid'))->get();
      BidCompany::where('id','=',$bid[0]['bid_company_id'])->update([
        'price_agreed'=>$bid[0]['price']
      ]);
      Session::flash('order_closed', 'Your order has been closed, check your email!');//need a jap message
      $client_email=Auth::user()->email;
      $company_id=BidCompany::where('id','=',$bid[0]['bid_company_id'])->value('user_id');
      $company_email=User::where('id','=',$company_id)->value('email');

      if(count(ChatUsers::where('client_id','=',Auth::id())->where('company_id','=',$company_id)->get())==0)
      {
        $createChatUsers=new ChatUsers;
        $createChatUsers->client_id=Auth::id();
        $createChatUsers->company_id=$company_id;
        $createChatUsers->save();
      }
      $client_message='Your order has been closed';
      $company_message='You have been chosen!';
      mail($client_email,'Order Confirmed',$client_message);
      mail($company_email,'Bid Accepted',$company_message);

      return back();
    }
    public function select_chat_company()
    {
      $bid_id=$_GET['bid_id'];
      $company_id=BidCompany::where('id','=',$bid_id)->value('user_id');
      if(count(ChatUsers::where('client_id','=',Auth::id())->where('company_id','=',$company_id)->get())==0)
      {
        $createChatUsers=new ChatUsers;
        $createChatUsers->client_id=Auth::id();
        $createChatUsers->company_id=$company_id;
        $createChatUsers->save();
      }
      return;
    }
    public function create(Request $request)
    {
        if(User::where('email','=',$request->input('hire_email')))
        {
          Session::flash('message', 'Email already exists!');
          return back();
        }
        $new_user=new User;
        $email_token=str_random(10);
        $new_user->user_category=$request->input('cars');
        $new_user->company_name=$request->input('hire_comp');
        $new_user->company_name_furigana=$request->input('hire_comp_fu');
        $new_user->first_name=$request->input('hire_first_name');
        $new_user->first_name_furigana=$request->input('hire_first_name_fu');
        $new_user->last_name=$request->input('hire_last_name');
        $new_user->last_name_furigana=$request->input('hire_last_name_fu');
        $new_user->address=$request->input('hire_address');
        $new_user->tel=$request->input('hire_tel');
        $new_user->email=$request->input('hire_email');
        if($request->input('hire_email')===$request->input('hire_email_check'))//ensure emails MongoDeleteBatch
        {
          $new_user->email_token=$email_token;
          $email = new EmailVerification(new User(['email_token' => $email_token, 'hire_first_name' => $request->input('hire_first_name')]));
          Mail::to($request->input('hire_email'))->send($email);
          Session::flash('message', 'We have sent you a verification email!');
          $new_user->save();
          return back();
        }
        else
        {
           return back()->withInput();
        }
    }
    public function registering()
    {
      if(Auth::user())
      {
        return back();
      }
      return view('registering');
    }
    public function check_messages()
    {
      $company_ids=ChatUsers::where('client_id','=',Auth::id())->get();
      $count=0;
      $company_names=array();
      foreach($company_ids as $company_id)
      {
        $company_data=array();
        $unread_messages=count(ChatMessages::where('chat_users_id','=',$company_id['id'])->where('recipient_id','=',Auth::id())->get());
        $login_time_secs=User::where('id','=',$company_id['client_id'])->value('last_login');if($login_time_secs){$login_time_secs=strtotime(Carbon::now())-$login_time_secs;}
        $company_data[0]=User::where('id','=',$company_id['company_id'])->value('company_name');
        $company_data[1]=User::where('id','=',$company_id['company_id'])->value('id');
        $company_data[2]=$unread_messages;
        $company_data[3]=User::where('id','=',$company_id['client_id'])->value('online_status');
        $company_data[4]=$login_time_secs;
        $company_names[$count]=$company_data;
        $count++;
      }
      if(count($company_names))
      {
        return $company_names;
      }
      return;
    }
    public function check_messages_company()
    {
      if(Auth::user()->user_category==0)
      {
        $ids=ChatUsers::where('company_id','=',Auth::id())->get();
      }
      else if(Auth::user()->user_category==1)
      {
        $ids=ChatUsers::where('client_id','=',Auth::id())->get();
      }
      $count=0;
      $client_names=array();
      foreach($ids as $client_id)
      {
        $client_data=array();
        $unread_messages=count(ChatMessages::where('chat_users_id','=',$client_id['id'])->where('recipient_id','=',Auth::id())->get());
        $login_time_secs=User::where('id','=',$client_id['client_id'])->value('last_login');if($login_time_secs){$login_time_secs=strtotime(Carbon::now())-$login_time_secs;}
        $client_data[0]=User::where('id','=',$client_id['client_id'])->value('company_name');
        $client_data[1]=User::where('id','=',$client_id['client_id'])->value('id');
        $client_data[2]=$unread_messages;
        $client_data[3]=User::where('id','=',$client_id['client_id'])->value('online_status');
        $client_data[4]=$login_time_secs;
        $client_names[$count]=$client_data;
        $count++;
      }
      if(count($client_names))
      {
        return $client_names;
      }
    }
    public function retrieve_messages()
    {
      if(Auth::user()->user_category==0)
      {
        $client_id=$_GET['id'];
        $company_id=Auth::id();
      }
      else if(Auth::user()->user_category==1)
      {
        $client_id=Auth::id();
        $company_id=$_GET['id'];
      }
      $chat_users_id=ChatUsers::where('client_id','=',$client_id)->where('company_id','=',$company_id)->value('id');
      $chat_messages=ChatMessages::where('chat_users_id','=',$chat_users_id)->get();
      ChatMessages::where('chat_users_id','=',$chat_users_id)->where('recipient_id','=',Auth::id())->update(['recipient_id'=>0]);
      //$unread_messages=count(ChatMessages::where('chat_users_id','=',$chat_users_id)->where('state','=',0)->get());
      /*$data=array();
      $count=0;
      foreach($chat_messages as $chat_message)
      {
        $message_data=array();
        ChatMessages::where('id','=',$chat_message['id'])->update(['state'=>1]);
        $message_data[0]=$chat_message['message'];
        $message_data[1]=$chat_message['created_at']->format('d/m/Y H:i:s');
        $message_data[2]=User::where('id','=',$client_id)->value('company_name');
        $message_data[3]=$chat_message['author_id'];
        $message_data[4]=$chat_message['id'];
        $data[$count]=$message_data;
        $count++;
      }
      return $data;*/
      return $chat_messages;
    }
    public function save_message()
    {
      if(Auth::user()->user_category==0)
      {
        $client_id=$_GET['id'];
        $company_id=Auth::id();
      }
      else if(Auth::user()->user_category==1)
      {
        $client_id=Auth::id();
        $company_id=$_GET['id'];
      }
      $chat_users_id=ChatUsers::where('client_id','=',$client_id)->where('company_id','=',$company_id)->value('id');
      $message_data=$_GET['message'];
      //save message
      $message=new ChatMessages;
      $message->chat_users_id=$chat_users_id;
      $message->message=$message_data;
      $message->user_id=Auth::id();
      $message->recipient_id=$_GET['id'];
      $message->save();

      return;
    }
    public function all_unread_messages()
    {
      if(Auth::user()->user_category==0)
      {
        $client_ids=ChatUsers::where('company_id','=',Auth::id())->get();
        $count=0;
        $unread_messages=0;
        foreach($client_ids as $client_id)
        {
          $unread_messages +=count(ChatMessages::where('chat_users_id','=',$client_id['id'])->where('recipient_id','=',Auth::id())->get());
          $count++;
        }
        return $unread_messages;
      }
      else if(Auth::user()->user_category==1)
      {
        $company_ids=ChatUsers::where('client_id','=',Auth::id())->get();
        $count=0;
        $unread_messages=0;
        foreach($company_ids as $company_id)
        {
          $unread_messages += count(ChatMessages::where('chat_users_id','=',$company_id['id'])->where('recipient_id','=',Auth::id())->get());
          $count++;
        }
        return $unread_messages;
      }
    }
}
