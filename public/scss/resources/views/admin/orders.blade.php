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
                                <th>日付</th>
                                <th>依頼者</th>
                                <th>依頼名</th>
                                <th>依頼番号</th>
                                <th>ご開始日時</th>
                                <th>お迎えの場所</th>
                                <th>終了予定日時</th>
                                <th>お送り先の場所</th>
                                <th>状態</th>
                                <th></th>
                            </tr>
                        @foreach($data as $datum)
                            <tr>
                                <td>{{$datum['created_at']->format('d/m/Y')}}</td>
                                <td>user{{$datum['user_id']}}</td>
                                <td>{{$datum['order_name']}}</td>
                                <td>BND{{$datum['id']}}</td>
                                <td>{{$datum['pick_up_date']}} --- {{$datum['pick_up_time']}}</td>
                                <td>{{$datum['pick_up_address']}}</td>
                                <td>{{$datum['drop_off_date']}} --- {{$datum['drop_off_time']}}</td>
                                <td>{{$datum['drop_off_address']}}</td>
                                @if($datum['bid_status'])
                                <td>確定</td>
                                @else
                                <td>未確定</td>
                                @endif
                                <td><a href="/admin-order-details/{{$datum['id']}}" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>
                    @endforeach
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
