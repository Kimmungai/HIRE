@extends('layouts.admin-layout')

@section('content')
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <div class="row">
                <div class="col-lg-12">
                  @if (Session::has('trash_page'))
                  <h3>{{ Session::get('trash_page') }}</h3>
                  @endif
                <form id="custom-search-form" class="form-search form-horizontal">
                <div class="input-append span12">
                    <input type="text" class="search-query" placeholder="Search">
                    <button type="submit" class="btn"><i class="glyphicon glyphicon-search"></i></button>
                </div>
                </form>
                </div>
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
                            @foreach($data as $datum)
                            <tr>
                                <td>{{$datum['created_at']->format('d/m/Y')}}</td>
                                <td>user{{$datum['id']}}</td>
                                <td>{{$datum['email']}}</td>
                                <td>{{$datum['company_name']}}</td>
                                <td>{{$datum['first_name']}} {{$datum['last_name']}}</td>
                                <td>A (13%)</td>
                                <td>保留</td>
                                <td><a href="/admin-trash-details/{{$datum['id']}}" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>
                            @endforeach
                          <!--  <tr>
                                <td>2017/08/22</td>
                                <td>user345</td>
                                <td>myemail@mail.com</td>
                                <td>株式会社1</td>
                                <td>山田太郎</td>
                                <td>A (13%)</td>
                                <td>保留</td>
                                <td><a href="admin-trash-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>
                            <tr>
                                <td>2017/08/22</td>
                                <td>user345</td>
                                <td>myemail@mail.com</td>
                                <td>株式会社1</td>
                                <td>山田太郎</td>
                                <td>A (13%)</td>
                                <td>保留</td>
                                <td><a href="admin-trash-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>-->
                        </table>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <ul class="pagination pagination-sm">
                        <li>{{$data->links()}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
@endsection
