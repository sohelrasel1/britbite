<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>

<?php $__env->startSection('pageHeading'); ?>
 <?php echo e($keywords['Register'] ?? __('Register')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->sign_up_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->sign_up_meta_description : ''); ?>
<?php $__env->startSection('content'); ?>
   
  <section class="page-title-area d-flex align-items-center"
    style="background-image: url('<?php echo e($userBs->breadcrumb ? Uploader::getImageUrl(Constant::WEBSITE_BREADCRUMB, $userBs->breadcrumb, $userBs) : asset('assets/restaurant/images/breadcrum.jpg')); ?>');background-size:cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                        <h2 class="title"><?php echo e($upageHeading?->signup_page_title); ?></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                 <li class="breadcrumb-item"><a href="<?php echo e(route('user.client.dashboard',getParam())); ?>"><i
                                            class="flaticon-home"></i><?php echo e($keywords['Dashboard'] ?? __('Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page"><?php echo e($upageHeading?->signup_page_title); ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

  
    <div class="login-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="login-content">
                        <?php if(Session::has('sendmail')): ?>
                            <div class="alert alert-success mb-4">
                                <p><?php echo e(Session::get('sendmail')); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="login-title">
                            <h3 class="title"><?php echo e($keywords["Register"] ?? __('Register')); ?></h3>
                        </div>
                        <form action="<?php echo e(route('user.client.register.submit',getParam())); ?>" method="POST"><?php echo csrf_field(); ?>
                            <div class="input-box">
                                <span><?php echo e($keywords['Username'] ?? __('Username')); ?> *</span>
                                <input type="text" name="username" value="<?php echo e(Request::old('username')); ?>">
                                <?php if($errors->has('username')): ?>
                                    <p class="text-danger mb-0 mt-2"><?php echo e($errors->first('username')); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="input-box">
                                <span><?php echo e($keywords['Email Address'] ?? __('Email Address')); ?> *</span>
                                <input type="email" name="email" value="<?php echo e(Request::old('email')); ?>">
                                <?php if($errors->has('email')): ?>
                                    <p class="text-danger mb-0 mt-2"><?php echo e($errors->first('email')); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="input-box">
                                <span><?php echo e($keywords['Password'] ?? __('Password')); ?> *</span>
                                <input type="password" name="password" value="<?php echo e(Request::old('password')); ?>">
                                <?php if($errors->has('password')): ?>
                                    <p class="text-danger mb-0 mt-2"><?php echo e($errors->first('password')); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="input-box mb-4">
                                <span><?php echo e($keywords['Confirmation Password'] ?? __('Confirmation Password')); ?> *</span>
                                <input type="password" name="password_confirmation"
                                       value="<?php echo e(Request::old('password_confirmation')); ?>">
                                <?php if($errors->has('password_confirmation')): ?>
                                    <p class="text-danger mb-0 mt-2"><?php echo e($errors->first('password_confirmation')); ?></p>
                                <?php endif; ?>
                            </div>

                            <?php if($userBs->is_recaptcha == 1): ?>
                                <div class="d-block mb-4">
                                    <div id="g-recaptcha" class="d-inline-block"></div>
                                    <?php if($errors->has('g-recaptcha-response')): ?>
                                        <?php
                                            $errmsg = $errors->first('g-recaptcha-response');
                                        ?>
                                        <p class="text-danger mb-0 mt-2"><?php echo e(__("$errmsg")); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="input-btn">
                                <button type="submit"
                                        class="main-btn"><?php echo e($keywords['Register'] ?? __('Register')); ?></button>
                                <br>
                                <p><?php echo e($keywords['Already have an account ?'] ?? __('Already have an account ?')); ?>

                                    <a class="mr-3" href="<?php echo e(route('user.client.login',getParam())); ?>">
                                        <?php echo e($keywords['Click Here'] ?? __('Click Here')); ?>

                                    </a>
                                    <?php echo e($keywords['To login'] ?? __('To login')); ?>

                                    .</p>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/client/register.blade.php ENDPATH**/ ?>