<?php $__env->startSection('content'); ?>
<div class="hero">
    <h2>一括見積もりシステム</h2>
</div>
<ol class="breadcrumb">
    <li class="current"><a href="/">トップ</a></li>
</ol>
<!--<ul class="service-flow">
  <li class="pointer dekita-color">1. <i class="fa fa-edit" aria-hidden="true"></i> 登録 <i class="fa fa-check-circle"></i></li>
  <li class="pointer">2. <i class="fa fa-user" aria-hidden="true"></i> 注文 <?php echo e(Auth::user()->order); ?></li>
  <li class="pointer">3. <i class="fa fa-user" aria-hidden="true"></i> 承認</li>
  <li class="pointer">4. <i class="fa fa-thumbs-up" aria-hidden="true"></i> 入札</li>
  <li class="pointer">5. <i class="fa fa-briefcase" aria-hidden="true"></i> 完了</li>
</ul>-->

<div class="row">
  <div class="col-lg-3 col-sm-6 text-center mb-4">
    <img class="img-circle img-fluid d-block mx-auto" src="http://placehold.it/200x200" alt="">&nbsp;&nbsp;
    <span style="font-size:1.5em;line-height:200px;" class="fa fa-arrow-right hidden-xs pull-right"></span>
    <h3><i class="fa fa-edit"></i> Register
      <small><i class="fa fa-check-circle text-success"></i></small>
    </h3>
    <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
  </div>
  <div class="col-lg-3 col-sm-6 text-center mb-4">
    <img class="img-circle img-fluid d-block mx-auto" src="http://placehold.it/200x200" alt="">&nbsp;&nbsp;
    <span style="font-size:1.5em;line-height:200px;" class="fa fa-arrow-right hidden-xs pull-right"></span>
    <h3><i class="fa fa-list"></i> Make order
      <small></small>
    </h3>
    <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
  </div>
  <div class="col-lg-3 col-sm-6 text-center mb-4">
    <img class="img-circle img-fluid d-block mx-auto" src="http://placehold.it/200x200" alt="">&nbsp;&nbsp;
    <span style="font-size:1.5em;line-height:200px;" class="fa fa-arrow-right hidden-xs pull-right"></span>
    <h3><i class="fa fa-user"></i> Approval
      <small></small>
    </h3>
    <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
  </div>
  <div class="col-lg-3 col-sm-6 text-center mb-4">
    <img class="img-circle img-fluid d-block mx-auto" src="http://placehold.it/200x200" alt="">
    <h3><i class="fa fa-edit"></i> Accept Bid
      <small></small>
    </h3>
    <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
  </div>
</div>

<ul class="top-main">
    <!--<li><a class="add" href="new_order"><i class="fa fa-plus-circle" aria-hidden="true"></i>新しいご依頼</a></li>-->
    <!--<li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>よくある質問</a></li>
    <li><a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>サービス流れ</a></li>-->
</ul>
<!-- last orders 3 -->
<h3>最新依頼</h3>
<div class="all-orders">
    <!-- shop picked -->
    <?php $count=0;?>
    <?php $__currentLoopData = $client_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client_datum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <div class="bid-card">
         <div class="part">
             <small>日付:</small>
             <p><?php echo e($client_datum['created_at']->format('Y/m/d')); ?></p>
         </div>
         <div class="part">
             <small>依頼名:</small>
             <p><?php echo e($client_datum['order_name']); ?></p>
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
             <?php if($client_datum['bid_status']): ?>
               <p>確定</p>
             <?php else: ?>
               <p>未確定</p>
             <?php endif; ?>
         </div>
         <div class="part">
             <a href="/client_order_view/<?php echo e($client_datum['id']); ?>" class="details">内容見る</a>
         </div>
     </div>
     <?php $count++;?>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<div class="col-lg-12">
    <ul class="pagination pagination-sm" style="list-style-type:none">
    <?php echo e($client_data->links()); ?>

    </ul>
</div>
</div><!-- container end -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hire', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>