@extends('layouts.hire')
@section('content')
<ol class="breadcrumb">
    <li><a href="#">トップ</a></li>
    <li class="current"><a href="#">会員情報</a></li>
</ol>

<div class="mydetails">
  @if (Session::has('user_updates_reg_details'))
  <h3>{{ Session::get('user_updates_reg_details') }}</h3>
  @endif
    <h3>登録情報</h3>
    <form action="/update_reg_details" method="POST">
      {{csrf_field()}}
    <label>ID：</label>
    <p>user{{$user_details['id']}}</p><br>
    <label>会社名:</label>
    <input name="company_name" type="text" value="{{$user_details['company_name']}}" required><br>
    <label>会社名フリガナ:</label>
    <input name="company_name_furigana" type="text" value="{{$user_details['company_name_furigana']}}" required><br>
    <label>姓:</label>
    <input name="last_name" type="text" value="{{$user_details['last_name']}}" required><br>
    <label>名:</label>
    <input name="first_name" type="text" value="{{$user_details['first_name']}}" required><br>
    <label>セイ:</label>
    <input name="last_name_furigana" type="text" value="{{$user_details['last_name_furigana']}}" required><br>
    <label>メイ:</label>
    <input name="first_name_furigana" type="text" value="{{$user_details['first_name_furigana']}}" required><br>
    <label>住所:</label>
    <input name="address" type="text" value="{{$user_details['address']}}" required><br>
    <label>電話番号:</label>
    <input  type="text" value="{{$user_details['tel']}}" required><br>
        <input type="submit" class="submit" value="保存"  />
    </form>
    <h3>パスワード変更</h3>
    <h3>{{ Session::get('password_mismatch') }}</h3>
    <form action="/set_pass" method="POST">
      {{csrf_field()}}
    <label>現在パスワード</label>
    <input name="password" type="password" ><br>
    <label>現在パスワード</label>
    <input name="password_check" type="password" ><br>
     <input type="submit" class="submit" value="パスワード変更" />
    </form>
</div>


</div>
@endsection
