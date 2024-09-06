<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <title><?php echo e($bs->website_title); ?></title>
    <link rel="icon" href="<?php echo e(asset('assets/front/img/'.$bs->favicon)); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/login.css')); ?>">
</head>
<body>
<div class="login-page">
    <div class="text-center mb-4">
        <img class="login-logo" src="<?php echo e(asset('assets/front/img/'.$bs->logo)); ?>" alt="">
    </div>
    <div class="form">
        <?php if(session()->has('alert')): ?>
            <div class="alert alert-danger fade show" role="alert">
                <strong><?php echo e(__('Oops')); ?>!</strong> <?php echo e(session('alert')); ?>

            </div>
        <?php endif; ?>
        <form class="login-form" action="<?php echo e(route('admin.login.submit')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="text" name="username" value="<?php echo e(old('username')); ?>" placeholder="<?php echo e(__('username')); ?>"/>
            <?php if($errors->has('username')): ?>
                <p class="text-danger text-left"><?php echo e($errors->first('username')); ?></p>
            <?php endif; ?>
            <input type="password" name="password" value="<?php echo e(old('password')); ?>" placeholder="<?php echo e(__('password')); ?>"/>
            <?php if($errors->has('password')): ?>
                <p class="text-danger text-left"><?php echo e($errors->first('password')); ?></p>
            <?php endif; ?>
            <button type="submit"><?php echo e(__('login')); ?></button>
        </form>
        <a class="forget-link" href="<?php echo e(route('admin.forget.form')); ?>"><?php echo e(__('Forgot Password')); ?> ?</a>
    </div>
</div>



<script src="<?php echo e(asset('assets/admin/js/core/jquery.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/admin/js/core/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/core/bootstrap.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>

</body>
</html>
<?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/admin/login.blade.php ENDPATH**/ ?>