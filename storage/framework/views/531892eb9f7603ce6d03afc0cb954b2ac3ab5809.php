<?php $__env->startSection('content'); ?>
<div class="hero">
    <h2>新しいご注文</h2>
</div>
<ol class="breadcrumb">
    <li><a href="/">トップ</a></li>
    <li class="current"><a href="#">新しいご注文</a></li>
</ol>
<form action="new_order" method="post">
  <?php echo e(csrf_field()); ?>


<div class="new-order">
    <div class="stripe">
        <label>注文名<span>必須</span>:</label>
        <select name="order_name">
          <option <?php if (session('order_name')=='ビジネス送迎') {echo 'selected';}?>>ビジネス送迎</option>
          <option <?php if (session('order_name')=='空港送迎') {echo 'selected';}?>>空港送迎</option>
          <option <?php if (session('order_name')=='観光') {echo 'selected';}?>>観光</option>
          <option <?php if (session('order_name')=='ゴルフ') {echo 'selected';}?>>ゴルフ</option>
          <option <?php if (session('order_name')=='冠婚葬祭') {echo 'selected';}?>>冠婚葬祭</option>
          <option <?php if (session('order_name')=='その他') {echo 'selected';}?>>その他</option>
        </select>
    </div>
    <div class="stripe">
        <label>ご開始日時<span>必須</span>:</label>
        <input type="text" id="start_date" name="start_date" value="<?php if (session('start_date')) {echo session('start_date');}?>" required><input  type="text" id="start_time" name="start_time" value="<?php if (session('start_time')) {echo session('start_time');}?>" required>
        <label>お迎えの場所<span>必須</span>:</label>
        <input type="text" name="pick_up_address" value="<?php if (session('pick_up_address')) {echo session('pick_up_address');}?>" required>
        <label>途中行程:</label>
        <textarea name="journey" cols="40" rows="6" required><?php if (session('journey')) {echo session('journey');}?></textarea>
    </div>
    <div class="stripe">
        <label>終了予定日時<span>必須</span>:</label>
        <input type="text" name="end_date" id="end_date" value="<?php if (session('end_date')) {echo session('end_date');}?>" required><input type="text" name="end_time" id="end_time" value="<?php if (session('end_time')) {echo session('end_time');}?>" required>
        <label>お送り先の場所<span>必須</span>:</label>
        <input type="text" name="drop_off_address" value="<?php if (session('drop_off_address')) {echo session('drop_off_address');}?>" required>
    </div>
    <div class="stripe">
        <label>利用希望台数<span>必須</span>:</label>
        <input type="number" name="car_num" value="<?php if (session('car_num')) {echo session('car_num');}?>" required>
        <label>利用人数<span>必須</span>:</label>
        <input type="number" name="people_num" value="<?php if (session('people_num')) {echo session('people_num');}?>" required>
        <label>お荷物個数<span>必須</span>:</label>
        <input type="text" name="baggage" placeholder="例えば：スーツケース　大:　3個" value="<?php if (session('baggage')) {echo session('baggage');}?>" required>
        <label>希望車種:</label>
        <input type="text" name="car_type" value="<?php if (session('car_type')) {echo session('car_type');}?>" required>
        <label>備考:</label>
        <textarea name="details" cols="40" rows="6"><?php if (session('details')) {echo session('details');}?></textarea>
    </div>
</div>

<input type="submit" class="submit" value="内容確認" />

</form>


</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hire', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>