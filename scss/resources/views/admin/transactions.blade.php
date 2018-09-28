@extends('layouts.admin-layout')

@section('content')
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <div class="row">
                <div class="col-lg-12">
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
                                <th>作成日付</th>
                                <th>依頼番号</th>
                                <th>支払会社名</th>
                                <th>支払者Email</th>
                                <th>受取会社</th>
                                <th>受取者Email</th>
                                <th></th>
                            </tr>
                            <?php $count=0;?>
                            @foreach($data as $datum)
                            <tr>
                                <td>{{$datum['created_at']->format('d/m/Y')}}</td>
                                <td>DFK{{$datum['id']}}</td>
                                <td>{{$client_name[$count]}}</td>
                                <td>{{$client_email[$count]}}</td>
                                <td>{{$seller_name[$count]}}</td>
                                <td>{{$seller_email[$count]}}</td>
                                <td><a href="/admin-transactions-details/{{$datum['id']}}" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>
                            <?php $count++;?>
                            @endforeach
                            <!--<tr>
                                <td>2017/08/19</td>
                                <td>DFK1234</td>
                                <td>株式会社1</td>
                                <td>user@user.com</td>
                                <td>株式会社山田</td>
                                <td>yamada@mail.com</td>
                                <td><a href="admin-transactions-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>
                            <tr>
                                <td>2017/08/19</td>
                                <td>DFK1234</td>
                                <td>株式会社1</td>
                                <td>user@user.com</td>
                                <td>株式会社山田</td>
                                <td>yamada@mail.com</td>
                                <td><a href="admin-transactions-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
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
