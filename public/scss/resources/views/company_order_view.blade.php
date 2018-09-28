@extends('layouts.hire_company')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">トップ</a></li>
    <li><a href="/company_order_view_all">注文履歴一覧</a></li>
    <li class="current"><a href="#">注文内容</a></li>
</ol>
<div class="client-details">
    <h3><i class="fa fa-user" aria-hidden="true"></i> {{$user_name}} ({{count($num_orders)}}) <!-- number of orders --></h3> <div class="chat"></div>
</div>
<div class="order-details">
    <span class="date">{{$orders[0]['created_at']->format('m/d/Y')}}</span>
    <span class="order-no">注文番号：BND{{$orders[0]['id']}}</span>
    <p><strong>注文名：</strong><span>{{$orders[0]['order_name']}}</span></p>
    <div class="card-row">
    <div class="card">
        <small>From:</small>
            <p><strong>ご開始日時:</strong><br>
                {{$orders[0]['pick_up_date']}} --- {{$orders[0]['pick_up_time']}}
            </p>
            <p><strong>お迎えの場所:</strong><br>
                {{$orders[0]['pick_up_address']}}
            </p>
    </div>
    <div class="card">
        <small>To:</small>
            <p><strong>終了予定日時:</strong><br>
                {{$orders[0]['drop_off_date']}} --- {{$orders[0]['drop_off_time']}}
            </p>
            <p><strong>お送り先の場所:</strong><br>
                {{$orders[0]['drop_off_address']}}
            </p>
    </div>
    </div>
    <p><strong>利用希望台数：</strong><span>{{$orders[0]['num_of_cars']}}</span></p>
    <p><strong>利用人数：</strong><span>{{$orders[0]['number_of_people']}}</span></p>
    <p><strong>お荷物個数：</strong><span>{{$orders[0]['luggage_num']}}</span></p>
    <p><strong>希望車種：</strong><span>{{$orders[0]['car_type']}}</span></p>
    <p><strong>備考：</strong>{{$orders[0]['remarks']}}</p>
</div>
<div class="place-bid">
    <h3>御社の提供</h3>
    <form action="/bid_with_message" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="order-num" value="{{$orders[0]['id']}}" />
        <label>金額:</label>
        <input name="bid-price" type="text" required>
        <label>メッセージ:</label>
        <textarea name="bid-message" rows="6" cols="40" required></textarea>
        <button type="submit" class="bid">提供する</button>
    </form>
</div>

<div class="bidder-details">
    <br>
    <h3>提供一覧：</h3>
    <!-- shop picked -->
@foreach(collect($orders[0]['bid'])->reverse() as $bid)
    <div class="bid-card hire">
        <div class="part">
            <small>日付:</small>
            <p>{{$bid['created_at']}}</p>
        </div>
        <div class="part">
            <small>ハイヤー会社:</small>
            <p>{{$bid['company_name']}}</p>
        </div>
        <div class="part">
            <small>金額:</small>
            <p class="price">¥{{$bid['price']}}</p>
        </div>
        <div class="part">
            <small>状態:</small>
            @if($orders[0]['bid_status'])
            <p>確定</p>
            @else
            <p>未確定</p>
            @endif
        </div>
    </div>
@endforeach
    <!--<div class="bid-card hire">
        <div class="part">
            <small>日付:</small>
            <p>2017/02/15</p>
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
    </div>
    <div class="bid-card hire">
        <div class="part">
            <small>日付:</small>
            <p>2017/02/16</p>
        </div>
        <div class="part">
            <small>ハイヤー会社:</small>
            <p>株式会社3</p>
        </div>
        <div class="part">
            <small>金額:</small>
            <p class="price">¥165,000</p>
        </div>
        <div class="part">
            <small>状態:</small>
            <p>未確定</p>
        </div>
    </div>-->
</div>

</div>
@endsection
