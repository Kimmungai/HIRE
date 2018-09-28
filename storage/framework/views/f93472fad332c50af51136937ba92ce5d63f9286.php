<?php $__env->startSection('content'); ?>
<ol class="breadcrumb">
    <li><a href="#">トップ</a></li>
    <li><a href="#">新しいご注文</a></li>
    <li class="current"><a href="#">ご注文内容確認</a></li>
</ol>
<form>
<div class="new-order">
    <div class="stripe">
        <label>注文名<span>必須</span>:</label>
        <p>CORPORATE BENZ September</p>
    </div>
    <div class="stripe">
        <label>ご開始日時<span>必須</span>:</label>
        <p>2017/09/22 --- 14:00</p>
        <label>お迎えの場所<span>必須</span>:</label>
        <p>Narita Airport</p>
    </div>
    <div class="stripe">
        <label>終了予定日時<span>必須</span>:</label>
        <p>2017/09/23 --- 16:00</p>
        <label>お送り先の場所<span>必須</span>:</label>
        <p>Haneda Airport</p>
    </div>
    <div class="stripe">
        <label>利用希望台数<span>必須</span>:</label>
        <p>5</p>
        <label>利用人数<span>必須</span>:</label>
        <p>5</p>
        <label>お荷物個数<span>必須</span>:</label>
        <p>スーツケース　大：1個</p>
        <label>希望車種:</label>
        <p>BENZ S550</p>
        <label>備考:</label>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin felis enim, dapibus quis semper id, rhoncus a augue. Nulla facilisi. Curabitur congue rhoncus ante quis fermentum. Cras maximus dignissim est quis tempus. Praesent placerat bibendum arcu, sit amet auctor ipsum facilisis quis. Proin diam urna, mattis id cursus sed, pulvinar id arcu.</p>
    </div>
</div>
<div class="fix">
<input type="submit" value="内容編集">
<input type="submit" value="依頼設定">
</div>
</form>


</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hire', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>