<?php $__env->startSection('content'); ?>
<div class="hero">
    <h2>依頼履歴一覧</h2>
</div>
<ol class="breadcrumb">
    <li><a href="/">トップ</a></li>
    <li class="current"><a href="#">依頼履歴一覧</a></li>
</ol>

<ol class="filter">
    <li><a href="open-bids">未確定のみ</a></li>
    <li><a href="closed-bids">確定のみ</a></li>
    <li class="current"><a href="company_order_view_all">全部</a></li>
</ol>
<?php if(!isset($my_orders)){?>
<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="order-card"> <!-- start order card -->
<div class="row">
    <div class="half">
    <span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo e($order['created_at']->format('m/d/Y')); ?></span><?php if((time()-strtotime($order['created_at'])) < 172800): ?><span class="new">新規</span><?php endif; ?>
    <p><strong>注文名：</strong><span><?php echo e($order['order_name']); ?></span></p>
    <p><strong>利用希望台数：</strong><span><?php echo e($order['num_of_cars']); ?></span></p>
    <p><strong>希望車種：</strong><span><?php echo e($order['car_type']); ?></span></p>
    <p><strong>状態：
      <?php if($order['bid_status']==1): ?>
      <span>確定</span>
      <?php elseif($order['bid_status']==0): ?>
      <span>未確定</span>
      <?php endif; ?>
    </strong></p>
    </div>
    <div class="half">
            <p class="hrs">利用時間：<?php echo e(number_format((time()-strtotime($order['created_at']))/3600)); ?>時間</p><!--number of hours since bidding-->
            <p><small>From:</small><br>
                <strong>お迎えの場所:</strong><br>
                <?php echo e($order['pick_up_address']); ?>

            </p>
            <p><small>To:</small><br>
                <strong>お送り先の場所:</strong><br>
                <?php echo e($order['drop_off_address']); ?>

            </p>
    </div>
</div>
<hr>
<div class="row">
    <div class="half">
            <?php echo e(csrf_field()); ?>

            <p>御社提供の金額:</p>
            <input type="hidden" name="order-num" value="<?php echo e($order['id']); ?>" />
            <input type="number" name="bid-price" id="bid-price<?php echo e($order['id']); ?>" <?php if($order['bid_status']==1){echo 'disabled';}?>>
            <input type="hidden" name="bid-message" value="" /><?php if($order['bid_status']==0){?><button type="button" class="submit active" onclick="bid(<?php echo e($order['id']); ?>,document.getElementById('bid-price<?php echo e($order['id']); ?>').value)">設定する</button><?php }?>

    </div>
    <div class="quarter">
        <div class="avg">
            <p><small>提供した会社数：</small></p>
            <p class="avg-num"><?php echo e(count($order['BidCompany'])); ?></p>
        </div>
    </div>
    <div class="quarter">
        <div class="avg">
            <p><small>現在平均金額：</small></p>
            <p class="avg-num">
              <?php  $summed_bid_price=0;
              foreach($order['bid'] as $bid_price){ $summed_bid_price += doubleval($bid_price['price']);}
              $number_of_bids=count($order['bid']);if($number_of_bids==0){$number_of_bids=1;}
              $average_bid_price=$summed_bid_price/$number_of_bids;?>
              ¥<?php echo e(number_format($average_bid_price,2)); ?>

            </p>
        </div>
    </div>
</div>
<div class="more"><a href="/company_order_view/<?php echo e($order['id']); ?>"><i class="fa fa-info-circle" aria-hidden="true"></i> 詳しく見る ></a></div>
</div><!-- order card finish -->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php }else{$orders=$my_orders;for($count=0;$count<count($orders);$count++){?>
  <?php $__currentLoopData = $orders[$count]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="order-card"> <!-- start order card -->
  <div class="row">
      <div class="half">
      <span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo e($order['created_at']->format('m/d/Y')); ?></span><?php if((time()-strtotime($order['created_at'])) < 172800): ?><span class="new">新規</span><?php endif; ?>
      <p><strong>注文名：</strong><span><?php echo e($order['order_name']); ?></span></p>
      <p><strong>利用希望台数：</strong><span><?php echo e($order['num_of_cars']); ?></span></p>
      <p><strong>希望車種：</strong><span><?php echo e($order['car_type']); ?></span></p>
      <p><strong>状態：
        <?php if($order['bid_status']==1): ?>
        <span>確定</span>
        <?php elseif($order['bid_status']==0): ?>
        <span>未確定</span>
        <?php endif; ?>
      </strong></p>
      </div>
      <div class="half">
              <p class="hrs">利用時間：<?php echo e(number_format((time()-strtotime($order['created_at']))/3600)); ?>時間</p><!--number of hours since bidding-->
              <p><small>From:</small><br>
                  <strong>お迎えの場所:</strong><br>
                  <?php echo e($order['pick_up_address']); ?>

              </p>
              <p><small>To:</small><br>
                  <strong>お送り先の場所:</strong><br>
                  <?php echo e($order['drop_off_address']); ?>

              </p>
      </div>
  </div>
  <hr>
  <div class="row">
      <div class="half">
              <?php echo e(csrf_field()); ?>

              <p>御社提供の金額:</p>
              <input type="hidden" name="order-num" value="<?php echo e($order['id']); ?>" />
              <input type="number" name="bid-price" id="bid-price<?php echo e($order['id']); ?>" <?php if($order['bid_status']==1){echo 'disabled';}?>>
              <input type="hidden" name="bid-message" value="" /><?php if($order['bid_status']==0){?><button type="button" class="submit active" onclick="bid(<?php echo e($order['id']); ?>,document.getElementById('bid-price<?php echo e($order['id']); ?>').value)">設定する</button><?php }?>

      </div>
      <div class="quarter">
          <div class="avg">
              <p><small>提供した会社数：</small></p>
              <p class="avg-num"><?php echo e(count($order['BidCompany'])); ?></p>
          </div>
      </div>
      <div class="quarter">
          <div class="avg">
              <p><small>現在平均金額：</small></p>
              <p class="avg-num">
                <?php  $summed_bid_price=0;
                foreach($order['bid'] as $bid_price){ $summed_bid_price += doubleval($bid_price['price']);}
                $number_of_bids=count($order['bid']);if($number_of_bids==0){$number_of_bids=1;}
                $average_bid_price=$summed_bid_price/$number_of_bids;?>
                ¥<?php echo e(number_format($average_bid_price,2)); ?>

              </p>
          </div>
      </div>
  </div>
  <div class="more"><a href="/company_order_view/<?php echo e($order['id']); ?>"><i class="fa fa-info-circle" aria-hidden="true"></i> 詳しく見る ></a></div>
  </div><!-- order card finish -->
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php }}?>
<script>
function bid(order_id,price){
  if(order_id === '' || price === '')
  {
    alert("金額を入力してください");
    return 0;
  }
  window.open('/bid-with-comment/'+order_id+'/'+price,'_self');

}
</script>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hire_company', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>