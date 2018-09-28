<?php $__env->startSection('content'); ?>
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <a href="admin-trash" class="btn btn-default"><i class="glyphicon glyphicon-backward"></i>  戻る</a>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                               <th>ID</th>
                               <td>hire335</td>
                               <td><input type="text"></td>
                            </tr>
                            <tr>
                               <th>PW</th>
                               <td>3456jfg</td>
                               <td><input type="text"></td>
                            </tr>
                            <tr>
                               <th>Email</th>
                               <td>myemail@myemail.com</td>
                               <td><input type="email" placeholder="new-email"></td>
                            </tr>
                            <tr>
                               <th>会社名</th>
                               <td>株式会社1</td>
                               <td><input type="text" placeholder="company name"></td>
                            </tr>
                            <tr>
                               <th>会社名 ふりがな</th>
                               <td>かぶしきがいしゃ1</td>
                               <td><input type="text" placeholder="company name"></td>
                            </tr>
                            <tr>
                               <th>担当者名</th>
                               <td>山田　太郎</td>
                               <td><input type="text" placeholder="first name"> <input type="text" placeholder="last name"></td>
                            </tr>
                            <tr>
                               <th>担当者名 ふりがな</th>
                               <td>やまだ　たろう</td>
                               <td><input type="text" placeholder="first name"> <input type="text" placeholder="last name"></td>
                            </tr>
                            </tr>
                            <tr>
                               <th>住所</th>
                               <td>東京都中央区銀座1-1-1, 10F</td>
                               <td><input type="text" placeholder="Address"></td>
                            </tr>
                            </tr>
                            <tr>
                               <th>電話番号</th>
                               <td>080-1234-6788</td>
                               <td><input type="tel" placeholder=""></td>
                            </tr>
                            <tr>
                               <th>アカウント種類</th>
                               <td>A (13%)</td>
                               <td><select>
                                   <option>A (13%)</option>
                                   <option>B (15%)</option>
                                   <option>C (20%)</option>
                                   <option>S (10%)</option>
                                   </select></td>
                            </tr>
                            <tr>
                               <th>アカウント状態</th>
                               <td>保留</td>
                               <td><select>
                                   <option>保留</option>
                                   <option>確認済み</option>
                                   </select></td>
                            </tr>
                        </table>
                        </div>
                        <a href="#" class="btn btn-primary">一覧に戻す</a>
                        <a href="#" class="btn btn-danger">完全削除</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>