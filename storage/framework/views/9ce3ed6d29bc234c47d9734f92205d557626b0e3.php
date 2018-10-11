<?php $__env->startSection('content'); ?>
<div class="hero">
    <h2>ログイン</h2>
</div>
<div class="form-register" ng-controller="ConfirmCtrl">
            <h2> ログイン </h2>
            <?php if(Session::has('error')): ?>
            <h2><?php echo e(Session::get('error')); ?></h2>
            <?php endif; ?>
            <form name="formConfirm" ng-submit="onSubmit(formConfirm.$valid)" novalidate="novalidate" method="POST" action="<?php echo e(url('/login')); ?>">
              <?php echo e(csrf_field()); ?>

                <!-- Password input -->
            <div class="full">
                <label> メールアドレス </label>
                <input type="email"
                       name="email"
                       required="required"
                        value="<?php echo e(old('email')); ?>" autofocus>
                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                </div>
                <!-- Password check -->
            <div class="full">
                <label>パスワード</label>
                <input type="password"
                       name="password"
                       required="required"
                       >
                       <?php if($errors->has('password')): ?>
                           <span class="help-block">
                               <strong><?php echo e($errors->first('password')); ?></strong>
                           </span>
                       <?php endif; ?>
                </div>
            <div class="full">
                <button type="submit" class="submit">ログイン</button>
                <a class="btn btn-primary" href="<?php echo e(url('/password/reset')); ?>">
                    パスワード忘れた方
                </a>
                <a class="btn btn-primary pull-right" href="<?php echo e(url('/registering')); ?>">
                    会員登録
                </a>
            </div>
            </form>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.registering', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>