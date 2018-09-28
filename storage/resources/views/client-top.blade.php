@extends('layouts.hire')
@section('content')
<div class="hero">
    <h2>一括見積もりシステム</h2>
</div>
<ol class="breadcrumb">
    <li class="current"><a href="/">トップ</a></li>
</ol>
<ul class="top-main">
    <li><a class="add" href="new_order"><i class="fa fa-plus-circle" aria-hidden="true"></i>新しいご依頼</a></li>
    <li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>よくある質問</a></li>
    <li><a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>サービス流れ</a></li>
</ul>
<!-- last orders 3 -->
<h3>最新依頼</h3>
<div class="all-orders">
    <!-- shop picked -->
    <?php $count=0;?>
    @foreach($client_data as $client_datum)
     <div class="bid-card">
         <div class="part">
             <small>日付:</small>
             <p>{{$client_datum['created_at']->format('d/m/Y')}}</p>
         </div>
         <div class="part">
             <small>依頼名:</small>
             <p>{{$client_datum['order_name']}}</p>
         </div>
         <div class="part">
             <small>ハイヤー会社:</small>
             <p><?php echo $company_name[$count]; ?></p>
         </div>
         <div class="part">
             <small>金額:</small>
             <p class="price">¥<?php echo $price_agreed[$count]; ?></p>
         </div>
         <div class="part">
             <small>状態:</small>
             @if($client_datum['bid_status'])
               <p>確定</p>
             @else
               <p>未確定</p>
             @endif
         </div>
         <div class="part">
             <a href="/client_order_view/{{$client_datum['id']}}" class="details">内容見る</a>
         </div>
     </div>
     <?php $count++;?>
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
            <a href="" class="details">内容見る</a>
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
            <a href="#" class="details">内容見る</a>
        </div>
    </div>-->
</div>
<div class="col-lg-12">
    <ul class="pagination pagination-sm">
    <li>{{$client_data->links()}}</li>
    <!--<li><a href="#" class="disabled"><i class="glyphicon glyphicon-chevron-left"></i></a></li>
    <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-chevron-right"></i></a></li>-->
    </ul>
</div>
</div><!-- container end -->
@endsection
