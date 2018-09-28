@extends('layouts.admin-layout')

@section('content')
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <a href="/admin-trash" class="btn btn-default"><i class="glyphicon glyphicon-backward"></i>  戻る</a>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                        <form id="company-details-admin" method="POST" />
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$data[0]['id']}}" />
                        <table class="table table-bordered table-hover">
                            <tr>
                               <th>ID</th>
                               <td>hire{{$data[0]['id']}}</td>
                               <td><input  type="text" value="{{$data[0]['id']}}" disabled></td>
                            </tr>
                            <tr>
                               <th>PW</th>
                               <td>******</td>
                               <td><input name="password" type="text"></td>
                            </tr>
                            <tr>
                               <th>Email</th>
                               <td>{{$data[0]['email']}}</td>
                               <td><input name="email" type="email" placeholder="new-email" value="{{$data[0]['email']}}"></td>
                            </tr>
                            <tr>
                               <th>会社名</th>
                               <td>{{$data[0]['company_name']}}</td>
                               <td><input name="company_name" type="text" placeholder="company name" value="{{$data[0]['company_name']}}"></td>
                            </tr>
                            <tr>
                               <th>会社名 ふりがな</th>
                               <td>{{$data[0]['company_name_furigana']}}</td>
                               <td><input name="company_name_furigana" type="text" placeholder="company name" value="{{$data[0]['company_name_furigana']}}"></td>
                            </tr>
                            <tr>
                               <th>担当者名</th>
                               <td>{{$data[0]['first_name']}} {{$data[0]['last_name']}}</td>
                               <td><input name="first_name" type="text" placeholder="first name" value="{{$data[0]['first_name']}}"> <input name="last_name" type="text" placeholder="last name" value="{{$data[0]['last_name']}}"></td>
                            </tr>
                            <tr>
                               <th>担当者名 ふりがな</th>
                               <td>{{$data[0]['first_name_furigana']}} {{$data[0]['last_name_furigana']}}</td>
                               <td><input name="first_name_furigana" type="text" placeholder="first name" value="{{$data[0]['first_name_furigana']}}"> <input name="last_name_furigana" type="text" placeholder="last name" value="{{$data[0]['last_name_furigana']}}"></td>
                            </tr>
                            </tr>
                            <tr>
                               <th>住所</th>
                               <td>{{$data[0]['address']}}</td>
                               <td><input name="address" type="text" placeholder="Address" value="{{$data[0]['address']}}"></td>
                            </tr>
                            </tr>
                            <tr>
                               <th>電話番号</th>
                               <td>{{$data[0]['tel']}}</td>
                               <td><input name="tel" type="tel" placeholder="" value="{{$data[0]['tel']}}"></td>
                            </tr>
                            <tr>
                               <th>アカウント種類</th>
                               <td>A (13%)</td>
                               <td><select>
                                   <option>A (13%)</option>
                                   <option>B (15%)</option>
                                   <option>C (20%)</option>
                                   <option>S (10%)</option>
                                   </select></td>
                            </tr>
                            <tr>
                               <th>アカウント状態</th>
                               <td>保留</td>
                               <td><select>
                                   <option <?php if($data[0]['admin_approved']==0 || $data[0]['admin_approved']==2){echo "selected='selected'";} ?>>保留</option>
                                   <option <?php if($data[0]['admin_approved']==1 ){echo  "selected='selected'";} ?>>確認済み</option>
                                   </select></td>
                            </tr>
                        </table>
                      </form>
                        </div>
                        <a href="#" class="btn btn-primary" onclick="restore_record()">一覧に戻す</a>
                        <a href="#" class="btn btn-danger" onclick="delete_record_permanently()">完全削除</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
        <script>
        function restore_record()
        {
          var restoreIt =confirm('Are you sure you want to restore the record?');
          if(restoreIt)
          {
            $('#company-details-admin').attr('action',"/restore_company_record").submit();
          }
        }
        function delete_record_permanently()
        {
          var deleteIt=confirm('Are you sure you want to delete the record?');
          if(deleteIt)
          {
            $('#company-details-admin').attr('action',"/delete_record_permanently").submit();
          }
        }
        </script>
@endsection
