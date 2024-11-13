<?php $__env->startSection('meta-description', !empty($seo) ? $seo->login_meta_description : ''); ?>
<?php $__env->startSection('meta-keywords', !empty($seo) ? $seo->login_meta_keywords : ''); ?>

<?php $__env->startSection('pagename'); ?>
- <?php echo e(__("Login")); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-title'); ?>
<?php echo e(__("Login")); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-link'); ?>
<?php echo e(__("Login")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="authentication-area ptb-120">
    <div class="container">
        <div class="main-form">
            <form id="#authForm" action="<?php echo e(route('user.login')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="title">
                    <h3><?php echo e(__('Login')); ?></h3>
                </div>
                <div class="form-group mb-30">
                    <input type="email" name="email" class="form-control" placeholder="<?php echo e(__('Email')); ?>" required>
                    <?php if(Session::has('err')): ?>
                    <p class="text-danger mb-2 mt-2"><?php echo e(Session::get('err')); ?></p>
                    <?php endif; ?>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger mb-2 mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="form-group mb-30" style="position: relative;">
                    <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo e(__('Password')); ?>" required style="padding-right: 40px;">
                    <span id="togglePassword" class="toggle-password-icon" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                        <i class="fa-regular fa-eye" id="passwordIcon"></i>
                    </span>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger mb-2 mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group mb-30">
                    <?php if($bs->is_recaptcha == 1): ?>
                    <div class="d-block mb-4">
                        <?php echo NoCaptcha::renderJs(); ?>

                        <?php echo NoCaptcha::display(); ?>

                        <?php if($errors->has('g-recaptcha-response')): ?>
                        <?php
                        $errmsg = $errors->first('g-recaptcha-response');
                        ?>
                        <p class="text-danger mb-0 mt-2"><?php echo e(__("$errmsg")); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col-4 col-xs-12">
                        <div class="link">
                            <a href="<?php echo e(route('user.forgot.password.form')); ?>"><?php echo e(__('Lost your password')); ?>?</a>
                        </div>
                    </div>
                    <div class="col-8 col-xs-12">
                        <div class="link go-signup">
                            <?php echo e(__("Don't have an account?")); ?> <a href="<?php echo e(route('front.pricing')); ?>"><?php echo e(__("Click Here")); ?></a> <?php echo e(__("to Signup")); ?>

                        </div>
                    </div>
                </div>
                <button type="submit" class="btn primary-btn w-100"> <?php echo e(__('LOG IN')); ?> </button>
            </form>
        </div>
    </div>
</div>




<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');

    togglePassword.addEventListener('click', function () {
        // Toggle the input type
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle the icon
        if (type === 'password') {
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        } else {
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        }
    });
</script>

<style>
    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 16px;
    }

    .toggle-password-icon i {
        font-size: 18px;
        color: #6c757d;
    }

    .form-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
    }
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/front/auth/login.blade.php ENDPATH**/ ?>