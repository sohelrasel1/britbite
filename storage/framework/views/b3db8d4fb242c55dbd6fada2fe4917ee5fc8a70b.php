<?php $__env->startSection('pagename'); ?>
    - <?php echo e(__("Reset Password")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta-description', !empty($seo) ? $seo->forget_password_meta_description : ''); ?>
<?php $__env->startSection('meta-keywords', !empty($seo) ? $seo->forget_password_meta_keywords : ''); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <?php echo e(__("Reset Password")); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-link'); ?>
    <?php echo e(__("Reset Password")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
    <div class="authentication-area ptb-120">
        <div class="container">
            <div class="main-form">
                <div class="title">
                    <h3><?php echo e(__("Reset Password")); ?></h3>
                </div>
                <?php if(session('success')): ?>
                    <div class="alert alert-success text-center" role="alert">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <form action="<?php echo e(route('user.forgot.password.submit')); ?>" method="post"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="form-group mb-30">
                        <span><?php echo e(__('Email Address')); ?>*</span>
                        <input type="email" name="<?php echo e(__('email')); ?>" class="form-control" value="<?php echo e(Request::old('email')); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-danger mb-0 mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button class="btn primary-btn w-100"><?php echo e(__('Send Password Reset Link')); ?></button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/front/auth/passwords/email.blade.php ENDPATH**/ ?>