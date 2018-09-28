<?php $__env->startSection('content'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
        <div class="row">
        <div class="col-lg-12">
        <form id="custom-search-form" class="form-search form-horizontal">
        <div class="input-append span12">
            <input type="text" class="search-query" placeholder="Search">
            <button type="submit" class="btn"><i class="glyphicon glyphicon-search"></i></button>
        </div>
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
                        <th></th>
                    </tr>
                    <tr>
                        <td>2017/08/19</td>
                        <td>user345</td>
                        <td>myemail@mail.com</td>
                        <td>株式会社1</td>
                        <td>山田太郎</td>
                        <td><a href="admin-client-accounts-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                    </tr>
                    <tr>
                        <td>2017/08/19</td>
                        <td>user345</td>
                        <td>myemail@mail.com</td>
                        <td>株式会社1</td>
                        <td>山田太郎</td>
                        <td><a href="admin-client-accounts-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                    </tr>
                    <tr>
                        <td>2017/08/19</td>
                        <td>user345</td>
                        <td>myemail@mail.com</td>
                        <td>株式会社1</td>
                        <td>山田太郎</td>
                        <td><a href="admin-client-accounts-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                    </tr>
                </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>