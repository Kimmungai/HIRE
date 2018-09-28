@extends('layouts.registering')

@section('content')
<!--<div class="container form-register">
            <h2>パスワード設定</h2>
            <form name="" method="POST" action="set_pass">
              {{csrf_field()}}
            <div class="full">
                <label>パスワード</label>
                <input type="text" name="password" required></div>
            <div class="full">
                <label>パスワード確認</label>
                <input type="text" name="password_check" required></div>
            <div class="full">
            <input type="submit" value="パスワード設定">
            </div>
          </form>
        </div>-->
        <div class="container form-register" ng-controller="ConfirmCtrl" >
          <div class="hero">
              <h2>パスワード設定</h2>
          </div>
                <h2>パスワード設定</h2>
                <form name="formConfirm" ng-submit="onSubmit(formConfirm.$valid)" novalidate="novalidate" method="POST" action="/set_pass">
                  {{ csrf_field() }}
                    <!-- Password input -->
                <div class="full" ng-class="{
                        'has-error':!formConfirm.password.$valid && (!formConfirm.password.$pristine || formConfirm.$submitted),
                        'has-success':formConfirm.password.$valid && (!formConfirm.password.$pristine || formConfirm.$submitted)}">
                    <label>パスワード</label>
                    <input type="password"
                           name="password"
                           required="required"
                           ng-model="formModel.password"
                           pattern="[A-Za-z0-9]{5,15}"
                           min="5"
                           max="15"
                           >
                    <p ng-show="formConfirm.password.$error.required && (!formConfirm.password.$pristine || formRegister.$submitted)">
    				こちらのフィールドはご入力必須です。
    			    </p>
    			    <p ng-show="formConfirm.password.$error.pattern && (!formConfirm.password.$pristine || formRegister.$submitted)">
    				パスワードはロマー字と数字のみ、長さは5-15までご入力ください。
    			    </p>
                    </div>
                    <!-- Password check -->
                <div class="full" ng-class="{
                        'has-error':!formConfirm.password_check.$valid && (!formConfirm.password_check.$pristine || formConfirm.$submitted),
                        'has-success':formConfirm.password_check.$valid && (!formConfirm.password_check.$pristine || formConfirm.$submitted)}">
                    <label>パスワード確認</label>
                    <input type="password"
                           name="password_check"
                           required="required"
                           ng-model="formModel.password_check"
                           ng-pattern="formModel.password"
                           >
                    <p ng-show="formConfirm.password_check.$error.required && (!formConfirm.password_check.$pristine || formRegister.$submitted)">
    				こちらのフィールドはご入力必須です。
    			    </p>
    			    <p ng-show="formConfirm.password_check.$error.pattern && (!formConfirm.password_check.$pristine || formRegister.$submitted)">
    				パスワードは上記のパスワードと違います。
    			    </p>
                    </div>
                <div class="full">
                <input type="submit" value="パスワード設定">
                </div>
                </form>
            </div>
          </div>
@endsection
