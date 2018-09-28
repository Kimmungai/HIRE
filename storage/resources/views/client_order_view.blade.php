@extends('layouts.hire')

@section('content')
<div class="hero">
    <h2>注文内容</h2>
</div>
<ol class="breadcrumb">
    <li><a href="/">トップ</a></li>
    <li><a href="/client_order_view_all">注文履歴一覧</a></li>
    <li class="current"><a href="#">注文内容</a></li>
</ol>
<div class="order-details">
    <span class="date">{{$client_order[0]['created_at']->format('d/m/Y')}}</span><!-- time format can be included by removing the format() -->
    <span class="order-no">注文番号：BND{{$client_order[0]['id']}}</span>
    <p><strong>注文名：</strong><span>{{$client_order[0]['order_name']}}</span></p>
    <p><span>{{ Session::get('order_closed') }}</span></p>
    <div class="card-row">
    <div class="card">
        <small>From:</small>
            <p><strong>ご開始日時:</strong><br>
                {{$client_order[0]['pick_up_date']}} --- {{$client_order[0]['pick_up_time']}}
            </p>
            <p><strong>お迎えの場所:</strong><br>
                {{$client_order[0]['pick_up_address']}}
            </p>
    </div>
    <div class="card">
        <small>To:</small>
            <p><strong>終了予定日時:</strong><br>
                {{$client_order[0]['drop_off_date']}} --- {{$client_order[0]['drop_off_time']}}
            </p>
            <p><strong>お送り先の場所:</strong><br>
                {{$client_order[0]['drop_off_address']}}
            </p>
    </div>
    </div>
    <p><strong>利用希望台数：</strong><span>{{$client_order[0]['num_of_cars']}}</span></p>
    <p><strong>利用人数：</strong><span>{{$client_order[0]['number_of_people']}}</span></p>
    <p><strong>お荷物個数：</strong><span>{{$client_order[0]['luggage_num']}}</span></p>
    <p><strong>希望車種：</strong><span>{{$client_order[0]['car_type']}}</span></p>
    <p><strong>備考：</strong>{{$client_order[0]['remarks']}}</p>
    @if(Auth::id()==$client_order[0]['user_id'])
    <a href="/cancel_order/{{$client_order[0]['id']}}" class="btn cancel">キャンセルする</a>
    @endif
</div>
<div class="bidder-details">
    <br>
    <h3>ハイヤー会社一覧：</h3>
    <!-- shop picked -->
    @foreach($client_order[0]['bid'] as $bid)
    <div class="bid-card pick">
      <div class="full">
            <small>メッセージ:</small>
            <p class="initial-message">{{$bid['message']}}</p>
        </div>
        <div class="part">
            <small>日付:</small>
            <p>{{$bid['created_at']->format('d/m/Y')}}</p>
        </div>
        <div class="part">
            <small>ハイヤー会社:</small>
            <p>{{$bid['company_name']}}</p>
        </div>
        <div class="part">
            <small>金額:</small>
            <p class="price">¥{{number_format(floatval($bid['price']),2)}}</p>
        </div>
        <div class="part">
            <small>状態:</small>
            @if($client_order[0]['bid_status'])
            <p>確定</p>
            @else
            <p>未確定</p>
            @endif
        </div>
        <div class="part open-chat">
            <i class="fa fa-comments" aria-hidden="true"></i>
        </div>
        <div class="part">
          @if($client_order[0]['bid_status'])
          <button class="settle">確定</button>
          @elseif(Auth::id())
            @if(Auth::id()==$client_order[0]['user_id'])
              <form action="/choose_company" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="order" value="{{$client_order[0]['id']}}"/>
                <input type="hidden" name="bid" value="{{$bid['id']}}"/>
                <button type="submit" class="settle active">確定</button>
              </form>
              @endif
          @else
            <button class="settle">確定</button>
          @endif
        </div>
    </div>
    @endforeach
  <!--  <div class="bid-card">
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
        <div class="part">
            <i class="fa fa-comments" aria-hidden="true"></i>
        </div>
        <div class="part">
            <button class="settle">確定</button>
        </div>
    </div>
    <div class="bid-card">
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
        <div class="part">
            <i class="fa fa-comments" aria-hidden="true"></i>
        </div>
        <div class="part">
            <button class="settle active">確定</button>
        </div>
    </div>-->
</div>


</div>
<!-- chat starts here -->
<!--<div class="chat">
    <div id="toggle-chat" class="chat-btn">
        <a class="but" href="#">
            <i class="fa fa-comments" aria-hidden="true"></i><span class="notify">2</span>
        </a>
    </div>
    <div class="chat-open">
        <div class="chat-container">
        <div class="contact-list">
            <header><h5>メッセージ</h5><a href="#" class="pull-right close"><i class="fa fa-times" aria-hidden="true"></i></a></header>
            <ul>
                @foreach($client_order[0]['bid'] as $company)
                <li><a class="on" href="#">{{$company['company_name']}}<span class="unread">2</span><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                @endforeach
                <li><a class="off" href="#">株式会社3<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="on" href="#">株式会社4<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社5<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社6<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社2<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社2<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社2<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社3<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                <li><a class="off" href="#">株式会社4<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>-->
          <!--</ul>
        </div>
        <div class="contact-message">
        <header><a class="back" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i></a> <h5 class="on">株式会社1</h5> <a href="#" class="pull-right close"><i class="fa fa-times" aria-hidden="true"></i></a></header>
        <div class="scroll">
        <article class="to">
            <div class="date">2017/08/12 14:00</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vehicula est non lacinia fringilla. </p>
        </article>
        <article class="from">
            <div class="date">2017/08/12 14:00</div>
            <span class="name">田中　正和</span>
            <p>Cras rutrum hendrerit erat, ut rhoncus eros rhoncus sed. Donec pellentesque est a justo porta viverra. Praesent et arcu tellus. </p>
        </article>
        <article class="from">
            <div class="date">2017/08/12 14:00</div>
            <span class="name">田中　正和</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vehicula est non lacinia fringilla. </p>
        </article>
        <article class="to">
            <div class="date">2017/08/12 14:00</div>
            <p>Cras rutrum hendrerit erat, ut rhoncus eros rhoncus sed. Donec pellentesque est a justo porta viverra. Praesent et arcu tellus. </p>
        </article>
        </div>
        <div class="input">
            <textarea></textarea><a class="send" href="#">送信</a>
        </div>
        </div>
        </div>
    </div>
</div>-->
@endsection
