@extends('layouts.hire')

@section('content')
<div class="hero">
    <h2>注文履歴</h2>
</div>
<ol class="breadcrumb">
    <li><a href="/">トップ</a></li>
    <li class="current"><a href="#">依頼履歴</a></li>
</ol>
<ol class="filter">
    <li <?php if(session('active_breadcrumb')==3) {echo 'class="current"';} ?>><a href="/open_client_bids">未確定のみ</a></li>
    <li <?php if(session('active_breadcrumb')==2) {echo 'class="current"';} ?>><a href="/closed_client_bids">確定のみ</a></li>
    <li <?php if(session('active_breadcrumb')==1 || session('active_breadcrumb')=='') {echo 'class="current"';} ?>><a href="/client_order_view_all">全部</a></li>
</ol>
<div class="all-orders">
    <!-- shop picked -->
    @foreach($all_user_orders as $user_order)
    <div class="bid-card">
        <div class="part">
            <small>日付:</small>
            <p>{{$user_order['created_at']->format('Y/m/d')}}</p><!-- time formating can be changed to all values by deleting format('Y/m/d')-->
        </div>
        <div class="part">
            <small>依頼名:</small>
            <p>{{$user_order['order_name']}}</p>
        </div>
        <div class="part">
            <small>ハイヤー会社:</small>
            @foreach($user_order['bid'] as $bid)<!--Looping through all bids and breaking immedietly after printing the most recent -->
            <p>{{$bid['company_name']}}</p>
            <?php break; ?>
            @endforeach
        </div>
        <div class="part">
            <small>金額:</small>
            @foreach($user_order['bid'] as $bid)
            <p class="price">¥{{number_format($bid['price'],2)}}</p>
            <?php break; ?>
            @endforeach
        </div>
        <div class="part">
            <small>状態:</small>
            @if($user_order['bid_status'])
            <p>確定</p>
            @else
            <p>未確定</p>
            @endif
        </div>
        <div class="part">
            <a href="/client_order_view/{{$user_order['id']}}" class="details">内容見る</a>
        </div>
    </div>
  @endforeach
</div>
<div class="col-lg-12">
    <ul class="pagination pagination-sm" style="list-style-type:none">
    {{$all_user_orders->links()}}
    </ul>
</div>
</div>
@endsection
