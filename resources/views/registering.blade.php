
          @extends('layouts.registering')

          @section('content')
                    <div class="hero">
                        <h2>登録フォーム</h2>
                    </div>
                      <h2>登録フォーム</h2>
                      @if (Session::has('message'))
                      <h2>{{ Session::get('message') }}</h2>
                      @endif
                      <form name="formRegister" id="formRegister" ng-submit="onSubmit(formRegister.$valid)" novalidate method="POST" action="/registering">
                        {{ csrf_field() }}
                      <div class="full">
                        <label>アカウント種類</label>
                        <!--<select name="cars">
                          <option value="0">ハイヤー会社</option>
                          <option value="1">利用者</option>
                        </select>-->
                      </div>
                      <div class="half">
                        <div class="account-box <?php if(old('cars') != ''){if(old('cars')=="0"){?>fill-color<?php }}else{?> fill-color<?php }?>" id="company-Acc" onclick="select_account(this.id)">ハイヤー会社 <input id="check-company-Acc" name="cars" type="radio" class="hidden" value="0" checked /></div>
                      </div>
                      <div class="half">
                        <div class="account-box <?php if(old('cars') != ''){if(old('cars')=="1"){?>fill-color<?php }}?>" id="user-Acc" onclick="select_account(this.id)">利用者 <input id="check-user-Acc" name="cars" type="radio" class="hidden" value="1" /></div>
                      </div>
                          <!-- Company name -->
                      <div class="full" ng-class="{
                              'has-error':!formRegister.hire_comp.$valid && (!formRegister.hire_comp.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_comp.$valid && (!formRegister.hire_comp.$pristine || formRegister.$submitted)}">
                          <label class="user-only">企業名</label>
                          <span class="company-only hidden">企業名</span>
                          <input type="text"
                                 name="hire_comp"
                                 ng-model="formModel.hire_comp"

                                 pattern="[^()/><\][\\\x22,;|]+"
                                >
                          <p ng-show="formRegister.hire_comp.$error.required && (!formRegister.hire_comp.$pristine || formRegister.$submitted)">
          				入力必須項目です。
          			    </p>
                    @if($errors->has('hire_comp'))
                    <p class="validation-errors">{{ $errors->first('hire_comp') }}</p>
                    @endif
          			    <p ng-show="formRegister.hire_comp.$error.pattern && (!formRegister.hire_comp.$pristine || formRegister.$submitted)">
          				企業名は文字、数字とハイフンのみご入力ください。
          			    </p>
                          </div>
                          <!-- Company furigana name -->
                      <div class="full" ng-class="{
                              'has-error':!formRegister.hire_comp_fu.$valid && (!formRegister.hire_comp_fu.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_comp_fu.$valid && (!formRegister.hire_comp_fu.$pristine || formRegister.$submitted)}">
                          <label class="user-only">企業名フリガナ</label>
                          <span class="company-only hidden">企業名フリガナ</span>
                          <input type="text"
                                 name="hire_comp_fu"
                                 ng-model="formModel.hire_comp_fu"

                                 pattern="^[ァ-ンヴー]+$"
                                 >
                          <p ng-show="formRegister.hire_comp_fu.$error.required && (!formRegister.hire_comp_fu.$pristine || formRegister.$submitted)">
          				入力必須項目です。
          			    </p>
                    @if($errors->has('hire_comp_fu'))
                    <p class="validation-errors">{{ $errors->first('hire_comp_fu') }}</p>
                    @endif
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

                                 pattern="[^()/><\][\\\x22,;|]+"
                                 >
                          <p ng-show="formRegister.hire_last_name.$error.required && (!formRegister.hire_last_name.$pristine || formRegister.$submitted)">
          				入力必須項目です。
          			    </p>
          			    <p ng-show="formRegister.hire_last_name.$error.pattern && (!formRegister.hire_last_name.$pristine || formRegister.$submitted)">
          				お名前は文字のみご入力ください。
          			    </p>
                    @if($errors->has('hire_last_name'))
                    <p class="validation-errors">{{ $errors->first('hire_last_name') }}</p>
                    @endif
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

                                 pattern="[^()/><\][\\\x22,;|]+"
                                 >
                          <p ng-show="formRegister.hire_first_name.$error.required && (!formRegister.hire_first_name.$pristine || formRegister.$submitted)">
          				入力必須項目です。
          			    </p>
          			    <p ng-show="formRegister.hire_first_name.$error.pattern && (!formRegister.hire_first_name.$pristine || formRegister.$submitted)">
          				お名前は文字のみご入力ください。
          			    </p>
                    @if($errors->has('hire_first_name'))
                    <p class="validation-errors">{{ $errors->first('hire_first_name') }}</p>
                    @endif
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

                                 pattern="^[ァ-ンヴー]+$"
                                 >
                          <p ng-show="formRegister.hire_last_name_fu.$error.required && (!formRegister.hire_last_name_fu.$pristine || formRegister.$submitted)">
          				入力必須項目です。
          			    </p>
          			    <p ng-show="formRegister.hire_last_name_fu.$error.pattern && (!formRegister.hire_last_name_fu.$pristine || formRegister.$submitted)">
          				全角カタカナのみご入力ください。
          			    </p>
                    @if($errors->has('hire_last_name_fu'))
                    <p class="validation-errors">{{ $errors->first('hire_last_name_fu') }}</p>
                    @endif
                      </div>
                          <!-- Reading of the first name -->
                      <div class="half" ng-class="{
                              'has-error':!formRegister.hire_first_name_fu.$valid && (!formRegister.hire_first_name_fu.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_first_name_fu.$valid && (!formRegister.hire_first_name_fu.$pristine || formRegister.$submitted)}">
                          <input type="text"
                                 name="hire_first_name_fu"

                                 placeholder="メイ："
                                 ng-model="formModel.hire_first_name_fu"
                                 pattern="^[ァ-ンヴー]+$"
                                 >
                          <p ng-show="formRegister.hire_first_name_fu.$error.required && (!formRegister.hire_first_name_fu.$pristine || formRegister.$submitted)">
          				入力必須項目です。
          			    </p>
          			    <p ng-show="formRegister.hire_first_name_fu.$error.pattern && (!formRegister.hire_first_name_fu.$pristine || formRegister.$submitted)">
          				全角カタカナのみご入力ください。
          			    </p>
                    @if($errors->has('hire_first_name_fu'))
                    <p class="validation-errors">{{ $errors->first('hire_first_name_fu') }}</p>
                    @endif
                      </div>
                      <!-- zip code -->
                  <div class="full" ng-class="{
                          'has-error':!formRegister.zip.$valid && (!formRegister.zip.$pristine || formRegister.$submitted),
                          'has-success':formRegister.zip.$valid && (!formRegister.zip.$pristine || formRegister.$submitted)}">
                      <label>郵便番号</label>
                      <input type="text"
                             name="zip"

                             ng-model="formModel.zip"
                             pattern="[0-9\-+]+"
                             >
                      <p ng-show="formRegister.zip.$error.required && (!formRegister.zip.$pristine || formRegister.$submitted)">
              入力必須項目です。
                </p>
                <p ng-show="formRegister.zip.$error.pattern && (!formRegister.zip.$pristine || formRegister.$submitted)">
              住所は文字、数字とハイフンのみご入力ください。
                </p>
                @if($errors->has('zip'))
                <p class="validation-errors">{{ $errors->first('zip') }}</p>
                @endif
                  </div>
                          <!-- Address -->
                      <div class="full" ng-class="{
                              'has-error':!formRegister.hire_address.$valid && (!formRegister.hire_address.$pristine || formRegister.$submitted),
                              'has-success':formRegister.hire_address.$valid && (!formRegister.hire_address.$pristine || formRegister.$submitted)}">
                          <label>住所</label>
                          <input type="text"
                                 name="hire_address"

                                 ng-model="formModel.hire_address"
                                 pattern="[^()/><\][\\\x22,;|]+"
                                 >
                          <p ng-show="formRegister.hire_address.$error.required && (!formRegister.hire_address.$pristine || formRegister.$submitted)">
          				入力必須項目です。
          			    </p>
                    @if($errors->has('hire_address'))
                    <p class="validation-errors">{{ $errors->first('hire_address') }}</p>
                    @endif
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

                                 ng-model="formModel.hire_tel"
                                 pattern="[0-9\-+]+">
                          <p ng-show="formRegister.hire_tel.$error.required && (!formRegister.hire_tel.$pristine || formRegister.$submitted)">
          				入力必須項目です。
          			    </p>
                    @if($errors->has('hire_tel'))
                    <p class="validation-errors">{{ $errors->first('hire_tel') }}</p>
                    @endif
          			    <p ng-show="formRegister.hire_tel.$error.pattern && (!formRegister.hire_tel.$pristine || formRegister.$submitted)">
          				電話番号は数字とハイフンのみご入力ください。
          			    </p>
                      </div>
                      <div class="full" ng-class="{
                              'has-error':!formRegister.email.$valid && (!formRegister.email.$pristine || formRegister.$submitted),
                              'has-success':formRegister.email.$valid && (!formRegister.email.$pristine || formRegister.$submitted)}">
                          <label>メールアドレス</label>
                          <input type="email"
                                 name="email"
                                 required="required"
                                 ng-model="formModel.email"
                                 >
                          <p ng-show="formRegister.email.$error.required && (!formRegister.email.$pristine || formRegister.$submitted)">
          				入力必須項目です。
                </p>
                  @if($errors->has('email'))
                  <p class="validation-errors">{{ $errors->first('email') }}</p>
                  @endif
          			    <p ng-show="formRegister.email.$error.email && (!formRegister.email.$pristine || formRegister.$submitted)">
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
                                 ng-pattern="formModel.mail"
                                 >
                          <p ng-show="formRegister.hire_email_check.$error.required && (!formRegister.hire_email_check.$pristine || formRegister.$submitted)">
          				入力必須項目です。
          			    </p>
                    @if($errors->has('hire_email_check'))
                    <p class="validation-errors">{{ $errors->first('hire_email_check') }}</p>
                    @endif
          			    <p ng-show="formRegister.hire_email_check.$error.pattern && (!formRegister.hire_email_check.$pristine || formRegister.$submitted)">
          				上記と同じメールアドレスご入力ください。
          			    </p>
                      </div>
                      <div class="full">
                      <input type="submit" value="登録" />
                      </div>
                      @if(count($errors))
                        <span class="hidden" ng-init="formModel.hire_comp='{{old('hire_comp')}}'"></span>
                        <span class="hidden" ng-init="formModel.hire_comp_fu='{{old('hire_comp_fu')}}'"></span>
                        <span class="hidden" ng-init="formModel.hire_last_name='{{old('hire_last_name')}}'"></span>
                        <span class="hidden" ng-init="formModel.hire_first_name='{{old('hire_first_name')}}'"></span>
                        <span class="hidden" ng-init="formModel.hire_last_name_fu='{{old('hire_last_name_fu')}}'"></span>
                        <span class="hidden" ng-init="formModel.hire_first_name_fu='{{old('hire_first_name_fu')}}'"></span>
                        <span class="hidden" ng-init="formModel.zip='{{old('zip')}}'"></span>
                        <span class="hidden" ng-init="formModel.hire_address='{{old('hire_address')}}'"></span>
                        <span class="hidden" ng-init="formModel.hire_tel='{{old('hire_tel')}}'"></span>
                        <span class="hidden" ng-init="formModel.email='{{old('email')}}'"></span>
                        <span class="hidden" ng-init="formModel.hire_email_check='{{old('hire_email_check')}}'"></span>
                      @endif
                      </form>
                  </div>
                </div>
                <script>
                function select_account(id) {
                  $('.validation-errors').hide();
                  $('.account-box').removeClass('fill-color');
                  $('#'+id).addClass('fill-color');
                  $('#check-'+id).prop("checked", true);
                  if(id === 'company-Acc'){
                    $('.company-only').hide();
                    $('.user-only').show();
                  }else{
                    $('.company-only').show();
                    $('.user-only').hide();
                  }
                }
                function register_user(id){
                  event.preventDefault();
                  var confirm=window.confirm("この内容で確定してよろしいですか?");
                  if(confirm){
                    $("#"+id).submit();
                  }
                }
                </script>
              @endsection
