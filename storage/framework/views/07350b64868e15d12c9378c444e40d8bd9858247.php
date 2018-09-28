<?php $__env->startSection('content'); ?>

<!-- computing of consumption_tax fee, total and subtotal starts here-->
<?php $consumption_tax_rate=0.08;?><!--Constant defined consumption tax -->
<?php $price_agreed=doubleval($closing_bid[0]['price_agreed']);
      $consumption_tax=$consumption_tax_rate * $price_agreed;
      if($seller[0]['company_type']==1){$excia_commission=0.13;}
      elseif($seller[0]['company_type']==2){$excia_commission=0.15;}
      elseif($seller[0]['company_type']==3){$excia_commission=0.20;}
      elseif($seller[0]['company_type']==4){$excia_commission=0.10;}
      $fee=$excia_commission*$price_agreed;
      $total=$price_agreed+$consumption_tax+$fee;                   ?>
<!-- computing of consumption_tax fee, total and subtotal ends here-->

<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <a href="/admin-transactions" class="btn btn-default"><i class="glyphicon glyphicon-backward"></i>  戻る</a>

                <div class="row">
               <div class="col-lg-12">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>作成日付</th>
                                <th>依頼番号</th>
                                <th>小計</th>
                                <th>消費税</th>
                                <th>手数料</th>
                                <th>合計</th>
                            </tr>
                            <tr>
                                <td><?php echo e($data[0]['created_at']->format('d/m/Y')); ?></td>
                                <td>DFK<?php echo e($data[0]['id']); ?></td>
                                <td>¥<?php echo e($price_agreed); ?></td>
                                <td>¥<?php echo e($consumption_tax); ?></td>
                                <td>¥<?php echo e($fee); ?></td>
                                <td>¥<?php echo e($total); ?></td>
                            </tr>
                        </table>
                        </div>
                   <h3>支払者</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>会社名</th>
                                <th>会社名 ふりがな</th>
                                <th>担当者名</th>
                                <th>担当者名 ふりがな</th>
                                <th>住所</th>
                                <th>電話番号</th>
                            </tr>
                            <tr>
                                <td>user<?php echo e($data[0]['user']['id']); ?></td>
                                <td><?php echo e($data[0]['user']['email']); ?></td>
                                <td><?php echo e($data[0]['user']['company_name']); ?></td>
                                <td><?php echo e($data[0]['user']['company_name_furigana']); ?></td>
                                <td><?php echo e($data[0]['user']['first_name']); ?> <?php echo e($data[0]['user']['last_name']); ?></td>
                                <td><?php echo e($data[0]['user']['first_name_furigana']); ?> <?php echo e($data[0]['user']['last_name_furigana']); ?></td>
                                <td><?php echo e($data[0]['user']['address']); ?></td>
                                <td><?php echo e($data[0]['user']['tel']); ?></td>
                            </tr>
                        </table>
                    </div>
                   <h3>受取者</h3>
                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>会社名</th>
                                <th>会社名 ふりがな</th>
                                <th>担当者名</th>
                                <th>担当者名 ふりがな</th>
                                <th>住所</th>
                                <th>電話番号</th>
                            </tr>
                            <?php if($seller){?>
                            <tr>
                                <td>hire<?php echo e($seller[0]['id']); ?></td>
                                <td><?php echo e($seller[0]['email']); ?></td>
                                <td><?php echo e($seller[0]['company_name']); ?></td>
                                <td><?php echo e($seller[0]['company_name_furigana']); ?></td>
                                <td><?php echo e($seller[0]['first_name']); ?> <?php echo e($seller[0]['last_name']); ?></td>
                                <td><?php echo e($seller[0]['first_name_furigana']); ?> <?php echo e($seller[0]['last_name_furigana']); ?></td>
                                <td><?php echo e($seller[0]['address']); ?></td>
                                <td><?php echo e($seller[0]['tel']); ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                   <h3>依頼内容</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th>依頼登録の日付</th>
                                <td><?php echo e($data[0]['created_at']->format('d/m/Y')); ?></td>
                            </tr>
                            <tr>
                                <th>依頼番号</th>
                                <td>BND<?php echo e($data[0]['id']); ?></td>
                            </tr>
                            <tr>
                                <th>ご開始日時:</th>
                                <td><?php echo e($data[0]['pick_up_date']); ?> --- <?php echo e($data[0]['pick_up_time']); ?></td>
                            </tr>
                            <tr>
                                <th>お迎えの場所:</th>
                                <td><?php echo e($data[0]['pick_up_address']); ?></td>
                            </tr>
                            <tr>
                                <th>終了予定日時:</th>
                                <td><?php echo e($data[0]['drop_off_date']); ?> --- <?php echo e($data[0]['drop_off_time']); ?></td>
                            </tr>
                            <tr>
                                <th>お送り先の場所:</th>
                                <td><?php echo e($data[0]['drop_off_address']); ?></td>
                            </tr>
                            <tr>
                                <th>利用希望台数:</th>
                                <td><?php echo e($data[0]['num_of_cars']); ?></td>
                            </tr>
                            <tr>
                                <th>利用人数:</th>
                                <td><?php echo e($data[0]['number_of_people']); ?></td>
                            </tr>
                            <tr>
                                <th>お荷物個数:</th>
                                <td><?php echo e($data[0]['luggage_num']); ?></td>
                            </tr>
                            <tr>
                                <th>希望車種：</th>
                                <td><?php echo e($data[0]['car_type']); ?></td>
                            </tr>
                            <tr>
                                <th>備考：</th>
                                <td>
                                    <div class="table-message">
                                  <?php echo e($data[0]['remarks']); ?>

                                    </div>
                                </td>
                            </tr>
                    </tbody>
                        </table>
                    </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>