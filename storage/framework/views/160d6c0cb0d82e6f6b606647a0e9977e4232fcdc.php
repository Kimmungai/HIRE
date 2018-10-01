<?php $__env->startSection('content'); ?>
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <div class="row">
                <div class="col-lg-12">
                  <?php if(Session::has('trash_page')): ?>
                  <h3><?php echo e(Session::get('trash_page')); ?></h3>
                  <?php endif; ?>
                <form id="custom-search-form" class="form-search form-horizontal">
                <!--<div class="input-append span12">
                    <input type="text" class="search-query" placeholder="Search">
                    <button type="submit" class="btn"><i class="glyphicon glyphicon-search"></i></button>
                </div>-->
                </form>
                </div>
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
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($datum['created_at']->format('d/m/Y')); ?></td>
                                <td>user<?php echo e($datum['id']); ?></td>
                                <td><?php echo e($datum['email']); ?></td>
                                <td><?php echo e($datum['company_name']); ?></td>
                                <td><?php echo e($datum['first_name']); ?> <?php echo e($datum['last_name']); ?></td>
                                <?php if($datum['company_type']==0): ?>
                                <td>A (13%)</td>
                                <?php elseif($datum['company_type']==1): ?>
                                <td>A (15%)</td>
                                <?php elseif($datum['company_type']==2): ?>
                                <td>A (20%)</td>
                                <?php elseif($datum['company_type']==3): ?>
                                <td>A (10%)</td>
                                <?php endif; ?>
                                <?php if($datum['admin_approved']==0): ?>
                                <td>保留</td>
                                <?php elseif($datum['admin_approved']==1): ?>
                                <td>確認済み</td>
                                <?php elseif($datum['admin_approved']==2): ?>
                                <td>削除済み</td>
                                <?php endif; ?>
                                <td><a href="/admin-trash-details/<?php echo e($datum['id']); ?>" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <!--  <tr>
                                <td>2017/08/22</td>
                                <td>user345</td>
                                <td>myemail@mail.com</td>
                                <td>株式会社1</td>
                                <td>山田太郎</td>
                                <td>A (13%)</td>
                                <td>保留</td>
                                <td><a href="admin-trash-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>
                            <tr>
                                <td>2017/08/22</td>
                                <td>user345</td>
                                <td>myemail@mail.com</td>
                                <td>株式会社1</td>
                                <td>山田太郎</td>
                                <td>A (13%)</td>
                                <td>保留</td>
                                <td><a href="admin-trash-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>-->
                        </table>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <ul class="pagination pagination-sm">
                        <li><?php echo e($data->links()); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>