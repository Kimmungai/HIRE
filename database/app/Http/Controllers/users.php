<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\users;
use App\User;
use App\Order;
use Auth;
use App\Mail\EmailVerification;
use Mail;
use Session;
use DB;

class users extends Controller
{
    public function index()
    {
      $data=User::with('order')->get();
      return view('top', compact('data'));
    }
    public function client_order()
    {
        $user_id = Auth::id();
        $latest_order=Order::where('user_id', '=', $user_id)->orderBy('id','Desc')->first();
        return view('client_order_view', compact('latest_order'));
        //return $latest_order;
    }
    public function client_orders_all()
    {
        return view('client_order_view_all');
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
    public function create(Request $request)
    {
        $new_user=new User;
        $email_token=str_random(10);
        $new_user->user_category=$request->input('cars');
        $new_user->company_name=$request->input('hire_comp');
        $new_user->company_name_furigana=$request->input('hire_comp_fu');
        $new_user->first_name=$request->input('first_name');
        $new_user->first_name_furigana=$request->input('first_name_fu');
        $new_user->last_name=$request->input('last_name');
        $new_user->last_name_furigana=$request->input('last_name_fu');
        $new_user->address=$request->input('address');
        $new_user->tel=$request->input('tel');
        $new_user->email=$request->input('email');
        $new_user->email_token=$email_token;
        $email = new EmailVerification(new User(['email_token' => $email_token, 'first_name' => $request->input('first_name')]));
        Mail::to($request->input('email'))->send($email);
        Session::flash('message', 'We have sent you a verification email!');
        $new_user->save();
        //return $request->all();
        return back();
    }
}
