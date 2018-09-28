@extends('layouts.hire_company')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">トップ</a></li>
    <li class="current"><a href="#">依頼履歴</a></li>
</ol>
<ol class="filter">
    <li><a href="/open_client_bids">未確定のみ</a></li>
    <li><a href="/closed_client_bids">確定のみ</a></li>
    <li class="current"><a href="/client_order_view_all">全部</a></li>
</ol>
<div class="all-orders">
    <!-- shop picked -->
    @foreach($all_user_orders as $user_order)
    <div class="bid-card">
        <div class="part">
            <small>日付:</small>
            <p>{{$user_order['created_at']->format('d/m/Y')}}</p><!-- time formating can be changed to all values by deleting format('d/m/Y')-->
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
    <!--<div class="bid-card">
        <div class="part">
            <small>日付:</small>
            <p>2017/02/15</p>
        </div>
        <div class="part">
            <small>依頼名:</small>
            <p>Corporate Benz</p>
        </div>
        <div class="part">
            <small>ハイヤー会社:</small>
            <p>株式会社2</p>
        </div>
        <div class="part">
            <small>金額:</small>
            <p class="price">¥160,000</p>
        </div>
        <div class="part">
            <small>状態:</small>
            <p>未確定</p>
        </div>
        <div class="part">
            <button class="details">内容見る</button>
        </div>
    </div>
    <div class="bid-card">
        <div class="part">
            <small>日付:</small>
            <p>2017/02/15</p>
        </div>
        <div class="part">
            <small>依頼名:</small>
            <p>Corporate Benz</p>
        </div>
        <div class="part">
            <small>ハイヤー会社:</small>
            <p>株式会社2</p>
        </div>
        <div class="part">
            <small>金額:</small>
            <p class="price">¥160,000</p>
        </div>
        <div class="part">
            <small>状態:</small>
            <p>未確定</p>
        </div>
        <div class="part">
            <button class="details">内容見る</button>
        </div>
    </div>-->
</div>


</div>
@endsection
