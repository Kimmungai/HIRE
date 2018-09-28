<?php $__env->startSection('content'); ?>
<div class="hero">
    <h2>注文履歴</h2>
</div>
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
    <?php $__currentLoopData = $all_user_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bid-card">
        <div class="part">
            <small>日付:</small>
            <p><?php echo e($user_order['created_at']->format('d/m/Y')); ?></p><!-- time formating can be changed to all values by deleting format('d/m/Y')-->
        </div>
        <div class="part">
            <small>依頼名:</small>
            <p><?php echo e($user_order['order_name']); ?></p>
        </div>
        <div class="part">
            <small>ハイヤー会社:</small>
            <?php $__currentLoopData = $user_order['bid']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><!--Looping through all bids and breaking immedietly after printing the most recent -->
            <p><?php echo e($bid['company_name']); ?></p>
            <?php break; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="part">
            <small>金額:</small>
            <?php $__currentLoopData = $user_order['bid']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p class="price">¥<?php echo e(number_format($bid['price'],2)); ?></p>
            <?php break; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="part">
            <small>状態:</small>
            <?php if($user_order['bid_status']): ?>
            <p>確定</p>
            <?php else: ?>
            <p>未確定</p>
            <?php endif; ?>
        </div>
        <div class="part">
            <a href="/client_order_view/<?php echo e($user_order['id']); ?>" class="details">内容見る</a>
        </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="col-lg-12">
    <ul class="pagination pagination-sm" style="list-style-type:none">
    <?php echo e($all_user_orders->links()); ?>

    </ul>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hire', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>