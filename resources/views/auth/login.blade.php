@extends('layouts.registering')

@section('content')
<div class="hero">
    <h2>ログイン</h2>
</div>
<div class="form-register" ng-controller="ConfirmCtrl">
            <h2> ログイン </h2>
            @if (Session::has('error'))
            <h2>{{ Session::get('error') }}</h2>
            @endif
            <form name="formConfirm" ng-submit="onSubmit(formConfirm.$valid)" novalidate="novalidate" method="POST" action="{{ url('/login') }}">
              {{ csrf_field() }}
                <!-- Password input -->
            <div class="full">
                <label> メールアドレス </label>
                <input type="email"
                       name="email"
                       required="required"
                        value="{{ old('email') }}" autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>
                <!-- Password check -->
            <div class="full">
                <label>パスワード</label>
                <input type="password"
                       name="password"
                       required="required"
                       >
                       @if ($errors->has('password'))
                           <span class="help-block">
                               <strong>{{ $errors->first('password') }}</strong>
                           </span>
                       @endif
                </div>
            <div class="full">
                <button type="submit" class="submit">ログイン</button>
                <a class="btn btn-primary" href="{{ url('/password/reset') }}">
                    パスワード忘れた方
                </a>
                <a class="btn btn-primary pull-right" href="{{ url('/registering') }}">
                    会員登録
                </a>
            </div>
            </form>
        </div>
      </div>
@endsection
