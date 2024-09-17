<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h4 class="page-title"><?php echo e(__('Password')); ?></h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="#">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#"><?php echo e(__('Registered Users')); ?></a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#"><?php echo e(__('Password')); ?></a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="<?php echo e(route('register.user.updatePassword')); ?>" method="post" role="form">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-title"><?php echo e(__('Update Password')); ?> (<?php echo e($user->username); ?>)</div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo e(route('admin.register.user')); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Back')); ?></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                            <div class="form-body">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for=""><?php echo e(__('New Password')); ?></label>
                                            <input type="password" class="form-control" placeholder="<?php echo e(__('New Password')); ?>" name="npass" value="<?php echo e(Request::old('npass')); ?>">
                                            <?php $__errorArgs = ['npass'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="text-danger mb-0"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for=""><?php echo e(__('Confirm Password')); ?></label>
                                            <input type="password" class="form-control" placeholder="<?php echo e(__('Confirm Password')); ?>" name="cfpass" value="<?php echo e(Request::old('cfpass')); ?>">
                                            <?php $__errorArgs = ['cfpass'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="text-danger mb-0"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success"><?php echo e(__('Submit')); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/admin/register_user/password.blade.php ENDPATH**/ ?>