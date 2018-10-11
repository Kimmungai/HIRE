<?php $__env->startSection('content'); ?>
<div class="hero">
    <h2>パスワードをリセット</h2>
</div>
<div class="form-register" ng-controller="ConfirmCtrl">
            <h2> ログインの際に使用するパスワードを設定して下さい。 </h2>
            <?php if(Session::has('message')): ?>
            <h2><?php echo e(Session::get('error')); ?></h2>
            <?php endif; ?>
            <form id="password-reset"  role="form" method="POST" action="<?php echo e(url('/password/reset')); ?>">
              <?php echo e(csrf_field()); ?>

              <input type="hidden" name="token" value="<?php echo e($token); ?>">
                <!-- Password input -->
            <div class="full">
                <label> メールアドレス </label>
                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(isset($email) ? $email : old('email')); ?>" required autofocus>
                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                </div>
                <!-- Password check -->
            <div class="full">
                <label>パスワード</label>
                <input id="password" type="password" class="form-control" name="password" required>
                       <?php if($errors->has('password')): ?>
                           <span class="help-block">
                               <strong><?php echo e($errors->first('password')); ?></strong>
                           </span>
                       <?php endif; ?>
                </div>
                <div class="full">
                    <label>パスワード確認</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                           <?php if($errors->has('password_confirmation')): ?>
                               <span class="help-block">
                                   <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                               </span>
                           <?php endif; ?>
                    </div>
            <div class="full">
                <button type="submit" class="submit" onclick="reset_message('password-reset')">リセット</button>
            </div>
            </form>
        </div>
      </div>
      <script>
        function reset_message(id){
          event.preventDefault();
          $("#"+id).submit();
          alert("パスワードがリセットされました。");
        }
      </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.registering', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>