<?php $__env->startSection('content'); ?>
<div class="hero">
    <h2>ご注文内容確認</h2>
</div>
<ol class="breadcrumb">
    <li><a href="/">トップ</a></li>
    <li><a href="/new_order">新しいご注文</a></li>
    <li class="current"><a href="#">ご注文内容確認</a></li>
</ol>
<form>
  <?php echo e(csrf_field()); ?>

<div class="new-order">
    <div class="stripe">
        <label>注文名<span>必須</span>:</label>
        <p><?php echo e($input['order_name']); ?></p>
    </div>
    <div class="stripe">
        <label>ご開始日時<span>必須</span>:</label>
        <p><?php echo e($input['start_date']); ?><?php echo e($input['start_time']); ?> </p>
        <label>お迎えの場所<span>必須</span>:</label>
        <p><?php echo e($input['pick_up_address']); ?></p>
    </div>
    <div class="stripe">
        <label>終了予定日時<span>必須</span>:</label>
        <p><?php echo e($input['end_date']); ?> <?php echo e($input['end_time']); ?></p>
        <label>お送り先の場所<span>必須</span>:</label>
        <p><?php echo e($input['drop_off_address']); ?></p>
    </div>
    <div class="stripe">
        <label>利用希望台数<span>必須</span>:</label>
        <p><?php echo e($input['car_num']); ?></p>
        <label>利用人数<span>必須</span>:</label>
        <p><?php echo e($input['people_num']); ?></p>
        <label>お荷物個数<span>必須</span>:</label>
        <p>スーツケース　大：<?php echo e($input['baggage']); ?>個</p>
        <label>希望車種:</label>
        <p><?php echo e($input['car_type']); ?></p>
        <label>旅:</label>
        <p><?php echo e($input['journey']); ?></p>
        <label>備考:</label>
        <p><?php echo e($input['details']); ?></p>
    </div>
</div>
<div class="fix">
<a href="new_order" class="submit">内容編集</a>
<a href="save_new_order" class="submit">依頼する</a>
</div>
</form>


</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hire', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>