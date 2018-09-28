@extends('layouts.hire_company')
@section('content')
<div class="hero">
    <h2>一括見積もりシステム</h2>
</div>
<ol class="breadcrumb">
    <li class="current"><a href="#">トップ</a></li>
</ol>
<ul class="top-main">
    <li><a class="add" href="#"><i class="fa fa-list" aria-hidden="true"></i>依頼一覧</a></li>
    <li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>よくある質問</a></li>
    <li><a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>サービス流れ</a></li>
</ul>
<!-- last 3 orders this company bid on -->
<h3>最新提供履歴</h3>
<div class="all-orders">

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
            <small>提供した会社数:</small>
            <p>3</p>
        </div>
        <div class="part">
            <small>平均金額:</small>
            <p class="price">¥160,000</p>
        </div>
        <div class="part">
            <small>状態:</small>
            <p>未確定</p>
        </div>
        <div class="part">
            <a href="#" class="details">内容見る</a>
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
            <small>提供した会社数:</small>
            <p>3</p>
        </div>
        <div class="part">
            <small>平均金額:</small>
            <p class="price">¥160,000</p>
        </div>
        <div class="part">
            <small>状態:</small>
            <p>未確定</p>
        </div>
        <div class="part">
            <a href="#" class="details">内容見る</a>
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
            <small>提供した会社数:</small>
            <p>3</p>
        </div>
        <div class="part">
            <small>平均金額:</small>
            <p class="price">¥160,000</p>
        </div>
        <div class="part">
            <small>状態:</small>
            <p>未確定</p>
        </div>
        <div class="part">
            <a href="#" class="details">内容見る</a>
        </div>
    </div>
</div>
</div><!-- container end -->
@endsection
