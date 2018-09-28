<?php $__env->startSection('content'); ?>
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <a href="admin-orders" class="btn btn-default"><i class="glyphicon glyphicon-backward"></i>  戻る</a>
                <div class="row">
                    <div class="col-lg-12">
                        <h3>依頼内容</h3>
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th>依頼登録の日付</th>
                                <td>2017/08/18</td>
                            </tr>
                            <tr>
                                <th>依頼番号</th>
                                <td>BND12345066</td>
                            </tr>
                            <tr>
                                <th>状態</th>
                                <td>未確定zw</td>
                            </tr>
                            <tr>
                                <th>ご開始日時:</th>
                                <td>2017/09/22 --- 14:00</td>
                            </tr>
                            <tr>
                                <th>お迎えの場所:</th>
                                <td>Narita Airport</td>
                            </tr>
                            <tr>
                                <th>終了予定日時:</th>
                                <td>2017/09/23 --- 16:00</td>
                            </tr>
                            <tr>
                                <th>お送り先の場所:</th>
                                <td>Haneda Airport</td>
                            </tr>
                            <tr>
                                <th>利用希望台数:</th>
                                <td>5</td>
                            </tr>
                            <tr>
                                <th>利用人数:</th>
                                <td>5</td>
                            </tr>
                            <tr>
                                <th>お荷物個数:</th>
                                <td>大スーツケース　1個</td>
                            </tr>
                            <tr>
                                <th>希望車種：</th>
                                <td>BENZ S550</td>
                            </tr>
                            <tr>
                                <th>備考：</th>
                                <td>
                                    <div class="table-message">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin felis enim, dapibus quis semper id, rhoncus a augue. Nulla facilisi. Curabitur congue rhoncus ante quis fermentum. Cras maximus dignissim est quis tempus. Praesent placerat bibendum arcu, sit amet auctor ipsum facilisis quis. Proin diam urna, mattis id cursus sed, pulvinar id arcu.
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                        </table>
                    </div>
                        <h3>提供したハイヤー会社一覧</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>会社名</th>
                                <th>担当者名</th>
                                <th>小計</th>
                                <th>消費税</th>
                                <th>手数料</th>
                                <th>合計</th>
                            </tr>
                            <tr>
                                <td>hire335</td>
                                <td>myemail@myemail.com</td>
                                <td>株式会社1</td>
                                <td>山田　太郎</td>
                                <td>¥150,000</td>
                                <td>¥12,000</td>
                                <td>¥19,500</td>
                                <td>¥181,500</td>
                            </tr>
                            <tr>
                                <td>hire123</td>
                                <td>second-comp@myemail.com</td>
                                <td>株式会社2</td>
                                <td>中山　ひろし</td>
                                <td>¥150,000</td>
                                <td>¥12,000</td>
                                <td>¥19,500</td>
                                <td>¥181,500</td>
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