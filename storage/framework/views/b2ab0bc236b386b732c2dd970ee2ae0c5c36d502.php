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
                                <th>日付</th>
                                <th>依頼者</th>
                                <th>依頼名</th>
                                <th>依頼番号</th>
                                <th>ご開始日時</th>
                                <th>お迎えの場所</th>
                                <th>終了予定日時</th>
                                <th>お送り先の場所</th>
                                <th>状態</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>2017/08/22</td>
                                <td>user345</td>
                                <td>Corporate Benz</td>
                                <td>BND12345066</td>
                                <td>2017/09/22 --- 14:00</td>
                                <td>Narita Airport</td>
                                <td>2017/09/23 --- 16:00</td>
                                <td>Haneda Airport</td>
                                <td>未確定</td>
                                <td><a href="admin-order-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>
                            <tr>
                                <td>2017/08/22</td>
                                <td>user345</td>
                                <td>Corporate Benz</td>
                                <td>BND12345066</td>
                                <td>2017/09/22 --- 14:00</td>
                                <td>Narita Airport</td>
                                <td>2017/09/23 --- 16:00</td>
                                <td>Haneda Airport</td>
                                <td>未確定</td>
                                <td><a href="admin-order-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>
                            <tr>
                                <td>2017/08/22</td>
                                <td>user345</td>
                                <td>Corporate Benz</td>
                                <td>BND12345066</td>
                                <td>2017/09/22 --- 14:00</td>
                                <td>Narita Airport</td>
                                <td>2017/09/23 --- 16:00</td>
                                <td>Haneda Airport</td>
                                <td>未確定</td>
                                <td><a href="admin-order-details" class="btn btn-default btn-block btn-sm">内容確認</a></td>
                            </tr>
                        </table>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <ul class="pagination pagination-sm">
                        <li><a href="#" class="disabled"><i class="glyphicon glyphicon-chevron-left"></i></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>