@extends('layouts.registering')

@section('content')
<div class="hero">
    <h2>パスワードをリセット</h2>
</div>
<div class="form-register" ng-controller="ConfirmCtrl">
            <h2> ログインの際に使用するパスワードを設定して下さい。 </h2>
            @if (Session::has('message'))
            <h2>{{ Session::get('error') }}</h2>
            @endif
            <form id="password-reset"  role="form" method="POST" action="{{ url('/password/reset') }}">
              {{ csrf_field() }}
              <input type="hidden" name="token" value="{{ $token }}">
                <!-- Password input -->
            <div class="full">
                <label> メールアドレス </label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>
                <!-- Password check -->
            <div class="full">
                <label>パスワード</label>
                <input id="password" type="password" class="form-control" name="password" required>
                       @if ($errors->has('password'))
                           <span class="help-block">
                               <strong>{{ $errors->first('password') }}</strong>
                           </span>
                       @endif
                </div>
                <div class="full">
                    <label>パスワード確認</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                           @if ($errors->has('password_confirmation'))
                               <span class="help-block">
                                   <strong>{{ $errors->first('password_confirmation') }}</strong>
                               </span>
                           @endif
                    </div>
            <div class="full">
                <button type="submit" class="submit" onclick="reset_message('password-reset')">リセット</button>
            </div>
            </form>
        </div>
      </div>
      <script>
        function reset_message(id){
          event.preventDefault();
          $("#"+id).submit();
          alert("パスワードがリセットされました。");
        }
      </script>
@endsection
