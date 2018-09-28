<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\BidCompany;
use App\Bid;
use Session;

class admin extends Controller
{
    public function company_accounts()
    {
      $user_data=User::where('user_category','=',0)->where('admin_approved','<>',2)->paginate(10);
      session(['active_element'=>1]);
      return view('admin.company-accounts',compact('user_data'));
      //return $user_data;
    }
    public function search_company(Request $request)
    {
      $search_query=$request->input('search-query');
      $user_data=User::where('user_category','=',0)->where('company_name','like','%'.$search_query.'%')->where('admin_approved','<>',2)->orWhere('email','like','%'.$search_query.'%')->paginate(10);
      if(empty($user_data))
      {
          Session::flash('no-search-results', 'Records not found!');
          return back();
      }
      else {

        Session::flash('no-search-results', count($user_data).' Records found!');
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
      Session::flash('update_success_admin', 'Record updated!');
      //$data=User::where('user_category','=',0)->where('id','=',$request->input('id'))->get();
      //return view('admin.company-accounts-details',compact('data'));
      //return $request->input('id');
      return back();
    }
    public function delete_company_record(Request $request)
    {
      User::where('id','=',$request->input('id'))->update(['admin_approved'=>2]);
      Session::flash('no-search-results', 'Record deleted!');
      //$data=User::where('user_category','=',0)->where('id','=',$request->input('id'))->where('admin_approved','<>',2)->get();
      return $this->company_accounts();
    }
    public function client_accounts()
    {
      $user_data=User::where('user_category','=',1)->where('admin_approved','<>',2)->paginate(10);
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
      Session::flash('update_success_admin', 'Record updated!');
      //$data=User::where('user_category','=',0)->where('id','=',$request->input('id'))->get();
      //return view('admin.company-accounts-details',compact('data'));
      //return $request->input('id');
      return back();
    }
    public function delete_client_record(Request $request)
    {
      User::where('id','=',$request->input('id'))->update(['admin_approved'=>2]);
      Session::flash('no-search-results', 'Record deleted!');
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
      $data=Order::where('id','=',$order_id)->get();
      $bid_companies=BidCompany::where('order_id','=',$order_id)->get();
      $count=0;
      foreach($bid_companies as $bid_company)
      {
        $bidder_email[$count]=User::where('id','=',$bid_company['user_id'])->value('email');
        $bidder_name[$count]=User::where('id','=',$bid_company['user_id'])->value('first_name');
        $bidder_latest_price[$count]=Bid::where('bid_company_id','=',$bid_company['id'])->orderBy('id','desc')->value('price');
        $count++;
      }
      session(['active_element'=>3]);
      return view('admin.order-details',compact('data','bid_companies','bidder_email','bidder_name','bidder_latest_price'));
    }
    public function transactions()
    {
      $data=Order::where('bid_status','=',1)->paginate(10); //get finalized orders
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
      $data=User::where('admin_approved','=',2)->paginate(10);
      session(['active_element'=>6]);
      return view('admin.trash',compact('data'));
    }
    public function deleted_company_details($user_id)
    {
      $data=user::where('id','=',$user_id)->where('admin_approved','=',2)->get();
      session(['active_element'=>6]);
      return view('admin.trash-details',compact('data'));
    }
    public function restore_company_record(Request $request)
    {
      User::where('id','=',$request->input('id'))->update(['admin_approved'=>1]);//user now approved by admin
      Session::flash('trash_page', 'Company '.$request->input('company_name').' restored!');
      return $this->deleted_companies();
    }
    public function delete_record_permanently(Request $request)
    {
      User::where('id','=',$request->input('id'))->update(['admin_approved'=>10]);//admin_approved value 10 indicates permanet deletion
        Session::flash('trash_page', 'Company '.$request->input('company_name').' deleted permanently!');
      return $this->deleted_companies();
    }
}
