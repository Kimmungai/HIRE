
            <!--<form name="form-register" role="form" method="POST" action="/registering">
              {{ csrf_field() }}
            <div class="full">
                <label>アカウント種類</label>
                <select name="cars">
                    <option value="0">ハイヤー会社</option>
                    <option value="1">利用法事</option>
                </select>
            </div>
            <div class="full">
                <label>企業名</label>
                <input type="text" name="hire_comp" required></div>
            <div class="full">
                <label>企業名フリガナ</label>
                <input type="text" name="hire_comp_fu" required></div>
            <div class="full">
                <label>担当者名</label>
            </div>
            <div class="half">
                <input type="text" name="first_name" required>
            </div>
            <div class="half">
                <input type="text" name="last_name" required>
            </div>
            <div class="full">
                <label>担当者名フリガナ</label>
            </div>
            <div class="half">
                <input type="text" name="first_name_fu" required>
            </div>
            <div class="half">
                <input type="text" name="last_name_fu" required>
            </div>
            <div class="full">
                <label>住所</label>
                <input type="text" name="address" required>
            </div>
            <div class="full">
                <label>電話番号</label>
                <input type="tel" name="tel" required>
            </div>
            <div class="full">
                <label>メールアドレス</label>
                <input type="email" name="email" required>
            </div>
            <div class="full">
                <label>メールアドレス確認</label>
                <input type="email" name="hire_email_check" required>
            </div>
            <div class="full">
            <input type="submit" value="登録">
            </div>
          </form>-->
          @extends('layouts.registering')

          @section('content')

                    <div class="hero">
                        <h2>登録フォーム</h2>
                    </div>
                      <h2>登録フォーム</h2>
                      @if (Session::has('message'))
                      <h2>{{ Session::get('message') }}</h2>
                      @endif
                      <form name="formRegister" ng-submit="onSubmit(formRegister.$valid)" novalidate="novalidate" method="POST" action="/registering">
                        {{ csrf_field() }}
                      <div class="full">
                          <label>アカウント種類</label>
                          <select name="cars">
                            <option value="0">ハイヤー会社</option>
                            <option value="1">利用法事</option>
                          </select>
                      </div>
                          <!-- Company name -->
                      <div class="full" ng-class="{
                              'has-error':!formRegister.hire_comp.$valid && (!formRegister.hire_comp.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_comp.$valid && (!formRegister.hire_comp.$pristine || formRegister.$submitted)}">
                          <label>企業名</label>
                          <input type="text"
                                 name="hire_comp"
                                 ng-model="formModel.hire_comp"
                                 required="required"
                                 pattern="[^()/><\][\\\x22,;|]+"
                                 >
                          <p ng-show="formRegister.hire_comp.$error.required && (!formRegister.hire_comp.$pristine || formRegister.$submitted)">
          				こちらのフィールドはご入力必須です。
          			    </p>
          			    <p ng-show="formRegister.hire_comp.$error.pattern && (!formRegister.hire_comp.$pristine || formRegister.$submitted)">
          				企業名は文字、数字とハイフンのみご入力ください。
          			    </p>
                          </div>
                          <!-- Company furigana name -->
                      <div class="full" ng-class="{
                              'has-error':!formRegister.hire_comp_fu.$valid && (!formRegister.hire_comp_fu.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_comp_fu.$valid && (!formRegister.hire_comp_fu.$pristine || formRegister.$submitted)}">
                          <label>企業名フリガナ</label>
                          <input type="text"
                                 name="hire_comp_fu"
                                 ng-model="formModel.hire_comp_fu"
                                 required="required"
                                 pattern="^[ァ-ンヴー]+$"
                                 >
                          <p ng-show="formRegister.hire_comp_fu.$error.required && (!formRegister.hire_comp_fu.$pristine || formRegister.$submitted)">
          				こちらのフィールドはご入力必須です。
          			    </p>
          			    <p ng-show="formRegister.hire_comp_fu.$error.pattern && (!formRegister.hire_comp_fu.$pristine || formRegister.$submitted)">
          				全角のカタカナのみご入力ください。
          			    </p>
                          </div>
                      <!-- Name of the person in charge -->
                      <div class="full">
                          <label>担当者名</label>
                      </div>
                      <!-- Last name of the person in charge -->
                      <div class="half" ng-class="{
                              'has-error':!formRegister.hire_last_name.$valid && (!formRegister.hire_last_name.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_last_name.$valid && (!formRegister.hire_last_name.$pristine || formRegister.$submitted)}">
                          <input type="text"
                                 name="hire_last_name"
                                 required="required"
                                 placeholder="姓："
                                 ng-model="formModel.hire_last_name"
                                 required="required"
                                 pattern="[^()/><\][\\\x22,;|]+"
                                 >
                          <p ng-show="formRegister.hire_last_name.$error.required && (!formRegister.hire_last_name.$pristine || formRegister.$submitted)">
          				こちらのフィールドはご入力必須です。
          			    </p>
          			    <p ng-show="formRegister.hire_last_name.$error.pattern && (!formRegister.hire_last_name.$pristine || formRegister.$submitted)">
          				お名前は文字のみご入力ください。
          			    </p>
                      </div>
                      <!-- First name of the person in charge -->
                      <div class="half" ng-class="{
                              'has-error':!formRegister.hire_first_name.$valid && (!formRegister.hire_first_name.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_first_name.$valid && (!formRegister.hire_first_name.$pristine || formRegister.$submitted)}">
                          <input type="text"
                                 name="hire_first_name"
                                 required="required"
                                 placeholder="名："
                                 ng-model="formModel.hire_first_name"
                                 required="required"
                                 pattern="[^()/><\][\\\x22,;|]+"
                                 >
                          <p ng-show="formRegister.hire_first_name.$error.required && (!formRegister.hire_first_name.$pristine || formRegister.$submitted)">
          				こちらのフィールドはご入力必須です。
          			    </p>
          			    <p ng-show="formRegister.hire_first_name.$error.pattern && (!formRegister.hire_first_name.$pristine || formRegister.$submitted)">
          				お名前は文字のみご入力ください。
          			    </p>
                      </div>
                      <!-- Reading of the name of person in charge -->
                      <div class="full">
                          <label>担当者名フリガナ</label>
                      </div>
                          <!-- Reading of the nlast name -->
                      <div class="half" ng-class="{
                              'has-error':!formRegister.hire_last_name_fu.$valid && (!formRegister.hire_last_name_fu.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_last_name_fu.$valid && (!formRegister.hire_last_name_fu.$pristine || formRegister.$submitted)}">
                          <input type="text"
                                 name="hire_last_name_fu"
                                 required="required"
                                 placeholder="セイ："
                                 ng-model="formModel.hire_last_name_fu"
                                 required="required"
                                 pattern="^[ァ-ンヴー]+$"
                                 >
                          <p ng-show="formRegister.hire_last_name_fu.$error.required && (!formRegister.hire_last_name_fu.$pristine || formRegister.$submitted)">
          				こちらのフィールドはご入力必須です。
          			    </p>
          			    <p ng-show="formRegister.hire_last_name_fu.$error.pattern && (!formRegister.hire_last_name_fu.$pristine || formRegister.$submitted)">
          				全角カタカナのみご入力ください。
          			    </p>
                      </div>
                          <!-- Reading of the first name -->
                      <div class="half" ng-class="{
                              'has-error':!formRegister.hire_first_name_fu.$valid && (!formRegister.hire_first_name_fu.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_first_name_fu.$valid && (!formRegister.hire_first_name_fu.$pristine || formRegister.$submitted)}">
                          <input type="text"
                                 name="hire_first_name_fu"
                                 required="required"
                                 placeholder="メイ："
                                 ng-model="formModel.hire_first_name_fu"
                                 pattern="^[ァ-ンヴー]+$"
                                 >
                          <p ng-show="formRegister.hire_first_name_fu.$error.required && (!formRegister.hire_first_name_fu.$pristine || formRegister.$submitted)">
          				こちらのフィールドはご入力必須です。
          			    </p>
          			    <p ng-show="formRegister.hire_first_name_fu.$error.pattern && (!formRegister.hire_first_name_fu.$pristine || formRegister.$submitted)">
          				全角カタカナのみご入力ください。
          			    </p>
                      </div>
                          <!-- Address -->
                      <div class="full" ng-class="{
                              'has-error':!formRegister.hire_address.$valid && (!formRegister.hire_address.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_address.$valid && (!formRegister.hire_address.$pristine || formRegister.$submitted)}">
                          <label>住所</label>
                          <input type="text"
                                 name="hire_address"
                                 required="required"
                                 ng-model="formModel.hire_address"
                                 pattern="[^()/><\][\\\x22,;|]+"
                                 >
                          <p ng-show="formRegister.hire_address.$error.required && (!formRegister.hire_address.$pristine || formRegister.$submitted)">
          				こちらのフィールドはご入力必須です。
          			    </p>
          			    <p ng-show="formRegister.hire_address.$error.pattern && (!formRegister.hire_address.$pristine || formRegister.$submitted)">
          				住所は文字、数字とハイフンのみご入力ください。
          			    </p>
                      </div>
                      <div class="full" ng-class="{
                              'has-error':!formRegister.hire_tel.$valid && (!formRegister.hire_tel.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_tel.$valid && (!formRegister.hire_tel.$pristine || formRegister.$submitted)}">
                          <label>電話番号</label>
                          <input type="tel"
                                 name="hire_tel"
                                 required="required"
                                 ng-model="formModel.hire_tel"
                                 pattern="[0-9\-+]+">
                          <p ng-show="formRegister.hire_tel.$error.required && (!formRegister.hire_tel.$pristine || formRegister.$submitted)">
          				こちらのフィールドはご入力必須です。
          			    </p>
          			    <p ng-show="formRegister.hire_tel.$error.pattern && (!formRegister.hire_tel.$pristine || formRegister.$submitted)">
          				電話番号は数字とハイフンのみご入力ください。
          			    </p>
                      </div>
                      <div class="full" ng-class="{
                              'has-error':!formRegister.hire_email.$valid && (!formRegister.hire_email.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_email.$valid && (!formRegister.hire_email.$pristine || formRegister.$submitted)}">
                          <label>メールアドレス</label>
                          <input type="email"
                                 name="hire_email"
                                 required="required"
                                 ng-model="formModel.hire_email"
                                 >
                          <p ng-show="formRegister.hire_email.$error.required && (!formRegister.hire_email.$pristine || formRegister.$submitted)">
          				こちらのフィールドはご入力必須です。
          			    </p>
          			    <p ng-show="formRegister.hire_email.$error.email && (!formRegister.hire_email.$pristine || formRegister.$submitted)">
          				正しいメールアドレスご入力ください。
          			    </p>
                      </div>
                      <div class="full" ng-class="{
                              'has-error':!formRegister.hire_email_check.$valid && (!formRegister.hire_email_check.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_email_check.$valid && (!formRegister.hire_email_check.$pristine || formRegister.$submitted)}">
                          <label>メールアドレス確認</label>
                          <input type="email"
                                 name="hire_email_check"
                                 required="required"
                                 ng-model="formModel.hire_email_check"
                                 ng-pattern="formModel.hire_email"
                                 >
                          <p ng-show="formRegister.hire_email_check.$error.required && (!formRegister.hire_email_check.$pristine || formRegister.$submitted)">
          				こちらのフィールドはご入力必須です。
          			    </p>
          			    <p ng-show="formRegister.hire_email_check.$error.pattern && (!formRegister.hire_email_check.$pristine || formRegister.$submitted)">
          				上記と同じメールアドレスご入力ください。
          			    </p>
                      </div>
                      <div class="full">
                      <input type="submit" value="登録">
                      </div>
                      </form>
                  </div>
                </div>
              @endsection
