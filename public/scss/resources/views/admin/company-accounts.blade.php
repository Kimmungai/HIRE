@extends('layouts.admin-layout')

@section('content')
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
        <div class="row">
        <div class="col-lg-12">
        <form action="/search-company" method="POST" id="custom-search-form" class="form-search form-horizontal">
          {{csrf_field()}}
        <div class="input-append span12">
            <input name="search-query" type="text" class="search-query" placeholder="Search">
            <button type="submit" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </div>
        </form>
        </div>
        @if (Session::has('no-search-results'))
        <h3>{{ Session::get('no-search-results') }}</h3>
        @endif
            <div class="col-lg-12">
                <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>登録日付</th>
                        <th>ID</th>
                        <th>Email</th>
                        <th>会社名</th>
                        <th>担当者名</th>
                        <th>種類</th>
                        <th>状態</th>
                        <th></th>
                    </tr>
                    @foreach($user_data as $user)
                    <tr>
                        <td>{{$user['created_at']->format('d/m/Y')}}</td>
                        <td>user{{$user['id']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['company_name']}}</td>
                        <td>{{$user['first_name']}} {{$user['last_name']}}</td>
                        <td>{{$user['commission_type']}}</td>
                        @if($user['admin_approved'])
                        <td>確認済み</td>
                        @else
                        <td>保留</td>
                        @endif
                        <td><a href="/company-account-details/{{$user['id']}}" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                    </tr>
                    @endforeach
                    <!--<tr class="danger">
                        <td>2017/08/22</td>
                        <td>user345</td>
                        <td>myemail@mail.com</td>
                        <td>株式会社1</td>
                        <td>山田太郎</td>
                        <td>A (13%)</td>
                        <td>確認済み</td>
                        <td><a href="/admin-company-accounts-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                    </tr>
                    <tr>
                        <td>2017/08/22</td>
                        <td>user345</td>
                        <td>myemail@mail.com</td>
                        <td>株式会社1</td>
                        <td>山田太郎</td>
                        <td>A (13%)</td>
                        <td>確認済み</td>
                        <td><a href="/admin-company-accounts-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                    </tr>-->
                </table>
                </div>

            </div>
            <div class="col-lg-12">
                <ul class="pagination pagination-sm">
                <li>{{$user_data->links()}}</li>
                <!--<li><a href="#" class="disabled"><i class="glyphicon glyphicon-chevron-left"></i></a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-chevron-right"></i></a></li>-->
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->
@endsection
