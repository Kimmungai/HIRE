@extends('layouts.admin-layout')

@section('content')
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <a href="/admin-orders" class="btn btn-default"><i class="glyphicon glyphicon-backward"></i>  戻る</a>
                <div class="row">
                  <div class="col-lg-10 col-lg-offset-1">
                    <h3>注文の選択肢</h3>
                    @if (Session::has('update_success_admin'))
                    <h4>{{ Session::get('update_success_admin') }}</h4>
                    @endif
                    <table class="table table-bordered">
                      <tbody>
                        <form id="admin-order-option-form" action="{{url('/admin-order-option')}}" method="POST">
                          {{csrf_field()}}
                          <input name="admin-option-order-id" type="hidden" value="{{$data[0]['id']}}" />
                        <tr>
                            <th>状態</th>
                            <td>
                              <select name="admin-option" class="form-control">
                                <option <?php if($data[0]['admin_approved']==-1){?>selected<?php }?> value="-1">保留</option>
                                <option <?php if($data[0]['admin_approved']==0){?>selected<?php }?> value="0">確認済み</option>
                                <option <?php if($data[0]['admin_approved']==1){?>selected<?php }?> value="1">中断した</option>
                                <option <?php if($data[0]['admin_approved']==2){?>selected<?php }?> value="2">削除</option>
                              </select>
                          </td>
                          <td>
                            <button type="submit" class="btn btn-default" onclick="update('admin-order-option-form')">確認する</button>
                          </td>
                        </tr>
                      </form>
                      <form id="admin-order-send-option-form" action="{{url('/admin-order-send-option')}}" method="POST">
                        {{csrf_field()}}
                        <input name="admin-order-id-send-option" type="hidden" value="{{$data[0]['id']}}" />
                        <tr>
                            <th>に送る</th>
                            <td>
                              <select name="admin-send-option" class="form-control">
                                @foreach($all_companies as $company)
                                  <option value="{{$company->id}}">{{$company->company_name}}</option>
                                @endforeach
                              </select>
                          </td>
                          <td>
                            <button type="submit" class="btn btn-default" onclick="update('admin-order-send-option-form')">確認する</button>
                          </td>
                        </tr>
                      </form>
                      </tbody>
                    </table>
                  </div>
                    <div class="col-lg-12">
                        <h3>依頼内容</h3>
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th>依頼登録の日付</th>
                                <td>{{$data[0]['created_at']->format('d/m/Y')}}</td>
                            </tr>
                            <tr>
                                <th>依頼番号</th>
                                <td>BND{{$data[0]['id']}}</td>
                            </tr>
                            <tr>
                                <th>状態</th>
                                @if($data[0]['bid_status'])
                                <td>確定</td>
                                @else
                                <td>未確定</td>
                                @endif
                            </tr>
                            <tr>
                                <th>ご開始日時:</th>
                                <td>2{{$data[0]['pick_up_date']}} --- {{$data[0]['pick_up_time']}}</td>
                            </tr>
                            <tr>
                                <th>お迎えの場所:</th>
                                <td>{{$data[0]['pick_up_address']}}</td>
                            </tr>
                            <tr>
                                <th>終了予定日時:</th>
                                <td>{{$data[0]['drop_off_date']}} --- {{$data[0]['drop_off_time']}}</td>
                            </tr>
                            <tr>
                                <th>お送り先の場所:</th>
                                <td>{{$data[0]['drop_off_address']}}</td>
                            </tr>
                            <tr>
                                <th>利用希望台数:</th>
                                <td>{{$data[0]['num_of_cars']}}</td>
                            </tr>
                            <tr>
                                <th>利用人数:</th>
                                <td>{{$data[0]['number_of_people']}}</td>
                            </tr>
                            <tr>
                                <th>お荷物個数:</th>
                                <td>{{$data[0]['luggage_num']}}</td>
                            </tr>
                            <tr>
                                <th>希望車種：</th>
                                <td>{{$data[0]['car_type']}}</td>
                            </tr>
                            <tr>
                                <th>備考：</th>
                                <td>
                                    <div class="table-message">
                                    {{$data[0]['remarks']}}
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                        </table>
                    </div>
                        <h3>提供したハイヤー会社一覧</h3>
                        <?php
                        //print_r($bidder_reg_details);
                      ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>会社名</th>
                                <th>担当者名</th>
                                <th>小計</th>
                                <th>消費税</th>
                                <th>手数料</th>
                                <th>合計</th>
                            </tr>
                            <?php $count=0;?>
                            @foreach($bid_companies as $bid_company)
                            <tr>
                                <td>hire{{$bid_company['user_id']}}</td>
                                <td>{{$bidder_email[$count]}}</td>
                                <td>{{$bid_company['bid'][0]['company_name']}}</td>
                                <td>{{$bidder_name[$count]}}</td>
                                <td>¥{{$bidder_latest_price[$count]}}</td>
                                <td>¥{{$bid_company['price_agreed']}}</td><!--tax calculation-->
                                <td>¥{{$bid_company['commission_deductable']}}</td>
                                <td>¥{{$bid_company['price_payable']}}</td>
                            </tr>
                            <?php $count++;?>
                            @endforeach

                            <!--<tr>
                                <td>hire123</td>
                                <td>second-comp@myemail.com</td>
                                <td>株式会社2</td>
                                <td>中山　ひろし</td>
                                <td>¥150,000</td>
                                <td>¥12,000</td>
                                <td>¥19,500</td>
                                <td>¥181,500</td>
                            </tr>-->
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
        <script>
        function update(id){
          event.preventDefault();
          var confirm=window.confirm("この内容で確定してよろしいですか?");
          if(confirm){
            $("#"+id).submit();
          }
        }
        </script>
@endsection
