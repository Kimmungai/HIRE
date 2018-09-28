<?php $__env->startSection('content'); ?>
<!-- computing of consumption_tax fee, total and subtotal starts here-->
<?php $consumption_tax_rate=0.08;$tax_percent='8%';?><!--Constant defined consumption tax -->
<?php if(Auth::user()->company_type==0){$excia_commission=0.13;$excia_commission_percent='13%';}
      elseif(Auth::user()->company_type==1){$excia_commission=0.13;$excia_commission_percent='13%';}
      elseif(Auth::user()->company_type==2){$excia_commission=0.15;$excia_commission_percent='15%';}
      elseif(Auth::user()->company_type==3){$excia_commission=0.20;$excia_commission_percent='20%';}
      elseif(Auth::user()->company_type==4){$excia_commission=0.10;$excia_commission_percent='10%';}            ?>
<!-- computing of consumption_tax fee, total and subtotal ends here-->
<div class="hero">
    <h2>注文内容<?php echo e(Auth::user()->company_type); ?></h2>
</div>
<ol class="breadcrumb">
    <li><a href="/">トップ</a></li>
    <li><a href="/company_order_view_all">注文履歴一覧</a></li>
    <li class="current"><a href="#">注文内容</a></li>
</ol>
<div class="client-details">
    <h3><i class="fa fa-user" aria-hidden="true"></i> <?php echo e($user_name); ?> (<?php echo e(count($num_orders)); ?>) <!-- number of orders --></h3> <div class="chat"></div>
</div>
<div class="order-details">
    <span class="date"><?php echo e($orders[0]['created_at']->format('m/d/Y')); ?></span>
    <span class="order-no">注文番号：BND<?php echo e($orders[0]['id']); ?></span>
    <p><strong>注文名：</strong><span><?php echo e($orders[0]['order_name']); ?></span></p>
    <div class="card-row">
    <div class="card">
        <small>From:</small>
            <p><strong>ご開始日時:</strong><br>
                <?php echo e($orders[0]['pick_up_date']); ?> --- <?php echo e($orders[0]['pick_up_time']); ?>

            </p>
            <p><strong>お迎えの場所:</strong><br>
                <?php echo e($orders[0]['pick_up_address']); ?>

            </p>
    </div>
    <div class="card">
        <small>To:</small>
            <p><strong>終了予定日時:</strong><br>
                <?php echo e($orders[0]['drop_off_date']); ?> --- <?php echo e($orders[0]['drop_off_time']); ?>

            </p>
            <p><strong>お送り先の場所:</strong><br>
                <?php echo e($orders[0]['drop_off_address']); ?>

            </p>
    </div>
    </div>
    <p><strong>利用希望台数：</strong><span><?php echo e($orders[0]['num_of_cars']); ?></span></p>
    <p><strong>利用人数：</strong><span><?php echo e($orders[0]['number_of_people']); ?></span></p>
    <p><strong>お荷物個数：</strong><span><?php echo e($orders[0]['luggage_num']); ?></span></p>
    <p><strong>希望車種：</strong><span><?php echo e($orders[0]['car_type']); ?></span></p>
    <p><strong>備考：</strong><?php echo e($orders[0]['remarks']); ?></p>
</div>
<div class="place-bid">
    <h3>御社の提供</h3>
    <?php if(Session::has('bid-successful')): ?>
    <h2><?php echo e(Session::get('bid-successful')); ?></h2>
    <?php endif; ?>
    <form action="/bid_with_message" method="POST">
        <?php echo e(csrf_field()); ?><?php if(Auth::user()->admin_approved==0){echo 'アカウントは未承認です';} ?><?php if($orders[0]['bid_status']==1){echo '入札が閉まった';} ?>
        <input type="hidden" name="order-num" value="<?php echo e($orders[0]['id']); ?>" />
        <label>金額:</label>
        <input id="bid-price" name="bid-price" type="number" onkeyup="calculate_charges(this.value,<?php echo e($consumption_tax_rate); ?>,<?php echo e($excia_commission); ?>)" value="<?php if(isset($price)){echo $price;} ?>" required <?php if(Auth::user()->admin_approved==0 || $orders[0]['bid_status']==1){echo '無効';} ?>>
        <p class="youget"></p>
        <p class="handling"></p>
        <p class="tax"></p>
        <label>メッセージ:</label>
        <textarea name="bid-message" rows="6" cols="40" required></textarea>
        <?php if(Auth::user()->admin_approved==1){ if($orders[0]['bid_status']==0){?><button type="submit" class="bid">提供する</button> <?php }}?>
        <?php if(Auth::user()->admin_approved==0 || $orders[0]['bid_status']==1){echo '無効 disabled';} ?>
    </form>
</div>

<div class="bidder-details">
    <br>
    <h3>提供一覧：</h3>
    <!-- shop picked -->
<?php $__currentLoopData = collect($orders[0]['bid'])->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bid-card hire">
        <div class="part">
            <small>日付:</small>
            <p><?php echo e($bid['created_at']); ?></p>
        </div>
        <div class="part">
            <small>ハイヤー会社:</small>
            <p><?php echo e($bid['company_name']); ?></p>
        </div>
        <div class="part">
            <small>金額:</small>
            <p class="price">¥<?php echo e($bid['price']); ?></p>
        </div>
        <div class="part">
            <small>状態:</small>
            <?php if($orders[0]['bid_status']): ?>
            <p>確定</p>
            <?php else: ?>
            <p>未確定</p>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

</div>
<script>
  calculate_charges($('#bid-price').val(),<?php echo e($consumption_tax_rate); ?>,<?php echo e($excia_commission); ?>)
  function calculate_charges(input_price,consumption_tax_rate,excia_commission)
  {
    var excia_commission_payable=excia_commission * input_price;
    var consumption_tax_payable=consumption_tax_rate * input_price;
    var final_amount=input_price -(consumption_tax_payable + excia_commission_payable);
    $('.youget').html('提示料金：'+final_amount.toLocaleString()+'円');
    $('.handling').html('+ 手数料(<?php echo e($excia_commission_percent); ?>)：'+excia_commission_payable.toLocaleString()+'円');
    $('.tax').html('+ 消費税(<?php echo e($tax_percent); ?>)：'+consumption_tax_payable.toLocaleString()+'円');
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hire_company', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>