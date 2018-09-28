<?php $__env->startSection('content'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
        <div class="row">
        <div class="col-lg-12">
        <form action="/search-company" method="POST" id="custom-search-form" class="form-search form-horizontal">
          <?php echo e(csrf_field()); ?>

        <div class="input-append span12">
            <input name="search-query" type="text" class="search-query" placeholder="Search">
            <button type="submit" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </div>
        </form>
        </div>
        <?php if(Session::has('no-search-results')): ?>
        <h3><?php echo e(Session::get('no-search-results')); ?></h3>
        <?php endif; ?>
            <div class="col-lg-12">
                <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>登録日付</th>
                        <th>ID</th>
                        <th>Email</th>
                        <th>会社名</th>
                        <th>担当者名</th>
                        <th>種類</th>
                        <th>状態</th>
                        <th></th>
                    </tr>
                    <?php $__currentLoopData = $user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user['created_at']->format('d/m/Y')); ?></td>
                        <td>user<?php echo e($user['id']); ?></td>
                        <td><?php echo e($user['email']); ?></td>
                        <td><?php echo e($user['company_name']); ?></td>
                        <td><?php echo e($user['first_name']); ?> <?php echo e($user['last_name']); ?></td>
                        <?php if($user['company_type']==1): ?>
                        <td>A (13%)</td>
                        <?php elseif($user['company_type']==2): ?>
                        <td>A (15%)</td>
                        <?php elseif($user['company_type']==3): ?>
                        <td>A (20%)</td>
                        <?php elseif($user['company_type']==4): ?>
                        <td>A (10%)</td>
                        <?php endif; ?>
                        <?php if($user['admin_approved']): ?>
                        <td>確認済み</td>
                        <?php else: ?>
                        <td>保留</td>
                        <?php endif; ?>
                        <td><a href="/company-account-details/<?php echo e($user['id']); ?>" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!--<tr class="danger">
                        <td>2017/08/22</td>
                        <td>user345</td>
                        <td>myemail@mail.com</td>
                        <td>株式会社1</td>
                        <td>山田太郎</td>
                        <td>A (13%)</td>
                        <td>確認済み</td>
                        <td><a href="/admin-company-accounts-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                    </tr>
                    <tr>
                        <td>2017/08/22</td>
                        <td>user345</td>
                        <td>myemail@mail.com</td>
                        <td>株式会社1</td>
                        <td>山田太郎</td>
                        <td>A (13%)</td>
                        <td>確認済み</td>
                        <td><a href="/admin-company-accounts-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                    </tr>-->
                </table>
                </div>

            </div>
            <div class="col-lg-12">
                <ul class="pagination pagination-sm">
                <li><?php echo e($user_data->links()); ?></li>
                <!--<li><a href="#" class="disabled"><i class="glyphicon glyphicon-chevron-left"></i></a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-chevron-right"></i></a></li>-->
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>