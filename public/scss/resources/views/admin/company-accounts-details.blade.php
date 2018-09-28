@extends('layouts.admin-layout')

@section('content')
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <a href="/admin-company-accounts" class="btn btn-default"><i class="glyphicon glyphicon-backward"></i>  戻る</a>
                @if (Session::has('update_success_admin'))
                <h3>{{ Session::get('update_success_admin') }}</h3>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                        <form method="POST" id="company-details-admin">
                          {{csrf_field()}}
                          <input type="hidden" name="id" value="{{$data[0]['id']}}" />
                        <table class="table table-bordered table-hover">
                            <tr>
                               <th>ID</th>
                               <td>hire{{$data[0]['id']}}</td>
                               <td><input name="id-disabled" type="text" value="{{$data[0]['id']}}" disabled></td>
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
                               <td>山田　太郎</td>
                               <td><input name="first_name" type="text" placeholder="first name" value="{{$data[0]['first_name']}}"> <input name="last_name" type="text" placeholder="last name" value="{{$data[0]['last_name']}}"></td>
                            </tr>
                            <tr>
                               <th>担当者名 ふりがな</th>
                               <td>{{$data[0]['first_name_furigana']}}</td>
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
                               <td><input name="tel" type="tel" placeholder="" value="{{$data[0]['tel']}}" ></td>
                            </tr>
                        </table>
                      </form>
                        </div>
                        <a  class="btn btn-primary" onclick="update_company_record()">更新する</a>
                        <a href="#" class="btn btn-danger delete_company_record" onclick="delete_company_record()">削除</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
        <script>
        function update_company_record()
        {
          $('#company-details-admin').attr('action',"/update_company_record").submit();
        }
        function delete_company_record()
        {
          $('#company-details-admin').attr('action',"/delete_company_record").submit();
        }
        </script>
@endsection
