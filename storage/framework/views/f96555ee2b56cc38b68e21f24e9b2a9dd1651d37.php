<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>

<?php $__env->startSection('pageHeading'); ?>
 <?php echo e($keywords['Login'] ?? __('Login')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->login_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->login_meta_description : ''); ?>
<?php $__env->startSection('content'); ?>


    <?php if ($__env->exists('user-front.breadcrum',['title' => $upageHeading?->login_page_title])) echo $__env->make('user-front.breadcrum',['title' => $upageHeading?->login_page_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
    <div class="login-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <?php if(!empty(request()->input('redirected')) && request()->input('redirected') == 'checkout'): ?>
                        <a href="<?php echo e(route('user.product.front.checkout', [getParam(),'type' => 'guest'])); ?>"
                           class="btn btn-block btn-primary mb-4 base-btn py-3">
                            <?php echo e($keywords['Checkout as Guest'] ?? __('Checkout as Guest')); ?>

                        </a>
                        <div class="mt-4 mb-3 text-center">
                            <h3 class="mb-0"><strong><?php echo e($keywords['OR'] ?? __('OR')); ?>,</strong></h3>
                        </div>
                    <?php endif; ?>

                    <div class="login-content">

                        <?php if($userBe->is_facebook_login == 1 || $userBe->is_google_login == 1): ?>
                            <div class="social-logins mt-4 mb-4">
                                <div class="btn-group btn-group-toggle d-flex">
                                    <?php if($userBe->is_facebook_login == 1): ?>
                                        <a class="btn btn-primary text-white py-2 facebook-login-btn"
                                           href="<?php echo e(route('user.client.facebook.login',getParam())); ?>"><i
                                                class="fab fa-facebook-f mr-2"></i>
                                            <?php echo e($keywords['Login via Facebook'] ?? __('Login via Facebook')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php if($userBe->is_google_login == 1): ?>
                                        <a class="btn btn-danger text-white py-2 google-login-btn"
                                           href="<?php echo e(route('user.client.google.login',getParam())); ?>"><i
                                                class="fab fa-google mr-2"></i>
                                            <?php echo e($keywords['Login via Google'] ?? __('Login via Google')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="login-title">
                            <h3 class="title"><?php echo e($keywords['Login'] ?? __('Login')); ?></h3>
                        </div>
                        <form id="loginForm" action="<?php echo e(route('user.client.login.submit',getParam())); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="input-box">
                                <span><?php echo e($keywords['Email Address'] ?? __('Email Address')); ?> *</span>
                                <input type="email" name="email" >
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
                            <div class="input-box">
                                <span><?php echo e($keywords['Password'] ??  __('Password')); ?> *</span>
                                <input type="password" name="password">
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
                            <div class="input-box">
                                <?php if($userBs->is_recaptcha == 1): ?>
                                    <div class="d-block mb-4">
                                        <div id="g-recaptcha" class="g-recaptcha d-inline-block"></div>
                                        <?php if($errors->has('g-recaptcha-response')): ?>
                                            <?php
                                                $errmsg = $errors->first('g-recaptcha-response');
                                            ?>
                                            <p class="text-danger mb-0 mt-2"><?php echo e(__("$errmsg")); ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="input-btn">
                                <button type="submit" class="main-btn"><?php echo e($keywords['LOG IN'] ?? __('LOG IN')); ?></button>
                                <div class="mt-2 d-flex justify-content-between">
                                     <a href="<?php echo e(route('user.client.forgot',getParam())); ?>" class="mr-3"><?php echo e($keywords["Lost your password"] ?? __("Lost your password")); ?>

                                        ?</a>
                                    <a href="<?php echo e(route('user.client.register',getParam())); ?>" class="mr-3"><?php echo e($keywords["Don't have an account"] ?? __("Don't have an account")); ?>

                                        ?</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/client/login.blade.php ENDPATH**/ ?>