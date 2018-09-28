<?php $__env->startSection('content'); ?>
<ol class="breadcrumb">
    <li><a href="#">トップ</a></li>
    <li><a href="#">注文履歴一覧</a></li>
    <li class="current"><a href="#">注文内容</a></li>
</ol>
<div class="client-details">
    <h3><i class="fa fa-user" aria-hidden="true"></i> user335 (0) <!-- number of orders --></h3> <div class="chat"></div>
</div>
<div class="order-details">
    <span class="date">2017/08/18</span>
    <span class="order-no">注文番号：BND12345066</span>
    <p><strong>注文名：</strong><span>Corporate Benz</span></p>
    <div class="card-row">
    <div class="card">
        <small>From:</small>
            <p><strong>ご開始日時:</strong><br>
                2017/09/22 --- 14:00
            </p>
            <p><strong>お迎えの場所:</strong><br>
                Narita Airport
            </p>
    </div>
    <div class="card">
        <small>To:</small>
            <p><strong>終了予定日時:</strong><br>
                2017/09/23 --- 16:00
            </p>
            <p><strong>お送り先の場所:</strong><br>
                Haneda Airport
            </p>
    </div>
    </div>
    <p><strong>利用希望台数：</strong><span>5</span></p>
    <p><strong>利用人数：</strong><span>5</span></p>
    <p><strong>お荷物個数：</strong><span>大スーツケース　1個</span></p>
    <p><strong>希望車種：</strong><span>BENZ S550</span></p>
    <p><strong>備考：</strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin felis enim, dapibus quis semper id, rhoncus a augue. Nulla facilisi. Curabitur congue rhoncus ante quis fermentum. Cras maximus dignissim est quis tempus. Praesent placerat bibendum arcu, sit amet auctor ipsum facilisis quis. Proin diam urna, mattis id cursus sed, pulvinar id arcu. </p>
</div>
<div class="place-bid">
    <h3>御社の提供</h3>
    <form>
        <label>金額:</label>
        <input type="text" required>
        <label>メッセージ:</label>
        <textarea rows="6" cols="40" required></textarea>
        <button type="submit" class="bid">提供する</button>
    </form>
</div>
<div class="bidder-details">
    <br>
    <h3>提供一覧：</h3>
    <!-- shop picked -->
    <div class="bid-card hire">
        <div class="part">
            <small>日付:</small>
            <p>2017/02/15</p>
        </div>
        <div class="part">
            <small>ハイヤー会社:</small>
            <p>株式会社1</p>
        </div>
        <div class="part">
            <small>金額:</small>
            <p class="price">¥150,000</p>
        </div>
        <div class="part">
            <small>状態:</small>
            <p>確定</p>
        </div>
    </div>
    <div class="bid-card hire">
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
    </div>
</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hire_company', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>